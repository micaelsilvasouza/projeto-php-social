<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Cadastro</title>
    <style>
        body{
            background-color: white;
        }      
        span{
            display: inline-block;
            background-color: green;
            color: white;
        }
        input.usu{
            display: none;
        }
    </style>
</head>
<body>
    <?php 
        require_once "arquivos.php"; 
        $usuario = $_POST["usu"] ?? 'exemplo';
        $arq_usuario = fopen("dados/usuarios/$usuario/informacao.txt", "r");
        $dados_atuais = transcreverArquivo($arq_usuario, true);
    ?>
    <h1>Atualizar Cadastro</h1>
    <form id="form" action="load-atualizar.php" method="post">
        <input type="text" name="usu" class="usu" value="<?=$usuario?>">
        <div>
            <label for="nome">Nome: </label>
            <input type="text" name="nome" id="nome" value="<?=$dados_atuais[0]?>">
        </div>
        <div>
            <label for="nome">Ano de Nascimento: </label>
            <input type="number" name="ano" id="ano" value="<?=(int)$dados_atuais[1]?>">
        </div>

        <div>
            <input type="submit" value="Atualizar">
        </div>
    </form>
    <form action="usuario.php" method="post">
        <input type="text" name="usu" class="usu" value="<?=$usuario?>">
    </form>
    <script>
        
    </script>
</body>
</html>