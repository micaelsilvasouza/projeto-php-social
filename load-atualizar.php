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

        div{
            width: 100px;
            height: 100px;
            border-bottom: 5px solid #00f0aa;
            border-radius: 50%;
            animation: rot 1s linear infinite;
            position: absolute;
            top: calc(50vh - 100px);
            left: calc(50vw - 100px);
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
    require_once "arquivos.php"; 
    $usuario = $_POST["usu"] ?? 'exemplo';
    $arq_usuario = fopen("dados/usuarios/$usuario/informacao.txt", "r");
    $dados_atuais = transcreverArquivo($arq_usuario, true);
    $dados_novos = [
            $_POST["nome"]??$dados_atuais[0], 
            $_POST["ano"]??$dados_atuais[1], 
            $dados_atuais[2],
            $dados_atuais[3]
        ];
    fclose($arq_usuario);
    //Verificando se houve alteração nos dados
    if($dados_atuais != $dados_novos){
        $dados_atuais = $dados_novos;
        $arq_usuario = fopen("dados/usuarios/$usuario/informacao.txt", "w");
        foreach($dados_novos as $dado){
            escreverArquivo($arq_usuario,$dado);
        }
    }
    
    /*var_dump($dados_atuais);
    echo "<br>dados/usuarios/$usuario/informacao.txt<br>";
    var_dump($dados_novos)*/
    
    ?>
    <form id="form" action="usuario.php" method="post">
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