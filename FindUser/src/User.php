<?php
/*Crie um banco de dados mysql com uma tabela "usuarios", contendo as colunas "id",
"nome", "login", "senha". Crie um arquivo php que se conecte a esse banco de
dados utilizando PDO. Em seguida faça uma consulta na tabela "usuarios" filtrando
pela coluna "id", que deverá ser igual ao valor recebido através de um parâmetro "id"
na url*/

require_once('Connection.php');

class User
{
    private $per_page = 5;

    public function __construct()
    {
        $this->conn = new Connection();
        $this->pdo = $this->conn->connection();
    }

    public function index($page, $user_id)
    {
        if (isset($user_id) && $user_id != null) {
            $stmt = $this->pdo->prepare("SELECT * FROM user WHERE id = $user_id");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $offset = ($page - 1) * $this->per_page;
            $stmt = $this->pdo->prepare("SELECT * FROM user LIMIT $this->per_page OFFSET $offset");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $result;
    }

    public function pagination($user_id)
    {
        if (isset($user_id) && $user_id != null) {
            $count = 1;
        } else {
            $stmt = $this->pdo->prepare("SELECT count('id') as count FROM user");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $count = ceil($result['count'] / $this->per_page);
        }

        return $count;
    }
}
