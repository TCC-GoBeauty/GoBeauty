<?php
    require_once './../gobeauty/controllers/user.controller.php';
    use app_controllers\UserController;
    $controller = new UserController;
?>
<div class="content">
    <h1>Todos os usuários</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class="cname">Nome</th>
                <th scope="col" class="cname">E-mail</th>
                <th scope="col" class="cname">Telefone</th>
                <th scope="col" class="cname">Tipo de usuário</th>
                <th scope="col" class="cname">
                    <form method="POST" action="" class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2 margin" type="text" name="searchUser" placeholder="Pesquisar" aria-label="Pesquisar">
                        <button class="btn btn-outline-success my-2 my-sm-0 margin" type="submit" name="submit">Pesquisar</button>
                    </form>
                </th>
            </tr>
        </thead>
        <tbody>
             <?php
                if(!isset($_POST['submit']))
                    $controller->list();

                if(isset($_POST['submit'])){
                    $controller->listWithParam($_POST['searchUser']);
                }
                
                if(isset($_GET['id']))
                    $controller->DeleteUser($_GET['id']);
                    unset($_GET['id']); 
            ?>  
        </tbody>
    </table>
</div>
