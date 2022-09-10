<?php

/*Faça um algoritmo em PHP que calcule a soma dos valores do array abaixo. Não é
permitido utilizar funções já definidas no PHP para realizar a soma, como por
exemplo array_sum, mas você pode utilizar if, while, for, foreach caso queira.
$valores = array(1,3,5,9,12,10)*/

function sum(array $array)
{
    $sum = 0;
    foreach ($array as $value) {
        $sum += $value;
    }

    return $sum;
}

$valores = array(1, 3, 5, 9, 12, 10);
$sum = sum($valores);
echo $sum;
