<?php 
session_start();
require_once('funcoes/login.php');
require_once('funcoes/funcao_imagem.php');
require_once('bd/conexao.php');
$conexao = conexaoMysql();

$botao = "Salvar";
$conteudo = "";
$nome = "";

//           MODO DE EXCLUSÃO
if(isset($_GET['modo']))
    {
        if($_GET['modo'] == 'excluir')
        {
            $sql ="delete from tbl_ator where id=".$_GET['id'];
            mysqli_query($conexao, $sql);
            
//            apaga o arquivo da imagem fisicamente no servidor
            $foto = "../imagens/atores_destaque/".$_GET['foto'];
            
            unlink($foto);
            header('location:gerenciar_ator_destaque.php');
//        MODO DE EDIÇÃO
        }elseif($_GET['modo'] == 'editar')
        {
            $sql="select * from tbl_ator where id=".$_GET['id'];
            $select=mysqli_query($conexao, $sql);
            if($rs= mysqli_fetch_array($select))
            {
                $conteudo = $rs['detalhes'];
                $nome = $rs['nome_ator'];
                $nomefoto = $rs['imagem'];
                $botao = "Editar";

                $_SESSION['id'] = $_GET['id'];
                $_SESSION['nomefoto']= $nomefoto;
            } 
        }
    }
//        SALVAR UM REGISTO
    if(isset($_POST['btnSalvar']))
    {
        $conteudo = $_POST['txtconteudo'];
        $nome = $_POST['txtnomeator'];
        
        
//        VERIFICA SE EXUSTE ARQYUVI SELECIONADO NO ELEMENTO FILES
        if(!empty($_FILES['flefotos']['name']))
        {   
            $arquivofoto = $_FILES['flefotos'];
            $flefotos = tratarImagem($arquivofoto, '../imagens/atores_destaque/');
            
            if($_POST['btnSalvar']=='Salvar')
                {
                    $sql = "insert into tbl_ator (detalhes, imagem, nome_ator) values ('".$conteudo."','".$flefotos."','".$nome."')";  

                    mysqli_query($conexao, $sql);
                }
            else if($_POST['btnSalvar']=="Editar")
            {
                $sql="update tbl_ator set detalhes='".$conteudo."',
                    imagem='".$flefotos."', nome_ator='".$nome."'
                    where id = ".$_SESSION['id'];

                if(mysqli_query($conexao, $sql))
                {
                    unlink('../imagens/atores_destaque/'.$_SESSION['nomefoto']);
                    header("location:gerenciar_atores_destaque.php");
                }
            } else if($_POST['btnSalvar']=='Salvar')
            {
                echo('Selecione uma foto');
            }      
                     

        } else 
//EDITAR SEM A FOTO
        {
            if($_POST['btnSalvar'] == "Editar")
            {
                $sql = "update tbl_ator set nome_ator='".$nome."', detalhes = '".$conteudo."' where id =".$_SESSION['id'];
                
                if(mysqli_query($conexao, $sql)){
               header("location:gerenciar_ator_destaque.php");
                    
                }
//               VALUE = SALVAR E NÃO POSSUI FOTO SELECIONADA 
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
            $sql="update tbl_ator set destaque = 0 ";
            if(mysqli_query($conexao, $sql))
            {
                header('location:gerenciar_ator_destaque.php');
            }
        }
        else
        {
            $sql="update tbl_ator set destaque = 1 where id = ".$codigo;
            if(mysqli_query($conexao, $sql))
            {
                $sql="update tbl_ator set destaque = 0 where id <> ".$codigo;
                if(mysqli_query($conexao, $sql))
                    header('location:gerenciar_ator_destaque.php'); 
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Gerenciar Ator</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="tamanho_centralizar" class="center">
            <div id="cms">
                <div id='cadastros'>
                        <a href="index.php">
                            <img alt='voltar' title='voltar' src="imagens/icones/return.png">
                        </a>
                        <form id="frmator" name="frmator" method="post" action="gerenciar_ator_destaque.php" enctype="multipart/form-data">
                    Conteudo<input type="text" name="txtconteudo" required value="<?php echo($conteudo)?>" > <br>
                    Nome<input type="text" name="txtnomeator" required  value="<?php echo($nome)?>" >       <br><br>
                    Imagem 1<input type="file"  name="flefotos" >   <br><br>
                    <?php if(isset($nomefoto)){?>
                            <div id="caixa_fotos">

                                <img src="../imagens/atores_destaque/<?php echo($nomefoto)?>">
                            </div>
                        <?php } ?> <br><br>


                    <input type="submit" value="<?php echo ($botao); ?>" id="btnSalvar" name="btnSalvar">  
                </form>
                    <div class='crud'>
                        <div id='scroll_tabela'>
                        <table id='padronizacao_crud'>
                            <tr>
                                <th>Nome</th>
                                <th>Conteudo</th>
                                <th>Foto</th>
                                <th>Opções</th>
                            </tr>
                            
                            <?php
                                $sql="select * from tbl_ator";
                                $select = mysqli_query($conexao, $sql);

                                while($rs = mysqli_fetch_array($select))
                            {
                                if($rs['destaque']== 0)
                                {
                                    $icone = "check1.png";
                                }else
                                {
                                    $icone = "check.png";
                                } 
                            ?>
                            <tr> 
                                <td>
                                    <?php echo($rs["nome_ator"]);?>
                                </td>
                                <td>
                                    <?php echo($rs["detalhes"]);?>
                                </td>
                                <td>
                                    <img src="../imagens/atores_destaque/<?php
                                    echo($rs["imagem"]);?>">
                                </td>


                                <td>
                                    <a href="gerenciar_ator_destaque.php?modo=excluir&id=<?php echo($rs['id'])?>&foto=<?php echo($rs['imagem'])?>"  onclick="return confirm('Deseja realmente excluir');"><img alt="excluir" src='imagens/icones/deletar.png'></a>
                                    <a href="gerenciar_ator_destaque.php?modo=editar&id=<?php echo($rs['id'])?>"><img src="imagens/icones/edit.png" alt="editar"></a>
                                    <a href="gerenciar_ator_destaque.php?status=<?php echo ($rs['destaque']); ?>&codigo=<?php echo($rs['id'])?>">
                                        <img src="../imagens/icones/<?php echo($icone) ?>">
                                    </a>    
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                    </table>   
                </div>
                    </div>
               </div> 
            </div>
        </div>         
    </body>
</html>