<?php 
    session_start();

    $botao = "Salvar";
    $titulo = null;
    $conteudo = null;
    require_once('funcoes/login.php');
    require_once('bd/conexao.php');
    $conexao = conexaoMysql();

    if(isset($_GET['modo']))
    {
        if($_GET['modo'] == 'excluir')
        {
            $sql ="delete from tbl_filme_mes where id=".$_GET['codigo'];
            mysqli_query($conexao, $sql);
            
//            apaga o arquivo da imagem fisicamente no servidor
            $foto = "../imagens/filme_mes/".$_GET['foto'];
            unlink($foto);
            header('location:gerenciar_filme_mes.php');
        
        }elseif($_GET['modo'] == 'editar')
        {
            $sql="select * from tbl_filme_mes where id=".$_GET['codigo'];
            $select=mysqli_query($conexao, $sql);
            if($rs= mysqli_fetch_array($select))
            {
                $titulo = $rs['titulo'];
                $conteudo = $rs['conteudo'];
                $nomefoto = $rs['imagem'];
                $botao = "Editar";

                $_SESSION['id'] = $_GET['codigo'];
                $_SESSION['nomefoto']= $nomefoto;
            } 
        }
    }

    if(isset($_GET['status'])){
        $codigo = $_GET['codigo'];
        $mudar  = $_GET['status'];
        
        if($mudar == 1){
            $sql="update tbl_filme_mes set ativo = 0 ";
            if(mysqli_query($conexao, $sql))
            {
                header('location:gerenciar_filme_mes.php');
            }
        }
        else
        {
            $sql="update tbl_filme_mes set ativo = 1 where id = ".$codigo;
            if(mysqli_query($conexao, $sql))
            {
                $sql="update tbl_filme_mes set ativo = 0 where id <> ".$codigo;
                if(mysqli_query($conexao, $sql))
                    header('location:gerenciar_filme_mes.php'); 
            }
        }
    }

    if(isset($_POST['btnSalvar']))
    {
        $conteudo = $_POST['txtconteudo'];
        $titulo = $_POST['txttitulo'];
        

        if(!empty($_FILES['flefotos']['name']))
        {
        $arquivos_permitidos = array(".jpg",".jpeg",".png");
        $diretorio ="../imagens/filme_mes/";
        $arquivo = $_FILES['flefotos']['name'];
        $tamanho_arquivo = $_FILES['flefotos']['size']; 
        $tamanho_arquivo = round($tamanho_arquivo/1024);
        $extensao_arquivo = strrchr($arquivo,'.');
        $nome_arquivo = pathinfo($arquivo,PATHINFO_FILENAME);
        $arquivo_criptografado = md5(uniqid(time()).$nome_arquivo);
        $foto = $arquivo_criptografado . $extensao_arquivo;
        if(in_array($extensao_arquivo, $arquivos_permitidos))
        {
            if($tamanho_arquivo <=5000)
            {
                $arquivo_temp = $_FILES['flefotos']['tmp_name'];
                if(move_uploaded_file($arquivo_temp, $diretorio.$foto))
                {
                    if($_POST['btnSalvar']=='Salvar')
                    {
                        $sql = "insert into tbl_filme_mes (titulo, conteudo, imagem) values ('".addslashes($titulo)."','".addslashes($conteudo)."','".addslashes($foto)."')";   
                        echo($sql);
                        
                        mysqli_query($conexao, $sql);
                    }elseif($_POST['btnSalvar']=="Editar"){
                        $sql="update tbl_filme_mes set titulo='".addslashes($titulo)."',conteudo='".addslashes($conteudo)."',
                            imagem='".addslashes($foto)."'
                            where id = ".$_SESSION['id'];
                        
                        if(mysqli_query($conexao, $sql)){
                            unlink('../imagens/filme_mes/'.$_SESSION['nomefoto']);
                        }
                    }             
                    header("location:gerenciar_filme_mes.php");
                }
                else
                {
                    echo("Erro ao enviar o arquivo para o servidor");
                }
            }else
            {
                echo("tamanho de arquivo inválido");
            }
        }else
        {
            echo("Extensão de arquivo inválida");
        } 
    }else
    {
        if($_POST['btnSalvar'] == "Editar"){
            $sql = "update tbl_filme_mes set conteudo='".addslashes($conteudo)."', titulo='".addslashes($titulo)."' where id =".$_SESSION['id'];
            mysqli_query($conexao, $sql);
            header("location:gerenciar_filme_mes.php");
        }else
        {
            echo('Favor escolher uma foto');
        }
    }
}
?>

<html lang="pt-br">
	<head>
        <title>
            Gerenciamento filme mês
        </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id='tamanho_centralizar' class='center'>
            <div id="cms" class="center">
                    <div id='cadastros'>
                        <a href="index.php">
                            <img alt='voltar' title='voltar' src="imagens/icones/return.png">
                        </a>
                        <h1>Cadastro do filme do mês</h1>        
            <form id="frmCadastro" name="frmCadastro" method="post" action="gerenciar_filme_mes.php" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Titulo</td>
                        <td>   <input type="text" name="txttitulo" value="<?php echo($titulo)?>" ></td>
                    </tr>
                    <tr>
                        <td>Conteudo</td>
                        <td><input type="text" name="txtconteudo" value="<?php echo($conteudo)?>" ></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="<?php echo ($botao); ?>" id="btnSalvar" name="btnSalvar"></td>
                    </tr>
                </table>
               
                <input type="file" name="flefotos"><br>
                    <?php if(isset($nomefoto)){?>
                    <div id="caixa_fotos">
                        
                        <img src="../imagens/filme_mes/<?php echo($nomefoto)?>">
                    </div>
                <?php } ?>
                <div id='scroll_tabela'>
                    <table>

                    <th>Titulo</th><th>Conteudo</th><th>Foto</th>
                    <?php
                        $sql="select * from tbl_filme_mes";
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
                            <?php echo($rs["titulo"]);?>
                        </td>
                        <td>
                            <?php echo($rs["conteudo"]);?>
                        </td>
                        <td>
                            <img class="foto" src="../imagens/filme_mes/<?php
                            echo($rs["imagem"]);?>">
                        </td>
                        <td>
                            <a href="gerenciar_filme_mes.php?modo=excluir&codigo=<?php echo($rs['id'])?>&foto=<?php echo($rs['imagem'])?>"  onclick="return confirm('Deseja realmente excluir');"><img alt="excluir" src='imagens/icones/deletar.png'></a>
                            <a href="gerenciar_filme_mes.php?modo=editar&codigo=<?php echo($rs['id'])?>"><img src="imagens/icones/edit.png" alt="editar"></a>
                            <a href="gerenciar_filme_mes.php?status=<?php echo ($rs['ativo']); ?>&codigo=<?php echo($rs['id'])?>">
                                <img src="../imagens/icones/<?php echo($icone) ?>">
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
            </table>
                </div>
                

            </form>
        </div>
            
            </div>
        </div>
    </body>
</html>