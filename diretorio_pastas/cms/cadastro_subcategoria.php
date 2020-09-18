<?php
    session_start();
    require_once('funcoes/login.php');
    require_once('bd/conexao.php');
    $conexao = conexaoMysql();

    $botao = 'Salvar';
    $subcategoria = '';
    $id_categoria = 0;
    $categoria = "";
    
    
    /*Ação para excluir ou carregar os valores para a edição*/
    if(isset($_GET['modo']))
    {
        if($_GET['modo'] == 'excluir')
        {
            $sql ="delete from tbl_subcategoria where id_subcategoria=".$_GET['codigo'];
            mysqli_query($conexao, $sql);
            header('location:cadastro_subcategoria.php');

        }elseif($_GET['modo'] == 'editar')
        {
            $sql="select tbl_subcategoria.*, tbl_categoria.categoria
                    from tbl_categoria
                    join tbl_subcategoria
                    on tbl_categoria.id_categoria = tbl_subcategoria.id_categoria
                    where id_subcategoria=".$_GET['codigo'];
            $select=mysqli_query($conexao, $sql);
            if($rs= mysqli_fetch_array($select))
            {
                $id_categoria = $rs['id_categoria'];
                $subcategoria = $rs['subcategoria'];
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
            $sql="update tbl_subcategoria set ativo = 0 where id_subcategoria = ".$codigo;
            if(mysqli_query($conexao, $sql))
            {
                echo("<script>window.location.href='cadastro_subcategoria.php'</script>");
            }
        }
        else
        {
            $sql="update tbl_subcategoria set ativo = 1 where id_subcategoria = ".$codigo;
            if(mysqli_query($conexao, $sql))
            {
                echo("<script>window.location.href='cadastro_subcategoria.php'</script>");
            }
        }
    }


    /*Ação de salvar ou editar uma categoria*/
    if(isset($_POST['btnSalvar']))
    {
        $subcategoria = $_POST['txtnomesubcategoria'];
        $categoria = $_POST['slt_categoria'];
        
        if($_POST['btnSalvar'] == 'Salvar')
        {
            $sql = "insert into tbl_subcategoria (subcategoria, id_categoria) values ('".$subcategoria."', ".$categoria.")";
            echo($sql);
            mysqli_query($conexao, $sql);
        }
        else if($_POST['btnSalvar']=="Editar")
        {
            $sql="update tbl_subcategoria set subcategoria='".$subcategoria."',id_categoria=".$categoria."
                where id_subcategoria = ".$_SESSION['id'];
                        echo($sql);

            mysqli_query($conexao, $sql);
        }
        header("location:cadastro_subcategoria.php");
    }


?>
<!doctype html>
<html lang="pt-br">
	<head>
        <title>
            Cms- Cadastro de Subcategoria
        </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        
        <div id="tamanho_centralizar" class="center">
            <div id="cms">
                <form id="frmsubcategoria" name="frmsubcategoria" method="post" action="cadastro_subcategoria.php">
                    <table>
                        <tr>
                            <td>Subcategoria:</td>
                            <td>
                                <input type="text" required name="txtnomesubcategoria" value="<?php echo($subcategoria)?>">
                            </td>
                        </tr> 
                        
                        <tr>
                                <td><span>Categoria</span></td>
                                <td> <select required name="slt_categoria">  
                                       <?php
                                            if($botao == 'Editar'){             
                                       ?>
                                        <option value="<?php echo($id_categoria);?>" selected><?php echo($categoria);?></option>
                                       <?php 
                                           }else{ 
                                       ?>
                                        <option value="" selected hidden>Selecione uma categoria</option>
                                        <?php 
                                           } 

                                        $sql = 'select  * from tbl_categoria where ativo = 1 and id_categoria <>'.$id_categoria;
                                        $select = mysqli_query($conexao, $sql);

                                        while($rs=mysqli_fetch_array($select)){
                                       ?>
                                        <option value='<?php echo($rs['id_categoria'])?>'><?php echo($rs['categoria'])?> </option>
                                        <?php } ?>
                                   </select>
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
                        $sql="select tbl_subcategoria.*, tbl_categoria.categoria from tbl_subcategoria join tbl_categoria on tbl_categoria.id_categoria = tbl_subcategoria.id_categoria";
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
                        <td> <?php echo($rs['id_subcategoria']) ?></td>
                        <td><?php echo($rs['subcategoria'])?></td>
                        <td><?php echo($rs['categoria'])?></td>
                        <td>
                            <a href="cadastro_subcategoria.php?modo=excluir&codigo=<?php echo($rs['id_subcategoria'])?>"  onclick="return confirm('Deseja realmente excluir');">
                                <img alt="excluir" src='imagens/icones/deletar.png'>
                            </a>
                            
                            <a href="cadastro_subcategoria.php?modo=editar&codigo=<?php echo($rs['id_subcategoria'])?>">
                                <img src="imagens/icones/edit.png" alt="editar">
                            </a>
                            
                            <a href="cadastro_subcategoria.php?status=<?php echo ($rs['ativo']);?>&codigo=<?php echo($rs['id_subcategoria'])?>">
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