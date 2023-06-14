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
        
        <br>
        <form id="form" action="load-post.php" method="post" enctype="multipart/form-data">
            <input type="text" name="usu" class="usu" value="<?=$usu?>">
            <label id="imagem" for="file">IMG</label>
            <label id="video" for="file">VID</label>
            <span id="remover">Remover Arquivo</span>
            <input type="file" name="file" id="file">
            <br>
            <textarea name="post" id="post" cols="50" rows="3" placeholder="Nova Publicação"></textarea>
            <br>
            <input id="enviar" type="button" value="Publicar">
        </form>
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
        <br>
        <a href="index.php">Voltar ao login</a>
    </main>

    <script>
        //objeto input button para submit do formalt Cadastro
        let altcad = document.getElementById("altcad")
        //Objeto input button para submit do formalr senha
        let altsen = document.getElementById("altsen")
        //Objeto input button para submit de Procura
        let proc = document.getElementById("proc")
        //objeto label id imagem
        let imagem = document.getElementById("imagem")
        //objeto label id video
        let video = document.getElementById("video")
        //Objeto input file 
        let file = document.getElementById("file")
        //Objeto form
        let form = document.getElementById("form")
        //Objeto input button para submit do form
        let enviar = document.getElementById("enviar")
        //Objeto textarea id post
        let post = document.getElementById("post")
        //Objeto span id remover
        /*let remover = document.getElementById("remover")
        /*remover.onclick = ()=>{
            file.files = ""
        }*/

        //Adcionando evento click para mudarFormato
        imagem.addEventListener("click", mudarFormato)
        video.addEventListener("click", mudarFormato)
        file.addEventListener("input", verficarFile)
        enviar.addEventListener("click", verificarSubmit)
        altcad.addEventListener("click", verificarSubmit)
        altsen.addEventListener("click", verificarSubmit)
        proc.addEventListener("click", verificarSubmit)

        function mudarFormato(){
            //Muda o formato aceito pelo input file com o id file
            if(this.innerHTML.toLowerCase() == "img"){
                file.setAttribute("accept", "image/*")
            }
            if(this.innerHTML.toLowerCase() == "vid"){
                file.setAttribute("accept", "video/*")
            }
        }

        function verficarFile(){
            //Confere se existe um file, e pega as suas inform
            //verificando se existe um arquivo em file
            if(file.files.length > 0){
                //variavel com o objeto do arquivo
                let arquivo = file.files[0]
                //verificando o tipo do arquivo
                if(arquivo.type.includes("image")){
                    imagem.style.backgroundColor = "#00ffa0"
                    imagem.innerHTML = arquivo.name
                    video.style.backgroundColor = "white"
                    video.innerHTML = "VID"
                }else {
                    video.style.backgroundColor = "#00ffa0"
                    video.innerHTML = arquivo.name
                    imagem.style.backgroundColor = "white"
                    imagem.innerHTML = "IMG"
                }
            }
        }

        function verificarSubmit(){
            /*Verifica se as condições de submit foram 
            atendias para poder enviar o form ou formalt*/
            //Post ou File precisam ter algo para enviar
            if((post.value.length > 0 || file.files.length > 0) && this.id.toLowerCase() == "enviar"){
                //enviar formulario form
                this.form.submit()
            }
            //Verificando se é do formalt
            if(this.form.id == "formalt"){
                //verificando para qual caminho desena
                let act//Determinha para onde será envidado
                if(this.id == "altcad"){
                    act = "atualizar.php"
                }else if(this.id == "altsen"){
                    act = "senha.php"
                }else if(this.id == "proc"){
                    act = "procura.php"
                }
                this.form.action = act
                this.form.submit()
            }
        }
    </script>
</body>
</html>