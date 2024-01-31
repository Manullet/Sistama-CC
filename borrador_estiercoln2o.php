<!--INICIO Modal para Editar -->
<!-- Modal para editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #17A2B8;">
        <h5 class="modal-title">EDITAR 3A2 ESTIERCOL N2O</h5>
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
                        <label for="id_estiercol" class="form-label">Id Estiercol</label>
                                <input type="text" class="form-control" id="id_estiercol" name="id_estiercol" readonly>
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
                        <label for="nivel_medicion" class="form-label">Nivel Medicion</label>
                                <input type="text" class="form-control" id="nivel_medicion_edit" name="nivel_medicion" required>
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
                        <label for="anio" class="form-label">Año</label>
                                <input type="text" class="form-control" id="anio_edit" name="anio" required>
                        </div>

                        <div class="col-md-6">
                        <label for="numero_ficha" class="form-label">Numero Ficha</label>
                                <input type="text" class="form-control" id="numero_ficha_edit" name="numero_ficha" required>
                        </div>



                        <div class="col-md-6">
                            <label for="id_categoria_especie" class="form-label">Categoria Especie</label>
                            <select class="form-control" id="id_categoria_especie_edit" name="id_categoria_especie" required>
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
                            <label for="id_especie" class="form-label">Especie</label>
                            <select class="form-control" id="id_especie_edit" name="id_especie" required>
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
                            <label for="categoria_medicion" class="form-label">Categoria Medicion</label>
                            <input type="text" class="form-control" id="categoria_medicion_edit" name="categoria_medicion">
                        </div>

          </div>
          <div class="tab-pane fade" id="datosTab">
                 
                        <div class="col-md-6">
                            <label for="id_criterios_medicion" class="form-label">Criterio Medicion</label>
                            <select class="form-control" id="id_criterios_medicion_edit" name="id_criterios_medicion" required>
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
                        <label for="cantidad_especie">Cantidad Especie:</label>
                          <input type="text" class="form-control" id="cantidad_especie_edit" name="cantidad_especie" required>
                        </div>

                        <div class="col-md-6">
                        <label for="sigla" class="form-label">Sigla</label>
                                <input type="text" class="form-control" id="sigla_edit" name="sigla" required>
                        </div>

                        <div class="col-md-6">
                        <label for="tasa_excrecion" class="form-label">Tasa Excrecion</label>
                                <input type="text" class="form-control" id="tasa_excrecion_edit" name="tasa_excrecion" required>
                        </div>

                        <div class="col-md-6">
                        <label for="masa_animal" class="form-label">Masa Animal</label>
                                <input type="text" class="form-control" id="masa_animal_edit" name="masa_animal" required>
                        </div>

                        <div class="col-md-6">
                        <label for="fraccion_excrecion" class="form-label">Fraccion Excrecion</label>
                        <input type="text" class="form-control" id="fraccion_excrecion_edit" name="fraccion_excrecion" required>
                        </div>

                        <div class="col-md-6">
                        <label for="factor_emisiones_directas" class="form-label">Factor Emisiones Directas</label>
                                <input type="text" class="form-control" id="factor_emisiones_directas_edit" name="factor_emisiones_directas" required>
                        </div>

                        <div class="col-md-6">
                        <label for="fraccion_excrecion_anual" class="form-label">Fraccion Excrecion Anual</label>
                                <input type="text" class="form-control" id="fraccion_excrecion_anual_edit" name="fraccion_excrecion_anual" required>
                        </div>

                        <div class="col-md-6">
                            <label for="id_gestion_estiercol_mms" class="form-label">Gestion Estiercol MMS</label>
                            <select class="form-control" id="id_gestion_estiercol_mms_edit" name="id_gestion_estiercol_mms" required>
                                <?php
                                // Conexión a la base de datos
                                include '../php/conexion_be.php';

                                // Consulta SQL para obtener los valores disponibles de id_sector desde tbl_sector
                                $sql = "SELECT id_gestion_estiercol_mms, gestion_estiercol FROM tbl_gestion_estiercol_mms";

                                // Ejecutar la consulta
                                $result = mysqli_query($conexion, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                // Genera opciones para cada valor de id_sector
                                echo '<option value="' . $row["id_gestion_estiercol_mms"] . '">' . $row["gestion_estiercol"] . '</option>';
                                }
                                } else {
                                echo '<option value="">No hay Criterios disponibles</option>';
                                }

                                // Cierra la conexión a la base de datos
                                mysqli_close($conexion);
                                ?>
                            </select>
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