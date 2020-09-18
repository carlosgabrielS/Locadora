<?php 
    session_start();
    require_once('funcoes/login.php');

    $botao = "Salvar";
    require_once('bd/conexao.php');
    $conexao = conexaoMysql();
    if(isset($_GET['modo']))
    {
        if($_GET['modo'] == 'excluir')
        {
            $sql ="delete from tbl_produto_categoria where id_produto_categoria=".$_GET['codigo'];
            mysqli_query($conexao, $sql);
            header('location:cadastro_produto_categoria.php');
        
        }elseif($_GET['modo'] == 'editar')
        {
            $sql = 'select tbl_produto_categoria.*, tbl_categoria.id_categoria, tbl_produto.nome_produto, tbl_subcategoria.subcategoria,tbl_categoria.categoria from tbl_produto_categoria join tbl_produto on tbl_produto.id_produto = tbl_produto_categoria.id_produto join tbl_subcategoria on tbl_subcategoria.id_subcategoria = tbl_produto_categoria.id_subcategoria join tbl_categoria on tbl_categoria.id_categoria = tbl_subcategoria.id_categoria where id_produto_categoria ='.$_GET['codigo'];
            
            
//            $sql="select * from tbl_produto_categoria where id_produto_categoria=".$_GET['codigo'];
            $select=mysqli_query($conexao, $sql);
            if($rs= mysqli_fetch_array($select))
            {
                $id_produto = $rs['id_produto'];
                $id_categoria = $rs['id_categoria'];
                $id_subcategoria = $rs['id_subcategoria'];
                $produto = $rs['nome_produto'];
                $categoria = $rs['categoria'];
                $subcategoria = $rs['subcategoria'];
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
            $sql="update tbl_produto_categoria set ativo = 0 where id_produto_categoria = ".$codigo;
            if(mysqli_query($conexao, $sql))
            {
                echo("<script>window.location.href='cadastro_produto_categoria.php'</script>");
            }
        }
        else
        {
            $sql="update tbl_produto_categoria set ativo = 1 where id_produto_categoria = ".$codigo;
            if(mysqli_query($conexao, $sql))
            {
                echo("<script>window.location.href='cadastro_produto_categoria.php'</script>");
            }
        }
    }


    if(isset($_GET['status'])){
        $codigo = $_GET['codigo'];
        $mudar  = $_GET['status'];
        
        if($mudar == 1)
        {
            $sql="update tbl_produto_categoria set ativo = 0 where id = ".$codigo;
            if(mysqli_query($conexao, $sql))
            {
                echo("<script>window.location.href='cadastro_produto_categoria.php'</script>");
            }
        }
        else
        {
            $sql="update tbl_produto_categoria set ativo = 1 where id = ".$codigo;
            mysqli_query($conexao, $sql);
        }
    }

    if(isset($_POST['btnSalvar']))
    {
        $id_produto = $_POST['slt_produto'];
        $id_cat_subcat = $_POST['slt_categoria_subcategoria'];
        
        if($_POST['btnSalvar']=='Salvar')
            {
                $sql = "insert into tbl_produto_categoria (id_produto, id_subcategoria) values (".$id_produto.",".$id_cat_subcat.")";   
                echo($sql);
                mysqli_query($conexao, $sql);
            }
        elseif($_POST['btnSalvar']=="Editar")
            {
                $sql="update tbl_produto_categoria set 
                        id_produto=".$id_produto.",
                        id_subcategoria=".$id_cat_subcat ."
                        where id_produto_categoria = ".$_SESSION['id'];
                
                mysqli_query($conexao, $sql);
                
            }    
            header("location:cadastro_produto_categoria.php");
    }   
?>
<html lang="pt-br">
	<head>
        <title>
            Cadastro de Produto final
        </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">            
    </head>
    <body>
        <div id='tamanho_centralizar' class='center'>
            <div id="cms" class="center">
                <form id="frmCadastroUsuario" name="frmCadastroUsuario" method="post" action="cadastro_produto_categoria.php">
                    <table>
                        <tr>
                            <td>Produto</td>
                            <td> <select required name="slt_produto">  
                                    <?php
                                        if($botao == 'Editar'){             
                                   ?>
                                    <option value="<?php echo($id_produto);?>" selected><?php echo($produto);?></option>
                                   <?php 
                                       }else{ 
                                   ?>
                                    <option value="" selected hidden>Selecione um produto</option>
                                    <?php 
                                        }
                                    $sql = 'select * from tbl_produto where ativo = 1 and id_produto <>'.$id_produto; 
                                    $select = mysqli_query($conexao, $sql);

                                    while($rsproduto=mysqli_fetch_array($select)){
                                    ?>

                                    <option value='<?php echo($rsproduto['id_produto'])?>'> <?php echo($rsproduto['nome_produto'])?> </option>

                                    <?php } ?>
                               </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Categoria e subcategoria</td>
                            <td> <select required name="slt_categoria_subcategoria">  
                                    <?php
                                        if($botao == 'Editar'){             
                                   ?>
                                    <option value="<?php echo($id_subcategoria);?>" selected><?php echo($categoria.' de '. $subcategoria);?></option>
                                   <?php 
                                       }else{ 
                                   ?>
                                    <option value="" selected hidden>Selecione uma categoria e subcategoria</option>
                                    <?php 
                                        }
                                
                                    $sql = 'SELECT tbl_subcategoria.*, tbl_categoria.* 
                                                    from tbl_categoria 
                                                    join tbl_subcategoria
                                                    on   tbl_categoria.id_categoria = tbl_subcategoria.id_categoria
                                                    where tbl_subcategoria.ativo = 1 and id_subcategoria <>'.$id_subcategoria;
                                    $select = mysqli_query($conexao, $sql);

                                    while($rs=mysqli_fetch_array($select)){
                                    ?>

                                    <option value='<?php echo($rs['id_subcategoria'])?>'> 
                                        <?php echo($rs['categoria']." de ".$rs['subcategoria']);?> 
                                    </option>

                                    <?php } ?>
                               </select>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="<?php echo ($botao); ?>" id="btnSalvar" name="btnSalvar"></td>
                        </tr>
                    </table>
                </form>
                <table>
                    <tr>
                        <td>Id do filme</td>
                        <td>Nome do filme</td>
                        <td>Categoria do filme</td>
                        <td>Subcategoria do filme</td>
                    </tr>  
                        <?php 
                        $sql = 'select tbl_produto_categoria.ativo, tbl_produto_categoria.id_produto_categoria, tbl_produto.nome_produto, tbl_subcategoria.subcategoria,tbl_categoria.categoria from tbl_produto_categoria join tbl_produto on tbl_produto.id_produto = tbl_produto_categoria.id_produto join tbl_subcategoria on tbl_subcategoria.id_subcategoria = tbl_produto_categoria.id_subcategoria join tbl_categoria on tbl_categoria.id_categoria = tbl_subcategoria.id_categoria';
                        $select = mysqli_query($conexao, $sql);
                        
                        while($rs=mysqli_fetch_array($select))
                        {
                            if($rs['ativo']== 0)
                                $icone = "check1.png";
                            else
                                $icone = "check.png";
                                
                    ?>
                    <tr>
                        <td><?php echo($rs['id_produto_categoria'])?></td>
                        <td><?php echo($rs['nome_produto'])?></td>
                        <td><?php echo($rs['categoria'])?></td>
                        <td><?php echo($rs['subcategoria'])?></td>
                        <td>
                            <a href="cadastro_produto_categoria.php?modo=excluir&codigo=<?php echo($rs['id_produto_categoria'])?>"  onclick="return confirm('Deseja realmente excluir');">
                                <img alt="excluir" src='imagens/icones/deletar.png'>
                            </a>
                            
                            <a href="cadastro_produto_categoria.php?modo=editar&codigo=<?php echo($rs['id_produto_categoria'])?>">
                                <img src="imagens/icones/edit.png" alt="editar">
                            </a>
                            
                            <a href="cadastro_produto_categoria.php?status=<?php echo ($rs['ativo']);?>&codigo=<?php echo($rs['id_produto_categoria'])?>">
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
