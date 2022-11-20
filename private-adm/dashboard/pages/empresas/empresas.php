<!DOCTYPE html>
<html lang="pt-br">
<?php
require_once("../../../../api/database/conexao.php");
@session_start();
if ($_SESSION['tipo'] != "Adm") {
  header("Location: /petiti/feed");
}
require_once("../objetos.php");

$denunciaPublicacao = new DenunciaPublicacao();
$denunciaUsuario = new DenunciaUsuario();

$listaEmpresasAtivas = $usuario->buscaEmpresaAtiva();
$qtdEmpresasAtivas = $usuario->buscaQtdUsuarioAtivoEmpresa();

$listaEmpresasBloqueadas = $usuario->buscaEmpresaBloqueada();
$qtdEmpresasBloqueadas = $usuario->buscaQtdUsuarioBloqueadoEmpresa();
?>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard - Tutores | Pet iti</title>
  <!-- material icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--style-->
  <link rel="stylesheet" href="/petiti/private-adm/dashboard/pages/empresas/empresas.css" />
  <script src="/petiti/private-adm/dashboard/js/script.js"></script>
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
        <a class="menu-item" href="/petiti/dashboard">
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
        <a class="menu-item active" href="/petiti/empresas-dashboard">
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
      <h1>Empresas</h1>
      <div class="info-pets">
        <h2>Lista de Empresas</h2>
        <div class="perfis-pets">
          <form action="" method="" class="search-bar">
            <input type="text" name="procurarPerfil" id="procurarPerfil" placeholder="Pesquise por perfis de empresas" class="form-input" />
            <button type="submit">
              <img id="search-img" src="/petiti/private-adm/dashboard/images/search-icon.svg" />
            </button>
          </form>

          <!-- Tab links -->
          <div class="tab">
            <button class="tablinks active" onclick="openTab(event, 'ativo')">
              Ativos
            </button>
            <button class="tablinks" onclick="openTab(event, 'bloqueado')">
              Bloqueados
            </button>
          </div>

          <!-- Tab content -->
          <div id="ativo" class="tabcontent">
            <h3 id="total-qtd">Total (<?php echo $qtdEmpresasAtivas ?>)</h3>
            <div class="cards">
              <?php
              foreach ($listaEmpresasAtivas as $linha) {
                $id = $linha['idUsuario'];
                $nome  = $linha['nomeUsuario'];
                $login =  $linha['loginUsuario'];
                $bio = $linha['bioUsuario'];
                $email = $linha['emailUsuario'];
                $dataCompleta = $linha['dia'] . " de " . $linha['mes'] . " de " . $linha['ano'];
                $verificado =  $linha['verificadoUsuario'];
                if ($verificado == 0) {
                  $verificado = "<p class='badge nao-verificado'>Não</p>";
                } else {
                  $verificado = "<p class='badge verificado'>Sim</p>";
                }
                $tipo = $linha['tipoUsuario'];
                $foto = $linha['caminhoFoto']; ?>


                <div class="card">
                  <div class="badges">
                    <p class="badge ativo">Ativo</p>
                    <p class="badge tipo"><?php echo $tipo ?></p>
                  </div>

                  <div class="infos-card">
                    <img class="foto-info" src="<?php echo $foto ?>">
                    <div class="perfil-info">
                      <p><span style="font-weight: 900;"><?php echo $nome ?></span></p>
                      <p><?php echo $bio ?></p>
                    </div>
                  </div>

                  <div class="card-data">
                    <span class="material-symbols-outlined">
                      date_range
                    </span>
                    <p> Entrou em: <?php echo $dataCompleta ?></p>
                  </div>
                  <div class="card-perfil">
                    <a href="">Ver perfil</a>
                  </div>
                  <a class="botao bloquear" href="/petiti/api/bloquear-empresa/<?php echo $id ?>">Bloquear empresa</a>
                </div>
              <?php  }
              ?>
            </div>
          </div>

          <div id="bloqueado" class="tabcontent">
            <h3 id="total-qtd">Total (<?php echo $qtdEmpresasBloqueadas ?>)</h3>

            <div class="cards">
              <?php
              foreach ($listaEmpresasBloqueadas as $linha) {
                $id = $linha['idUsuario'];
                $nome  = $linha['nomeUsuario'];
                $login =  $linha['loginUsuario'];
                $bio = $linha['bioUsuario'];
                $email = $linha['emailUsuario'];
                $dataCompleta = $linha['dia'] . " de " . $linha['mes'] . " de " . $linha['ano'];
                $verificado =  $linha['verificadoUsuario'];
                if ($verificado == 0) {
                  $verificado = "<p class='badge nao-verificado'>Não</p>";
                } else {
                  $verificado = "<p class='badge verificado'>Sim</p>";
                }
                $tipo = $linha['tipoUsuario'];
                $foto = $linha['caminhoFoto']; ?>


                <div class="card">
                  <div class="badges">
                    <p class="badge bloqueado">Bloqueado</p>
                    <p class="badge tipo"><?php echo $tipo ?></p>
                  </div>

                  <div class="infos-card">
                    <img class="foto-info" src="<?php echo $foto ?>">
                    <div class="perfil-info">
                      <p><span style="font-weight: 900;"><?php echo $nome ?></span></p>
                      <p><?php echo $bio ?></p>
                    </div>
                  </div>

                  <div class="card-data">
                    <span class="material-symbols-outlined">
                      date_range
                    </span>
                    <p> Entrou em: <?php echo $dataCompleta ?></p>
                  </div>
                  <div class="card-perfil">
                    <a href="">Ver perfil</a>
                  </div>
                  <a class="botao ativar" href="/petiti/api/ativar-empresa/<?php echo $id ?>">Ativar empresa</a>
                </div>
              <?php  }
              ?>
            </div>
          </div>
        </div>
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
          <p>
            <?php
            $resultadoUltimaDenuncia = $denunciaPublicacao->ultimaDenuncia();
            $ultimaDenuncia = $resultadoUltimaDenuncia['ultimaDenuncia'];
            $arrayDenunciaPublicacao = $denunciaPublicacao->buscaDenunciaPublicacao($ultimaDenuncia);
            $denunciador = $arrayDenunciaPublicacao['usuarioDenunciador'];
            $denunciado = $arrayDenunciaPublicacao['usuarioDenunciado'];
            $foto = $arrayDenunciaPublicacao['fotoDenunciado'];
            ?>

          <div class="msg-denuncia">
            <div class="foto-perfil">
              <img src="<?php echo $foto; ?>" />
            </div>
            <div class="mensagem">
              O post de <span style="color: #DB310C; font-weight: 750;">@<?php echo $denunciado; ?> </span> foi denunciado por <span style="font-weight: 800">@<?php echo $denunciador; ?>
              
              </p>
              <p id="p-small">10 minutos atrás</p>
            </div>
          </div>

          <?php
          $resultadoUltimaDenuncia = $denunciaUsuario->ultimaDenuncia();
          $ultimaDenuncia = $resultadoUltimaDenuncia['ultimaDenuncia'];
          $arrayDenunciaUsuario = $denunciaUsuario->buscaDenunciaUsuario($ultimaDenuncia);
          $denunciador = $arrayDenunciaUsuario['usuarioDenunciador'];
          $denunciado = $arrayDenunciaUsuario['usuarioDenunciado'];
          $foto = $arrayDenunciaUsuario['fotoDenunciado'];
          ?>
          <div class="msg-denuncia">
            <div class="foto-perfil">
              <img src="<?php echo $foto; ?>" />
            </div>
            <div class="mensagem">
              O usuário <span style="color: #DB310C; font-weight: 750;">@<?php echo $denunciado; ?></span> foi denunciado por <span style="font-weight: 800">@<?php echo $denunciador; ?><?php  ?></span> 
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
  <!--.container-->

  <script src="/petiti/private-adm/dashboard/js/script.js"></script>

  <?php
    if(isset($_COOKIE["empresaBloqueada"])){
      echo($_COOKIE["empresaBloqueada"]);
    }else if(isset($_COOKIE["empresaAtivada"])){
      echo($_COOKIE["empresaAtivada"]);
    }
  ?>
</body>

</html>