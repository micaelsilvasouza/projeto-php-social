<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Cadastro</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cadastro-login.css">

    <style>
        @media screen and (min-width: 700px) {
            main > h1{
                padding-top: 66px;
                padding-bottom: 70px;
            }
        }
    </style>
</head>
<body>
    <?php 
        require_once "arquivos.php"; 
        $usuario = $_COOKIE["usuario"] ?? 'exemplo';
        $arq_usuario = fopen("dados/usuarios/$usuario/informacao.txt", "r");
        $dados_atuais = transcreverArquivo($arq_usuario, true);
    ?>
    <main>
        <h1>Atualizar Cadastro</h1>
        <form id="form" action="load-atualizar.php" method="post">
            <div>
                <label for="nome">Nome </label>
                <input type="text" name="nome" id="nome" value="<?=$dados_atuais[0]?>">
            </div>
            <div>
                <label for="ano">Data de nacimento </label>
                <input type="number" name="ano" id="ano" value="<?=(int)$dados_atuais[1]?>">
            </div>
            <div>
                <input type="submit" value="Atualizar">
            </div>
        </form>
    </main>
    <a href="usuario.php">Voltar</a>
</body>
</html>