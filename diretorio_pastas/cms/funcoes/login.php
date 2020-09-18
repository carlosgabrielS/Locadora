<?php

    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);

/* verificação se o login pode ser efetuado*/
if(!isset($_SESSION['login'])){
	header('location:../index.php');

}

/* verificação se o logout pode ser efetuado*/
if(isset($_GET['login'])){
	if($_GET['login'] == 'logout'){
		
		session_destroy();
		header('location:../');
	}
}
?>