<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha</title>
    <style>
        body{
            background-color: white;
        }
        p.men{
            background-color: red;
            color: white;
            text-align: center;
            width: 250px;
            padding: 10px;
        }

        input#usu{
            display: none;
        }
    </style>
</head>
<body onload="removerMensagem()">
    <?php 
        require_once "arquivos.php";
        $usuario = $_POST["usu"]??"Luciano";
        $atual = $_POST["atual"]??"";
        $nova = $_POST["nova"]??"";

        //Pegando os dados do usuario
        $arquivo_usu = fopen("dados/usuarios/$usuario/informacao.txt", "r");
        $dados = transcreverArquivo($arquivo_usu, true);
        fclose($arquivo_usu);
    ?>
    <h1>Alterar Senha</h1>
    <form id="form" action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
        <input type="text" name="usu" id="usu" value="<?=$usuario?>">
        <div>
            <label for="atual">Senha atual</label>
            <input type="password" name="atual" id="atual" required minlength="8" maxlength="15">
        </div>

        <div>
            <label for="nova">Nova senha</label>
            <input type="password" name="nova" id="nova" required minlength="8" maxlength="15">
        </div>

        <div>
            <label for="conf">Confirmar senha</label>
            <input type="password" id="conf" required minlength="8" maxlength="15">
        </div>

        <div>
            <input id="enviar" type="button" value="Alterar Senha">
        </div>
    </form>
    
    <?php 
        //Verificando se a senha conferem
        $check = false;
        if($atual."\n" == $dados[3]){
            //Alterando o valor da senha e escrevendo 
            $arquivo_usu = fopen("dados/usuarios/$usuario/informacao.txt", "w");
            $dados[3] = $nova;
            foreach($dados as $dado){
                escreverArquivo($arquivo_usu, $dado);
            }
            fclose($arquivo_usu);
            $check = true;
            echo "
                <p class='men' style='background-color: green'>
                    Senha alterada com sucesso
                </p>
            ";
        }elseif($atual != ""){
            echo "
                <p class='men'>
                    A senha digitada não confere com a atual
                </p>
            ";
        }
    ?>

    <form id="formusu" action="usuario.php" method="post">
        <input type="text" name="usu" id="usu" value="<?=$usuario?>">
    </form>
    <?php //var_dump($dados)?>
    <script>
        let check = "<?=$check?>"
        let form = document.getElementById("form")
        let enviar = document.getElementById("enviar")
        enviar.addEventListener("click", validarSubmit)

        if(check){
            setTimeout(()=>{
                form = document.getElementById("formusu")
                form.submit()
            },500)
        }

        function validarSubmit(){ 
            //Avalia se a nova senha e o conf da senha são iguais
            let atual = document.getElementById("atual").value
            let nova = document.getElementById("nova").value
            let conf = document.getElementById("conf").value
            let men = document.createElement("p")
            men.setAttribute("class", "men")
            //Verificar tamanho da senha(nova, atual, conf)
            if(atual.length>=8 && nova.length >= 8 && conf.length >=8 && atual.length<=15 && nova.length<=15 && conf.length<=15){
                if(conf == nova){
                    //Enviar o formulário
                    form.submit()
                }else{
                    //Mensagem de erro
                    men.innerHTML = "Senha não Confirmada"
                    document.body.appendChild(men)
                    removerMensagem()
                }
            }else{
                men.innerHTML = "A senha precisa ter entre 8 a 15 digitos"
                document.body.appendChild(men)
                removerMensagem()
            }
            //Verifica os valores de senha(nova, conf)
            
        }

        function removerMensagem(){
            let men=document.querySelectorAll(".men")
            if(men){
                setTimeout(()=>{
                    for(m of men){
                        m.style.display = "none"
                    }
                    
                }, 2000)
            }
        }
    </script>
</body>
</html>