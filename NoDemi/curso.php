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
        <meta charset="UTF-8">
        <title>NoDemi</title>
    </head>

    <body class="sb">

        <?php
        include "classes.php";
        $curso = new cursos();
        $nav = new navbar();
        $nav->simple();
        $byebye = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST["pagar"])) {
                echo '<script type="text/javascript">
                     alert("Compra exitosa");
                     </script>';
                header('Location: index.php');
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            if (isset($_GET["cur"])) {
                $codigo = $_GET["cur"];
                $cur = new mySQLphpClass();
                $result = $cur->get_curso_unique($codigo);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $codigo = $row["código"];
                    $nombre = $row["nombre"];
                    $desc = $row["descripcion"];
                    $precio = $row["precio"];
                    $imagen = $row["imagen"];
                    $img_str = 'img/banner.jpg';
                    if(!empty($imagen)){
                        $img_str = 'data:image/jpg;base64,' . base64_encode($imagen);
                    }
                    $incluye = $row["incluye"];
                    $lastUpdate = $row["lastUpdate"];
                    $tName = $row["nombreUser"] . ' ' . $row["apellidoUser"];
                    $userIMG = $row["userIMG"];
                    $img_str2 = 'https://pbs.twimg.com/media/EiNYM5CWAAAh9PV?format=png&name=240x240';
                    if(!empty($userIMG)){
                        $img_str2 = 'data:image/jpg;base64,' . base64_encode($userIMG);
                    }
                    $publicado = $row["publicado"];
                    if ($publicado != 1) {
                        $byebye = true;
                    }
                } else {
                    $byebye = true;
                }
            }
        }
        
        if ($byebye) {
            header('Location: index.php');
        }

        if (isset($_SESSION["usuario"])) {
            $nav->yesSession($_SESSION["usuario"], $_SESSION["privilegio"], $_SESSION["imagen"]);
        } else {
            $_SESSION["usuario"] = null;
            $nav->notSession();
        }
        ?>

        <!--CONTENIDO (INICIO)-->
        <div class="contGlobal">

            <div class="mainContent">


                <div class="container">
                    <div class="row py-3">
                        <div class="col">
                            <div class="jumbotron" style="background: #e1cce5">
                                <h1><?php echo $nombre; ?></h1>
                                <br>
                                <h6>
                                    Última modificación: <?php echo $lastUpdate; ?>.
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="row py-3 ">

                        <img src="<?php echo $img_str; ?>" alt="" style="width: 100%; height: auto;" class="mb-5">

                        <div class="col-8">
                            <h4>Incluye</h4>
                            <p><?php echo $incluye; ?></p>
                        </div>
                        <div class="col-4">
                            <h1>MXN$ <?php echo $precio; ?></h1>
                            <form action="compra.php" method="POST" enctype="multipart/form-data">
                                <button class="btn btn-primary btnConfig" type="submit" name="buy" value="<?php echo $codigo; ?>"<?php echo $curso->compradoONo( $_SESSION["usuario"],$codigo) ?> </button>
                            </form>
                        </div>
                    </div>
                    <div>
                        <h4>Requisitos</h4>
                        <ul>
                            <li>pintura de aceite</li>
                        </ul>
                    </div>
                    <div>
                        <h1>Descripción</h1>
                        <p><?php echo $desc; ?></p>
                    </div>

                    <h3>Contenido</h3>

                    <div>
                        <div class="accordion" id="accordionExample">
                            <?php
                    $curso->nivelesCursos($_GET["cur"]);
                    ?>
                        </div>
                    </div>


                </div>
                <div class="row py-3">
                    <div class="col">
                        <div class="autor">
                            <div class="row no-gutters">
                                <div class="col-3">
                                    <img src="<?php echo $img_str2; ?>"
                                         alt="Avatar">
                                </div>
                                <div class="col-9 text-center m-auto text-wrap"><?php echo $tName; ?></div>
                            </div>

                        </div>
                        <div class="calificacionC">
                            <h2 class="child">calificacion: 5.0</h2>
                            <input id="radio10" class="child" type="radio" name="estrellas" value="50">
                            <label id="estrella" for="radio1">★</label>
                        </div>
                    </div>
                </div>
                <br><br><br>



                <div class="separador">
                    <h3>También podría interesarte...</h3>
                </div>

                <div class="row text-center">
                    <?php
                    $curso->categoriasIgualesCurso($_GET["cur"], 3);
                    ?>
                </div>
                <br>




                <div class="separador"></div>
                <!--SECCIÓN DE COMENTARIOS-->
                <div class="col">
                    Calificación del curso.
                </div>
                <form>

                    <div class="calificacionC">
                        <h1 class="child">5.0</h1>
                        <p class="clasificacion ">
                            <input id="radio1" type="radio" name="estrellas" value="5">
                            <label id="estrella" for="radio1">★</label>
                            <input id="radio2" type="radio" name="estrellas" value="4">
                            <label id="estrella" for="radio2">★</label>
                            <input id="radio3" type="radio" name="estrellas" value="3">
                            <label id="estrella" for="radio3">★</label>
                            <input id="radio4" type="radio" name="estrellas" value="2">
                            <label id="estrella" for="radio4">★</label>
                            <input id="radio5" type="radio" name="estrellas" value="1">
                            <label id="estrella" for="radio5">★</label>
                        </p>
                    </div>

                </form>
                <div class="row mt-3">
                    <div class="col">
                        Hey, déjanos un comentario.
                    </div>
                </div>
                <div class="row mt-2">

                    <div class="col-lg-10 m-auto">
                        <textarea style="width:100%"></textarea>
                    </div>
                    <div class="col-lg-2 p-0 p-sm-2 p-lg-0">
                        <button type="button" class="btn btn-primary btn-lg btn-block">Enviar</button>
                    </div>
                </div>
                <div class="listaNotas overflow-auto my-2">

                    <div class="comentario">
                        <img src="https://pbs.twimg.com/media/EiNYM5CWAAAh9PV?format=png&name=240x240" />
                        <div class="comentext">
                            <h4>Pollito</h4>
                            No pues la verdad pobre de ese sujeto, quién sabe qué habría sido si hubiera ganado.
                            <small class="text-muted"><br>Hace 5 minutos</small>
                        </div>
                    </div>

                    <div class="comentario">
                        <img src="https://pbs.twimg.com/media/EiNYONQXkAEvm5d?format=png&name=360x360" />
                        <div class="comentext">
                            <h4>Vela en Cubo</h4>
                            Sinceramente no entiendo a quién le puede interesar una noticia como esta. Ese juegot tiene como
                            un siglo y la verdad nadie lo sabe jugar. Ojalá que el perdedor del que hablan en la noticia se
                            encuentre un juego de verdad en lugar de seguir con esa porquería que nadie quiere.
                            <small class="text-muted"><br>Hace 8 minutos</small>
                        </div>
                    </div>

                </div>


            </div>

            <!--BARRA (INICIO)-->
            <div class="barra overflow-auto sb">
                <div class="separador">CATEGORÍAS</div>
<?php
$barra = new category();
$barra->llenaLaBarra();
?>
            </div>
            <!--BARRA (FIN)-->
        </div>
        <!--CONTENIDO (FIN)-->

        <!--FOOTER (INICIO)-->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col">
                        qué onda
                    </div>
                    <div class="col">
                        qué tal
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        cómo va todo?
                    </div>
                </div>
            </div>
        </footer>
        <!--FOOTER (FIN)-->

    </body>

</html>