<?php

    namespace MODEL;

    class Usuario{
        private ?string $login;
        private ?string $senha;
        private ?string $tipo;

        public function __construct(){
        }

        public function getLogin(){
            return $this->login;
        }

        public function getSenha(){
            return $this->senha;
        }

        public function getTipo(){
            return $this->tipo;
        }

        public function setLogin(string $login){
            $this->login = $login;
        }

        public function setSenha(string $senha){
            $this->senha = $senha;
        }

        public function setTipo(string $tipo){
            $this->tipo = $tipo;
        }

    }
?>