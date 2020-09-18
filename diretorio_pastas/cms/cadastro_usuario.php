<?php 
    
    session_start();

    $botao = "Salvar";
    $conteudo = null;
    require_once('funcoes/login.php');
    require_once('bd/conexao.php');
    $conexao = conexaoMysql();

    $usuario = '';
    $email = '';
    $codigo_nivel_usuario = 0;

    if(isset($_GET['modo']))
    {
        if($_GET['modo'] == 'excluir')
        {
            $sql ="delete from tbl_usuario where id=".$_GET['codigo'];
            mysqli_query($conexao, $sql);
            header('location:cadastro_usuario.php');
        
        }elseif($_GET['modo'] == 'editar')
        {
            $sql="select tbl_usuario.*, tbl_nivel_usuario.nivel as nivel_usuario from tbl_usuario join tbl_nivel_usuario on tbl_usuario.nivel = tbl_nivel_usuario.id where tbl_usuario.id=".$_GET['codigo'];
            $select=mysqli_query($conexao, $sql);
            
            if($rsusers= mysqli_fetch_array($select))
            {
                $usuario = $rsusers['usuario'];
                $email = $rsusers['email'];
                $nivel = $rsusers['nivel_usuario'];
                $codigo_nivel_usuario = $rsusers['nivel'];
                $botao = "Editar";

                $_SESSION['id'] = $_GET['codigo'];
            } 
        }
    }


    if(isset($_POST['btnSalvar']))
    {
        $usuario = $_POST['txtusuario'];
        $email = $_POST['txtemail'];
        $senha1 = $_POST['txtsenha1'];
        $senha2 = $_POST['txtsenha2'];
        $nivel = $_POST['slt_nivel'];
        $botao = $_POST['btnSalvar'];   
        
      

        if($senha1 == $senha2)
        {
            $senha = md5($senha1);
            if($_POST['btnSalvar']=='Salvar')
                {
                    $sql = "insert into tbl_usuario (usuario, email, senha, nivel) values ('".$usuario."','".$email."' ,'".$senha."',".$nivel.")";   
                    mysqli_query($conexao, $sql);
                
                }elseif($_POST['btnSalvar']=="Editar")
                {
                    $sql="update tbl_usuario set usuario='".$usuario."',
                       email='".$email."',
                       senha='".$senha."',
                       nivel=".$nivel."
                        where id = ".$_SESSION['id'];
                    
                    mysqli_query($conexao, $sql);
                    
                    
                }
           header("location:index.php");

                
        }else
        {
            echo('senhas não se coincidem');
        }
}



?>



<html lang="pt-br">
	<head>
        <title>
            Cadastro Usuário
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
                        
                    
                    

                    <form id="frmCadastroUsuario" name="frmCadastroUsuario" method="post" action="cadastro_usuario.php" enctype="multipart/form-data">
                        
                        <table>
                            <tr>
                                <td><span>Usuário</span></td>
                                <td><input required type="text" name="txtusuario" value="<?php echo($usuario)?>" ></td>
                            </tr>
                             <tr>
                                <td><span>E-mail</span></td>
                                <td><input required type="text" name="txtemail" value="<?php echo($email)?>"></td>
                            </tr>
                             <tr>
                                <td> <span>Senha</span></td>
                                <td><input required type="password" name="txtsenha1"></td>
                            </tr>
                             <tr>
                                <td><span>Confirme a senha</span></td>
                                <td><input required type="password" name="txtsenha2"></td>
                            </tr>
                             <tr>
                                <td><span>Nível do Usuário</span></td>
                                <td> <select required name="slt_nivel">  
                                       <?php
                                           if($botao == 'Editar'){             
                                       ?>
                                        <option value="<?php echo($codigo_nivel_usuario);?>" selected><?php echo($nivel);?></option>
                                       <?php 
                                           }else{ 
                                       ?>
                                        <option value="" selected hidden>Selecione um nível</option>
                                        <?php 
                                           } 

                                        $sql = 'select * from tbl_nivel_usuario where ativo = 1 and id <>'.$codigo_nivel_usuario;
                                        $select = mysqli_query($conexao, $sql);

                                        while($rs=mysqli_fetch_array($select)){
                                       ?>

                                        <option value='<?php echo($rs['id'])?>'> <?php echo($rs['nivel'])?> </option>

                                        <?php } ?>
                                   </select>
                                 </td>
                            </tr>
                            
                            <tr>
                                <td><input type="submit" value="<?php echo ($botao); ?>" id="btnSalvar" name="btnSalvar"></td>
                                
                            </tr>
                        </table>

                   
                    </form>
                    </div>
                
            </div>
        </div>
        
    </body>
</html>
