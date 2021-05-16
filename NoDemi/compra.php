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
        <script type="text/javascript" src="js/mifacebook.js"></script>
        <script src="js/scripts.js" ;></script>
        <meta charset="UTF-8">
        <title>NoDemi</title>
        <script type="text/javascript">
	function shareFB() {
		var nombreCurs = $("#cursoNombre").val();
		shareScore(nombreCurs);
		
	}
	</script>
    </head>

    <body class="sb">

        <?php
        include "classes.php";
        $curso = new cursos();
        $compra = new mySQLphpClass();
        $nav = new navbar();
        $nav->simple();
        $compraBoto = 0;
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST["pagar"])) {
                $codigo = $_POST["pagar"];
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
                    $img_str2 = 'img/default.png';
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
                $compra = $compra->cursoXusuario(null, $_SESSION["usuario"], $codigo, null, "i");
                echo '<script type="text/javascript">
                     alert("Compra exitosa");
                     </script>';
                $compraBoto = $curso->compradoBoto($_SESSION["usuario"], $codigo);
                
                //header('Location: index.php');
            }
            
            if (isset($_POST["buy"])) {
                $codigo = $_POST["buy"];
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
                    $img_str2 = 'img/default.png';
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

        if (isset($_SESSION["usuario"])) {
            $nav->yesSession($_SESSION["usuario"], $_SESSION["privilegio"], $_SESSION["imagen"]);
        } else {
            $_SESSION["usuario"] = null;
            $nav->notSession();
        }
        ?>

        <!--CONTENIDO (INICIO)-->
        <div class="contGlobal" style="background-color: #cec2d0">

            <div class="container">

                <div class="row">

                    <div class="col mt-5">
                        
                        <div class="row">
                            <?php
                            if($compraBoto == 0){
                                echo '<h2>Resumen de la compra</h2>';
                            }
                            else{
                                 echo '<h2>Gracias por comprar con nosotros</h2>';
                            };
                            ?>
                            
                        </div>
                        <div class="row">
                           <?php 
                           if($compraBoto == 0){echo'El curso: '; echo $nombre;}
                           else{
                               echo'<p>Compártelo con tus amigos</p>';
                           } 
                           ?>
                        </div>
                        <div class="row">
                            
                        </div>
                        <?php if($compraBoto == 0){
                            echo'<div class="row">
                                <form action="compra.php" method="POST" enctype="multipart/form-data">
                                    <button class="btn btn-primary btnConfig" type="submit" name="pagar" value="'. $codigo.'" >Pagar</button>
                                </form>
                            </div>';
                        }
                        else{
                            
                            echo '<input id="cursoNombre" type="hidden" name="cursoNombre" value="'. $nombre .'"><button class="btn btn-primary btnConfig" onclick="shareFB();">Compartir en Facebook</button>';
                        }?>
                    </div>

                    <div class="col-4 pb-5" style="background-color: #e9e9e9">
                        <div class="row justify-content-center p-5">
                            <img src="<?php echo $img_str; ?>" alt="" style="width: 100%; height: auto; border-radius: 20px; margin-top: 3rem;">
                        </div>
                        <div class="row justify-content-center p-3">
                            <h3 class="text-center"><?php echo $nombre; ?></h3> 
                        </div>
                        <div class="row justify-content-center">
                            por <?php echo $tName; ?>
                        </div>
                        <div class="row justify-content-center p-3 mb-5">
                            <h4 class="mb-5"><?php echo $precio; ?></h4>
                        </div>
                    </div>

                </div>

            </div>

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