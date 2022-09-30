<?php
require_once("/xampp/htdocs/petiti/api/classes/Usuario.php");
require_once("/xampp/htdocs/petiti/api/classes/FotoUsuario.php");
require_once("/xampp/htdocs/petiti/api/classes/Cookies.php");
// Objetos
$usuario = new Usuario();
$fotoUsuario = new FotoUsuario();
$cookie = new Cookies();

$caminho = "/xampp/htdocs/petiti/private-user/fotos-perfil/";
$caminhoBanco = "";
$foto = $_FILES['flFoto'];
$nomeFoto = $foto['name'];


$tipo = strtolower(pathinfo($nomeFoto, PATHINFO_EXTENSION));

@session_start();
if ($foto['size'] == 0) {
    $usuario->setIdUsuario($_SESSION['id-cadastro']);
    $fotoUsuario->setUsuario($usuario);
    $fotoUsuario->setNomeFoto("padrao.png");
    $fotoUsuario->setCaminhoFoto("private-user/fotos-perfil/padrao.png");
    $fotoUsuario->cadastrar($fotoUsuario);
    header('location: /petiti/inicio-pet');
} elseif ($foto['error'] <> 0) {
    $cookie->criarCookie("erro-foto", "Erro ao subir imagem, tente novamente.", 1);
    header('location: /petiti/foto-usuario');
} elseif (($tipo <> 'jpg') && ($tipo <> 'jpeg') && ($tipo <> 'png')) {
    $cookie->criarCookie("erro-foto", "Formato inválido.", 1);
    header('location: /petiti/foto-usuario');
} else {
    $nomeRandom = uniqid();
    $caminhoCompleto = $caminho . $nomeRandom . "." . $tipo;
    move_uploaded_file($foto['tmp_name'], $caminhoCompleto);


    $caminhoBanco = "private-user/fotos-perfil/" . $nomeRandom . "." . $tipo;
    $nomeTipo = $nomeRandom . "." . $tipo;
    $usuario->setIdUsuario($_SESSION['id-cadastro']);
    $fotoUsuario->setUsuario($usuario);
    $fotoUsuario->setNomeFoto($nomeTipo);
    $fotoUsuario->setCaminhoFoto($caminhoBanco);
    $fotoUsuario->cadastrar($fotoUsuario);
    header('location: /petiti/inicio-pet');
}
