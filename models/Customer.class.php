<?php

    namespace app_models;
    require_once 'User.class.php';

    class Customer extends User{
        public function __construct() {
            $this->setRole(3);
        }
    }