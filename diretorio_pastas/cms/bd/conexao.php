<?php 

    function conexaoMysql(){
        /*mysqli()  -  biblioteca de conexão com BD mysql,
        vigente as versões atuais

        
        /* Variável que vai receber a conexão do bd*/
        $conexao = null;

        /* Variável ára estabelecer a conexao com o bd*/
        $server = "localhost";
        $user = "root";
        $password = "bcd127";
        $database = "db_locadora";

        $conexao = mysqli_connect($server,$user,$password,$database);
        
        return $conexao;
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