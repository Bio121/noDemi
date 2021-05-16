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
                height: fit-content;
                width: fit-content;
            }
        </style>
    </head>

    <body>
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
                <p class="cursive">Daniel Alejandro Jacobo Hernández</p>
                <div class="mt-5">
                    <p style="font-size: large;">Por haber concluído satisfactoriamente el curso:
                        <span>
                            <strong>
                                Cómo aprender a raparse cada día de la
                                vida.
                            </strong>
                        </span>
                    </p>
                    <p>Es un placer para nosotros como institución el ser facilitadores de
                        aprendizajes para personas especiales que se interesan en la adquisición del conocimiento.</p>
                </div>

            </div>

        </div>

    </body>

</html>