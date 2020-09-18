<?php
session_start();
require_once('bd/conexao.php');
$conexao = conexaoMysql();

if(isset($_POST['btnlogin'])){
    $usuario = $_POST['txtusuario'];
    $senha = $_POST['txtsenha'];
    
// criptografia da senha
	$senha = md5($senha);
	
// listagem dos dados do usuario
	$sql = "select usuario, senha from tbl_usuario 
            where ativo = 1 and 
            usuario = '".$usuario."' and 
            senha = '".addslashes($senha)."'
			";
	echo($sql);
	$select = mysqli_query($conexao, $sql);

// armazenamento dos dados do usuario
	if($rs=mysqli_fetch_array($select)){
		$_SESSION['usuario'] = $rs['usuario'];
		$_SESSION['login'] = true;
        header('location:cms');
	}else{
// coreção caso haja algum erro na hora do login do usuario
		$page= basename($_SERVER['SCRIPT_FILENAME']);
			
		echo("<script>alert('Usuario ou Senha incorreto !!!');window.location.href='".$page."'</script>");
				
	}
}
?>

<!-- Cabeçalho de todas as páginas -->
<header id="cabecalho">
    <div class="center" id="cabecalho_central">
        <!-- navegação para a home -->
        <nav id='menu_mobile_header'>
            <ul id="menu_mobile_itens">
                <!-- navegação para a home -->
                <li >
                    <a href="index.php">HOME</a>
                </li>
                <!-- navegação para as promoções -->
                <li >
                    <a href="promocoes.php">PROMOÇÕES</a>
                </li>
                <li>
                     <!-- navegação para atores destaques -->
                    <a href="atores_destaques.php">ATORES EM DESTAQUE</a>
                </li>
                <li>
                    <!-- navegação para o filme do mês -->
                    <a href="filme_mes.php">FILME DO MÊS</a>
                </li>
                <li>
                    <!-- navegação para as nossas lojas -->
                    <a href="nossas_lojas.php">NOSSAS LOJAS</a>
                </li>
                <li>
                    <!-- navegação até sobre a locadora -->
                    <a href="sobre.php">SOBRE A LOCADORA</a>
                </li>
                <li>
                    <!-- navegação para o fale conosco -->
                    <a href="fale_conosco.php">FALE CONOSCO</a>
                </li>
            </ul>
        </nav>
        <a href="index.php">
            <div id="logo" class="center">
            </div>
        </a>
        <!--  menu  -->
        <nav>
            <!--Desktop
-->
            <ul id="menu">
                <!-- navegação para a home -->
                <li >
                    <a href="index.php">HOME</a>
                </li>
                <!-- navegação para as promoções -->
                <li >
                    <a href="promocoes.php">PROMOÇÕES</a>
                </li>
                <li class="menu_item">
                    <a href="#">EM ALTA</a>
                    <ul class="submenu">
                        <li>
                            <!-- navegação para atores destaques -->
                            <a href="atores_destaques.php">ATORES EM DESTAQUE</a>
                        </li>
                        <li>
                            <!-- navegação para o filme do mês -->
                            <a href="filme_mes.php">FILME DO MÊS</a>
                        </li>
                    </ul>
                </li>
                <li class="menu_item">
                    <a href="#">INSTITUCIONAL</a>
                    <ul class="submenu">
                        <!-- navegação para as nossas lojas -->
                        <li><a href="nossas_lojas.php">NOSSAS LOJAS</a></li>
                        <!-- navegação até sobre a locadora -->
                        <li><a href="sobre.php">SOBRE A LOCADORA</a></li>
                        <!-- navegação para o fale conosco -->
                        <li><a href="fale_conosco.php">FALE CONOSCO</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- area de login do usuário -->
        <form method="post"  action="#" name="frmlogin">
            <div id="autenticacao">
                <div class="usuario">
                    <span>Usuário</span><input type="text" name="txtusuario" required/>
                </div>
                <div class="usuario">
                    <span> Senha</span><input type="password" name="txtsenha" required/>
                </div>
                <input id ="btsalv" type='submit' name='btnlogin' value='Login'>
            </div>
        </form>
        <!-- redes sociais flutuantes -->
        <div id="redes">
            <figure class="redes_sociais">
                <img alt="facebook" src="imagens/fb.png">
                <figure class="rede_1">
                    <a href="#"><img alt="Facebook" src="./imagens/fb2.png"></a>
                </figure>
            </figure>
            <figure class="redes_sociais">
                <img alt="insta" src="imagens/insta.png">
                <figure class="rede_1">
                    <a href="#"><img alt="instagram" src="./imagens/insta2.png"></a>
                </figure>
            </figure>
            <figure class="redes_sociais">
                <img alt="tt" src="imagens/tt.png">
                <figure class="rede_1">
                    <a href="#"><img alt="twiter" src="./imagens/tt2.png"></a>
                </figure>
            </figure>
        </div>
    </div>
</header>
<!-- caixa para ocultar o espaço deixado pelo header fixo -->
<div style="height:50px"></div>
