<?php
    require_once('bd/conexao.php');
    $conexao = conexaoMysql();
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <link rel="icon" href="imagens/ICONES/icone.png">
        <title>
            Sobre a ACME
		</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
	<body>
         <!-- Area do cabeçalho-->       
        <?php include'header.php' ?> 
            <!--Area do conteúdo -->    
            <div id="faixa_principal" class="center">
                <div id="conteudo_sobre" class="center">
                    <h1>Sobre Acme</h1>
                    <?php

                        $sql="SELECT conteudo,imagem from tbl_sobre where ativo = 1";
                        $select = mysqli_query($conexao, $sql);
                        while($rsloja=mysqli_fetch_array($select))
                        {

                        echo($rsloja['conteudo']); ?>
                    <div id="imagem_sobre">
                        <img alt="empresa" title="empresa" src="imagens/sobre/<?php echo($rsloja['imagem']); ?>">
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        <!-- Rodapé-->        
        <?php include'footer.php' ?>
    </body>
</html>
