<?php

    namespace app_models;

    class Service {
        private $_name;
        private $_price;
        private $_max_time;

        public function __construct() {
            $this->_name = "";
            $this->_price = 0.00;
            $this->_max_time = "00:00";
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

       public function returnService() {
           echo "Hello, I am a service and my name is $this->_name, my price is $this->_price and my time of execution is $this->_max_time";
       }
    }
?>