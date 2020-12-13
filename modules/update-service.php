<?php 
    require_once './../gobeauty/controllers/service.controller.php';

    use app_controllers\ServiceController;

    $serv_controller = new ServiceController();

    $arr = $serv_controller->getServiceInfos($_GET['id']);
?>
<div class="content">
    <h1>Atualizar Serviço</h1>
       
    <form action="" method="POST">
        <div class="container container-sm box" style="margin-top: 5%;">
                <label class="sr-only" for="inlineFormInputGroupUsername2">Nome</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"> <i class="fas fa-file-signature" style="color: orange;"></i></div>
                    </div>
                    <input type="text" name="Servicename" class="form-control" id="inlineFormInputGroupUsername2" value="<?php echo $arr['name']?>"  placeholder="Nome">
                    </div>
            </div>

            <div class="container container-sm box">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="color: #ff9900;">R$</span>
                    </div>
                    <input type="text" name="price" class="form-control" value="<?php echo substr($arr['price'],0,-3)?>" aria-label="Quantia" placeholder="00">
                    <div class="input-group-append">
                        <span class="input-group-text"  style="color: #ff9900;" >.00</span>
                    </div>
                </div>
            </div>

            <div class="container container-sm box">
                <label class="sr-only" for="inlineFormInputGroupUsername2">Tempo de duração</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                            <span class="input-group-text" style="color: #ff9900;"><i class="fas fa-clock" style="color: orange;"></i></span>
                    </div>
                    <input type="time" name="time" value="<?php echo $arr['max_time']?>" class="form-control" id="inlineFormInputGroupUsername2">
                </div>
            </div>

            <div class="container container-sm box" style="text-align: center; margin-top: 3%">
                <button type="submit" name="submit" class="btn btn-lg" style="background-color: #ff9900;color:white;">Confirmar</button>
            </div>
        <?php
            if(isset($_POST['submit']))
                $serv_controller->updateService($_GET['id']);
                unset($_POST['submit']);
        ?>
    </form>
</div> 

<div>