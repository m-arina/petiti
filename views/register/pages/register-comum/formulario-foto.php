<!DOCTYPE php>
<html lang="pt-br">
<?php
include_once("sentinela-cadastro.php");
?>

<head>
    <!-- HTML base -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A Orion é uma empresa especializada em softwares para empresas de pequeno e médio porte.">

    <!-- styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="/petiti/views/assets/css/style.css">
    <link rel="stylesheet" href="/petiti/assets/libs/croppie/croppie.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />


    <!-- título da pág e icone (logo) -->
    <title>Pet iti - A rede social para petlovers</title>
    <link rel="icon" href="/petiti/views/assets/img/logo-icon.svg">

    <!--script-->
    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
    <script src="/petiti/assets/libs/croppie/croppie.js"></script>

    <script async src="/petiti/views/assets/js/script-jquery-foto.js"></script>
</head>

<body>
    <main class="container-content">
        <section id="formularioFoto">
            <div class="holderFormularioFoto">
                <div class="formulario">
                <a class="setaVoltar" href="cadastro-usuario"><img src="/petiti/views/assets/img/seta - voltar.svg" alt=""></a>
                    <div class="tituloFormHolderFoto">
                        <span>
                            Deixe seu pefil mais a sua cara!
                        </span>
                    </div>

                    <div class="formElementsHolderflexivel">

                        <label class="previewFormFoto">
                            <div id="imagePreview"></div>
                            <img class="previewFoto" id="preview" src="/petiti/private-user/fotos-perfil/padrao.png" />
                        </label>

                        
                        <label class="formLabelFoto" id="inputTag">
                            <input class="inputFormFoto" type="file" accept=".jpg, .png" name="flFoto" id="flFoto">
                            <input id="baseFoto" type="hidden" name="baseFoto" value="">
                            Anexar foto dos meus arquivos
                        </label>


                        <div class="EHolder">
                            <div class="line"></div>
                            <span style="font-family:'Raleway Bold';">E</span>
                            <div class="line"></div>
                        </div>

                        <div class="formTextFoto">
                            <span>Caso não tenha escolhido uma foto, você pode fazer isso depois. E, caso você tenha anexado uma foto e não tenha gostado muito, será possível alterar quando sua conta estiver feita.</span>
                        </div>

                       <a id="enviarFoto" href="inicio-pet" class="formInputFoto"> Continuar</a>

                        </div>
                </div>
                    <div id="modal-recortar-foto" class="modal">
                          <div class="modalInner">
                                 <span class="subTituloForm">Redimensione sua imagem!</span>
                                <div id="upload-demo"></div>               
                                    <a href="#close-modal" rel="modal:close" class="formInputFoto">
                                        <span rel="modal:close" id="continuar-crop-foto" style="padding-block: 10px; padding-inline: 87px;">Confirmar</span>
                                    </a>
                            </div>
                    </div>
            </div>

        </section>
    </main>

