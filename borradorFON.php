<div class="table-responsive">

<table class="table table-hover">
    <thead class="table-dark text-center" style="background-color: #343A40;">
        <tr>   
        <th scope="col">Id Fon</th>
        <th scope="col">Id Ficha</th>
        <th scope="col">Categoria Ficha</th>
        <th scope="col">Nivel Medicion</th>
        <th scope="col">Sector</th>
        <th scope="col">Año</th>
        <th scope="col">Gestion Estiercol MMS</th>
        <th scope="col">Categoria Especie</th>
        <th scope="col">Especie</th>
        <th scope="col">Criterios Medicion</th>
        <th scope="col">Numero Ficha</th>
        <th scope="col">Categoria Medicion</th>
        <th scope="col">Cantidad de Cabezas de la Especie </th>
        <th scope="col">Promedio b</th>
        <th scope="col">Promedio c</th>
        <th scope="col">Cantidad de nitrógeno del estiércol gestionado para la categoría de ganado T que se pierde en el sistema de gestión del estiércol S,</th>
        <th scope="col">Cantidad de nitrógeno del estiércol gestionado para la categoría de ganado T que se pierde en el sistema de gestión del estiércol S,</th>
        <th scope="col">Cantidad de nitrógeno de las camas (a aplicar para almacenamiento de sólidos y MMS de cama profunda si se utiliza una cama orgánica conocida)</th>
        <th scope="col">Cantidad anual de de estiércol animal, compost, lodos cloacales y otros aportes de N aplicada a los suelos</th>
        <th scope="col">Estado</th>
            <th scope="col">Acciones</th> <!-- Added text-center class here -->
        </tr>
    </thead>
    <tbody class="text-center">
        <?php
        include "../php/conexion_be.php";
        $sql = $conexion->query("SELECT tbl_fon.id_fon, tbl_fichas.id_ficha, tbl_categorias_fichas.categoria_ficha, tbl_fon.nivel_medicion, tbl_sector.sector, tbl_fon.anio, tbl_gestion_mms_estiercol.gestion_estiercol, tbl_categorias_especies.categoria_especie, tbl_especie.especie, tbl_criterio_medicion.criterio_medicion, tbl_fon.numero_ficha, tbl_fon.categoria_medicion, tbl_fon.cantidad_especie, tbl_fon.promedio_b, tbl_fon.fraccion_c, tbl_fon.cantidad_nitrogeno_d, tbl_fon.cantidad_nitrogeno_e, tbl_fon.cantidad_nitrogeno_f, tbl_fon.cantidad_g, tbl_fon.estado
        FROM tbl_fon
        INNER JOIN tbl_fichas ON tbl_fon.id_ficha = tbl_fichas.id_ficha
        INNER JOIN tbl_categorias_fichas ON tbl_fon.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha
        INNER JOIN tbl_sector ON tbl_fon.id_sector = tbl_sector.id_sector
        INNER JOIN tbl_categorias_especies ON tbl_fon.id_categoria_especie = tbl_categorias_especies.id_categoria_especie
        INNER JOIN tbl_especie ON tbl_fon.id_especie = tbl_especie.id_especie
        INNER JOIN tbl_gestion_mms_estiercol ON tbl_fon.id_gestion_estiercol_mms = tbl_gestion_mms_estiercol.id_gestion_estiercol_mms
        INNER JOIN tbl_criterio_medicion ON tbl_fon.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion");
        while ($datos = $sql->fetch_object()) { ?>
            <tr>
                <td><?= $datos->id_fon?></td>
                <td><?= $datos->id_ficha?></td>
                <td><?= $datos->categoria_ficha?></td>
                <td><?= $datos->nivel_medicion?></td>
                <td><?= $datos->sector?></td>
                <td><?= $datos->anio?></td>
                <td><?= $datos->gestion_estiercol?></td>
                <td><?= $datos->categoria_especie?></td>
                <td><?= $datos->especie?></td>
                <td><?= $datos->criterio_medicion?></td>
                <td><?= $datos->numero_ficha?></td>
                <td><?= $datos->categoria_medicion ?></td>
                <td><?= $datos->cantidad_especie ?></td>
                <td><?= $datos->promedio_b ?></td>
                <td><?= $datos->fraccion_c ?></td>
                <td><?= $datos->cantidad_nitrogeno_d ?></td>
                <td><?= $datos->cantidad_nitrogeno_e ?></td>
                <td><?= $datos->cantidad_nitrogeno_f ?></td>
                <td><?= $datos->cantidad_g ?></td>
                <td><?php
                    if ($datos->estado == "ACTIVO") {
                        echo '<span class="badge bg-success">Activo</span>';
                    } else {
                        echo '<span class="badge bg-danger">Inactivo</span>';
                    }
                    ?></td>
                <td>
                    <button type="button" class="btn btn-editar" data-toggle="modal" data-target="#modalEditar" onclick="abrirModalEditar
                    ('<?= $datos->id_fon ?>', '<?= $datos->id_ficha ?>', '<?= $datos->categoria_ficha ?>', '<?= $datos->nivel_medicion ?>', 
                    '<?= $datos->sector ?>', '<?= $datos->anio ?>', '<?= $datos->gestion_estiercol ?>', '<?= $datos->categoria_especie ?>',
                    '<?= $datos->especie ?>', '<?= $datos->criterio_medicion ?>', '<?= $datos->numero_ficha ?>', '<?= $datos->categoria_medicion ?>',
                    '<?= $datos->cantidad_especie ?>', '<?= $datos->promedio_b ?>', '<?= $datos->fraccion_c ?>',
                    '<?= $datos->cantidad_nitrogeno_d ?>', '<?= $datos->cantidad_nitrogeno_e ?>', '<?= $datos->cantidad_nitrogeno_f ?>', '<?= $datos->cantidad_g ?>', '<?= $datos->estado ?>' )">
                        <i class="bi bi-pencil-square"></i>
                        Editar
                    </button>
                    <form id="deleteForm" method="POST" action="modelos2/delete_cultivos_medicion.php" style="display: inline;">
                        <input type="hidden" name="id_fon" value="<?= $datos->id_fon ?>">
                        <button type="submit" class="btn btn-eliminar">
                            <i class="bi bi-trash"></i>
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        <?php }
        ?>
    </tbody>
</table>
</div>







<!-- JavaScript para manejar la edición de usuarios -->
<script>
    // Función para abrir el modal de edición
    function abrirModalEditar(id_fon, id_ficha, id_categoria_ficha, nivel_medicion, id_sector, anio, id_gestion_estiercol_mms, id_categoria_especie, id_especie,
    id_criterios_medicion, numero_ficha, categoria_medicion, cantidad_especie, promedio_b, fraccion_c, cantidad_nitrogeno_d, cantidad_nitrogeno_e, 
    cantidad_nitrogeno_f, estado) {
    document.getElementById("id_fon").value = id_fon;
    document.getElementById("id_ficha_edit").value = id_ficha;
    document.getElementById("id_categoria_ficha_edit").value = id_categoria_ficha;
    document.getElementById("nivel_medicion_edit").value = nivel_medicion;
    document.getElementById("id_sector_edit").value = id_sector;
    document.getElementById("anio_edit").value = anio;
    document.getElementById("id_gestion_estiercol_mms_edit").value = id_gestion_estiercol_mms;
    document.getElementById("id_categoria_especie_edit").value = id_categoria_especie;
    document.getElementById("id_especie_edit").value = id_especie;
    document.getElementById("id_criterios_medicion_edit").value = id_criterios_medicion;
    document.getElementById("numero_ficha_edit").value = numero_ficha;
    document.getElementById("categoria_medicion_edit").value = categoria_medicion;
    document.getElementById("cantidad_especie_edit").value = cantidad_especie;
    document.getElementById("promedio_b_edit").value = promedio_b;
    document.getElementById("fraccion_c_edit").value = fraccion_c;
    document.getElementById("cantidad_nitrogeno_d_edit").value = cantidad_nitrogeno_d;
    document.getElementById("cantidad_nitrogeno_e_edit").value = cantidad_nitrogeno_e;
    document.getElementById("cantidad_nitrogeno_f_edit").value = cantidad_nitrogeno_f;
    document.getElementById("estado_edit").value = estado;



        $('#modalEditar').modal('show'); // Mostrar el modal de edición
    }
</script>







<!-- Modal para crear -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #17A2B8; color: white;">
        <h5 class="modal-title">AGREGAR FON MEDICION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="modelos3/insert_FONMedicion.php" method="POST">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" href="#fichaTab" data-toggle="tab">Ficha</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#especieTab" data-toggle="tab">Especie</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#medicionTab" data-toggle="tab">Medicion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#emisionTab" data-toggle="tab">Emision</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="fichaTab">
          <div class="col-md-6">
                            <label for="anio">Año</label>
                            <input type="text" class="form-control" id="anio" name="anio" required>
                        </div>
                        <div class="col-md-6">
                                <label for="id_ficha">Ficha:</label>
                                <select class="form-control" id="id_ficha" name="id_ficha" required>
                                    <?php
                                    // Conexión a la base de datos
                                    include '../php/conexion_be.php';

                                    // Consulta SQL para obtener los valores disponibles de id_sector desde tbl_sector
                                    $sql = "SELECT id_ficha, id_ficha FROM tbl_fichas";

                                    // Ejecutar la consulta
                                    $result = mysqli_query($conexion, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    // Genera opciones para cada valor de id_sector
                                    echo '<option value="' . $row["id_ficha"] . '">' . $row["id_ficha"] . '</option>';
                                    }
                                    } else {
                                    echo '<option value="">No hay fichas disponibles</option>';
                                    }

                                    // Cierra la conexión a la base de datos
                                    mysqli_close($conexion);
                                    ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                                <label for="id_categoria_ficha">Categoria de Ficha:</label>
                                <select class="form-control" id="id_categoria_ficha" name="id_categoria_ficha" required>
                                    <?php
                                    // Conexión a la base de datos
                                    include '../php/conexion_be.php';

                                    $sql = "SELECT id_categoria_ficha, categoria_ficha FROM tbl_categorias_fichas";

                                    // Ejecutar la consulta
                                    $result = mysqli_query($conexion, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    // Genera opciones para cada valor 
                                    echo '<option value="' . $row["id_categoria_ficha"] . '">' . $row["categoria_ficha"] . '</option>';
                                    }
                                    } else {
                                    echo '<option value="">No hay registros disponibles</option>';
                                    }

                                    // Cierra la conexión a la base de datos
                                    mysqli_close($conexion);
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="numero_ficha">Numero de Ficha</label>
                                <input type="text" class="form-control" id="numero_ficha" name="numero_ficha" required>
                            </div>
                            <div class="col-md-6">
                                <label for="id_sector">Sector:</label>
                                <select class="form-control" id="id_sector" name="id_sector" required>
                                    <?php
                                    // Conexión a la base de datos
                                    include '../php/conexion_be.php';

                                    // Consulta SQL para obtener los valores disponibles de id_sector desde tbl_sector
                                    $sql = "SELECT id_sector, sector FROM tbl_sector";

                                    // Ejecutar la consulta
                                    $result = mysqli_query($conexion, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    // Genera opciones para cada valor de id_sector
                                    echo '<option value="' . $row["id_sector"] . '">' . $row["sector"] . '</option>';
                                    }
                                    } else {
                                    echo '<option value="">No hay sectores disponibles</option>';
                                    }

                                    // Cierra la conexión a la base de datos
                                    mysqli_close($conexion);
                                    ?>
                                </select>
                            </div>
          </div>
          <div class="tab-pane fade" id="especieTab">
          <div class="col-md-6">
                                <label for="id_categoria_especie">Categoria Especie</label>
                                <select class="form-control" id="id_categoria_especie" name="id_categoria_especie" required>
                                <?php
                                // Conexión a la base de datos
                                include '../php/conexion_be.php';

                                // Consulta SQL para obtener los valores disponibles de id_sector desde tbl_sector
                                $sql = "SELECT id_categoria_especie, categoria_especie FROM tbl_categorias_especies";

                                // Ejecutar la consulta
                                $result = mysqli_query($conexion, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                // Genera opciones para cada valor de id_sector
                                echo '<option value="' . $row["id_categoria_especie"] . '">' . $row["categoria_especie"] . '</option>';
                                }
                                } else {
                                echo '<option value="">No hay Criterios disponibles</option>';
                                }

                                // Cierra la conexión a la base de datos
                                mysqli_close($conexion);
                                ?>
                            </select>
                         </div>
                         <div class="col-md-6">
                                <label for="id_especie">Especie</label>
                                <select class="form-control" id="id_especie" name="id_especie" required>
                                <?php
                                // Conexión a la base de datos
                                include '../php/conexion_be.php';

                                // Consulta SQL para obtener los valores disponibles de id_sector desde tbl_sector
                                $sql = "SELECT id_especie, especie FROM tbl_especie";

                                // Ejecutar la consulta
                                $result = mysqli_query($conexion, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                // Genera opciones para cada valor de id_sector
                                echo '<option value="' . $row["id_especie"] . '">' . $row["especie"] . '</option>';
                                }
                                } else {
                                echo '<option value="">No hay Criterios disponibles</option>';
                                }

                                // Cierra la conexión a la base de datos
                                mysqli_close($conexion);
                                ?>
                            </select>
                         </div>
                         <div class="col-md-6">
                                <label for="cantidad_especie" class="form-label">Cantidad Especie</label>
                                <input type="text" class="form-control" id="cantidad_especie" name="cantidad_especie" required>
                            </div>
          </div>
          <div class="tab-pane fade" id="medicionTab">
                <div class="col-md-6">
                    <label for="id_gestion_estiercol_mms">Gestion Estiercol MMS</label>
                                <select class="form-control" id="id_gestion_estiercol_mms" name="id_gestion_estiercol_mms" required>
                                <?php
                                // Conexión a la base de datos
                                include '../php/conexion_be.php';

                                // Consulta SQL para obtener los valores disponibles de ID y Nombre del sistema
                                $sql = "SELECT id_gestion_estiercol_mms, gestion_estiercol FROM tbl_gestion_mms_estiercol";

                                // Ejecutar la consulta
                                $result = mysqli_query($conexion, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // Genera opciones con el nombre del sistema como etiqueta y el ID como valor
                                        echo '<option value="' . $row["id_gestion_estiercol_mms"] . '">' . $row["gestion_estiercol"] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No hay campos disponibles</option>';
                                }

                                // Cierra la conexión a la base de datos
                                mysqli_close($conexion);
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                                <label for="categoria_medicion" class="form-label">Categoria Medicion</label>
                                <input type="text" class="form-control" id="categoria_medicion" name="categoria_medicion" required>
                            </div>
                            <div class="col-md-6">
                                <label for="id_criterios_medicion" class="form-label">Criterio Medicion</label>
                                <select class="form-control" id="id_criterios_medicion" name="id_criterios_medicion" required>
                                <?php
                                // Conexión a la base de datos
                                include '../php/conexion_be.php';

                                // Consulta SQL para obtener los valores disponibles de id_sector desde tbl_sector
                                $sql = "SELECT id_criterios_medicion, criterio_medicion FROM tbl_criterio_medicion";

                                // Ejecutar la consulta
                                $result = mysqli_query($conexion, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                // Genera opciones para cada valor de id_sector
                                echo '<option value="' . $row["id_criterios_medicion"] . '">' . $row["criterio_medicion"] . '</option>';
                                }
                                } else {
                                echo '<option value="">No hay Criterios disponibles</option>';
                                }

                                // Cierra la conexión a la base de datos
                                mysqli_close($conexion);
                                ?>
                            </select>
                            </div>
                            <div class="col-md-6">
                                <label for="nivel_medicion" class="form-label">Nivel Medicion</label>
                                <input type="text" class="form-control" id="nivel_medicion" name="nivel_medicion" required>
                            </div>
          </div>
          <div class="tab-pane fade" id="emisionTab">
                    <div class="col-md-6">
                                <label for="promedio_b" class="form-label">Promedio B</label>
                                <input type="text" class="form-control" id="promedio_b" name="promedio_b" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fraccion_c" class="form-label">Fraccion C</label>
                                <input type="text" class="form-control" id="fraccion_c" name="fraccion_c" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cantidad_nitrogeno_d" class="form-label">Cantidad Nitrogeno D</label>
                                <input type="text" class="form-control" id="cantidad_nitrogeno_d" name="cantidad_nitrogeno_d" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cantidad_nitrogeno_e" class="form-label">Cantidad Nitrogeno E</label>
                                <input type="text" class="form-control" id="cantidad_nitrogeno_e" name="cantidad_nitrogeno_e" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cantidad_nitrogeno_f" class="form-label">Cantidad Nitrogeno F</label>
                                <input type="text" class="form-control" id="cantidad_nitrogeno_f" name="cantidad_nitrogeno_f" required>
                            </div>
                            <div class="col-md-6">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado_edit" name="estado" required>
                            <option value="" disabled selected>Selecciona un estado</option>
                                <option value="ACTIVO">Activo</option>
                                <option value="INACTIVO">Inactivo</option>
                            </select>
                        </div> 
          </div>
        <div class="mt-3">
          <button type="submit" class="btn btn-outline-info" name="btnnuevo" value="ok">Crear</button>
          <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
          </form>
        </div>
      </div>
    </div>
  </div>


<!--Fin Modal Crear -->