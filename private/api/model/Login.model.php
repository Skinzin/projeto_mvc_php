<?php 
    header("Content-Type: application/json");
    include_once("../controller/Login.controller.php");

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirPassword = $_POST['confirPassword'];

    // Criando Obj login;
    $objLogin = new Login();

    if($password === $confirPassword) {
        $userStatus = 1;
        $fxLogin = 'addLogin';
        // Acesso e a passagem e retorno do Controller;
        $objLogin->setUsername($username);
        $objLogin->setEmail($email);
        $objLogin->setPassword($password, $email);
        $objLogin->setUserHash($password, $email);
        // $objLogin->setStatus($status);
        $objLogin->setAddLogin($fxLogin);

        $retorna = $objLogin->fxLogin;
        // $retorna = [
        //     'status' => true,
        //     'msg' => "<p style='color:#0f0'>Cadastro realizado com sucesso!!!</p>"
        // ];
    } else {
        $retorna = [
            "status" => false,
            'msg' => "<p style='color:#f00'>ERRO - Senha não combina.</p>"
        ];
    }

    echo json_encode($retorna);

    // echo "<script>console.log(".implode($retorna).")</script>";
    // return $retorna;

    // echo '<pre>';
    // var_dump($retorna);
    // echo '</pre>';
?>