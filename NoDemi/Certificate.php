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

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
        <script src="js/html2canvas.min.js"></script>

        <script src="js/scripts.js" ;></script>
        <link rel="stylesheet" href="css/style.css" media="screen">
        <title>NoDemi</title>

        <style>
            canvas{
                position: absolute;
                top: 0;
                left: 0;
            }
            body{
                overflow: none;
            }
        </style>
    </head>

    <body>

        <?php
        include 'mySQLphpClass.php';

        $cl = new mySQLphpClass();

        $error = false;
        $errArr = array();

        if (isset($_GET['cur']) && isset($_GET['user'])) {

            $progresion = 0;
            $res = $cl->progreso($_GET['cur'], $_GET['user']);
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $progresion = $row["progreso"];
                }
            }
            echo $progresion;

            if ($progresion == 100) {

                $user = $cl->get_user($_GET['user']);
                $nameUser = 'No funcion??';
                if ($user->num_rows > 0) {
                    while ($row = $user->fetch_assoc()) {
                        $nameUser = $row['nombre'];
                        if (empty($nameUser) || strlen($nameUser) < 3) {
                            $error = true;
                            array_push($errArr, 0);
                        }
                    }
                }

                $curso = $cl->get_curso_unique($_GET['cur']);
                if ($curso->num_rows > 0) {
                    while ($row = $curso->fetch_assoc()) {
                        $nameCurso = $row['nombre'];
                        if ($row['publicado'] == 0) {
                            $error = true;
                            array_push($errArr, 2);
                        }
                    }
                }
            }
            else{
                $error = true;
            }

            if ($error) {
                $gerSTR = '';
                foreach ($errArr as $row) {
                    $getSTR = $gerSTR . 'err[]=' . $row . '&';
                }
                header('Location: ErrorPage.php?' . $getSTR);
            }
        }
        else{
            header('Location: ErrorPage.php');
        }
        ?>
        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
        <script src="js/PDFar.js"></script>


        <div class="certificado" id="certif">
            <img src="img/seal.png" alt="" class="seal">
            <img src="img/firma.png" alt="" class="firma">
            <div class="sup1"></div>
            <div class="sup2"></div>
            <div class="inf1"></div>
            <div class="inf2"></div>
            <div class="center-col">
                <p class="empresa my-3">NoDemi</p>
                <p class="titleCert">CERTIFICADO</p>
                <p style="font-size: larger;" class="py-3"><strong>NoDemi tiene el gusto de certificar a:</strong></p>
                <p class="cursive"><?php echo $nameUser; ?></p>
                <div class="mt-5">
                    <p style="font-size: large;">Por haber conclu??do satisfactoriamente el curso:
                        <span>
                            <strong>
                                <?php echo $nameCurso; ?>
                            </strong>
                        </span>
                    </p>
                    <p>Es un placer para nosotros como instituci??n el ser facilitadores de
                        aprendizajes para personas especiales que se interesan en la adquisici??n del conocimiento.</p>
                </div>

            </div>

        </div>

    </body>

</html>