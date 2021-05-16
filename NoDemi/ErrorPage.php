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
            .errorScreen{
                position: absolute;
                top: 0;
                left: 0;
                display: flex;
                background-color: #e29bb0;
                width: 100%;
                height: 100%;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
                min-height: 100vh;
            }
        </style>
    </head>

    <body>

        <?php
        include 'mySQLphpClass.php';

        $cl = new mySQLphpClass();

        $error = false;

        $errArr = ['No es posible generar el certificado, ya que no hay ningún nombre registrado a esta cuenta.',
            'El certificado solo puede generarse una vez se hayan cursado todas las clases.',
            'Es imposible generar certificados para cursos que no han sido publicados.'
        ];

        $htmlSTR = '<div class="errorMess"><h1>Hubo un error al tratar de ver la página.</h1></div>';
        if (isset($_GET['err'])) {

            foreach ($_GET['err'] as $row) {
                $htmlSTR = $htmlSTR . '<div class="errorMess">' . $errArr[$row] . '</div>';
            }
        }
        ?>

        <div class="errorScreen">
            <?php
            echo $htmlSTR;
            ?>
        </div>

    </body>

</html>