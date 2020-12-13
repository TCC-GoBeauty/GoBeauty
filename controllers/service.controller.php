<?php
    namespace app_controllers;
    require_once './../gobeauty/models/service.class.php';

    use app_models\Service;
    use PDOException;

class ServiceController {
        private $_service;

        public function __construct() {
            $this->_service = new Service();
        }

        public function addNewService() {              
            if(!isset($_SESSION)) {
                session_start();
            }
            if(strlen($_POST['Servicename'])>=2 && strlen($_POST['price'])>=0.00) {
                $this->_service->setName($_POST['Servicename']);
                $this->_service->setPrice($_POST['price'].".00");
                $this->_service->setMaxTime($_POST['time']);

                try{
                    if(!$this->_service->exists($this->_service->getName())) {
                        $this->_service->createService($this->_service->getName(),$this->_service->getPrice(),$this->_service->getMaxTime());
                        alertMessage('Serviço inserido com sucesso');
                        unset($this->_service);
                        redirect('page-admin.php?module=list-services');
                    } else {
                        alertMessage('Serviço já existe');
                        unset($this->_service);
                        redirect('page-admin.php?module=create-service');
                    }
                } catch (PDOException $ex) {
                        //captura erro do banco
                        alertMessage('Erro ao inserir serviço');
                        unset($this->_service);
                        redirect('page-admin.php?module=create-service');
                }
            } else {
                //algo inválido no registro para a plataforma
                alertMessage('Informações inválidas');
                unset($this->_service);
                redirect('page-admin.php?module=create-service');                
            }
        }

        public function updateService($id) {
            if(!isset($_SESSION)) {
                session_start();
            }
            if(strlen($_POST['Servicename'])>=2 && strlen($_POST['price'])>=0.00) {
                $this->_service->setName($_POST['Servicename']);
                $this->_service->setPrice($_POST['price'].".00");
                $this->_service->setMaxTime($_POST['time']);
                try {
                    $this->_service->updateService($id,$this->_service->getName(),$this->_service->getPrice(),$this->_service->getMaxTime());
                    alertMessage('Serviço atualizado com sucesso');
                    unset($this->_service);
                    redirect('page-admin.php?module=list-services');
                } catch (PDOException $ex) {
                    //captura erro do banco
                    alertMessage('Erro ao atualizar serviço');
                    unset($this->_service);
                    redirect('page-admin.php?module=list-services');
                }
            } else {
            //algo inválido no registro para a plataforma
                alertMessage('Informações inválidas');
                unset($this->_service);
                redirect('page-admin.php?module=list-services');                
            } 
        }
        
        public function deleteService($id) {
            try {
                $this->_service->deleteService($id);
                alertMessage('Serviço deletado com sucesso');
                unset($this->_service);
                redirect('page-admin.php?module=list-services');       
            } catch (PDOException $ex) {
                //captura erro do banco
                alertMessage('Erro ao deletar serviço');
                unset($this->_service);
                redirect('page-admin.php?module=list-services');
            }
        }

        public function listAllServices() {
            $arr = $this->_service->getAllServices();
            for($i=0;$i < count($arr);$i++) {
                echo "<tr>
                <td>".$arr[$i]['name']."</td>
                <td>".$arr[$i]['price']."</td>
                <td>".$arr[$i]['max_time']."</td>
                <td>
                <a href='?module=list-services&id=".$arr[$i]['id']."&delete=true' role='button' class='btn btn-sm'><i class='fas fa-trash-alt'></i>&nbsp;&nbsp;Deletar</a>
                <a href='?module=update-service&id=".$arr[$i]['id']."' role='button' class='btn btn-sm'><i class='far fa-edit'></i>&nbsp;&nbsp;Editar</a>
                </td>
        </tr>";
            }
        }

        public function getServiceInfos($id) {
           return $this->_service->getServiceInfos($id);
        }
    }
?>