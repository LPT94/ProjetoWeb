<?php
   namespace MODEL; 

   class ItemVenda{

        private ?int $id_venda;
        private ?int $id_produto;
        private ?float $qtde;
        private ?float $valor;

        public function __construct(){
        }

        public function getId_venda(){
            return $this->id_venda;
        }

        public function getId_produto(){
            return $this->id_produto;
        }

        public function getQtde(){
            return $this->qtde;
        }

        public function getValor(){
            return $this->valor;
        }
        public function setId_venda(int $id_venda){
            $this->id_venda = $id_venda;
        }

        public function setId_produto(int $id_produto){
            $this->id_produto = $id_produto;
        }

        public function setQtde(float $qtde){
            $this->qtde = $qtde;
        }

        public function setValor(float $valor){
            $this->valor = $valor;
        }

   }

?>