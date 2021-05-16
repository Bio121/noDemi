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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>	
        <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src= "js/scripts.js";></script>
        <meta charset="UTF-8">
        <title>Configuración de usuario</title>
    </head>
    <body class="sb">

        <?php
        include "classes.php";
        $nav = new navbar();
        $nav->simple();
        $news = new mySQLphpClass();
        $cat = new category();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (array_key_exists('createNew', $_POST)) {
                $result = $news->cursos(null, "Nombre de ejemplo", "Breve descripción de su curso", "0.99", null, $_SESSION["usuario"], "0", "Cuéntanos qué incluye tu curso", "I");
                $row = $result->fetch_assoc();
                $_SESSION["cursoActual"] = $row["código"];
            }

            if (isset($_POST['imgUpload'])) {

                $codeVar = $_POST['imgUpload'];
                $cursoFolder = 'Curso' . $_POST['curso'];
                $nivelFolder = 'Nivel' . $_POST['nivel'];

                $num_imagenes = count($_FILES['video']['name']);
                for ($i = 0; $i < $num_imagenes; $i++) {
                    if (isset($_FILES['video']['name'][$i]) && $_FILES['video']['size'][$i] > 0) {

                        if ($_FILES['video']['size'][$i] > 2048000000) {
                            $salioMal = '<div class="alert alert-danger my-3" role="alert"> El Archivo es muy grande para ser subido. </div>';
                        } else {

                            $ruta = 'ARCHIVOS/' . $cursoFolder . '/' . $nivelFolder;
                            if (!is_dir($ruta)) {
                                mkdir($ruta, 0777, true);
                            }
                            $file_namev = $_FILES['video']['name'][$i];
                            $file_tmpv = $_FILES['video']['tmp_name'][$i];
                            $file_type = $_FILES['video']['type'][$i];

                            $rutaFinal = $ruta . '/' . $file_namev;

                            $news->archivos($rutaFinal, $file_type, $file_namev, $_POST['nivel'], null, 'I');

                            move_uploaded_file($file_tmpv, $rutaFinal);
                        }
                    }
                }

                unset($_POST['imgUpload']);
            }

            if (isset($_POST['linkUpload'])) {

                $url = $_POST['link'];

                if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
                    $salioMal = '<div class="alert alert-danger my-3" role="alert"> El enlace introducido no es un enlace válido. </div>';
                } else {
                    $news->archivos($url, 'link', $url, $_POST['nivel'], null, 'I');
                }
            }

            if (array_key_exists('existent', $_POST)) {
                $_SESSION["cursoActual"] = $_POST["existent"];
            }

            if (array_key_exists('addCat', $_POST)) {
                $news->seccion($_POST['nombreCat'], $_POST['descCat'], null, 'I');
            }

            if (array_key_exists('addTextCat', $_POST)) {
                $news->seccionXcurso($_SESSION['cursoActual'], $_POST['categoria'], null, 'I');
            }

            if (array_key_exists('catBorrar', $_POST)) {
                $str = $news->seccionXcurso(null, null, $_POST['quitaCategoria'], 'D');
            }

            if (array_key_exists('changes', $_POST)) {
                if ((isset($_FILES['image'])) && ($_FILES['image']['tmp_name'] != '')) {
                    $file = $_FILES['image'];
                    $temName = $file['tmp_name'];
                    $fp = fopen($temName, "rb");
                    $contenido = fread($fp, filesize($temName));
                    $imagen = addslashes($contenido);
                    fclose($fp);
                } else {
                    $imagen = null;
                }
                $news->cursos($_SESSION["cursoActual"], $_POST["nombreCurso"], $_POST["descCurso"], $_POST["precioCurso"], $imagen, $_SESSION["usuario"], null, $_POST["incluyeCurso"], 'U');
                
                $diff = $_POST['dificultad'];
                
                $news->proc_dificultad($_SESSION["cursoActual"], $diff);
            }

            if (array_key_exists('publish', $_POST) && !isset($_POST['videoLock'])) {

                $news->cursos($_SESSION["cursoActual"], null, null, null, null, null, null, null, 'P');
            }
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
                $dificultad = $row['dificultad'];
                if($dificultad == 'Novato')$rb1 = ' checked'; else $rb1 = '';
                if($dificultad == 'Medio')$rb2 = ' checked'; else $rb2 = '';
                if($dificultad == 'Experto')$rb3 = ' checked'; else $rb3 = '';
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

        <div class="contGlobal">
            <div class="mainContent">
                <div class="container">

                    <div class="textoOculto"><?php echo $_SESSION['cursoActual']; ?></div>

                    <div class="row">
                        <div>
                            <?php
                            if (isset($salioMal)) {
                                echo $salioMal;
                            }
                            ?>
                            <h3>Categorías del curso</h3>

                            <form action="crearCurso.php" method="post" enctype='multipart/form-data'>
                                <div class="catContEx">
                                    <?php
                                    $cat->seccionesDeCurso($_SESSION["cursoActual"]);
                                    ?>
                                </div>
                            </form>

                            <form action="crearCurso.php" method="post" enctype='multipart/form-data'>
                                <div class="catText">
                                    <span class="text-muted">Selecciona una categoría para agregar</span>
                                </div>
                                <div class="catContainer sb my-2">
                                    <?php
                                    $cat->llenaElCuadro();
                                    ?>
                                </div>
                                <button class="btn btn-primary" type="submit" id="addTextCat" name="addTextCat">Añadir esta categoría</button>
                            </form>
                            <button class="btn btn-link" type="button" id=""  data-toggle="modal" data-target="#newCatModal">
                                La categoría que busco no se encuentra en la lista
                            </button>
                        </div>
                    </div>

                    <div class="row mt-5"> 
                        <div class="col" >
                            <form action="crearCurso.php" method="post" enctype='multipart/form-data'>

                                <h1>Datos del curso</h1>

                                <label for="nombreCurso">Nombre del curso</label>
                                <input type="text" class="form-control campoConfig" id="nombreCurso" name="nombreCurso" placeholder="" value="<?php echo $nombre; ?>" maxlength="255">

                                <label for="descCurso">Descripción corta</label>
                                <input type="text" class="form-control campoConfig" id="descCurso" name="descCurso" placeholder="" value="<?php echo $desc; ?>" maxlength="100">

                                <div class="row mb-5">
                                    <div class="col">    
                                        <?php
                                        $img = "img/default.png";
                                        if (!empty($imagen2)) {
                                            $img = "data:image/jpg;base64," . base64_encode($imagen2);
                                        }
                                        ?>
                                        <img src="<?PHP echo $img; ?>"alt="Img" class="float-left imagenUserConfig"/>

                                        <div class="custom-file">

                                            <div class="btn btn-outline-secondary btn-rounded waves-effect float-left">
                                                <input type="file" id="archivo" name="image"  accept="image/png,image/jpeg">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col d-flex">
                                        <div class="my-auto">
                                            <div class="row text-center mb-5">
                                                <h3>Elige el nivel de dificultad que identifica mejor este curso</h3>
                                            </div>
                                            <div class="row mt-5">
                                                <div class="form-check mx-auto">
                                                    <input class="form-check-input" type="radio" name="dificultad" id="novatoRadio" value="Novato" <?php echo $rb1; ?>>
                                                    <label class="form-check-label" for="novatoRadio">
                                                        Novato
                                                    </label>
                                                </div>
                                                <div class="form-check mx-auto">
                                                    <input class="form-check-input" type="radio" name="dificultad" id="medioRadio" value="Medio" <?php echo $rb2; ?>>
                                                    <label class="form-check-label" for="medioRadio">
                                                        Medio
                                                    </label>
                                                </div>
                                                <div class="form-check mx-auto">
                                                    <input class="form-check-input" type="radio" name="dificultad" id="expertoRadio" value="Experto" <?php echo $rb3; ?>>
                                                    <label class="form-check-label" for="expertoRadio">
                                                        Experto
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <label for="incluyeCurso">Qué incluye</label>
                                <input type="text" class="form-control campoConfig" id="incluyeCurso" name="incluyeCurso" placeholder=" " value="<?php echo $incluye; ?>" maxlength="255">
                                <label for="precioCurso">Precio</label>
                                <input type="number" class="form-control campoConfig" id="precioCurso" name="precioCurso" placeholder=" " value="<?php echo $precio; ?>" step="any">

                                <button class="btn btn-primary btnConfig btn-lg" type="Submit" name="changes" value="changes">Aplicar Cambios</button> 
                            </form>

                            <div class="separadorConfig mt-5"></div>
                            <h1>Contenido del curso</h1>

                            <div class="clasesNuevas">

                            </div>

                            <button class="btn btn-primary btnConfig" type="button" onclick="" id="newClass">Añadir clase</button>
                            <br>
                            <form action="crearCurso.php" method="post" enctype='multipart/form-data'>
                                <button class="btn btn-primary btnConfig btn-lg" type="submit" name="publish" value="publish" id="vidCheck">
                                    <?php
                                    if ($publicado == 0)
                                        echo 'Publicar curso';
                                    else
                                        echo 'Retirar curso';
                                    ?>
                                </button> 
                            </form>
                        </div>
                    </div>  
                </div>

            </div>


            <div class="barra overflow-auto">
                <div class="separador">CATEGORÍAS</div>
                <?php
                $barra = new category();
                $barra->llenaLaBarra();
                ?>
            </div>
        </div>

        <footer>

        </footer>

        <!-- Modal -->
        <div class="modal fade" id="newCatModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="newCatModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newCatModalLabel">Agregar una categoría nueva</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="crearCurso.php" method="post" enctype='multipart/form-data'>
                        <div class="modal-body">
                            <label for="nombreCat">Nombre de la categoría</label>
                            <input type="text" class="form-control campoConfig" id="nombreCat" name="nombreCat" placeholder="Nombre conciso" maxlength="50">

                            <label for="descCat">Descripción</label>
                            <input type="text" class="form-control campoConfig" id="descCat" name="descCat" placeholder="En qué consiste esta categoría" maxlength="255">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" name="addCat" value="addCat">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="seguroModal" tabindex="-1" aria-labelledby="seguroModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <h2>¿Está seguro que quiere eliminar esta clase?</h2>
                    </div>
                    <div class="modal-footer">
                        <div class="textoOculto" id="claseBorrar"></div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="borrarClase">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/files.js"></script>

    </body>
</html>