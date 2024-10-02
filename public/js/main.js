const sendRequest = async (a, b, c) => {
    const response = await fetch(
        `/api/index.php?method=sum&a=${a}&b=${b}&c=${c}`
    ); // - ОТПРАВЛЯЕТ запрос и возвращает значение как обычная привычная нам функция
    const answer = await response.json()
    if (answer?.result === 'ok') {
        return answer.data;
    }
    return "im broken";
}

const sendRequest2 = async (x, func, eps) => {
    const response = await fetch(
        `/api/index.php?method=derivative&x=${x}&func=${func}&eps=${eps}`
    ); 
    const answer = await response.json()
    if (answer?.result === 'ok') {
        return answer.data;
    }
    return "im broken";
}

const clickHandler = async () => {
    const a = document.getElementById('a').value - 0;
    const b = document.getElementById('b').value - 0;
    const c = document.getElementById('c').value - 0;

    if (a && b && c) {
        const result = await sendRequest(a, b, c);
        document.getElementById('result').innerHTML = `result: ${result}`;
    }
}

const clickHandler2 = async () => {
    const x = document.getElementById('x').value - 0;
    const func = document.getElementById('func').value;
    const eps = document.getElementById('eps').value - 0;

    if (x && func && eps) {
        const result = await sendRequest2(x, func, eps);
        document.getElementById('resultDer').innerHTML = `result: ${result}`;
    }
}

window.onload = function () {
    document.getElementById('button').addEventListener('click', clickHandler);
    document.getElementById('butDer').addEventListener('click', clickHandler2);
}
