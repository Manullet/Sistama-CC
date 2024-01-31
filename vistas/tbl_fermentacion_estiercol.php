<?php 
session_start();
 $_SESSION['url'] = 'vistas/tbl_fermentacion_estiercol.php';
 $_SESSION['content-wrapper'] = 'content-wrapper';
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/estilos.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



<div class="containertable">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="poppins-font mb-2">Fermentación Estiércol</h1>
            <br>
            <a href="#" data-bs-toggle="modal" data-bs-target="#modalForm" class="btn btn-info">
                <i class="nav-icon bi bi-people-fill"></i> Crear
            </a>
        </div>

        <div class="mb-4 border-bottom">
            <form class="d-flex" role="search">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                    <input class="form-control" id="searchInput" type="search" placeholder="Buscar ..." aria-label="Search">
                </div>
            </form>
        </div>
    </div>

     <!--  descargar excel -->
     <div class="center-vertical">
            </div>
            <!--  fin de descargar -->

             <!-- descargar PDF-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

            <script>
                document.getElementById("pdfButton").addEventListener("click", function() {
                    // Código para generar el PDF usando jsPDF
                    const pdf = new jsPDF();
                    pdf.text("Contenido del PDF", 10, 10);
                    pdf.save("documento.pdf");
                });
            </script>
             <!--  fin de descargar PDF-->

                 <!-- descargar EXCEL -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.8/xlsx.full.min.js"></script>

                <script>
                    document.getElementById("excelButton").addEventListener("click", function() {
                        // Código para generar el archivo Excel usando SheetJS
                        const data = [
                            ["Nombre", "Edad"],
                            ["Juan", 30],
                            ["María", 25],
                            ["Pedro", 28]
                        ];
                        const ws = XLSX.utils.aoa_to_sheet(data);
                        const wb = XLSX.utils.book_new();
                        XLSX.utils.book_append_sheet(wb, ws, "Hoja1");
                        XLSX.writeFile(wb, "datos.xlsx");
                    });
                </script>

                  <!-- Fin descargar EXCEL-->



    <div class="table-responsive">

        <table class="table table-hover">
            <thead class="table-dark text-center" style="background-color: #343A40;">
                <tr>
                    <th scope="col">Id Fermentación</th>
                    <th scope="col">Id Ficha</th>
                    <th scope="col">Id Categoria Ficha</th>
                    <th scope="col">Nivel Medicion</th>
                    <th scope="col">Id Sector</th>
                    <th scope="col">Año</th>
                    <th scope="col">Número Ficha</th>
                    <th scope="col">Id Categoria Especie</th>
                    <th scope="col">Id Especie</th>
                    <th scope="col">Categoria Medición</th>
                    <th scope="col">Id Criterios Medición</th>
                    <th scope="col">Cantidad Especie</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Sigla</th>
                    <th scope="col">Creado Por</th>
                    <th scope="col">Fecha Creación</th>
                    <th scope="col">Actualizado Por</th>
                    <th scope="col">Fecha Actualización</th>
                    <th scope="col">Factor Emisión Fermentación</th>
                    <th scope="col">Factor Emisión Estiércol</th>
                    <th scope="col">Total Fermentación</th>
                    <th scope="col">Total Estiércol</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th> <!-- Added text-center class here -->
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                include "../php/conexion_be.php";
                $sql = $conexion->query("SELECT tbl_fermentacion_estiercol.id_fermentacion, tbl_fichas.descripcion, tbl_categorias_fichas.categoria_ficha, tbl_fermentacion_estiercol.nivel_medicion, tbl_sector.sector, tbl_fermentacion_estiercol.anio, tbl_fermentacion_estiercol.numero_ficha, tbl_categorias_especies.categoria_especie, tbl_especie.especie, tbl_fermentacion_estiercol.categoria_medicion, tbl_criterio_medicion.criterio_medicion, tbl_fermentacion_estiercol.cantidad_especie, tbl_fermentacion_estiercol.descripcion, tbl_fermentacion_estiercol.sigla, tbl_fermentacion_estiercol.creado_por, tbl_fermentacion_estiercol.fecha_creacion, tbl_fermentacion_estiercol.actualizado_por, tbl_fermentacion_estiercol.fecha_actualizacion, tbl_fermentacion_estiercol.factor_fermentacion, tbl_fermentacion_estiercol.factor_estiercol, tbl_fermentacion_estiercol.total_fermentacion, tbl_fermentacion_estiercol.total_estiercol  ,tbl_fermentacion_estiercol.estado
                 FROM tbl_fermentacion_estiercol INNER JOIN tbl_sector ON tbl_fermentacion_estiercol.id_sector = tbl_sector.id_sector INNER JOIN tbl_categorias_especies ON tbl_fermentacion_estiercol.id_categoria_especie = tbl_categorias_especies.id_categoria_especie  INNER JOIN tbl_especie ON tbl_fermentacion_estiercol.id_especie = tbl_especie.id_especie  INNER JOIN tbl_criterio_medicion ON tbl_fermentacion_estiercol.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion  INNER JOIN tbl_fichas ON tbl_fermentacion_estiercol.id_ficha = tbl_fichas.id_ficha  INNER JOIN tbl_categorias_fichas ON tbl_fermentacion_estiercol.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha");
                // Inicializar variables para los totales
                $totalFermentacion = 0;
                $totalEstiercol = 0;
                while ($datos = $sql->fetch_object()) { 
                    // Sumar los valores para los totales
                $totalFermentacion += $datos->total_fermentacion;
                $totalEstiercol += $datos->total_estiercol;
                ?>
                    <tr>
                        <td><?= $datos->id_fermentacion ?></td>
                        <td><?= $datos->descripcion ?></td>
                        <td><?= $datos->categoria_ficha ?></td>
                        <td><?= $datos->nivel_medicion ?></td>
                        <td><?= $datos->sector?></td>
                        <td><?= $datos->anio?></td>
                        <td><?= $datos->numero_ficha ?></td>
                        <td><?= $datos->categoria_especie?></td>
                        <td><?= $datos->especie ?></td>
                        <td><?= $datos->categoria_medicion?></td>
                        <td><?= $datos->criterio_medicion?></td>
                        <td><?= $datos->cantidad_especie?></td>
                        <td><?= $datos->descripcion?></td>
                        <td><?= $datos->sigla?></td>
                        <td><?= $datos->creado_por?></td>
                        <td><?= $datos->fecha_creacion?></td>
                        <td><?= $datos->actualizado_por?></td>
                        <td><?= $datos->fecha_actualizacion?></td>
                        <td><?= $datos->factor_fermentacion?></td>
                        <td><?= $datos->factor_estiercol?></td>
                        <td><?= $datos->total_fermentacion?></td>
                        <td><?= $datos->total_estiercol?></td>
                        <td><?php
                            if ($datos->estado == "ACTIVO") {
                                echo '<span class="badge bg-success">Activo</span>';
                            } else {
                                echo '<span class="badge bg-danger">Inactivo</span>';
                            }
                            ?></td>
                        <td>
                            <button type="button" class="btn btn-editar" data-toggle="modal" data-target="#modalEditar" onclick="abrirModalEditar
                            ('<?= $datos->id_fermentacion ?>', '<?= $datos->descripcion ?>', '<?= $datos->categoria_ficha ?>', '<?= $datos->nivel_medicion ?>', '<?= $datos->sector ?>', '<?= $datos->anio ?>', '<?= $datos->numero_ficha ?>', '<?= $datos->categoria_especie ?>', '<?= $datos->especie ?>', '<?= $datos->categoria_medicion ?>', '<?= $datos->criterio_medicion ?>', '<?= $datos->cantidad_especie ?>', '<?= $datos->descripcion ?>', '<?= $datos->sigla ?>', '<?= $datos->creado_por ?>', '<?= $datos->fecha_creacion ?>', '<?= $datos->actualizado_por ?>', '<?= $datos->fecha_actualizacion ?>', '<?= $datos->factor_fermentacion ?>', '<?= $datos->factor_estiercol ?>'  ,'<?= $datos->total_fermentacion ?>', '<?= $datos->total_estiercol ?>'  ,'<?= $datos->estado ?>' )">
                                <i class="bi bi-pencil-square"></i>
                                Editar
                            </button>
                            <form id="deleteForm" method="POST" action="modelos/delete_Fermentacion_Est.php" style="display: inline;">
                                <input type="hidden" name="id_fermentacion" value="<?= $datos->id_fermentacion ?>">
                                <button type="submit" class="btn btn-eliminar">
                                    <i class="bi bi-trash"></i>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php }
                ?>
                <!-- Fila de totales -->
                <tr>
                    <td colspan="20"></td> <!-- Colspan igual al número total de columnas -->
                    <td>Total Fermentación: <?= $totalFermentacion ?></td>
                    <td>Total Estiércol: <?= $totalEstiercol ?></td>
                </tr>
            </tbody>
        </table>
        
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled">
                <a class="page-link">Anterior</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Siguiente</a>
            </li>
        </ul>
    </nav>
</div>

<!--INICIO Modal para Editar -->
<!-- Modal para editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #17A2B8;">
        <h5 class="modal-title">EDITAR FERMENTACION ESTIERCOL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="formularioEditar" method="POST" action="modelos/update_Fermentacion_Est.php">
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
                            <label for="id_fermentacion" class="form-label">Id Fermentacion</label>
                            <input type="text" class="form-control" id="id_fermentacion" name="id_fermentacion" readonly>
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
                            <label for="id_categoria_ficha" class="form-label">Categoria Ficha</label>
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
                            <input type="text" class="form-control" id="nivel_medicion_edit" name="nivel_medicion">
                        </div>

                        <div class="col-md-6">
                            <label for="id_sector" class="form-label">Sector</label>
                            <select class="form-control" id="id_sector_edit" name="id_sector" required>
        <?php
        // Conexión a la base de datos
        include '../php/conexion_be.php';

        // Consulta SQL para obtener los valores disponibles de ID y Nombre de Departamento
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
                            <input type="text" class="form-control" id="anio_edit" name="anio">
                        </div>

                        <div class="col-md-6">
                            <label for="id_categoria_especie" class="form-label">Categoria Especie</label>
                            <select class="form-control" id="id_categoria_especie_edit" name="id_categoria_especie" required>
        <?php
        // Conexión a la base de datos
        include '../php/conexion_be.php';

        // Consulta SQL para obtener los valores disponibles de ID y Nombre de Departamento
        $sql = "SELECT id_categoria_especie, categoria_especie FROM tbl_categorias_especies";

        // Ejecutar la consulta
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Genera opciones con el nombre del departamento como etiqueta y el ID como valor
                echo '<option value="' . $row["id_categoria_especie"] . '">' . $row["categoria_especie"] . '</option>';
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
                                echo '<option value="">No hay Especies disponibles</option>';
                                }

                                // Cierra la conexión a la base de datos
                                mysqli_close($conexion);
                                ?>
                            </select>
                        </div>

          </div>
          <div class="tab-pane fade" id="datosTab">
                       <div class="col-md-6">
                            <label for="categoria_medicion" class="form-label">Categoria Medicion</label>
                            <input type="text" class="form-control" id="categoria_medicion_edit" name="categoria_medicion">
                        </div>

                        <div class="col-md-6">
                            <label for="id_criterios_medicion" class="form-label">Criterios Medicion</label>
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
                           <label for="descripcion">Descripción:</label>
                           <input type="text" class="form-control" id="descripcion_edit" name="descripcion" >
                        </div>

                        <div class="col-md-6">
                           <label for="sigla">Sigla:</label>
                           <input type="text" class="form-control" id="sigla_edit" name="sigla" required>
                        </div>

                        <div class="col-md-6">
                            <label for="factor_fermentacion">Factor Emisión Fermentación:</label>
                            <input type="text" class="form-control" id="factor_fermentacion_edit" name="factor_fermentacion" required>
                        </div>

                        <div class="col-md-6">
                           <label for="factor_estiercol">Factor Emisión Estiércol:</label>
                            <input type="text" class="form-control" id="factor_estiercol_edit" name="factor_estiercol" required>
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

<!-- Modal para crear -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #17A2B8; color: white;">
        <h5 class="modal-title">AGREGAR FERMENTACIÓN ESTIERCOL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="modelos/insert_Fermentacion_Est.php" method="POST">
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
            <a class="nav-link" href="#cantidadesTab" data-toggle="tab">Cantidades</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="fichaTab">
                    <div class="col-md-6">
                           <label for="anio">Año:</label>
                            <input type="Number" class="form-control" id="anio" name="anio" required>
                        </div>
                <div class="col-md-6">
                        <label for="id_ficha">Id Ficha:</label>
                            <select class="form-control" id="id_ficha" name="id_ficha" required>
                            <?php
                            // Conexión a la base de datos
                            include '../php/conexion_be.php';

                            // Consulta SQL para obtener los valores disponibles de ID y Nombre de Departamento
                            $sql = "SELECT id_ficha, descripcion FROM tbl_fichas";

                            // Ejecutar la consulta
                            $result = mysqli_query($conexion, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Genera opciones con el nombre del departamento como etiqueta y el ID como valor
                                    echo '<option value="' . $row["id_ficha"] . '">' . $row["descripcion"] . '</option>';
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
                        <label for="id_categoria_ficha">Categoria Ficha:</label>
                            <select class="form-control" id="id_categoria_ficha" name="id_categoria_ficha" required>
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
                           <label for="numero_ficha">Numero Ficha:</label>
                            <input type="text" class="form-control" id="numero_ficha" name="numero_ficha" required>
                        </div>
                        <div class="col-md-6">
                        <label for="id_sector">Sector:</label>
                            <select class="form-control" id="id_sector" name="id_sector" required>
                        <?php
                            // Conexión a la base de datos
                            include '../php/conexion_be.php';

                            // Consulta SQL para obtener los valores disponibles de ID y Nombre de Departamento
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
          </div>
          <div class="tab-pane fade" id="especieTab">
                    <div class="col-md-6">
                            <label for="id_especie">Id Especie:</label>
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
                                echo '<option value="">No hay Especies disponibles</option>';
                                }

                                // Cierra la conexión a la base de datos
                                mysqli_close($conexion);
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_categoria_especie">Id Categoria Especie:</label>
                            <select class="form-control" id="id_categoria_especie" name="id_categoria_especie" required>
                            <?php
                            // Conexión a la base de datos
                            include '../php/conexion_be.php';

                            // Consulta SQL para obtener los valores disponibles de ID y Nombre de Departamento
                            $sql = "SELECT id_categoria_especie, categoria_especie FROM tbl_categorias_especies";

                            // Ejecutar la consulta
                            $result = mysqli_query($conexion, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Genera opciones con el nombre del departamento como etiqueta y el ID como valor
                                    echo '<option value="' . $row["id_categoria_especie"] . '">' . $row["categoria_especie"] . '</option>';
                                }
                            } else {
                                echo '<option value="">No hay campos disponibles</option>';
                            }

                            // Cierra la conexión a la base de datos
                            mysqli_close($conexion);
                            ?>
                                </select>
                                </div>
                         </div>
          <div class="tab-pane fade" id="medicionTab">
                <div class="col-md-6">
                            <label for="id_criterios_medicion">Id Criterio Medicion:</label>
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
                            <label for="categoria_medicion">Categoria Medicion:</label>
                            <input type="text" class="form-control" id="categoria_medicion" name="categoria_medicion" required>
                        </div>
                        <div class="col-md-6">
                        <label for="nivel_medicion">Nivel Medicion:</label>
                            <input type="text" class="form-control" id="nivel_medicion" name="nivel_medicion" required>
                        </div>
          </div>
          <div class="tab-pane fade" id="cantidadesTab">
                    <div class="col-md-6">
                            <label for="cantidad_especie">Cantidad Especie:</label>
                            <input type="text" class="form-control" id="cantidad_especie" name="cantidad_especie" required>
                        </div>
                        <div class="col-md-6">
                            <label for="factor_fermentacion">Factor Emisión Fermentación:</label>
                            <input type="text" class="form-control" id="factor_fermentacion" name="factor_fermentacion" required>
                        </div>
                        <div class="col-md-6">
                            <label for="factor_estiercol">Factor Emisión Estiércol:</label>
                            <input type="text" class="form-control" id="factor_estiercol" name="factor_estiercol" required>
                        </div>
                        <div class="col-md-6">
                            <label for="sigla">Sigla:</label>
                            <input type="text" class="form-control" id="sigla" name="sigla" required>
                        </div>
                        <div class="col-md-6">
                            <label for="descripcion">Descripcion:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required  style=" height: 100px; overflow-y: scroll; resize: none;">
                        </div>
                        <div class="col-md-6">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado" required>
                            <option value="" disabled selected>Selecciona un estado</option>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                    </div>
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




<!-- JavaScript para manejar la edición de usuarios -->
<script>
    // Función para abrir el modal de edición
    function abrirModalEditar(id_fermentacion, nivel_medicion, numero_ficha, categoria_medicion, cantidad_especie, descripcion, sigla, creado_por, fecha_creacion, actualizado_por, fecha_actualizacion, factor_fermentacion, factor_estiercol ,total_fermentacion, total_estiercol ,estado) {
        document.getElementById("id_fermentacion").value = id_fermentacion;
        document.getElementById("nivel_medicion_edit").value = nivel_medicion;
        document.getElementById("anio").value = anio;
        document.getElementById("numero_ficha").value = numero_ficha;
        document.getElementById("categoria_medicion_edit").value = categoria_medicion;
        document.getElementById("cantidad_especie_edit").value = cantidad_especie;
        document.getElementById("descripcion_edit").value = descripcion;
        document.getElementById("sigla_edit").value = sigla;
        document.getElementById("creado_por").value = creado_por;
        document.getElementById("fecha_creacion").value = fecha_creacion;
        document.getElementById("actualizado_por").value = actualizado_por;
        document.getElementById("fecha_actualizacion").value = fecha_actualizacion;
        document.getElementById("factor_fermentacion_edit").value = factor_fermentacion;
        document.getElementById("factor_estiercol_edit").value = factor_estiercol;
        document.getElementById("total_fermentacion_edit").value = total_fermentacion;
        document.getElementById("total_estiercol_edit").value = total_estiercol;
        document.getElementById("estado_edit").value = estado;

        $('#modalEditar').modal('show'); // Mostrar el modal de edición
    }
</script>


<!-- Script para mostrar el mensaje al momento de editar un usuario-->
<script>
    $(document).ready(function() {
        $("#formularioEditar").on("submit", function(event) {
            event.preventDefault();

            $.ajax({
                url: "modelos/update_Fermentacion_Est.php",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response == "success") {
                        Swal.fire({
                            title: "Registro actualizado correctamente",
                            text: "El Registro se ha actualizado correctamente.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonText: "Cerrar"
                        }).then(function() {
                            $("#modalEditar").modal("hide");
                            location.reload(); // Recarga la página
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Hubo un problema al actualizar el registro.",
                            icon: "error",
                            confirmButtonText: "Cerrar"
                        }).then(function() {
                            location.reload(); // Recarga la página
                        });
                    }
                }
            });
        });
    });
</script>

<!-- Script para mostrar el mensaje al momento de eliminar un usuario-->
<script>
    $(document).ready(function() {
        $("form#deleteForm").on("submit", function(event) {
            event.preventDefault();

            var form = $(this);

            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción eliminará el periodo. Esta acción no se puede deshacer.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: form.attr("action"),
                        method: "POST",
                        data: form.serialize(),
                        success: function(response) {
                            if (response == "success") {
                                Swal.fire({
                                    title: "Registro eliminado correctamente",
                                    text: "El Registro se ha eliminado correctamente.",
                                    icon: "success",
                                    showCancelButton: false,
                                    confirmButtonText: "Cerrar"
                                }).then(function() {
                                    location.reload(); // Recarga la página
                                });
                            } else {
                                Swal.fire({
                                    title: "Error",
                                    text: "Hubo un problema al eliminar el Registro.",
                                    icon: "error",
                                    confirmButtonText: "Cerrar"
                                }).then(function() {
                                    location.reload(); // Recarga la página
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.table').DataTable({
            "lengthChange": false,
            "pageLength": 10
        });
    });
</script>