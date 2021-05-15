function volverseEcuela() {
    var ask = window.confirm("Seguro que quiere volverse una escuela?");
    if (ask) {
        window.alert("Su cuenta se a vuelto la de una escuela.");

    }
}

function redirect(site) {
    window.location.href = site;
}

function validacionRegistrarse() {

    email = document.getElementById("emailRegistrarse").value;
    if (!(/^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/.test(email))) {
        alert("Correo no válido.");
        return false;
    }

    usuario = document.getElementById("usuarioRegistrarse").value;
    if (usuario == null || usuario.length == 0 || /^\s+$/.test(usuario)) {
        alert("Agrege un usuario.");
        return false;
    }

    pass = document.getElementById("contraseñaRegistrarse").value;
    if (pass == null || pass.length < 8 || /^[a-zA-Z0-9]+$/.test(pass)) {
        alert("Agrege una contraseña válida.");
        return false;
    }

    pass2 = document.getElementById("contraseñaConfirmarRegistrarse").value;
    if (pass2 != pass) {
        alert("Confirme correctamente su contraseña.");
        return false;
    }

    alert("Usted está registrado");

}

function validacionInicioSesion() {

    email = document.getElementById("emailIniciarSesion").value;
    if (!(/^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/.test(email))) {
        alert("Correo no registrado.");
        return false;
    }

    usuario = document.getElementById("usuarioIniciarSesion").value;
    if (usuario == null || usuario.length == 0 || /^\s+$/.test(usuario)) {
        alert("Usuario incorrecto.");
        return false;
    }

    pass = document.getElementById("contraseñaIniciarSesion").value;
    if (pass == null || pass.length < 8 || /^[a-zA-Z0-9]+$/.test(pass)) {
        alert("Contraseña incorrecta.");
        return false;
    }

    alert("Inicio de sesión exitoso.");

}

function validacionConfig() {

    usuario = document.getElementById("UsuarioConfig").value;
    if (usuario == null || usuario.length == 0 || /^\s+$/.test(usuario)) {
        alert("Usuario no valido");
        return false;
    }

    email = document.getElementById("mailCofig").value;
    if (!(/^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/.test(email))) {
        alert("correo no valido");
        return false;
    }

    pass = document.getElementById("contraConfig").value;
    if (pass == null || pass.length < 8 || /^[a-zA-Z0-9]+$/.test(pass)) {
        alert("contraseña no valida");
        return false;
    }

    pass2 = document.getElementById("confirmarContraConfig").value;
    if (pass2 != pass) {
        alert("confirme correctamente su contraseña");
        return false;
    }

    nombreConfig = document.getElementById("nombreConfig").value;
    if (nombreConfig == null || nombreConfig.length == 0 || nombreConfig == " " || /^\s+$/.test(nombreConfig)) {

    } else {
        if (!(/^[A-Z]+$/i.test(nombreConfig))) {
            alert("El nombre solo acepta letras");
            return false;
        }
    }
    apellidoPaConfig = document.getElementById("apellidoPaConfig").value;
    if (apellidoPaConfig == null || apellidoPaConfig.length == 0 || apellidoPaConfig == " " || /^\s+$/.test(apellidoPaConfig)) {

    } else {
        if (!(/^[A-Z]+$/i.test(apellidoPaConfig))) {
            alert("El apellido paterno solo acepta letras");
            return false;
        }
    }

    apellidoMaConfig = document.getElementById("apellidoMaConfig").value;
    if (apellidoMaConfig == null || apellidoMaConfig.length == 0 || apellidoMaConfig == " " || /^\s+$/.test(apellidoMaConfig)) {

    } else {
        if (!(/^[A-Z]+$/i.test(apellidoMaConfig))) {
            alert("El apellido materno solo acepta letras");
            return false;
        }
    }

    TelefonoConfig = document.getElementById("TelefonoConfig").value;
    if (!(/^\d{10}$/.test(TelefonoConfig))) {
        alert("numero de telefono no valido");
        return false;
    }

    alert("los datos se an actualizado");

}
function BajaUsuariro() {
    var ask = window.confirm("Seguro que quiere dar de baja su cuenta?");
    if (ask) {
        window.alert("Su cuenta a sido dada de baja.");

        window.location.href = "index.php";

    }
}