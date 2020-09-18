<?php 
    session_start();
    require_once('funcoes/login.php');

    $botao = "Salvar";
    $nivel = null;
    require_once('bd/conexao.php');
    $conexao = conexaoMysql();
    if(isset($_GET['modo']))
    {
        if($_GET['modo'] == 'excluir')
        {
            $sql ="delete from tbl_nivel_usuario where id=".$_GET['codigo'];
            mysqli_query($conexao, $sql);
            header('location:cadastro_nivel.php');
        
        }elseif($_GET['modo'] == 'editar')
        {
            $sql="select * from tbl_nivel_usuario where id=".$_GET['codigo'];
            $select=mysqli_query($conexao, $sql);
            if($rs= mysqli_fetch_array($select))
            {
                $nivel = $rs['nivel'];
                $botao = "Editar";

                $_SESSION['id'] = $_GET['codigo'];
            } 
        }
    }

    if(isset($_GET['status'])){
        $codigo = $_GET['codigo'];
        $mudar  = $_GET['status'];
        
        if($mudar == 1){
            $sql="update tbl_nivel_usuario set ativo = 0 where id = ".$codigo;
            if(mysqli_query($conexao, $sql))
            {
                echo("<script>window.location.href='cadastro_nivel.php'</script>");
            }
        }
        else
        {
            $sql="update tbl_nivel_usuario set ativo = 1 where id = ".$codigo;
            if(mysqli_query($conexao, $sql))
            {
                
            }
        }
    }


    if(isset($_POST['btnSalvar']))
    {
        $nivel = $_POST['txtnivel'];
        
        if($_POST['btnSalvar']=='Salvar')
            {
                $sql = "insert into tbl_nivel_usuario (nivel) values ('".addslashes($nivel)."')";   
                echo($sql);
                mysqli_query($conexao, $sql);
            }
        elseif($_POST['btnSalvar']=="Editar")
            {
                $sql="update tbl_nivel_usuario set nivel='".addslashes($nivel)."'
                    where id = ".$_SESSION['id'];
                
                if(mysqli_query($conexao, $sql))
                {  
                }
            }    
            header("location:cadastro_nivel.php");
    }
?>



<html lang="pt-br">
	<head>
        <title>
            Cadastro de níveis
        </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <style>
            #gerenciar_sobre img{
               width: 100px;
                height: 100px;
               }  
        </style> 
                 
               
        
    </head>
    <body>
        <div id='tamanho_centralizar' class='center'>
            <div id="cms" class="center">
                <div id='cadastros'>
                        <a href="index.php">
                            <img alt='voltar' title='voltar' src="imagens/icones/return.png">
                        </a>
                        <h1>Cadastro de users</h1>
                    <form id="frmCadastro" name="frmCadastro" method="post" action="cadastro_nivel.php" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td>
                                    <span>Nivel</span>
                                </td>
                                <td>
                                    <input type="text" name="txtnivel" value="<?php echo($nivel)?>"> 
                                </td>
                            </tr>
                            <tr>
                                <td><input type="submit" value="<?php echo ($botao); ?>" id="btnSalvar" name="btnSalvar"></td>
                            </tr>
                        </table>
                    </form>
                </div>
                    <div id='visu' class='center'>
                        <table> 
                            <tr>
                                <th>Codigo</th>
                                <th>Nivel</th>
                                <th>Opções</th>
                            </tr>
                            
                    <?php
                        $sql="select * from tbl_nivel_usuario";
                        $select = mysqli_query($conexao, $sql);
                    
                        while($rs=mysqli_fetch_array($select))
                        {
                            if($rs['ativo']== 0){
                                $icone = "check1.png";
                            }else{
                                $icone = "check.png";
                            }    
                    ?>
                    <tr> 
                        <td>
                            <?php echo($rs["id"]);?>
                        </td>
                        <td>
                            <?php echo($rs["nivel"]);?>
                        </td>
                        <td>
                            <a href="cadastro_nivel.php?modo=excluir&codigo=<?php echo($rs['id'])?>"  onclick="return confirm('Deseja realmente excluir');"><img alt="excluir" src='imagens/icones/deletar.png'></a>
                            <a href="cadastro_nivel.php?modo=editar&codigo=<?php echo($rs['id'])?>"><img src="imagens/icones/edit.png" alt="editar"></a>
                            <a href="cadastro_nivel.php?status=<?php echo ($rs['ativo']); ?>&codigo=<?php echo($rs['id'])?>"><img src="../imagens/icones/<?php echo($icone) ?>"></a>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
            </table>
                    </div>
                    
            </div>
        </div>
    </body>
</html>
