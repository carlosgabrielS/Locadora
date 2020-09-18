<?php



//declaração das variáveis ultilizadas no modo = buscar
$nome ="";
$telefone = "";
$celular ="";
$email = "";
$homepage ="";
$linkfacebook =""; 
$sugestao ="";
$produto =""; 
$rdosexof ="";
$rdosexom ="";
$profissao = "";
$botao="Salvar";

//conexão com o banco
require_once('bd/conexao.php');
$conexao = conexaoMysql();


//ação de inserir um novo registro
if(isset($_POST['btnsalvar']))
   {
       $nome = $_POST['txtnome'];
       $telefone = $_POST['txttelefone'];
       $celular = $_POST['txtcelular'];
       $email = $_POST['txtemail'];
       $homepage = $_POST['txthomepage'];
       $linkfacebook = $_POST['txtlinkfacebook'];
       $sugestao = $_POST['txtsugestao'];
       $produto = $_POST['txtinfproduto'];
       $sexo = $_POST['rdosexo'];
       $profissao = $_POST['txtprofissao'];
    

    //Verifica se o valor do botão é "Salvar", se sim, criará a variavel sql para setar os valores no banco
       if($_POST['btnsalvar']=="Salvar"){
            $sql = "insert into tbl_fale_conosco
            (nome, telefone, celular, email, home_page, facebook, sugestao, produto, sexo, profissao)
            values
            ('".$nome."', '".$telefone."','".$celular."', '".$email."', '".$homepage."', '".$linkfacebook."', '".$sugestao."', '".$produto."', '".$sexo."', '".$profissao."' ) 
            ";      
       }
        
    //RECEBE COMO PARAMETRO A CONEXÃO FEITA NO OUTRO ARQUIVO E A STRING SLQ FEIA LOGO ACIMA
    if(mysqli_query($conexao, $sql)){
                    //redireciona para uma nova página
                    header('location:fale_conosco.php');
                }else{
                    //em caso de erro na gravação
                    echo("<script>alert('erro no cadastro') </script>");
                }
   }
?>
<!doctype html>
<html lang="pt-br">
	<head>
        <title>
            Fale Conosco
		</title>
        <link rel="icon" href="imagens/ICONES/icone.png">
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src='js/jquery.js'></script>
        <script src="js/menu.js"></script>
        <script src="js/jquery-3.3.1.js"></script>
        <script src="js/maskformat.js"></script>
    </head>
	<body>
        <!--  Header do site      -->
        <?php include'header.php' ?>
            <!--Onde todos o c onteúdo estará-->
            <div id="faixa_principal" class="center">
                <div id="fale_conosco" class="center">
                    <!-- Formulário do fale conosco -->
                    <form name="frm_fale_conosco" method="post" action="fale_conosco.php">
                        <h1>Fale conosco</h1>
                        <!-- caixa de itens do formulário -->
                        <div class="caixas_formulario_faleconosco">
                            <div class="informacao_fale_conosco">
                                Nome:*
                            </div>
                            <div class="area_escrita_faleconosco">
                                <input type="text" required placeholder="Ex: Maria da Silva" class="obrigatorio" maxlength="60" name="txtnome" pattern="[a-z\s A-Z]+$" value="<?php echo($nome)?>">
                            </div>
                        </div>
                        <!-- caixa de itens do formulário -->
                        <div class="caixas_formulario_faleconosco">
                            <div class="informacao_fale_conosco">
                                Telefone:
                            </div>
                            <div class="area_escrita_faleconosco">
                                <input type="tel" id="txttelefone" placeholder="(11) 2345-6789" name="txttelefone"  pattern="\([0-9]{2}\) [0-9]{4}-[0-9]{4}$" value="<?php echo($telefone)?>">
                            
                                <!-- Máscara de texto do telefone -->
                                <script>
                                    $("#txttelefone").mask("(99) 9999-9999");
                                </script>
                            </div>
                        </div>
                        <!-- caixa de itens do formulário -->
                        <div class="caixas_formulario_faleconosco">
                            <div class="informacao_fale_conosco">
                                Celular:*
                            </div>
                            <div class="area_escrita_faleconosco">
                               <input type="tel" placeholder="(11) 12345-6789" pattern="\([0-9]{2}\) [0-9]{5}-[0-9]{4}$" required id="txtcelular" name="txtcelular" class="obrigatorio" value="<?php echo($celular)?>">
                                
                                <!-- Máscara de texto do celular -->
                                <script>
                                    $("#txtcelular").mask("(99) 99999-9999");
                                </script>
                            </div>
                        </div>
                        <!-- caixa de itens do formulário -->
                        <div class="caixas_formulario_faleconosco">
                            <div class="informacao_fale_conosco">
                               Email:*
                            </div>
                            <div class="area_escrita_faleconosco">
                                 <input type="email" required placeholder="Ex: email@email.com" class="obrigatorio" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="txtemail" maxlength="40" value="<?php echo($email)?>">
                            </div>
                        </div>
                        <!-- caixa de itens do formulário -->
                        <div class="caixas_formulario_faleconosco">
                            <div class="informacao_fale_conosco">
                                home Page:
                            </div>
                            <div class="area_escrita_faleconosco">
                               <input type="text"  placeholder="Digite sua home page" name="txthomepage" maxlength="99" value="<?php echo($homepage)?>"> 
                            </div>
                        </div>
                        <!-- caixa de itens do formulário -->
                        <div class="caixas_formulario_faleconosco">
                            <div class="informacao_fale_conosco">
                                Link do facebook:
                            </div>
                            <div class="area_escrita_faleconosco">
                                <input type="text"  placeholder="digite seu link do facebook" maxlength="99" name="txtlinkfacebook" value="<?php echo($linkfacebook)?>">
                            </div>
                        </div>
                        <!-- caixa de itens do formulário -->
                        <div class="caixas_formulario_faleconosco">
                            <div class="informacao_fale_conosco">
                                Informação do produto:
                            </div>
                            <div class="area_escrita_faleconosco">
                                <input type="text"  placeholder="Informações do produto" maxlength="99" name="txtinfproduto" size="26" value="<?php echo($produto)?>">
                            </div>
                        </div> 
                        <!-- caixa de itens do formulário -->
                        <div class="caixas_formulario_faleconosco">
                            <div class="informacao_fale_conosco">
                                Sexo*
                            </div>
                            <div class="rdo_faleconosco">
                                <label>
                                    <input type="radio" checked required name="rdosexo" value="f" <?php echo($rdosexof)?>>Feminino
                                </label>
                                <label>
                                    <input type="radio" required name="rdosexo" value="m" <?php echo($rdosexom)?>>Masculino<br>
                                </label>
                            </div>
                        </div>
                        <!-- caixa de itens do formulário -->
                        <div class="caixas_formulario_faleconosco">
                            <div class="informacao_fale_conosco">
                                Profissao*:
                            </div>
                            <div class="area_escrita_faleconosco">
                                <input type="text" required placeholder="Ex: Professor" class="obrigatorio" name="txtprofissao" maxlength="30" pattern="[a-z\s A-Z]+$" value="<?php echo($profissao)?>">
                            </div>
                        </div> 
                        <!-- caixa de itens do formulário -->
                        <div class="caixas_formulario_faleconosco_txtarea">
                            <div class="informacao_fale_conosco_textarea">
                                Sugestão/ Crítica:
                            </div>
                            <div class="area_escrita_faleconosco_textarea">
                                <textarea cols="90" placeholder="sugestão ou crítica" maxlength="500" name="txtsugestao" rows="6" ><?php echo($sugestao)?></textarea>
                            </div>
                        </div>
                        <!-- botões do formulário -->
                        <div id="botoes_faleconosco" class="center">
                            <input class="botao" type="submit" name="btnsalvar" value="<?php echo($botao) ?>">
                            <input class="botao" type="reset" name="btnLimpar" value="Limpar">
                        </div>
                    </form>
                </div>         
            </div>
        <!-- Rodapé do site -->
        <?php include'footer.php' ?>
    </body>
</html>