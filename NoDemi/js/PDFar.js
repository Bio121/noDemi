/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    var cer = $('#certif');

    html2canvas(document.getElementById('certif')).then(function (canvas) {
        $('#certif').hide();
        document.body.appendChild(canvas);
        var pdf = new jsPDF();
        var img = canvas.toDataURL('image/png'),
                doc = new jsPDF({
                    orientation: 'landscape',
                    unit: 'px',
                    format: 'a4'
                });
        doc.addImage(img, 'JPEG', 0, 0);
        doc.save('CERTIFICADO.pdf');
    });

});
