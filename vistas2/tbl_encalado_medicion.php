<?php 
session_start();
 $_SESSION['url'] = 'vistas2/tbl_encalado_medicion.php';
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
            <h1 class="poppins-font mb-2">Encalado Medicion</h1>
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
                    <th scope="col">Id Encalado Medicion</th>
                    <th scope="col">Ficha</th>
                    <th scope="col">Categoria Ficha</th>
                    <th scope="col">Nivel Medicion</th>
                    <th scope="col">Tipo Cal</th>
                    <th scope="col">Sector</th>
                    <th scope="col">Año</th>
                    <th scope="col">Numero Ficha</th>
                    <th scope="col">Criterio Medicion</th>
                    <th scope="col">Sigla</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Codigo Categoria</th>
                    <th scope="col">Hoja</th>
                    <th scope="col">Referencia</th>
                    <th scope="col">Cantidad Piedra Caliza</th>
                    <th scope="col">Factor Piedra Caliza</th>
                    <th scope="col">Cantidad Dolomita</th>
                    <th scope="col">Factor Dolomita</th>
                    <th scope="col">Emision CO2 Piedra Caliza</th>
                    <th scope="col">Emision CO2 Dolomita</th>
                    <th scope="col">Creado Por</th>
                    <th scope="col">Fecha Creacion</th>
                    <th scope="col">Actualizado Por</th>
                    <th scope="col">Fecha Actualizacion</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th> <!-- Added text-center class here -->
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                include "../php/conexion_be.php";
                $sql = $conexion->query("SELECT tbl_encalado_medicion_n.id_encalado_medicion, tbl_fichas.id_ficha, tbl_categorias_fichas.categoria_ficha, tbl_encalado_medicion_n.nivel_medicion, tbl_tipos_cal_n.tipo_cal, tbl_sector.sector, tbl_encalado_medicion_n.anio, tbl_encalado_medicion_n.numero_ficha, tbl_criterio_medicion.criterio_medicion, tbl_encalado_medicion_n.sigla, tbl_encalado_medicion_n.descripcion, tbl_encalado_medicion_n.cantidad_anual_pc, tbl_encalado_medicion_n.factor_pc, tbl_encalado_medicion_n.cantidad_anual_dolomita, tbl_encalado_medicion_n.factor_dolomita, tbl_encalado_medicion_n.emision_co_pc, tbl_encalado_medicion_n.creado_por, tbl_encalado_medicion_n.fecha_creacion, tbl_encalado_medicion_n.actualizado_por, tbl_encalado_medicion_n.fecha_actualizacion, tbl_encalado_medicion_n.estado, tbl_encalado_medicion_n.codigo_categoria, tbl_encalado_medicion_n.hoja, tbl_encalado_medicion_n.referencia, tbl_encalado_medicion_n.emision_co_dolomita
                FROM tbl_encalado_medicion_n INNER JOIN tbl_fichas ON tbl_encalado_medicion_n.id_ficha = tbl_fichas.id_ficha INNER JOIN tbl_categorias_fichas ON tbl_encalado_medicion_n.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha INNER JOIN tbl_sector ON tbl_encalado_medicion_n.id_sector = tbl_sector.id_sector INNER JOIN tbl_tipos_cal_n ON tbl_encalado_medicion_n.id_tipo_cal = tbl_tipos_cal_n.id_tipo_cal INNER JOIN tbl_criterio_medicion ON tbl_encalado_medicion_n.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion");
                while ($datos = $sql->fetch_object()) { ?>
                    <tr>
                        <td><?= $datos->id_encalado_medicion ?></td>
                        <td><?= $datos->id_ficha ?></td>
                        <td><?= $datos->categoria_ficha ?></td>
                        <td><?= $datos->nivel_medicion ?></td>
                        <td><?= $datos->tipo_cal?></td>
                        <td><?= $datos->sector?></td>
                        <td><?= $datos->anio ?></td>
                        <td><?= $datos->numero_ficha?></td>
                        <td><?= $datos->criterio_medicion ?></td>
                        <td><?= $datos->sigla?></td>
                        <td><?= $datos->descripcion?></td>
                        <td><?= $datos->codigo_categoria?></td>
                        <td><?= $datos->hoja?></td>
                        <td><?= $datos->referencia?></td>
                        <td><?= $datos->cantidad_anual_pc?></td>
                        <td><?= $datos->factor_pc?></td>
                        <td><?= $datos->cantidad_anual_dolomita?></td>
                        <td><?= $datos->factor_dolomita?></td>
                        <td><?= $datos->emision_co_pc?></td>
                        <td><?= $datos->emision_co_dolomita?></td>
                        <td><?= $datos->creado_por?></td>
                        <td><?= $datos->fecha_creacion?></td>
                        <td><?= $datos->actualizado_por?></td>
                        <td><?= $datos->fecha_actualizacion?></td>
                        <td><?php
                            if ($datos->estado == "ACTIVO") {
                                echo '<span class="badge bg-success">Activo</span>';
                            } else {
                                echo '<span class="badge bg-danger">Inactivo</span>';
                            }
                            ?></td>
                        <td>
                            <button type="button" class="btn btn-editar" data-toggle="modal" data-target="#modalEditar" onclick="abrirModalEditar
                            ('<?= $datos->id_encalado_medicion ?>', '<?= $datos->id_ficha ?>', '<?= $datos->categoria_ficha ?>', '<?= $datos->nivel_medicion ?>', '<?= $datos->tipo_cal ?>', '<?= $datos->sector ?>', '<?= $datos->anio ?>', '<?= $datos->numero_ficha ?>', '<?= $datos->criterio_medicion ?>', '<?= $datos->sigla ?>', '<?= $datos->descripcion ?>', '<?= $datos->codigo_categoria ?>', '<?= $datos->hoja ?>', '<?= $datos->referencia ?>' ,'<?= $datos->cantidad_anual_pc ?>', '<?= $datos->factor_pc ?>', '<?= $datos->cantidad_anual_dolomita ?>', '<?= $datos->factor_dolomita ?>', '<?= $datos->emision_co_pc ?>', '<?= $datos->emision_co_dolomita ?>', '<?= $datos->creado_por ?>', '<?= $datos->fecha_creacion ?>', '<?= $datos->actualizado_por ?>'  ,'<?= $datos->fecha_actualizacion ?>', '<?= $datos->estado ?>' )">
                                <i class="bi bi-pencil-square"></i>
                                Editar
                            </button>
                            <form id="deleteForm" method="POST" action="modelos2/delete_encalado_medicion.php" style="display: inline;">
                                <input type="hidden" name="id_encalado_medicion" value="<?= $datos->id_encalado_medicion ?>">
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
        <table>
        <thead class="table-dark text-center" style="background-color: #343A40;">
        <tr>
        <th scope="col">Totales</th>

        </tr>
        </thead>

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
        <h5 class="modal-title">EDITAR 3C2 ENCALADO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="formularioEditar" method="POST" action="modelos2/update_encalado_medicion.php">
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
                        <label for="id_encalado_medicion" class="form-label">Id Encalado Medicion</label>
                                <input type="text" class="form-control" id="id_encalado_medicion" name="id_encalado_medicion" readonly>
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
                            <label for="id_tipo_cal" class="form-label">Tipo de Cal</label>
                            <select class="form-control" id="id_tipo_cal_edit" name="id_tipo_cal" required>
        <?php
        // Conexión a la base de datos
        include '../php/conexion_be.php';

        // Consulta SQL para obtener los valores disponibles de ID y Nombre del sistema
        $sql = "SELECT id_tipo_cal, tipo_cal FROM tbl_tipos_cal_n";

        // Ejecutar la consulta
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Genera opciones con el nombre del sistema como etiqueta y el ID como valor
                echo '<option value="' . $row["id_tipo_cal"] . '">' . $row["tipo_cal"] . '</option>';
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
                            <label for="anio" class="form-label">Año</label>
                            <input type="text" class="form-control" id="anio_edit" name="anio">
                        </div>

                        <div class="col-md-6">
                              <label for="numero_ficha">Numero de Ficha</label>
                                <input type="text" class="form-control" id="numero_ficha_edit" name="numero_ficha" required>
                        </div>

                        <div class="col-md-6">
                            <label for="id_criterios_medicion" class="form-label">Criterio de Medicion</label>
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


          </div>
          <div class="tab-pane fade" id="datosTab">
                       <div class="col-md-6">
                       <label for="sigla" class="form-label">Sigla</label>
                                <input type="text" class="form-control" id="sigla_edit" name="sigla" required>
                        </div>

                        <div class="col-md-6">
                        <label for="descripcion" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" id="descripcion_edit" name="descripcion">
                        </div>

                        <div class="col-md-6">
                        <label for="codigo_categoria" class="form-label">Codigo Categoria</label>
                                <input type="text" class="form-control" id="codigo_categoria_edit" name="codigo_categoria" required>
                        </div>

                        <div class="col-md-6">
                        <label for="hoja" class="form-label">Hoja</label>
                                <input type="text" class="form-control" id="hoja_edit" name="hoja" required>
                        </div>

                        <div class="col-md-6">
                        <label for="referencia" class="form-label">Referencia</label>
                                <input type="text" class="form-control" id="referencia_edit" name="referencia" required>
                        </div>

                        <div class="col-md-6">
                        <label for="cantidad_anual_pc" class="form-label">Cantidad Anual Piedra Caliza</label>
                                <input type="text" class="form-control" id="cantidad_anual_pc_edit" name="cantidad_anual_pc" >
                        </div>

                        <div class="col-md-6">
                        <label for="factor_pc" class="form-label">Factor Emisión Piedra Caliza</label>
                                <input type="text" class="form-control" id="factor_pc_edit" name="factor_pc">
                        </div>

                        <div class="col-md-6">
                        <label for="cantidad_anual_dolomita" class="form-label">Cantidad Anual Dolomita</label>
                                <input type="text" class="form-control" id="cantidad_anual_dolomita_edit" name="cantidad_anual_dolomita" >
                        </div>

                        <div class="col-md-6">
                        <label for="factor_dolomita" class="form-label">Factor Emisión Dolomita</label>
                                <input type="text" class="form-control" id="factor_dolomita_edit" name="factor_dolomita">
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
        <h5 class="modal-title">AGREGAR ENCALADO MEDICION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="modelos2/insert_encalado_medicion.php" method="POST">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" href="#fichaTab" data-toggle="tab">Ficha</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#encaladoTab" data-toggle="tab">Encalado</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#cantidadesTab" data-toggle="tab">Cantidades</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="fichaTab">
          <div class="col-md-6">
                            <label for="anio" class="form-label">Año</label>
                            <input type="text" class="form-control" id="anio" name="anio" required>
                            </div>
          <div class="col-md-6">
                                <label for="id_ficha">Ficha</label>
                                <select class="form-control" id="id_ficha" name="id_ficha" required>
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
                    <label for="id_categoria_ficha">Categoria Ficha</label>
                                <select class="form-control" id="id_categoria_ficha" name="id_categoria_ficha" required>
                                <?php
                                // Conexión a la base de datos
                                include '../php/conexion_be.php';

                                // Consulta SQL para obtener los valores disponibles de ID y Nombre de categoria
                                $sql = "SELECT id_categoria_ficha, categoria_ficha FROM tbl_categorias_fichas";

                                // Ejecutar la consulta
                                $result = mysqli_query($conexion, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // Genera opciones con el nombre de la categoria como etiqueta y el ID como valor
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
                                <label for="numero_ficha" class="form-label">Numero Ficha</label>
                                <input type="text" class="form-control" id="numero_ficha" name="numero_ficha" required>
                            </div>
                            <div class="col-md-6">
                              <label for="id_sector">Sector</label>
                                <select class="form-control" id="id_sector" name="id_sector" required>
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
          </div>
          <div class="tab-pane fade" id="encaladoTab">
          <div class="col-md-6">
                    <label for="id_tipo_cal">Tipo Cal</label>
                                <select class="form-control" id="id_tipo_cal" name="id_tipo_cal" required>
                                    <?php
                                    // Conexión a la base de datos
                                    include '../php/conexion_be.php';

                                    // Consulta SQL para obtener los valores disponibles de ID y Nombre del sistema
                                    $sql = "SELECT id_tipo_cal, tipo_cal FROM tbl_tipos_cal_n";

                                    // Ejecutar la consulta
                                    $result = mysqli_query($conexion, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            // Genera opciones con el nombre del sistema como etiqueta y el ID como valor
                                            echo '<option value="' . $row["id_tipo_cal"] . '">' . $row["tipo_cal"] . '</option>';
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
                                <label for="id_criterios_medicion">Criterio Medicion</label>
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
          <div class="tab-pane fade" id="cantidadesTab">
          <div class="col-md-6">
                                <label for="cantidad_anual_pc" class="form-label">Cantidad Anual Piedra Caliza</label>
                                <input type="text" class="form-control" id="cantidad_anual_pc" name="cantidad_anual_pc">
                            </div>
                            <div class="col-md-6">
                                <label for="factor_pc" class="form-label">Factor Emisión Piedra Caliza</label>
                                <input type="text" class="form-control" id="factor_pc" name="factor_pc">
                            </div>
                            <div class="col-md-6">
                                <label for="cantidad_anual_dolomita" class="form-label">Cantidad Anual Dolomita</label>
                                <input type="text" class="form-control" id="cantidad_anual_dolomita" name="cantidad_anual_dolomita">
                            </div>
                            <div class="col-md-6">
                                <label for="factor_dolomita" class="form-label">Factor Emisión Dolomita</label>
                                <input type="text" class="form-control" id="factor_dolomita" name="factor_dolomita">
                            </div>
                            <div class="col-md-6">
                                <label for="codigo_categoria" class="form-label">Codigo Categoria</label>
                                <input type="text" class="form-control" id="codigo_categoria" name="codigo_categoria" required>
                            </div>
                            <div class="col-md-6">
                                <label for="hoja" class="form-label">Hoja</label>
                                <input type="text" class="form-control" id="hoja" name="hoja" required>
                            </div>
                            <div class="col-md-6">
                                <label for="referencia" class="form-label">Referencia</label>
                                <input type="text" class="form-control" id="referencia" name="referencia" required>
                            </div>
                            <div class="col-md-6">
                                <label for="sigla" class="form-label">Sigla</label>
                                <input type="text" class="form-control" id="sigla" name="sigla" required>
                            </div>
                            <div class="col-md-6">
                                <label for="descripcion" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" required  style="height: 100px; overflow-y: scroll; resize: none;">
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

<!-- JavaScript para manejar la edición de usuarios -->
<script>
    // Función para abrir el modal de edición
    function abrirModalEditar(id_encalado_medicion, id_ficha, id_categoria_ficha, nivel_medicion, id_tipo_cal, id_sector, anio, numero_ficha, id_criterios_medicion, sigla, descripcion, codigo_categoria, hoja, referencia ,cantidad_anual_pc, factor_pc, cantidad_anual_dolomita, factor_dolomita , emision_co_pc , emision_co_dolomita , creado_por , fecha_creacion , actualizado_por , fecha_actualizacion ,estado) {
        document.getElementById("id_encalado_medicion").value = id_encalado_medicion;
        document.getElementById("id_ficha_edit").value = id_ficha;
        document.getElementById("id_categoria_ficha_edit").value = id_categoria_ficha;
        document.getElementById("nivel_medicion_edit").value = nivel_medicion;
        document.getElementById("id_tipo_cal_edit").value = id_tipo_cal;
        document.getElementById("id_sector_edit").value = id_sector;
        document.getElementById("anio_edit").value = anio;
        document.getElementById("numero_ficha_edit").value = numero_ficha;
        document.getElementById("id_criterios_medicion_edit").value = id_criterios_medicion;
        document.getElementById("sigla_edit").value = sigla;
        document.getElementById("descripcion_edit").value = descripcion;
        document.getElementById("codigo_categoria_edit").value = codigo_categoria;
        document.getElementById("hoja_edit").value = hoja;
        document.getElementById("referencia_edit").value = referencia;
        document.getElementById("cantidad_anual_pc_edit").value = cantidad_anual_pc;
        document.getElementById("factor_pc_edit").value = factor_pc;
        document.getElementById("cantidad_anual_dolomita_edit").value = cantidad_anual_dolomita;
        document.getElementById("factor_dolomita_edit").value = factor_dolomita;
        document.getElementById("emision_co_pc").value = emision_co_pc;
        document.getElementById("emision_co_dolomita").value = emision_co_dolomita;
        document.getElementById("creado_por").value = creado_por;
        document.getElementById("fecha_creacion").value = fecha_creacion;
        document.getElementById("actualizado_por").value = actualizado_por;
        document.getElementById("fecha_actualizacion").value = fecha_actualizacion;
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
                url: "modelos2/update_encalado_medicion.php",
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
                            title: "Registro Actualizado Correctamente",
                            text: "El Registro se ha Actualizado Correctamente.",
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