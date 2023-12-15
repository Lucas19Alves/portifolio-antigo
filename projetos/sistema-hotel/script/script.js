document.addEventListener("DOMContentLoaded", function() {
  // Esta função será executada quando a página estiver completamente carregada

  document.getElementById("submitBtn").addEventListener("click", function () {
    // Obter os valores dos campos do formulário
    var nome = document.getElementById("nome").value;
    var cpf = document.getElementById("cpf").value;
    var data_nascimento = document.getElementById("data_nascimento").value;
    var celular = document.getElementById("celular").value;
    var cidade = document.getElementById("cidade").value;
    var sexo = document.getElementById("sexo").value;

    // Criar um objeto com os dados do cadastro
    var cadastro = {
      nome: nome,
      cpf: cpf,
      data_nascimento: data_nascimento,
      celular: celular,
      cidade: cidade,
      sexo: sexo
    };

    // Converter o objeto para JSON
    var cadastro_json = JSON.stringify(cadastro);

    // Atribuir o JSON a um campo oculto no formulário
    document.getElementById("cadastro").value = cadastro_json;
  });

  // Faça a requisição dos cadastros assim que o script for carregado
  obterCadastros();

  // Adicione outras inicializações, se necessário
});
