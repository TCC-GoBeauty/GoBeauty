<?php
    require_once './../gobeauty/controllers/user.controller.php';
    use app_controllers\UserController;

    $controller = new UserController;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Go Beauty</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/signup.css">
    <link rel="stylesheet" href="./assets/css/signin.css">
</head>

<body>
    <div class="container-login">
        <div class="background-signup"></div>
        <div class="content-login">
            <div class="animation-signup">
                <img src="./assets/img/logo.svg" alt="GoBeauty" />

                <form method="POST" action="">
                    <h1>Faça seu cadastro</h1>

                    <div class="input">
                        <img src="./assets/img/icons/user.svg" alt="icon login">
                        <input name="name" type="text" placeholder="Nome" required/>
                    </div>

                    <div class="input">
                        <img src="./assets/img/icons/phone.svg" alt="icon login">
                        <input  name="tel" id="tel" type="tel" placeholder="Telefone" required/>
                    </div>
                    
                    <div class="input">
                        <img src="./assets/img/icons/mail.svg" alt="icon login">
                        <input name="email" type="email" placeholder="E-mail" required/>
                    </div>

                    <div class="input">
                        <img src="./assets/img/icons/lock.svg" alt="icon login">
                        <input name="password" type="password" placeholder="Senha" required/>
                    </div>

                    <button class="button" type="submit" name="submit">Cadastrar</button>

                </form>


                <a href="./index.php" id="back-to-login">
                    <img src="./assets/img/icons/arrowLeft.svg" alt="icon login">
                    Voltar ao login
                </a>
                <div>
                    <?php
                        //verifica se submit foi setado para executar ação do controller
                        if(isset($_POST['submit']))
                            $controller->createNewAccount(3);
                        unset($_POST['submit']);
                    ?>
                </div>

            </div>
        </div>
    </div>
    <script lang="javascript">
        <?php
            require_once './../gobeauty/controllers/functions/mask.php';
        ?>
    </script>

</body>

</html>

