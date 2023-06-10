<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procurar</title>
    <style>
        body{
            background-color: white;
        }
        input.usu, datalist{
            display: none;
        }
        button.btproc{
            display: block;
        }
    </style>
</head>
<body>
    <?php 
        require_once "arquivos.php";
        $usuario = $_POST["usu"]??"exemplo";
        $procura = $_POST["proc"]??0;
        $arquivo_usuarios = fopen("dados/usuarios.txt", 'r');
        $usuarios = transcreverArquivo($arquivo_usuarios);
        fclose($arquivo_usuarios);
        //echo "/$procura/";
    ?>
    <h1>Procurar</h1>
    <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
        <div>
            <label for="proc">Procucar por</label>
            <input type="text" name="proc" list="usuarios">
            <datalist id="usuarios">
                <?php
                    foreach($usuarios as $u){
                        echo "
                            <option value='$u[2]'>
                        ";
                    }
                ?>
            </datalist>
        </div>
        <div>
            <input type="submit" value="Procurar">
        </div>
    </form>

    <form id="formres" action="resultado-procura.php" method="post">
        <input type="text" name="usu" class="usu" value="<?=$usuario?>">
        <input type="text" name="proc" class="usu" id="proc">
        <?php
            if($procura){ 
                $exproc = "/$procura/i";//Expressão regular para procura
                foreach($usuarios as $usu){
                    if(preg_match($exproc, $usu[2])){
                        echo "
                            <button class='btproc' value='$usu[0]'>$usu[2]</button>
                        ";
                    }
                }
            }
        ?>
    </form>

    <script>
        let btprocs = document.querySelectorAll(".btproc")
        let proc = document.getElementById("proc")
        let form = document.getElementById("formres")
        for(let bt of btprocs){
            bt.addEventListener("click", function(){
                proc.value = this.value
                //form.submit()
            })
        }
    </script>
</body>
</html>