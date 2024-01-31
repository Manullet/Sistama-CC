<?php 
session_start();
 $_SESSION['url'] = 'reportes/vistasuelos_indirectos_reporte.php';
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
            <h1 class="poppins-font mb-2">Reporte Suelos Indirectos</h1>
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
            window.location.href = "reportes/suelos_indirectos_reporte.php";
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

            <th scope="col">Id Suelos Indirectos</th>
            <th scope="col">Id Ficha</th>
            <th scope="col">Suelos Indirectos</th>
            <th scope="col">Categoria Ficha</th>
            <th scope="col">Sector</th>
            <th scope="col">Criterios Medicion </th>
            <th scope="col">Codigo Categoria</th>
            <th scope="col">Año</th>
            <th scope="col">Categoria Medicion</th>
            <th scope="col">Cantidad Anual N</th>
            <th scope="col">Fraccion N</th>
            <th scope="col">Cantidad Animal</th>
            <th scope="col">Cantidad Orina</th>
            <th scope="col">Fraccion Materiales</th>
            <th scope="col">Factor Emision</th>
            <th scope="col">Cantidad Deposicion</th>
            <th scope="col">N2o Volatilizacion</th>
            <th scope="col">Cantidad Residuos</th>
            <th scope="col">Cantidad Mineralizado</th>
            <th scope="col">Fracción Mineralizdo</th>
            <th scope="col">Cantidad Lixiviación</th>
            <th scope="col">Fraccion Lixiviación</th>
            <th scope="col">N2o Lixiviación</th>
            <th scope="col">Total</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                include "../php/conexion_be.php";
                $sql = $conexion->query("SELECT 
                tbl_suelos_indirectos_b.id_suelos_indirectos_b,
                tbl_fichas.id_ficha,
                tbl_suelos_indirectos.nombre_suelo,
                tbl_categorias_fichas.categoria_ficha, 
                tbl_sector.sector, 
                tbl_criterio_medicion.criterio_medicion, 
                tbl_suelos_indirectos_b.codigo_categoria,
                tbl_suelos_indirectos_b.anio,
                tbl_suelos_indirectos_b.categoria_medicion,
                tbl_suelos_indirectos_b.cantidad_anual_n,
                tbl_suelos_indirectos_b.fraccion_n,
                tbl_suelos_indirectos_b.cantidad_animal,
                tbl_suelos_indirectos_b.cantidad_orina,
                tbl_suelos_indirectos_b.fraccion_materiales,
                tbl_suelos_indirectos_b.factor_emision,
                tbl_suelos_indirectos_b.cantidad_deposicion,
                tbl_suelos_indirectos_b.n2o_volatilizacion,
                tbl_suelos_indirectos_b.cantidad_residuos,
                tbl_suelos_indirectos_b.cantidad_mineralizado,
                tbl_suelos_indirectos_b.fraccion_mineralizado,
                tbl_suelos_indirectos_b.cantidad_lixiviacion,
                tbl_suelos_indirectos_b.fraccion_lixiviacion,
                tbl_suelos_indirectos_b.n2o_lixxiviacion,
                tbl_suelos_indirectos_b.total,
                tbl_suelos_indirectos_b.hoja, 
                tbl_suelos_indirectos_b.referencia,
                tbl_suelos_indirectos_b.creado_por,
                tbl_suelos_indirectos_b.fecha_creacion,
                tbl_suelos_indirectos_b.actualizado_por,
                tbl_suelos_indirectos_b.fecha_actualizacion,
                tbl_suelos_indirectos_b.estado
            FROM tbl_suelos_indirectos_b 
            INNER JOIN tbl_fichas ON tbl_suelos_indirectos_b.id_ficha = tbl_fichas.id_ficha 
            INNER JOIN tbl_categorias_fichas ON tbl_suelos_indirectos_b.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha 
            INNER JOIN tbl_sector ON tbl_suelos_indirectos_b.id_sector = tbl_sector.id_sector 
            INNER JOIN tbl_criterio_medicion ON tbl_suelos_indirectos_b.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion
            INNER JOIN tbl_suelos_indirectos ON tbl_suelos_indirectos_b.id_suelos_indirectos = tbl_suelos_indirectos.id_suelos_indirectos
            
            ");
            
            
             

                while ($datos = $sql->fetch_object()) { ?>
                    <tr>
                <td><?= $datos->id_suelos_indirectos_b ?></td>
                <td><?= $datos->id_ficha ?></td>
                <td><?= $datos->nombre_suelo ?></td>
                <td><?= $datos->categoria_ficha ?></td>
                <td><?= $datos->sector ?></td>
                <td><?= $datos->criterio_medicion ?></td>
                <td><?= $datos->codigo_categoria ?></td>
                <td><?= $datos->anio?></td>
                <td><?= $datos->categoria_medicion?></td>
                <td><?= $datos->cantidad_anual_n ?></td>
                <td><?= $datos->fraccion_n ?></td>
                <td><?= $datos->cantidad_animal ?></td>
                <td><?= $datos->cantidad_orina ?></td>
                <td><?= $datos->fraccion_materiales ?></td>
                <td><?= $datos->factor_emision ?></td>
                <td><?= $datos->cantidad_deposicion ?></td>
                <td><?= $datos->n2o_volatilizacion ?></td>
                <td><?= $datos->cantidad_residuos ?></td>
                <td><?= $datos->cantidad_mineralizado ?></td>
                <td><?= $datos->fraccion_mineralizado ?></td>
                <td><?= $datos->cantidad_lixiviacion ?></td>
                <td><?= $datos->fraccion_lixiviacion ?></td>
                <td><?= $datos->n2o_lixxiviacion ?></td>
                <td><?= $datos->total ?></td>
                <td><?php
                            if ($datos->estado == "ACTIVO") {
                                echo '<span class="badge bg-success">Activo</span>';
                            } else {
                                echo '<span class="badge bg-danger">Inactivo</span>';
                            }
                            ?></td>
                        <td>
                            <button type="button" class="btn btn-editar" data-toggle="modal" data-target="#modalEditar" onclick="abrirModalEditar(
                                    '<?= $datos->id_suelos_indirectos_b ?>',
                                    '<?= $datos->id_ficha ?>',
                                    '<?= $datos->id_suelos_indirectos ?>',
                                    '<?= $datos->categoria_ficha ?>',
                                    '<?= $datos->sector ?>',
                                    '<?= $datos->criterio_medicion ?>',
                                    '<?= $datos->codigo_categoria ?>',
                                    '<?= $datos->anio ?>',
                                    '<?= $datos->categoria_medicion ?>',
                                    '<?= $datos->cantidad_anual_n ?>',
                                    '<?= $datos->fraccion_n ?>',
                                    '<?= $datos->cantidad_animal ?>',       
                                    '<?= $datos->cantidad_orina ?>',         
                                    '<?= $datos->fraccion_materiales ?>',  
                                    '<?= $datos->factor_emision ?>', 
                                    '<?= $datos->cantidad_deposicion ?>'
                                    '<?= $datos->n2o_volatilización ?>'
                                    '<?= $datos->cantidad_residuos ?>',
                                    '<?= $datos->cantidad_mineralizado ?>',
                                    '<?= $datos->fraccion_mineralizado ?>',
                                    '<?= $datos->cantidad_lixiviacion ?>',
                                    '<?= $datos->fraccion_lixiviacion ?>',
                                    '<?= $datos->n2o_lixxiviacion ?>'
                                    '<?= $datos->total ?>'
                                    '<?= $datos->estado ?>'
                                    )">
                                Editar
                            </button>
                            <form id="deleteForm" method="POST" action="modelos/delete_suelos_indirectos.php" style="display: inline;">
                                <input type="hidden" name="id_suelos_indirectos_b" value="<?= $datos->id_suelos_indirectos_b ?>">
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
        <h5 class="modal-title">EDITAR 3C5 SUELOS INDIRECTOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="formularioEditar" method="POST" action="modelos3/update_suelosindirectos_medicion.php">
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
                                <input type="text" class="form-control" id="factor_emision_edit" name="factor_emision" required>
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

        





<!--***********************************************************************************************************************************************************-->
<!-- Modal para crear -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #17A2B8; color: white;">
        <h5 class="modal-title">AGREGAR SUELOS INDIRECTOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="modelos3/insert_suelosindirectos_medicion.php" method="POST">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" href="#fichaTab" data-toggle="tab">Ficha</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#factorTab" data-toggle="tab">Factor y Cantidad</a>
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
                                    $sql = "SELECT id_ficha FROM tbl_fichas";

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
                                <label for="id_suelos_indirectos">Id Suelos Indirectos</label>
                                <select class="form-control" id="id_suelos_indirectos" name="id_suelos_indirectos" required>
                                    <?php
                                    // Conexión a la base de datos
                                    include '../php/conexion_be.php';

                                    $sql = "SELECT id_suelos_indirectos, nombre_suelo FROM tbl_suelos_indirectos";

                                    // Ejecutar la consulta
                                    $result = mysqli_query($conexion, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    // Genera opciones para cada valor 
                                    echo '<option value="' . $row["id_suelos_indirectos"] . '">' . $row["nombre_suelo"] . '</option>';
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
          <div class="tab-pane fade" id="factorTab">
                <div class="col-md-6">
                                <label for="id_criterios_medicion">Criterio de Medición</label>
                                <select class="form-control" id="id_criterios_medicion" name="id_criterios_medicion" required>
                                    <?php
                                    // Conexión a la base de datos
                                    include '../php/conexion_be.php';

                                    $sql = "SELECT id_criterios_medicion, criterio_medicion FROM tbl_criterio_medicion";

                                    // Ejecutar la consulta
                                    $result = mysqli_query($conexion, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    // Genera opciones para cada valor 
                                    echo '<option value="' . $row["id_criterios_medicion"] . '">' . $row["criterio_medicion"] . '</option>';
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
                                <label for="cantidad_anual_n">Cantidad Anual N</label>
                                <input type="text" class="form-control" id="cantidad_anual_n" name="cantidad_anual_n" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fraccion_n">Fraccion N </label>
                                <input type="text" class="form-control" id="fraccion_n" name="fraccion_n" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cantidad_animal">Cantidad Animal </label>
                                <input type="text" class="form-control" id="cantidad_animal" name="cantidad_animal" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cantidad_orina">Cantidad Orina </label>
                                <input type="text" class="form-control" id="cantidad_orina" name="cantidad_orina" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fraccion_materiales">Fraccion Materiales</label>
                                <input type="text" class="form-control" id="fraccion_materiales" name="fraccion_materiales" required>
                            </div>
                            <div class="col-md-6">
                                <label for="factor_emision">Factor Emision </label>
                                <input type="text" class="form-control" id="factor_emision" name="factor_emision" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cantidad_residuos">Cantidad Residuos </label>
                                <input type="text" class="form-control" id="cantidad_residuos" name="cantidad_residuos" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cantidad_mineralizado">Cantidad Mineralizado </label>
                                <input type="text" class="form-control" id="cantidad_mineralizado" name="cantidad_mineralizado" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fraccion_mineralizado">Fraccion Mineralizado </label>
                                <input type="text" class="form-control" id="fraccion_mineralizado" name="fraccion_mineralizado" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fraccion_lixiviacion">Fraccion Lixiviacion </label>
                                <input type="text" class="form-control" id="fraccion_lixiviacion" name="fraccion_lixiviacion" required>
                            </div>
                            <div class="col-md-6">
                                        <label for="codigo_categoria">Codigo categoria</label>
                                        <input type="text" class="form-control" id="codigo_categoria" name="codigo_categoria" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="categoria_medicion">Categoria Medicion</label>
                                        <input type="text" class="form-control" id="categoria_medicion" name="categoria_medicion" required>
                                    </div>
                         <div class="col-md-6">
                                        <label for="referencia">Referencia</label>
                                        <input type="text" class="form-control" id="referencia" name="referencia" required>
                                    </div>
                             <div class="col-md-6">
                                        <label for="hoja">Hoja</label>
                                        <input type="text" class="form-control" id="hoja" name="hoja" required>
                                    </div>
                            <div class="col-md-6">
                                        <label for="descripcion">Descripcion </label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion" required style="height: 100px; overflow-y: scroll; resize: none;">
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

<!--Fin Modal Crear -->
<!--***********************************************************************************************************************************************************-->



<!-- JavaScript para manejar la edición de usuarios -->
<script>
    // Función para abrir el modal de edición
    function abrirModalEditar(id_suelos_indirectos_b, id_ficha, id_suelos_indirectos, id_categoria_ficha, id_sector, id_criterios_medicion, codigo_categoria, 
    anio, categoria_medicion,cantidad_anual_n, fraccion_n, cantidad_animal, cantidad_orina, fraccion_materiales, cantidad_deposicion ,factor_emision,
    cantidad_residuos, cantidad_mineralizado, fraccion_mineralizado, cantidad_lixiviacion, fraccion_lixiviacion, estado) {
    document.getElementById("id_suelos_indirectos_b").value = id_suelos_indirectos_b;
    document.getElementById("id_ficha_edit").value = id_ficha;
    document.getElementById("id_suelos_indirectos_edit").value = id_suelos_indirectos;
    document.getElementById("id_categoria_ficha_edit").value = id_categoria_ficha;
    document.getElementById("id_sector_edit").value = id_sector;
    document.getElementById("id_criterios_medicion_edit").value = id_criterios_medicion;
    document.getElementById("codigo_categoria_edit").value = codigo_categoria;
    document.getElementById("anio_edit").value = anio;
    document.getElementById("categoria_medicion_edit").value = categoria_medicion;
    document.getElementById("cantidad_anual_n_edit").value = cantidad_anual_n;
    document.getElementById("fraccion_n_edit").value = fraccion_n;
    document.getElementById("cantidad_animal_edit").value = cantidad_animal;
    document.getElementById("cantidad_orina_edit").value = cantidad_orina;
    document.getElementById("fraccion_materiales_edit").value = fraccion_materiales;
    document.getElementById("cantidad_deposicion_edit").value = cantidad_deposicion;
    document.getElementById("factor_emision_edit").value = factor_emision;
    document.getElementById("cantidad_residuos_edit").value = cantidad_residuos;
    document.getElementById("cantidad_mineralizado_edit").value = cantidad_mineralizado;
    document.getElementById("fraccion_mineralizado_edit").value = fraccion_mineralizado;
    document.getElementById("cantidad_lixiviacion_edit").value = cantidad_lixiviacion;
    document.getElementById("fraccion_lixiviacion_edit").value = fraccion_lixiviacion;
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
                url: "modelos3/update_suelosindirectos_medicion.php",
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
                                    title: "Error",
                                    text: "Hubo un problema al eliminar el Registro.",
                                    icon: "error",
                                    confirmButtonText: "Cerrar"
                                }).then(function() {
                                    location.reload(); // Recarga la página
                                });
                            } else {
                                Swal.fire({
                                    title: "Registro eliminado correctamente",
                                    text: "El Registro se ha eliminado correctamente.",
                                    icon: "success",
                                    showCancelButton: false,
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