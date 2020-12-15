<?php
    require_once './../gobeauty/controllers/functions/myFunctions.php';
    if(!isset($_SESSION))
        session_start();
    if(!isset($_SESSION['id'])){
        session_destroy();
        header("Location:./../gobeauty/index.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/nav-custom.css">
    <link rel="stylesheet" href="./assets/css/content.css">
    <link rel="stylesheet" href="./assets/css/profile.css">
    <link rel="stylesheet" href="./assets/css/change-password.css">
    <link rel="stylesheet" href="./assets/css/gallery.css">
    <script src="https://kit.fontawesome.com/86d4fe3a19.js"></script>
    <title>Usuário - GoBeauty</title>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="#"><img src="./assets/img/logo.svg" alt="Logo GoBeauty" width="50%" height="50%"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#textoNavbar" aria-controls="textoNavbar" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="textoNavbar">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="?module=today-user">Inicio<span class="sr-only">(Página atual)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?module=gallery">Galeria</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?module=create-schedule">Agendar</a>
        </li>
        </ul>
        <span class="nav-item dropdown" id="user-options">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php salute(); echo $_SESSION['username'];?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="?module=edit-account&u=<?php echo $_SESSION['id']?>">Editar minha conta</a>
                <a class="dropdown-item" href="./../gobeauty/controllers/functions/logout.php">Logout do sistema</a>
            </div>
        </span>
    </div>
    </nav>
    <div class="container">
        <?php

            if(isset($_GET['module']))
                require_once './../gobeauty/modules/'.$_GET['module'].'.php';
        ?>
    </div>
    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>