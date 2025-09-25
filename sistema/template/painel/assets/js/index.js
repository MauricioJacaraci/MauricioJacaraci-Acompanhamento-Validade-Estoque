const urlQuantidade = document.getElementById('url_atualizar_quantidade').dataset.urlQuantidade;

document.querySelectorAll(".editavel").forEach(function (td) {
  td.addEventListener("click", function () {
    if (td.querySelector("input")) return;

    let valorAntigo = td.innerText.trim();
    td.innerText = "";

    let input = document.createElement("input");
    input.type = "text";
    input.value = valorAntigo;
    input.style.width = "100%";

    td.appendChild(input);
    input.focus();

    function salvar() {
      let novoValor = input.value.trim();
      let produtoId = td.getAttribute("data-id");

      // Se não mudou nada, apenas volta
      if (novoValor === valorAntigo) {
        td.innerText = valorAntigo;
        return;
      }

      td.innerText = novoValor;

      // Envia via POST para o backend
      fetch(urlQuantidade, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "id=" + encodeURIComponent(produtoId) +
          "&quantidade=" + encodeURIComponent(novoValor)
      })
        .then(res => res.text())
        .then(resposta => {
          console.log("Servidor:", resposta);
        })
        .catch(err => {
          console.error("Erro:", err);
          td.innerText = valorAntigo; // volta valor antigo se der erro
          alert("Erro ao atualizar produto!");
        });
    }

    input.addEventListener("blur", salvar);
    input.addEventListener("keypress", function (e) {
      if (e.key === "Enter") {
        salvar();
      }
    });
  });
});
