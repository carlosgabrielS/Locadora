<?php
    require_once('bd/conexao.php');
    $conexao = conexaoMysql();

?>

<!doctype html>
<html lang="pt-br">
	<head>
        <link rel="icon" href="imagens/ICONES/icone.png">
        <title>
            Promoções
		    </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src='js/jquery.js'></script>
        <script src="js/menu.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      </head>
	   <body>
        <?php include'header.php'?> 
            <div id="faixa_principal" class="center">
                <h1>Promoções</h1>
                <!-- Caixas nas quais as promoções estão, cabem 2 por faixa-->
                <?php 
                    $sql = 'select img_filme, tbl_promocao.id as cod_promo, tbl_promocao.ativo, nome_filme, preco, promocao, descricao
                            from tbl_filme join tbl_promocao 
                            on id_filme = tbl_filme.id
                            where tbl_promocao.ativo = 1';

                    
                     $select = mysqli_query($conexao, $sql);

                     while($rs=mysqli_fetch_array($select))
                    { 
                        $preco_final;
                        $preco_final = $rs['preco'] * $rs['promocao']/100;
                ?>
                    <div class="caixa_promocoes">
                        <figure class="imagem_promocoes">
                            <img alt="promoção <?php echo ($rs['cod_promo']);?>" src="imagens/<?php echo ($rs['img_filme']);?>">
                        </figure>
                        <div class="conteudo_promocoes">
                            <p class="titulo_filme_promocao"><?php echo ($rs['nome_filme']);?> </p>
                            <span>de </span><p class="valor_filme_promocao">R$<?php echo ($rs['preco']);?></p>
                            <span>por apenas</span><p class="final_filme_promocao">R$<?php echo ($preco_final);?></p>
                            <!-- <div class="detalhes_promocoes">detalhes</div> -->
                        </div>
                    </div>
                    <?php } ?>   
            </div>
        <!-- Rodapé-->
        <?php include'footer.php' ?>
    </body>
</html>
