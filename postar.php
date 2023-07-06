<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de postagem</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/postagem.css">
</head>
<body>
    <?php 
        $usuario = $_COOKIE["usuario"]??"exemplo";
    ?>
    <form id="form" action="load-post.php" method="post" enctype="multipart/form-data">
        <input type="text" name="usu" class="usu" value="<?=$usuario?>">
        <input type="file" name="file" id="file">
        <div>
            <label id="imagem" for="file">IMG</label>
            <label id="video" for="file">VID</label>
            <input id="enviar" type="button" value="Publicar">
        </div>
        <div>
            <textarea name="post" id="post" cols="50" rows="3" placeholder="Nova Publicação"></textarea>
        </div>
    </form>

    <script src="js/postagem.js"></script>
</body>
</html>