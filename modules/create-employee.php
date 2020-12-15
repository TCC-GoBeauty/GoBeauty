<?php
    if($_SESSION['id']>2) {
        echo 'Você não tem acesso a essa página!';
    }
?>
<div class="content">
    <h1>Criar Funcionário</h1>
       
    <form action="" method="POST">
        <div class="container container-sm box" style="margin-top: 5%;">
                <label class="sr-only" for="inlineFormInputGroupUsername2">Usuário</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"> <img src="./assets/img/icons/user.svg" alt="icon login"></div>
                    </div>
                    <input type="text" name="name" class="form-control" id="inlineFormInputGroupUsername2"  placeholder="Usuário">
                    </div>
            </div>
                <div class="container container-sm box">
                <label class="sr-only" for="inlineFormInputGroupUsername2">Telefone</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><img src="./assets/img/icons/phone.svg" alt="icon login"></div>
                    </div>
                    <input type="tel" name="tel" class="form-control" id="tel"  placeholder="Telefone">
                    </div>
            </div>
            <div class="container container-sm box">
                <label class="sr-only" for="inlineFormInputGroupUsername2">E-mail</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><img src="./assets/img/icons/mail.svg" alt="icon login"></div>
                    </div>
                    <input type="text" name="email" class="form-control" id="inlineFormInputGroupUsername2"  placeholder="E-mail">
                    </div>
            </div>
            <div class="container container-sm box">
                <label class="sr-only" for="inlineFormInputGroupUsername2">Senha</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><img src="./assets/img/icons/lock.svg" alt="icon login"></div>
                    </div>
                    <input type="password" name="password" class="form-control" id="inlineFormInputGroupUsername2"  placeholder="Senha">
                </div>
            </div>
            <div class="container container-sm box" style="text-align: center; margin-top: 3%">
                <button type="submit" name="submit" class="btn btn-lg" style="background-color: #ff9900;color:white;">Confirmar</button>
            </div>
        
    </form>
</div> 

<div>
    <?php
        //verifica se submit foi setado para executar ação do controller
        if(isset($_POST['submit']))
            $controller->createNewAccount(4);
        unset($_POST['submit']);
    ?>
</div>
<script lang="javascript">
        <?php
            require_once './../gobeauty/controllers/functions/mask.php';
        ?>
</script>


