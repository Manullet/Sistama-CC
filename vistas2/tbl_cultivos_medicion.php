<?php 
session_start();
 $_SESSION['url'] = 'vistas2/tbl_cultivos_medicion.php';
 $_SESSION['content-wrapper'] = 'content-wrapper';
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/estilos.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<div class="containertable">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="poppins-font mb-2">CULTIVOS MEDICION</h1>
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
                    <th scope="col">Id Medición de Cultivos</th>
                    <th scope="col">Id Ficha</th>
                    <th scope="col">Categoria de Ficha</th>
                    <th scope="col">Nivel Medición</th>  
                    <th scope="col">Sector</th>
                    <th scope="col">Año</th>
                       <th scope="col">Numero de Ficha</th>
                    <th scope="col">Cultivo</th>
                    <th scope="col">Criterio de Medicion</th>
                    <th scope="col">Total</th>
                    <th scope="col">Sigla</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Tipo Superficie</th>
                    <th scope="col">Masa Combustible</th>
                    <th scope="col">Factor Combustion</th>
                    <th scope="col">Factor Emision CH4</th>
                    <th scope="col">Factor Emision CO</th>
                    <th scope="col">Factor Emision NO2</th>
                    <th scope="col">Factor Emision NOx</th>
                    <th scope="col">Emision CH4</th>
                    <th scope="col">Emision CO</th>
                    <th scope="col">Emision N2O</th>
                    <th scope="col">Emision NOx</th>
                    <th scope="col">Actualizado Por</th>
                    <th scope="col">Estado</th>

                    <th scope="col">Acciones</th> <!-- Added text-center class here -->
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                include "../php/conexion_be.php";
                $sql = $conexion->query("SELECT tbl_cultivos_medicion.id_cultivos_medicion, tbl_fichas.id_ficha, tbl_categorias_fichas.categoria_ficha, tbl_sector.sector, tbl_categorias_cultivo.cultivo, tbl_criterio_medicion.criterio_medicion, tbl_cultivos_medicion.nivel_medicion, tbl_cultivos_medicion.anio, tbl_cultivos_medicion.numero_ficha, tbl_cultivos_medicion.total, tbl_cultivos_medicion.sigla, tbl_cultivos_medicion.descripcion, tbl_cultivos_medicion.actualizado_por, tbl_cultivos_medicion.tipo_superficie, tbl_cultivos_medicion.masa_combustible, tbl_cultivos_medicion.factor_emision_ch, tbl_cultivos_medicion.factor_emision_co, tbl_cultivos_medicion.factor_emision_n2o, tbl_cultivos_medicion.factor_emision_nox, tbl_cultivos_medicion.emision_ch, tbl_cultivos_medicion.emision_co, tbl_cultivos_medicion.emision_n2o, tbl_cultivos_medicion.emision_nox , tbl_cultivos_medicion.factor_combustion ,tbl_cultivos_medicion.estado
                FROM tbl_cultivos_medicion
                INNER JOIN tbl_fichas ON tbl_cultivos_medicion.id_ficha = tbl_fichas.id_ficha
                INNER JOIN tbl_categorias_fichas ON tbl_cultivos_medicion.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha
                INNER JOIN tbl_sector ON tbl_cultivos_medicion.id_sector = tbl_sector.id_sector
                INNER JOIN tbl_categorias_cultivo ON tbl_cultivos_medicion.id_cultivo = tbl_categorias_cultivo.id_cultivo
                INNER JOIN tbl_criterio_medicion ON tbl_cultivos_medicion.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion");
                while ($datos = $sql->fetch_object()) { ?>
                    <tr>
                        <td><?= $datos->id_cultivos_medicion?></td>
                        <td><?= $datos->id_ficha?></td>
                        <td><?= $datos->categoria_ficha?></td>
                        <td><?= $datos->nivel_medicion?></td>
                        <td><?= $datos->sector?></td>
                        <td><?= $datos->anio?></td>
                        <td><?= $datos->numero_ficha?></td>
                        <td><?= $datos->cultivo?></td>
                        <td><?= $datos->criterio_medicion?></td>
                        <td><?= $datos->total?></td>
                        <td><?= $datos->sigla?></td>
                        <td><?= $datos->descripcion ?></td>
                        <td><?= $datos->tipo_superficie ?></td>
                        <td><?= $datos->masa_combustible ?></td>
                        <td><?= $datos->factor_combustion ?></td>
                        <td><?= $datos->factor_emision_ch ?></td>
                        <td><?= $datos->factor_emision_co ?></td>
                        <td><?= $datos->factor_emision_n2o ?></td>
                        <td><?= $datos->factor_emision_nox ?></td>
                        <td><?= $datos->emision_ch?></td>
                        <td><?= $datos->emision_co?></td>
                        <td><?= $datos->emision_n2o?></td>
                        <td><?= $datos->emision_nox?></td>
                        <td><?= $datos->actualizado_por ?></td>
                        <td><?php
                            if ($datos->estado == "ACTIVO") {
                                echo '<span class="badge bg-success">Activo</span>';
                            } else {
                                echo '<span class="badge bg-danger">Inactivo</span>';
                            }
                            ?></td>
                        <td>
                            <button type="button" class="btn btn-editar" data-toggle="modal" data-target="#modalEditar" onclick="abrirModalEditar
                            ('<?= $datos->id_cultivos_medicion ?>', '<?= $datos->id_ficha ?>', '<?= $datos->categoria_ficha ?>', '<?= $datos->nivel_medicion ?>' ,'<?= $datos->sector ?>', '<?= $datos->anio ?>', '<?= $datos->numero_ficha ?>'  ,'<?= $datos->cultivo ?>', '<?= $datos->criterio_medicion ?>', '<?= $datos->total ?>', '<?= $datos->sigla ?>', '<?= $datos->descripcion ?>', '<?= $datos->tipo_superficie ?>', '<?= $datos->masa_combustible ?>', '<?= $datos->factor_combustion ?>' ,'<?= $datos->factor_emision_ch ?>', '<?= $datos->factor_emision_co ?>', '<?= $datos->factor_emision_n2o ?>', '<?= $datos->factor_emision_nox ?>', '<?= $datos->emision_ch ?>', '<?= $datos->emision_co ?>', '<?= $datos->emision_n2o ?>', '<?= $datos->emision_nox ?>' ,'<?= $datos->actualizado_por ?>', '<?= $datos->estado ?>')">
                                <i class="bi bi-pencil-square"></i>
                                Editar
                            </button>
                            <form id="deleteForm" method="POST" action="modelos2/delete_cultivos_medicion.php" style="display: inline;">
                                <input type="hidden" name="id_cultivos_medicion" value="<?= $datos->id_cultivos_medicion ?>">
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
        <h5 class="modal-title">EDITAR CULTIVOS MEDICION RESIDUOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="formularioEditar" method="POST" action="modelos2/update_cultivos_medicion.php">
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
                            <label for="id_cultivos_medicion" class="form-label">Id Medicion de Cultivos</label>
                            <input type="text" class="form-control" id="id_cultivos_medicion" name="id_cultivos_medicion" readonly>
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
                              <label for="numero_ficha">Numero de Ficha</label>
                                <input type="text" class="form-control" id="numero_ficha_edit" name="numero_ficha" required>
                        </div>

                        <div class="col-md-6">
                            <label for="id_cultivo" class="form-label">Cultivo</label>
                            <select class="form-control" id="id_cultivo_edit" name="id_cultivo" required>
                                    <?php
                                    // Conexión a la base de datos
                                    include '../php/conexion_be.php';

                                    $sql = "SELECT id_cultivo, cultivo FROM tbl_categorias_cultivo";

                                    // Ejecutar la consulta
                                    $result = mysqli_query($conexion, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    // Genera opciones para cada valor 
                                    echo '<option value="' . $row["id_cultivo"] . '">' . $row["cultivo"] . '</option>';
                                    }
                                    } else {
                                    echo '<option value="">No hay cultivos disponibles</option>';
                                    }

                                    // Cierra la conexión a la base de datos
                                    mysqli_close($conexion);
                                    ?>
                                </select>
                        </div>

                        <div class="col-md-6">
                            <label for="id_criterios_medicion" class="form-label">Criterio de Medicion</label>
                            <select class="form-control" id="id_criterios_medicion_edit" name="id_criterios_medicion" required>
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

          </div>
          <div class="tab-pane fade" id="datosTab">
                       <div class="col-md-6">
                               <label for="total">Total</label>
                                <input type="text" class="form-control" id="total_edit" name="total" required>
                        </div>

                        <div class="col-md-6">
                                <label for="sigla">Sigla</label>
                                <input type="text" class="form-control" id="sigla_edit" name="sigla" required>
                        </div>

                        <div class="col-md-6">
                           <label for="descripcion">Descripción:</label>
                           <input type="text" class="form-control" id="descripcion_edit" name="descripcion" >
                        </div>

                        <div class="col-md-6">
                                <label for="tipo_superficie">Medida Superficie </label>
                                <input type="text" class="form-control" id="tipo_superficie_edit" name="tipo_superficie" required>
                        </div>

                        <div class="col-md-6">
                                <label for="masa_combustible">Masa de Combustible </label>
                                <input type="text" class="form-control" id="masa_combustible_edit" name="masa_combustible" required>
                        </div>

                        <div class="col-md-6">
                                <label for="factor_combustion">Factor Combustion </label>
                                <input type="text" class="form-control" id="factor_combustion_edit" name="factor_combustion" required>
                        </div>

                        <div class="col-md-6">
                                <label for="factor_emision_ch">Factor Emision CH4 </label>
                                <input type="text" class="form-control" id="factor_emision_ch_edit" name="factor_emision_ch" required>
                        </div>

                        <div class="col-md-6">
                                <label for="factor_emision_co">Factor Emision CO </label>
                                <input type="text" class="form-control" id="factor_emision_co_edit" name="factor_emision_co" required>
                        </div>

                        <div class="col-md-6">
                                <label for="factor_emision_n2o">Factor Emision N2O </label>
                                <input type="text" class="form-control" id="factor_emision_n2o_edit" name="factor_emision_n2o" required>
                        </div>

                        <div class="col-md-6">
                                <label for="factor_emision_nox">Factor Emision NOx </label>
                                <input type="text" class="form-control" id="factor_emision_nox_edit" name="factor_emision_nox" required>
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
        <h5 class="modal-title">AGREGAR CULTIVOS MEDICION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="modelos2/insert_cultivos_medicion.php" method="POST">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" href="#fichaTab" data-toggle="tab">Ficha</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#cultivoTab" data-toggle="tab">Cultivo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#emisionesTab" data-toggle="tab">Emisiones</a>
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
                <div class="tab-pane fade" id="cultivoTab">
                <div class="col-md-6">
                                <label for="id_cultivo">Cultivo</label>
                                <select class="form-control" id="id_cultivo" name="id_cultivo" required>
                                    <?php
                                    // Conexión a la base de datos
                                    include '../php/conexion_be.php';

                                    $sql = "SELECT id_cultivo, cultivo FROM tbl_categorias_cultivo";

                                    // Ejecutar la consulta
                                    $result = mysqli_query($conexion, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    // Genera opciones para cada valor 
                                    echo '<option value="' . $row["id_cultivo"] . '">' . $row["cultivo"] . '</option>';
                                    }
                                    } else {
                                    echo '<option value="">No hay cultivos disponibles</option>';
                                    }

                                    // Cierra la conexión a la base de datos
                                    mysqli_close($conexion);
                                    ?>
                                </select>
                        </div>
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
                                <label for="nivel_medicion">Nivel de Medicion </label>
                                <input type="text" class="form-control" id="nivel_medicion" name="nivel_medicion" required>
                            </div>
          </div>
          <div class="tab-pane fade" id="emisionesTab">
                     <div class="col-md-6">
                                <label for="tipo_superficie">Medida Superficie </label>
                                <input type="text" class="form-control" id="tipo_superficie" name="tipo_superficie" required>
                            </div>
                        <div class="col-md-6">
                                <label for="masa_combustible">Masa de Combustible </label>
                                <input type="text" class="form-control" id="masa_combustible" name="masa_combustible" required>
                            </div>
                        <div class="col-md-6">
                                <label for="factor_combustion">Factor Combustion </label>
                                <input type="text" class="form-control" id="factor_combustion" name="factor_combustion" required>
                        </div>
                        <div class="col-md-6">
                                <label for="factor_emision_ch">Factor Emision CH4 </label>
                                <input type="text" class="form-control" id="factor_emision_ch" name="factor_emision_ch" required>
                            </div>
                        <div class="col-md-6">
                                <label for="factor_emision_co">Factor Emision CO </label>
                                <input type="text" class="form-control" id="factor_emision_co" name="factor_emision_co" required>
                            </div>
                        <div class="col-md-6">
                                <label for="factor_emision_n2o">Factor Emision N2O </label>
                                <input type="text" class="form-control" id="factor_emision_n2o" name="factor_emision_n2o" required>
                            </div>
                        <div class="col-md-6">
                                <label for="factor_emision_nox">Factor Emision NOx </label>
                                <input type="text" class="form-control" id="factor_emision_nox" name="factor_emision_nox" required>
                            </div>
                            <div class="col-md-6">
                                <label for="total">Total</label>
                                <input type="text" class="form-control" id="total" name="total" required>
                            </div>
                            <div class="col-md-6">
                                        <label for="sigla">Sigla</label>
                                        <input type="text" class="form-control" id="sigla" name="sigla" required>
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
        <div class="mt-3">
          <button type="submit" class="btn btn-outline-info" name="btnnuevo" value="ok">Crear</button>
          <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
          </form>
      </div>
    </div>
  </div>
</div>

<!--Fin Modal Crear -->

<!-- JavaScript para manejar la edición de usuarios -->
<script>
    // Función para abrir el modal de edición
    function abrirModalEditar(id_cultivos_medicion, id_ficha, id_categoria_ficha, nivel_medicion, id_sector, anio, numero_ficha, id_cultivo, id_criterios_medicion, total, sigla, descripcion, tipo_superficie, masa_combustible, factor_combustion ,factor_emision_ch, factor_emision_co , factor_emision_n2o , factor_emision_nox, emision_ch, emision_co , emision_n2o , emision_nox ,actualizado_por, estado) {
        document.getElementById("id_cultivos_medicion").value = id_cultivos_medicion;
        document.getElementById("id_ficha_edit").value = id_ficha;
        document.getElementById("id_categoria_ficha_edit").value = id_categoria_ficha;
        document.getElementById("nivel_medicion_edit").value = nivel_medicion;
        document.getElementById("id_sector_edit").value = id_sector;
        document.getElementById("anio").value = anio;
        document.getElementById("numero_ficha_edit").value = numero_ficha;
        document.getElementById("id_cultivo_edit").value = id_cultivo;
        document.getElementById("id_criterios_medicion_edit").value = id_criterios_medicion;
        document.getElementById("total_edit").value = total;
        document.getElementById("sigla_edit").value = sigla;
        document.getElementById("descripcion_edit").value = descripcion;
        document.getElementById("tipo_superficie_edit").value = tipo_superficie;
        document.getElementById("masa_combustible_edit").value = masa_combustible;
        document.getElementById("factor_combustion_edit").value = factor_combustion;
        document.getElementById("factor_emision_ch_edit").value = factor_emision_ch;
        document.getElementById("factor_emision_co_edit").value = factor_emision_co;
        document.getElementById("factor_emision_n2o_edit").value = factor_emision_n2o;
        document.getElementById("factor_emision_nox_edit").value = factor_emision_nox;
        document.getElementById("emision_ch_edit").value = emision_ch;
        document.getElementById("emision_co_edit").value = emision_co;
        document.getElementById("emision_n2o_edit").value = emision_n2o;
        document.getElementById("emision_nox_edit").value = emision_nox;
        document.getElementById("actualizado_por_edit").value = actualizado_por;
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
                url: "modelos2/update_cultivos_medicion.php",
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