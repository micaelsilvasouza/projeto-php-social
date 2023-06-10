<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body{
            background-color: white;
        }
        p.men{
            display: block;
            text-align: center;
            background-color: red;
            color: white;
            width:  250px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <?php 
        //Importações
        require_once "arquivos.php";   
    ?>
    <?php 
        $arquvio_usu = fopen("dados/usuarios.txt", "r");
        $usuarios = transcreverArquivo($arquvio_usu);
        fclose($arquvio_usu);
        $usuario = $_POST["usu"]??"";
        $senha = $_POST["sen"]??"";
    ?>
    <h1>Login</h1>
    <form id="form" action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
        <label for="usu">Usuário</label>
        <input type="text" name="usu" id="usu" value="<?=$usuario?>" required>
        <br>
        <label for="sen">Senha</label>
        <input type="password" name="sen" id="sen" value="<?=$senha?>" required>
        <br>
        <input type="submit" value="Entrar">
    </form>
    <?php 
        //var_dump($usuarios);
        $check = false;
        //Verificar se foi enviado nome de usuario
        if(strlen($usuario) > 0 ){
            //Verificando se o usuario existe
            foreach ($usuarios as $usu){
                if($usu[0] == $usuario || $usu[1]==$usuario){
                    $usuario = $usu[0];
                    $check = true;
                    break;
                }
            }
            if(!$check){
                //Informando que o usuario não existe
                echo "
                    <p class='men'>
                        Usuario $usuario não foi cadastrado.
                    </p>
                ";
            }
        }
        //Verificando se o usuario existe
        if($check){
            //Acessando as infomações cadastradss
            $arquvio_usu = fopen("dados/usuarios/$usuario/informacao.txt","r");
            $info = transcreverArquivo($arquvio_usu, true);
            //var_dump($info[3]);
            //var_dump($senha);
            fclose($arquvio_usu);
            //Verificando se a senha esta correta
            if($senha."\n" == $info[3]){
                $check = true;
            }else{
                $check = false;
                echo "
                <p class='men'>
                    Senha incorreta.
                </p>
                ";
            }
        }
    ?>
    <a href="cadastro.php">Cadastrar-se</a>
    <script>
        let check = "<?=$check? true:false?>"
        let usuario = "<?=$usuario?>"
        let form = document.getElementById("form")
        let men = document.getElementsByClassName("men")[0]
        let usu = document.getElementById("usu")
        //console.log(check)
        if(check){
            console.log("enviar")
            form.setAttribute("action", "usuario.php")
            usu.value = usuario
            form.submit()
        }
        if(men){
            setTimeout(()=>{men.style.display = "none"},2000)
        }
        
    </script>
</body>
</html>