<?php
    require_once('bd/conexao.php');
    $conexao = conexaoMysql();
?>

<!doctype html>
<html lang="pt-br">
	<head>
        <link rel="icon" href="imagens/ICONES/icone.png">
        <title>
            Filme do Mês
		</title>
        <script src='js/jquery.js'></script>
        <script src="js/menu.js"></script>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
      </head>
	<body>
        <!-- Area do header -->
        <?php include'header.php' ?> 
            <!-- Caixa onde está todo o conteudo do site-->
            <div id="faixa_principal" class="center">
                <h1>Filmes do mês</h1>
                <!-- Area do filme do mês -->
                <?php

                        $sql="select titulo, conteudo,imagem from tbl_filme_mes where ativo = 1";
                        $select = mysqli_query($conexao, $sql);
                        while($rs=mysqli_fetch_array($select))
                        { 
                         ?>
                
                <div  class="caixa_filme_mes center">
                    <!--  Titulo do filme do mês-->
                    <div class="titulo_filme_mes center_vertical "><?php echo($rs['titulo']); ?></div>
                    <!-- Imagem do filme do mês -->
                    <figure class="imagem_filme_mes center">
                        <img alt="imagem1" src="imagens/filme_mes/<?php echo($rs['imagem']);?>">
                    </figure>
                    <!--  Texto do filme do mês-->
                    <div class="descricao_filme_mes center">
                        <p> <?php echo($rs['conteudo']); ?></p> 
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        <!-- Rodapé do site -->
        <?php include'footer.php' ?>
    </body>
</html>
