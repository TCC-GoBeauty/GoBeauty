<?php

    //Atribui um namespace a classe para facilitar na hora da instância
    namespace app_models;


    //define um nome a classe que futuramente será um objeto
    class Product {
        //faltam criar alguns atributos
        private $_name;
        private $_description;
        private $_min_storage;
        private $_max_storage;
        private $_price;
        
        //constrói o objeto com os atributos com valor zerado
        public function __construct() {
            $this->_name = "";
            $this->_description = "";
            $this->_min_storage = 0;
            $this->_max_storage = 0;
            $this->_price = 0.00;
        }

        //getters and setters dos atributos
        public function setName($name) {
            $this->_name = $name;
        }

        public function getName() {
            return $this->_name;
        }

        public function setDescription($description) {
            $this->_description = $description;
        }

        public function getDescription() {
            return $this->_description;
        }

        public function setPrice($price) {
            $this->_price = $price;
        }

        public function getPrice() {
            return $this->_price;
        }

        //função para validar funcionamento da classe
        public function returnProduct() {
            echo "the product with name $this->_name and price $this->_price was successfull created";
        }
    }
?>