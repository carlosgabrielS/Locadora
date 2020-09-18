<?php 

    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
    

    function conexaoMysql()
    {
        $conexao = null;//CONEXÃO COMEÇA NULA

        $server = "localhost"; //SERVIDOR DO BANCO
        $user = "root";         //USUARIO DE LOGIN DO BANCO
        $password = "bcd127";   //SENHA DO BANCO
        $database = "db_locadora"; //BANCO SELECIONADO

        $conexao = mysqli_connect($server,$user,$password,$database); //CONEXÃO EM SI

        return $conexao; //RETORNO DESSA CONEXÃO
    }

//    function conexaoMysql()
//        {
//            $conexao = null;//CONEXÃO COMEÇA NULA
//
//            $server = "192.168.0.2"; //SERVIDOR DO BANCO
//            $user = "pc2820191";         //USUARIO DE LOGIN DO BANCO
//            $password = "senai127";   //SENHA DO BANCO
//            $database = "dbpc2820191"; //BANCO SELECIONADO
//
//            $conexao = mysqli_connect($server,$user,$password,$database); //CONEXÃO EM SI
//
//            return $conexao; //RETORNO DESSA CONEXÃO
//        }



?>