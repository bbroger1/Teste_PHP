<?php
require_once("src/Connection.php");
require_once("src/User.php");
session_start();

$page = "";
$user_id = "";

//verifica paginação
if (isset($_GET["p"])) {
    $page = $_GET["p"];
} else {
    $page = 1;
}

//verifica se possui pesquisa pelo id do user
if (isset($_GET["id"])) {
    $user_id = $_GET["id"];
}

$obj = new User();
$users = $obj->index($page, $user_id);

$pagination = $obj->pagination($page, $user_id);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div>
            <h3 class="text-center mt-2 mb-2">Usuários</h3>
            <?php
            if (isset($_SESSION['msg'])) {
                echo "<div class='alert alert-success text-center mb-2'>" . $_SESSION['msg'] . "</div>";
                unset($_SESSION['msg']);
            }

            if (isset($_SESSION['error'])) {
                echo "<div class='alert alert-danger text-center mb-2'>" . $_SESSION['error'] . "</div>";
                unset($_SESSION['error']);
            }
            ?>
            <?php foreach ($users as $user) : ?>
                <div class="row">
                    <div class="text-center mt-2 mb-2">
                        <?= $user['nome']; ?> - <a class="btn btn-sm btn-success" href="?id=<?= $user['id']; ?>">Ver</a>
                        <?php if ($user_id) {
                            echo '- <a class="btn btn-sm btn-primary" href="http://localhost:3000/index.php">Voltar</a>';
                        } ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="text-center mt-2">
                <nav>
                    <ul class="pagination justify-content-center">
                        <?php if (isset($user_id) && $user_id != null) {
                            echo '<li class="page-item"><a class="page-link" href="http://localhost:3000/index.php?id=' . $user['id'] . '">1</a></li>';
                        } else {
                            $previous = $page - 1;
                            if ($previous <= 0) {
                                $previous = 1;
                            }

                            $next = $page + 1;
                            if ($next > $pagination) {
                                $next = $pagination;
                            }

                            echo '<li class="page-item"><a class="page-link" href="http://localhost:3000/index.php?p=' . $previous . '" aria-label="Anterior"> <span aria-hidden="true">&laquo;</span></a></li>';

                            for ($i = 1; $i <= $pagination; $i++) {
                                $active = "";
                                if ($page == $i) {
                                    $active = "active";
                                }
                                echo '<li class="page-item ' . $active . '"><a class="page-link" href="http://localhost:3000/index.php?p=' . $i . '">' . $i . '</a></li>';
                            }

                            echo '<li class="page-item"><a class="page-link" href="http://localhost:3000/index.php?p=' . $next . '" aria-label="Anterior"> <span aria-hidden="true">&raquo;</span></a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>