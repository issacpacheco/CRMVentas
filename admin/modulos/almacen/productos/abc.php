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

//Consulta del producto a editar o eliminar
$producto = $administracion->obtener_producto($token);
//Consulta de unidades de medida
$unidades = $administracion->obtener_unidades_medida();
$cunidades = $funciones->cuentarray($unidades);
//Consulta de categorias 
$categorias = $administracion->obtener_categorias();
$ccategorias = $funciones->cuentarray($categorias);

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
            <input type="hidden" name="id_producto" id="id_producto" value="<?php echo $producto['id'][0] ?>">
            <div class="row mb-3">
                <div class="col-sm-4">
                    <label>Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $producto['nombre'][0] ?>">
                </div>
                <div class="col-sm-4">
                    <label>Descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control" value="<?php echo $producto['descripcion'][0] ?>">
                </div>
                <div class="col-sm-4">
                    <label>codigo interno</label>
                    <input type="text" name="codigo" id="codigo" class="form-control" value="<?php echo $producto['codigo'][0]; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <label>SKU</label>
                    <input type="text" name="sku" id="sku" class="form-control" value="<?php echo $producto['sku'][0]; ?>">
                </div>
                <div class="col-sm-3">
                    <label>Precio original</label>
                    <input type="text" name="precio_original" id="precio_original" class="form-control" value="<?php echo $producto['precio_original'][0]; ?>" onChange="CalcularPrecio();">
                </div>
                <div class="col-sm-3">
                    <label>Porcentaje de ganancia</label>
                    <input type="number" name="porcentaje_ganancia" id="porcentaje_ganancia" class="form-control" value="<?php echo $producto['porcentaje_ganancia'][0]; ?>" onchange="CalcularPrecio();">
                </div>
                <div class="col-sm-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 ms-3">
                            <p class="h3">Incluye IVA: </p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="form-check" id="card-switchiva">
                                <label for="switch_iva" data-on-label="Sí" data-off-label="No" class="mb-0 d-block h4"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <label>Precio venta</label>
                    <input type="text" name="precio_venta" id="precio_venta" class="form-control" value="<?php echo $producto['precio_venta'][0]; ?>">
                </div>
                <div class="col-sm-3">
                    <label>Cantidad</label>
                    <input type="text" name="cantidad" id="cantidad" class="form-control" value="<?php echo $producto['cantidad'][0]; ?>">
                </div>
                <div class="col-sm-3">
                    <label>Estatus</label>
                    <select name="estatus" id="estatus" class="form-control">
                        <option value="0" selected>Selecciona una opción</option>
                        <option value="1" <?php echo $producto['estatus'][0] == '1' ? 'selected' : ''; ?>>Activo</option>
                        <option value="2" <?php echo $producto['estatus'][0] == '2' ? 'selected' : ''; ?>>Inactivo</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label>Unidad de medida</label>
                    <select name="id_unidad" id="id_unidad" class="form-control">
                        <option value="0">Selecciona una opcion</option>
                        <?php for ($i = 0; $i < $cunidades; $i++) {
                            if ($unidades['id'][$i] == $producto['id_unidad'][0]) { ?>
                                <option value="<?php echo $unidades['id'][$i]; ?>" selected><?php echo $unidades['nombre'][$i] ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $unidades['id'][$i]; ?>"><?php echo $unidades['nombre'][$i]; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <label>Categoria del producto</label>
                    <select name="id_categoria" id="id_categoria" class="form-control">
                        <option value="0">Selecciona una opcion</option>
                        <?php for ($i = 0; $i < $ccategorias; $i++) {
                            if ($categorias['id'][$i] == $producto['id_categoria'][0]) { ?>
                                <option value="<?php echo $categorias['id'][$i]; ?>" selected><?php echo $categorias['nombre'][$i] ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $categorias['id'][$i]; ?>"><?php echo $categorias['nombre'][$i]; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-12 mb-2 full border-gris" id="cajongaleria">
                    <div class="thumbnail">
                        <img src="" alt="" class="responsive">
                        <div class="portaelimina">
                            <i class="fal fa-trash borrarimagen"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <input type="file" name="file" id="file" accept="image/x-png,img/jpg">
                    <div class="upload-area fullimportant" id="uploadfile">
                        <h1>Arrastra y suelta el archivo aqui <br> Selecciona el archivo</h1>
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

        //let data = new FormData($('#form_abc'));
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
            url: 'modulos/<?php echo $menu; ?>/<?php echo $modulo; ?>/upload',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                addThumbnail(response);
            }
        })
    }

    function addThumbnail(data) {
        let len = $("#cajongaleria div.thumbnail").length;

        let num = Number(len);
        num = num + 1;
        console.log(data);
        let name = data.nombre;
        let size = convertSize(data.size);
        let src = data.src;
        let id = data.idfoto;
        let page = "eliminar-foto-material";

        // Creating an thumbnail 
        let thumb = '<div class="thumbnail" id="foto_' + id + '">\n\
                     <img src="upload/material/' + id + '/' + name + '" class="responsive" />\n\
                      <div class="portaelimina">\n\
                        <span onclick="eliminarImagen(\'' + id + '\', \'' + name + '\')" class="borrarimagen fas fa-trash-alt letraroja font18 pointer tooltip" title="Eliminar imagen"></span>\n\
                        <i class="borrarimagen fal fa-trash-alt" onclick="eliminarImagen(\'' + id + '\', \'' + name + '\',\'' + page + '\')" title="Eliminar imagen"></i>\n\
                      </div>\n\
                    </div>';

        $("#cajongaleria").append(thumb);

        $("#uploadfile").html("<h1>Arrastra y suelta el archivo aqui<br />O<br />Selecciona el archivo</h1>");
    }

    // Bytes conversion
    function convertSize(size) {
        let sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (size == 0)
            return '0 Byte';
        let i = parseInt(Math.floor(Math.log(size) / Math.log(1024)));
        return Math.round(size / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }

    // preventing page from redirecting
    $("html").on("drop", function(e) {
        e.preventDefault();
        e.stopPropagation();
    });

    // Drag enter
    $('.upload-area').on('dragenter', function(e) {
        e.stopPropagation();
        e.preventDefault();
        $("#uploadfile h1").text("Suelta la imagen aqui");
    });

    // Drag over
    $('.upload-area, html').on('dragover', function(e) {
        e.stopPropagation();
        e.preventDefault();
        $("#uploadfile h1").text("Suelta la imagen aqui");
    });

    $('html').on("dragleave", function(e) {
        e.stopPropagation();
        e.preventDefault();
        $("#uploadfile").html("<h1>Arrastra y suelta el archivo aqui<br />O<br />Selecciona el archivo</h1>");
    });

    // Drop
    $('.upload-area').on('drop', function(e) {
        e.stopPropagation();
        e.preventDefault();

        $("#uploadfile h1").text("Subiendo imagen....");

        let file = e.originalEvent.dataTransfer.files;
        let id_producto = $("#id_producto").val();
        let fd = new FormData();

        fd.append('file', file[0]);
        fd.append('token', id_producto);

        uploadData(fd);
    });

    // Open file selector on div click
    $("#uploadfile").click(function() {
        $("#file").click();
    });

    // file selected
    $("#file").change(function() {
        $("#uploadfile h1").text("Subiendo imagen....");
        let fd = new FormData();

        let files = $('#file')[0].files[0];
        let id_producto = $("#id_producto").val();

        fd.append('file', files);
        fd.append('token', id_producto);
        uploadData(fd);
    });
</script>