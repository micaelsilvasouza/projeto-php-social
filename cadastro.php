<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Usuario</title>
    <style>
        body{
            background-color: antiquewhite;
        }
    </style>
</head>
<body>
    <?php
        #Importações
        require_once "arquivos.php";
        $arquivo_usu = fopen("dados/usuarios.txt","r");
        $usuarios = transcreverArquivo($arquivo_usu);
        fclose($arquivo_usu)
    ?>

    <?php 
        $arquivo_usu = fopen("dados/usuarios.txt", "a");
        $nome = $_POST["nome"]??"";
        $nasc = $_POST['nasc']??"";
        $usuario = $_POST["usu"]??"";
        $email = $_POST["email"]??"";
        $senha = $_POST["sen"]??"";
        $check = false;
    ?>

    <h1>Cadastro Usuario</h1>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <div>
            <label for="nome">Nome: </label>
            <input type="text" name="nome" id="nome" placeholder="Nome Sobrenome" value="<?=$nome
            ?>" required>
        </div>
        <div>
            <label for="nasc">Ano de Nascimento</label>
            <input type="number" name="nasc" id="nasc" placeholder="2000" value="<?=$nasc?>" required>
        </div>
        <div>
            <label for="usu">Nome de Usuario: </label>
            <input type="text" name="usu" id="usu" value="<?=$usuario?>" placeholder="Usuario_exe" required>
            <span class="men"></span>
        </div>
        
        <div>   
            <label for="email">Email: </label>
            <input type="email" name="email" id="email"  value="<?=$email?>" placeholder="exemplo.usu@email" required>
            <span class="men"></span>
        </div>
        
        <div>
            <label for="sen">Senha: </label>
            <input type="password" name="sen" id="sen" minlength="8" maxlength="15" required>
            <span class="men"></span>
        </div>
       
        <div>
            <input type="submit" value="Cadastrar">
        </div>
    </form>
    <?php 
        if($usuario != "" and $email != "" and $senha != ""){
            for($u = 0; $u < count($usuarios); $u += 1){
                if(!in_array($usuario, $usuarios[$u])){
                    $check = true;
                }else{
                    echo "Usuario $usuario já cadastrado";
                    $check = false;
                    break;
                }
                if(!in_array($email, $usuarios[$u])){
                    $check = true;
                }else{
                    echo "Email $email já cadastrado";
                    $check = false;
                    break;
                }
            }
        }
        if($check){
            fwrite($arquivo_usu, "$usuario|$email|$nome\n");
            criarArquivosUsuario($usuario,$nome, $nasc,$email,$senha);
            echo("Usuario Cadastrado com sucesso");
        }
        fclose($arquivo_usu)
    ?>
    <br>
    <a href="index.php">Voltar ao Login</a>
</body>
</html>