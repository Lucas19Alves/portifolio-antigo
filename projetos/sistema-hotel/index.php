<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quartos - Sistema</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .room {
      width: 250px;
      height: 120px;
      margin: 10px;
      text-align: center;
      padding-top: 30px;
      font-size: 18px;
      border: 2px solid #ccc;
      border-radius: 5px;
      cursor: pointer;
    }

    .empty {
      background-color: #fff;
      color: #333;
    }

    .reserved {
      background-color: #007bff;
      color: #fff;
    }

    .occupied {
      background-color: #dc3545;
      color: #fff;
    }

    .dirty {
      background-color: #ffc107;
      color: #333;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.html">Hotel Minas Bahia</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Quartos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cadastro.html">Cadastro</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="consulta.html">Consulta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reservas.html">Reservas</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container mt-5">
    <h2 class="text-center mb-4">Gerenciamento de Quartos</h2>
    <div class="row" id="quartos">
      <?php
      // Função para obter o estado salvo dos quartos ou atribuir um estado padrão
      function obterEstadoQuarto($numeroQuarto)
      {
        if (isset($_COOKIE['estado_quarto_' . $numeroQuarto])) {
          return $_COOKIE['estado_quarto_' . $numeroQuarto];
        } else {
          return 'empty'; // Estado padrão
        }
      }

      // Criação dinâmica dos quartos
      for ($numeroQuarto = 101; $numeroQuarto <= 126; $numeroQuarto++) {
        echo '<div class="col-md-3">';
        echo '<div class="room ' . obterEstadoQuarto($numeroQuarto) . '" onclick="alterarEstado(' . $numeroQuarto . ')" data-quarto="' . $numeroQuarto . '">';
        echo $numeroQuarto;
        echo '</div>';
        echo '</div>';
      }
      ?>
    </div>
  </div>

  <script>
    function alterarEstado(numeroQuarto) {
      var room = document.getElementById('quartos').querySelector('[onclick="alterarEstado(' + numeroQuarto + ')"]');
      if (room.classList.contains('empty')) {
        room.classList.remove('empty');
        room.classList.add('reserved');
      } else if (room.classList.contains('reserved')) {
        room.classList.remove('reserved');
        room.classList.add('occupied');
      } else if (room.classList.contains('occupied')) {
        room.classList.remove('occupied');
        room.classList.add('dirty');
      } else if (room.classList.contains('dirty')) {
        room.classList.remove('dirty');
        room.classList.add('empty');
      }

      // Salva o estado do quarto no localStorage
      localStorage.setItem('estado_quarto_' + numeroQuarto, room.classList[1]);
    }

    function obterEstadoQuarto(numeroQuarto) {
      var estadoLocalStorage = localStorage.getItem('estado_quarto_' + numeroQuarto);
      if (estadoLocalStorage !== null) {
        return estadoLocalStorage;
      } else {
        return 'empty'; // Estado padrão
      }
    }


    document.addEventListener('DOMContentLoaded', function () {
  // Restaura os estados dos quartos ao carregar a página
  for (var numeroQuarto = 101; numeroQuarto <= 126; numeroQuarto++) {
    var room = document.querySelector('[data-quarto="' + numeroQuarto + '"]');
    if (room) {
      room.classList.remove('empty', 'reserved', 'occupied', 'dirty');
      room.classList.add(obterEstadoQuarto(numeroQuarto));
    }
  }
});


  </script>

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>