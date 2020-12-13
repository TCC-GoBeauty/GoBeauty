<?php
    function alertMessage($msg) {
        echo "
            <script language = 'javascript'>
                alert('$msg');
            </script>
        ";
    }

    function redirect($page) {
        echo "<script>window.location.href = './../../../gobeauty/$page';</script>";
    }

    function salute(){
        setDefaultTimezone();
        $hour = date('H:m:s');
        if($hour <= 12) {
            echo 'Bom dia, ';
        } else if($hour >= 13 && $hour <= 18) {
            echo 'Boa tarde, ';
        } else {
            echo 'Boa noite, ';
        }
    }

    function setDefaultTimezone() {
        date_default_timezone_set('America/Sao_Paulo');
    }
?>