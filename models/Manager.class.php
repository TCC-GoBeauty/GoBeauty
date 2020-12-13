<?php

    namespace app_models;
    require_once 'User.class.php';

    class Manager extends User {
        public function __construct() {
            $this->Role = 2;
        }
    }
