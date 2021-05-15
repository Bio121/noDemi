<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <link rel="stylesheet" href="css/style.css" media="screen">
        <script src="js/scripts.js" ;></script>

        <title>NoDemi</title>
    </head>

    <body class="sb">

        <?php
        
        if($_SESSION["privilegio"]=='Alumno'){
            header('Location: myself.php');
        }
        
        include "classes.php";
        
        $cur = new cursos();
        
        $nav = new navbar();
        $nav->simple();

        if (isset($_SESSION["usuario"])) {
            $nav->yesSession($_SESSION["usuario"], $_SESSION["privilegio"], $_SESSION["imagen"]);
        } else {
            $_SESSION["usuario"] = null;
            header('Location: index.php');
        }
        ?>

        <div class="contGlobal">
            <div class="mainContent">

                <div class="row">
                    <div class="col">
                        <div class="list-group list-group-horizontal " id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active text-center" id="list-home-list"
                               data-toggle="list" href="#list-home" role="tab" aria-controls="home">Alumnos</a>
                        </div>
                    </div>
                </div>

                <div class="listaNotas overflow-auto my-2 sb">

                    <div class="notaLista tab-content" id="nav-tabContent">
                        
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                            
                            <?php $cur->misAlumnosCurso($_SESSION["usuario"],$_POST["Detalles"]); ?>

                        </div>

                    </div>

                </div>

            </div>


            <div class="barra overflow-auto sb">

                <div class="perfil" style="color: azure;">
                    <?php $cur->misCursosDetalle($_POST["Detalles"], NULL); ?>
                    <div class="row no-gutters">
                        <div class="col py-3 text-center">
                            <?php $cur->alumnosGanancia($_POST["Detalles"]); ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

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
    </body>

</html>