/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    var $uploadCrop;

    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.upload-demo').addClass('ready');
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function () {
                    console.log('jQuery bind complete');
                });

            }

            reader.readAsDataURL(input.files[0]);
        } else {
            swal("Sorry - you're browser doesn't support the FileReader API");
        }
    }

    $uploadCrop = $('#upload-demo').croppie({
        viewport: {
            width: 300,
            height: 300,
            type: 'circle'
        },
        enableExif: true
    });

    $('#archivo').on('change', function () {
        readFile(this);
        $('.upload-msg').addClass("d-none");
        $('.upload-demo-wrap').removeClass("d-none");
    });
    $('.upload-result').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'base64',
            size: 'original',
            circle: true
        }).then(function (resp) {
            resp = resp.substr(22);
            $('#formConfigUser').append('<input type="text" name="imagen" value="' + resp + '">');
        });
    });

});


