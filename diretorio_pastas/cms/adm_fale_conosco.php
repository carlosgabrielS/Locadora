<?php 

/*DECLARAÇÃO DE VARIÁVEIS*/
$nome = "";
$email = "";
$profissao = "";
$celular = "";
$modo ="";
require_once('bd/conexao.php');
$conexao = conexaoMysql();


    if(isset($_GET['modo']))
    {
       //variáveis enviada pelo href para excluir no HTML
        $modo = $_GET['modo'];
        $id = $_GET['id'];
        
//exluir um registro
        if($modo == "excluir")
        {
            $sql = "DELETE FROM tbl_fale_conosco WHERE codigo=".$id;
            mysqli_query($conexao, $sql);
            
            //buscar um registro a ser atualizado
        }elseif($modo == "buscar")
        {
            $sql="select * from tbl_fale_conosco where codigo=".$id;
            $select = mysqli_query($conexao, $sql);
            
            if($rscontato= mysqli_fetch_array($select))
            { 
                $nome = $rscontato['nome'];
                $celular = $rscontato['celular'];                
                $email = $rscontato['email'];        
                $profissao = $rscontato['profissao'];             
            }
        }
    }

?>

    <div id="adm_fale_conosco">
        <form name="frmfaleconosco" method="post" action="index.php">
            <table class="center"> 

                <th class="inform_fale_conosco">
                    Nome
                </th>
                 <th class="inform_fale_conosco">
                     E-mail
                </th>
                <th class="inform_fale_conosco">
                     Profissão
                </th>
                <th class="inform_fale_conosco">
                     Celular
                </th>
                <th class="inform_icon"> 
                     Opções
                </th>
                <?php 

                    $sql= "select * from tbl_fale_conosco order by codigo desc";

                    //guarda o retorno do bv em uma variavel local
                    $select = mysqli_query($conexao, $sql);

                    //mysql_fetch_array transforma uma lidata de retorno do banco
                    // de dados numa matrizde dados
                    while($rscontatos=mysqli_fetch_array($select))
                    {

                    ?>
                <tr>
                    <td><?php echo($rscontatos['nome']) ?></td>
                    <td><?php echo($rscontatos['email']) ?> </td>
                    <td><?php echo($rscontatos['profissao']) ?> </td>
                    <td><?php echo($rscontatos['celular']) ?> </td>
                    <td> 
                        <a href="index.php?modo=excluir&id=<?php echo($rscontatos['codigo']);?>" onclick="return confirm('Deseja realmente excluir');">
                            <img src='imagens/icones/deletar.png'>
                        </a>  
                        <a class="detalhes">  
                            <img class="visualizar" onclick="visualizarDados(<?php echo($rscontatos['codigo']);?>)" src="imagens/icones/visualizar.png" alt="visualizar">
                        </a>

                    </td>
                </tr>
                <?php 
                }              
                ?>
            </table>
        </form>
    
</div>