<?php
    namespace app_models;

    require_once './../gobeauty/models/Conn.class.php';

    use app_models\Connect;
    use PDOException;

    class Schedule {
        private $_service;
        private $_start_time;
        private $_finish_Time;
        private $_creator;

        public function __construct() {
            $this->_service = 0;
            $this->_start_time = '00:00';
            $this->_finish_Time = '00:00';
            $this->_weekday = 0;
        }

        public function setService($service) {
            $this->_service = $service;
        }

        public function getService(){
            return $this->_service;
        }

        public function setStartTime($startTime) {
            $this->_start_time = $startTime;
        }

        public function getStartTime() {
            return $this->_start_time;
        }

        public function getFinishTime($id_service,$start_time) {
            $conn = new Connect();
            try {
                $sql = "SELECT ADDTIME('$start_time',max_time) AS finish_time FROM service WHERE id = :id";
                $stmt = $conn->get_conn()->prepare($sql);
                $stmt->bindValue(':id',$id_service);
                $stmt->execute();
                $result = $stmt -> fetchAll();
                return $result[0]['finish_time'];
            } catch(PDOException $ex) {
                return $ex->getMessage();
            }
        }

        public function setCreator($creator) {
            $this->_creator = $creator;
        }

        public function getCreator() {
            return $this->_creator;
        }

        public function addSchedule($service,$start_time,$creator) {
            $conn = new Connect();
            try {
                $sql = "INSERT INTO schedule_add(service_id,start_time,finish_time,user_id) VALUES (:service,:start_time,:finish_time,:creator)";
                $stmt = $conn->get_conn()->prepare($sql);
                $stmt-> bindValue(':service',$service);
                $stmt-> bindValue(':start_time',$start_time);
                $stmt-> bindValue(':finish_time',$this->getFinishTime($service,$start_time));
                $stmt-> bindValue(':creator',$creator);
                $stmt-> execute();
            } catch (PDOException $ex) {
                return $ex->getMessage();
            }
        }

        public function deleteSchedule($id) {
            $conn = new Connect();
            try {
                $sql = "DELETE FROM schedule_add WHERE id = :id";
                $stmt = $conn->get_conn()->prepare($sql);
                $stmt-> bindValue(':id',$id);
                $stmt-> execute();
            } catch (PDOException $ex) {
                return $ex->getMessage();
            }
        }

        public function listSchedule($user_id) {
            $conn = new Connect();
            try {
                $sql = "SELECT sc.id as id,DATE_FORMAT(sc.start_time,'%d/%m/%Y - %H:%i:%s') as start_time,DATE_FORMAT(sc.finish_time,'%d/%m/%Y - %H:%i:%s') as finish_time,service.name as service, service.price as price FROM schedule_add AS sc LEFT JOIN service ON service.id = sc.service_id WHERE user_id = :id";
                $stmt = $conn->get_conn()->prepare($sql);
                $stmt-> bindValue(':id',$user_id);
                $stmt-> execute();
                $result = $stmt->fetchAll();
                return $result;
            } catch (PDOException $ex) {
                return $ex->getMessage();
            }
        }

        public function listAllSchedules() {
            $conn = new Connect();
            try {
                $sql = "SELECT sc.id as id,DATE_FORMAT(sc.start_time,'%d/%m/%Y - %H:%i:%s') as start_time,DATE_FORMAT(sc.finish_time,'%d/%m/%Y - %H:%i:%s') as finish_time,users.username,service.name as service FROM schedule_add AS sc LEFT JOIN users ON users.id = sc.user_id LEFT JOIN service ON service.id = sc.service_id";
                $stmt = $conn->get_conn()->prepare($sql);
                $stmt-> execute();
                $result = $stmt->fetchAll();
                return $result;                
            } catch (PDOException $ex) {
                return $ex->getMessage();
            } 
        }
        
    }
?>