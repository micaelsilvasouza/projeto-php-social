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
//Adiconando os eventos e funções dos elementos
imagem.addEventListener("click", mudarFormato)
video.addEventListener("click", mudarFormato)
file.addEventListener("input", verficarFile)
enviar.addEventListener("click", verificarSubmit)

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

function mudarFormato(){
    //Muda o formato aceito pelo input file com o id file
    if(this.innerHTML.toLowerCase() == "img"){
        file.setAttribute("accept", "image/*")
    }
    if(this.innerHTML.toLowerCase() == "vid"){
        file.setAttribute("accept", "video/*")
    }
}

function verificarSubmit(){
    /*Verifica se as condições de submit foram 
    atendias para poder enviar o form ou formalt*/
    //Post ou File precisam ter algo para enviar
    console.log("tentando enviar")
    if((post.value.length > 0 || file.files.length > 0) && this.id.toLowerCase() == "enviar"){
        //enviar formulario form
        console.log("Pode enviar")
        this.form.submit()
    }else{
        console.log("error")
    }
}