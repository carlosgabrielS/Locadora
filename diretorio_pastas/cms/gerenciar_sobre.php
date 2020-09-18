<?php 
    session_start();

    $botao = "Salvar";
    $conteudo = null;
    require_once('bd/conexao.php');
    require_once('funcoes/login.php');
    $conexao = conexaoMysql();
    if(isset($_GET['modo']))
    {
        if($_GET['modo'] == 'excluir')
        {
            $sql ="delete from tbl_sobre where id=".$_GET['codigo'];
            mysqli_query($conexao, $sql);
            
//            apaga o arquivo da imagem fisicamente no servidor
            $foto = "../imagens/sobre/".$_GET['foto'];
            unlink($foto);
            header('location:gerenciar_sobre.php');
        
        }elseif($_GET['modo'] == 'editar')
        {
            $sql="select * from tbl_sobre where id=".$_GET['codigo'];
            $select=mysqli_query($conexao, $sql);
            if($rs= mysqli_fetch_array($select))
            {
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
            $sql="update tbl_sobre set ativo = 0 ";
            if(mysqli_query($conexao, $sql))
            {
                header('location:gerenciar_sobre.php');
            }
        }
        else
        {
            $sql="update tbl_sobre set ativo = 1 where id = ".$codigo;
            if(mysqli_query($conexao, $sql))
            {
                $sql="update tbl_sobre set ativo = 0 where id <> ".$codigo;
                if(mysqli_query($conexao, $sql))
                    header('location:gerenciar_sobre.php'); 
            }
        }
    }


    if(isset($_POST['btnSalvar']))
    {
        $conteudo = $_POST['txtconteudo'];
        
      
//        VERIFICA SE EXUSTE ARQYUVI SELECIONADO NO ELEMENTO FILES
        if(!empty($_FILES['flefotos']['name']))
           {
              //        arquivos permitidos no upload
        $arquivos_permitidos = array(".jpg",".jpeg",".png");
        
//        diretorio que as imagens serão gravadas
        $diretorio ="../imagens/sobre/";
        
        
//        nome do arquivo a ser upado para o servidor
        $arquivo = $_FILES['flefotos']['name'];
//        tamanho do arquivo a ser upado para o servidor
        $tamanho_arquivo = $_FILES['flefotos']['size']; 
        
//        transforma o valor do arquivo de bytes em kbytes, para facilitar o tratamento de tamanho de arquivo
        $tamanho_arquivo = round($tamanho_arquivo/1024);
        
//        guarda somente a extensão do arquivo
        $extensao_arquivo = strrchr($arquivo,'.');
        
//        guarda somente o nome do arquivo, utulizando a função pathinfo
        $nome_arquivo = pathinfo($arquivo,PATHINFO_FILENAME);
        
//        uniqid - gera uma sequencia numerica aleatoria baseado em informações de hardware, porém estamos agregando hora, minuto e segundo para gerar uma hash totalmente única
        $arquivo_criptografado = md5(uniqid(time()).$nome_arquivo);
        
//        criamos o nome com a extensão do arquivo (já criptografado) que será enviada para o servidor
        $foto = $arquivo_criptografado . $extensao_arquivo;
        
//        validação das extensões dos arquivos permitidos
        if(in_array($extensao_arquivo, $arquivos_permitidos))
        {
//            validação de tamanho de arquivo (limite de no maximo 5mb)
            if($tamanho_arquivo <=5000)
            {
//                caminho do diretorio temportário que a imagem foi guardada pelo servidor
                $arquivo_temp = $_FILES['flefotos']['tmp_name'];
                
                
                if(move_uploaded_file($arquivo_temp, $diretorio.$foto))
                {
                    if($_POST['btnSalvar']=='Salvar')
                    {
                        $sql = "insert into tbl_sobre (conteudo, imagem) values ('".addslashes($conteudo)."','".addslashes($foto)."')";   
                        echo($sql);
//                    addslashes - elimina a entrada de asoas ' no script
//                    addsclashes
//                    strip_tag - elimina a entrada de tag <>,
//                    podemos proibir a entrada de comandos em javascript <script>
                        mysqli_query($conexao, $sql);
                    }elseif($_POST['btnSalvar']=="Editar"){
                        $sql="update tbl_sobre set conteudo='".addslashes($conteudo)."',
                            imagem='".addslashes($foto)."'
                            where id = ".$_SESSION['id'];
                        
                        if(mysqli_query($conexao, $sql)){
                            unlink('../imagens/sobre/'.$_SESSION['nomefoto']);
                        }
                    }
                    
                    

                    
                    header("location:gerenciar_sobre.php");
                    
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
            $sql = "update tbl_sobre set conteudo='".addslashes($conteudo)."' where id =".$_SESSION['id'];
            
            mysqli_query($conexao, $sql);
            header("location:gerenciar_sobre.php");
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
            Gerenciamento sobre a loja
        </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
         
                 
               
        
    </head>
    <body>
        <!-- Todo a área de CMS   -->
        <div id="tamanho_centralizar" class="center">
        
            <div id="cms">
                <div id='cadastros'>
                        <a href="index.php">
                            <img  alt='voltar' title='voltar' src="imagens/icones/return.png">
                        </a>
                        <h1>Cadastro de lojas</h1>
            <form id="frmCadastro" name="frmCadastro" method="post" action="gerenciar_sobre.php" enctype="multipart/form-data"><br><br><br>
                Conteudo<input type="text" name="txtconteudo" value="<?php echo($conteudo)?>" ><br><br> 
            
            <input type="submit" value="<?php echo ($botao); ?>" id="btnSalvar" name="btnSalvar"><br>                
                <input type="file" name="flefotos"><br>
                    <?php if(isset($nomefoto)){?>
                    <div id="caixa_fotos">
                        
                        <img src="../imagens/sobre/<?php echo($nomefoto)?>">
                    </div>
                <?php } ?>
                <div id='scroll_tabela'>
                    <table class='tabela_sobre'>

                    <th class='inform_fale_conosco'>Conteudo</th>
                    <th class='inform_fale_conosco'>Foto</th>
                    <th class='inform_fale_conosco'>Opção</th>
                    <?php
                        $sql="select * from tbl_sobre";
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
                            <p><?php echo($rs["conteudo"]);?></p>
                        </td>
                        <td>
                            <img class="foto" src="../imagens/sobre/<?php
                            echo($rs["imagem"]);?>">
                        </td>
                        <td id='icon_table'>
                            <a href="gerenciar_sobre.php?modo=excluir&codigo=<?php echo($rs['id'])?>&foto=<?php echo($rs['imagem'])?>"  onclick="return confirm('Deseja realmente excluir');"><img alt="excluir" src='imagens/icones/deletar.png'></a>
                            <a href="gerenciar_sobre.php?modo=editar&codigo=<?php echo($rs['id'])?>"><img src="imagens/icones/edit.png" alt="editar"></a>
                            <a href="gerenciar_sobre.php?status=<?php echo ($rs['ativo']); ?>&codigo=<?php echo($rs['id'])?>"><img src="../imagens/icones/<?php echo($icone) ?>"></a>
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
