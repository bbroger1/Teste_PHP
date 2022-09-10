<?php

class MyDate
{
    public function index($date)
    {
        //verifica se tem a quantidade de 10 caracteres
        if (strlen($date) < 10) {
            $_SESSION['error'] = "Formato de data inválido, favor utilizar d-m-Y ou Y-m-d.";
            header('Location: index.php');
            exit;
        } elseif (strlen($date) > 10) {
            $_SESSION['error'] = "Formato de data inválido, favor utilizar d-m-Y ou Y-m-d.";
            header('Location: index.php');
            exit;
        }

        $this->toggle($date);
    }

    private static function toggle($date)
    {
        //verifica se está no formato americano
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
            //se estiver faz a conversão para o formato brasileiro
            $brazilianDate = implode('/', array_reverse(explode('-', $date)));
            $_SESSION['msg'] = "Data no formato americano, convertendo para o formato brasileiro a data é " . $brazilianDate;
            header('Location: index.php');
            exit;
            //verifica se a data está com barras e substitui por -  
        } elseif (preg_match("/^[0-9]{4}\/(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
            $brazilianDate = implode('/', array_reverse(explode('/', $date)));
            $_SESSION['msg'] = "Data no formato americano2, convertendo para o formato brasileiro a data é " . $brazilianDate;
            header('Location: index.php');
            exit;
            //verifica se a data esta no formato brasileiro
        } elseif (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/", $date)) {
            //se estiver faz a conversão para o formato americano
            $americanDate = self::toAmerican($date, "-");
            $_SESSION['msg'] = "Data no formato brasileiro, convertendo para o formato americano a data é " . $americanDate;
            header('Location: index.php');
            exit;
            //verifica se a data está com barras e substitui por -  
        } elseif (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/", $date)) {
            $americanDate = self::toAmerican($date, "/");
            $_SESSION['msg'] = "Data no formato brasileiro2, convertendo para o formato americano a data é " . $americanDate;
            header('Location: index.php');
            exit;
        } else {
            $_SESSION['error'] = "Formato de data inválido, favor utilizar d-m-Y ou Y-m-d.";
            header('Location: index.php');
            exit;
        }
    }

    private static function toAmerican($date, $symbol)
    {
        if ($symbol == "-") {
            $americanDate = implode("-", array_reverse(explode("-", $date)));
        } else {
            $americanDate = implode("-", array_reverse(explode('/', $date)));
        }
        return $americanDate;
    }
}
