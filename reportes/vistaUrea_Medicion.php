<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/estilos.css">
<link rel="stylesheet" href="../assets/css/estilos1.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?php
session_start();
$_SESSION['url'] = '../bienvenida.php';
$_SESSION['content-wrapper'] = 'content-wrapper';
 $conexion = mysqli_connect("localhost", "root","", "bd_cc");
////////////////// VARIABLES DE CONSULTA////////////////////////////////////

$where="";
$anio=isset($_POST['xanio']) ? $_POST['xanio'] : null;


////////////////////// BOTON BUSCAR //////////////////////////////////////

if (isset($_POST['buscar']))
{

	if (!empty($_POST['xanio']))
	{
		$where="where anio='".$anio."'";
	}

}
/////////////////////// CONSULTA A LA BASE DE DATOS ////////////////////////

$fermentacion="SELECT tbl_urea_medicion.id_urea_medicion, tbl_fichas.id_ficha, tbl_categorias_fichas.categoria_ficha, tbl_sector.sector, tbl_urea_medicion.codigo_categoria ,tbl_urea_medicion.hoja, tbl_urea_medicion.referencia, tbl_sub_categorias_urea.categoria_urea, tbl_urea_medicion.anio, tbl_urea_medicion.numero_ficha, tbl_criterio_medicion.criterio_medicion, tbl_urea_medicion.sigla, tbl_urea_medicion.descripcion, tbl_urea_medicion.fertilizacion_urea, tbl_urea_medicion.factor_urea, tbl_urea_medicion.emisiones_urea, tbl_urea_medicion.total, tbl_urea_medicion.creado_por, tbl_urea_medicion.fecha_creacion, tbl_urea_medicion.actualizado_por, tbl_urea_medicion.fecha_actualizacion, tbl_urea_medicion.estado 
FROM tbl_urea_medicion INNER JOIN tbl_fichas ON tbl_urea_medicion.id_ficha = tbl_fichas.id_ficha INNER JOIN tbl_categorias_fichas ON tbl_urea_medicion.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha INNER JOIN tbl_sector ON tbl_urea_medicion.id_sector = tbl_sector.id_sector INNER JOIN tbl_sub_categorias_urea ON tbl_urea_medicion.id_subcategoria_urea = tbl_sub_categorias_urea.id_subcategoria_urea INNER JOIN tbl_criterio_medicion ON tbl_urea_medicion.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion $where";
$resfer=$conexion->query($fermentacion);
$consultaAnios = "SELECT DISTINCT anio FROM tbl_urea_medicion";
$resultadoAnios = $conexion->query($consultaAnios);


if(mysqli_num_rows($resultadoAnios)==0)
{
	$mensaje="<h1>No hay registros que coincidan con su criterio de búsqueda.</h1>";
}
?>
<html lang="es">

	<head>
		<title>Reporte Urea Medicion</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

		<link href="css/estilos.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/estilos1.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <div class="containertable">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="poppins-font mb-2">Reporte Urea Medicion</h1>
            <br>
        </div>

     <!--  descargar excel -->
     <div class="center-vertical">
            <button type="button" class="btn btn-success custom-btn" id="excelButton">Generar Reporte</button>
            <button type="button" class="btn btn-primary custom-btn" id="generarReporteButton">Generar Resumen</button>
            </div>

          
                <button class="custom-btn btn-primary" style="position: absolute; top: 0; right: 0;" id="regresarButton">
                    Regresar
                </button>
               
              
             <script>
        document.getElementById("regresarButton").addEventListener("click", function() {
            // Redirigir a excel.php al hacer clic en el botón de Excel
            window.location.href = "../bienvenida.php";
        });
    </script>

            <!--  fin de descargar -->

             <script>
        document.getElementById("excelButton").addEventListener("click", function() {
            // Redirigir a excel.php al hacer clic en el botón de Excel
            window.location.href = "urea_medicion_reporte.php";
        });
    </script>
       <script>
        document.getElementById("generarReporteButton").addEventListener("click", function() {
            // Redirigir a excel.php al hacer clic en el botón de Excel
            window.location.href = "Reporte_tendencia_urea.php";
        });
    </script>

                
	</head>
	<body>
		<header>
			<h2> </h2>
			</div>
		</header>
		<section>
        <form method="post">
            <select name="xanio">
                <option value="">Año </option>
                <?php
                    while ($registroAnios = $resultadoAnios->fetch_assoc()) {
                        echo '<option value="'.$registroAnios['anio'].'">'.$registroAnios['anio'].'</option>';
                    }
                ?>
            </select>
            <input type="hidden" name="xanio_hidden" id="xanio_hidden"> <!-- Nuevo campo oculto -->
            <button name="buscar" type="submit" id="buscarButton">Buscar</button>
        </form>

			<table class="table">
				<tr>
                    <th scope="col" class="header-cell">Año</th>
                    <th scope="col" class="header-cell">Urea Medición</th>
					<th scope="col" class="header-cell">Sub-Categorias por año de reporte</th>
                    <th scope="col" class="header-cell">Cantidad Anual de Fertilizacion con urea</th>
                    <th scope="col" class="header-cell">Factor de Emision</th>
                    <th scope="col" class="header-cell">Emisiones de CO2 por Aplicacion de Urea</th>                    
				</tr>

				<?php
                $totalEmisionesUrea = 0;
                

				while ($selectfer = $resfer->fetch_assoc()) {
                    $totalEmisionesUrea += $selectfer['emisiones_urea'];
                    

					echo'<tr>
                            <td>'.$selectfer['anio'].'</td>
                            <td>'.$selectfer['id_urea_medicion'].'</td>
                            <td>'.$selectfer['categoria_urea'].'</td>
                            <td>'.$selectfer['fertilizacion_urea'].'</td>
                            <td>'.$selectfer['factor_urea'].'</td>
                            <td>'.$selectfer['emisiones_urea'].'</td>
						 </tr>';
                            
				}
				?>
                
                <tr>
                    <td colspan="5">Totales</td>
                    <td><?= $totalEmisionesUrea ?></td>
                </tr>
			</table>
            
			<?
				echo $mensaje;
			?>
		</section>
	</body>
</html>