<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of barraCategory
 *
 * @author ira3ck
 */
include 'mySQLphpClass.php';

class category {

    function llenaLaBarra() {
        $conn = new mySQLphpClass();
        $result = $conn->get_secciones();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row["Estado"] == "a") {
                    $nombre = rawurlencode($row["Nombre"]);
                    echo "<div class='category user-select-none' onclick=" . "Redirect('index.php?variable1=" . $nombre . "')" . " style='background: #" . $row["Color"] . "'>" . $row["Nombre"] . "</div>";
                }
            }
        } else {
            echo "0 results";
        }
        $conn = null;
    }

    function seleccionCategoria() {
        $conn = new mySQLphpClass();
        $result = $conn->get_secciones();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nombre = rawurlencode($row["Nombre"]);
                if ($row["Estado"] == "a") {
                    $estar = "activo";
                } else {
                    $estar = "inactivo";
                }
                echo "<div class='card listaCard' onclick=" . "Redirect('creacionSeccion.php?color=" . $row["Color"] . "&nombre=" . $nombre . "&orden=" . $row["Orden"] . "&estado=" . $row["Estado"] . "')" . " style='background: #" . $row["Color"] . "'>
                    <div class='row no-gutters'>
                        <div class='col-md-8'>
                            <div class='card-body'>
                                <h5 class='card-title'>" . $row["Nombre"] . "</h5>
                                <p class='card-text'>
                                    " . $estar . "
                                </p>
                            </div>
                        </div></div></div>";
            }
        } else {
            echo "0 results";
        }
        $conn = null;
    }

    function EliminarCategoria() {
        $conn = new mySQLphpClass();
        $result = $conn->get_secciones();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nombre = rawurlencode($row["Nombre"]);
                if ($row["Estado"] == "a") {
                    echo "<div class='card listaCard' onclick=" . "Redirect('EliminarSeccion.php?variable1=" . $row["Color"] . "&variable2=" . $nombre . "&variable3=" . $row["Orden"] . "&variable4=" . $row["Estado"] . "')" . " style='background: #" . $row["Color"] . "'>
                    <div class='row no-gutters'>
                        <div class='col-md-8'>
                            <div class='card-body'>
                                <h5 class='card-title'>" . $row["Nombre"] . "</h5>
                                <p class='card-text'>
                                    " . $row["Orden"] . "
                                </p>
                            </div>
                        </div></div></div>";
                }
            }
        } else {
            echo "0 results";
        }
        $conn = null;
    }

    function CrearCategoria($orden, $color, $nombre, $estado, $nuevoNombre, $Seleccion) {
        $conn = new mySQLphpClass();
        $conn->Crear_secciones($orden, $color, $nombre, $estado, $nuevoNombre, $Seleccion);
        $conn = null;
    }

    function dropdown() {
        $conn = new mySQLphpClass();
        $result = $conn->get_seccionesEX();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<input type="submit" class="dropdown-item" value="' . $row["Nombre"] . '" name="categorei">';
            }
        } else {
            echo "0 results";
        }
        $conn = null;
    }

}

class noticias {

    function enHome($cant, $opc, $categoria) {
        $conn = new mySQLphpClass();
        $result = $conn->get_noticias($cant);
        $img = '#';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if (array_key_exists('imagen', $row)) {
                    $img = $row["imagen"];
                }
                if ($opc == "T") {
                    $piece = "'noticia.php?new=" . $row["C??digo"] . "';";
                    $redirect = '"window.location = ' . $piece . '"';
                    $now = time();
                    $target = strtotime($row["fechaPublicado"]);
                    $diff = $now - $target;
                    echo "<div class='nota' onclick=" . $redirect . ">";
                    if ($diff <= 68417) {
                        echo "<div class='flash'>????LTIMO MOMENTO!</div>";
                    }
                    echo "<div class='row no-gutters'>
                          <div class='col-12'><h2>" . $row["T??tulo"] . "</h2></div></div>
                          <div class='row no-gutters'><div class='col-lg-5'>
                          <img src='data:image/jpg;base64," . $img . "' class='notaIMG' alt='...'>
                          </div><div class='col-lg-7 p-2'><div class='row no-gutters' style='height: 90%;'>
                          <p>" . $row["Descripci??n"] . "</p></div><div class='row no-gutters'>
                          <div class='col'><p class='autor'>" . $row["Nombre_Rep"] . " - " . $row["fechaPublicado"] .
                    "</p></div></div></div></div></div>";
                }
                if ($opc == "C") {
                    if ($categoria == $row["Secci??nFK"]) {
                        $piece = "'noticia.php?new=" . $row["C??digo"] . "';";
                        $redirect = '"window.location = ' . $piece . '"';
                        $now = time();
                        $target = strtotime($row["fechaPublicado"]);
                        $diff = $now - $target;
                        echo "<div class='nota' onclick=" . $redirect . ">";
                        if ($diff <= 68417) {
                            echo "<div class='flash'>????LTIMO MOMENTO!</div>";
                        }
                        echo "<div class='row no-gutters'>
                                  <div class='col-12'><h2>" . $row["T??tulo"] . "</h2></div></div>
                                  <div class='row no-gutters'><div class='col-lg-5'>
                                  <img src='data:image/jpg;base64," . $img . "' class='notaIMG' alt='...'>
                                  </div><div class='col-lg-7 p-2'><div class='row no-gutters' style='height: 90%;'>
                                  <p>" . $row["Descripci??n"] . "</p></div><div class='row no-gutters'>
                                  <div class='col'><p class='autor'>" . $row["Nombre_Rep"] . " - " . $row["fechaPublicado"] .
                        "</p></div></div></div></div></div>";
                    }
                }
            }
        } else {
            echo "0 results";
        }
    }

    function buscar($buscar, $inicio, $fin, $cant) {
        $timeinicio = "00:00:00";
        $timefin = "23:59:59";
        if ($inicio == null)
            $inicio = "1900-01-01";
        else
            $inicio = date('Y-m-d H:i:s', strtotime("$inicio $timeinicio"));
        if ($fin == null)
            $fin = date("Y-m-d H:i:s");
        else
            $fin = date('Y-m-d H:i:s', strtotime("$fin $timefin"));
        $conn = new mySQLphpClass();
         $ind = 0;
        $result = $conn->get_noticiasBusqueda($buscar, $inicio, $fin, $cant);
        $img = '#';
        if($result){
            if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                    $piece = "'noticia.php?new=" . $row["C??digo"] . "';";
                    $redirect = '"window.location = ' . $piece . '"';
                    $now = time();
                    $ind = $ind + 1;
                    $target = strtotime($row["fechaPublicado"]);
                    $diff = $now - $target;
                    if (array_key_exists('imagen', $row)) {
                        $img = $row["imagen"];
                    }
                    if ($ind == 1) {
                        echo "<div class='carousel-item active'><div class='nota' onclick=" . $redirect . ">";
                    }
                    if ($ind > 1) {
                        echo "<div class='carousel-item'><div class='nota' onclick=" . $redirect . ">";
                    }
                    if ($diff <= 68417) {
                        echo "<div class='flash'>????LTIMO MOMENTO!</div>";
                    }
                    echo "<div class='row no-gutters'>
                        <div class='col-12'><h2>" . $row["T??tulo"] . "</h2></div></div>
                        <div class='row no-gutters'><div class='col-lg-5'></div><img src='data:image/jpg;base64," . $img . "' class='notaIMG' alt='...'><div class='col-lg-7 p-2'><div class='row no-gutters' style='height: 90%;'>
                        <p>" . $row["Descripci??n"] . "</p></div><div class='row no-gutters'>
                        <div class='col'><p class='autor'>" . $row["Nombre_Rep"] . " - " . $row["fechaPublicado"] . "</p></div></div></div></div></div></div>";
                }
            } else {
                echo "0 results";
            }
         }else {
                echo "0 results";
            }
         
    }
    
    function buscar2($buscar, $inicio, $fin, $fecha, $titulo, $palabra) {
        $timeinicio = "00:00:00";
        $timefin = "23:59:59";
        if ($inicio == null)
            $inicio = "1900-01-01";
        else
            $inicio = date('Y-m-d H:i:s', strtotime("$inicio $timeinicio"));
        if ($fin == null)
            $fin = date("Y-m-d H:i:s");
        else
            $fin = date('Y-m-d H:i:s', strtotime("$fin $timefin"));
        $conn = new mySQLphpClass();
        $result = $conn->get_noticiasBusqueda2($buscar, $inicio, $fin, $fecha, $titulo, $palabra);
        $img = '#';
        if($result){
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if (array_key_exists('imagen', $row)) {
                        $img = $row["imagen"];
                    }

                    $piece = "'noticia.php?new=" . $row["C??digo"] . "';";
                    $redirect = '"window.location = ' . $piece . '"';
                    $now = time();
                    $target = strtotime($row["fechaPublicado"]);
                    $diff = $now - $target;
                    echo "<div class='nota' onclick=" . $redirect . ">";
                    if ($diff <= 68417) {
                        echo "<div class='flash'>????LTIMO MOMENTO!</div>";
                    }
                    echo "<div class='row no-gutters'>
                              <div class='col-12'><h2>" . $row["T??tulo"] . "</h2></div></div>
                              <div class='row no-gutters'><div class='col-lg-5'>
                              <img src='data:image/jpg;base64," . $img . "' class='notaIMG' alt='...'>
                              </div><div class='col-lg-7 p-2'><div class='row no-gutters' style='height: 90%;'>
                              <p>" . $row["Descripci??n"] . "</p></div><div class='row no-gutters'>
                              <div class='col'><p class='autor'>" . $row["Nombre_Rep"] . " - " . $row["fechaPublicado"] .
                    "</p></div></div></div></div></div>";
                }
            } else {
                echo "0 results";
            }
         }else {
                echo "0 results erro";
            }
         
    }

    function Vistas($cant) {
        $conn = new mySQLphpClass();
        $ind = 0;
        $result = $conn->get_noticiasNew($cant);
        $img = '#';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $piece = "'noticia.php?new=" . $row["C??digo"] . "';";
                $redirect = '"window.location = ' . $piece . '"';
                $now = time();
                $ind = $ind + 1;
                $target = strtotime($row["fechaPublicado"]);
                $diff = $now - $target;
                if (array_key_exists('imagen', $row)) {
                    $img = $row["imagen"];
                }
                if ($ind == 1) {
                    echo "<div class='carousel-item active'><div class='nota' onclick=" . $redirect . ">";
                }
                if ($ind > 1) {
                    echo "<div class='carousel-item'><div class='nota' onclick=" . $redirect . ">";
                }
                if ($diff <= 68417) {
                    echo "<div class='flash'>????LTIMO MOMENTO!</div>";
                }
                echo "<div class='row no-gutters'>
                        <div class='col-12'><h2>" . $row["T??tulo"] . "</h2></div></div>
                        <div class='row no-gutters'><div class='col-lg-5'></div><img src='data:image/jpg;base64," . $img . "' class='notaIMG' alt='...'><div class='col-lg-7 p-2'><div class='row no-gutters' style='height: 90%;'>
                        <p>" . $row["Descripci??n"] . "</p></div><div class='row no-gutters'>
                        <div class='col'><p class='autor'>" . $row["Nombre_Rep"] . " - " . $row["fechaPublicado"] . "</p></div></div></div></div></div></div>";
            }
        } else {
            echo "0 results";
        }
    }
    
    

    function misNoticias($usuario, $orden, $estado) {
        $conn = new mySQLphpClass();
        $result = $conn->get_misNoticias($usuario, $orden, $estado, null);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                echo '<div class="card listaCard"><div class="row no-gutters"><div class="col-md-4">
                      <img src="data:image/jpg;base64,' . $row["imagen"] . '" class="card-img" alt="...">
                      </div><div class="col-md-8"><div class="card-body"><h5 class="card-title">' . $row["t??tulo"] . '</h5><p class="card-text">'
                . $row["descripci??n"] . '</p><div class="row no-gutters"><div class="col-10">
                      <p class="card-text"><small class="text-muted">??ltima actualizaci??n ' . $row["lastUpdate"] . '</small></p></div>
                      <div class="col-2"><form action="preview.php" method="post" enctype="multipart/form-data" class="form-inline">
                      <button type="submit" name="existent" value="' . $row["c??digo"] . '" class="btn btn-secondary" >IR</button>
                      </form></div></div></div></div></div></div>';
            }
        } else {
            echo "0 results";
        }
    }

    function lasNoticias($orden, $estado) {
        $conn = new mySQLphpClass();
        $result = $conn->get_lasNoticias($orden, $estado, null);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                echo '<div class="card listaCard"><div class="row no-gutters"><div class="col-md-4">
                      <img src="data:image/jpg;base64,' . $row["imagen"] . '" class="card-img" alt="...">
                      </div><div class="col-md-8"><div class="card-body"><h5 class="card-title">' . $row["t??tulo"] . '</h5><p class="card-text">'
                . $row["descripci??n"] . '</p><div class="row no-gutters"><div class="col-10">
                      <p class="card-text"><small class="text-muted">??ltima actualizaci??n ' . $row["lastUpdate"] . '</small></p></div>
                      <div class="col-2"><form action="previewEditor.php" method="post" enctype="multipart/form-data" class="form-inline">
                      <button type="submit" name="existent" value="' . $row["c??digo"] . '" class="btn btn-secondary" >IR</button>
                      </form></div></div></div></div></div></div>';
            }
        } else {
            echo "0 results";
        }
    }

}

class navbar {

    private $inSes;
    private $regis;

    function navbar() {
        $this->inSes = "<div class = 'dropdown ml-auto iniciarSesionDrop'><button class = 'btn btn-secondary dropdown-toggle pull-right' type = 'button' id = 'dropdownMenuButton' data-toggle = 'dropdown' aria-haspopup = 'true' aria-expanded = 'false'>
                  Iniciar Sesi??n</button><div class = 'dropdown-menu dropdown-menu-right'><form class = 'px-4 py-3' action = 'index.php' onsubmit = 'return validacionInicioSesion()' method = 'post' enctype='multipart/form-data'>
                  <div class = 'form-group'><label for = 'emailIniciarSecion'>Email</label><input type = 'email' class = 'form-control' id = 'emailIniciarSesion' placeholder = 'correo@ejemplo.com' name = 'Correo'>
                  </div><div class = 'form-group'><label for = 'usuarioIniciarSesion'>Usuario</label><input type = 'text' class = 'form-control' id = 'usuarioIniciarSesion' placeholder = 'Usuario' name = 'Usuario'>
                  </div><div class = 'form-group'><label for = 'contrase??aIniciarSesion'>Contrase??a</label><input type = 'password' class = 'form-control' id = 'contrase??aIniciarSesion' placeholder = 'Contrase??a' name = 'Contrase??a'>
                  </div><button type = 'submit' class = 'btn btn-primary' >Iniciar Sesi??n</button></form></div></div>";
        $this->regis = "<div class = 'dropdown RegistrarseDrop'><button class = 'btn btn-secondary dropdown-toggle pull-right' type = 'button' id = 'dropdownMenuButton' data-toggle = 'dropdown' aria-haspopup = 'true' aria-expanded = 'false'>
                  Registrarse</button><div class = 'dropdown-menu dropdown-menu-right'><form class = 'px-4 py-3' action = 'index.php' onsubmit = 'return validacionRegistrarse()' method = 'post' enctype='multipart/form-data'>
                  <div class = 'form-group'><label for = 'emailRegistrarse'>Email</label><input type = 'email' class = 'form-control' id = 'emailRegistrarse' placeholder = 'correo@ejemplo.com' name = 'Correo'>
                  </div><div class = 'form-group'><label for = 'usuarioRegistrarse'>Usuario</label><input type = 'text' class = 'form-control' id = 'usuarioRegistrarse' placeholder = 'Usuario' name = 'Usuario'>
                  </div><div class = 'form-group'><label for = 'telefonoRegistrarse'>Tel??fono</label><input type = 'text' class = 'form-control' id = 'telefonoRegistrarse' placeholder = 'Tel??fono' name = 'Phone'>
                  </div><div class = 'form-group'><label for = 'contrase??aRegistrarse'>Contrase??a</label><input type = 'password' class = 'form-control' id = 'contrase??aRegistrarse' placeholder = 'Contrase??a' name = 'Contrase??a'>
                  </div><div class = 'form-group'><label for = 'contrase??aConfirmarRegistrarse'>Confirmar Contrase??a</label><input type = 'password' class = 'form-control' id = 'contrase??aConfirmarRegistrarse' placeholder = 'Confirmar Contrase??a'>
                  </div><button type = 'submit' class = 'btn btn-primary' >Registrarse</button></form></div></div>";
    }

    function simple() {
        $code = "<nav class='nav navbar navbar-expand-lg navbar-dark fixed-top fixed-top-2'>
                    <form action='buscar.php' method='get' class='form-inline ml-auto'>
                        <div class='md-form my-0'>
                            <input class='form-control' type='text' name='busqueda' id='busqueda' placeholder='Search' aria-label='Search'>
                        </div>
                        <button href='#!' class='btn btn-primary btn-outline-white btn-md my-0 ml-sm-2' type='submit'>Buscar</button>
                    </form>
                </nav>";
        echo $code;
    }

    function notSession() {
        $code = "<nav class = 'nav navbar navbar-expand-lg navbar-dark fixed-top'>
                    <a class = 'navbar-brand' href = 'index.php'>Novedades del Bot</a>
                    <button class = 'navbar-toggler' type = 'button' data-toggle = 'collapse' data-target = '#navbarNavAltMarkup' aria-controls = 'navbarNavAltMarkup' aria-expanded = 'false' aria-label = 'Toggle navigation'>
                        <span class = 'navbar-toggler-icon'></span>
                    </button>
                    <div class = 'collapse navbar-collapse navbar-right' id = 'navbarNavAltMarkup'>
                        " . $this->inSes . $this->regis . "
                    </div>
                </nav>";
        echo $code;
    }

    function yesSession($nombre, $privilegio, $imagen) {
        $page = 'index.php';
        $profile = "";
        $img = "https://pbs.twimg.com/media/EiNYM5CWAAAh9PV?format=png&name=240x240";
        if ($privilegio == 'Editor') {
            $page = 'HomeEditor.php';
            $profile = "<a class='dropdown-item' href='" . $page . "'>Perfil</a>";
        }
        if ($privilegio == 'Reportero') {
            $page = 'Home.php';
            $profile = "<a class='dropdown-item' href='" . $page . "'>Perfil</a>";
        }
        echo "<nav class='nav navbar navbar-expand-lg navbar-dark fixed-top'>
                    <a class='navbar-brand' href='index.php'>Novedades del Bot</a>    
                    <div class='div-inline ml-auto  usuarioNav' > ";
        $img_str = base64_encode($imagen);
        if (!empty($imagen)) {
            $img = "data:image/jpg;base64," . $img_str;
        }
        echo '<img src="' . $img . '" class="imgNavBar float-left imagenUserNavbar" alt="img de navbar "/>';
        echo "<a class='nav-link dropdown-toggle usuarioNomNav' href='#' id='navbarDropdown nav' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            " . $nombre . " 
                        </a>
                        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='navbarDropdown'>
                            <form action = 'index.php' method = 'post'>
                                " . $profile . "
                                <a class='dropdown-item' href='ConfigUser.php'>Configuracion de Perfil</a>
                                <div class='dropdown-divider'></div>
                                <input type='submit'  href='index.php' class='button mx-3 px-5' name='salir' value='Salir' style='background=azure; border=none;'/>
                            </form>
                        </div>  
                    </div> 
                </nav>";
    }

}

class inicioRegistro {

    function inicio($usuario, $correo, $contrase??a) {
        $conn = new mySQLphpClass();
        $result = $conn->initSes($usuario, $correo, $contrase??a);
        return $result;
    }

    function registro($telefono, $correo, $usuario, $contrase??a) {
        $conn = new mySQLphpClass();
        $result = $conn->usuarios(null, null, null, $telefono, $correo, $usuario, $contrase??a, null, null, null, 'Registrado', null, 'I');
        return $result;
    }

}

class preview {

    function setStatusCard($estado) {
        switch ($estado) {
            case 'Aprobada':
                echo '<div class="card text-white bg-info text-wrap my-3 d-none d-lg-block" style="max-width: 18rem;"><div class="card-header">ESTADO</div><div class="card-body">
                  <h5 class="card-title">Revisada y Aprobada</h5><p class="card-text">La noticia ha sido aprobada, y est?? lista para ser publicada.</p></div></div>';
                break;
            case 'Pendiente':
                echo '<div class="card text-white bg-warning text-wrap my-3 d-none d-lg-block" style="max-width: 18rem;"><div class="card-header">ESTADO</div><div class="card-body">
                  <h5 class="card-title">Pendiente de correcci??n</h5><p class="card-text">La noticia no puede ser publicada porque hay uno o m??s detalles que atender.</p></div></div>';
                break;
            case 'Rechazada':
                echo '<div class="card text-white bg-danger text-wrap my-3 d-none d-lg-block" style="max-width: 18rem;"><div class="card-header">ESTADO</div><div class="card-body">
                  <h5 class="card-title">Rechazada por el Editor</h5><p class="card-text">El Editor ha decidido rechazar la noticia, por lo tanto no podr?? ser publicada.</p></div></div>';
                break;
            case 'Publicada':
                echo '<div class="card text-white bg-success text-wrap my-3 d-none d-lg-block" style="max-width: 18rem;"><div class="card-header">ESTADO</div><div class="card-body">
                   <h5 class="card-title">Publicada</h5><p class="card-text">La noticia ya ha sido publicada en el portal de noticias.</p></div></div>';
                break;
            default:
                echo 'NADA';
                break;
        }
    }

    function botonesModales($estado) {
        switch ($estado) {
            case 'Aprobada':
                echo '<button type="button" class="btn btn-info my-3 d-block d-sm-block d-md-block d-lg-none" data-toggle="modal" data-target="#modalStatus" style="width: 100%;padding-top: 100%;position: relative; padding-bottom: 0; ">
                  <p style="position: absolute; font-size: 8vw; top: 2%; left: 0%; bottom: 0; right: 0;">E</p></button>';
                break;
            case 'Pendiente':
                echo '<button type="button" class="btn btn-warning my-3 d-block d-sm-block d-md-block d-lg-none" data-toggle="modal" data-target="#modalStatus" style="width: 100%;padding-top: 100%;position: relative; padding-bottom: 0; ">
                  <p style="position: absolute; font-size: 8vw; top: 2%; left: 0%; bottom: 0; right: 0;">E</p></button>';
                break;
            case 'Rechazada':
                echo '<button type="button" class="btn btn-danger my-3 d-block d-sm-block d-md-block d-lg-none" data-toggle="modal" data-target="#modalStatus" style="width: 100%;padding-top: 100%;position: relative; padding-bottom: 0; ">
                  <p style="position: absolute; font-size: 8vw; top: 2%; left: 0%; bottom: 0; right: 0;">E</p></button>';
                break;
            case 'Publicada':
                echo '<button type="button" class="btn btn-success my-3 d-block d-sm-block d-md-block d-lg-none" data-toggle="modal" data-target="#modalStatus" style="width: 100%;padding-top: 100%;position: relative; padding-bottom: 0; ">
                   <p style="position: absolute; font-size: 8vw; top: 2%; left: 0%; bottom: 0; right: 0;">E</p></button>';
                break;
            default:
                echo 'NADA';
                break;
        }
    }

    function ventanasModales($estado, $editComm) {
        $title = '';
        $text = '';
        $color = '';
        switch ($estado) {
            case 'Aprobada':
                $title = 'ESTADO: Revisada y Aprobada';
                $color = 'bg-info';
                $text = 'La noticia ha sido aprobada, y est?? lista para ser publicada.';
                break;
            case 'Pendiente':
                $title = 'ESTADO: Pendiente de correcci??n';
                $color = 'bg-warning';
                $text = 'La noticia no puede ser publicada porque hay uno o m??s detalles que atender.';
                break;
            case 'Rechazada':
                $title = 'ESTADO: Rechazada por el Editor';
                $color = 'bg-danger';
                $text = 'El Editor ha decidido rechazar la noticia, por lo tanto no podr?? ser publicada.';
                break;
            case 'Publicada':
                $title = 'ESTADO: Publicada';
                $color = 'bg-success';
                $text = 'La noticia ya ha sido publicada en el portal de noticias.';
                break;
            default:
                echo 'NADA';
                break;
        }
        echo '<div class="modal fade" id="modalStatus" tabindex="-1" aria-labelledby="modalStatusLabel" aria-hidden="true"><div class="modal-dialog modal-dialog-centered"><div class="modal-content ' . $color . '">
              <div class="modal-header"><h5 class="modal-title" id="modalStatusLabel">' . $title . '</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button></div><div class="modal-body">' . $text . '</div></div></div></div>';
        echo '<div class="modal fade" id="modalComment" tabindex="-1" aria-labelledby="modalCommentLabel" aria-hidden="true"><div class="modal-dialog modal-dialog-centered"><div class="modal-content">
              <div class="modal-header"><h5 class="modal-title" id="modalCommentLabel">Comentarios</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button></div><div class="modal-body">' . $editComm . '</div></div></div></div>';
    }

}

class archivos {

    private $codigo;
    private $arr;

    function archivos($code) {
        $this->codigo = $code;
        $this->arr = array();
    }

    function cargarArchivos() {
        $conn = new mySQLphpClass();
        $i = 1;
        while (true) {
            $result = $conn->get_Archivos($this->codigo, null, $i);
            if (empty($result)) {
                break;
            }
            $row = $result->fetch_assoc();
            if ($row["tipo"] == 'vacio') {
                break;
            }
            $this->HTMLify($row);
            $i++;
        }
    }

    function cargarNoticia() {
        $conn = new mySQLphpClass();
        $i = 1;
        while (true) {
            $result = $conn->get_Archivos($this->codigo, null, $i);
            if (empty($result)) {
                break;
            }
            $row = $result->fetch_assoc();
            if ($row["tipo"] == 'vacio') {
                break;
            }
            $this->HTMLifyNEW($row);
            $i++;
        }
    }

    private function imashNEW($size, $orden, $imagen) {
        $id = 'modal' . $orden;
        $str = '<div class="row py-3"><div class="col" align="center">
                  <img src="data:image/jpg;base64,' . $imagen . '" class="figure-img img-fluid rounded ' . $size . '" alt="..."><div class="editBTN" data-toggle="modal" data-target="#' . $id . '">
                  </div></div></div>';
        return $str;
    }

    private function tecstoNEW($text, $orden) {
        $id = 'modal' . $orden;
        $str = '<div class = "row py-3"><div class = "col"><p>' . $text . '</p><div class="editBTN" data-toggle="modal" data-target="#' . $id . '">
                </div></div></div>';
        return $str;
    }

    private function vidioNEW($size, $orden, $video) {
        $id = 'modal' . $orden;
        $str = '<div class="row py-3"><div class="col" align="center">
                  <video controls class="figure-img img-fluid rounded ' . $size . '"><source src="data:video/mp4;base64,' . $video . '"/></video><div class="editBTN" data-toggle="modal" data-target="#' . $id . '">
                  </div></div></div>';
        return $str;
    }

    private function imash($size, $orden, $imagen) {
        $id = 'modal' . $orden;
        $str = '<div class="row py-3"><div class="col" align="center">
                  <img src="data:image/jpg;base64,' . $imagen . '" class="figure-img img-fluid rounded ' . $size . '" alt="..."><div class="editBTN" data-toggle="modal" data-target="#' . $id . '">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg></div></div></div>';
        return $str;
    }

    private function tecsto($text, $orden) {
        $id = 'modal' . $orden;
        $str = '<div class = "row py-3"><div class = "col"><p>' . $text . '</p><div class="editBTN" data-toggle="modal" data-target="#' . $id . '">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg></div></div></div>';
        return $str;
    }

    private function vidio($size, $orden, $video) {
        $id = 'modal' . $orden;
        $str = '<div class="row py-3"><div class="col" align="center">
                  <video controls class="figure-img img-fluid rounded ' . $size . '"><source src="data:video/mp4;base64,' . $video . '"/></video><div class="editBTN" data-toggle="modal" data-target="#' . $id . '">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg></div></div></div>';
        return $str;
    }

    private function imashModal($orden, $code, $tama??o) {
        $chico = '';
        $mediano = '';
        $grande = '';
        switch ($tama??o) {
            case '1': $chico = 'checked="checked"';
                break;
            case '2': $mediano = 'checked="checked"';
                break;
            case '3': $grande = 'checked="checked"';
                break;
            default: break;
        }
        $id = 'modal' . $orden;
        $str = '<div class="modal fade" id="' . $id . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="' . $id . '" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="staticBackdropLabel">Editar Imagen (PNG o JPEG ??nicamente)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                <form action="preview.php" method="post" enctype="multipart/form-data"><div class="modal-body"><div class="user-select-none"><input type="text" class="form-control" name="code" value="' . $code . '"readonly="readonly" style="color: #e9ecef;">
                </div><div class="input-group py-2"><div class="custom-file"><div class="btn btn-outline-secondary btn-rounded waves-effect float-left">
                <input type="file" id="archivo" name="image" accept="image/png,image/jpeg"></div></div></div><div id="seccion">Tama??o: </div>
                <div class="custom-control custom-radio"><input type="radio" id="chico' . $orden . '" name="sizeConfig' . $orden . '" class="custom-control-input"' . $chico . 'value="1">
                <label class="custom-control-label user-select-none" for="chico' . $orden . '">Chico</label></div><div class="custom-control custom-radio">
                <input type="radio" id="mediano' . $orden . '" name="sizeConfig' . $orden . '" class="custom-control-input"' . $mediano . 'value="2">
                <label class="custom-control-label user-select-none" for="mediano' . $orden . '">Mediano</label></div><div class="custom-control custom-radio">
                <input type="radio" id="grande' . $orden . '" name="sizeConfig' . $orden . '" class="custom-control-input"' . $grande . 'value="3">
                <label class="custom-control-label user-select-none" for="grande' . $orden . '">Grande</label></div></div><div class="modal-footer">
                <button type="submit" class="btn btn-danger" name="deleteFile" value="I' . $orden . '">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
                <button type="submit" class="btn btn-primary" name="editFile" value="I' . $orden . '">Aceptar</button></div></form></div></div></div>';
        array_push($this->arr, $str);
    }

    private function tecstoModal($text, $orden, $code) {
        $id = 'modal' . $orden;
        $str = '<div class="modal fade" id="' . $id . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="' . $id . '" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="staticBackdropLabel">Editar Texto</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
               <form action="preview.php" method="post" enctype="multipart/form-data"><div class="modal-body"><div class=" user-select-none"><input type="text" class="form-control" name="code" value="' . $code . '" readonly="readonly" style="color: #e9ecef;">
               </div><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">Texto</span></div>
               <textarea class="form-control" aria-label="titleDescModal" name="texto' . $id . '" id="textAreaField" rows="4" cols="50">' . $text . '</textarea></div></div>
               <div class="modal-footer"><button type="submit" class="btn btn-danger" name="deleteFile" value="T' . $orden . '">Eliminar</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button><button type="submit" class="btn btn-primary" name="editFile" value="T' . $orden . '">Aceptar</button></div></form></div></div></div>';
        array_push($this->arr, $str);
    }

    private function vidioModal($orden, $code, $tama??o) {
        $chico = '';
        $mediano = '';
        $grande = '';
        switch ($tama??o) {
            case '1': $chico = 'checked="checked"';
                break;
            case '2': $mediano = 'checked="checked"';
                break;
            case '3': $grande = 'checked="checked"';
                break;
            default: break;
        }
        $id = 'modal' . $orden;
        $str = '<div class="modal fade" id="' . $id . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="' . $id . '" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="staticBackdropLabel">Editar Video (MP4 ??nicamente)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                <form action="preview.php" method="post" enctype="multipart/form-data"><div class="modal-body"><div class="user-select-none"><input type="text" class="form-control" name="code" value="' . $code . '"readonly="readonly" style="color: #e9ecef;">
                </div><div class="input-group py-2"><div class="custom-file"><div class="btn btn-outline-secondary btn-rounded waves-effect float-left">
                <input type="file" id="archivo" name="video" accept="video/mp4"></div></div></div><div id="seccion">Tama??o: </div>
                <div class="custom-control custom-radio"><input type="radio" id="chicoVid' . $orden . '" name="sizeConfigVid' . $orden . '" class="custom-control-input"' . $chico . 'value="1">
                <label class="custom-control-label user-select-none" for="chicoVid' . $orden . '">Chico</label></div><div class="custom-control custom-radio">
                <input type="radio" id="medianoVid' . $orden . '" name="sizeConfigVid' . $orden . '" class="custom-control-input"' . $mediano . 'value="2">
                <label class="custom-control-label user-select-none" for="medianoVid' . $orden . '">Mediano</label></div><div class="custom-control custom-radio">
                <input type="radio" id="grandeVid' . $orden . '" name="sizeConfigVid' . $orden . '" class="custom-control-input"' . $grande . 'value="3">
                <label class="custom-control-label user-select-none" for="grandeVid' . $orden . '">Grande</label></div></div><div class="modal-footer">
                <button type="submit" class="btn btn-danger" name="deleteFile" value="V' . $orden . '">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
                <button type="submit" class="btn btn-primary" name="editFile" value="V' . $orden . '">Aceptar</button></div></form></div></div></div>';
        array_push($this->arr, $str);
    }

    private function HTMLify($row) {
        $size = '';
        if ($row["tipo"] != 'texto') {
            switch ($row['tama??o']) {
                case 1: $size = 'noticiaIMG-ch';
                    break;
                case 2: $size = 'noticiaIMG-md';
                    break;
                case 3: $size = 'noticiaIMG-gd';
                    break;
            }
        }
        switch ($row["tipo"]) {
            case 'imagen':
                echo $this->imash($size, $row["orden"], $row["imagen"]);
                $this->imashModal($row["orden"], $row["clave"], $row["tama??o"]);
                break;
            case 'texto':
                echo $this->tecsto($row["texto"], $row["orden"]);
                $this->tecstoModal($row["texto"], $row["orden"], $row["clave"]);
                break;
            case 'video':
                echo $this->vidio($size, $row["orden"], $row["video"]);
                $this->vidioModal($row["orden"], $row["clave"], $row["tama??o"]);
                break;
            default: echo 'NADA';
                break;
        }
    }

    private function HTMLifyNEW($row) {
        $size = '';
        if ($row["tipo"] != 'texto') {
            switch ($row['tama??o']) {
                case 1: $size = 'noticiaIMG-ch';
                    break;
                case 2: $size = 'noticiaIMG-md';
                    break;
                case 3: $size = 'noticiaIMG-gd';
                    break;
            }
        }
        switch ($row["tipo"]) {
            case 'imagen':
                echo $this->imashNEW($size, $row["orden"], $row["imagen"]);
                break;
            case 'texto':
                echo $this->tecstoNEW($row["texto"], $row["orden"]);
                break;
            case 'video':
                echo $this->vidioNEW($size, $row["orden"], $row["video"]);
                break;
            default: echo 'NADA';
                break;
        }
    }

    public function modales() {
        foreach ($this->arr as $mode) {
            echo $mode;
        }
    }

}

class comentarios {

    private $new;
    private $arr;

    public function comentarios($codigo) {
        $this->new = $codigo;
        $this->arr = array();
    }

    public function newComment($usuario, $texto, $responde) {
        $conn = new mySQLphpClass();
        $conn->comentarios(null, $texto, null, $responde, $this->new, $usuario, 'I');
    }

    public function deleteComment($clave) {
        $conn = new mySQLphpClass();
        $conn->comentarios($clave, null, null, null, null, null, 'D');
    }

    function cargarComentarios() {
        $conn = new mySQLphpClass();
        $result = $conn->get_misComentarios($this->new, null);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if (!isset($row["Responde"])) {
                    $this->HTMLify($row, false);
                    $this->addModal($row["Clave"]);
                }
                $result2 = $conn->get_misComentarios($this->new, $row["Clave"]);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        $this->HTMLify($row2, true);
                    }
                }
            }
        } else {
            echo '<div class="p-5" style="color:#857086;">Se el primero en dejar un comentario.</div>';
        }
    }

    function cargarComentariosDevMode() {
        $conn = new mySQLphpClass();
        $result = $conn->get_misComentarios($this->new, null);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if (!isset($row["Responde"])) {
                    $this->HTMLifyDevMode($row, false);
                    $this->addModalDevMode($row["Clave"]);
                }
                $result2 = $conn->get_misComentarios($this->new, $row["Clave"]);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        $this->HTMLifyDevMode($row2, true);
                        $this->addModalDevMode($row2["Clave"]);
                    }
                }
            }
        } else {
            echo '<div class="p-5" style="color:#857086;">Esta noticia no cuenta con comentarios.</div>';
        }
    }

    private function addModal($id) {
        $str = '<!-- Modal Comentario -->
                <div class="modal fade" id="modal' . $id . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="commentModal' . $id . '" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Responder un comentario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="noticia.php" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="user-select-none">
                                        <input type="text" class="form-control user-select-none" name="replying" value="' . $id . '" readonly="readonly" style="color: #e9ecef;">
                                    </div>
                                    <div class="user-select-none">
                                        <input type="text" class="form-control user-select-none" name="code" value="' . $this->new . '" readonly="readonly" style="color: #e9ecef;">
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Comentario</span>
                                        </div>
                                        <textarea class="form-control" aria-label="commentModal' . $id . '" name="commentText" id="textAreaField" rows="5" cols="100"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
                                    <button type="submit" class="btn btn-primary" name="commentSubmit" value="commentSubmit">Responder</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>';
        array_push($this->arr, $str);
    }

    private function HTMLify($row, $respuesta) {
        $img = "https://pbs.twimg.com/media/EiNYM5CWAAAh9PV?format=png&name=240x240";
        $responde = "";
        $enRespuesta = "";
        $replyBTN = '<div class="responder text-right user-select-none" data-toggle="modal" data-target="#modal' . $row["Clave"] . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="currentColor" class="bi bi-chat-square-fill" viewBox="0 0 16 16">
                                    <path d="M2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                    </svg>
                                <small>Responder</small>
                            </div>';
        if (isset($row["Imagen"])) {
            $img = "data:image/jpg;base64," . base64_encode($row["Imagen"]);
        }
        if ($respuesta) {
            $responde = 'style="margin-left: 3rem;"';
            $enRespuesta = ", En respuesta.";
            $replyBTN = "";
        }
        echo '<div class="comentario" ' . $responde . '>
                        <div class="comentext mr-2">
                            <div class="comentor">
                                <img class="comentIMG" src="' . $img . '"/>
                                <h4 style="display: inline-block; margin-bottom: 30px; margin-right: 1rem;">' . $row["Usuario"] . '</h4>
                            </div>
                            ' . $row["Texto"] . '
                            <small class="text-muted"><br>' . $row["Fecha"] . $enRespuesta . '</small>' . $replyBTN . '
                        </div>
                    </div>';
    }

    private function addModalDevMode($id) {
        $str = '<!-- Modal Comentario -->
                <div class="modal fade" id="modal' . $id . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="commentModal' . $id . '" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Eliminar comentario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="preview.php" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <h3>??Est?? seguro de querer eliminar este comentario?</h3>
                                    <h5>(Los resultados ser??n permanentes)</h5>
                                    <p>Tome en cuenta que eliminar un comentario que ha sido comentado eliminar?? tambi??n esos comentarios.</p>
                                    <div class="user-select-none">
                                        <input type="text" class="form-control user-select-none" name="clave" value="' . $id . '" readonly="readonly" style="color: #e9ecef;">
                                    </div>
                                    <div class="user-select-none">
                                        <input type="text" class="form-control user-select-none" name="code" value="' . $this->new . '" readonly="readonly" style="color: #e9ecef;">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
                                    <button type="submit" class="btn btn-danger" name="commentDelete" value="commentDelete">Aceptar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>';
        array_push($this->arr, $str);
    }

    private function HTMLifyDevMode($row, $respuesta) {
        $img = "https://pbs.twimg.com/media/EiNYM5CWAAAh9PV?format=png&name=240x240";
        $responde = "";
        $enRespuesta = "";
        $replyBTN = '<div class="responder text-right user-select-none" data-toggle="modal" data-target="#modal' . $row["Clave"] . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                <small>Eliminar</small>
                            </div>';
        if (isset($row["Imagen"])) {
            $img = "data:image/jpg;base64," . base64_encode($row["Imagen"]);
        }
        if ($respuesta) {
            $responde = 'style="margin-left: 3rem;"';
            $enRespuesta = ", En respuesta.";
        }
        echo '<div class="comentario" ' . $responde . '>
                        <div class="comentext mr-2">
                            <div class="comentor">
                                <img class="comentIMG" src="' . $img . '"/>
                                <h4 style="display: inline-block; margin-bottom: 30px; margin-right: 1rem;">' . $row["Usuario"] . '</h4>
                            </div>
                            ' . $row["Texto"] . '
                            <small class="text-muted"><br>' . $row["Fecha"] . $enRespuesta . '</small>' . $replyBTN . '
                        </div>
                    </div>';
    }

    public function modales() {
        foreach ($this->arr as $mode) {
            echo $mode;
        }
    }

}

class reporteros {

    private $arr;

    public function fillReporteros() {
        $this->arr = array();
        $conn = new mySQLphpClass();
        $result = $conn->get_Reporteros();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->HTMLify($row);
                $this->bajaModal($row["Usuario"]);
            }
        }
    }

    private function HTMLify($row) {
        $img = "https://pbs.twimg.com/media/EiNYM5CWAAAh9PV?format=png&name=240x240";
        if (isset($row["Imagen"])) {
            $img = "data:image/jpg;base64," . base64_encode($row["Imagen"]);
        }
        $str = '<div class="repUser my-auto user-select-none">
                        <div class="row">
                            <div class="equis text-right pr-1" data-toggle="modal" data-target="#modal' . $row['Usuario'] . '">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="row repIMG mx-auto">
                            <img src="' . $img . '" alt="Avatar">
                        </div>
                        <div>
                            <p class="text-center">' . $row["Usuario"] . '</p>
                        </div>
                    </div>';
        echo $str;
    }

    private function bajaModal($id) {
        $str = '<div class="modal fade" id="modal' . $id . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="delete' . $id . '" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Baja Usuario Reportero</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="HomeEditor.php" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <h3>??Est?? seguro de querer dar de Baja el usuario de este Reportero?</h3>
                                    <p>Tome en cuenta que dar de Baja el Usuario tambi??n elimina todas las noticias que no hubiesen sido pulicadas.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
                                    <button type="submit" class="btn btn-danger" name="RepDelete" value="' . $id . '">Aceptar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>';
        array_push($this->arr, $str);
    }

    public function modales() {
        foreach ($this->arr as $mode) {
            echo $mode;
        }
    }

}
