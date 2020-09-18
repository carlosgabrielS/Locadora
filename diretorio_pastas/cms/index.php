<?php
    session_start();
    require_once('funcoes/login.php');
?>
<!doctype html>
<html lang="pt-br">
	<head>
        <title>
            Cms- Gerenciamento do site
        </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery-3.3.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.detalhes').click(function(){
                    $('#container').fadeIn(1000);
                });
            });
            
            function visualizarDados(idItem)
            {
                $.ajax({
                    type: "GET",
                    url:"modal.php",
                    data:{codigo:idItem},
                    success: function(dados){
                        $('#modal').html(dados);
                        //alert(dados);  
                    }
                })
            }
        </script>
    </head>
	<body>
        <div id="container">
            <div id="modal">
                
            </div>
        </div>
        <!-- Todo a área de CMS   -->
        <div id="tamanho_centralizar" class="center">
        
        <div id="cms">
            <!--  Primeira faixa do cms   -->
            <div id="head_cms">
                <!-- Texto head do cms -->
                <div id="conteudo_header_cms"><span>CMS</span>- Sistema de Gerenciamento do Site</div>
                <!-- Logo head do cms-->
                <div id="logo_cms">
                    <img alt="logo" src="imagens/img_cms.png">
                </div>
            </div>
            <!-- Segunda faixa do cms -->
            <div id="administradores">
                <!-- Caixa de todos os usuários do cms-->
                <div id="usuarios">
                    <!-- Caixa usuários do cms-->
                    <div class="usuarios_sistema" id="administrador_sistema">
                        <!-- imagem dos usuários do cms--> 
                        <div class="usuarios_sistema_imagem center ">
                                <img alt="usuario" src="imagens/avatar/afromen.png">
                        </div>
                        <div class="usuarios_sistema_nome">
                            Adm. Sistema    
                        </div>
                    </div>
                    <!-- Caixa usuários do cms-->
                    <div class="usuarios_sistema" id="administrador_fale_conosco">
                        <!-- imagem dos usuários do cms-->
                        <div class="usuarios_sistema_imagem center ">
                            <img alt="usuario" src="imagens/avatar/einsten.png">
                        </div>
                        <div class="usuarios_sistema_nome">
                            Adm. Fale Conosco    
                        </div>
                    </div>
                    <!-- Caixa usuários do cms-->
                    <div class="usuarios_sistema" id="administrador_produtos">
                        <!-- imagem dos usuários do cms-->
                        <div class="usuarios_sistema_imagem center ">
                            <img alt="usuario" src="imagens/avatar/girl.png">
                        </div>
                        <div class="usuarios_sistema_nome">
                            Adm. Produtos    
                        </div>
                    </div>
                    <!-- Caixa usuários do cms-->
                    <div class="usuarios_sistema" id="administrador_usuarios">
                        <!-- imagem dos usuários do cms-->
                        <div class="usuarios_sistema_imagem center ">
                            <img alt="usuario" src="imagens/avatar/girl2.png">
                        </div>
                        <div class="usuarios_sistema_nome">
                            Adm. Usuários    
                        </div>
                    </div>
                </div>
                <div id="logaut">
                    <div id="nome_logaut">
                        <p>Bem vindo</p><span> <?php echo ($_SESSION['usuario'])?></span>
                    </div>
                    <a href="?login=logout"><div id="navegacao_logaut">Logaut</div></a>
                     
                </div>
            </div>
            <div id='suporta_conteudo'>
                <div id="a">
                    <?php include('adm_sistema.php')?>
                </div>
                <div id="b">
                    <?php include('adm_fale_conosco.php')?>
                </div>
                <div id="c">
                    <?php include('adm_produto.php')?>
                </div>
                <div id="d">
                    <?php include('adm_usuarios.php')?>
                </div>
            </div>
            
            <div id="rodape">
                <span>Desenvolvido por Carlos Gabriel</span>
            </div>
        </div>
        </div>
        <script src="js/mudar_conteudo.js"></script>
    </body>
</html>
