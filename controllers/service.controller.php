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
                        redirect('page-admin.php?module=create-service');
                    } else {
                        alertMessage('Serviço já existe');
                        unset($this->_service);
                        redirect('page-admin.php?module=create-service');
                    }
                } catch (PDOException $ex) {
                        //captura erro do banco
                        alertMessage('Erro ao inserir usuário');
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
    }
?>