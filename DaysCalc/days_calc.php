<?php

/*Faça um algoritmo em PHP que receba uma data através de um parâmetro da url,
em formato brasileiro (dd/mm/YYYY), e calcule a quantidade de dias passados até a
data atual. A data atual não deve estar fixa no código, deve-se pegar a data atual
automaticamente no momento em que o script for executado*/
session_start();

$date = filter_var(preg_replace("([^0-9/] | [^0-9-])", "", htmlentities($_GET['date'])));
$current_date = date("Y-m-d");

$days = calc_days($current_date, $date);

$_SESSION['msg'] = "Se passaram $days dias desde a data pesquisada.";

header('Location: index.php');
exit;

function calc_days($current_date, $date)
{
    if (strtotime($date) > strtotime($current_date)) {
        $_SESSION['error'] = "Por favor selecione uma data anterior a data atual.";
        header('Location: index.php');
        exit;
    }
    $strtotime = strtotime($current_date) - strtotime($date);
    $days = floor($strtotime / (60 * 60 * 24));

    return $days;
}
