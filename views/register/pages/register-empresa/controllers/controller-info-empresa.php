<?php
require_once("/xampp/htdocs/petiti/api/classes/Usuario.php");
require_once("/xampp/htdocs/petiti/api/classes/UsuarioEndereco.php");
require_once("/xampp/htdocs/petiti/api/classes/TipoUsuario.php");

$usuario = new Usuario();
$tipoUsuario = new TipoUsuario();
@session_start();
$lista = $usuario->listarUsuario($_SESSION['id-cadastro']);
foreach ($lista as $linha) {
    $id = $linha['idUsuario'];
    $senha = $linha['senhaUsuario'];
    $login = $linha['loginUsuario'];
    $verificado = $linha['verificadoUsuario'];
    $email = $linha['emailUsuario'];
}
$usuario->setIdUsuario($id);
$usuario->setNomeUsuario($_POST['txtNomeEmpresa']);
$usuario->setSenhaUsuario($senha);
$usuario->setLoginUsuario($login);
$usuario->setVerificadoUsuario($verificado);
$usuario->setEmailUsuario($email);
$tipoUsuario->setIdTipoUsuario(2);
$usuario->setTipoUsuario($tipoUsuario);
echo $usuario->getNomeUsuario();

$usuario->update($usuario);

header('location: ../formulario-foto-empresa.php');
