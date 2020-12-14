<?php 
    require_once './../gobeauty/controllers/schedule.controller.php';
    use app_controllers\ScheduleController;
    $sche_controller = new ScheduleController();
?>
<div class="content">
    <h1>Todos os Horários marcados</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class="cname">Cliente</th>
                <th scope="col" class="cname">Procedimento</th>
                <th scope="col" class="cname">Data</th>
                <th scope="col" class="cname">Horário p/ finalização</th>
                <th scope="col" class="cname">Ação</th>
            </tr>
        </thead>
        <tbody>

             <?php
                $sche_controller->listAllSchedules();
                if(isset($_GET['delete']) && $_GET['delete']=='true') {
                    $sche_controller->deleteSchedule($_GET['id']);
                    unset($_GET['id']);
                    unset($_GET['delete']);
                    redirect('page-admin.php?module=today&id=&delete=false');  
                }
            ?>  
        </tbody>
    </table>
</div>
