<?php
    session_start();
    require_once('funcoes/login.php');
    require_once('bd/conexao.php');
    $conexao = conexaoMysql();

    $botao = 'Salvar';
    $categoria = '';
    
    
    /*Ação para excluir ou carregar os valores para a edição*/
    if(isset($_GET['modo']))
    {
        if($_GET['modo'] == 'excluir')
        {
            $sql ="delete from tbl_categoria where id_categoria=".$_GET['codigo'];
            echo($sql);
            mysqli_query($conexao, $sql);
//            header('location:cadastro_categoria.php');

        }elseif($_GET['modo'] == 'editar')
        {
            $sql="select * from tbl_categoria where id_categoria=".$_GET['codigo'];
            $select=mysqli_query($conexao, $sql);
            if($rs= mysqli_fetch_array($select))
            {
                $categoria = $rs['categoria'];
                $botao = "Editar";

                $_SESSION['id'] = $_GET['codigo'];
            } 
        }
    }
    




    /*Ação de mudar status da categoria
    de ativo para 0 ou 1*/
    if(isset($_GET['status'])){
        $codigo = $_GET['codigo'];
        $mudar  = $_GET['status'];
        
        if($mudar == 1){
            $sql="update tbl_categoria set ativo = 0 where id_categoria = ".$codigo;
            if(mysqli_query($conexao, $sql))
            {
                echo("<script>window.location.href='cadastro_categoria.php'</script>");
            }
        }
        else
        {
            $sql="update tbl_categoria set ativo = 1 where id_categoria = ".$codigo;
            if(mysqli_query($conexao, $sql))
            {
                
            }
        }
    }


    /*Ação de salvar ou editar uma categoria*/
    if(isset($_POST['btnSalvar']))
    {
        $categoria = $_POST['txtnomecategoria'];
        
        if($_POST['btnSalvar'] == 'Salvar')
        {
            $sql = "insert into tbl_categoria (categoria) values ('".$categoria."')";
            echo($sql);
            mysqli_query($conexao, $sql);
        }
        else if($_POST['btnSalvar']=="Editar")
        {
            $sql="update tbl_categoria set categoria='".addslashes($categoria)."'
                where id_categoria = ".$_SESSION['id'];
            mysqli_query($conexao, $sql);
        }
        header("location:cadastro_categoria.php");
    }


?>
<!doctype html>
<html lang="pt-br">
	<head>
        <title>
            Cms- Cadastro de categoria
        </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        
        <div id="tamanho_centralizar" class="center">
            <div id="cms">
                <form id="frmcategoria" name="frmcategoria" method="post" action="cadastro_categoria.php">
                    <table>
                        <tr>
                            <td>Categoria:</td>
                            <td>
                                <input type="text" required name="txtnomecategoria" value="<?php echo($categoria)?>">
                            </td>
                        </tr> 
                        <tr>
                            <td>
                                <input type="submit" value="<?php echo ($botao); ?>" id="btnSalvar" name="btnSalvar">
                            </td>
                        </tr>
                    </table>
                </form>
                <table>
                    <?php
                        $sql="select * from tbl_categoria";
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
                        <td> <?php echo($rs['id_categoria']) ?></td>
                        <td><?php echo($rs['categoria'])?></td>
                        <td>
                            <a href="cadastro_categoria.php?modo=excluir&codigo=<?php echo($rs['id_categoria'])?>"  onclick="return confirm('Deseja realmente excluir');">
                                <img alt="excluir" src='imagens/icones/deletar.png'>
                            </a>
                            
                            <a href="cadastro_categoria.php?modo=editar&codigo=<?php echo($rs['id_categoria'])?>">
                                <img src="imagens/icones/edit.png" alt="editar">
                            </a>
                            
                            <a href="cadastro_categoria.php?status=<?php echo ($rs['ativo']);?>&codigo=<?php echo($rs['id_categoria'])?>">
                                <img src="../imagens/icones/<?php echo($icone) ?>">
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </body>
</html>