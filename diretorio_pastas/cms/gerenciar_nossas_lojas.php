<?php 

    

session_start();
require_once('funcoes/login.php');
require_once('funcoes/funcao_imagem.php');
require_once('bd/conexao.php');
$conexao = conexaoMysql();

$botao = "Salvar";
$conteudo = "";
$titulo = "";

if(isset($_GET['modo']))
    {
        if($_GET['modo'] == 'excluir')
        {
            $sql ="delete from tbl_nossas_lojas where id=".$_GET['id'];
            mysqli_query($conexao, $sql);
            
//            apaga o arquivo da imagem fisicamente no servidor
            $foto1 = "../imagens/nossas_lojas/".$_GET['foto'];
            $foto2 = "../imagens/nossas_lojas/".$_GET['foto2'];
            
            unlink($foto1);
            unlink($foto2);
            header('location:gerenciar_nossas_lojas.php');
        
        }elseif($_GET['modo'] == 'editar')
        {
            $sql="select * from tbl_nossas_lojas where id=".$_GET['id'];
            $select=mysqli_query($conexao, $sql);
            if($rs= mysqli_fetch_array($select))
            {
                $conteudo = $rs['conteudo'];
                $titulo = $rs['titulo'];
                $nomefoto1 = $rs['imagem1'];
                $nomefoto2 = $rs['imagem2'];
                $botao = "Editar";

                $_SESSION['id'] = $_GET['id'];
                $_SESSION['nomefoto1']= $nomefoto1;
                $_SESSION['nomefoto2']= $nomefoto2;
            } 
        }
    }



    if(isset($_POST['btnSalvar']))
    {
        $conteudo = $_POST['txtconteudo'];
        $titulo = $_POST['txttitulo'];
        
        
//        VERIFICA SE EXUSTE ARQYUVI SELECIONADO NO ELEMENTO FILES
        if(!empty($_FILES['flefotos1']['name']) && !empty($_FILES['flefotos2']['name']))
        {   
            $arquivofoto1 = $_FILES['flefotos1'];
            $arquivofoto2 = $_FILES['flefotos2'];
            $flefotos1 = tratarImagem($arquivofoto1, '../imagens/nossas_lojas/');
            $flefotos2 = tratarImagem($arquivofoto2, '../imagens/nossas_lojas/');
            
            if($_POST['btnSalvar']=='Salvar')
                {
                    $sql = "insert into tbl_nossas_lojas (conteudo, imagem1, imagem2, titulo) values ('".$conteudo."','".$flefotos1."','".$flefotos2."','".$titulo."')";  
                    echo($sql);

                    mysqli_query($conexao, $sql);
                }
                    else if($_POST['btnSalvar']=="Editar")
                {
                    $sql="update tbl_nossas_lojas set 
                    conteudo='".$conteudo."',
                        imagem1='".$flefotos1."',
                        imagem2='".$flefotos2."',
                         titulo='".$titulo."'
                        where id = ".$_SESSION['id'];

                        echo($sql);

                    if(mysqli_query($conexao, $sql))
                    {
                        unlink('../imagens/nossas_lojas/'.$_SESSION['nomefoto1']);
                        unlink('../imagens/nossas_lojas/'.$_SESSION['nomefoto2']);
                    }
                }          
                     header("location:gerenciar_nossas_lojas.php");      
        }else if(!empty($_FILES['flefotos1']['name']))
        {   
            $arquivofoto1 = $_FILES['flefotos1'];
            $flefotos1 = tratarImagem($arquivofoto1, '../imagens/nossas_lojas/');
            
            if($_POST['btnSalvar']=="Editar")
            {
                $sql="update tbl_nossas_lojas set conteudo='".$conteudo."',
                    imagem1='".$flefotos1."', titulo='".$titulo."'
                    where id = ".$_SESSION['id'];

                    echo($sql);

                if(mysqli_query($conexao, $sql))
                {
                    unlink('../imagens/nossas_lojas/'.$_SESSION['nomefoto1']);
                    header("location:gerenciar_nossas_lojas.php");
                }
            } else if($_POST['btnSalvar']=='Salvar')
            {
                echo('Selecione a foto 2');
            }      
                     

        } else if(!empty($_FILES['flefotos2']['name']))
        {   
            $arquivofoto2 = $_FILES['flefotos2'];
            $flefotos2 = tratarImagem($arquivofoto2, '../imagens/nossas_lojas/');
            
            if($_POST['btnSalvar']=="Editar")
            {
                $sql="update tbl_nossas_lojas set conteudo='".$conteudo."',
                    imagem2='".$flefotos2."', titulo='".$titulo."'
                    where id = ".$_SESSION['id'];

                    echo($sql);

                if(mysqli_query($conexao, $sql))
                {
                    unlink('../imagens/nossas_lojas/'.$_SESSION['nomefoto2']);
                    header("location:gerenciar_nossas_lojas.php");
                }
            }else if($_POST['btnSalvar']=='Salvar')
            {
                echo('Selecione a foto 1');
            }        
                          
        }else 
        {
            if($_POST['btnSalvar'] == "Editar")
            {
                $sql = "update tbl_nossas_lojas set titulo='".$titulo."', conteudo = '".$conteudo."' where id =".$_SESSION['id'];
                echo($sql);
                if(mysqli_query($conexao, $sql)){
                    header("location:gerenciar_nossas_lojas.php");      
                }
                
            }else
            {
                echo('Favor escolher uma foto');
            }
        }
    }

    if(isset($_GET['status'])){
        $codigo = $_GET['codigo'];
        $mudar  = $_GET['status'];
        
        if($mudar == 1){
            $sql="update tbl_nossas_lojas set ativo = 0 where id = ".$codigo;
            if(mysqli_query($conexao, $sql))
            {
                echo("<script>window.location.href='gerenciar_nossas_lojas.php'</script>");
            }
        }
        else
        {
            $sql="update tbl_nossas_lojas set ativo = 1 where id = ".$codigo;
            if(mysqli_query($conexao, $sql))
            {
                header('location:gerenciar_nossas_lojas.php');
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Gerenciar Nossas lojas</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="tamanho_centralizar" class="center">
            <div id="cms">
                <div id='cadastros'>
                        <a href="index.php">
                            <img alt='voltar' title='voltar' src="imagens/icones/return.png">
                        </a>
        <form id="frmCadastro" name="frmCadastro" method="post" action="gerenciar_nossas_lojas.php" enctype="multipart/form-data">
            
            <table>
                <tr>
                    <td>Conteudo</td>
                    <td><input type="text" name="txtconteudo" required value="<?php echo($conteudo)?>" ></td>
                    <td><input type="submit" value="<?php echo ($botao); ?>" id="btnSalvar" name="btnSalvar"></td>
                </tr>
                <tr>
                    <td>Titulo</td>
                    <td><input type="text" name="txttitulo" required  value="<?php echo($titulo)?>" ></td>
                </tr>
                <tr>
                    <td>Imagem 1</td>
                    <td><input type="file"  name="flefotos1" ></td>
                </tr>
                <tr>
                    <td>Imagem 2</td>
                    <td><input type="file" name="flefotos2"  ></td>
                    <td>
                        <div id='caixa_suporta_foto'>
                <?php if(isset($nomefoto1)){?>
                    <div class="caixa_fotos" id='caixa_fotos1'>
                        
                        <img src="../imagens/nossas_lojas/<?php echo($nomefoto1)?>">
                    </div>
                <?php } ?> 
               
            <?php if(isset($nomefoto2)){?>
                    <div class="caixa_fotos">
                        
                        <img src="../imagens/nossas_lojas/<?php echo($nomefoto2)?>">
                    </div>
                <?php } ?>
            </div>
                    </td>
                </tr>
            </table>
            
             
            </form>
            <div id='scroll_tabela'>
                <table>

                    <th>Titulo</th><th>Conteudo</th><th>Foto</th>
                    <?php
                        $sql="select * from tbl_nossas_lojas";
                        $select = mysqli_query($conexao, $sql);
                    
                        while($rs = mysqli_fetch_array($select))
                    {
                        if($rs['ativo']== 0)
                        {
                            $icone = "check1.png";
                        }else
                        {
                            $icone = "check.png";
                        } 
                    ?>
                    <tr> 
                        <td>
                            <?php echo($rs["titulo"]);?>
                        </td>
                        <td>
                            <?php echo($rs["conteudo"]);?>
                        </td>
                        <td>
                            <img src="../imagens/nossas_lojas/<?php
                            echo($rs["imagem1"]);?>">
                        </td>
                        <td>
                            <img src="../imagens/nossas_lojas/<?php
                            echo($rs["imagem2"]);?>">
                        </td>
                        
                        <td>
                            <a href="gerenciar_nossas_lojas.php?modo=excluir&id=<?php echo($rs['id'])?>&foto=<?php echo($rs['imagem1'])?>&foto2=<?php echo($rs['imagem2'])?>"  onclick="return confirm('Deseja realmente excluir');">Excluir</a>
                            <a href="gerenciar_nossas_lojas.php?modo=editar&id=<?php echo($rs['id'])?>">Editar</a>
                            <a href="gerenciar_nossas_lojas.php?status=<?php echo ($rs['ativo']); ?>&codigo=<?php echo($rs['id'])?>">
                                <img src="../imagens/icones/<?php echo($icone) ?>">
                            </a>    
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
            </table>    
            </div>
      
        
                </div></div></div>
    </body>
</html>