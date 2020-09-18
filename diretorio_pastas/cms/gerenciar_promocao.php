<?php

session_start();
require_once('funcoes/login.php');
require_once('bd/conexao.php');
$conexao = conexaoMysql();



$botao = "Salvar";
$porcentagem_promocao = null;


if(isset($_GET['modo']) ){
	$codigo = $_GET['id'];
	
	if($_GET['modo'] == "excluir"){
		
	   $sql = "delete from tbl_promocao where id =".$codigo;
	   if(mysqli_query($conexao, $sql)){
		   if(mysqli_query($conexao, $sql)){
				header('location:gerenciar_promocao.php');   
			}
		}
	}		
					
	if($_GET['modo'] == "editar"){
			
		$_SESSION['id'] = $codigo;
		$botao = "Editar";
   
		$sql = "select tbl_promocao.id as cod_promo, tbl_filme.id as cod_filme, promocao, nome_filme from tbl_promocao join tbl_filme 
		on id_filme = tbl_filme.id where tbl_promocao.id= ".$codigo;
		   
		   
		   
		   $select = mysqli_query($conexao, $sql);

		    if($rs=mysqli_fetch_array($select)){
				$porcentagem_promocao = $rs['promocao'];
				$codigo_filme_promocao = $rs['cod_filme'];
				$codigo_promocao_filme = $rs['cod_promo'];
				$nome_filme_promocao = $rs['nome_filme'];
			}
		}
}

// area que faz o processo de ativar e desativar um registro
if(isset($_GET['mudar']) ){
	$codigo = $_GET['id'];
	$mudar = $_GET['mudar'];
	$filme = $_GET['filme'];
    
    if($mudar == 1)
    {
		$sql = "update tbl_promocao set ativo = 0 where id =".$codigo;
        if(mysqli_query($conexao, $sql))
        {
			header('location:gerenciar_promocao.php');
		}
		
	}else{
		$sql = "update tbl_promocao set ativo = 1 where id =".$codigo;
        if(mysqli_query($conexao, $sql))
        {
            $sql = "update tbl_promocao set ativo = 0 where id <> ".$codigo." and id_filme =".$filme;
            if(mysqli_query($conexao, $sql))
            {
			 header('location:gerenciar_promocao.php');
            }
        }
	}

    
}

if(isset($_POST['btnsalvar'])){
	$codigo = $_POST['slt_filme'];
	$porcentagem_promocao = $_POST['porcentagem'];
	
// area que faz o processo de envio do registro para o banco
	if($_POST['btnsalvar'] == "Salvar"){
		
		$sql = "insert into tbl_promocao (promocao, id_filme)
				VALUES(".$porcentagem_promocao.",".$codigo.")";
                
		if(mysqli_query($conexao, $sql)){
            
			echo("<script>alert('Nova promoção adicionada com Sucesso'); window.location.replace('gerenciar_promocao.php');</script>");   
		}
	}
  
// area que faz o processo de edição do registro no banco
    if($_POST['btnsalvar'] == "Editar"){
        
        $sql = "update tbl_promocao set promocao = ".$porcentagem_promocao." where id=".$_SESSION['id'];
        
		if(mysqli_query($conexao, $sql)){
			echo("<script>alert('Promoção atualizada com Sucesso'); window.location.replace('gerenciar_promocao.php');</script>");   
		}
	}
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Gerenciamento das Promoções</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id='tamanho_centralizar' class='center'>
            <div id="cms" class="center">
               
                    <div id='cadastros'>
                        <a href="index.php">
                            <img alt='voltar' title='voltar' src="imagens/icones/return.png">
                        </a>
                        <h1>Cadastro de promoções</h1>
        <form id="frmCadastro" name="frmCadastro" method="post" action="gerenciar_promocao.php"> 
            <table>
                <tr>
                    <td>Filme:</td>
                    <td><select required name="slt_filme">
                    <?php
                        if($botao == 'Editar'){
                    ?>
                    <option value="<?php echo($codigo_promocao_filme);?>" selected><?php echo("Promoção ".$codigo_promocao_filme.": ".$nome_filme_promocao);?></option>
                    <?php 
                        }else{
                    ?>
                        <option value="" selected hidden>Selecione um filme</option>
                    <?php
                        }
                    
                        $sql = "select id,nome_filme from tbl_filme where ativo = 1";
                        
                        //guarda o retorno do banco de dados
                        $select = mysqli_query($conexao, $sql);
                        
                        //mysql_fetch_array transforma uma lista de retorno do banco de dados em uma matriz
                        while($rsfilmes=mysqli_fetch_array($select)){
                            
                    ?>
                        <option value="<?php echo($rsfilmes['id'])?>"><?php echo($rsfilmes['nome_filme'])?></option>
                    <?php
                        }
                    ?>
                </select></td>
                </tr>
                <tr>
                    <td>Promoção:</td>
                    <td> 
                        <input required type="number"  id="porcentagem" name="porcentagem" 
            value="<?php echo($porcentagem_promocao)?>">
                    </td>
                </tr>
                <tr>
                    <td><input  name="btnsalvar" type="submit" value="<?php echo($botao)?>"/></td>
                </tr>
            </table>
                
            
            
            
        </form>
        <div id='scroll_tabela'>
             <table>
        <?php
            $sql = "select tbl_promocao.*, nome_filme ,img_filme 
                    FROM tbl_promocao
                    join tbl_filme on id_filme = tbl_filme.id";
    
            //guarda o retorno do banco de dados
            $select = mysqli_query($conexao, $sql);
            
            //mysql_fetch_array transforma uma lista de retorno do banco de dados em uma matriz
            while($rs=mysqli_fetch_array($select)){
                
            if ($rs['ativo'] == 1){
                $check = "check.png";
            }else{
                $check = "check1.png";
            }
            
        ?>
        
            <tr>
                <td>
                    <img src="../imagens/<?php echo($rs['img_filme'])?>">
                </td>
                <td>
                    <span>Promoção: <?php echo($rs['id'])?>   </span>
                </td>
                <td>
                   &nbsp Filme: <?php echo($rs['nome_filme'])?>
                </td>
                <td>
                &nbsp Promoção: <?php echo($rs['promocao']."%")?>
                </td>
                <td>
                <a href="gerenciar_promocao.php?modo=editar&id=<?php echo($rs['id'])?>">
                    Editar
                </a>

                <a href="gerenciar_promocao.php?modo=excluir&
                        id=<?php echo($rs['id'])?>" onclick="return confirm('Deseja realmente excluir');">
                        excluir
                </a>

                <a href="gerenciar_promocao.php?mudar=<?php echo($rs['ativo']);?>&filme=<?php echo($rs['id_filme'])?>&id=<?php echo($rs['id'])?>">
                    <img  src="../imagens/icones/<?php echo($check)?>"/>
                </a>
                </td>
            </tr>            
                   
        
        
        
        <?php }?>
              </table>   
            </div>
                </div></div></div>
    </body>
</html>