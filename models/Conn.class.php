<?php

    //declarando namespace e dependências necessárias
    namespace app_models;
    use \PDO;
    use \PDOException;
    use \PDOStatement;
    use \PDORow;
    use \Exception;
    use \ErrorException;

    Class Connect {
        private $_host;
        private $_user;
        private $_pass;
        private $_db;
        private $_conn;


        //constrói objeto com parâmetros de conexão ao banco
        public function __construct($host='127.0.0.1',$user='root',$pass='',$db='id15544054_gobeauty1') {
            $this->_host = $host;
            $this->_user = $user;
            $this->_pass = $pass;
            $this->_db = $db;
            
            //tenta realizar conexão com parâmetros passados
            try {
                $this->_conn = new PDO('mysql:host='.$this->_host.';dbname='.$this->_db,$this->_user,$this->_pass);
                $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $err) {
                //captura erro do PDO
                return $err->getMessage();
            } catch (Exception $genericERR) {
                //captura erro genérico
                return $genericERR->getMessage();
            }
        }

        public function get_conn(){
            //devolve valor da conexão
            if(isset($this->_conn)){
                return $this->_conn;
            } else {
                return false;
            }
        }

        public function __destruct()
        {
            //destrói conexão
            unset($this->_conn);
        }
    }
?>