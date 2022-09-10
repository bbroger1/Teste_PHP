<?php
session_start();
require_once("MyDate.php");

if (isset($_POST['date'])) {
    $date = filter_var(preg_replace("([^0-9/] | [^0-9-])", "", htmlentities($_POST['date'])));
    if (!$date || $date == null) {
        $_SESSION['error'] = "Por favor selecione uma data.";
        header('Location: index.php');
        exit;
    }
    $myDate = new MyDate();
    $myDate->index($date);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Date</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">

        <?php
        if (isset($_SESSION['msg'])) {
            echo "<div class='alert alert-success text-center mt-2'>" . $_SESSION['msg'] . "</div>";
            unset($_SESSION['msg']);
        }

        if (isset($_SESSION['error'])) {
            echo "<div class='alert alert-danger text-center mt-2'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']);
        }
        ?>
        <form action="" method="POST" class="mt-5 text-center">
            <div class="row text-center">
                <div class="col">
                    <label for="date">Informe a data:</label>
                    <input type="text" name="date" id="date">
                </div>
            </div>
            <button class="btn btn-sm btn-success mt-2" type="submit">Pesquisar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>