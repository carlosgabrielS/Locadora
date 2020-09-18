<?php
    if (isset($_GET['codigo']))
    {
        //conexão com o banco
        require_once('bd/conexao.php');
        $conexao = conexaoMysql();

        $codigo = $_GET['codigo'];
        $sql = "select * from tbl_fale_conosco where codigo=".$codigo;
        $select = mysqli_query($conexao, $sql);

        //rs = record set ... nomenclatura usada antigamente para definir retorno dos dados de um banco
        if($rscontato=mysqli_fetch_array($select))
        {
            $nome = $rscontato['nome'];
            $telefone = $rscontato['telefone'];
            $celular = $rscontato['celular'];
            $email = $rscontato['email'];
            $home_page = $rscontato['home_page'];
            $facebook = $rscontato['facebook'];
            $sugestao = $rscontato['sugestao'];
            $produto = $rscontato['produto'];
            $sexo = $rscontato['sexo'];
            $profissao = $rscontato['profissao'];

        }
    }


?>
        <script>
            $(document).ready(function(){

                $('#fechar').click(function(){
                    $('#container').fadeOut(1000);


                });

            });
        </script>

<div id="fechar">
    <a href="#"> X</a>
</div>
<table id="visualizar_fale_conosco_cms">
	
    <tr>
        <th>Nome: </th>
        <td><?php echo($rscontato['nome']) ?></td>
    </tr>
    <tr>
        <th>Telefone: </th>
        <td><?php echo($rscontato['telefone']) ?></td>
    </tr>
    <tr>
        <th>Celular: </th>
        <td><?php echo($rscontato['celular']) ?></td>
    </tr>
    <tr>
        <th>E-mail: </th>
        <td><?php echo($rscontato['email']) ?></td>
    </tr>
    <tr>
        <th>Home-page: </th>
        <td><?php echo($rscontato['home_page']) ?></td>
    </tr>
    <tr>
        <th>Facebook: </th>
        <td><?php echo($rscontato['facebook']) ?></td>
    </tr>
    <tr>
        <th>Produto: </th>
        <td><?php echo($rscontato['produto']) ?></td>
    </tr>
		<?php 
				$sexo = $rscontato['sexo'];
				if($sexo == "m"){
					$sexo = "Masculino";
				}else{
					$sexo = "Feminino";
				}
		echo '

				<tr>
					<th> Sexo: </th>
					<td>' .$sexo .'</td>
				</tr>
		';
		?> 
    
    <tr>
        <th>Profissão: </th>
        <td><?php echo($rscontato['profissao']) ?></td>
    </tr>
		<tr>
        <th>Sugestão: </th>
        <td>
            <div id="conteudo_sugestao">
                <?php echo($rscontato['sugestao']) ?>
            </div>
        </td>
    </tr>
</table>