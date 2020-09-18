const btnAdmSistema = document.getElementById("administrador_sistema");
const btnAdmFaleConosco = document.getElementById("administrador_fale_conosco");
const btnAdmUsuarios = document.getElementById("administrador_usuarios");
const btnAdmProdutos = document.getElementById("administrador_produtos");

let divAdmSistema = document.getElementById('a');
let divAdmFaleConosco = document.getElementById('b');
let divAdmProdutos = document.getElementById('c');
let divAdmUsuarios = document.getElementById('d')

let qualPag = localStorage.getItem("pagina");


const displayConteudoSistema = () =>{
    divAdmSistema.style.display="block";
    divAdmFaleConosco.style.display="none";
    divAdmUsuarios.style.display="none";
    divAdmProdutos.style.display="none";
    localStorage.setItem("pagina", "conteudo_sistema");
}

const displayConteudoFaleConosco = () =>{
    divAdmSistema.style.display="none";
    divAdmFaleConosco.style.display="block";
    divAdmUsuarios.style.display="none";
    divAdmProdutos.style.display="none";
    localStorage.setItem("pagina", "fale_conosco");
    
}
const displayConteudoUsuarios = () =>{
    divAdmSistema.style.display="none";
    divAdmFaleConosco.style.display="none";
    divAdmUsuarios.style.display="block";
    divAdmProdutos.style.display="none";
    localStorage.setItem("pagina", "administrador_usuarios");
}

const displayConteudoProdutos = () =>{
    divAdmSistema.style.display="none";
    divAdmFaleConosco.style.display="none";
    divAdmUsuarios.style.display="none";
    divAdmProdutos.style.display="block";
    localStorage.setItem("pagina", "administrador_produtos");
}


if(qualPag == "conteudo_sistema")
{
    divAdmSistema.style.display="block";
    divAdmFaleConosco.style.display="none";
    divAdmUsuarios.style.display="none";
    divAdmProdutos.style.display="none";
}
else if(qualPag == "fale_conosco")
{
    divAdmSistema.style.display="none";
    divAdmFaleConosco.style.display="block";
    divAdmUsuarios.style.display="none";
    divAdmProdutos.style.display="none";
} 
else if(qualPag == "administrador_usuarios")
{
    divAdmSistema.style.display="none";
    divAdmFaleConosco.style.display="none";
    divAdmUsuarios.style.display="block";
    divAdmProdutos.style.display="none";
}
else if(qualPag == "administrador_produtos")
{
    divAdmSistema.style.display="none";
    divAdmFaleConosco.style.display="none";
    divAdmUsuarios.style.display="none";
    divAdmProdutos.style.display="block";
}





btnAdmSistema.addEventListener("click", displayConteudoSistema);
btnAdmFaleConosco.addEventListener("click", displayConteudoFaleConosco);
btnAdmUsuarios.addEventListener("click", displayConteudoUsuarios);
btnAdmProdutos.addEventListener("click", displayConteudoProdutos);
