<?php
session_start();
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

    <head>
        <link rel="stylesheet" href="css/style.css" media="screen">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
              integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
                integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
                integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
        <script src="js/scripts.js" ;></script>
        <style>
            .voto{
                color: #ed1111;
            }
        </style>
        <meta charset="UTF-8">
        <title>Novedades del Bot</title>
    </head>

    <body>

        <!-- NAVBAR -->
        <?php
        include "classes.php";
        $modalID = "comment";
        $curso = new cursos();
        $nav = new navbar();
        $nav->simple();
        $news = new mySQLphpClass();
        $cat = new category();
        $contenido = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            if (array_key_exists('existent', $_POST)) {
                $_SESSION["cursoActual"] = $_POST["existent"];
            }

            if (array_key_exists('commentSubmit', $_POST)) {

                $comment = new comentarios($_POST["nivelId"]);
                $contenido = $_POST["contenidoId"];
                $nivel = $curso->getNivelArchivo($contenido);
                $comment->newComment($_SESSION["usuario"], $_POST["commentText"]);
            }
        }

        if (isset($_GET["c"])) {
            $contenido = $_GET["c"];
            $nivel = $curso->getNivelArchivo($_GET["c"]);
        }
        
        
        if(isset($_GET["like"])&& isset($_SESSION["usuario"])){
          $con = new mySQLphpClass();
          $con->newsInteractions($nivel, $_SESSION["usuario"], $_GET["like"]);
          header('Location: tomarCurso.php?c=' . $_GET["c"]);
         }


        $news = new mySQLphpClass();
        $result = $news->get_misCursos($_SESSION["cursoActual"], null);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nombre = $row["nombre"];
                $desc = $row["descripcion"];
                $precio = $row["precio"];
                $imagen2 = $row["imagen"];
                $incluye = $row["incluye"];
                $publicado = $row["publicado"];
            }
        } else {
            echo "0 results";
        }

        if (isset($_SESSION["usuario"])) {
            $nav->yesSession($_SESSION["usuario"], $_SESSION["privilegio"], $_SESSION["imagen"]);
        } else {
            $_SESSION["usuario"] = null;
            header('Location: index.php');
        }
        ?>
        <!-- FIN NAVBAR -->

        <script>

            $(document).ready(function () {
                $(function () {
                    $('[data-toggle="popover"]').popover();
                });

                $(".autor").popover({
                    content: '<span class="popText px-3">Abrir chat con el maestro</span>',
                    html: true
                });
            });


        </script>

        <div class="contGlobal">

            <div class="mainContentB" style="min-height: 50em;">
                <div class="contariner">


                    <div class="row">


                        <div class="col-12">

                            <?php $curso->archivoAMostrar($contenido) ?>
                            <div class="separador">Contenido</div>
                            <div class="accordion" id="accordionExample">
                                <?php
                                $curso->nivelesCursosPaVer($_SESSION["cursoActual"]);
                                ?>
                            </div>
                            <div class="separador">Datos del curso</div>
                            <div>
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="ds">
                                            <h2 class="mb-0">
                                                <button class="btn" type="button" data-toggle="collapse"
                                                        data-target="#collapseZeroA" aria-expanded="true"
                                                        aria-controls="collapseZeroA">
                                                    Certificado
                                                </button>
                                            </h2>
                                        </div>
                                        <?php $termino = $curso->Progreso($_SESSION["cursoActual"], $_SESSION["usuario"]) ?>

                                        <div id="collapseZeroA" class="collapse" aria-labelledby="headingZeroA"
                                             data-parent="#accordionExample">
                                            <div class="card-body">
                                                <button class="btn btn-primary btnConfig" type="submit"
                                                        onclick="redirect('Certificate.php?user=<?php echo $_SESSION["usuario"] ?>&cur=<?php echo $_SESSION["cursoActual"] ?>')" <?php if($termino != 100) echo "disabled" ?>>Generar Certificado </button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="ds">
                                            <h2 class="mb-0">
                                                <button class="btn" type="button" data-toggle="collapse"
                                                        data-target="#collapseOneA" aria-expanded="true"
                                                        aria-controls="collapseOneA">
                                                    Descripcion del curso <?php echo $nombre ?>
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseOneA" class="collapse" aria-labelledby="headingOneA"
                                             data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p><?php echo $desc ?></p>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwoA">
                                            <h2 class="mb-0">
                                                <button class="btn" type="button" data-toggle="collapse"
                                                        data-target="#collapseTwoA" aria-expanded="false"
                                                        aria-controls="collapseTwoA">
                                                    Maestro
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseTwoA" class="collapse" aria-labelledby="headingTwoA"
                                             data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="row py-3">
                                                    <div class="col">
                                                        <div class="autor" data-trigger="hover">
                                                            <?php echo $curso->getMaestroDelCurso($_SESSION["cursoActual"]) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--SECCIÓN DE COMENTARIOS-->

                            <?php
                            if ($contenido > 0) {
                                
                                $redir = "redirect('tomarCurso.php?c=". $contenido ."&user=&like=1')";
                                $redir2 = "redirect('tomarCurso.php?c=". $contenido ."&user=&like=0')";
                                echo ' <h5 style >Una vez termines el nivel comparte con nosotros que te parecio el nivel </h5>
                                    <p>es necesario calificar el nivel para darlo por terminado</p>
                                    <div class="row">
                    <div class="col-3 my-5" id="likeCounter" style="font-size: 25px">';
                                
                                $votastePor= $curso->votasteONo($nivel,$_SESSION["usuario"]);
                                if (!isset($votastePor)){
                                    $votastePor=3;
                                };
                       //cho $likes; 
                                
                    echo '</div>
                        
                       
                       
                    <div class="';
                    if($votastePor == 1){
                    echo ' voto ';}
                    echo 'col-2 my-5 meGusta user-select-none text-center" onclick="'. $redir .'">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-suit-heart" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 0l1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864 8 0z"/>
                        <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
                        </svg>
                        Premiar
                    </div>
                    <div class="';
                    if($votastePor == 0){
                    echo ' voto ';}
                    echo 'col-2 my-5 meGusta user-select-none text-center" onclick="'. $redir2 .'">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-suit-heart" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M9.669.864L8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193l-1.51-.229L8 1.126l-1.355.702-1.51.229-.684 1.365-1.086 1.072L3.614 6l-.25 1.506 1.087 1.072.684 1.365 1.51.229L8 10.874l1.356-.702 1.509-.229.684-1.365 1.086-1.072L12.387 6l.248-1.506-1.086-1.072-.684-1.365z"/>
                        <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
                        </svg>
                        No Premiar
                    </div>
                </div>';

                                echo "<div class='row mt-3'>
                    <h3 class='mx-auto'>COMENTARIOS</h3> 
                </div>


                <div class='listaNotas overflow-auto my-2'>

                    ";
                                $comentarios = new comentarios($nivel);
                                $comentarios->cargarComentarios();
                                echo "

                </div>



                <div>
                    <div class='commentBTN py-2' data-toggle='modal' data-target='#" . $modalID . "'>
                        <div class='center' >
                            <div class='row no-gutters'>
                                <div class='col pl-4'>
                                    <svg width='3em' height='3em' viewBox='0 0 16 16' class='bi bi-plus' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                    <path fill-rule='evenodd' d='M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z'/>
                                    </svg>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='2em' height='2em' fill='currentColor' class='bi bi-pen' viewBox='0 0 16 16'>
                                    <path d='M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z'/>
                                    </svg>
                                </div>
                            </div>

                            <div class='row no-gutters'>
                                <div class='col pb-3'>
                                    Dejar un Comentario
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Comentario -->
                <div class='modal fade' id='comment' data-backdrop='static' data-keyboard='false' tabindex='-1' aria-labelledby='commentModal' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='staticBackdropLabel'>Comentar en la noticia</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <form action='tomarCurso.php' method='post' enctype='multipart/form-data'>
                                <div class='modal-body user-select-none'>
                                    <div class='user-select-none'>
                                        <input type='text' class='form-control user-select-none' name='code' value='" . $nivel . "' readonly='readonly' style='color: #e9ecef;'>
                                    </div>
                                    <div class='input-group'>
                                        <div class='input-group-prepend'>
                                            <span class='input-group-text'>Comentario</span>
                                        </div>
                                        <textarea class='form-control' aria-label='commentModal' name='commentText' id='textAreaField' rows='5' cols='100'></textarea>
                                    </div>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Volver</button>
                                    <input type='hidden' id='nivelId' name='nivelId' value='" . $nivel . "'>
                                    <input type='hidden' id='contenidoId' name='contenidoId' value='" . $contenido . "'>
                                    <button type='submit' class='btn btn-primary' name='commentSubmit' value='commentSubmit'>Comentar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>";


                                $comentarios->modales();
                            }
                            ?> 

                        </div>



                    </div>


                </div>
            </div>

        </div>




        <footer>



        </footer>
    </div>
</body>

</html>