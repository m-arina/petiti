<?php
@session_start();
date_default_timezone_set('America/Sao_Paulo');
require('../../api/classes/Usuario.php');
include_once("../../sentinela.php");
require_once('../../api/classes/curtidaPublicacao.php');
require_once('../../api/classes/UsuarioSeguidor.php');


$usuario = new Usuario();
$idPerfil = $usuario->procuraId2($_GET['user']);
if ($idPerfil == "") {
    header('location: /petiti/feed');
}
if ($idPerfil == $_SESSION['id']) {
    header('location: /petiti/decidir-perfil');
}

$url = "http://localhost/petiti/api/publicacoes/usuario/" . $idPerfil;

$json = file_get_contents($url);
$dados = (array)json_decode($json, true);
$contagem = count($dados['publicacoes']);

//Pets Perfil
$id = $idPerfil;
$urlPets = "http://localhost/petiti/api/usuario/$id/pets";

$jsonPets = file_get_contents($urlPets);

$dadosPets = (array) json_decode($jsonPets, true);

$contagemPets = count($dadosPets['pets']);


//Meus pets
$meuId = $_SESSION['id'];
$urlMeusPets = "http://localhost/petiti/api/usuario/$meuId/pets";

$jsonMeusPets = file_get_contents($urlMeusPets);

$dadosMeusPets = (array) json_decode($jsonMeusPets, true);
$contagemMeusPets = count($dadosMeusPets['pets']);


$urlPerfil = "http://localhost/petiti/api/usuario/$id";
$jsonPerfil = file_get_contents($urlPerfil);
$dadosPerfil = json_decode($jsonPerfil);

$nome = $dadosPerfil[0]->nomeUsuario;
$login = $dadosPerfil[0]->loginUsuario;
$tipoUsuario = $dadosPerfil[0]->tipoUsuario;
$bioUsuario = $dadosPerfil[0]->bioUsuario;
$foto = $dadosPerfil[0]->caminhoFoto;
$siteUsuario = $dadosPerfil[0]->siteUsuario;
$localizacao = $dadosPerfil[0]->localizacaoUsuario;



$urlCurtidas = "http://localhost/petiti/api/publicacoes/curtidas/" . $id;

$jsonCurtidas = file_get_contents($urlCurtidas);
$dadosCurtidas = (array)json_decode($jsonCurtidas, true);
$contagemCurtidas = count($dadosCurtidas['publicacoes']);

$conexao = Conexao::conexao();
$query = "SELECT COUNT(idUsuarioSeguidor) as qtdSeguindo FROM tbUsuarioSeguidor WHERE idSeguidor = $id";
$resultado = $conexao->query($query);
$lista = $resultado->fetchAll();
$qtdSeguindo = $lista[0]['qtdSeguindo'];

$query = "SELECT COUNT(idPetSeguidor) as qtdSeguindo FROM tbpetSeguidor WHERE idSeguidor = $id";
$resultado = $conexao->query($query);
$lista = $resultado->fetchAll();
$qtdSeguindo = $qtdSeguindo + $lista[0]['qtdSeguindo'];

$query = "SELECT COUNT(idUsuarioSeguidor) as qtdSeguidores FROM tbUsuarioSeguidor WHERE idUsuario = $id";
$resultado = $conexao->query($query);
$lista = $resultado->fetchAll();
$qtdSeguidores = $lista[0]['qtdSeguidores'];

$usuarioSeguidor  = new UsuarioSeguidor();

$verificarSeguidor = $usuarioSeguidor->verificarSeguidor($id, $meuId);
if ($verificarSeguidor['boolean']==true) {
    $jsSeguidor = "true";
} else {
    $jsSeguidor = "false";
}

?>




<!DOCTYPE php>
<html lang="pt-br">

<head>
    <!-- HTML base -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A Orion é uma empresa especializada em softwares para empresas de pequeno e médio porte.">

    <!-- styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="/petiti/assets/css/feed-style.css">
    <link rel="stylesheet" href="/petiti/assets/css/usuario-style.css">
    <link rel="stylesheet" href="/petiti/assets/libs/croppie/croppie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    <!--- iconscout icon --->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">

    <!-- título da pág e icone (logo) -->

    <title><?php echo $login ?></title>


    <link rel="icon" href="/petiti/assets/images/logo-icon.svg">

    <!--script-->

    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
    <script src="/petiti/assets/libs/croppie/croppie.js"></script>
    <script src="/petiti/views/assets/js/script-jquery-foto.js"></script>
    <script src="/petiti/assets/js/script.js"></script>
    <script src="/petiti/views/assets/js/funcs.js"></script>
</head>

<body class="feed perfilUsuario">

    <nav class="feed">
        <div class="container">
            <div class="popupOptions" id="popup">

                <div class="flex-col">

                    <div class="flex-row">
                        <div class="fotoDePerfil">
                            <img src="<?php echo $_SESSION['foto']; ?>" alt="">
                        </div>
                        <h3><?php echo $_SESSION['nome']; ?></h3>
                    </div>

                    <?php for ($p = 0; $p < $contagemMeusPets; $p++) { ?>
                        <div class="flex-row petUser">

                            <a class="hrefNomePet" href="/petiti/api/escolher-pet/<?php echo $dadosMeusPets['pets'][$p]['idPet'] ?>">
                                <div class="fotoDePerfil">
                                    <img src="<?php echo $dadosMeusPets['pets'][$p]['caminhoFotoPet'] ?>" alt="">
                                    <!--Foto do pet  -->
                                </div>

                                <h3><?php echo $dadosMeusPets['pets'][$p]['nomePet'] ?></h3>
                            </a>
                        </div>
                    <?php    } ?>
                </div>


                <div class="flex-col borderTop row-gap">

                    <h3>Adicionar conta existente</h3>

                    <h3>Gerenciar contas</h3>

                    <h3>Configurações</h3>

                    <h3><a href="sair"> <i class="uil uil-sign-out-alt"></i> Sair</a></h3>

                </div>

            </div>

            <h2 class="logo">
                <img src="./assets/images/logo_principal.svg">
            </h2>
            <div class="caixa-de-busca">
                <i class="uil uil-search"></i>
                <input type="search" placeholder="Pesquisar">
            </div>

            <script>
                window.onload = function() {
                    var hidediv = document.getElementById('popup');
                    document.onclick = function(div) {
                        if (div.target.id !== 'popup' && div.target.id !== 'opcoes') {
                            hidediv.style.display = "none";
                        }
                    };
                };
            </script>

            <div class="opcoes" id="opcoes" onclick="showPopUp()">
                <label for="abrir-opcoes"><i class="uil uil-setting"></i></label>
                <div class="fotoDePerfil">
                    <img src="<?php echo $_SESSION['foto']; ?>" alt="">
                </div>
            </div>
        </div>
    </nav>

    <main class="feed">
        <div class="container">

            <!-- LADO ESQUERDO -->
            <div class="ladoEsquerdo">
                <a href="/petiti/decidir-perfil" class="perfil">
                    <div class="fotoDePerfil">
                        <img src="<?php echo $_SESSION['foto']; ?>" alt="">
                    </div>
                    <div class="handle">
                        <h4><?php echo $_SESSION['nome']; ?></h4>
                        <p class="text-muted">
                            <?php echo "@" . $_SESSION['login']; ?>
                        </p>
                    </div>
                </a>
                <!-- SIDEBAR LADO ESQUERDO -->

                <div class="sidebar">
                    <a href="feed" class="menu-item">
                        <span><i class="uil uil-house-user"></i> </span>
                        <h3>Home</h3>
                    </a>

                    <a href="animaisPerdidos" class="menu-item">
                        <span><i class="uil uil-heart-break"></i></span>
                        <h3>Animais perdidos</h3>
                    </a>

                    <a href="animaisEmAdocao" class="menu-item">
                        <span><i class="uil uil-archive"></i> </span>
                        <h3>Animais em doação</h3>
                    </a>


                    <a href="notificacoes" class="menu-item">
                        <span><i class="uil uil-bell"></i> </span>
                        <h3>Notificações</h3>
                    </a>

                    <a href="#" class="menu-item">
                        <span><i class="uil uil-envelope"></i> </span>
                        <h3>Mensagens</h3>
                    </a>

                    <a href="#" class="menu-item">
                        <span><i class="uil uil-shopping-bag"></i> </span>
                        <h3>Produtos e Serviços</h3>
                    </a>

                    <a href="paraVoce" class="menu-item">
                        <span><i class="uil uil-coffee"></i> </span>
                        <h3>Para Você</h3>
                    </a>
                </div>

                <!-- Botao de criar post -->
                <button class="btn btn-primary">
                    <p>
                        <?php echo $verificarSeguidor['boolean'] ?>
                        <a href="#modal-foto-post" rel="modal:open">Criar um Post</a>
                    </p>
                </button>

            </div>
            <!-- FIM DO LADO ESQUERDO -->

            <div class="Meio">
                <div class="userArea">

                    <div class="userHandle">

                        <div class="userCima">
                            <div class="fotoDePerfil">
                                <img src="<?php echo $foto; ?>" alt="">
                            </div>

                            <div class="userInfo">

                                <div class="infoHolder topo">
                                    <input id="jsSeguidor" value="<?php echo $jsSeguidor?>" type="hidden">
                                    <h2><?php echo $login; ?></h2>
                                    <?php if ($verificarSeguidor['boolean'] == true) { ?>
                                        <button value="<?php echo $id ?>" class="seguir btn btn-primary">Seguir</button>
                                    <?php } else { ?>
                                        <button value="<?php echo $id ?>" class="seguir btn btn-secundary">Seguindo</button>
                                    <?php } ?>

                                </div>


                                <div class="infoHolder meio">
                                    <h3> <?php echo $contagem ?> <span class="text-muted"> postagens </span></h3>
                                    <h3> <span id="seguidores"> <?php echo $qtdSeguidores ?> </span> <span class="text-muted">seguidores</span></h3>
                                    <h3> <?php echo $qtdSeguindo ?> <span class="text-muted">Seguindo</span></h3>
                                </div>

                                <div class="infoHolder baixo">
                                    <div style="width: 15rem; display: flex; align-items: center;">
                                        <i class="uil uil-map-marker"></i>
                                        <h4><?php echo $localizacao ?></h4>
                                    </div>

                                    <div style="width: 15rem; display: flex; align-items: center;">
                                        <i class="uil uil-link-alt"></i> <a target="_blank" href="http://<?php echo $siteUsuario ?>"><?php echo $siteUsuario ?> </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="userBaixo">

                            <div class="subUserBaixo">
                                <div style="width: fit-content; max-width: 25rem; display: flex; align-items: center;">
                                    <h2><?php echo $nome; ?></h2>
                                </div>
                                <?php if ($contagemPets > 0) { ?>


                                    <h4 class="text-muted">(Sou dono(a) do <?php
                                                                            for ($t = 0; $t < $contagemPets; $t++) {
                                                                                $userPet = $dadosPets['pets'][$t]['usuarioPet'];
                                                                                if ($t < ($contagemPets - 2)) {
                                                                                    echo ("<a href='/petiti/pet/$userPet'>@" . $userPet . "</a>, ");
                                                                                } else if ($t == ($contagemPets - 2)) {
                                                                                    echo ("<a href='/petiti/pet/$userPet'>@" . $userPet . "</a> e ");
                                                                                }
                                                                                if ($t == ($contagemPets - 1)) {
                                                                                    echo ("<a href='/petiti/pet/$userPet'>@" . $userPet . "</a>");
                                                                                }
                                                                            }
                                                                            ?>
                                        )

                                    </h4>
                                <?php } ?>
                            </div>

                            <div class="bio">


                                <h4 class="text-muted"><?php echo $bioUsuario; ?></h4>

                            </div>

                        </div>
                    </div>
                    <!-- fim da parte de informacao do usuario -->

                    <div class="tabs">

                        <div class="userTabs ">
                            <button class="userTabOption userTabOption--ativo" data-for-tab="1">Postagens</button>
                            <button class="userTabOption" data-for-tab="2">Marcações</button>
                            <button class="userTabOption" data-for-tab="3">Curtidas</button>
                        </div>
                        <!-- fim das tabs de navegacao de usuario -->

                        <div class="tabs_content postagens tabAtiva" data-tab="1">
                            <?php

                            for ($i = 0; $i < $contagem; $i++) {
                                $foto = $dados['publicacoes'][$i]['caminhoFoto'];
                            ?>
                                <div class="previewPostImage">
                                    <img src="<?php echo $foto ?>" alt="">
                                </div>

                            <?php } ?>

                        </div>

                        <div class="tabs_content marcacoes" data-tab="2">

                            <div class="aviso">
                                <h3>Esse usuário ainda não foi marcado em nenhum post...</h3>
                            </div>
                        </div>

                        <div class="tabs_content curtidas" data-tab="3">

                            <?php




                            for ($i = 0; $i < $contagemCurtidas; $i++) {
                                $fotoCurtidas = $dadosCurtidas['publicacoes'][$i]['caminhoFoto'];
                            ?>
                                <div class="previewPostImage">
                                    <img src="<?php echo $fotoCurtidas ?>" alt="">
                                </div>
                            <?php } ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- fim do meio -->

        </div>
    </main>

</body>

</html>