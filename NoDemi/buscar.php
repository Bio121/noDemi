
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
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src= "js/scripts.js";></script>
        <meta charset="UTF-8">
        <title>NoDemi</title>
    </head>
    <body class="sb">

        <!-- NAVBAR -->
        <?php
        include "classes.php";
        $curso = new cursos();
        $nav = new navbar();
        $nav->simple();
        $regis = false;
        $mal = 0;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["salir"])) {
                session_unset();
                session_destroy();
                $nav->notSession();
            } else {
                $ses = new inicioRegistro();
                $usuario = $_POST["Usuario"];
                $correo = $_POST["Correo"];
                $contraseña = $_POST["Contraseña"];

                if (isset($_POST["Confirm"])) {
                    $texto = $ses->registro($correo, $usuario, $contraseña);
                    $regis = true;
                }

                $result = $ses->inicio($usuario, $correo, $contraseña);
                if (!empty($result)) {
                    $_SESSION["nombre"] = $result[0];
                    $_SESSION["paterno"] = $result[1];
                    $_SESSION["materno"] = $result[2];
                    $_SESSION["correo"] = $result[3];
                    $_SESSION["usuario"] = $result[4];
                    $_SESSION["contraseishon"] = $result[5];
                    $_SESSION["imagen"] = $result[6];
                    $_SESSION["genero"] = $result[7];
                    $_SESSION["nacimiento"] = $result[8];
                    $_SESSION["privilegio"] = $result[9];
                    $nav->yesSession($_SESSION["usuario"], $_SESSION["privilegio"], $_SESSION["imagen"]);
                } else {
                    if ($regis) {
                        $mal += 1;
                    }
                    $mal += 1;
                    $_SESSION["usuario"] = null;
                    $nav->notSession();
                }
            }
        } else {
            if (isset($_SESSION["usuario"])) {
                $nav->yesSession($_SESSION["usuario"], $_SESSION["privilegio"], $_SESSION["imagen"]);
            } else {
                $_SESSION["usuario"] = null;
                $nav->notSession();
            }
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["opcFecha"])) {
                $opcFecha = $_GET["opcFecha"];
            }
            else
                $opcFecha = 0;
            if (isset($_GET["opcTitulo"])) {
                $opcTitulo = $_GET["opcTitulo"];
            }
            else
                $opcTitulo = 0;
            
            if (isset($_GET["opcDificultad"])) {
                $opcDificultad = $_GET["opcDificultad"];
            }
            else
                $opcDificultad = 0;
            if (isset($_GET["opcPaga"])) {
                $opcPaga = $_GET["opcPaga"];
            }
            else
                $opcPaga = -1;
            
            
            
            if (isset($_GET["busqueda"])) {
                $busqueda = $_GET["busqueda"];
            } else {
                $busqueda = "";
            }

            if (isset($_GET["inicio"])) {
                $inicio = $_GET["inicio"];
            } else
                $inicio = NULL;


            if (isset($_GET["final"])) {
                $fin = $_GET["final"];
            } else
                $fin = NULL;
        }
        ?>
    <!-- FIN NAVBAR -->

        <div class="contGlobal">

            <div class="mainContentB" style="min-height: 50em;">
                <div class="contariner">
                
                <form action="buscar.php" method="get" class="">
                <div class="row">
                    
                 
                <div class="col-8">
               
                    <h3>Buscar por</h3>
                    <input type="checkbox" id="opcFecha" name="opcFecha" value="1"<?php if($opcFecha == 1) echo "checked"  ?>>
                    <label for="opcFecha" class="pr-3"> Por fecha</label>
                    <input type="checkbox" id="opcTitulo" name="opcTitulo" value="1"<?php if($opcTitulo == 1) echo "checked"  ?>>
                    <label for="opcTitulo" class="pr-3"> Título, descripción o creador del curso</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg" name="busqueda" id="busqueda"  placeholder="búsqueda" value="<?php echo $busqueda ?>">
                        <div class="input-group-append">
                           <input type="hidden" name="opcNovato" value="0" />
                            <button href='#!' class='btn  btn-outline-secondary' type='submit'>Buscar</button>
                        </div>
                    </div>
                    <label  for="inicio" class="user-select-none">Inicio de búsqueda</label>
                    <input type="date" id="inicio" class="campoConfig" name="inicio" min="2000-01-01" max="<?php echo date("Y-m-d") ?>"placeholder="<?php echo date("Y-m-d") ?>" value="<?php echo $inicio ?>">
                    <label  for="final" class="user-select-none">Final de búsqueda</label>
                    <input type="date" id="final" class="campoConfig" name="final" min="2000-01-01" max="<?php echo date("Y-m-d") ?>"placeholder="<?php echo date("Y-m-d") ?>" value="<?php echo $fin ?>">

               
                </div>
                     <div class="col-4">
                   
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        nivel
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">

                                        <input type="checkbox" id="opcNovato" name="opcDificultad" value="1"<?php if($opcDificultad == 1) echo "checked"  ?>>
                                        <label for="opcNovato" class="pr-3" > Novato</label>
                                        <br>
                                        <input type="checkbox" id="opcMedio" name="opcDificultad" value="2"<?php if($opcDificultad == 2) echo "checked"  ?>>
                                        <label for="opcMedio" class="pr-3"> Medio</label>
                                        <br>
                                        <input type="checkbox" id="opcExperto" name="opcDificultad" value="3"<?php if($opcDificultad == 3) echo "checked"  ?>>
                                        <label for="opcExperto" class="pr-3"> Experto</label>

                                    
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Precio
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    

                                        <input type="checkbox" id="opcPaga" name="opcPaga" value=".01"<?php if($opcPaga == .01) echo "checked"  ?>>
                                        <label for="opcPaga" class="pr-3"> Paga</label>
                                        <br>
                                        <input type="checkbox" id="opcGratuito" name="opcPaga" value="2"<?php if($opcPaga == 2) echo "checked"  ?>>
                                        <label for="opcGratuito" class="pr-3"> Gratuito</label>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                
                <div class="col-8">
                <div class="separador"></div>
                <div class="row text-center">
                    <?php
                        $curso->buscar2($busqueda, $inicio, $fin, $opcFecha,$opcTitulo,$opcDificultad, $opcPaga);
                    ?>
                </div>
                
                </div>

                </div> </form>
               </div> 

            </div>


            

            <footer>
                


            </footer>
        </div>
    </body>
</html>
