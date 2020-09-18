<?php

$botao = "Salvar";
require_once('bd/conexao.php');
$conexao = conexaoMysql();

if(isset($_GET['modo']))
    {
        if($_GET['modo'] == 'excluir')
        {
            $sql ="delete from tbl_usuario where id=".$_GET['codigo'];
            mysqli_query($conexao, $sql);
            
        
        }
    }

if(isset($_GET['status'])){
        $codigo = $_GET['codigo'];
        $mudar  = $_GET['status'];
        
        if($mudar == 1){
            $sql="update tbl_usuario set ativo = 0 where id = ".$codigo;
            if(mysqli_query($conexao, $sql))
            {
                echo("<script>window.location.href='index.php'</script>");
            }
        }
        else
        {
            $sql="update tbl_usuario set ativo = 1 where id = ".$codigo;
            if(mysqli_query($conexao, $sql))
            {
                // AJUDAAAAAAAAAAAAAAAAAAA
                // header('location:index.php');
            }
        }
    }


?>
<div id='administ_usuarios'>
		<div class='align_direita'>
				<a href="cadastro_usuario.php"><img alt="Novo user" title="Novo user" src='imagens/icones/novo_user.png'></a>
			<a href="cadastro_nivel.php"><img alt="cadastro de level" title="cadastro de level" src='imagens/icones/level.png'></a>
		</div>
	
    <table >
        <tr>
            <th>Codigo</th>
            <th>Usuario</th>
            <th>Nivel</th>
            <th>Opções</th>
        </tr>
<?php
         
    $sql ="select tbl_usuario.id, tbl_usuario.ativo, tbl_usuario.usuario, tbl_nivel_usuario.nivel as nivel_usuario from tbl_usuario join tbl_nivel_usuario on tbl_usuario.nivel = tbl_nivel_usuario.id;";
    $select = mysqli_query($conexao, $sql);

    while($rsusers=mysqli_fetch_array($select))
        {
        
        if($rsusers['ativo']== 0)
        {
            $icone = "check1.png";
        }else
        {
            $icone = "check.png";
        } 
                
?>
    
        
        <tr>
            <td><?php echo($rsusers['id']);?></td>
            <td><?php echo($rsusers['usuario']);?></td>
            <td><?php echo($rsusers['nivel_usuario']);?></td>

            <td><a href="index.php?modo=excluir&codigo=<?php echo($rsusers['id']);?>" onclick="return confirm('Deseja realmente excluir');">
                 <img alt="excluir" src='imagens/icones/deletar.png'> 
                
            </a>  
            <a href="cadastro_usuario.php?modo=editar&codigo=<?php echo($rsusers['id']);?>">  
                 <img src="imagens/icones/edit.png" alt="editar"> 
                
            </a>
            <a href="index.php?status=<?php echo ($rsusers['ativo']); ?>&codigo=<?php echo($rsusers['id'])?>">
                <img src="../imagens/icones/<?php echo($icone) ?>">
            </a>
            </td>
        <tr>
       <?php  }?>
    </table>
</div>