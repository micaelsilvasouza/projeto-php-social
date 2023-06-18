//objeto input button para submit do formalt Cadastro
let altcad = document.getElementById("altcad")
//Objeto input button para submit do formalr senha
let altsen = document.getElementById("altsen")
//Objeto input button para submit de Procura
let proc = document.getElementById("proc")


//Adcionando evento click para mudarFormato
altcad.addEventListener("click", verificarSubmit)
altsen.addEventListener("click", verificarSubmit)
proc.addEventListener("click", verificarSubmit)



function verificarSubmit(){
    /*Verifica se as condições de submit foram 
    atendias para poder enviar o form ou formalt*/
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