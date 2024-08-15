<?php
include("../../../class/allClass.php");

use nsadministracion\administracion;
use nsfunciones\funciones;

$administracion = new administracion();
$funciones = new funciones();

$menu = filter_input(INPUT_POST, 'menu', FILTER_SANITIZE_SPECIAL_CHARS);
$modulo = filter_input(INPUT_POST, 'modulo', FILTER_SANITIZE_SPECIAL_CHARS);
$vista = filter_input(INPUT_POST, 'vista', FILTER_SANITIZE_SPECIAL_CHARS);
$opcion = filter_input(INPUT_POST, 'opcion', FILTER_SANITIZE_SPECIAL_CHARS);
$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS);

$usuario = $administracion->obtener_almacen($token);

?>
<div class="row mb-2">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo ucfirst($menu); ?></a></li>
                    <li class="breadcrumb-item active"><?php echo ucfirst($modulo); ?></li>
                    <li class="breadcrumb-item active"><?php echo ucfirst($opcion); ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <form action="#" method="post" id="form_abc" enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="col-sm-4">
                    <label>Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $usuario['nombre'][0] ?>">
                </div>
                <div class="col-sm-4">
                    <label>Estatus</label>
                    <select name="estatus" id="estatus" class="form-control">
                        <option value="" selected>Selecciona una opción</option>
                        <option value="1" <?php echo $usuario['estatus'][0] == 1 ? 'selected' : ''; ?>>Activo</option>
                        <option value="2" <?php echo $usuario['estatus'][0] == 2 ? 'selected' : ''; ?>>inactivo</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <input type="hidden" name="modulo" value="<?php echo $modulo; ?>">
                    <input type="hidden" name="opcion" value="<?php echo $opcion; ?>">
                    <?php
                    if ($opcion == 'editar') {
                        echo '
								<input type="hidden" name="token" value="' . $token . '">
								<div class="d-grid gap">
									<button type="submit" class="btn btn-success btn-lg btn-block">Guardar <i class="fal fa-save"></i></button>
								</div>
								';
                    } else if ($opcion == 'eliminar') {
                        echo '
								<input type="hidden" name="token" value="' . $token . '">
								<div class="d-grid gap">
									<button type="button" class="btn btn-danger btn-lg btn-block" id="boton_guardar" onClick="Confirmar()">Eliminar <i class="fal fa-trash-alt"></i></button>
								</div>
								';
                    } else {
                        echo '
								<div class="d-grid gap">
									<button type="submit" class="btn btn-success btn-lg btn-block" id="boton_guardar">Guardar <i class="fal fa-save"></i></button>
								</div>
								';
                    }
                    ?>
                </div>
                <div class="col-sm-4">
                    <div class="d-grid gap">
                        <a href="javascript:void(0);" class="btn btn-info btn-lg btn-block" onClick="Vista('<?php echo $menu; ?>','<?php echo $modulo; ?>','catalogo')">Cancelar <i class="fas fa-times"></i></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $('#form_abc').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'text-danger', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        onfocusout: function(element) {
            this.element(element);
        }, //Validate on blur
        onkeyup: function(element) {
            this.element(element);
        }, //Validate on keyup
        focusCleanup: true, //If enabled, removes the errorClass from the invalid elements and hides all error messages whenever the element is focused
        ignore: "",
        rules: {
            nombre: {
                required: true,
            },
            estatus: {
                required: true
            }
        },

        submitHandler: function(form) {
            Guardar();
        }
    });

    $('#form_abc input').keypress(function(e) {
        if (e.which == 13) {
            if ($('#form_abc').validate().form()) {
                Guardar();
            }
            return false;
        }
    });

    function Guardar() {

        //var data = new FormData($('#form_abc'));
        $('#boton_guardar').empty();
        $('#boton_guardar').prop('disabled', true);
        $('#boton_guardar').append('<i class="fas fa-spinner fa-spin"></i> Enviando...');
        // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: 'modulos/<?php echo $menu; ?>/<?php echo $modulo; ?>/guardar',
            cache: false,
            data: $('#form_abc').serialize(),
            //data:data,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                console.log(data);
                switch (data) {
                    case "-1": {
                        //Error
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Ocurrío un error en el sistema.',
                        });
                        break;
                    }
                    case "1": {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'El registro se guardó correctamente.',
                        });
                        Vista('<?php echo $menu ?>', '<?php echo $modulo ?>', 'catalogo');
                        break;
                    }
                    case "2": {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'El registro se actualizó correctamente.',
                        });
                        Vista('<?php echo $menu ?>', '<?php echo $modulo ?>', 'catalogo');
                        break;
                    }
                    case "3": {
                        Vista('<?php echo $menu ?>', '<?php echo $modulo ?>', 'catalogo');
                        break;
                    }
                    default: {
                        //Error
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Ocurrío un error, por favor intente de nuevo.',
                        });
                        break;
                    }
                }
                $('#boton_guardar').empty();
                $('#boton_guardar').append('<i class="fal fa-save"></i> Guardar');
                $('#boton_guardar').prop('disabled', false);

            }
        })
        return false;
    }

    function Confirmar() {

        Swal.fire({
            title: 'ATENCIÓN',
            icon: 'info',
            width: 500,
            html: '<h4>¿Esta seguro que deseas eliminar este registro?</h4>',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<i class="fas fa-thumbs-up"></i> Sí, estoy seguro',
            cancelButtonText: '<i class="fas fa-thumbs-down"></i> ¡No!, aborta la misión',
        }).then((result) => {
            if (result.isConfirmed) {
                //Acept
                Guardar();
            }
        });
    }
</script>