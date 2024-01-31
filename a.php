<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/tbl_sector.css">



<style>.icono-grande {
            font-size: 20px;
            margin-right: 10px; 
        }</style>
<div class="containertable">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div >
            <h1 class="poppins-font mb-2">CATEGORIA FICHAS</h1>
            <br>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#miModal">
            <i class="bi bi-plus-square icono-grande"></i> Agregar Categoria
            </a>
        </div>
        <br>
        
        
        <div class="mb-4 border-bottom">
            <form class="d-flex" role="search">
                <div class="input-group">
                    <div class="input-group-prepend" title="Buscar">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                    <input class="form-control" id="searchInput" type="search" placeholder="Buscar Categoria..." aria-label="Search">
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="modelos/insert_categoriaFichas.php">
                        <div class="form-group">
                            <label for="id_sector">ID Sector:</label>
                            <select class="form-control" id="id_sector" name="id_sector" required>
                                <?php
                                // Conexión a la base de datos
                                include '../php/conexion_be.php';

                                // Consulta SQL para obtener los valores disponibles de id_sector desde tbl_sector
                                $sql = "SELECT id_sector FROM tbl_sector";

                                // Ejecutar la consulta
                                $result = mysqli_query($conexion, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                // Genera opciones para cada valor de id_sector
                                echo '<option value="' . $row["id_sector"] . '">' . $row["id_sector"] . '</option>';
                                }
                                } else {
                                echo '<option value="">No hay sectores disponibles</option>';
                                }

                                // Cierra la conexión a la base de datos
                                mysqli_close($conexion);
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_ficha">ID Ficha:</label>
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
                        <div class="form-group">
                            <label for="categoria_ficha">Categoria Ficha:</label>
                            <input type="text" class="form-control" id="categoria_ficha" name="categoria_ficha" required>
                        </div>
                        <div class="form-group">
                            <label for="codigo_categoriaficha">Código Categoria Ficha:</label>
                            <input type="text" class="form-control" id="codigo_categoriaficha" name="codigo_categoriaficha" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                        </div>
                        <div class="form-group">
                            <label for="hoja">Hoja:</label>
                            <input type="text" class="form-control" id="hoja" name="hoja" required>
                        </div>
                        <div class="form-group">
                            <label for="referencia">Referencia:</label>
                            <input type="text" class="form-control" id="referencia" name="referencia" required>
                        </div>
                        <div class="form-group">
                            <label for="formula">Formula:</label>
                            <input type="text" class="form-control" id="formula" name="formula" required>
                        </div>
                        <div class="form-group">
                            <label for="creado_por">Creado Por:</label>
                            <input type="text" class="form-control" id="creado_por" name="creado_por" required>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

            <!--  descargar excel -->
            <div class="center-vertical">
            <button type="button" class="btn btn-danger" id="pdfButton">PDF</button>
            <button type="button" class="btn btn-success" id="excelButton">EXCEL</button>
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



         <!--  seleccion de registros -->
         <div class="formulario-registros">
            <label for="cantidadRegistros" style="margin-right: 60px;">Mostrar
            <select id="cantidadRegistros">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
            </select>
            <span class="registros-text">Registros</span></label>
        </div>
           <!--  funcion para mostrar registros --> 
        <script>
            // Obtiene referencias a los elementos HTML
         const selectCantidadRegistros = document.getElementById("cantidadRegistros");

         selectCantidadRegistros.addEventListener("change", function() {
         const cantidadSeleccionada = parseInt(selectCantidadRegistros.value);
        console.log(`Se seleccionaron ${cantidadSeleccionada} registros.`);
    });
</script>

        <!--  fin  -->

    <div class="table-responsive">
        <!--  tipo de clase de la tabla  -->
        <table  class="table table-bordered">
            <thead class="text-center" style="background-color: #AED4F3;">
                <tr>
                    <!--  AQUI PONEN LAS CABECERAS DE SU TABLA  -->
                    <th scope="col">Id Sector</th>
                    <th scope="col">Id Ficha</th>
                    <th scope="col">Id Categoria Ficha</th>
                    <th scope="col">Categoria Ficha</th>
                    <th scope="col">Codigo Categoria Ficha</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Hoja</th>
                    <th scope="col">Referencia</th>
                    <th scope="col">Formula</th>
                    <th scope="col">Creado Por</th>
                    <th scope="col">Fecha Creacion</th>
                    <th scope="col">Actualizado Por</th>
                    <th scope="col">Fecha Actualizacion</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                include "../php/conexion_be.php";
                $sql = $conexion->query("SELECT * FROM tbl_categorias_fichas ");
                while ($datos = $sql->fetch_object()) { ?>
                    <tr>
                        <!--  AQUI PONEN SUS VARIABLES COMO ESTAN EN LA BASE DE DATOS    -->
                        <td><?= $datos->id_sector ?></td>
                        <td><?= $datos->id_ficha ?></td>
                        <td><?= $datos->id_categoria_ficha ?></td>
                        <td><?= $datos->categoria_ficha?></td>
                        <td><?= $datos->codigo_categoriaficha?></td>
                        <td><?= $datos->descripcion ?></td>
                        <td><?= $datos->hoja?></td>
                        <td><?= $datos->referencia ?></td>
                        <td><?= $datos->formula?></td>
                        <td><?= $datos->creado_por?></td>
                        <td><?= $datos->fecha_creacion?></td>
                        <td><?= $datos->actualizado_por?></td>
                        <td><?= $datos->fecha_actualizacion?></td>
                        <td><?= $datos->estado?></td>
                        <td class="actions-column">
                        <button class="btn btn-primary btn-editar" data-toggle="modal" data-target="#modalEditar" onclick="abrirModalEditar('<?= $datos->id_sector ?>', '<?= $datos->id_ficha ?>', '<?= $datos->id_categoria_ficha ?>', '<?= $datos->categoria_ficha ?>', '<?= $datos->codigo_categoriaficha ?>', '<?= $datos->descripcion ?>', '<?= $datos->hoja ?>', '<?= $datos->referencia ?>', '<?= $datos->formula ?>', '<?= $datos->creado_por ?>', '<?= $datos->fecha_creacion ?>', '<?= $datos->actualizado_por ?>', '<?= $datos->fecha_actualizacion ?>', '<?= $datos->estado ?>')">
                        <i class="bi bi-pencil-square" ></i>
                    </button>
                                <form method="POST" action="../SISTEMA-CC/modelos/delete_categoriaFichas.php" style="display: inline;">
                                <input type="hidden" name="id_categoria_ficha" value="<?= $datos->id_categoria_ficha ?>">
                                <button type="submit" class="btn btn-danger btn-eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                <i class="bi bi-x-circle-fill" ></i>
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

<!-- Modal para editar usuarios -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Agregar un atributo data-* para pasar los datos desde la fila a la función abrirModalEditar -->

            <!-- ... -->

            <!-- Dentro del modal, ajusta los campos para reflejar los nombres de las variables y sus valores -->
            <div class="modal-body">
                <form id="formularioEditar" method="POST" action="modelos/update_categoriaFichas.php">
                <div class="form-group">
                        <label for="id_sector">Id Sector:</label>
                        <input type="text" class="form-control" id="id_sector" name="id_sector" readonly>
                    </div>
                    <div class="form-group">
                        <label for="id_ficha">Id Ficha:</label>
                        <input type="text" class="form-control" id="id_ficha" name="id_ficha" readonly>
                    </div>
                    <div class="form-group">
                        <label for="id_categoria_ficha">Id Categoria Ficha:</label>
                        <input type="text" class="form-control" id="id_categoria_ficha" name="id_categoria_ficha" readonly>
                    </div>
                    <div class="form-group">
                        <label for="categoria_ficha">Categoria Ficha:</label>
                        <input type="text" class="form-control" id="categoria_ficha" name="categoria_ficha" required>
                    </div>
                    <div class="form-group">
                        <label for="codigo_categoriaficha">Codigo Categoria Ficha:</label>
                        <input type="text" class="form-control" id="codigo_categoriaficha" name="codigo_categoriaficha" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripcion:</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                    </div>
                    <div class="form-group">
                        <label for="hoja">Hoja:</label>
                        <input type="text" class="form-control" id="hoja" name="hoja" required>
                    </div>
                    <div class="form-group">
                        <label for="referencia">Referencia:</label>
                        <input type="text" class="form-control" id="referencia" name="referencia" required>
                    </div>
                    <div class="form-group">
                        <label for="formula">Formula:</label>
                        <input type="text" class="form-control" id="formula" name="formula" required>
                    </div>
                    <div class="form-group">
                        <label for="actualizado_por">Actualizado Por:</label>
                        <input type="text" class="form-control" id="actualizado_por" name="actualizado_por" required>
                    </div>
                    <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal de éxito -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Categoria actualizada correctamente</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>La Categoria se ha actualizado correctamente.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <a href="../index.php" class="btn btn-primary">Ir a la página principal</a>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para manejar la edición de usuarios -->
<script>
    // Función para abrir el modal de edición
    function abrirModalEditar(id_sector, id_ficha, id_categoria_ficha, categoria_ficha, codigo_categoriaficha, descripcion, hoja, referencia, formula, creado_por, fecha_creacion, actualizado_por, fecha_actualizacion, estado) {
        document.getElementById("id_sector").value = id_sector; 
        document.getElementById("id_ficha").value = id_ficha;
        document.getElementById("id_categoria_ficha").value = id_categoria_ficha;
        document.getElementById("categoria_ficha").value = categoria_ficha;
        document.getElementById("codigo_categoriaficha").value = codigo_categoriaficha;
        document.getElementById("descripcion").value = descripcion;
        document.getElementById("hoja").value = hoja;
        document.getElementById("referencia").value = referencia;
        document.getElementById("formula").value = formula;
        document.getElementById("creado_por").value = creado_por;
        document.getElementById("fecha_creacion").value = fecha_creacion;
        document.getElementById("actualizado_por").value = actualizado_por;
        document.getElementById("fecha_actualizacion").value = fecha_actualizacion;
        document.getElementById("estado").value = estado;


        $('#modalEditar').modal('show'); // Mostrar el modal de edición
    }
</script>

<!-- Código JavaScript para mostrar el modal de éxito después de actualizar -->
<?php
if (isset($_GET['success']) && $_GET['success'] === 'true') {
    echo '<script>
                    $(document).ready(function(){
                        $("#myModal").modal("show");
                    });
                  </script>';
}
?>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>