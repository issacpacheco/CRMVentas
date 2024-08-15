function InicioSesion() {
    $.ajax({
        type: 'post',
        url: 'admin/scripts/login.php',
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