<?php

    namespace app_models;
    require_once 'Conn.class.php';
    use PDOException;
    use PDORow; 
    use app_models\Connect;

    class Service {
        private $_name;
        private $_price;
        private $_max_time;
        private $_service_infos;

        public function __construct() {
            $this->_name = "";
            $this->_price = 0.00;
            $this->_max_time = "00:00";
            $this->_service_infos = [];
       }

       public function setName($name) {
            $this->_name = $name;
       }

       public function getName() {
           return $this->_name;
       }

       public function setPrice($price) {
           $this->_price = $price;
       }

       public function getPrice() {
           return $this->_price;
       }

       public function setMaxTime($max_time) {
           $this->_max_time = $max_time;
       }

       public function getMaxTime() {
           return $this->_max_time;
       }

       public function getServiceInfos($id) {
            $conn = new Connect();
            try{
                $sql = "SELECT * FROM service WHERE id = :id";
                $stmt = $conn->get_conn()->prepare($sql);
                $stmt->bindValue(':id',$id);
                $stmt->execute();
                $result = $stmt->fetchAll();
                $this->_service_infos = array(
                    'id' => $result[0]['id'],
                    'name' => $result[0]['name'],
                    'price' => $result[0]['price'],
                    'max_time' => $result[0]['max_time']
                );
                return $this->_service_infos;
            } catch (PDOException $ex) {
                return $ex -> getMessage();
            }
       }

       public function getAllServices() {
            $conn = new Connect();
            try{
                $sql = "SELECT * FROM service";
                $stmt = $conn->get_conn()->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
            } catch (PDOException $ex) {
                return $ex -> getMessage();
            }
       }

       public function createService($name,$price,$time) {
           $conn = new Connect();
           try{
                $sql = "INSERT INTO service(name,price,max_time) VALUES (:name,:price,:max_time)";
                $stmt = $conn->get_conn()->prepare($sql);
                $stmt->bindValue(':name',$name);
                $stmt->bindValue(':price',$price);
                $stmt->bindValue(':max_time',$time);
                $stmt->execute();
            } catch (PDOException $ex) {
                return $ex->getMessage();
            }
       }

       public function updateService($id,$name,$price,$time) {
           $conn = new Connect();
           try{
               $sql = "UPDATE service SET name = :name, price = :price, max_time = :time WHERE id = :id";
               $stmt = $conn->get_conn()->prepare($sql);
               $stmt-> bindValue(':name',$name);
               $stmt-> bindValue(':price',$price);
               $stmt-> bindValue(':time',$time);
               $stmt-> bindValue(':id',$id);
               $stmt-> execute();
           } catch (PDOException $ex) {
                return $ex->getMessage();
            }
       }

       public function serviceExists($id) {
            $conn = new Connect();
            try{
                $sql = "SELECT * FROM service WHERE id = :id";
                $stmt = $conn->get_conn()->prepare($sql);
                $stmt->bindValue(':id',$id);
                $stmt->execute();
                if($stmt->rowCount()>=1) {
                    return true;
                }
                return false;
                
            } catch (PDOException $ex) {
                return $ex->getMessage();
            }
       }

       public function deleteService($id) {
           $conn = new Connect();
           try{
               $sql = "DELETE FROM service WHERE id = :id";
               $stmt = $conn->get_conn()->prepare($sql);
               $stmt->bindValue(':id',$id);
               $stmt->execute();
               if(!$this->serviceExists($id)) {
                   return true;
               } 
               return false;
            } catch (PDOException $ex) {
                return $ex->getMessage();
            }
       }


       public function exists($name) {
        try {
            $conn = new Connect();
            $sql = "SELECT * FROM service WHERE name LIKE :name";
            $stmt = $conn -> get_conn() -> prepare($sql);
            $stmt -> bindValue(':name', $name);
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

       public function returnService() {
           echo "Hello, I am a service and my name is $this->_name, my price is $this->_price and my time of execution is $this->_max_time";
       }
    }
?>