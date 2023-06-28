<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Load Post</title>
    <style>
        @keyframes rot{
            to{
                transform: rotate(360deg);
            }
        }

        body{
            display: flex;
            align-items: center;
            justify-content: center;
        }

        div{
            width: 20vw;
            height: 20vw;
            border-bottom: 5px solid #00f0aa;
            border-radius: 50%;
            animation: rot 1s linear infinite;
        }
        form{
            display: none;
        }
    </style>
    <?php 
        //Incluido Arquivos php externos
        require_once "arquivos.php";
    ?>
</head>
<body>
    <?php
        //Infomarções enviadas
        $usuario = $_POST["usu"];//String nome usuario
        $post = $_POST["post"];//string para o post
        $file = $_FILES["file"];//arquivo enviado

        //Arrays para verificação de tipo
        $imagem = ["jpg", "jpeg", "png","gif"];//imagens
        $video = ["mp4", "mkv"];//videos

        //Formato do arquivo recebido
        $formato = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    ?>
    <?php 
        //echo !$file['error'] ?$file["name"]:"nda foi enviado";
        //echo basename($file["name"]);
        //echo $formato;
        //var_dump($file);

        //Arquivo do usuario para posts
        $arquivo = fopen("dados/usuarios/$usuario/posts.txt", "a");
        /*Verificando se o arquivo recebido é uma imagem ou 
        um video, e se tem um post para ser colocado*/
        if(in_array($formato, $imagem)){
            //Adicona imagem
            salvarArquivosEnviados($usuario,$file,"imagem");
            escreverArquivo($arquivo, $post,$file["name"],"imagem");
        
        }else if(in_array($formato, $video)){
            //Adicina video
            salvarArquivosEnviados($usuario,$file,"video");
            escreverArquivo($arquivo,$post,$file["name"],"video");
        }else if(strlen($post)>0){
            escreverArquivo($arquivo, $post);
        }
        
    ?>
    <form id="form" action="usuario.php" target="_parent" method="post">
        <input type="text" name="usu" id="usu" value="<?=$usuario?>">
        <input type="submit" value="Continuar">
    </form>
    <div></div>

    <script>
        let form = document.getElementById("form")
        setTimeout(()=>{form.submit()}, 2000)
    </script>
</body>
</html>