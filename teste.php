<?php

    require_once './../gobeauty/models/Schedule.class.php';
    use app_models\Schedule;

    $time = new Schedule();

    var_dump($time->getFinishTime(5,'2020-12-13 19:30:00'));
?>