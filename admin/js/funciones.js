function InicioSesion() {
    $.ajax({
        type: 'post',
        url: 'admin/scripts/login',
        data: {
            usuario: $("#usuario").val(),
            password: $("#password").val()
        },
        cache: false,
        success: function (response) {
            if (response == '1') {
                window.location.href = 'admin/'
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Usuario o contraseña erronea"
                });
            }
        }
    });
}

function Vista(menu, modulo, vista, opcion, token) {
    $.ajax({
        type: 'post',
        url: 'modulos/' + menu + '/' + modulo + '/' + vista,
        data: {
            menu: menu,
            modulo: modulo,
            vista: vista,
            opcion: opcion,
            token: token
        },
        cache: false,
        success: function (response) {
            $('#contenedor').html(response);
        }
    })
}

function FiltroProspecto() {
    $.ajax({
        type: 'post',
        url: 'modulos/' + menu + '/' + modulo + '/' + vista,
        data: {
            menu: menu,
            modulo: modulo,
            vista: vista,
            opcion: opcion,
            token: token
        },
        cache: false,
        success: function (response) {
            $('#contenedor_tabla').html(response);
        }
    })
}

function CalcularPrecio() {
    var precio_inicial = $("#precio_original").val();
    var porcentaje_ganancia = $("#porcentaje_ganancia").val();
    var precio_final = 0;

    var precio_porcentaje_ganancia = parseFloat(precio_inicial * (porcentaje_ganancia / 100));
    precio_final = (parseFloat(precio_porcentaje_ganancia) + parseFloat(precio_inicial));
    $("#precio_venta").val(precio_final);
}

function IncluyeIVA() {
    if ($('#switch_iva').is(':checked')) {
        var precio_venta = $("#precio_venta").val();
        var iva = parseFloat(precio_venta * 0.16);
        var total = (parseFloat(precio_venta) + parseFloat(iva));
        $("#precio_venta").val(total);
    } else {
        var precio_inicial = $("#precio_original").val();
        var porcentaje_ganancia = $("#porcentaje_ganancia").val();
        var precio_final = 0;

        var precio_porcentaje_ganancia = parseFloat(precio_inicial * (porcentaje_ganancia / 100));
        precio_final = (parseFloat(precio_porcentaje_ganancia) + parseFloat(precio_inicial));
        $("#precio_venta").val(precio_final);
    }
}

function CambiarCiudad(e) {
    const id_estado = $(e).val();
    $.ajax({
        type: 'post',
        url: 'scripts/obtenermunicipios',
        data: {
            id_estado: id_estado,
        },
        cache: false,
        success: function (response) {
            $('#municipios').html(response);
        }
    });
}