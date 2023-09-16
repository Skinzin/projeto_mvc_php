<?php 
    /*
     * Config do BD por: Vinicius.
     * Versão 1.0
     */
    $conn =  @new mysqli("localhost:3308", "root", "", "login_mvc");

    /* $conn = mysqli_connect(
        //...
    ) or die ("ERRO não Conecta"); */

    if($conn->connect_error){
        echo "ERRO:".$conn->connect_errno;
        echo "<br>";
        echo "ERRO:".$conn->connect_error;
        exit();
    } else {
        /* echo "Sucesso: Uma conexão adequada com MySQL";
        echo "<br>";
        echo "Host informação: ". $conn->host_info;
        echo "<br>";
        echo "Versão do protocolo: ". $conn->protocol_version; */

        mysqli_set_charset($conn, "utf8"); // Definindo o Tipo de CharSet para ele salvar os dados de forma correta.
        date_default_timezone_set('America/Sao_Paulo');
    }
?>