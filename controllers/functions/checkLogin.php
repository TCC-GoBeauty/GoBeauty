<?php
    if(!isset($_SESSION))
        session_start();
    if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false){
        unset($_SESSION);
        session_destroy();
        header('Location:./../../GoBeauty/index.php');
    }
        
?>