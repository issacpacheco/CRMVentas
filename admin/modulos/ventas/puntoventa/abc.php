<?php
include("../../../class/allClass.php");

use nsadministracion\administracion;
use nsfunciones\funciones;
use nspuntoventa\puntoventa;

$administracion = new administracion();
$funciones = new funciones();
$puntoventa = new puntoventa();

$menu = filter_input(INPUT_POST, 'menu', FILTER_SANITIZE_SPECIAL_CHARS);
$modulo = filter_input(INPUT_POST, 'modulo', FILTER_SANITIZE_SPECIAL_CHARS);
$vista = filter_input(INPUT_POST, 'vista', FILTER_SANITIZE_SPECIAL_CHARS);
$opcion = filter_input(INPUT_POST, 'opcion', FILTER_SANITIZE_SPECIAL_CHARS);
$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS);

//Consulta del prospecto a editar o eliminar
$clientes = $administracion->obtener_clientes();
$cclientes = $funciones->cuentarray($clientes);

$productos = $administracion->obtener_lista_productos();
$cproductos = $funciones->cuentarray($productos);


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
                    <label>Productos</label>
                    <select class="select-puntoventa form-control" id="selectProducto" name="producto[]">
                        <option value="0" selected disabled>Selecciona un producto</option>
                        <?php for ($i = 0; $i < $cproductos; $i++) { ?>
                            <option value="<?php echo $productos['id'][$i] ?>"
                                data-nombre="<?php echo $productos['nombre'][$i] ?>"
                                data-precio_venta="<?php echo $productos['precio_venta'][$i] ?>">
                                <?php echo $productos['nombre'][$i] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label>Clientes</label>
                    <select class="select-puntoventa  form-control" name="cliente[]">
                        <option value="0" selected disabled>Selecciona un cliente</option>
                        <?php for ($i = 0; $i < $cclientes; $i++) { ?>
                            <option value="<?php echo $clientes['id'][$i] ?>"><?php echo $clientes['nombre'][$i] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header" style="text-transform:uppercase;">Detalles Venta</div>
                <div class="card-body text-center">
                    <div class="row">
                        <table class="table table-bordered" id="puntoventa">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio Unitario</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se agregarán las filas dinámicamente -->
                            </tbody>
                            <tfoot>
                                <!-- Aquí se agregará la fila de total -->
                            </tfoot>
                        </table>
                    </div>
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
            <script>
                $(document).ready(function() {
                    $('.select-puntoventa').select2();
                });

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

                function uploadData(formdata) {
                    $.ajax({
                        url: 'modulos/<?php echo $menu; ?>/<?php echo $modulo; ?>/guardar',
                        type: 'POST',
                        data: formdata,
                        contentType: false,
                        processData: false,
                        dataType: json,
                        success: addThumbnail()
                    })
                }

                function addThumbnail(data) {

                }


                $(document).ready(function() {
                    // Detectar cuando se selecciona un producto
                    $('#selectProducto').change(function() {
                        // Obtener el producto seleccionado
                        const selectProduct = $(this).find(':selected'); // Obtener la opción seleccionada
                        const productoId = selectProduct.val();
                        const nombreProducto = selectProduct.data('nombre');
                        const precioProducto = selectProduct.data('precio_venta'); // Asegúrate que coincida con el atributo HTML

                        // Verificar si se seleccionó un producto válido
                        if (productoId == 0) {
                            alert("Por favor selecciona un producto.");
                            return;
                        }

                        // Crear una nueva fila <tr>
                        const nuevaFila = $('<tr>');

                        // Agregar celdas <td> con los valores del producto seleccionado
                        nuevaFila.append('<td><input type="text" class="form-control" name="nombre[]" value="' + nombreProducto + '" readonly></td>');
                        nuevaFila.append('<td><input type="number" class="form-control cantidad" name="cantidad[]" value="1" min="1"></td>');
                        nuevaFila.append('<td><input type="number" class="form-control precio_unitario" name="precio_unitario[]" value="' + precioProducto + '" readonly></td>');
                        nuevaFila.append('<td><input type="number" class="form-control total" name="total[]" value="' + precioProducto + '" readonly></td>');

                        // Botón para eliminar la fila
                        nuevaFila.append('<td><button type="button" class="btn btn-danger btnEliminar">Eliminar <i class="fal fa-trash-alt"></i></button></td>');

                        // Agregar la nueva fila al <tbody>
                        $('#puntoventa tbody').append(nuevaFila);

                        // Actualizar el total de todos los productos
                        actualizarTotal();
                    });

                    // Actualizar el total cuando cambie la cantidad
                    $('#puntoventa').on('input', '.cantidad', function() {
                        const fila = $(this).closest('tr');
                        const cantidad = $(this).val();
                        const precioUnitario = fila.find('.precio_unitario').val();
                        const total = cantidad * precioUnitario;
                        fila.find('.total').val(total);

                        // Actualizar el total de todos los productos
                        actualizarTotal();
                    });

                    // Eliminar fila
                    $('#puntoventa').on('click', '.btnEliminar', function() {
                        $(this).closest('tr').remove();
                        // Actualizar el total de todos los productos
                        actualizarTotal();
                    });

                    // Función para actualizar la fila de total
                    function actualizarTotal() {
                        let sumaTotal = 0;
                        $('#puntoventa .total').each(function() {
                            sumaTotal += parseFloat($(this).val()) || 0;
                        });

                        // Verificar si la fila de total ya existe
                        let totalFila = $('#puntoventa tfoot .total-row');
                        if (totalFila.length) {
                            totalFila.find('.total').text(sumaTotal.toFixed(2));
                        } else {
                            // Agregar una nueva fila de total si no existe
                            $('#puntoventa tfoot').remove(); // Eliminar cualquier fila existente de total
                            const filaTotal = $('<tfoot><tr class="total-row"><td colspan="3">Total:</td><td class="total">' + sumaTotal.toFixed(2) + '</td></tr></tfoot>');
                            $('#puntoventa').append(filaTotal);
                        }
                    }
                });
            </script>