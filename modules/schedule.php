<?php
    require_once './../gobeauty/controllers/user.controller.php';
    use app_controllers\UserController;
    $controller = new UserController();
?>

<div class="content">
    <h1>Agendar horário</h1>
       
    <form action="" method="POST">
        
            <div class="container container-sm box" style="text-align: center; margin-top: 5%">
                <button type="submit" name="submit" class="btn btn-lg" style="background-color: #ff9900;color:white;">Confirmar</button>
            </div>
        
    </form>
</div> 

<div>
    <?php
        //verifica se submit foi setado para executar ação do controller
        if(isset($_POST['submit']))
            $controller->UpdateUser($_GET['u']);
        unset($_POST['submit']);
    ?>
</div>