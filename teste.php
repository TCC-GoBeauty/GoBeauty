<?php

    require_once './../gobeauty/models/Schedule.class.php';
    use app_models\Schedule;

    $time = new Schedule();

    var_dump($time->addSchedule(6,'2020-11-13 16:30:00',18));
?>