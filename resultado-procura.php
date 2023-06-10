<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Nome</title>
    <style>
        body{
            background-color: white;
        }
        input.usu{
            display: none;
        }

        label, span{
            display: inline-block;
            padding: 5px;
            margin-left: 10px;
            margin-bottom: 10px;
            border: 2px solid black;
            border-radius: 5px;
            
        }

        label:hover, span:hover{
            cursor: pointer;
        }

        label:active,span:active{
            background-color: #dddddd;
        }

        input[type="file"]{
            display: none;
        }

        textarea{
            resize: none;
        }

        img.imagepost, video{
            display: block;            
            width: 200px;
            max-height: 200px;
            margin: 10px;
        }
    </style>
</head>
<body>
    <?php
        //Importações
        require_once "arquivos.php";
        $usu = $_POST["usu"]??"exemplo";
        $proc = $_POST["proc"]??"exemplo";
        $inform_usu = fopen("dados/usuarios/".$proc."/informacao.txt","r");
        $procura = transcreverArquivo($inform_usu,true);

        $nome = $procura[0];
        $nasc = $procura[1];
        $email = $procura[2];
        $idade = date("Y") - (int)$nasc;
        //var_dump($usuario);
        fclose($inform_usu);
    ?>
    <h1>Nome: <?=$nome?></h1>
    <h2>Idade: <?=$idade?> </h2>
    <h2>Nascimento: <?=$nasc?></h2>
    <h2>Email: <?=$email?></h2>
    <?php
        $arq_posts = fopen("dados/usuarios/$proc/posts.txt","r");
        $posts = transcreverArquivo($arq_posts);
        fclose($arq_posts);
        if(count($posts) > 0){
            foreach (array_reverse($posts) as $post) {
                if(strlen($post[0]) > 0){
                    echo "<p>$post[0]<p>";
                }
                if (count($post) > 2){
                    if($post[2] == "imagem"){
                        echo "<img class='imagepost' src='dados/usuarios/$proc/imagens/$post[1]' alt='post/image'>";
                    }
                    if($post[2] == "video"){
                        echo "<video src='dados/usuarios/$proc/videos/$post[1]' controls></video>";
                    }
                }
                
            }
        }else{
            echo "<p>Não Há Nenhuma Publicação</p>";
        }
    ?>
</body>
</html>