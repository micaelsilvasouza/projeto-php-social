<?php 
function transcreverArquivo($arquivo, $porlinha = false){
    /*
    Transcreve as informações contidade dentro de cada 
    linha de um arquivo de texto e retorna uma array com os 
    valores
    param:$arquivo: Arquivo de texto
    param:$porlinha: Separa as informações apenas por linha 
    padrão = false
    return:$dados: Array com as informações obtidas
    */
    $dados = [];
    if(!$porlinha){
        while (!feof($arquivo)){
            $linha = fgets($arquivo);
            $linhadados = [];
            $dado = "";
            if(strlen($linha) > 0){
                for($i = 0; $i < strlen($linha); $i++){
                    if($linha[$i] == "|" || $linha[$i] == "\n"){
                        array_push($linhadados,$dado);  
                        $dado = ""; 
                    }else{
                        $dado.= $linha[$i];
                    }
                }
                array_push($dados,$linhadados);
            }
        }
    }else{
        while(!feof($arquivo)){
            $linha = fgets($arquivo);
            if($linha != "\n" && strlen($linha) > 0){
                //echo "dado $linha";
                array_push($dados,$linha);
            }
        }
    }
    return $dados;
}


function criarArquivosUsuario($usuario, $nome, $nasc, $email,$senha){
    mkdir("dados/usuarios/$usuario");
    mkdir("dados/usuarios/$usuario/imagens");
    mkdir("dados/usuarios/$usuario/videos");
    $inform = fopen("dados/usuarios/$usuario/informacao.txt", "x+");
    $post = fopen("dados/usuarios/$usuario/posts.txt","x+");
    fwrite($inform, "$nome\n$nasc\n$email\n$senha\n");
    fclose($inform);
    fclose($post);
}

function escreverArquivo($arquivo, $escrever, $adicional="",$formato=""){
    //Verficando se é escrever no arquivo adiconando informações separados na mesma linha
    if(strlen($adicional)){
        $escrever = "$escrever|$adicional|$formato";
        //verificando o final para ver se necessita de \n
        $tam = strlen($escrever);
        if($escrever[$tam-1] != "\n"){
            $escrever.="\n";
        }
        fwrite($arquivo, $escrever);
    }else{
        //verificando o final para ver se necessita de \n
        $tam = strlen($escrever);
        if($escrever[$tam-1] != "\n"){
            $escrever=$escrever."\n";
            //echo "Não Tem $escrever";
        }
        fwrite($arquivo, $escrever);
    }
}

function salvarArquivosEnviados($usuario,$enviado,$formato){
    $nome = $enviado["name"];
    if($formato == "imagem"){
        move_uploaded_file($enviado["tmp_name"], "dados/usuarios/$usuario/imagens/".$nome);
    }
    if($formato == "video"){
        move_uploaded_file($enviado["tmp_name"], "dados/usuarios/$usuario/videos/".$nome);
    }
}