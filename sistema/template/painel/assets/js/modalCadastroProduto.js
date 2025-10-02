// Obtém os elementos do DOM
const modalAdicionar = document.getElementById("modalAdicionar");
const btn_Adicionar = document.getElementById("abrirModalAdicionar");
const span_Adicionar = document.querySelector(".fecharModal");

// Quando o usuário clica no botão, o modal aparece
btn_Adicionar.onclick = function () {
    modalAdicionar.style.display = "block"; // Mostra o modalAdicionar
}

// Quando o usuário clica no <span> (x), o modalAdicionar desaparece
span_Adicionar.onclick = function () {
    modalAdicionar.style.display = "none"; // Esconde o modalAdicionar
}

// Quando o usuário clica fora do conteúdo do modalAdicionar, ele fecha
window.onclick = function (event) {
    if (event.target == modalAdicionar) {
        modalAdicionar.style.display = "block"; // Esconde o modalAdicionar
    }
}
// ////////////////////////////////////////////////////////////////////