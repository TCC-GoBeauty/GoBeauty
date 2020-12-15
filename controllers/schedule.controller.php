<?php
    namespace app_controllers;

    require_once './../gobeauty/models/Schedule.class.php';

    use app_models\Schedule;
    use Exception;
    use PDOException;

class ScheduleController{
        private $_schedule;
        
        public function __construct() {
            $this->_schedule = new Schedule();
        }

        public function addNewSchedule($service,$start_time,$creator) {
            try{
                $this->_schedule->setService($service);
                $this->_schedule->setStartTime($start_time);
                $this->_schedule->setCreator($creator);
                $this->_schedule->addSchedule($this->_schedule->getService(),$this->_schedule->getStartTime(),$this->_schedule->getCreator());
                alertMessage('Horário marcado com sucesso!');
                unset($this->_schedule);
                redirect('page-user.php?module=today-user');
            } catch(PDOException $ex){
                return $ex->getMessage();
                unset($this->_schedule);
                redirect('page-user.php?module=create-schedule');
            } catch(Exception $commonEx) {
                return $commonEx->getMessage();
                unset($this->_schedule);
                redirect('page-user.php?module=create-schedule');
            }
        }

        public function listAllSchedules() {
            $arr = $this->_schedule->listAllSchedules();
            for($i = 0;$i<count($arr);$i++) {
                echo "<tr>
                    <td>".$arr[$i]['username']."</td>
                    <td>".$arr[$i]['service']."</td>
                    <td>".$arr[$i]['start_time']."</td>
                    <td>".$arr[$i]['finish_time']."</td>
                    <td>
                    <a href='?module=today&id=".$arr[$i]['id']."&delete=true' role='button' class='btn btn-sm'><i class='fas fa-trash-alt'></i>&nbsp;&nbsp;Deletar</a>
                    </td>
                </tr>";
            }
        }

        public function listAllSchedulesWithoutDelete() {
            $arr = $this->_schedule->listAllSchedules();
            for($i = 0;$i<count($arr);$i++) {
                echo "<tr>
                    <td>".$arr[$i]['username']."</td>
                    <td>".$arr[$i]['service']."</td>
                    <td>".$arr[$i]['start_time']."</td>
                    <td>".$arr[$i]['finish_time']."</td>
                </tr>";
            }
        }

        public function listSchedule($id) {
            $arr = $this->_schedule->listSchedule($id);
            for($i = 0;$i<count($arr);$i++) {
                echo "<tr>
                    <td>".$arr[$i]['service']."</td>
                    <td>".$arr[$i]['price']." R$</td>
                    <td>".$arr[$i]['start_time']."</td>
                    <td>".$arr[$i]['finish_time']."</td>
                    <td>
                    <a href=?module=today-user&id=".$arr[$i]['id']."&delete=true' role='button' class='btn btn-sm' disabled><i class='fas fa-trash-alt'></i>&nbsp;&nbsp;Deletar</a>
                    </td>
                </tr>";
            }
        }

        public function deleteSchedule($id) {
            $this->_schedule->deleteSchedule($id);
            alertMessage('Horário deletado com sucesso!');
        }
    }
?>