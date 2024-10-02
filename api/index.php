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
function splines($p1, $p2, $p3) {
    
}

// функция для получение результата...
function getResult($params) {
    $method = $params['method'];
    switch ($method) {
        case 'sum': 
            return sum($params['a'], $params['b'], $params['c']);
        case 'derivative': 
            return derivative($params['func'], $params['x'], $params['eps']);
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