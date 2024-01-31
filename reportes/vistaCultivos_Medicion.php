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

$fermentacion="SELECT tbl_cultivos_medicion.id_cultivos_medicion, tbl_fichas.id_ficha, tbl_categorias_fichas.categoria_ficha, tbl_sector.sector, tbl_categorias_cultivo.cultivo, tbl_criterio_medicion.criterio_medicion, tbl_cultivos_medicion.nivel_medicion, tbl_cultivos_medicion.anio, tbl_cultivos_medicion.numero_ficha, tbl_cultivos_medicion.total, tbl_cultivos_medicion.sigla, tbl_cultivos_medicion.descripcion, tbl_cultivos_medicion.actualizado_por, tbl_cultivos_medicion.tipo_superficie, tbl_cultivos_medicion.masa_combustible, tbl_cultivos_medicion.factor_emision_ch, tbl_cultivos_medicion.factor_emision_co, tbl_cultivos_medicion.factor_emision_n2o, tbl_cultivos_medicion.factor_emision_nox, tbl_cultivos_medicion.emision_ch, tbl_cultivos_medicion.emision_co, tbl_cultivos_medicion.emision_n2o, tbl_cultivos_medicion.emision_nox , tbl_cultivos_medicion.factor_combustion ,tbl_cultivos_medicion.estado
FROM tbl_cultivos_medicion
INNER JOIN tbl_fichas ON tbl_cultivos_medicion.id_ficha = tbl_fichas.id_ficha
INNER JOIN tbl_categorias_fichas ON tbl_cultivos_medicion.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha
INNER JOIN tbl_sector ON tbl_cultivos_medicion.id_sector = tbl_sector.id_sector
INNER JOIN tbl_categorias_cultivo ON tbl_cultivos_medicion.id_cultivo = tbl_categorias_cultivo.id_cultivo
INNER JOIN tbl_criterio_medicion ON tbl_cultivos_medicion.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion $where";
$resfer=$conexion->query($fermentacion);
$consultaAnios = "SELECT DISTINCT anio FROM tbl_cultivos_medicion";
$resultadoAnios = $conexion->query($consultaAnios);


if(mysqli_num_rows($resultadoAnios)==0)
{
	$mensaje="<h1>No hay registros que coincidan con su criterio de búsqueda.</h1>";
}
?>
<html lang="es">

	<head>
		<title>Reporte Cultivos Medicion</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

		<link href="css/estilos.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/estilos1.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <div class="containertable">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="poppins-font mb-2">Reporte Cultivos Medicion</h1>
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
            window.location.href = "cultivos_medicion_reporte.php";
        });
    </script>
       <script>
        document.getElementById("generarReporteButton").addEventListener("click", function() {
            // Redirigir a excel.php al hacer clic en el botón de Excel
            window.location.href = "Reporte_tendencia_residuos.php";
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
					<th scope="col" class="header-cell">Cultivo</th>
                    <th scope="col" class="header-cell">Superficie Quemada</th>
                    <th scope="col" class="header-cell">Masa de Combustible disponible para la combustion</th>
                    <th scope="col" class="header-cell">Factor de Combustion</th>                    
                    <th scope="col" class="header-cell">Factor de Emision CH4</th>
                    <th scope="col" class="header-cell">Factor de Emision CO</th>
                    <th scope="col" class="header-cell">Factor de Emision N2O</th>
                    <th scope="col" class="header-cell">Factor de Emision NOx</th>
                    <th scope="col" class="header-cell">Emision CH4</th>
                    <th scope="col" class="header-cell">Emision CO</th>
                    <th scope="col" class="header-cell">Emision N2O</th>
                    <th scope="col" class="header-cell">Emision NOx</th>
				</tr>

				<?php
                $totalEmisionCH = 0;
                $totalEmisionCO = 0;
                $totalEmisionN2O = 0;
                $totalEmisionNOx = 0;
                

				while ($selectfer = $resfer->fetch_assoc()) {
                    $totalEmisionCH += $selectfer['emision_ch'];
                    $totalEmisionCO += $selectfer['emision_co'];
                    $totalEmisionN2O += $selectfer['emision_n2o'];
                    $totalEmisionNOx += $selectfer['emision_nox'];
                    

					echo'<tr>
                            <td>'.$selectfer['anio'].'</td>
                            <td>'.$selectfer['cultivo'].'</td>
                            <td>'.$selectfer['tipo_superficie'].'</td>
                            <td>'.$selectfer['masa_combustible'].'</td>
                            <td>'.$selectfer['factor_combustion'].'</td>
                            <td>'.$selectfer['factor_emision_ch'].'</td>
                            <td>'.$selectfer['factor_emision_co'].'</td>
                            <td>'.$selectfer['factor_emision_n2o'].'</td>
                            <td>'.$selectfer['factor_emision_nox'].'</td>
                            <td>'.$selectfer['emision_ch'].'</td>
                            <td>'.$selectfer['emision_co'].'</td>
                            <td>'.$selectfer['emision_n2o'].'</td>
                            <td>'.$selectfer['emision_nox'].'</td>
						 </tr>';
                            
				}
				?>
                
                <tr>
                    <td colspan="9">Totales</td>
                    <td><?= $totalEmisionCH ?></td>
                    <td><?= $totalEmisionCO ?></td>
                    <td><?= $totalEmisionN2O ?></td>
                    <td><?= $totalEmisionNOx ?></td>
                </tr>
			</table>
            
			<?
				echo $mensaje;
			?>
		</section>
	</body>
</html>