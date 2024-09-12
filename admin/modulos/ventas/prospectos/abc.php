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

//Consulta del prospecto a editar o eliminar
$prospecto = $administracion->obtener_prospecto($token);
//Consulta de estados de México
$estados = $administracion->obtener_estados();
$cestados = $funciones->cuentarray($estados);
//Consulta de municipios de México
$municipios = $administracion->obtener_municipios();
$cmunicipios = $funciones->cuentarray($municipios);

$estatus = $administracion->obtener_estatus();
$cestatus = $funciones->cuentarray($estatus);

$etiquetas = $administracion->obtener_etiquetas();
$cetiquetas = $funciones->cuentarray($etiquetas);

// $medios = $administracion->obtener_medios();
// $cmedios = $funciones->cuentarray($medios);


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
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <picture>
                                    <source srcset="img/avatar-1.png" type="image/svg+xml">
                                    <img src="img/avatar-1.png" class="img-fluid img-thumbnail rounded-circle" alt="avatar">
                                </picture>
                            </div>
                            <div class="col-sm-9">
                                <p class="h4 fw-bold"><?php echo $prospecto['nombre'][0] . ' ' . $prospecto['paterno'][0] . ' ' . $prospecto['materno'][0];  ?></p>
                                <p class="h5"><?php echo $prospecto['correo'][0]; ?></p>
                                <p class="h6"><?php echo $prospecto['telefono'][0]; ?></p>
                            </div>
                        </div>
                        <div class="text-center justify-content-center d-flex flex-row bd-highlight mb-3">

                            <div class="p-1 bd-highlight text-center">
                                <button class="btn btn-outline-secondary rounded-circle p-importante" onClick="ModalDraggable('nota')"><i class="fal fa-pencil"></i></button>
                                <p class="f-12">Nota</p>
                            </div>
                            <div class="p-1 bd-highlight text-center">
                                <button class="btn btn-outline-primary rounded-circle p-importante" onClick="ModalDraggable('correo')"><i class="fal fa-envelope"></i></button>
                                <p class="f-12">Correo</p>
                            </div>
                            <div class="p-1 bd-highlight text-center">
                                <button class="btn btn-outline-warning rounded-circle p-importante" onClick="ModalDraggable('llamada')"><i class="fal fa-phone-alt"></i></button>
                                <p class="f-12">Llamada</p>
                            </div>
                            <div class="p-1 bd-highlight text-center">
                                <button class="btn btn-outline-danger rounded-circle p-importante" onClick="ModalDraggable('tarea')"><i class="fal fa-tasks"></i></button>
                                <p class="f-12">Tarea</p>
                            </div>
                            <div class="p-1 bd-highlight text-center">
                                <button class="btn btn-outline-success rounded-circle p-importante" onClick="ModalDraggable('whatsapp')"><i class="fab fa-whatsapp"></i></button>
                                <p class="f-12">Whatsapp</p>
                            </div>
                        </div>
                        <hr />


                        <form action="#" method="post" id="form_abc" enctype="multipart/form-data">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <i class="fal fa-caret-right"></i> Información del prospecto
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-sm-12 mb-1">
                                                    <label>Nombre</label>
                                                    <input type="text" class="form-control" value="<?php echo $prospecto['nombre'][0] ?>" id="nombre" name="nombre">
                                                </div>
                                                <div class="col-sm-6 mb-1">
                                                    <label>Paterno</label>
                                                    <input type="text" class="form-control" value="<?php echo $prospecto['paterno'][0] ?>" id="paterno" name="paterno">
                                                </div>
                                                <div class="col-sm-6 mb-1">
                                                    <label>Materno</label>
                                                    <input type="text" class="form-control" value="<?php echo $prospecto['materno'][0] ?>" id="materno" name="materno">
                                                </div>
                                                <div class="col-sm-12 mb-1">
                                                    <label>Correo</label>
                                                    <input type="email" class="form-control" value="<?php echo $prospecto['correo'][0] ?>" id="correo" name="correo">
                                                </div>
                                                <div class="col-sm-12 mb-1">
                                                    <label>Telefono</label>
                                                    <input type="text" class="form-control" value="<?php echo $prospecto['telefono'][0] ?>" id="telefono" name="telefono">
                                                </div>
                                                <div class="col-sm-6 mb-1">
                                                    <label>Estatus del prospecto</label>
                                                    <select name="estatus" id="estatus" class="form-control">
                                                        <option value="0" selected>Inicio proceso</option>
                                                        <?php
                                                        for ($i = 0; $i < $cestatus; $i++) {
                                                            if ($prospecto['estatus'][0] == $estatus['id'][$i]) {
                                                                echo "<option value='" . $estatus['id'][$i] . "' selected>" . $estatus['estatus'][$i] . "</option>";
                                                            } else {
                                                                echo "<option value='" . $estatus['id'][$i] . "'>" . $estatus['estatus'][$i] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 mb-1">
                                                    <label>Etiqueta</label>
                                                    <select name="etiqueta" id="etiqueta" class="form-control">
                                                        <option value="0" selected>Selecciona una opción</option>
                                                        <?php
                                                        for ($i = 0; $i < $cetiquetas; $i++) {
                                                            if ($prospecto['etiqueta'][0] == $etiquetas['id'][$i]) {
                                                                echo "<option value='" . $etiquetas['id'][$i] . "' selected>" . $etiquetas['etiqueta'][$i] . "</option>";
                                                            } else {
                                                                echo "<option value='" . $etiquetas['id'][$i] . "'>" . $etiquetas['etiqueta'][$i] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 mb-1">
                                                    <label>Estado</label>
                                                    <select name="id_estado" id="id_estado" class="form-control list-ciudades" onchange="CambiarCiudad(this)">
                                                        <option value="0" selected>Selecciona un estado</option>
                                                        <?php
                                                        for ($i = 0; $i < $cestados; $i++) {
                                                            if ($estados['id'][$i] == $prospecto['id_estado'][0]) {
                                                                echo "<option value='" . $estados['id'][$i] . "' selected>" . $estados['nombre'][$i] . "</option>";
                                                            } else {
                                                                echo "<option value='" . $estados['id'][$i] . "'>" . $estados['nombre'][$i] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 mb-1" id="municipios">
                                                    <label>Municipio</label>
                                                    <select name="id_municipio" id="id_municipio" class="form-control list-municipios">
                                                        <option value="0" selected>Selecciona un estado primero</option>
                                                        <?php
                                                        if ($prospecto['id_municipio'][0] != 0) {
                                                            for ($i = 0; $i < $cmunicipios; $i++) {
                                                                if ($municipios['id'][$i] == $prospecto['id_municipio'][0]) {
                                                                    echo "<option value='" . $municipios['id'][$i] . "' selected>" . $municipios['nombre'][$i] . "</option>";
                                                                } else {
                                                                    echo "<option value='" . $municipios['id'][$i] . "'>" . $municipios['nombre'][$i] . "</option>";
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <i class="fal fa-caret-right"></i> Información extra
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-sm-12 mb-1">
                                                    <label>¿Dónde se enteró de nosotros?</label>
                                                    <select name="id_medio_nos_conocio" id="id_medio_nos_conocio" class="form-control">
                                                        <option value="0" selected>Selecciona un medio</option>
                                                        <?php
                                                        for ($i = 0; $i < $cmedios; $i++) {
                                                            if ($medios['id'][$i] == $prospecto['id_medio_nos_conocio'][0]) {
                                                                echo "<option value='" . $medios['id'][$i] . "' selected>" . $medios['nombre'][$i] . "</option>";
                                                            } else {
                                                                echo "<option value='" . $medios['id'][$i] . "'>" . $medios['nombre'][$i] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 mb-1">
                                                    <label>Medio de contacto</label>
                                                    <select name="id_medio_contacto" id="id_medio_contacto" class="form-control">
                                                        <option value="0" selected>Selecciona una oferta educativa</option>
                                                        <?php
                                                        for ($i = 0; $i < $cmedios_contacto; $i++) {
                                                            if ($medios_contacto['id'][$i] == $prospecto['id_medio_contacto'][0]) {
                                                                echo "<option value='" . $medios_contacto['id'][$i] . "' selected>" . $medios_contacto['nombre_medio'][$i] . "</option>";
                                                            } else {
                                                                echo "<option value='" . $medios_contacto['id'][$i] . "'>" . $medios_contacto['nombre_medio'][$i] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 mb-1">
                                                    <label>Campaña</label>
                                                    <select name="id_campania" id="id_campania" class="form-control" onchange="ObtenerCampania(this);">
                                                        <option value="" selected>Selecciona una campaña publicitaria</option>
                                                        <?php
                                                        for ($c = 0; $c < $ccampanias; $c++) {
                                                            $id_plataforma = $campanias['facebook_id'][$c] != '' ? $campanias['facebook_id'][$c] : $campanias['google_id'][$c];
                                                            if ($campanias['id'][$c] == $prospecto['id_campania'][0]) {
                                                                echo "<option value='" . $campanias['id'][$c] . "' selected>" . strtoupper($campanias['nombre'][$c]) . " | " . $id_plataforma . "</option>";
                                                            } else {
                                                                echo "<option value='" . $campanias['id'][$c] . "'>" . strtoupper($campanias['nombre'][$c]) . " | " . $id_plataforma . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div id="divcampania"></div>
                                                <div class="col-sm-12 mb-1">
                                                    <label>Comentarios</label>
                                                    <textarea name="comentario" class="form-control" rows="4" placeholder="Comentario" <?php echo $read; ?>></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="hidden" name="modulo" id="modulo" value="<?php echo $modulo; ?>">
                                                <input type="hidden" name="opcion" value="<?php echo $opcion ?>">
                                                <?php
                                                if ($_POST['opcion'] == 'editar') {
                                                    echo '
								<input type="hidden" name="token" value="' . $token . '">
								<div class="d-grid gap">
									<button type="submit" class="btn btn-success btn-lg btn-block" id="boton_guardar">Guardar <i class="fal fa-save"></i></button>
								</div>
								';
                                                } else if ($_POST['opcion'] == 'eliminar') {
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
                                            <div class="col-sm-6">
                                                <div class="d-grid gap">
                                                    <a href="javascript:void(0);" class="btn btn-info btn-lg btn-block" onClick="Vista('<?php echo $menu; ?>','<?php echo $modulo; ?>','catalogo')">Cancelar <i class="fas fa-times"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- <div class="col-sm-8 bg-light" id="miDiv">
                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Descripción</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Actividades</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active mb-3 card-body row" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="col-sm-12 row card bg-white text-black mb-3">
                                    <div class="col-sm-12 mb-3 mt-3">
                                        <h3>Aspectos destacados de los datos</h3>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12">
                                            <div class="col-sm-12 row mb-3">
                                                <div class="col-sm-4">
                                                    <h4 class="text-center fw-bold">Fecha de creación</h4>
                                                    <p class="text-center fw-bold"><?php echo $prospecto['fch_registro'][0] ?></p>
                                                </div>
                                                <div class="col-sm-4">
                                                    <h4 class="text-center fw-bold">Etapa del prospecto</h4>
                                                    <p class="text-center fw-bold"><?php echo $etapa_prospectos; ?></p>
                                                </div>
                                                <div class="col-sm-4">
                                                    <h4 class="text-center fw-bold">Ultima actividad</h4>
                                                    <p class="text-center fw-bold"><?php echo $ultima_actividad; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 row card bg-white mb-3 text-black">
                                    <div class="col-sm-12 mb-3">
                                        <h4>Actividades reciente</h4>
                                    </div>
                                    <div class="col-sm-12 row bg-white">
                                        <?php
                                        if ($cultimas_actividades == 0) {
                                            echo "<h2>SIN ACTIVIDADES</h2>";
                                        } else {
                                            for ($i = 0; $i < $cultimas_actividades; $i++) {
                                                $consulta3 = mysqli_query($conexion, "SELECT * FROM si_usuarios WHERE id = '{$ultimas_actividades['asesor'][$i]}'");
                                                $prospecto3 = mysqli_fetch_array($consulta3);
                                                switch ($ultimas_actividades['origen'][$i]) {
                                                    case 'si_' . $modulo . '_notas':
                                                        $contenido = '<a class="btn btn-secondary rounded-circle p-importante"><i class="fal fa-pencil"></i> </a>
														<span> <span class="text-success fw-bold">' . $prospecto3['nombre'] . ' ' . $prospecto3['paterno'] . '</span> registro una nota a <span class="text-success fw-bold">' . $prospecto['nombre'][0] . ' ' . $prospecto['paterno'][0] . '</span></span>';
                                                        break;
                                                    case 'si_' . $modulo . '_correos':
                                                        $contenido = '<a class="btn btn-primary rounded-circle p-importante"><i class="fal fa-envelope"></i> </a>
														<span> <span class="text-success fw-bold">' . $prospecto3['nombre'] . ' ' . $prospecto3['paterno'] . '</span> envio un correo a <span class="text-success fw-bold">' . $prospecto['nombre'][0] . ' ' . $prospecto['paterno'][0] . '</span></span>';
                                                        break;
                                                    case 'si_' . $modulo . '_llamadas':
                                                        $contenido = '<a class="btn btn-warning rounded-circle p-importante"><i class="fal fa-phone-alt"></i> </a>
														<span> <span class="text-success fw-bold">' . $prospecto3['nombre'] . ' ' . $prospecto3['paterno'] . '</span> registro una llamada a <span class="text-success fw-bold">' . $prospecto['nombre'][0] . ' ' . $prospecto['paterno'][0] . '</span></span>';
                                                        break;
                                                    case 'si_' . $modulo . '_tareas':
                                                        $contenido = '<a class="btn btn-danger rounded-circle p-importante"><i class="fal fa-tasks"></i> </a>
														<span> <span class="text-success fw-bold">' . $prospecto3['nombre'] . ' ' . $prospecto3['paterno'] . '</span> registro una tarea a <span class="text-success fw-bold">' . $prospecto['nombre'][0] . ' ' . $prospecto['paterno'][0] . '</span></span>';
                                                        break;
                                                    case 'si_' . $modulo . '_comentarios':
                                                        $contenido = '<a class="btn btn-info rounded-circle p-importante"><i class="fal fa-comment"></i> </a>
														<span> <span class="text-success fw-bold">' . $prospecto3['nombre'] . ' ' . $prospecto3['paterno'] . '</span> realizo un comentario a <span class="text-success fw-bold">' . $prospecto['nombre'][0] . ' ' . $prospecto['paterno'][0] . '</span></span>';
                                                        break;
                                                }
                                        ?>
                                                <div class="col-sm-12 row mb-3">
                                                    <div class="col-sm-8">
                                                        <?php echo $contenido; ?>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <p><?php echo $funciones->fechaMexicana($ultimas_actividades['fecha_registro_actividad'][$i]) . ' a la(s) ' . $ultimas_actividades['hora_registro_actividad'][$i] ?></p>
                                                    </div>
                                                </div>
                                                <hr />
                                        <?php }
                                        } ?>
                                    </div>
                                </div>

                                <div class="col-sm-12 row card bg-white mb-3 text-black">
                                    <div class="col-sm-12 mb-3">
                                        <h4>Historial de comentarios</h4>
                                    </div>
                                    <div class="col-sm-12 mb-4 row">
                                        <?php if ($ccomentarios == 0) {
                                            echo "<h2>SIN COMENTARIOS</h2>";
                                        } else { ?>
                                            <?php for ($i = 0; $i < $ccomentarios; $i++) { ?>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="well">
                                                            <p><strong>Fecha: <?php echo $funciones->FechaFormato($comentarios['fch_registro'][$i]) . ' ' . $comentarios['hra_registro'][$i]; ?></strong></p>
                                                            <p><?php echo $comentarios['comentario'][$i]; ?></p>
                                                            <br>
                                                            <p class="text-info"><strong>Asesor: </strong><?php echo $comentarios['asesor'][$i]; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php }
                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade mb-3 card-body row" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="col-sm-12 mb-3" id="nav-test">
                                    <div id="nav-container">
                                        <ul>
                                            <li class="nav-li active-nav"><a id="p_actividad">Actividad</a></li>
                                            <li class="nav-li"><a id="p_nota">Notas</a></li>
                                            <li class="nav-li"><a id="p_correo">Correos</a></li>
                                            <li class="nav-li"><a id="p_llamada">Llamadas</a></li>
                                            <li class="nav-li"><a id="p_tarea">Tareas</a></li>
                                        </ul>
                                        <hr>
                                        <div id="line" class="mt-n2"></div>
                                    </div>
                                </div>

                                <div class="col-sm-12 d-none row card text-black" id="d_actividad">
                                    <div class="col-sm-12 card-body mb-0">
                                        <p>Fecha</p>
                                    </div>
                                    <div class="col-sm-12 row bg-white card-body mt-n3">
                                        <?php for ($i = 0; $i < $cultimas_actividades; $i++) {
                                            $consulta3 = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id = '{$ultimas_actividades['asesor'][$i]}'");
                                            $prospecto3 = mysqli_fetch_array($consulta3);
                                            switch ($ultimas_actividades['origen'][$i]) {
                                                case 'si_' . $modulo . '_notas':
                                                    $contenido = '<a class="btn btn-secondary rounded-circle p-importante"><i class="fal fa-pencil"></i> </a>
													<span> <span class="text-success fw-bold">' . $prospecto3['nombre'] . ' ' . $prospecto3['paterno'] . '</span> registro una nota a <span class="text-success fw-bold">' . $prospecto['nombre'][0] . ' ' . $prospecto['paterno'][0] . '</span></span>';
                                                    break;
                                                case 'si_' . $modulo . '_correos':
                                                    $contenido = '<a class="btn btn-primary rounded-circle p-importante"><i class="fal fa-envelope"></i> </a>
													<span> <span class="text-success fw-bold">' . $prospecto3['nombre'] . ' ' . $prospecto3['paterno'] . '</span> envio un correo a <span class="text-success fw-bold">' . $prospecto['nombre'][0] . ' ' . $prospecto['paterno'][0] . '</span></span>';
                                                    break;
                                                case 'si_' . $modulo . '_llamadas':
                                                    $contenido = '<a class="btn btn-warning rounded-circle p-importante"><i class="fal fa-phone-alt"></i> </a>
													<span> <span class="text-success fw-bold">' . $prospecto3['nombre'] . ' ' . $prospecto3['paterno'] . '</span> registro una llamada a <span class="text-success fw-bold">' . $prospecto['nombre'][0] . ' ' . $prospecto['paterno'][0] . '</span></span>';
                                                    break;
                                                case 'si_' . $modulo . '_tareas':
                                                    $contenido = '<a class="btn btn-danger rounded-circle p-importante"><i class="fal fa-tasks"></i> </a>
													<span> <span class="text-success fw-bold">' . $prospecto3['nombre'] . ' ' . $prospecto3['paterno'] . '</span> registro una tarea a <span class="text-success fw-bold">' . $prospecto['nombre'][0] . ' ' . $prospecto['paterno'][0] . '</span></span>';
                                                    break;
                                                case 'si_' . $modulo . '_comentarios':
                                                    $contenido = '<a class="btn btn-info rounded-circle p-importante"><i class="fal fa-comment"></i> </a>
													<span> <span class="text-success fw-bold">' . $prospecto3['nombre'] . ' ' . $prospecto3['paterno'] . '</span> realizo un comentario a <span class="text-success fw-bold">' . $prospecto['nombre'][0] . ' ' . $prospecto['paterno'][0] . '</span></span>';
                                                    break;
                                            }
                                        ?>
                                            <div class="col-sm-12 row mb-3">
                                                <div class="col-sm-8">
                                                    <?php echo $contenido; ?>
                                                </div>
                                                <div class="col-sm-4">
                                                    <p><?php echo $funciones->fechaMexicana($ultimas_actividades['fecha_registro_actividad'][$i]) . ' a la(s) ' . $ultimas_actividades['hora_registro_actividad'][$i] ?></p>
                                                </div>
                                            </div>
                                            <hr />
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="d-none" id="d_nota">
                                    <div class="d-flex justify-content-end mb-3">
                                        <button class="btn btn-outline-secondary" onClick="ModalDraggable('nota')"><i class="fal fa-plus"></i> Crear nota</button>
                                    </div>
                                    <div id="contenedor-nota" class="row card text-black"></div>
                                    <?php $consulta1 = mysqli_query($conexion, "SELECT fecha_registro FROM prospectos WHERE MD5(id) = '{$token}' GROUP BY fecha_registro ORDER BY fecha_registro DESC");
                                    while ($prospecto1 = mysqli_fetch_array($consulta1)) { ?>
                                        <h5><?php echo $funciones->fechaMexicana($prospecto1['fecha_registro']) ?></h5>
                                        <div class="row card text-black">
                                            <div class="col-sm-12 row bg-white card-body">
                                                <?php $consulta2 = mysqli_query($conexion, "SELECT * FROM prospectos WHERE MD5(id) = '{$token}' AND fecha_registro = '{$prospecto1['fecha_registro']}' ORDER BY id DESC");
                                                while ($prospecto2 = mysqli_fetch_array($consulta2)) {
                                                    $consulta3 = mysqli_query($conexion, "SELECT * FROM si_usuarios WHERE id = '{$prospecto2['id_usuario']}'");
                                                    $prospecto3 = mysqli_fetch_array($consulta3);
                                                ?>
                                                    <div class="col-sm-12 mb-3 row">
                                                        <div class="col-sm-8">
                                                            <p>Nota por <span class="text-success fw-bold"><?php echo $prospecto3['nombre'] . ' ' . $prospecto3['paterno'] . ' ' . $prospecto3['materno'] ?></span></p>
                                                            <?php echo $prospecto2['nota'] ?>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <p><?php echo $funciones->fechaMexicana($prospecto2['fecha_registro']); ?> a la(s) <?php echo $prospecto2['hora_registro'] ?></p>
                                                        </div>

                                                    </div>
                                                    <hr>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="d-none" id="d_correo">
                                    <div class="d-flex justify-content-end mb-3">
                                        <button class="btn btn-outline-secondary" onClick="ModalDraggable('correo')"><i class="fal fa-plus"></i> Nuevo correo</button>
                                    </div>
                                    <div id="contenedor-correo" class="row card text-black"></div>
                                    <?php $consulta1 = mysqli_query($conexion, "SELECT fecha_registro FROM prospectos WHERE MD5(id) = '{$token}' GROUP BY fecha_registro ORDER BY fecha_registro DESC");
                                    while ($prospecto1 = mysqli_fetch_array($consulta1)) { ?>
                                        <h5><?php echo $funciones->fechaMexicana($prospecto1['fecha_registro']) ?></h5>
                                        <div class="row card text-black">
                                            <div class="col-sm-12 row bg-white card-body">
                                                <?php $consulta2 = mysqli_query($conexion, "SELECT * FROM prospectos WHERE MD5(id) = '{$token}' AND fecha_registro = '{$prospecto1['fecha_registro']}' ORDER BY id DESC");
                                                while ($prospecto2 = mysqli_fetch_array($consulta2)) {
                                                    $consulta3 = mysqli_query($conexion, "SELECT * FROM si_usuarios WHERE id = '{$prospecto2['id_usuario']}'");
                                                    $prospecto3 = mysqli_fetch_array($consulta3);
                                                ?>
                                                    <div class="col-sm-12 mb-3 row">
                                                        <div class="col-sm-8">
                                                            <p>Correo enviado por <span class="text-success fw-bold"><?php echo $prospecto3['nombre'] . ' ' . $prospecto3['paterno'] . ' ' . $prospecto3['materno'] ?></span></p>
                                                            <?php echo $prospecto2['contenido'] ?>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <p><?php echo $funciones->fechaMexicana($prospecto2['fecha_registro']); ?> a la(s) <?php echo $prospecto2['hora_registro'] ?></p>
                                                        </div>

                                                    </div>
                                                    <hr>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="d-none" id="d_llamada">
                                    <div class="d-flex justify-content-end mb-3">
                                        <button class="btn btn-outline-secondary" onClick="ModalDraggable('llamada')"><i class="fal fa-plus"></i> Registrar llamada</button>
                                    </div>
                                    <div id="contenedor-llamada" class="row card text-black"></div>
                                    <?php $consulta1 = mysqli_query($conexion, "SELECT fecha_registro FROM prospectos WHERE MD5(id) = '{$token}' GROUP BY fecha_registro ORDER BY fecha_registro DESC");
                                    while ($prospecto1 = mysqli_fetch_array($consulta1)) { ?>
                                        <h5><?php echo $funciones->fechaMexicana($prospecto1['fecha_registro']) ?></h5>
                                        <div class="row card text-black">
                                            <div class="col-sm-12 row bg-white card-body">
                                                <?php $consulta2 = mysqli_query($conexion, "SELECT * FROM prospectos WHERE MD5(id) = '{$token}' AND fecha_registro = '{$prospecto1['fecha_registro']}' ORDER BY id DESC");
                                                while ($prospecto2 = mysqli_fetch_array($consulta2)) {
                                                    $consulta3 = mysqli_query($conexion, "SELECT * FROM si_usuarios WHERE id = '{$prospecto2['id_usuario']}'");
                                                    $prospecto3 = mysqli_fetch_array($consulta3);
                                                ?>
                                                    <div class="col-sm-12 mb-3 row">
                                                        <div class="col-sm-8">
                                                            <p>Llamada registrada - Realizado por <span class="text-success fw-bold"><?php echo $prospecto3['nombre'] . ' ' . $prospecto3['paterno'] . ' ' . $prospecto3['materno'] ?></span></p>
                                                            <?php echo $prospecto2['contenido'] ?>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <p><?php echo $funciones->fechaMexicana($prospecto2['fecha_registro']); ?> a la(s) <?php echo $prospecto2['hora_registro'] ?></p>
                                                        </div>
                                                        <hr>
                                                        <div class="col-sm-12 row">
                                                            <div class="col-sm-3">
                                                                <label>Resultado</label>
                                                                <select name="resultado" id="resultado" class="form-control" disabled>
                                                                    <?php for ($i = 0; $i < $cbandera_llamada; $i++) {
                                                                        if ($prospecto2['resultado_llamada'] == $bandera_llamada['id'][$i]) {
                                                                            echo '<option value="' . $bandera_llamada['id'][$i] . '" selected>' . $bandera_llamada['bandera'][$i] . '</option>';
                                                                        } else {
                                                                            echo '<option value="' . $bandera_llamada['id'][$i] . '" >' . $bandera_llamada['bandera'][$i] . '</option>';
                                                                        }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label>Dirección</label>
                                                                <select name="direccion" id="direccion" class="form-control" disabled>
                                                                    <option value="0" selected>Seleccionar dirección de la llamada</option>
                                                                    <option value="1" <?php echo $prospecto2['direccion_llamada'] == 1 ? 'selected' : ''; ?>>Entrante</option>
                                                                    <option value="2" <?php echo $prospecto2['direccion_llamada'] == 2 ? 'selected' : ''; ?>>Saliente</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label>Fecha</label>
                                                                <input type="date" name="registro_llamada" id="registro_llamada" class="form-control" value="<?php echo $prospecto2['fecha_registro_llamada'] ?>" readonly>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label>Hora</label>
                                                                <input type="time" name="hora_llamada" id="hora_llamada" class="form-control" value="<?php echo $prospecto2['hora_registro_llamada'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="d-none" id="d_tarea">
                                    <div class="d-flex justify-content-end mb-3">
                                        <button class="btn btn-outline-secondary" onClick="ModalDraggable('tarea')"><i class="fal fa-plus"></i> Crear tarea</button>
                                    </div>
                                    <div id="contenedor-tarea" class="row card text-black"></div>
                                    <?php $consulta1 = mysqli_query($conexion, "SELECT fecha_registro FROM prospectos WHERE MD5(id) = '{$token}' GROUP BY fecha_registro ORDER BY fecha_registro DESC");
                                    while ($prospecto1 = mysqli_fetch_array($consulta1)) { ?>
                                        <h5><?php echo $funciones->fechaMexicana($prospecto1['fecha_registro']) ?></h5>
                                        <div class="row card text-black">
                                            <div class="col-sm-12 row bg-white card-body">
                                                <?php $consulta2 = mysqli_query($conexion, "SELECT * FROM prospectos WHERE MD5(id) = '{$token}' AND fecha_registro = '{$prospecto1['fecha_registro']}' ORDER BY id DESC");
                                                while ($prospecto2 = mysqli_fetch_array($consulta2)) {
                                                    $consulta3 = mysqli_query($conexion, "SELECT * FROM si_usuarios WHERE id = '{$prospecto2['id_usuario_asignado']}'");
                                                    $prospecto3 = mysqli_fetch_array($consulta3);
                                                ?>
                                                    <div class="col-sm-12 mb-3 row">
                                                        <div class="col-sm-8">
                                                            <p>Tarea asignada a <span class="text-success fw-bold"><?php echo $prospecto3['nombre'] . ' ' . $prospecto3['paterno'] . ' ' . $prospecto3['materno'] ?></span></p>
                                                            <?php echo $prospecto2['contenido'] ?>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <p><?php echo $funciones->fechaMexicana($prospecto2['fecha_registro']); ?> a la(s) <?php echo $prospecto2['hora_registro'] ?></p>
                                                        </div>
                                                        <div class="col-sm-12 mt-1">
                                                            <h4><?php echo $prospecto2['titulo_tarea'] ?></h4>
                                                        </div>
                                                        <hr>
                                                        <div class="col-sm-12 row mb-3">
                                                            <div class="col-sm-3">
                                                                <label>Fecha de vencimiento</label>
                                                                <input type="date" name="fecha_vencimiento_tarea" id="fecha_vencimiento_tarea" class="form-control" value="<?php echo $prospecto2['fecha_vencimiento'] ?>" readonly>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label>Hora de vencimiento</label>
                                                                <input type="time" name="hora_vencimiento_tarea" id="hora_vencimiento_tarea" class="form-control" value="<?php echo $prospecto2['hora_vencimiento'] ?>" readonly>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label>Recordatorio</label>
                                                                <select name="recordatorio" id="recordatorio" class="form-control" disabled>
                                                                    <option value="0" selected>Sin recordatorio</option>
                                                                    <option value="1" <?php echo $prospecto2['tipo_notificacion'] == 1 ? 'selected' : ''; ?>>A la hora del vencimiento de la tarea</option>
                                                                    <option value="2" <?php echo $prospecto2['tipo_notificacion'] == 2 ? 'selected' : ''; ?>>30 minutos antes</option>
                                                                    <option value="3" <?php echo $prospecto2['tipo_notificacion'] == 3 ? 'selected' : ''; ?>>1 hora antes</option>
                                                                    <option value="4" <?php echo $prospecto2['tipo_notificacion'] == 4 ? 'selected' : ''; ?>>1 día antes</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="col-sm-12 row">
                                                            <div class="col-sm-3">
                                                                <label>Tipo</label>
                                                                <select name="t_tarea" id="t_tarea" class="form-control">
                                                                    <option value="0">Selecciona un opción</option>
                                                                    <option value="1" <?php echo $prospecto2['tipo_tarea'] == 1 ? 'selected' : ''; ?>>Llamada</option>
                                                                    <option value="2" <?php echo $prospecto2['tipo_tarea'] == 2 ? 'selected' : ''; ?>>Correo</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label>Prioridad</label>
                                                                <select name="prioridad_tarea" id="prioridad_tarea" class="form-control">
                                                                    <option value="0" selected>Ninguna</option>
                                                                    <option value="1" class="text-success" <?php echo $prospecto2['prioridad'] == 1 ? 'selected' : ''; ?>>&#11044; Baja</option>
                                                                    <option value="2" class="text-warning" <?php echo $prospecto2['prioridad'] == 2 ? 'selected' : ''; ?>>&#11044; Media</option>
                                                                    <option value="3" class="text-danger" <?php echo $prospecto2['prioridad'] == 3 ? 'selected' : ''; ?>>&#11044; Alta</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label>asignado a</label>
                                                                <select name="id_usuario_asignado" id="id_usuario_asignado" class="form-control">
                                                                    <option value="0" selected>Selecciona un asesor</option>
                                                                    <?php for ($i = 0; $i < $cusuarios; $i++) {
                                                                        if ($prospecto3['id'] == $usuarios['id'][$i]) {
                                                                            echo '<option value="' . $usuarios['id'][$i] . '" selected>' . $usuarios['nombre'][$i] . ' ' . $usuarios['paterno'][$i] . '</option>';
                                                                        } else {
                                                                            echo '<option value="' . $usuarios['id'][$i] . '" >' . $usuarios['nombre'][$i] . ' ' . $usuarios['paterno'][$i] . '</option>';
                                                                        }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="moda_nota" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg p-0 mb-2 bg-white rounded">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="staticBackdropLabel">Nota</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="fw-bold text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="editor_nota" contenteditable="true" onClick="comenzarAEscribir()">
                    <p>Empieza a escribir para dejar una nota</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onClick="GuardarModal('nota');">Guardar <i class="fal fa-save"></i></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="moda_correo" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg p-0 mb-2 bg-white rounded">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="staticBackdropLabel">Correo</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="fw-bold text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <label>Asunto</label>
                        <input type="text" name="asunto" id="asunto" class="form-control">
                    </div>
                </div>
                <h5>Cuerpo del correo</h5>
                <hr>
                <div id="editor_correo" class="mb-3" contenteditable="true" onClick="comenzarAEscribir()">
                    <p>Empieza a escribir tu correo</p>
                </div>
                <hr>
                <div class="row">
                    <h5>Datos de correo institucional (opcional)</h5>
                    <div class="col-sm-4">
                        <label>Correo saliente</label>
                        <input type="text" name="correo_usuario" id="correo_usuario" value="" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label>Contraseña del correo</label>
                        <input type="password" name="pass_correo_usuario" id="pass_correo_usuario" class="form-control mb-1">
                        <input type="checkbox" name="ver_pass" id="ver_pass" onClick="VerContrasena();"> Ver contraseña
                    </div>
                    <div class="alert alert-warning h5" role="alert">
                        Estos datos son opcionales, ya que el correo puede ser enviado por noreply@cert.edu.mx, pero si quieres llevar tu propio registro de correos y verlos en tu bandeja, puedes capturar tu correo institucional y tu contraseña, es importante mencionar que tu contraseña no es guardada en ninguna base de datos es por ello que cada que envíes un correo con tu usuario tu contraseña será solicitada a cada momento.
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onClick="GuardarModal('correo');">Enviar <i class="fal fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="moda_llamada" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg p-0 mb-2 bg-white rounded">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="staticBackdropLabel">Registrar llamada</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="fw-bold text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-1">
                    <div class="col-sm-4">
                        <label>Contactado</label>
                        <select name="id_asesor_llamada" id="id_asesor_llamada" class="form-select">
                            <option value="0" selected>Selecciona un asesor</option>
                            <?php for ($i = 0; $i < $cusuarios; $i++) {
                                if ($_SESSION['id'] == $usuarios['id'][$i]) {
                                    echo '<option value="' . $usuarios['id'][$i] . '" selected>' . $usuarios['nombre'][$i] . ' ' . $usuarios['paterno'][$i] . '</option>';
                                } else {
                                    echo '<option value="' . $usuarios['id'][$i] . '" >' . $usuarios['nombre'][$i] . ' ' . $usuarios['paterno'][$i] . '</option>';
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>Resultado de la llamada</label>
                        <select name="resultado_llamada" id="resultado_llamada" class="form-select">
                            <option value="0" selected>Selecciona un resultado</option>
                            <?php for ($i = 0; $i < $cbandera_llamada; $i++) {
                                echo '<option value="' . $bandera_llamada['id'][$i] . '" >' . $bandera_llamada['bandera'][$i] . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>Dirección</label>
                        <select name="direccion_llamada" id="direccion_llamada" class="form-select">
                            <option value="0" selected>Seleccionar dirección de la llamada</option>
                            <option value="1">Entrante</option>
                            <option value="2">Saliente</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label>Fecha</label>
                        <input type="date" name="fecha_registro_llamada" id="fecha_registro_llamada" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label>Hora</label>
                        <input type="time" name="hora_registro_llamada" id="hora_registro_llamada" class="form-control">
                    </div>
                </div>
                <hr>
                <div id="editor_llamada" class="mb-3" contenteditable="true" onClick="comenzarAEscribir()">
                    <p>Describe la llamada</p>
                </div>
                <hr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onClick="GuardarModal('llamada');">Registrar <i class="fal fa-save"></i></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="moda_tarea" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg p-0 mb-2 bg-white rounded">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="staticBackdropLabel">Tarea</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="fw-bold text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <label>Ingresa tu tarea</label>
                        <input type="text" name="titulo_tarea" id="titulo_tarea" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label>Fecha de vencimiento</label>
                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label>Hora</label>
                        <input type="time" name="hora_vencimiento" id="hora_vencimiento" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label>Notificarme recordatorio</label>
                        <select name="tipo_notificacion" id="tipo_notificacion" class="form-select">
                            <option value="0" selected>Sin recordatorio</option>
                            <option value="1">A la hora del vencimiento de la tarea</option>
                            <option value="2">30 minutos antes</option>
                            <option value="3">1 hora antes</option>
                            <option value="4">1 día antes</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <label>Tipo</label>
                        <select name="tipo_tarea" id="tipo_tarea" class="form-select">
                            <option value="0">Selecciona un opción</option>
                            <option value="1">Llamada</option>
                            <option value="2">Correo</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label>Prioridad</label>
                        <select name="prioridad" id="prioridad" class="form-select">
                            <option value="0" selected>Ninguna</option>
                            <option value="1" class="text-success">&#11044; Baja</option>
                            <option value="2" class="text-warning">&#11044; Media</option>
                            <option value="3" class="text-danger">&#11044; Alta</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label>asignado a</label>
                        <select name="id_usuario_asignado" id="id_usuario_asignado" class="form-select">
                            <option value="0" selected>Selecciona un asesor</option>
                            <?php for ($i = 0; $i < $cusuarios; $i++) {
                                if ($_SESSION['id'] == $usuarios['id'][$i]) {
                                    echo '<option value="' . $usuarios['id'][$i] . '" selected>' . $usuarios['nombre'][$i] . ' ' . $usuarios['paterno'][$i] . '</option>';
                                } else {
                                    echo '<option value="' . $usuarios['id'][$i] . '" >' . $usuarios['nombre'][$i] . ' ' . $usuarios['paterno'][$i] . '</option>';
                                }
                            } ?>
                        </select>
                    </div>
                </div>
                <hr>
                <div id="editor_tarea" class="mb-3" contenteditable="true" onClick="comenzarAEscribir()">
                    <p>Notas...</p>
                </div>
                <hr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onClick="GuardarModal('tarea');">Registrar <i class="fal fa-save"></i></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="moda_whatsapp" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg p-0 mb-2 bg-white rounded">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="staticBackdropLabel">Whatsapp</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="fw-bold text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <label>Escribe un mensaje</label>
                        <input type="text" name="mensaje_whatsapp" id="mensaje_whatsapp" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label>Teléfono</label>
                        <input type="text" name="numero_whatsapp" id="numero_whatsapp" class="form-control" value="<?php echo $d['telefono'][0] ?>">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onClick="EnviarWhatsapp();">Enviar <i class="fal fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</div> -->
<!-- <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script> -->
<!-- <script>
    $(document).ready(function() {
        var $activeWidth, $defaultMarginLeft, $defaultPaddingLeft, $firstChild, $line, $navListItem;

        $line = $('#line');

        $navListItem = $('.nav-li');

        $activeWidth = $('.active-nav').width();

        $firstChild = $('.nav-li:first-child');

        $defaultMarginLeft = parseInt($('.nav-li:first-child').next().css('marginLeft').replace(/\D/g, ''));

        $defaultPaddingLeft = parseInt($('#nav-container > ul').css('padding-left').replace(/\D/g, ''));

        $line.width($activeWidth + 'px');

        $line.css('marginLeft', $defaultPaddingLeft + 'px');

        $navListItem.click(function() {
            var $activeNav, $currentIndex, $currentOffset, $currentWidth, $initWidth, $marginLeftToSet, $this;
            $this = $(this);
            $activeNav = $('.active-nav');
            $currentWidth = $activeNav.width();
            $currentOffset = $activeNav.position().left;
            $currentIndex = $activeNav.index();
            $activeNav.removeClass('active-nav');
            $this.addClass('active-nav');
            if ($this.is($activeNav)) {
                return 0;
            } else {
                if ($this.index() > $currentIndex) {
                    if ($activeNav.is($firstChild)) {
                        $initWidth = $defaultMarginLeft + ($this.width() - 50) + ($this.position().left - 570) - $defaultPaddingLeft;
                    } else {
                        $initWidth = ($this.position().left - 570) + $this.width() - $currentOffset;
                    }
                    $marginLeftToSet = ($this.position().left - 570) + $defaultMarginLeft + 'px';
                    $line.width($initWidth + 'px');
                    return setTimeout(function() {
                        $line.css('marginLeft', $marginLeftToSet);
                        return $line.width($this.width() + 'px');
                    }, 175);
                } else {
                    if ($this.is($firstChild)) {
                        $initWidth = $currentOffset - $defaultPaddingLeft + $defaultMarginLeft + $currentWidth;
                        $marginLeftToSet = ($this.position().left - 570);
                    } else {
                        $initWidth = $currentWidth + $currentOffset - ($this.position().left - 570);
                        $marginLeftToSet = ($this.position().left - 570) + $defaultMarginLeft;
                    }
                    $line.css('marginLeft', $marginLeftToSet);
                    $line.width($initWidth + 'px');
                    return setTimeout(function() {
                        return $line.width($this.width() + 'px');
                    }, 175);
                }
            }
        });

        $("#p_actividad").on("click", function() {
            $("#d_actividad").removeClass("d-none");
            $("#d_nota").addClass("d-none");
            $("#d_correo").addClass("d-none");
            $("#d_llamada").addClass("d-none");
            $("#d_tarea").addClass("d-none");
            // $("#d_reunion").addClass("d-none");

            $("#d_actividad").addClass("d-block");
        });

        $("#p_nota").on("click", function() {
            $("#d_actividad").addClass("d-none");
            $("#d_nota").removeClass("d-none");
            $("#d_correo").addClass("d-none");
            $("#d_llamada").addClass("d-none");
            $("#d_tarea").addClass("d-none");
            // $("#d_reunion").addClass("d-none");

            $("#d_nota").addClass("d-block");
        });

        $("#p_correo").on("click", function() {
            $("#d_actividad").addClass("d-none");
            $("#d_nota").addClass("d-none");
            $("#d_correo").removeClass("d-none");
            $("#d_llamada").addClass("d-none");
            $("#d_tarea").addClass("d-none");
            // $("#d_reunion").addClass("d-none");

            $("#d_correo").addClass("d-block");
        });

        $("#p_llamada").on("click", function() {
            $("#d_actividad").addClass("d-none");
            $("#d_nota").addClass("d-none");
            $("#d_correo").addClass("d-none");
            $("#d_llamada").removeClass("d-none");
            $("#d_tarea").addClass("d-none");
            // $("#d_reunion").addClass("d-none");

            $("#d_llamada").addClass("d-block");
        });

        $("#p_tarea").on("click", function() {
            $("#d_actividad").addClass("d-none");
            $("#d_nota").addClass("d-none");
            $("#d_correo").addClass("d-none");
            $("#d_llamada").addClass("d-none");
            $("#d_tarea").removeClass("d-none");
            // $("#d_reunion").addClass("d-none");

            $("#d_tarea").addClass("d-block");
        });

        $("#t2").on("click", function() {
            $("#p_actividad").click();
            $("#d_actividad").removeClass("d-none");
        });

        $("#t1").on("click", function() {
            $("#d_actividad").addClass("d-none");
            $("#d_nota").addClass("d-none");
            $("#d_correo").addClass("d-none");
            $("#d_llamada").addClass("d-none");
            $("#d_tarea").addClass("d-none");
            // $("#d_reunion").addClass("d-none");
        });


    });

    function ModalDraggable(opcion) {
        switch (opcion) {
            case 'nota':
                $('#moda_nota').modal('show');
                $("#moda_nota .modal-header").css("cursor", "grab");
                $("#moda_nota").draggable({
                    handle: ".modal-header",
                    cursor: "move"
                });
                crearEditor(opcion);
                break;
            case 'correo':
                $('#moda_correo').modal('show');
                $("#moda_correo .modal-header").css("cursor", "grab");
                $("#moda_correo").draggable({
                    handle: ".modal-header",
                    cursor: "move"
                });
                crearEditor(opcion);
                break;
            case 'llamada':
                $('#moda_llamada').modal('show');
                $("#moda_llamada .modal-header").css("cursor", "grab");
                $("#moda_llamada").draggable({
                    handle: ".modal-header",
                    cursor: "move"
                });
                crearEditor(opcion);
                break;
            case 'tarea':
                $('#moda_tarea').modal('show');
                $("#moda_tarea .modal-header").css("cursor", "grab");
                $("#moda_tarea").draggable({
                    handle: ".modal-header",
                    cursor: "move"
                });
                crearEditor(opcion);
                break;
            case 'whatsapp':
                $('#moda_whatsapp').modal('show');
                $("#moda_whatsapp .modal-header").css("cursor", "grab");
                $("#moda_whatsapp").draggable({
                    handle: ".modal-header",
                    cursor: "move"
                });
                // crearEditor(opcion);
                break;
            default:
                break;
        }
    }

    var quill = null; // Inicializamos la variable del editor como nula
    var editorCreado = false; // Variable para rastrear si ya se creó el editor
    var editorNota = false;
    var editorCorreo = false;
    var editorLlamada = false;
    var editorTarea = false;
    // var editorReunion = false;

    function crearEditor(opcion) {
        switch (opcion) {
            case 'nota':

                if (!editorNota) {
                    quill = new Quill('#editor_' + opcion, {
                        theme: 'snow',
                        // otras opciones...
                    });

                    quill.on('selection-change', function(range, oldRange, source) {
                        if (range === null && oldRange === null && source === 'user') {
                            // Si la selección es nula y el cambio provino del usuario, asumimos que el editor está inactivo
                            console.log('El editor está inactivo.');
                        } else {
                            // En otros casos, asumimos que el editor está activo
                            console.log('El editor está activo.');
                        }
                    });
                    editorNota = true;
                } else {
                    console.log('Ya existe un editor activo.');
                }
                break;
            case 'correo':

                if (!editorCorreo) {
                    quill = new Quill('#editor_' + opcion, {
                        theme: 'snow',
                        // otras opciones...
                    });

                    quill.on('selection-change', function(range, oldRange, source) {
                        if (range === null && oldRange === null && source === 'user') {
                            // Si la selección es nula y el cambio provino del usuario, asumimos que el editor está inactivo
                            console.log('El editor está inactivo.');
                        } else {
                            // En otros casos, asumimos que el editor está activo
                            console.log('El editor está activo.');
                        }
                    });
                    editorCorreo = true;
                } else {
                    console.log('Ya existe un editor activo.');
                }
                break;
            case 'llamada':
                if (!editorLlamada) {
                    quill = new Quill('#editor_' + opcion, {
                        theme: 'snow',
                        // otras opciones...
                    });

                    quill.on('selection-change', function(range, oldRange, source) {
                        if (range === null && oldRange === null && source === 'user') {
                            // Si la selección es nula y el cambio provino del usuario, asumimos que el editor está inactivo
                            console.log('El editor está inactivo.');
                        } else {
                            // En otros casos, asumimos que el editor está activo
                            console.log('El editor está activo.');
                        }
                    });
                    editorLlamada = true;
                } else {
                    console.log('Ya existe un editor activo.');
                }
                break;
            case 'tarea':

                if (!editorTarea) {
                    quill = new Quill('#editor_' + opcion, {
                        theme: 'snow',
                        // otras opciones...
                    });

                    quill.on('selection-change', function(range, oldRange, source) {
                        if (range === null && oldRange === null && source === 'user') {
                            // Si la selección es nula y el cambio provino del usuario, asumimos que el editor está inactivo
                            console.log('El editor está inactivo.');
                        } else {
                            // En otros casos, asumimos que el editor está activo
                            console.log('El editor está activo.');
                        }
                    });
                    editorTarea = true;
                } else {
                    console.log('Ya existe un editor activo.');
                }
                break;
                // case 'reunion':
                // 	if (!editorReunion) {
                // 		quill = new Quill('#editor_' + opcion, {
                // 			theme: 'snow',
                // 			// otras opciones...
                // 		});

                // 		quill.on('selection-change', function(range, oldRange, source) {
                // 			if (range === null && oldRange === null && source === 'user') {
                // 				// Si la selección es nula y el cambio provino del usuario, asumimos que el editor está inactivo
                // 				console.log('El editor está inactivo.');
                // 			} else {
                // 				// En otros casos, asumimos que el editor está activo
                // 				console.log('El editor está activo.');
                // 			}
                // 		});
                // 		editorReunion = true;
                // 	} else {
                // 		console.log('Ya existe un editor activo.');
                // 	}
                // 	break;
        }
    }

    function comenzarAEscribir() {
        var texto = $(".ql-editor").text();
        if (texto === "Empieza a escribir para dejar una nota") {
            $(".ql-editor").empty();
        }
        console.log(texto);
    }

    function crearDIV(asesor, descripcion, opcion) {
        // Crear elementos HTML
        var contenedorNota = document.getElementById('contenedor-' + opcion);

        var titulo = document.createElement('h5');
        titulo.className = 'titulo_momento';
        titulo.textContent = 'Creado hace un momento';

        var nuevaNota = document.createElement('div');
        nuevaNota.className = 'col-sm-12 row bg-white card-body';

        var columnaNota = document.createElement('div');
        columnaNota.className = 'col-sm-12 mb-3';

        var parrafoAsesor = document.createElement('p');
        parrafoAsesor.textContent = 'Nota por ';
        var spanAsesor = document.createElement('span');
        spanAsesor.className = 'text-success fw-bold';
        spanAsesor.textContent = asesor;
        parrafoAsesor.appendChild(spanAsesor);

        var parrafoDescripcion = document.createElement('p');
        parrafoDescripcion.innerHTML = descripcion;

        // Agregar elementos al contenedor
        columnaNota.appendChild(titulo);
        columnaNota.appendChild(parrafoAsesor);
        columnaNota.appendChild(parrafoDescripcion);
        nuevaNota.appendChild(columnaNota);
        contenedorNota.appendChild(nuevaNota);
    }


    function GuardarModal(opcion) {
        switch (opcion) {
            case 'nota':
                var nota = document.getElementById('editor_' + opcion).children[0].innerHTML;
                var abc = '<?php echo $_POST['opcion']; ?>';
                var token = '<?php echo $token; ?>';
                break;
            case 'correo':
                var nota = document.getElementById('editor_' + opcion).children[0].innerHTML;
                var abc = '<?php echo $_POST['opcion']; ?>';
                var token = '<?php echo $token; ?>';
                var correo_usuario = document.getElementById('correo_usuario').value;
                var pass_correo_usuario = document.getElementById('pass_correo_usuario').value;
                var asunto = document.getElementById('asunto').value;
                break;
            case 'llamada':
                var nota = document.getElementById('editor_' + opcion).children[0].innerHTML;
                var abc = '<?php echo $_POST['opcion']; ?>';
                var token = '<?php echo $token; ?>';
                var resultado_llamada = document.getElementById('resultado_llamada').value;
                var direccion_llamada = document.getElementById('direccion_llamada').value;
                var fecha_registro_llamada = document.getElementById('fecha_registro_llamada').value;
                var hora_registro_llamada = document.getElementById('hora_registro_llamada').value;
                var id_asesor_llamada = document.getElementById('id_asesor_llamada').value;
                break;
            case 'tarea':
                var nota = document.getElementById('editor_' + opcion).children[0].innerHTML;
                var abc = '<?php echo $_POST['opcion']; ?>';
                var token = '<?php echo $token; ?>';
                var titulo_tarea = document.getElementById('titulo_tarea').value;
                var fecha_vencimiento = document.getElementById('fecha_vencimiento').value;
                var hora_vencimiento = document.getElementById('hora_vencimiento').value;
                var tipo_notificacion = document.getElementById('tipo_notificacion').value;
                var tipo_tarea = document.getElementById('tipo_tarea').value;
                var prioridad = document.getElementById('prioridad').value;
                var id_usuario_asignado = document.getElementById('id_usuario_asignado').value;
                break;
            default:
                break;
        }
        $.ajax({
            type: 'post',
            url: 'modulos/<?php echo $_POST['modulo']; ?>/guardar',
            cache: false,
            data: {
                nota: nota,
                correo_usuario: correo_usuario,
                pass_correo_usuario: pass_correo_usuario,
                resultado_llamada: resultado_llamada,
                direccion_llamada: direccion_llamada,
                fecha_registro_llamada: fecha_registro_llamada,
                hora_registro_llamada: hora_registro_llamada,
                id_asesor_llamada: id_asesor_llamada,
                titulo_tarea: titulo_tarea,
                fecha_vencimiento: fecha_vencimiento,
                hora_vencimiento: hora_vencimiento,
                tipo_notificacion: tipo_notificacion,
                tipo_tarea: tipo_tarea,
                prioridad: prioridad,
                id_usuario_asignado: id_usuario_asignado,
                asunto: asunto,
                accion: abc,
                opcion_modal: opcion,
                token: token
            },
            success: function(response) {
                switch (response) {
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
                        switch (opcion) {
                            case 'nota':
                                crearDIV('<?php echo $_SESSION['nombre'] . ' ' . $_SESSION['paterno'] . ' ' . $_SESSION['materno'] ?>', nota, opcion);
                                $('#moda_' + opcion).modal('hide');
                                break;
                            case 'correo':
                                crearDIV('<?php echo $_SESSION['nombre'] . ' ' . $_SESSION['paterno'] . ' ' . $_SESSION['materno'] ?>', nota, opcion);
                                $('#moda_' + opcion).modal('hide');
                                break;
                            case 'llamada':
                                crearDIV('<?php echo $_SESSION['nombre'] . ' ' . $_SESSION['paterno'] . ' ' . $_SESSION['materno'] ?>', nota, opcion);
                                $('#moda_' + opcion).modal('hide');
                                break;
                            case 'tarea':
                                crearDIV('<?php echo $_SESSION['nombre'] . ' ' . $_SESSION['paterno'] . ' ' . $_SESSION['materno'] ?>', nota, opcion);
                                $('#moda_' + opcion).modal('hide');
                                break;
                            default:
                                break;
                        }
                        break;
                    }
                    case "2": {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'El registro se actualizó correctamente.',
                        });
                        break;
                    }
                    case "3": {
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
            }
        })
    }
</script> -->
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