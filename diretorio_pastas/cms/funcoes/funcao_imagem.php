<?php function tratarImagem($fle, $diretorio){
    
                //arquivos permitidos no upload
        $arquivos_permitidos = array(".jpg",".jpeg",".png");
              
        //        nome do arquivo a ser upado para o servidor
        $arquivo = $fle['name'];
        //        tamanho do arquivo a ser upado para o servidor
        $tamanho_arquivo =$fle['size']; 
        
        //        transforma o valor do arquivo de bytes em kbytes, para facilitar o tratamento de tamanho de arquivo
        $tamanho_arquivo = round($tamanho_arquivo/1024);
        
        //        guarda somente a extensão do arquivo
        $extensao_arquivo = strrchr($arquivo,'.');
        
        //        guarda somente o nome do arquivo, utulizando a função pathinfo
        $nome_arquivo = pathinfo($arquivo,PATHINFO_FILENAME);
        
        //        uniqid - gera uma sequencia numerica aleatoria baseado em informações de hardware, porém estamos agregando hora, minuto e segundo para gerar uma hash totalmente única
        $arquivo_criptografado = md5(uniqid(time()).$nome_arquivo);
        
        //        criamos o nome com a extensão do arquivo (já criptografado) que será enviada para o servidor
        $fotoBanco = $arquivo_criptografado . $extensao_arquivo;
    
        if(in_array($extensao_arquivo, $arquivos_permitidos))
        {
            if($tamanho_arquivo <=5000)
            {
                //caminho do diretorio temportário que a imagem foi guardada pelo servidor
                $arquivo_temp = $fle['tmp_name'];
    
                if(move_uploaded_file($arquivo_temp, $diretorio.$fotoBanco))
                {
                   return $fotoBanco;
                }
                else
                {
                    return null;
                }
            }else
            {
                echo("tamanho de arquivo inválido");
            }
                
        }else
        {
            return null;
        } 
 
}
?>