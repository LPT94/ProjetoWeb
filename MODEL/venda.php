<?php
   namespace MODEL; 

   class Venda{

        private ?int $id;
        private ?float $valor;
        private ?string $data_venda;

        public function __construct(){
        }

        public function getId(){
            return $this->id;
        }

        public function getValor(){
            return $this->valor;
        }

        public function getData_venda(){
            return $this->data_venda;
        }

        public function setId(int $id){
            $this->id = $id;
        }

        public function setValor(float $valor){
            $this->valor = $valor;
        }

        public function setData_venda(string $data_venda){
            $this->data_venda = $data_venda;
        }

   }

?>