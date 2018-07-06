function inicializarFecha() {
    $('.datepicker').datepicker({
        format: "dd-mm-yyyy",
        language: "es",
        autoclose: true
    });
}


function cargarCombo(emisor, receptor, url) {
    if ($("#" + emisor).val() != '') {
        $.ajax({
            type: 'GET',
            url: url,
            data: $('#form').serialize(),
            success: function (data) {
                $("#" + receptor).empty();
                if (data.length > 0) {
                    for (i = 0; i < data.length; i++) {
                        $("#" + receptor).append("<option value='" + data[i].id + "'>" + data[i].nombre + "</option>");
                    }
                    alert('Seleccione sus butacas');
                } else {
                    alert('No existen butacas disponibles para la fecha seleccionada');

                }

            }
        });
    } else {
        $("#" + receptor).empty();
    }
}

function controlNumeroButacas() {
    var cnt=0;
    for (var i = 0; i < document.getElementById('butacas').length; i++) {
        if (document.getElementById('butacas')[i].selected) {
            cnt++;
        }
    }
    if ($('#numero_personas').val() != cnt) {
        alert('El numero de personas debe ser igual al numero de butacas seleccionadas');
        return false;
    } else {
        return true;
    }
}