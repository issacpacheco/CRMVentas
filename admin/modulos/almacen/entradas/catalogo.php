<?php
include("../../../class/allClass.php");

use nsadministracion\administracion;
use nsfunciones\funciones;

$admin = new administracion();
$funcion = new funciones();
$menu = filter_input(INPUT_POST, 'menu', FILTER_SANITIZE_SPECIAL_CHARS);
$modulo = filter_input(INPUT_POST, 'modulo', FILTER_SANITIZE_SPECIAL_CHARS);
$vista = filter_input(INPUT_POST, 'vista', FILTER_SANITIZE_SPECIAL_CHARS);
$opcion = filter_input(INPUT_POST, 'opcion', FILTER_SANITIZE_SPECIAL_CHARS);

$producto = $admin->obtener_productos_entrada();
$cproducto = $funcion->cuentarray($producto);
?>
<div class="row mb-2">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo ucfirst($menu); ?></a></li>
                    <li class="breadcrumb-item active"><?php echo ucfirst($modulo); ?></li>
                    <li class="breadcrumb-item active"><?php echo ucfirst($vista); ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<h4 class="page-title">Productos</h4>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <a href="javascript: void(0);" class="btn btn-primary btn-lg my-3" onClick="Vista('<?php echo $menu; ?>','<?php echo $modulo; ?>','abc','agregar')"><i class="fal fa-plus"></i> Agregar </a>
                <table class="table table-striped table-centered mb-0" id="tabla">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Fecha de entrada</th>
                            <th>Hora hora</th>
                            <th>Cantidad</th>
                            <!-- <th>Accion</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < $cproducto; $i++) { ?>
                            <tr>
                                <td><?php echo $producto['nombre'][$i]; ?></td>
                                <td><?php echo $producto['fecha_registro'][$i]; ?></td>
                                <td><?php echo $producto['hora_registro'][$i]; ?></td>
                                <td><?php echo $producto['cantidad'][$i]; ?></td>
                                <!-- <td class="table-action">
                                    <a href="javascript: void(0);" class="btn btn-success m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" onClick="Vista('<?php echo $menu; ?>','<?php echo $modulo; ?>','abc','editar','<?php echo md5($producto['id'][$i]); ?>')"> <i class="fal fa-pencil"></i></a>
                                    <a href="javascript: void(0);" class="btn btn-danger m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar" onClick="Vista('<?php echo $menu; ?>','<?php echo $modulo; ?>','abc','eliminar','<?php echo md5($producto['id'][$i]); ?>')"> <i class="fal fa-trash-alt"></i></a>
                                </td> -->
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                            <th>Producto</th>
                            <th>Fecha de entrada</th>
                            <th>Hora hora</th>
                            <th>Cantidad</th>
                            <!-- <th>Accion</th> -->
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>