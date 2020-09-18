<!doctype html>
<html lang="pt-br">
	<head>
        <link rel="icon" href="imagens/ICONES/icone.png">
        <title>
            Atores em destaque
		</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="cms/js/jquery-3.3.1.min.js"></script>
        <script src='js/jquery.js'></script>
        <script src="js/menu.js"></script>
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
        <!-- header do site -->
        <?php
	       include 'header.php';
        ?>
        <!-- Caixa onde comporta todo o conteudo do site -->
            <div id="faixa_principal" class="center">
                <h1>Atores em destaque</h1>
                <!-- Caixa dos atores em destaque -->
                <!-- <div class="caixas_ator_destaque">
                 imagem atores 
                    <figure class="imagem_ator">
                        <img alt="ator 1" src="imagens/nicolascage.jpg">
                    </figure>
                    Breve explicação sobre os atores 
                    <div class="conteudo_ator">
                        <p class="nome">Nicolas Cage</p>
                        <p>79 filmes</p>
                    </div>
                </div> -->
                <?php
                    require_once('bd/conexao.php');
                    $conexao = conexaoMysql();
                    
                    $sql="select * from tbl_ator where destaque = 1";
                        $select = mysqli_query($conexao, $sql);
                        while($rs=mysqli_fetch_array($select))
                        {
                
                ?>
                <div id='atores'>
                    <h2><?php echo ($rs['nome_ator'])?></h2>
                <figure>
                    <img alt='ator destaque' src='imagens/atores_destaque/<?php echo($rs["imagem"]) ?>'>
                </figure>
                
                <p> 
                    <?php echo($rs['detalhes'])?>
                </p>
                </div>
                <?php }?>
            </div>
        <!-- Rodape do site -->
        <?php include('footer.php') ?>
    </body>
</html>
