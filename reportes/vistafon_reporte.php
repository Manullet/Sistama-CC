<?php 
session_start();
 $_SESSION['url'] = 'reportes/vistafon_reporte.php';
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
            <h1 class="poppins-font mb-2">Reporte FON</h1>
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
            window.location.href = "reportes/fon_reporte.php";
        });
    </script>
        <script>
        document.getElementById("generarReporteButton").addEventListener("click", function() {
            // Redirigir a excel.php al hacer clic en el botón de Excel
            window.location.href = "reportes/Reporte_tendencia_encalado.php";
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
        <h5 class="modal-title">EDITAR 3C4 FON</h5>
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
                        <label for="id_fon" class="form-label">Id FON</label>
                                <input type="text" class="form-control" id="id_fon" name="id_fon" readonly>
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
                        <label for="numero_ficha">Numero Ficha:</label>
                          <input type="text" class="form-control" id="numero_ficha_edit" name="numero_ficha" required>
                        </div>

                        <div class="col-md-6">
                        <label for="categoria_medicion" class="form-label">Categoria Medicion</label>
                                <input type="text" class="form-control" id="categoria_medicion_edit" name="categoria_medicion" required>
                        </div>

                        <div class="col-md-6">
                        <label for="cantidad_especie" class="form-label">Cantidad Especie</label>
                                <input type="text" class="form-control" id="cantidad_especie_edit" name="cantidad_especie" required>
                        </div>

                        <div class="col-md-6">
                        <label for="promedio_b" class="form-label">Promedio Anual Excrecion de N</label>
                                <input type="text" class="form-control" id="promedio_b_edit" name="promedio_b" required>
                        </div>

                        <div class="col-md-6">
                        <label for="fraccion_c" class="form-label">Fraccion de la Excrecion Total Anual</label>
                        <input type="text" class="form-control" id="fraccion_c_edit" name="fraccion_c" required>
                        </div>

                        <div class="col-md-6">
                        <label for="cantidad_nitrogeno_d" class="form-label">Cantidad de Nitrogeno del Estiercol D</label>
                                <input type="text" class="form-control" id="cantidad_nitrogeno_d_edit" name="cantidad_nitrogeno_d" required>
                        </div>

                        <div class="col-md-6">
                        <label for="cantidad_nitrogeno_e" class="form-label">Cantidad de Nitrogeno del Estiercol E</label>
                                <input type="text" class="form-control" id="cantidad_nitrogeno_e_edit" name="cantidad_nitrogeno_e" required>
                        </div>

                        <div class="col-md-6">
                        <label for="cantidad_nitrogeno_f" class="form-label">Cantidad de Nitrogeno de las camas F</label>
                                <input type="text" class="form-control" id="cantidad_nitrogeno_f_edit" name="cantidad_nitrogeno_f" required>
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
    <div class="modal-dialog">
        <div class="modal-content" role="document">
            <div class="modal-header" style="background-color: #17A2B8;">
                <h5 class="poppins-modal mb-2" id="exampleModalLabel">Ingresar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="modelos2/insert_fon_estiercol.php" method="POST">
                    <div class="row mb-3">
                    <div class="col-8">
                            <label for="id_sistema" class="form-label">Sistema</label>
                            <select class="form-control" id="sistema" name="id_sistema" required>
                                <?php
                                // Conexión a la base de datos
                                include '../php/conexion_be.php';

                                // Consulta SQL para obtener los valores disponibles de id_sector desde tbl_sector
                                $sql = "SELECT id_sistema, sistema FROM tbl_sistema_mms";

                                // Ejecutar la consulta
                                $result = mysqli_query($conexion, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                // Genera opciones para cada valor de id_sector
                                echo '<option value="' . $row["id_sistema"] . '">' . $row["sistema"] . '</option>';
                                }
                                } else {
                                echo '<option value="">No hay Especies disponibles</option>';
                                }

                                // Cierra la conexión a la base de datos
                                mysqli_close($conexion);
                                ?>
                            </select>

                        </div>

                        <div class="col-8">
                            <label for="id_especie" class="form-label">Especie</label>
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
                        
                        <div class="col-8">
                            <label for="cantidad_a_edit" class="form-label">Cantidad de Cabezas</label>
                            <input type="text" class="form-control" id="cantidad_a_edit" name="cantidad_a_edit">
                        </div>

                        <div class="col-8">
                            <label for="promedio_b_edit" class="form-label">Promedio Anual de Excrecion</label>
                            <input type="text" class="form-control" id="promedio_b_edit" name="promedio_b_edit">
                        </div>

                        <div class="col-8">
                            <label for="fraccion_c_edit" class="form-label">Fracción de la Excreción</label>
                            <input type="text" class="form-control" id="fraccion_c_edit" name="fraccion_c_edit">
                        </div>

                        <div class="col-8">
                            <label for="cantidad_nitrogeno_d_edit" class="form-label">Cantidad de Nitrogeno Estiercol (D)</label>
                            <input type="text" class="form-control" id="cantidad_nitrogeno_d_edit" name="cantidad_nitrogeno_d_edit">
                        </div>
                        
                        <div class="col-8">
                            <label for="cantidad_nitrogeno_e_edit" class="form-label">Cantidad de Nitrogeno Estiercol (E)</label>
                            <input type="text" class="form-control" id="cantidad_nitrogeno_e_edit" name="cantidad_nitrogeno_e_edit">
                        </div>
                                                
                        <div class="col-8">
                            <label for="cantidad_nitrogeno_f_edit" class="form-label">Cantidad de Nitrogeno de Camas (F)</label>
                            <input type="text" class="form-control" id="cantidad_nitrogeno_f_edit" name="cantidad_nitrogeno_f_edit">
                        </div>
                        <div class="col-12">
                    <button type="submit" class="btn btn-success" name="btnnuevo" value="ok">Crear</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para manejar la edición de usuarios -->
<script>
    // Función para abrir el modal de edición
    function abrirModalEditar(id_fon,id_ficha, id_categoria_ficha, nivel_medicion,id_sector, anio, id_gestion_estiercol_mms,id_categoria_especie, id_especie,
    id_criterios_medicion, numero_ficha, categoria_medicion, sistema, cantidad_especie, promedio_b, fraccion_c, cantidad_nitrogeno_d, cantidad_nitrogeno_e, 
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
    document.getElementById("sistema_edit").value = sistema;
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