<?php
include('../class/allClass.php');

use nsadministracion\administracion;
use nsfunciones\funciones;

$administracion = new administracion();
$funciones = new funciones();

$id_estado = filter_input(INPUT_POST, 'id_estado', FILTER_SANITIZE_NUMBER_INT);

$municipios = $administracion->obtener_municipios_x_estado($id_estado);
$cmunicipios = $funciones->cuentarray($municipios);

?>

<label>Municipio</label>
<select name="id_municipio" id="id_municipio" class="form-control list-municipios">
    <option value="0" selected>Selecciona un municipio</option>
    <?php
    for ($i = 0; $i < $cmunicipios; $i++) {
        echo "<option value='" . $municipios['id'][$i] . "'>" . $municipios['nombre'][$i] . "</option>";
    }

    ?>
</select>