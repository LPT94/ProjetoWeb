<?php

    namespace MODEL;

    class Produto{
        
        private ?int $id;
        private ?int $id_categoria;
        private ?string $nome;
        private ?string $descricao;
        private ?float $preco;
        private ?float $qtde_estoque;
        private ?string $fabricante;

        public function __construct(){
        }

        public function getId(){
            return $this->id;
        }

        public function getId_categoria(){
            return $this->id_categoria;
        }

        public function getNome(){
            return $this->nome;
        }

        public function getDescricao(){
            return $this->descricao;
        }

        public function getPreco(){
            return $this->preco;
        }

        public function getQtde_estoque(){
            return $this->qtde_estoque;
        }
        
        public function getFabricante(){
            return $this->fabricante;
        }

        public function setId(int $id){
            $this->id = $id;
        }

        public function setId_categoria(int $id_categoria){
            $this->id_categoria = $id_categoria;
        }

        public function setNome(string $nome){
            $this->nome = $nome;
        }

        public function setDescricao(string $descricao){
            $this->descricao = $descricao;
        }

        public function setPreco(float $preco){
            $this->preco = $preco;
        }

        public function setQtde_estoque(float $qtde_estoque){
            $this->qtde_estoque = $qtde_estoque;
        }

        public function setFabricante(string $fabricante){
            $this->fabricante = $fabricante;
        }
    }

?>