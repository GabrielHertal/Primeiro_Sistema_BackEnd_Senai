<?php
    class BancoDeDados 
    {
        //Atributos da Classe
        private $conexao;

        // Método 
        function __construct()
        {
            $this->$conexao = new PDO('mysql:host=localhost;dbname=db_exemplo;charset=utf8mb4', 'root', '');
        }
    }