<?php

header('Content-Type: application/json; charset=utf-8');

// сумма блин
function sum($a, $b, $c) {
    return array(
        'result' => 'ok',
        'data' => $a + $b + $c
    );
}

// производная нафик
function der($func, $x, $eps) {
    $fx = $func($x);
    $f_plus_eps = $func($x + $eps);
    return (($f_plus_eps - $fx) / $eps);
}

function derivative($func, $x, $eps) {
    return array (
        'result' => 'ok',
        'data' => der($func, $x, $eps)
    );
}

// сплайныыыыыыы  ыыыы ыы(
function spline($x1, $y1, $x2, $y2, $x3, $y3) {
    $h1 = $x2 - $x1;
    $h2 = $x3 - $x2;

    $a1 = ($y2 - $y1) / $h1;
    $a2 = ($y3 - $y2) / $h2;

    $b1 = 3 * (($y2 - $y1) / ($h1 * $h1)) - 2 * (($y3 - $y1) / ($h1 * $h2)) + (($y3 - $y2) / ($h2 * $h2));
    $b2 = 3 * (($y3 - $y2) / ($h2 * $h2)) - 2 * (($y3 - $y1) / ($h1 * $h2)) + (($y2 - $y1) / ($h1 * $h1));

    $c1 = (($y3 - $y1) / ($h1 * $h2)) - (($y2 - $y1) / ($h1 * $h1)) - $b1 * $h1 / 3;
    $c2 = (($y2 - $y1) / ($h1 * $h2)) - (($y3 - $y2) / ($h2 * $h2)) - $b2 * $h2 / 3;

    $splinePoints = [];
    $x = $x1;
    while ($x <= $x3) {
        if ($x <= $x2) {
            $y = $y1 + $a1 * ($x - $x1) + $b1 * pow($x - $x1, 2) / 2 + $c1 * pow($x - $x1, 3) / 6;
        } else {
            $y = $y2 + $a2 * ($x - $x2) + $b2 * pow($x - $x2, 2) / 2 + $c2 * pow($x - $x2, 3) / 6;
        }
        $splinePoints[] = ['x' => $x, 'y' => $y];
        $x += 0.01; // шаг для отрисовки графека
    }

    return array(
        'result' => 'ok',
        'splinePoints' => $splinePoints,
    );
}

// функция для получение результата...
function getResult($params) {
    $method = $params['method'];
    switch ($method) {
        case 'sum': 
            return sum($params['a'], $params['b'], $params['c']);
        case 'derivative': 
            return derivative($params['func'], $params['x'], $params['eps']);
        case 'spline':
            return spline($params['x1'], $params['y1'], $params['x2'], $params['y2'], $params['x3'], $params['y3']);
    }
    return array(
        'result' => 'error',
        'error' => 'im broken'
    );
}


// ну то самое
if (isset($_GET['method']) && !empty($_GET['method'])) {
    $method = $_GET['method'];
    echo(json_encode(getResult($_GET)));
} else {
    echo json_encode(array(
        'result' => 'error',
        'error' => 'missing method'
    ));
}


/*$a = $_GET["a"]; 
$b = $_GET["b"];
$c = $_GET["c"];*/

//$method = $_GET['method']; // - помогает обработать более чем 1 запрос в бэкенде

/*
// корни уравнения
$a = 1;
$b = 2;
$c = 0;

if(isset($_GET["a"])) { $a = $_GET["a"]; };
if(isset($_GET["b"])) { $b = $_GET["b"]; };
if(isset($_GET["c"])) { $c = $_GET["c"]; };

function FindTheRoot($a, $b, $c) {
    $discr = $b * $b - 4 * $a * $c; 
    if ($discr >= 0) {
        $rootFirst = (- $b + sqrt($discr)) / (2 * $a);
        $rootSecond = (- $b - sqrt($discr)) / (2 * $a);
        return "первый корень = {$rootFirst}, второй корень = {$rootSecond} <br>";
    } else {
        return "дискриминант меньше либо равень нулю... на этом мои полномочия - всё!";
    }
}   
echo FindTheRoot($a, $b, $c);


// производная
$func = function($x) { return $x**2; }; 
$x = 2; 
$eps = 0.0001; 

if(isset($_GET["x"])) { $x = $_GET["x"]; };
if(isset($_GET["eps"])) { $eps = $_GET["eps"]; };
if(isset($_GET["func"])) { $func = $_GET["func"]; };

function derivative($func, $x, $eps) {
    $fx = $func($x);
    $f_plus_eps = $func($x + $eps);
    return ($f_plus_eps - $fx) / $eps;
}
  
$derivative_value = derivative($func, $x, $eps);
echo "<br> производная функции в точке {$x}: {$derivative_value}";
*/