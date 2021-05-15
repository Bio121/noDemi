/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


window.addEventListener('resize', onWindowResize);

function onWindowResize() {

    var rem = function rem() {
        var html = document.getElementsByTagName('html')[0];

        return function () {
            return parseInt(window.getComputedStyle(html)['fontSize']);
        }
    }();

    var long = $('.unaClase').width() / rem() + 10;

    $('textarea').attr('cols', long.toString());

}


var classCounter = 0;

$(document).ready(function () {

    var actual = $('.textoOculto').text();

    var claveFinal = '-1';

    $('#newClass').click(function () {
        crearClase();
    });

    $('.catContainer').on("click", ".catItem", function () {
        claveFinal = $(this).children('.catID').text().toString();
        var mostrar = $(this).text();
        var res = mostrar.substr(0, mostrar.length - claveFinal.length);
        $('.catText').text(res);
    });

    $('.clasesNuevas').on("click", ".modifyBTN", function () {
        var nombre = $(this).siblings('.nameClass').val();
        var desc = $(this).siblings('.descClass').val();
        var codigo = $(this).siblings('.textoOculto').text();

        alteraClase(nombre, desc, codigo);
    });


    $(document).on('change', 'input[type="file"]', function (e) {
        $(this).siblings('.subeIMG').attr('disabled', false);
    });

    $(document).on('click', '.subeIMG', function () {
        var nivel = $(this).parents('.unaClase').children('.textoOculto').text();

        var htmlSTR = '<input type="text" name="curso" value="' + actual + '">';
        htmlSTR += '<input type="text" name="nivel" value="' + nivel + '">';

        $(this).parents('form').append(htmlSTR);
    });


    $('.clasesNuevas').on("click", ".closeClase", function () {
        var codigo = $(this).parents('.unaClase > .textoOculto').text();
        $('#claseBorrar').text(codigo);
    });

    $('.clasesNuevas').on("click", ".delFile", function () {
        var codigo = $(this).siblings('.textoOculto').text();
        var nivel = $(this).parents('.unaClase').children('.textoOculto').text();
        quitaArchivo(codigo, nivel);
    });

    $('.catContEx').on("click", ".catQuitar", function () {
        claveFinal = $(this).siblings('.catID').text().toString();
        $('.catContEx').append('<input type="text" name="quitaCategoria" value="' + claveFinal + '">');
    });

    $('#addTextCat').click(function () {
        $('.catText').text('');
        $('.catText').append('<input type="text" name="categoria" value="' + claveFinal + '">');
    });

    $('#borrarClase').click(function () {
        var codigo = $(this).siblings('.textoOculto').text();
        quitaClase(codigo);
    });

    traerClases();

    function traerClases() {
        var dataToSend = {
            action: "getClases",
            cursoActual: actual
        };
        $.ajax({
            url: "clasesCurso.php",
            async: true,
            type: "POST",
            data: dataToSend,
            dataType: "json",
            success: function (data) {
                data.forEach(element => {
                    ponerClase(element.codigo, element.titulo, element.desc, element.calificacion);
                });
            },
            error: function (x, y, z) {
                alert("Error del WebService: " + x + y + z);
            }
        });
    }

    function crearClase() {
        var dataToSend = {
            action: "creaClases",
            cursoActual: actual
        };
        $.ajax({
            url: "clasesCurso.php",
            async: true,
            type: "POST",
            data: dataToSend,
            dataType: "json",
            success: function (data) {
                data.forEach(element => {
                    ponerClase(element.codigo, element.titulo, element.desc, element.calificacion);
                });
            },
            error: function (x, y, z) {
                alert("Error del WebService: " + x + y + z);
            }
        });
    }

    function alteraClase(nombre, desc, codigo) {
        var dataToSend = {
            action: "modifyClases",
            cursoActual: actual,
            nombre: nombre,
            desc: desc,
            codigo: codigo
        };
        $.ajax({
            url: "clasesCurso.php",
            async: true,
            type: "POST",
            data: dataToSend,
            dataType: "json",
            success: function (data) {
                data.forEach(element => {
                    //ponerClase(element.codigo, element.titulo, element.desc, element.calificacion);
                });
            },
            error: function (x, y, z) {
                alert("Error del WebService: " + x + y + z);
            }
        });
    }

    function quitaClase(codigo) {
        var dataToSend = {
            action: "quitaClases",
            cursoActual: actual,
            codigo: codigo
        };
        $.ajax({
            url: "clasesCurso.php",
            async: true,
            type: "POST",
            data: dataToSend,
            dataType: "json",
            success: function (data) {
                data.forEach(element => {
                    //ponerClase(element.codigo, element.titulo, element.desc, element.calificacion);
                });
                classCounter = 0;
                $('.clasesNuevas').empty();
                traerClases();
            },
            error: function (x, y, z) {
                alert("Error del WebService: " + x + y + z);
            }
        });
    }

    function ponerClase(codigo, titulo, desc, calificacion) {

        classCounter++;

        var htmlSTR = '<div class="unaClase c' + classCounter + '">';
        htmlSTR += '<div class="textoOculto">' + codigo + '</div>';
        htmlSTR += '<div class="modal-header"><h3>Clase ' + classCounter + '</h3>';
        htmlSTR += '<button type="button" class="close closeClase" data-toggle="modal" data-target="#seguroModal"><span aria-hidden="true">&times;</span></button>';
        htmlSTR += '<label for="nameClass' + classCounter + '"></label></div>';
        htmlSTR += '<input type="text" class="form-control campoConfig nameClass" id="' + classCounter + '" name="name" placeholder="" value="' + titulo + '">';
        htmlSTR += '<label for="contraConfig">Contenido</label><br>';
        htmlSTR += '<form action="crearCurso.php" method="post" enctype="multipart/form-data">';
        htmlSTR += '<input class="mr-3 mb-3" type="file" name="video[]" multiple>';
        htmlSTR += '<button class="btn btn-primary subeIMG" type="Submit" name="imgUpload" value="' + codigo + '" disabled>Subir Archivos</button></form>';
        htmlSTR += '<form action="crearCurso.php" method="post" enctype="multipart/form-data">';
        htmlSTR += '<input class="mr-3 mb-3 form-control" type="text" name="link" placeholder="Enlace a un sitio web">';
        htmlSTR += '<button class="btn btn-primary subeIMG" type="Submit" name="linkUpload" value="' + codigo + '">Guardar enlace</button></form>';
        htmlSTR += '<div class="filesCont sb" id="files' + codigo + '"></div>';
        htmlSTR += '<label for="desc' + classCounter + '">Descripción</label><br>';
        htmlSTR += '<textarea class="descClass" id="desc' + classCounter + '" name="desc' + classCounter + '" rows="4" cols="77" style="box-sizing:border-box">' + desc + '</textarea><br>';
        htmlSTR += '<button class="btn btn-primary btnConfig modifyBTN" type="Submit" name="changes" value="changes">Actualizar Datos de la clase</button></div>';

        $('.clasesNuevas').append(htmlSTR);

        traerArchivos(codigo);

    }

    function traerArchivos(nActual) {
        var dataToSend = {
            action: "getArchivos",
            nivelActual: nActual
        };
        debugger;
        $.ajax({
            url: "clasesCurso.php",
            async: true,
            type: "POST",
            data: dataToSend,
            dataType: "json",
            success: function (data) {
                debugger;
                data.forEach(element => {
                    ponerArchivo(element.ruta, element.tipoDato, element.nombre, element.clave, element.nivel, nActual);
                });
            },
            error: function (x, y, z) {
                alert("Error del WebService: " + x + y + z);
            }
        });
    }

    function quitaArchivo(codigo, nActual) {
        var dataToSend = {
            action: "quitaArchivo",
            nivelActual: nActual,
            codigo: codigo
        };
        debugger;
        $.ajax({
            url: "clasesCurso.php",
            async: true,
            type: "POST",
            data: dataToSend,
            dataType: "json",
            success: function (data) {
                data.forEach(element => {
                    //ponerClase(element.codigo, element.titulo, element.desc, element.calificacion);
                });
                $('#files' + nActual).empty();
                traerArchivos(nActual);
            },
            error: function (x, y, z) {
                alert("Error del WebService: " + x + y + z);
            }
        });
    }

    function ponerArchivo(ruta, tipoDato, nombre, clave, nivel, id) {

        debugger;
        var url;

        if (tipoDato.indexOf('image') == 0) {
            url = ruta;
        } else {
            url = 'img/files/' + imashIcon(tipoDato);
        }

        var redir = "redirect('" + ruta + "')";

        var htmlSTR = '<div class="fileItem">';
        htmlSTR += '<div class="textoOculto">' + clave + '</div>';
        htmlSTR += '<div class="delFile">';
        htmlSTR += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">';
        htmlSTR += '<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>';
        htmlSTR += '<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>';
        htmlSTR += '</svg></div>';
        htmlSTR += '<div class="fileIcon" style="background: url(' + url + ') no-repeat center center; background-size: 80% auto;" onclick = "' + redir + '"></div>';
        htmlSTR += '<p class="fileName">' + nombre + '</p></div>';


        $('#files' + id).append(htmlSTR);

    }

    function imashIcon(tipoDato) {
        var result;

        switch (tipoDato) {
            case 'video/mp4':
            case 'video/mkv':
            case 'video/mov':
            case 'video/avi':
            case 'video/wmv':
            case 'video/webm':
                result = 'movie-videos.png';
                break;
            case 'audio/wav':
            case 'audio/aiff':
            case 'audio/mpeg':
            case 'audio/aac':
            case 'audio/ogg':
            case 'audio/wma':
            case 'audio/flac':
            case 'audio/alac':
                result = 'analyze-sound-wave.png';
                break;
            case 'pdf':
                result = 'pdf-files.png';
                break;
            case 'rar':
                result = 'rar-file.png';
                break;
            case 'txt':
                result = 'txt-file.png';
                break;
            case 'zip':
                result = 'zip-file.png';
                break;
            case 'link':
                result = 'link.png';
                break;
            default:
                result = 'unknown-file.png';
        }

        return result;
    }
});

