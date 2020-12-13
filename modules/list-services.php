<?php 
    require_once './../gobeauty/controllers/service.controller.php';
    use app_controllers\ServiceController;
    $serv_controller = new ServiceController();
?>
<div class="content">
    <h1>Todos os serviços</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class="cname">Nome</th>
                <th scope="col" class="cname">Preço</th>
                <th scope="col" class="cname">Duração</th>
                <th scope="col" class="cname">Ação</th>
            </tr>
        </thead>
        <tbody>

             <?php
                $serv_controller->listAllServices();
                if(isset($_GET['delete']) && $_GET['delete']=='true') {
                    $serv_controller->deleteService($_GET['id']);
                    unset($_GET['id']);
                    unset($_GET['delete']);
                    redirect('page-admin.php?module=list-services&id=&delete=false');  
                }
            ?>  
        </tbody>
    </table>
</div>
