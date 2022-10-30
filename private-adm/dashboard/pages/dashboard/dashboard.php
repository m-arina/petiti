<!DOCTYPE html>
<html lang="pt-br">
<?php

require_once("../../../../api/database/conexao.php");
@session_start();
if ($_SESSION['tipo'] != "Adm") {
  header("Location: /petiti/feed");
}
$con = Conexao::conexao();
$query = "SELECT COUNT(idUsuario) FROM `tbusuario` WHERE idTipoUsuario = 1 AND dataCriacaoConta >= DATE_SUB(CURDATE(),INTERVAL 24 HOUR)";

$resultado = $con->query($query);
$lista = $resultado->fetchAll();
foreach ($lista as $linha) {
  $qtdTutores = $linha[0];
}

//
$query = "SELECT COUNT(idPet) FROM tbPet";

$resultado = $con->query($query);
$lista = $resultado->fetchAll();
foreach ($lista as $linha) {
  $qtdPets = $linha[0];
}
//

//
$query = "SELECT COUNT(idUsuario) FROM tbusuario WHERE idTipoUsuario > 1 AND dataCriacaoConta >= DATE_SUB(CURDATE(),INTERVAL 24 HOUR)";

$resultado = $con->query($query);
$lista = $resultado->fetchAll();
foreach ($lista as $linha) {
  $qtdEmpresas = $linha[0];
}
//

?>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard | Pet iti</title>
  <!-- material icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" />

  <!--style-->
  <link rel="stylesheet" href="/petiti/private-adm/dashboard/pages/dashboard/dashboard.css" />
</head>

<body>
  <div class="container">
    <!------------------- começo - aside ------------------->
    <aside>
      <div class="top">
        <div class="logo">
          <img src="/petiti/private-adm/dashboard/images/logo-petiti.svg" />
          <h1>pet iti</h1>
        </div>
        <div class="close" id="close-btn">
          <span class="material-icons-sharp">close</span>
        </div>
      </div>

      <div class="sidebar">
        <a class="menu-item active" href="/petiti/dashboard">
          <span class="material-icons-round">dashboard</span>
          <h3>Dashboard</h3>
        </a>
        <a class="menu-item" href="/petiti/tutores-dashboard">
          <span class="material-icons-round">person_outline</span>
          <h3>Tutores</h3>
        </a>
        <a class="menu-item" href="/petiti/pets-dashboard">
          <span class="material-icons-round">pets</span>
          <h3>Pets</h3>
        </a>
        <a class="menu-item" href="/petiti/empresas-dashboard">
          <span class="material-icons-round">store</span>
          <h3>Empresas</h3>
        </a>
        <a class="menu-item" href="/petiti/categorias-dashboard">
          <span class="material-icons-round">category</span>
          <h3>Categorias</h3>
        </a>
        <a class="menu-item" href="/petiti/denuncias-dashboard">
          <span class="material-icons-outlined">report</span>
          <h3>Denúncias</h3>
        </a>
        <a id="logout" class="menu-item" href="/petiti/sair">
          <span class="material-icons-round">logout</span>
          <h3>Sair</h3>
        </a>
      </div>
    </aside>
    <!------------------- final do aside ------------------->

    <!------------------- começo - main ------------------->
    <main>
      <h1>Dashboard</h1>

      <div class="info-conteudo">
        <div class="tutores">
          <span class="material-icons-round">person_outline</span>
          <div class="info">
            <div class="left-side">
              <h3>Total de Tutores</h3>
              <h2><?php echo $qtdTutores ?> contas</h2>
              <!-- php aqui (puxar a qtd de contas do banco)-->
            </div>
            <div class="progresso">
              <img />
            </div>
          </div>
          <p id="cinza">Últimas 24 horas</p>
        </div>
        <!------------------- final - tutores ------------------->

        <div class="pets">
          <span class="material-icons-round">pets</span>
          <div class="info">
            <div class="left-side">
              <h3>Total de Pets</h3>
              <h2><?php echo $qtdPets ?> contas</h2>
            </div>
          </div>
          <p id="cinza">Últimas 24 horas</p>
        </div>
        <!------------------- final - pets ------------------->

        <div class="empresas">
          <span class="material-icons-round">store</span>
          <div class="info">
            <div class="left-side">
              <h3>Total de Empresas</h3>
              <h2><?php echo $qtdEmpresas ?> contas</h2>
            </div>
            <p id="cinza">Últimas 24 horas</p>
          </div>
        </div>
        <!------------------- final - empresas ------------------->
      </div>

      <div class="informacoes">
        <h2>Informações da Pet Iti</h2>
        <div class="graficos"></div>
      </div>
    </main>
    <!------------------- final - main ------------------->

    <div class="right-side">
      <div class="top-right">
        <div class="perfil">
          <div class="info-admin">
            <p>Olá, <span style="font-weight: 800">Admin</span></p>
            <p id="cinza" style="margin-top: 0.3rem">Administrador</p>
          </div>
        </div>
      </div>

      <div class="container-denuncias">
        <h2>Denúncias recentes</h2>
        <div class="denuncias">
          <div class="icon-denuncia">
            <span id="icon-report" class="material-icons-outlined">report</span>
          </div>
          <div class="msg-denuncia">
            <div class="foto-perfil">
              <img src="/petiti/private-adm/dashboard/images/le.jpg" />
              <!--puxar do banco (pessoa que fez a denuncia)-->
            </div>
            <div class="mensagem">
              <p>
                <span style="font-weight: 800">@leandrocoelho</span> denúnciou
                o post de @kauanmatheus. A causa foi "É spam".
              </p>
              <p id="p-small">10 minutos atrás</p>
            </div>
          </div>
          <div class="msg-denuncia">
            <div class="foto-perfil">
              <img src="/petiti/private-adm/dashboard/images/le.jpg" />
            </div>
            <div class="mensagem">
              <p>
                <span style="font-weight: 800">@cauagustavo</span> denúnciou o
                post de @camilamartins. A causa foi "Simplesmente não gostei"
              </p>
              <p id="p-small">10 minutos atrás</p>
            </div>
          </div>
          <div class="msg-denuncia">
            <div class="foto-perfil">
              <img src="/petiti/private-adm/dashboard/images/le.jpg" />
            </div>
            <div class="mensagem">
              <p>
                <span style="font-weight: 800">@marinaliz</span> denúnciou o
                post de @kauanmatheus. A causa foi "Bullying ou assédio".
              </p>
              <p id="p-small">10 minutos atrás</p>
            </div>
          </div>
        </div>
      </div>
      <!------------------- final - denuncias recentes ------------------->

      <div class="categorias-alta">
        <h2>Categorias em alta</h2>
        <div class="categoria">
          <div class="icon">
            <span class="material-icons-round">category</span>
          </div>
          <div class="right">
            <div class="info-cat">
              <h3 style="font-size: 1.3rem">Cachorros</h3>
              <p id="p-small">Últimas 24 horas</p>
            </div>
            <h5 class="sucesso">+71%</h5>
            <h3 style="font-size: 1.2rem">5070</h3>
          </div>
        </div>
        <div class="categoria">
          <div class="icon">
            <span class="material-icons-round">category</span>
          </div>
          <div class="right">
            <div class="info-cat">
              <h3 style="font-size: 1.3rem">Lontrinhas</h3>
              <p id="p-small">Últimas 24 horas</p>
            </div>
            <h5 class="perigo">-10%</h5>
            <h3 style="font-size: 1.2rem">2015</h3>
          </div>
        </div>
        <div class="categoria">
          <div class="icon">
            <span class="material-icons-round">category</span>
          </div>
          <div class="right">
            <div class="info-cat">
              <h3 style="font-size: 1.3rem">Axolote</h3>
              <p id="p-small">Últimas 24 horas</p>
            </div>
            <h5 class="sucesso">+15%</h5>
            <h3 style="font-size: 1.2rem">500</h3>
          </div>
        </div>
      </div>

      <div class="contato">
        <div>
          <span class="material-icons-round">forward_to_inbox </span>
          <h3 style="font-size: 1.2rem; text-align: center">
            Precisa de ajuda ? Entre em contato com a empresa
          </h3>
        </div>
      </div>
    </div>
  </div>

  <script src="/petiti/private-adm/dashboard/js/script.js"></script>
</body>

</html>