<?php
    session_start();
    require_once('funcoes/login.php');
    require_once('funcoes/funcao_imagem.php');
    require_once('bd/conexao.php');
    $conexao = conexaoMysql();

    $botao = 'Salvar';
    $nome_produto = '';
    $preco = 0.0;
    $detalhe = '';
    $descricao = '';
    
    
    /*Ação para excluir ou carregar os valores para a edição*/
    if(isset($_GET['modo']))
    {
        if($_GET['modo'] == 'excluir')
        {
            $sql ="delete from tbl_produto where id_produto=".$_GET['codigo'];
            mysqli_query($conexao, $sql);   
            $foto = "../imagens/produtos/".$_GET['foto'];
            unlink($foto);
            
            header('location:cadastro_produto.php');

        }elseif($_GET['modo'] == 'editar')
        {
            $sql="select * from tbl_produto where id_produto=".$_GET['codigo'];
            $select=mysqli_query($conexao, $sql);
            if($rs= mysqli_fetch_array($select))
            {
                $nome_produto = $rs['nome_produto'];
                $preco = $rs['preco'];
                $detalhe = $rs['detalhe'];
                $descricao = $rs['descricao'];
                $nomefoto = $rs['imagem'];
                $botao = "Editar";

                
                $_SESSION['nomefoto']= $nomefoto;
                $_SESSION['id'] = $_GET['codigo'];
            } 
        }
    }  

    /*Ação de mudar status da categoria
    de ativo para 0 ou 1*/
    if(isset($_GET['status']))
    {
        $codigo = $_GET['codigo'];
        $mudar  = $_GET['status'];
        
        if($mudar == 1)
        {
            $sql="update tbl_produto set ativo = 0 where id_produto = ".$codigo;
            if(mysqli_query($conexao, $sql))
                echo("<script>window.location.href='cadastro_produto.php'</script>");
        }
        else
        {
            $sql="update tbl_produto set ativo = 1 where id_produto = ".$codigo;
            mysqli_query($conexao, $sql);    
        }
    }

            /*Ação de salvar ou editar um PRODUTO*/
        if(isset($_POST['btnSalvar']))
        {
            $nome_produto = $_POST['txtnomeproduto'];
            $preco = $_POST['txtpreco'];
            $detalhe = $_POST['txtdetalhe'];
            $descricao = $_POST['txtdescricao'];
            $botao = "Editar";

            if(!empty($_FILES['flefotos']['name']))
            {   
            $arquivofoto = $_FILES['flefotos'];
            $flefotos = tratarImagem($arquivofoto, '../imagens/produtos/');
                if($_POST['btnSalvar'] == 'Salvar')
                {
                    $sql = "insert into tbl_produto (nome_produto, preco, detalhe, descricao, imagem) 
                            values ('".$nome_produto."',".$preco.",'".$detalhe."', '".$descricao."','".$flefotos."')";
                    echo($sql);
                    mysqli_query($conexao, $sql);
                }
                else if($_POST['btnSalvar']=="Editar")
                {
                    $sql="update tbl_produto set 
                                nome_produto='".addslashes($nome_produto)."',
                                preco=".$preco.",
                                detalhe='".addslashes($detalhe)."',
                                descricao='".addslashes($descricao)."',
                                imagem='".$flefotos."'
                        where id_produto = ".$_SESSION['id'];
                    echo($sql);

                    if(mysqli_query($conexao, $sql))
                        unlink('../imagens/produtos/'.$_SESSION['nomefoto']);
                    else
                        echo('Erro na gravação');
                }
                header("location:cadastro_produto.php");
            }  
            else
            {
                if($_POST['btnSalvar']=="Editar")
                {
                $sql="update tbl_produto set 
                                nome_produto='".addslashes($nome_produto)."',
                                preco=".$preco.",
                                detalhe='".addslashes($detalhe)."',
                                descricao='".addslashes($descricao)."'
                        where id_produto = ".$_SESSION['id'];
                    echo($sql);
                    if(mysqli_query($conexao, $sql))
                        header("location:cadastro_produto.php");
                    else
                        echo("Erro na atualização");
                }
                else
                {
                    echo('Favor escolher uma foto');
                }
            }
        }
?>
<!doctype html>
<html lang="pt-br">
	<head>
        <title>
            Cms- Cadastro de Produto
        </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        
        <div id="tamanho_centralizar" class="center">
            <div id="cms">
                <form id="frmproduto" name="frmproduto" method="post" action="cadastro_produto.php" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>Produto:</td>
                            <td>
                                <input type="text" required name="txtnomeproduto" value="<?php echo($nome_produto)?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Preco:</td>
                            <td>
                                <input type="number" required name="txtpreco" value="<?php echo($preco)?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Detalhe:</td>
                            <td>
                                <input type="text" required name="txtdetalhe" value="<?php echo($detalhe)?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Descricao:</td>
                            <td>
                                <input type="text" required name="txtdescricao" value="<?php echo($descricao)?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Imagem do Produto</td>
                            <td> <input  type="file"  name="flefotos"></td>
                            <?php if(isset($nomefoto)){?>
                                <div>
                                    <img src="../imagens/produtos/<?php echo($nomefoto)?>">
                                </div>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="<?php echo ($botao); ?>" id="btnSalvar" name="btnSalvar">
                            </td>
                        </tr>
                    </table>
                </form>
                <table>
                    <tr>
                        <th>id</th>
                        <th>nome</th>
                        <th>preco</th>
                        <th>detalhe</th>
                        <th>descricao</th>
                        <th>imagem</th>
                    </tr>
                    <?php
                        $sql="select * from tbl_produto";
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
                        <td> <?php echo($rs['id_produto']) ?></td>
                        <td><?php echo($rs['nome_produto'])?></td>
                        <td><?php echo($rs['preco'])?></td>
                        <td><?php echo($rs['detalhe'])?></td>
                        <td><?php echo($rs['descricao'])?></td>
                        <td><img src='../imagens/produtos/<?php echo($rs['imagem'])?>'></td>
                        <td>
                            <a href="cadastro_produto.php?modo=excluir&foto=<?php echo($rs['imagem'])?>&codigo=<?php echo($rs['id_produto'])?>"  onclick="return confirm('Deseja realmente excluir');">
                                <img alt="excluir" src='imagens/icones/deletar.png'>
                            </a>
                            
                            <a href="cadastro_produto.php?modo=editar&codigo=<?php echo($rs['id_produto'])?>">
                                <img src="imagens/icones/edit.png" alt="editar">
                            </a>
                            
                            <a href="cadastro_produto.php?status=<?php echo ($rs['ativo']);?>&codigo=<?php echo($rs['id_produto'])?>">
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