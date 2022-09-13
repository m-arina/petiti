<!DOCTYPE php>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet iti</title>
    <script src="js/script.js" async></script>
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <main class="container-content">
        <section id="formularioUsuario">
            <div class="holderFormularioUsuario">

                <div class="formulario">



                    <div class="tituloFormHolder">
                        <span>
                            Vamos começar!
                        </span>
                    </div>

                    <div class="subTituloFormHolderUsuario">
                        <span>
                            Insira seus dados de acesso abaixo:
                        </span>
                    </div>


                    <div class="formularioHolder ">
                        <form class="formElementsHolder" action="controllers/controller-usuario-empresa.php" method="post">

                            <label class="formText">Email</label>
                            <input class="formInput" placeholder="Insira seu email" type="email" name="txtEmailUsuarioEmpresa" id="txtEmailUsuarioEmpresa">

                            <label class="formText">Nome de usuário</label>
                            <input class="formInput" placeholder="Insira seu username" type=" text" name="txtLoginUsuarioEmpresa" id="txtLoginUsuarioEmpresa" required minlength="4">

                            <label class="formText">Senha</label>
                            <input class="formInput" placeholder="Insira sua melhor senha" type="password" name="txtPw" id="txtPw" required minlength="6">

                            <label class="formText">Confirme sua senha</label>
                            <input class="formInput" placeholder="Confirme a senha" type="password" name="txtPwConfirm" id="txtPwConfirm" required minlength="6">
                            <button class="formSubmit" type="submit">Continuar</button>

                        </form>
                    </div>

                    <div class="cookieCadastroEmpresa animate__bounce">
                        <p class="animate__animated animate__tada "><?php echo @$_COOKIE['erro-cadastro'] ?></p>
                    </div>


                </div>
            </div>
        </section>
    </main>
</body>

</html>