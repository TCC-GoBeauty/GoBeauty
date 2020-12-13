<?php
    require_once './../gobeauty/controllers/user.controller.php';
    use app_controllers\UserController;
    $controller = new UserController();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Go Beauty</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/signin.css">
</head>

<body>
    <div class="container-login">
        <div class="content-login">
            <div class="animation-login">
                <img src="./assets/img/logo.svg" alt="GOBeauty" />

                <form method="POST" action="">
                    <h1>Faça seu logon</h1>

                    <div class="input">
                        <img src="./assets/img/icons/mail.svg" alt="icon login">
                        <input name="email" placeholder="E-mail" required/>
                    </div>
                    <div class="input">
                        <img src="./assets/img/icons/lock.svg" alt="icon login">
                        <input name="password" type="password" placeholder="Senha" required/>
                    </div>

                    <button class="button" type="submit" name="submit">Entrar</button>

                    <a href="./forgot-password.html">Esqueci minha senha</a>
                </form>

                <a href="./register.php">
                    <img src="./assets/img/icons/login.svg" alt="icon login">
                    Criar conta
                </a>
            </div>
        </div>
''
        <div class="background-signin"></div>
    </div>

    <div>
        <?php
            //verifica se submit foi setado para executar ação do controller
            if(isset($_POST['submit']))
                $controller->login();
            unset($_POST['submit']); 
        ?>
    </div>
</body>

</html>