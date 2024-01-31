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

$fermentacion="SELECT tbl_suelosdirectos_medicion.id_suelosDirectos_medicion, tbl_fichas.id_ficha, tbl_categorias_fichas.categoria_ficha, tbl_sector.sector, tbl_tipos_suelos_directos.nombre_suelo, tbl_suelosdirectos_medicion.anio, tbl_suelosdirectos_medicion.numero_ficha, tbl_categorias_fichas.categoria_ficha, tbl_suelosdirectos_medicion.sigla, tbl_suelosdirectos_medicion.descripcion_medicion, tbl_suelosdirectos_medicion.cantidad_anual_n_formula, tbl_suelosdirectos_medicion.cantidad_anual_n_dato, tbl_suelosdirectos_medicion.factor_emision_formula, tbl_suelosdirectos_medicion.factor_emision_dato, tbl_suelosdirectos_medicion.emisiones_directas_aportes, tbl_suelosdirectos_medicion.subtotal, tbl_suelosdirectos_medicion.total, tbl_suelosdirectos_medicion.creado_por, tbl_suelosdirectos_medicion.fecha_creacion, tbl_suelosdirectos_medicion.actualizado_por, tbl_suelosdirectos_medicion.fecha_actualizacion, tbl_suelosdirectos_medicion.estado, tbl_suelosdirectos_medicion.codigo_categoria, tbl_suelosdirectos_medicion.descripcion_suelo, tbl_criterio_medicion.criterio_medicion
FROM tbl_suelosdirectos_medicion 
INNER JOIN tbl_fichas ON tbl_suelosdirectos_medicion.id_ficha = tbl_fichas.id_ficha
INNER JOIN tbl_categorias_fichas ON tbl_suelosdirectos_medicion.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha
INNER JOIN tbl_sector ON tbl_suelosdirectos_medicion.id_sector = tbl_sector.id_sector
INNER JOIN tbl_tipos_suelos_directos ON tbl_suelosdirectos_medicion.id_suelo_directo = tbl_tipos_suelos_directos.id_suelo_directo
INNER JOIN tbl_criterio_medicion ON tbl_suelosdirectos_medicion.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion $where";
$resfer=$conexion->query($fermentacion);
$consultaAnios = "SELECT DISTINCT anio FROM tbl_suelosdirectos_medicion";
$resultadoAnios = $conexion->query($consultaAnios);


if(mysqli_num_rows($resultadoAnios)==0)
{
	$mensaje="<h1>No hay registros que coincidan con su criterio de búsqueda.</h1>";
}
?>
<html lang="es">

	<head>
		<title>Reporte Suelos Directos Medicion</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

		<link href="css/estilos.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/estilos1.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <div class="containertable">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="poppins-font mb-2">Reporte Suelos Directos Medicion</h1>
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
            window.location.href = "suelos_directos_reporte.php";
        });
    </script>
       <script>
        document.getElementById("generarReporteButton").addEventListener("click", function() {
            // Redirigir a excel.php al hacer clic en el botón de Excel
            window.location.href = "Reporte_tendencia_suelosdirectos.php";
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
                    <th scope="col" class="header-cell">Id Suelos Directos Medicion</th>
					<th scope="col" class="header-cell">Tipo de N Aplicado</th>
                    <th scope="col" class="header-cell">Tipo de N Aplicado Descripcion</th>
                    <th scope="col" class="header-cell">Cantidad Anual de N Aplicado</th>
                    <th scope="col" class="header-cell">Cantidad Anual de N Aplicado Dato</th>
                    <th scope="col" class="header-cell">Factor de Emision de N2O de Aportes</th>
                    <th scope="col" class="header-cell">Factor de Emision de N2O de Aportes Dato</th>
                    <th scope="col" class="header-cell">Emisiones Directas de N2O-N Aportes de N</th>                
				</tr>

				<?php
                $totalEmisionesDirectas = 0;
                

				while ($selectfer = $resfer->fetch_assoc()) {
                    $totalEmisionesDirectas += $selectfer['emisiones_directas_aportes'];
                    

					echo'<tr>
                            <td>'.$selectfer['anio'].'</td>
                            <td>'.$selectfer['id_suelosDirectos_medicion'].'</td>
                            <td>'.$selectfer['nombre_suelo'].'</td>
                            <td>'.$selectfer['descripcion_suelo'].'</td>
                            <td>'.$selectfer['cantidad_anual_n_formula'].'</td>
                            <td>'.$selectfer['cantidad_anual_n_dato'].'</td>
                            <td>'.$selectfer['factor_emision_formula'].'</td>
                            <td>'.$selectfer['factor_emision_dato'].'</td>
                            <td>'.$selectfer['emisiones_directas_aportes'].'</td>
						 </tr>';
                            
				}
				?>
                
                <tr>
                <td colspan="8">Totales</td>
                    <td><?= $totalEmisionesDirectas ?></td>
                </tr>
			</table>
            
			<?
				echo $mensaje;
			?>
		</section>
	</body>
</html>