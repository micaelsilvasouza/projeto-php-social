<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Nome</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pagina-usuario.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Unbounded:wght@200;300;400;500;600;700;800;900&display=swap');
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
    <header>
        <h1><?=$nome?></h1>
        <div>
            <span><?=$email?></span>
            <span><?=$idade?> anos</span>
        </div>
    </header>
    <main>
        <?php
            $arq_posts = fopen("dados/usuarios/$proc/posts.txt","r");
            $posts = transcreverArquivo($arq_posts);
            fclose($arq_posts);
            if(count($posts) > 0){
                foreach (array_reverse($posts) as $post) {
                    echo"<div><h1>$nome</h1>";
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
                    echo "</div>";
                }
            }else{
                echo "<div><h1>Não Há Nenhuma Publicação</h1></div>";
            }
        ?>
    </main>
</body>
</html>