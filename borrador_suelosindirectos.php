<!--INICIO Modal para Editar -->
<!-- Modal para editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #17A2B8;">
        <h5 class="modal-title">EDITAR 3C5 SUELOS INDIRECTOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="formularioEditar" method="POST" action="modelos2/update_fprp_medicion.php">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" href="#sistemaTab" data-toggle="tab">Sistema</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#datosTab" data-toggle="tab">Datos</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="sistemaTab">
           
                        <div class="col-md-6">
                        <label for="id_suelos_indirectos_b" class="form-label">Id Suelos Indirectos Medicion</label>
                                <input type="text" class="form-control" id="id_suelos_indirectos_b" name="id_suelos_indirectos_b" readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="id_ficha" class="form-label">Ficha</label>
                            <select class="form-control" id="id_ficha_edit" name="id_ficha" required>
        <?php
        // Conexión a la base de datos
        include '../php/conexion_be.php';

        // Consulta SQL para obtener los valores disponibles de ID y Nombre de Departamento
        $sql = "SELECT id_ficha, id_ficha FROM tbl_fichas";

        // Ejecutar la consulta
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Genera opciones con el nombre del departamento como etiqueta y el ID como valor
                echo '<option value="' . $row["id_ficha"] . '">' . $row["id_ficha"] . '</option>';
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
                            <label for="id_categoria_ficha" class="form-label">Categoria de Ficha</label>
                            <select class="form-control" id="id_categoria_ficha_edit" name="id_categoria_ficha" required>
        <?php
        // Conexión a la base de datos
        include '../php/conexion_be.php';

        // Consulta SQL para obtener los valores disponibles de ID y Nombre de Departamento
        $sql = "SELECT id_categoria_ficha, categoria_ficha FROM tbl_categorias_fichas";

        // Ejecutar la consulta
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Genera opciones con el nombre del departamento como etiqueta y el ID como valor
                echo '<option value="' . $row["id_categoria_ficha"] . '">' . $row["categoria_ficha"] . '</option>';
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
                            <label for="id_sector" class="form-label">Sector</label>
                            <select class="form-control" id="id_sector_edit" name="id_sector" required>
        <?php
        // Conexión a la base de datos
        include '../php/conexion_be.php';

        // Consulta SQL para obtener los valores disponibles de ID y Nombre de sector
        $sql = "SELECT id_sector, sector FROM tbl_sector";

        // Ejecutar la consulta
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Genera opciones con el nombre del departamento como etiqueta y el ID como valor
                echo '<option value="' . $row["id_sector"] . '">' . $row["sector"] . '</option>';
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
                            <label for="id_suelos_indirectos" class="form-label">Tipo de Suelos Indirectos</label>
                            <select class="form-control" id="id_suelos_indirectos_edit" name="id_suelos_indirectos" required>
        <?php
        // Conexión a la base de datos
        include '../php/conexion_be.php';

        // Consulta SQL para obtener los valores disponibles de ID y Nombre de sector
        $sql = "SELECT id_suelos_indirectos, nombre_suelo FROM tbl_suelos_indirectos";

        // Ejecutar la consulta
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Genera opciones con el nombre del departamento como etiqueta y el ID como valor
                echo '<option value="' . $row["id_suelos_indirectos"] . '">' . $row["nombre_suelo"] . '</option>';
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
                            <label for="id_criterios_medicion" class="form-label">Criterios de Medicion</label>
                            <select class="form-control" id="id_criterios_medicion_edit" name="id_criterios_medicion" required>
        <?php
        // Conexión a la base de datos
        include '../php/conexion_be.php';

        // Consulta SQL para obtener los valores disponibles de ID y Nombre de sector
        $sql = "SELECT id_criterios_medicion, criterio_medicion FROM tbl_criterio_medicion";

        // Ejecutar la consulta
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Genera opciones con el nombre del departamento como etiqueta y el ID como valor
                echo '<option value="' . $row["id_criterios_medicion"] . '">' . $row["criterio_medicion"] . '</option>';
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
                        <label for="descripcion" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" id="descripcion_edit" name="descripcion" required>
                        </div>

                        <div class="col-md-6">
                        <label for="codigo_categoria" class="form-label">Codigo Categoria</label>
                                <input type="text" class="form-control" id="codigo_categoria_edit" name="codigo_categoria" required>
                        </div>

                        <div class="col-md-6">
                        <label for="categoria_medicion" class="form-label">Categoria Medicion</label>
                                <input type="text" class="form-control" id="categoria_medicion_edit" name="categoria_medicion" required>
                        </div>

                        <div class="col-md-6">
                            <label for="hoja" class="form-label">Hoja</label>
                            <input type="text" class="form-control" id="hoja_edit" name="hoja">
                        </div>

                        <div class="col-md-6">
                            <label for="referencia" class="form-label">Referencia</label>
                            <input type="text" class="form-control" id="referencia_edit" name="referencia">
                        </div>

                        <div class="col-md-6">
                            <label for="anio" class="form-label">Año</label>
                            <input type="text" class="form-control" id="anio_edit" name="anio">
                        </div>

          </div>
          <div class="tab-pane fade" id="datosTab">
                 
                        <div class="col-md-6">
                        <label for="cantidad_anual_n">Cantidad Anual de Fertilizante Sintetico:</label>
                          <input type="text" class="form-control" id="cantidad_anual_n_edit" name="cantidad_anual_n" required>
                        </div>

                        <div class="col-md-6">
                        <label for="fraccion_n" class="form-label">Fraccion de N Fertilizantes Sinteticos</label>
                                <input type="text" class="form-control" id="fraccion_n_edit" name="fraccion_n" required>
                        </div>

                        <div class="col-md-6">
                        <label for="factor_emision" class="form-label">Cantidad Anual de Estiercol animal Gestionado</label>
                                <input type="text" class="form-control" id="tasa_excrecion_edit" name="tasa_excrecion" required>
                        </div>

                        <div class="col-md-6">
                        <label for="cantidad_animal" class="form-label">Cantidad Animal</label>
                                <input type="text" class="form-control" id="cantidad_animal_edit" name="cantidad_animal" required>
                        </div>

                        <div class="col-md-6">
                        <label for="cantidad_orina" class="form-label">Cantidad Orina</label>
                        <input type="text" class="form-control" id="cantidad_orina_edit" name="cantidad_orina" required>
                        </div>

                        <div class="col-md-6">
                        <label for="fraccion_materiales" class="form-label">Fraccion Materiales</label>
                                <input type="text" class="form-control" id="fraccion_materiales_edit" name="fraccion_materiales" required>
                        </div>

                        <div class="col-md-6">
                        <label for="cantidad_deposicion" class="form-label">Cantidad Deposicion</label>
                                <input type="text" class="form-control" id="cantidad_deposicion_edit" name="cantidad_deposicion" required>
                        </div>

                        <div class="col-md-6">
                        <label for="cantidad_residuos" class="form-label">Cantidad de Residuos</label>
                                <input type="text" class="form-control" id="cantidad_residuos_edit" name="cantidad_residuos" required>
                        </div>

                        <div class="col-md-6">
                        <label for="cantidad_mineralizado" class="form-label">Cantidad Mineralizado</label>
                                <input type="text" class="form-control" id="cantidad_mineralizado_edit" name="cantidad_mineralizado" required>
                        </div>

                        <div class="col-md-6">
                        <label for="fraccion_mineralizado" class="form-label">Fraccion Mineralizado</label>
                                <input type="text" class="form-control" id="fraccion_mineralizado_edit" name="fraccion_mineralizado" required>
                        </div>

                        <div class="col-md-6">
                        <label for="fraccion_lixiviacion" class="form-label">Fraccion Lixiviacion</label>
                                <input type="text" class="form-control" id="fraccion_lixiviacion_edit" name="fraccion_lixiviacion" required>
                        </div>

                        <div class="col-md-6">
                        <label for="cantidad_lixiviacion" class="form-label">Cantidad Lixiviacion</label>
                                <input type="text" class="form-control" id="cantidad_lixiviacion_edit" name="cantidad_lixiviacion" required>
                        </div>

                      
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado_edit" name="estado" required>
                            <option value="" disabled selected>Selecciona un estado</option>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                        </div>
                    </div>

                   
          </div>
      
        </div>
        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="actualizarBtn">Actualizar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>