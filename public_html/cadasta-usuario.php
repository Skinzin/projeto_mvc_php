<?php
    include_once("../private/config/global.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div id="form-addLogin">
        <div>
            <label for="user-name">Nome de usuário:</label>
            <input type="text" placeholder="Ex: Joe Dohn" id="user-name" name="user-name">
        </div>
        <div>
            <label for="user-email">Email:</label>
            <input type="email" placeholder="Ex: joedohn@email.com"  id="user-email" name="user-email">
        </div>
        <div>
            <label for="user-pass">Senha:</label>
            <input type="password" placeholder="********" id="user-pass" name="user-pass">
        </div>
        <div>
            <label for="user-pass-confirm">Confirme sua senha:</label>
            <input type="password" placeholder="********" id="user-pass-confirm" name="user-pass-confirm">
        </div>

        <button onclick="handleLogin()">Enviar</button>

        <span id="alertMsg"></span>
    </div>
    <script>
        function handleLogin() {
            let username = $("#user-name").val();
            let email = $("#user-email").val();
            let password = $("#user-pass").val();
            let confirPassword = $("#user-pass-confirm").val();

            $.ajax({
                url: "<?=$pathPrivate?>/api/model/Login.model.php",
                method: "POST",
                // async: true,
                data: {
                    username,
                    email,
                    password,
                    confirPassword
                },
                // dataType: "json"
            }).done((result) => {
                if(result['status']) {
                    document.getElementById("alertMsg").innerHTML = result.msg;
                } else {
                    document.getElementById("alertMsg").innerHTML = result.msg;
                }
            }).fail(() => {
                document.getElementById("alertMsg").innerHTML = "Ouve um erro inesperado."
            });
        }
    </script>
</body>
</html>