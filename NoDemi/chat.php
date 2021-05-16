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
        include "classes.php";
        $compra = new mySQLphpClass();
        $nav = new navbar();
        $nav->simple();

        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php');
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            $result = $compra->get_user($_GET['user']);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $conName = $row['nombre'];
                    $conUser = $_GET['user'];
                    $conEmail = $row['correo'];
                    $conIMG = $row['imagen'];
                    $conPriv = $row['privilegio'];
                    $names = array($conUser, $_SESSION['usuario']);
                    sort($names);
                }
            } else {
                //echo '<div class="emptyMessage text-muted">este curso no cuenta con contenido</div>';
            }
        }

        if (isset($_SESSION["usuario"])) {
            $nav->yesSession($_SESSION["usuario"], $_SESSION["privilegio"], $_SESSION["imagen"]);
        } else {
            $_SESSION["usuario"] = null;
            $nav->notSession();
        }
        ?>

        <script src="https://www.gstatic.com/firebasejs/8.4.1/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.4.1/firebase-database.js"></script>

        <script>
            var firebaseConfig = {
                apiKey: "AIzaSyDw3hWD6RBCrYQ6bAinKv5Cq6BZI4gi-3c",
                authDomain: "nodemi-9e04c.firebaseapp.com",
                projectId: "nodemi-9e04c",
                storageBucket: "nodemi-9e04c.appspot.com",
                messagingSenderId: "616433481949",
                appId: "1:616433481949:web:e38f324f465cedb6f84334",
                databaseURL: 'https://nodemi-9e04c-default-rtdb.firebaseio.com/'
            };
            firebase.initializeApp(firebaseConfig);


            $(document).ready(function () {

                $(document).keypress(function (e) {
                    var key = e.which;
                    if (key == 13) // the enter key code
                    {
                        $('#send').click();
                        return false;
                    }
                });

                var yo = $('#yo').text();
                var nos = $('#nos').text();

                const chatsHere = firebase.database().ref().child(nos);


                chatsHere.on("child_added", (snap) => {
                    var mensaje = snap.val();
                    var texto = mensaje.texto;
                    var user = mensaje.yo;
                    var time = mensaje.time;
                    var read = mensaje.read;
                    var dir = snap.key

                    var clase;
                    if (user == yo) {
                        clase = 'va';
                    } else {
                        clase = 'viene';
                    }
                    var htmlSTR = '<div class="message ' + clase + '">';
                    htmlSTR += '<div class="mesText">' + texto + '</div>';
                    htmlSTR += '<div class="mesDate"><small class="text-muted">' + time + '</small></div></div>';

                    $('.chatCont').append(htmlSTR);

                    /*$(".chatCont").animate({
                     scrollTop: $(".message:last-child").position().top
                     }, 1000);*/

                });

                $('#send').click(function () {

                    var texto = $('input[name=textoEnviar]').val();
                    debugger;
                    if (texto != null) {
                        const tiempo = new Date();

                        const time = tiempo.toLocaleTimeString("en-US", {
                            hour: "2-digit",
                            minute: "2-digit",
                        });

                        var newMessage = chatsHere.push();
                        newMessage.set({
                            texto,
                            time,
                            yo
                        });

                        $('input[name=textoEnviar]').val('');
                    }

                });

            });

        </script>


        <div class="contGlobal" style="background-color: #cec2d0">
            <div class="mainContent">
                <div class="textoOculto" id="nos"><?php echo $names[0] . $names[1] . $_GET['cur']; ?></div>
                <div class="textoOculto" id="yo"><?php echo $_SESSION['usuario']; ?></div>

                <div class="chatCont sb">
                </div>
                <div class="chatSep"></div>
                <div class="chatInput align-middle">
                    <input class="form-control form-control-lg my-auto mx-3 chI" type="text" placeholder="Escribe tu mensaje..." name="textoEnviar">
                    <button type="submit" class="btn btn-primary my-1 chI" id="send">Enviar</button>
                </div>
                <div class="chatSep"></div>


            </div>


            <div class="barra overflow-auto">

                <div class="perfil" style="color: azure;">
                    <div class="row no-gutters">
                        <div class="col">
                            <?php
                            $img = "img/default.png";
                            if (!empty($conIMG)) {
                                $img = "data:image/jpg;base64," . base64_encode($conIMG);
                            }
                            ?>
                            <img src='<?php echo $img ?>' alt='Avatar' style="height: auto;">
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col py-2 text-center">
                            <h3><?php echo $conUser ?></h3>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col px-2 text-center">
                            <p><?php echo $conEmail ?></p>

                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col px-2 text-right">
                            <p><?php echo $conPriv ?></p>

                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col py-3 text-center">
                            <p><?php echo $conName ?></p>
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