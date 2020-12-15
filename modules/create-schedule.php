<?php 
    require_once './../gobeauty/controllers/service.controller.php';
    require_once './../gobeauty/controllers/schedule.controller.php';
    use app_controllers\ServiceController;
    use app_controllers\ScheduleController;

    $serv_controller = new ServiceController();
    $schedule_con = new ScheduleController();
?>
<div class="content">
    <h1>Agendar horário</h1>
       
    <form action="" method="POST">
        <div class="container container-sm box" style="margin-top: 5%;">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01" style="color: #ff9900">Procedimento</label>
                </div>
                <select name="service" class="custom-select" id="inputGroupSelect01" required>
                    <option selected disabled>Escolha clicando aqui</option>
                    <?php 
                        $serv_controller->listServices();
                    ?>
                </select>
            </div>
        </div>

            <div class="container container-sm box">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="color: #ff9900;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-calendar-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </div>
                    <input type="date" name="date" class="form-control" aria-label="date" min="<?php echo date('Y-m-d');?>" max="<?php echo date('Y-m-d',strtotime('+90 days'));?>" required>
                </div>
            </div>

            <div class="container container-sm box">
                <label class="sr-only" for="inlineFormInputGroupUsername2">Tempo de duração</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                            <span class="input-group-text" style="color: #ff9900;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-clock" style="color: orange;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
                    </div>
                    <input type="time" name="time" class="form-control" id="inlineFormInputGroupUsername2" min="09:00" max="19:00" required>
                </div>
            </div>

            <div class="container container-sm box" style="text-align: center; margin-top: 3%">
                <button type="submit" name="submit" class="btn btn-lg" style="background-color: #ff9900;color:white;">Confirmar</button>
            </div>
        <?php
            if(isset($_POST['submit'])){
                $start_time = $_POST['date'].' '.$_POST['time'].':00';
                $schedule_con->addNewSchedule($_POST['service'],$start_time,$_SESSION['id']);
                unset($_POST['submit']);                
            }

        ?>
    </form>
</div> 

<div>