<div class="content">
    <h1>Criar Funcionário</h1>
       
       <div class="container container-sm box" style="margin-top: 5%;">
            <label class="sr-only" for="inlineFormInputGroupUsername2">Usuário</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"> <img src="./assets/img/icons/user.svg" alt="icon login"></div>
                </div>
                <input type="text" class="form-control" id="inlineFormInputGroupUsername2"  placeholder="Usuário">
                </div>
        </div>
        <div class="container container-sm box">
            <label class="sr-only" for="inlineFormInputGroupUsername2">Telefone</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><img src="./assets/img/icons/phone.svg" alt="icon login"></div>
                </div>
                <input type="tel" class="form-control" id="tel"  placeholder="Telefone">
                </div>
        </div>
        <div class="container container-sm box">
            <label class="sr-only" for="inlineFormInputGroupUsername2">E-mail</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><img src="./assets/img/icons/mail.svg" alt="icon login"></div>
                </div>
                <input type="text" class="form-control" id="inlineFormInputGroupUsername2"  placeholder="E-mail">
                </div>
        </div>
        <div class="container container-sm box">
            <label class="sr-only" for="inlineFormInputGroupUsername2">Senha</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><img src="./assets/img/icons/lock.svg" alt="icon login"></div>
                </div>
                <input type="password" class="form-control" id="inlineFormInputGroupUsername2"  placeholder="Senha">
            </div>
        </div>
        <div class="container container-sm box" style="text-align: center; margin-top: 3%">
            <button type="submit" class="btn btn-lg" style="background-color:  #ff9900;color:white;">Confirmar</button>
        </div>
        
</div> 

<script lang="javascript">
        <?php
            require_once './../gobeauty/controllers/functions/mask.php';
        ?>
</script>


