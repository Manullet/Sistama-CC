<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/tbl_fermentacion_estiercol_documentacion.css">



<style>.icono-grande {
            font-size: 20px;
            margin-right: 10px; 
        }</style>
<div class="containertable">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div >
            <h1 class="poppins-font mb-2">FERMENTACIÓN ESTIÉRCOL RESUMEN</h1>
            <br>

        </div>
        <br>
        
        
        <div class="mb-4 border-bottom">
            <form class="d-flex" role="search">
                <div class="input-group">
                    <div class="input-group-prepend" title="Buscar">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                    <input class="form-control" id="searchInput" type="search" placeholder="Buscar..." aria-label="Search">
                </div>
            </form>
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
                    <th scope="col">Id Ficha</th>
                    <th scope="col">Id Categoria Ficha</th>
                    <th scope="col">Nivel Medición</th>
                    <th scope="col">Id Fermentación</th>
                    <th scope="col">Id Sector</th>
                    <th scope="col">Año</th>
                    <th scope="col">Categoria Medición</th>
                    <th scope="col">Equivalente</th>
                    <th scope="col">Descripción Equivalente</th>
                    <th scope="col">Variación</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                include "../php/conexion_be.php";
                $sql = $conexion->query("SELECT * FROM tbl_fermentacion_estiercol_resumen");
                while ($datos = $sql->fetch_object()) { ?>
                    <tr>
                        <!--  AQUI PONEN SUS VARIABLES COMO ESTAN EN LA BASE DE DATOS    -->
                        <td><?= $datos->id_ficha ?></td>
                        <td><?= $datos->id_categoria_ficha ?></td>
                        <td><?= $datos->nivel_medicion?></td>
                        <td><?= $datos->id_fermentacion?></td>
                        <td><?= $datos->id_sector?></td>
                        <td><?= $datos->anio?></td>
                        <td><?= $datos->categoria_medicion?></td>
                        <td><?= $datos->equivalente?></td>
                        <td><?= $datos->descripcion_equivalente?></td>
                        <td><?= $datos->variacion ?></td>
                        
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