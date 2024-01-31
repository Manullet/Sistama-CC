<?php 
session_start();
 $_SESSION['url'] = 'vistas2/vistaestiercol_n2o_reporte.php';
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


<div class="containertable">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="poppins-font mb-2">Reporte Estiercol N2O</h1>
            <br>
            <a href="#" data-bs-toggle="modal" data-bs-target="#modalForm" class="btn btn-info">
                <i class="nav-icon bi bi-people-fill"></i> Ingresar
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
            <button type="button" class="btn btn-success" id="excelButton">Generar Reporte</button>
            <button type="button" class="btn btn-primary" id="generarReporteButton">Generar Resumen</button>
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

             <script>
        document.getElementById("excelButton").addEventListener("click", function() {
            // Redirigir a excel.php al hacer clic en el botón de Excel
            window.location.href = "reportes/estiercol_n2o_reporte.php";
        });
    </script>
       <script>
        document.getElementById("generarReporteButton").addEventListener("click", function() {
            // Redirigir a excel.php al hacer clic en el botón de Excel
            window.location.href = "reportes/Reporte_tendencia_estiercol_n2o.php";
        });
    </script>

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
                <th scope="col">Id Estiercol</th>
                <th scope="col">Id Ficha</th>
                <th scope="col">Categoria Ficha</th>
                <th scope="col">Nivel Medicion</th>
                <th scope="col">Sector</th>
                <th scope="col">Año</th>
                <th scope="col">Numero Ficha</th>
                <th scope="col">Gestion Estiercol</th>
                <th scope="col">Categoria Especie</th>    
                <th scope="col">Especie</th>
                <th scope="col">Categoria Medicion</th>
                <th scope="col">Criterios Medicion</th>
                <th scope="col">Cantidad Especie</th>
                <th scope="col">Tasa Excrecion</th>
                <th scope="col">Masa Animal </th>
                <th scope="col">Promedio Anual de Excreción de N</th>
                <th scope="col">Fracción de la Excreción Total Anual de Nitrógeno</th>
                <th scope="col">N Total Excretado por MMS</th>
                <th scope="col">Factor de Emisión para Emisiones Directas de N2O</th>
                <th scope="col">Emisiones Directas de N2O de la Gestión del Estiércol</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                include "../php/conexion_be.php";
                $sql = $conexion->query("SELECT
                      tbl_gestion_mms_estiercol.gestion_estiercol,
                      tbl_fichas.id_ficha,
                      tbl_categorias_fichas.categoria_ficha,
                      tbl_estiercol_n2o.nivel_medicion,
                      tbl_estiercol_n2o.id_estiercol,
                      tbl_sector.sector,
                      tbl_estiercol_n2o.anio,
                      tbl_estiercol_n2o.numero_ficha,
                      tbl_categorias_especies.categoria_especie,
                      tbl_especie.especie,
                      tbl_estiercol_n2o.categoria_medicion,
                      tbl_criterio_medicion.criterio_medicion,
                      tbl_estiercol_n2o.cantidad_especie,
                      tbl_estiercol_n2o.sigla,
                      tbl_estiercol_n2o.creado_por,
                      tbl_estiercol_n2o.fecha_creacion,
                      tbl_estiercol_n2o.actualizado_por,
                      tbl_estiercol_n2o.fecha_actualizacion,
                      tbl_estiercol_n2o.estado, 
                      tbl_estiercol_n2o.tasa_excrecion, 
                      tbl_estiercol_n2o.masa_animal,
                      tbl_estiercol_n2o.promedio_anual_excrecion,
                      tbl_estiercol_n2o.fraccion_excrecion,
                      tbl_estiercol_n2o.n_total_excretado,
                      tbl_estiercol_n2o.factor_emisiones_directas,
                      tbl_estiercol_n2o.emision_directas

                FROM tbl_estiercol_n2o 
                INNER JOIN tbl_fichas ON tbl_estiercol_n2o.id_ficha = tbl_fichas.id_ficha 
                INNER JOIN tbl_categorias_fichas ON tbl_estiercol_n2o.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha
                INNER JOIN tbl_sector ON tbl_estiercol_n2o.id_sector = tbl_sector.id_sector
                INNER JOIN tbl_categorias_especies ON tbl_estiercol_n2o.id_categoria_especie = tbl_categorias_especies.id_categoria_especie
                INNER JOIN tbl_especie ON tbl_estiercol_n2o.id_especie = tbl_especie.id_especie
                INNER JOIN tbl_criterio_medicion ON tbl_estiercol_n2o.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion
                INNER JOIN tbl_gestion_mms_estiercol ON tbl_estiercol_n2o.id_gestion_estiercol_mms = tbl_gestion_mms_estiercol.id_gestion_estiercol_mms 

                
                ");  
                $totalNTotalF = 0;
                $totalEmisionH = 0;

                while ($datos = $sql->fetch_object()) { ?>
                    <tr>
                        <td><?= $datos->id_estiercol?></td>
                        <td><?= $datos->id_ficha ?></td>
                        <td><?= $datos->categoria_ficha ?></td>
                        <td><?= $datos->nivel_medicion?></td>      
                        <td><?= $datos->sector?></td>
                        <td><?= $datos->anio?></td>
                        <td><?= $datos->numero_ficha?></td>
                        <td><?= $datos->gestion_estiercol?></td>
                        <td><?= $datos->categoria_especie?></td>
                        <td><?= $datos->especie?></td>
                        <td><?= $datos->categoria_medicion?></td>
                        <td><?= $datos->criterio_medicion?></td>
                        <td><?= $datos->cantidad_especie ?></td>
                        <td><?= $datos->tasa_excrecion?></td>
                        <td><?= $datos->masa_animal?></td>
                        <td><?= $datos->promedio_anual_excrecion?></td>
                        <td><?= $datos->fraccion_excrecion?></td>
                        <td><?= $datos->n_total_excretado?></td>
                        <td><?= $datos->factor_emisiones_directas?></td>
                        <td><?= $datos->emision_directas?></td>
                        <td><?= $datos->id_gestion_estiercol_mms?></td>
                        
                    
                    
                        <td>
                            <button type="button" class="btn btn-editar" data-toggle="modal" data-target="#modalEditar" onclick="abrirModalEditar
                            ('<?= $datos->id_estiercol ?>', '<?= $datos->ficha ?>', '<?= $datos->categoria_ficha ?>', '<?= $datos->nivel_medicion ?>', 
                            '<?= $datos->sector ?>', '<?= $datos->anio ?>', '<?= $datos->numero_ficha ?>', '<?= $datos->gestion_estiercol ?>',
                            '<?= $datos->categoria_especie ?>', '<?= $datos->especie ?>', '<?= $datos->categoria_medicion ?>', '<?= $datos->criterio_medicion ?>',
                            '<?= $datos->cantidad_especie ?>', '<?= $datos->tasa_excrecion ?>', '<?= $datos->masa_animal ?>', '<?= $datos->promedio_anual_excrecion ?>',
                            '<?= $datos->fraccion_excrecion ?>', '<?= $datos->n_total_excretado ?>', '<?= $datos->factor_emisiones_directas ?>', '<?= $datos->emision_directas ?>', '<?= $datos->id_gestion_estiercol_mms ?>'
                            )">
                                <i class="bi bi-pencil-square"></i>
                                Editar
                            </button>
                            <form id="deleteForm" method="POST" action="modelos/delete_sector.php" style="display: inline;">
                                <input type="hidden" name="id_sector" value="<?= $datos->id_sector ?>">
                                <button type="submit" class="btn btn-eliminar">
                                    <i class="bi bi-trash"></i>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                

                    </tr>
                <?php 
                // Sumar los valores para los totales
                $totalNTotalF += $datos->n_total_f;
                $totalEmisionH += $datos->emision_h;
            }
                ?>
                <!-- Fila de totales -->
                <tr>
                    <td colspan="7">Totales</td>
                    <td><?= $totalNTotalF ?></td>
                    <td><?= $totalEmisionH ?></td>
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

 <!-- Modal para crear -->
 <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #17A2B8; color: white;">
        <h5 class="modal-title">AGREGAR ESTIERCOL N20 MEDICION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="modelos2/insert_estiercoln2o.php" method="POST">
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
          <li class="nav-item">
            <a class="nav-link" href="#datosTab" data-toggle="tab">Datos</a>
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
                                <label for="tasa_excrecion" class="form-label">Tasa Excrecion</label>
                                <input type="text" class="form-control" id="tasa_excrecion" name="tasa_excrecion" required>
                            </div>
                            <div class="col-md-6">
                                <label for="masa_animal" class="form-label">Masa Animal</label>
                                <input type="text" class="form-control" id="masa_animal" name="masa_animal" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fraccion_excrecion" class="form-label">Fraccion Excrecion</label>
                                <input type="text" class="form-control" id="fraccion_excrecion" name="fraccion_excrecion" required>
                            </div>
                            <div class="col-md-6">
                                <label for="factor_emisiones_directas" class="form-label">Factor Emisiones Directas</label>
                                <input type="text" class="form-control" id="factor_emisiones_directas" name="factor_emisiones_directas" required>
                            </div>
          </div>
          <div class="tab-pane fade" id="datosTab">
                            <div class="col-md-6">
                                <label for="sigla" class="form-label">Sigla</label>
                                <input type="text" class="form-control" id="sigla" name="sigla" required>
                            </div>
                            <div class="col-md-6">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado" required>
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


<!-- JavaScript para manejar la edición de usuarios -->
<script>
    // Función para abrir el modal de edición
    function abrirModalEditar(id_estiercol, id_ficha, id_categoria_ficha, nivel_medicion, id_sector, anio, numero_ficha, id_categoria_especie,
    especie, categoria_medicion, id_criterios_medicion,cantidad_especie, sigla, tasa_excrecion, masa_animal, promedio_anual_excrecion,fraccion_excrecion, 
    factor_emisiones_directas,  promedio_anual_excrecion, n_total_excretado, ) {
       document.getElementById("id_estiercol").value = id_estiercol;
       document.getElementById("id_ficha").value = id_ficha_edit;
       document.getElementById("id_categoria_ficha").value = id_categoria_ficha_edit;
       document.getElementById("nivel_medicion").value = nivel_medicion_edit;
       document.getElementById("id_sector").value = id_sector_edit;
       document.getElementById("anio").value = anio_edit;
       document.getElementById("numero_ficha").value = numero_ficha_edit;
       document.getElementById("id_categoria_especie").value = id_categoria_especie_edit;
       document.getElementById("especie").value = especie_edit;
       document.getElementById("categoria_medicion").value = categoria_medicion_edit;
       document.getElementById("id_criterios_medicion").value = id_criterios_medicion_edit;
       document.getElementById("cantidad_especie").value = cantidad_especie_edit;
       document.getElementById("sigla").value = sigla_edit;
       document.getElementById("tasa_excrecion").value = tasa_excrecion_edit;
       document.getElementById("masa_animal").value = masa_animal_edit;
       document.getElementById("promedio_anual_excrecion").value = promedio_anual_excrecion_edit;
       document.getElementById("fraccion_excrecion").value = fraccion_excrecion_edit;
       document.getElementById("factor_emisiones_directas").value = factor_emisiones_directas_edit;
       document.getElementById("promedio_anual_excrecion").value = promedio_anual_excrecion_edit;
       document.getElementById("n_total_excretado").value = n_total_excretado;

        $('#modalEditar').modal('show'); // Mostrar el modal de edición
    }
</script>


<!-- Script para mostrar el mensaje al momento de editar un usuario-->
<script>
    $(document).ready(function() {
        $("#formularioEditar").on("submit", function(event) {
            event.preventDefault();

            $.ajax({
                url: "modelos/update_sector.php",
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