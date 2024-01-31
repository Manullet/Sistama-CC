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

$fermentacion="SELECT tbl_fermentacion_estiercol.id_fermentacion, tbl_fichas.id_ficha, tbl_categorias_fichas.categoria_ficha, tbl_fermentacion_estiercol.nivel_medicion, tbl_sector.sector, tbl_fermentacion_estiercol.anio, tbl_fermentacion_estiercol.numero_ficha, tbl_categorias_especies.categoria_especie, tbl_especie.especie, tbl_fermentacion_estiercol.categoria_medicion, tbl_criterio_medicion.criterio_medicion, tbl_fermentacion_estiercol.cantidad_especie, tbl_fermentacion_estiercol.descripcion, tbl_fermentacion_estiercol.sigla, tbl_fermentacion_estiercol.creado_por, tbl_fermentacion_estiercol.fecha_creacion, tbl_fermentacion_estiercol.actualizado_por, tbl_fermentacion_estiercol.fecha_actualizacion, tbl_fermentacion_estiercol.estado, tbl_fermentacion_estiercol.total_fermentacion, tbl_fermentacion_estiercol.total_estiercol, tbl_fermentacion_estiercol.factor_fermentacion, tbl_fermentacion_estiercol.factor_estiercol
FROM tbl_fermentacion_estiercol INNER JOIN tbl_sector ON tbl_fermentacion_estiercol.id_sector = tbl_sector.id_sector INNER JOIN tbl_categorias_especies ON tbl_fermentacion_estiercol.id_categoria_especie = tbl_categorias_especies.id_categoria_especie  INNER JOIN tbl_especie ON tbl_fermentacion_estiercol.id_especie = tbl_especie.id_especie  INNER JOIN tbl_criterio_medicion ON tbl_fermentacion_estiercol.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion  INNER JOIN tbl_fichas ON tbl_fermentacion_estiercol.id_ficha = tbl_fichas.id_ficha  INNER JOIN tbl_categorias_fichas ON tbl_fermentacion_estiercol.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha $where";
$resfer=$conexion->query($fermentacion);
$consultaAnios = "SELECT DISTINCT anio FROM tbl_fermentacion_estiercol";
$resultadoAnios = $conexion->query($consultaAnios);


if(mysqli_num_rows($resultadoAnios)==0)
{
	$mensaje="<h1>No hay registros que coincidan con su criterio de búsqueda.</h1>";
}
?>
<html lang="es">

	<head>
		<title>Resumen Fermentacion Estiercol</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

		<link href="css/estilos.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/estilos1.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <div class="containertable">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="poppins-font mb-2">Reporte Fermentacion Estiercol</h1>
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
            window.location.href = "ferment_est_reporte.php";
        });
    </script>
       <script>
        document.getElementById("generarReporteButton").addEventListener("click", function() {
            // Redirigir a excel.php al hacer clic en el botón de Excel
            window.location.href = "Reporte_tendencia_fermentacion.php";
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
					<th scope="col" class="header-cell">Id Fermentación</th>
                    <th scope="col" class="header-cell">Id Ficha</th>
                    <th scope="col" class="header-cell">Categoria Especie</th>
                    <th scope="col" class="header-cell">Cantidad Especie</th>                    
                    <th scope="col" class="header-cell">Factor Emisión Fermentación</th>
                    <th scope="col" class="header-cell">Factor Emisión Estiércol</th>
                    <th scope="col" class="header-cell">Total Fermentación</th>
                    <th scope="col" class="header-cell">Total Estiércol</th>
				</tr>

				<?php
                $totalFermentacion = 0;
                $totalEstiercol = 0;
                

				while ($selectfer = $resfer->fetch_assoc()) {
                    $totalFermentacion +=  $selectfer['total_fermentacion'] ;
                    $totalEstiercol += $selectfer['total_estiercol'];
                    

					echo'<tr>
                         <td>'.$selectfer['anio'].'</td>
						 <td>'.$selectfer['id_fermentacion'].'</td>
						 <td>'.$selectfer['id_ficha'].'</td>
                         <td>'.$selectfer['categoria_especie'].'</td>
                         <td>'.$selectfer['cantidad_especie'].'</td>
                         <td>'.$selectfer['factor_fermentacion'].'</td>
                         <td>'.$selectfer['factor_estiercol'].'</td>
                         <td>'.$selectfer['total_fermentacion'].'</td>
                         <td>'.$selectfer['total_estiercol'].'</td>
						 </tr>';
                            
				}
				?>
                
                <tr>
                    <td colspan="7"></td> <!-- Colspan igual al número total de columnas -->
                    <td>Total Fermentación: <?= $totalFermentacion ?></td>
                    <td>Total Estiércol: <?= $totalEstiercol ?></td>
                </tr>
			</table>
            
			<?
				echo $mensaje;
			?>
		</section>
	</body>
</html>