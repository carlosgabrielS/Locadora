<?php
    require_once('bd/conexao.php');
    $conexao = conexaoMysql();


?>

<!doctype html>
<html lang="pt-br">
	<head>
        <link rel="icon" href="imagens/ICONES/icone.png">
        <title>
            Nossas Lojas
		    </title>
        <script src='js/jquery.js'></script>
        <script src="js/menu.js"></script>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">     
        
      </head>
	<body>
        <!-- Header do site -->
        <?php include'header.php' ?> 
            <!-- onde todo o conteúdo do site estará  -->
            <div id="faixa_principal" class="center">
                <h1>Nossas Lojas</h1>
                <?php 
                    $sql = 'SELECT * FROM tbl_nossas_lojas where ativo = 1';
                    $select = mysqli_query($conexao, $sql);

                    while($rs=mysqli_fetch_array($select))
                    {                
                ?>
                <!-- Area escrita do conteúdo da loja -->
                <div id="conteudo_lojas" class="center">
                    <h2><?php echo($rs['titulo'])?></h2>
                    <p><?php echo($rs['conteudo'])?><p>
                </div>
                    
                <!--Todas as imagens estarão dentro dessa caixa -->
                <div id="image_shop" class="center"> 
                    <figure class="imagem_lojas">
                        <img alt="imagem1" src="imagens/nossas_lojas/<?php echo($rs['imagem1']);?>">
                    </figure>
                    <figure class="imagem_lojas">
                        <img alt="imagem2" src="imagens/nossas_lojas/<?php echo($rs['imagem2']);?>">
                    </figure>
                </div>
                <?php } ?>
            </div>
            <!-- Rodapé -->
        <?php include'footer.php' ?>
    </body>
</html>