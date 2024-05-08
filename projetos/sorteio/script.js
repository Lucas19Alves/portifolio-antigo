document.getElementById("drawButton").addEventListener("click", function() {
    var quantity = parseInt(document.getElementById("quantity").value);
    var resultDiv = document.getElementById("result");
  
    if (isNaN(quantity) || quantity <= 0) {
      alert("Por favor, insira um número válido maior que zero.");
      return;
    }
  
    // Animação de suspense
    resultDiv.textContent = "Sorteando...";
    setTimeout(function() {
      var randomNumber = Math.floor(Math.random() * quantity) + 1;
      resultDiv.textContent = "O número sorteado é: " + randomNumber;
    }, 2000); // Mudar para a duração desejada da animação de suspense (em milissegundos)
  });
  