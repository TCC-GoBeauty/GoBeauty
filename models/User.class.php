<?php
    namespace app_models;

use PDOException;
use PDORow;

require_once 'Conn.class.php';

    class User {
        private $_user;
        private $_pass;
        private $_email;
        private $_tel;
        private $_statusLogin;
        private $_role;
        private $_userInfos = [];

        //Construtor que inicializa alguns valores(Será utilizado nas classes que herdam desta)
        public function __construct() {

        }

        //conjunto de funções que setam e retornam atributos da classe
        public function setUsername($user) {
            $this->_user = $user;
        }

        public function getUsername() {
            return $this->_user;
        }

        public function setPass($pass) {
            $this->_pass = md5($pass);
        }

        public function getPass() {
            return $this->_pass;
        }

        public function setEmail($email) {
            $this->_email = $email;
        }

        public function getEmail(){
            return $this->_email;
        }

        public function setTel($tel) {
            $this->_tel = $tel;
        }

        public function getTel(){
            return $this->_tel;
        }

        public function setRole($role) {
            $this->_role = $role;
        }

        public function getRole(){
            return $this->_role;
        }

        public function getStatusLogin() {
            return $this->_statusLogin;
        }
        
        public function getUserInfos() {
            return $this->_userInfos;
        }

        public function getAllUsers() {
            $conn = new Connect();

            try{
                $sql = "SELECT * FROM users WHERE role_id between 2 and 4";
                $stmt = $conn->get_conn()->prepare($sql);
                $stmt->execute();
                $result = $stmt -> fetchAll();
                return $result;
            } catch(PDOException $ex) {
                return $ex->getMessage();
            }
        }

        //função que cria um usuário dentro da plataforma
        public function createUser($name,$email,$tel,$pass,$role){
            $this->setEmail($email);
            $this->setUsername($name);
            $this->setPass($pass);
            $this->setTel($tel);
            $this->setRole($role);
            $conn = new Connect();
            try{
                $sql = "INSERT INTO users(email,username,tel,password,created_at,role_id) VALUES (:email,:user,:tel,:pass,:created_at,:role)";
                $stmt = $conn->get_conn()->prepare($sql);
                $stmt->bindValue(':email',"".$this->getEmail()."");
                $stmt->bindValue(':user',"".$this->getUsername()."");
                $stmt->bindValue(':tel',"".$this->getTel()."");
                $stmt->bindValue(':pass',"".$this->getPass()."");
                $stmt->bindValue(':created_at',"".date('Y-m-d H:m:s')."");
                $stmt->bindValue(':role',"".$this->getRole()."");
                $stmt->execute();
            } catch (PDOException $ex) {
                return $ex->getMessage();
            } 
        }

        //função que delete os dados do usuário de dentro da plataforma
        public function deleteUser($id) {
            $conn = new Connect();
            try{
                $sql = "DELETE FROM users WHERE id = :id";
                $stmt = $conn->get_conn()->prepare($sql);
                $stmt->bindValue(':id',"".$id."");
                $stmt->execute();
            } catch (PDOException $ex){
                return $ex->getMessage();
            }
        }

        //Função que atualiza os dados do usuário dentro da plataforma
        public function updateUser($id,$user,$email,$pass,$tel) {
            $this -> setEmail($email);
            $this -> setUsername($user);
            $this -> setPass($pass);
            $this -> setTel($tel);
            $conn = new Connect();
            try{
                $sql = "UPDATE users  SET username = :user, password = :pass,email = :email  WHERE id = :id";
                $stmt = $conn->get_conn()->prepare($sql);
                $stmt->bindValue(':user',"".$this->getUsername()."");
                $stmt->bindValue(':pass',"".$this->getPass()."");   
                $stmt->bindValue(':email',"".$this->getEmail()."");
                $stmt->bindValue(':id',"".$id."");  
                $stmt->execute();
            } catch(PDOException $ex) {
                return $ex->getMessage();
            } 
        }

        //Função que valida se usuário existe na plataforma, utilizado tanto no login quanto no cadastro de um novo usuário
        public function exists($email) {
            try {
                $conn = new Connect();
                $sql = 'SELECT * FROM users WHERE email LIKE :email';
                $stmt = $conn -> get_conn() -> prepare($sql);
                $stmt -> bindValue(':email', $email);
                $stmt -> execute();
                $result = $stmt -> fetchAll();
                if (count($result) == 1) {
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $ex) {
                return $ex -> getMessage();
            }
        }   

        // Função que valida se usuário pode ou não ser logado no sistema, recebe este nome porque também valida se o mesmo está logado.
        public function isLogged($email,$pass) {
            try{
                if($this->exists($email)) {
                    $conn = new Connect();
                    $sql = 'SELECT * FROM users WHERE email LIKE :email and password LIKE :pass';
                    $stmt = $conn->get_conn()->prepare($sql);
                    $stmt->bindValue(':email',$email);
                    $stmt->bindValue(':pass',md5($pass));
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    if($stmt->rowCount() == 1) {

                        $this->setUsername($result[0]['username']);
                        $this->setPass($result[0]['password']);
                        $this->setEmail($result[0]['email']);
                        $this->setTel($result[0]['tel']);
                        $this->setRole($result[0]['role_id']);

                        $this->_userInfos = array(
                        'id' => $result[0]['id'],
                        'username' => $this->getUserName(),
                        'pass' => $this->getPass(),
                        'email' => $this->getEmail(),
                        'tel' => $this->getTel(),
                        'role' =>$this->getRole()
                        );    
                        
                        $this->_statusLogin=true;
                    } else {
                        $this->_statusLogin=false;
                    }

                    return $this->_statusLogin;
                }
            } catch (PDOException $ex) {
                return $ex -> getMessage();
            }
        }
    }

?>