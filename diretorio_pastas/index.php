<?php
    require_once('bd/conexao.php');
    $conexao = conexaoMysql();
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <link rel="icon" href="imagens/ICONES/icone.png">
        <title>
            HOME
		</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel='stylesheet' type="text/css" href="css/menu_lateral.css">
        <script src="js/jssor.slider-27.5.0.min.js" >
        </script>
        <script src='js/jquery.js'></script>
        <script src="js/menu.js"></script>
        <script src="js/slide.js"></script>
        <link rel="stylesheet" type="text/css" href="css/slider.css"> 
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
        <!-- Header do site-->
        <?php include 'header.php'?> 
        
        <!--Area do slider -->
        <!--Desktop -->
        <div id="slider" class="center">
            <?php include('slide.php')?>
        </div>
        <!--Mobile -->
        <div id='imagem_fixa_home'></div>
        <!-- Caixa principal de todas as telas -->
        <div id="faixa_principal" class="center">
            
            <!--Area para a navegação lateral -->
            <!--desktop-->
            <nav id="menu_itens">
                <?php 
                    $sql = 'select * from tbl_categoria where ativo = 1';
                    $select = mysqli_query($conexao, $sql);
            
                    while($rs=mysqli_fetch_array($select)){ 
                        $id_categoria = $rs['id_categoria'];
                ?>
                    <div class="itens_menu">
                        <?php echo($rs['categoria']) ?>
                        
                        <?php 
                        $sql_submenu = 'select * from tbl_subcategoria where id_categoria ='.$id_categoria;
                        
                        $select_sub = mysqli_query($conexao,$sql_submenu);
                         while($rs_submenu=mysqli_fetch_array($select_sub)){
                        ?>
                        <div class='itens_menu_submenu'> <?php echo($rs_submenu['subcategoria'])?> </div>
                        <?php } ?>
                    </div>
                <?php } ?>                  
            </nav>
             <!--Area para a navegação lateral -->
            <!--mobile-->
            <nav id='menu_lateral'>
                <?php include('menu/menu_lateral.html')?>
            </nav>
            <!--Conteudo onde comportam todas as caixas de filmes -->
                <div id="conteudo">
                    <?php
                        $sql = 'select tbl_produto.*, tbl_produto_categoria.ativo 
                        from tbl_produto join tbl_produto_categoria
                        on tbl_produto_categoria.id_produto = tbl_produto.id_produto
                        where tbl_produto_categoria. ativo = 1 order by rand()';
        
                        $select=mysqli_query($conexao, $sql);
                    while($rs=mysqli_fetch_array($select))
                    {
                ?>
                    <!-- Caixa filme -->
                    <div class="caixa_conteudo center">
                        <!-- Imagem do filme-->
                        <figure class="imagem_conteudo center">
                            <img alt="<?php echo($rs['nome_produto'])?>" src="imagens/produtos/<?php echo($rs['imagem'])?>">
                        </figure>
                        <!-- Sobre o filme -->
                        <div class="conteudo_filme center">
                            <p><span>Nome:</span><?php echo($rs['nome_produto'])?></p>
                            <p><span>Descrição:</span> <?php echo($rs['descricao'])?></p>
                            <p><span>Preço:</span>R$:<?php echo($rs['preco'])?></p>
                            <a>
                                <span class="detalhes" onclick="visualizarDados()">
                                    Detalhes
                                </span>
                            </a>
                        </div>
                    </div>   
                    <?php } ?>
                </div>
        </div>
        <!-- Rodapé do site -->
        <?php include'footer.php'?>
        <!-- Scrip do slider -->
        <script>jssor_1_slider_init();</script>
    </body>
</html>
