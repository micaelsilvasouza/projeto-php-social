<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina do Usuario</title>
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
        $inform_usu = fopen("dados/usuarios/".$usu."/informacao.txt","r");
        $usuario = transcreverArquivo($inform_usu,true);

        $nome = $usuario[0];
        $nasc = $usuario[1];
        $email = $usuario[2];
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
        <form id="formalt" action="atualizar.php" method="post">
            <input type="text" name="usu" class="usu" value="<?=$usu?>">
            <input id="altcad" type="button" value="Atualizar Cadastro">
            <input id="altsen" type="button" value="Alterar Senha">
            <input id="proc" type="button" value="Procurar">
        </form>

        <iframe src="postar.php" frameborder="1" ></iframe>

        <?php
            $arq_posts = fopen("dados/usuarios/$usu/posts.txt","r");
            $posts = transcreverArquivo($arq_posts);
            feof($arq_posts);
            foreach (array_reverse($posts) as $post) {
                echo "<div><h1>$nome</h1>";
                if(strlen($post[0]) > 0){
                    echo "<p>$post[0]</p>";
                }
                if (count($post) > 2){
                    if($post[2] == "imagem"){
                        echo "<img class='imagepost' src='dados/usuarios/$usu/imagens/$post[1]' alt='post/image'>";
                    }
                    if($post[2] == "video"){
                        echo "<video src='dados/usuarios/$usu/videos/$post[1]' controls></video>";
                    }
                }
                echo "</div>";
            }
        
        ?>
    </main>
</body>
</html>