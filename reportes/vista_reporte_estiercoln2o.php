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

$fermentacion="SELECT
tbl_estiercol_n2o.id_estiercol,
tbl_fichas.id_ficha,
tbl_categorias_fichas.categoria_ficha,
tbl_estiercol_n2o.nivel_medicion,
tbl_sector.sector,
tbl_estiercol_n2o.anio,
tbl_estiercol_n2o.numero_ficha,
tbl_categorias_especies.categoria_especie,
tbl_especie.especie,
tbl_estiercol_n2o.categoria_medicion,
tbl_criterio_medicion.criterio_medicion,
tbl_estiercol_n2o.cantidad_especie,
tbl_estiercol_n2o.sigla,
tbl_estiercol_n2o.creado_por,
tbl_estiercol_n2o.fecha_creacion,
tbl_estiercol_n2o.actualizado_por,
tbl_estiercol_n2o.fecha_actualizacion,
tbl_estiercol_n2o.estado, 
tbl_estiercol_n2o.tasa_excrecion, 
tbl_estiercol_n2o.masa_animal,
tbl_estiercol_n2o.promedio_anual_excrecion,
tbl_estiercol_n2o.fraccion_excrecion,
tbl_estiercol_n2o.n_total_excretado,
tbl_estiercol_n2o.factor_emisiones_directas,
tbl_estiercol_n2o.emision_directas,
tbl_gestion_mms_estiercol.gestion_estiercol
FROM tbl_estiercol_n2o 
INNER JOIN tbl_fichas ON tbl_estiercol_n2o.id_ficha = tbl_fichas.id_ficha 
INNER JOIN tbl_categorias_fichas ON tbl_estiercol_n2o.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha
INNER JOIN tbl_sector ON tbl_estiercol_n2o.id_sector = tbl_sector.id_sector
INNER JOIN tbl_categorias_especies ON tbl_estiercol_n2o.id_categoria_especie = tbl_categorias_especies.id_categoria_especie
INNER JOIN tbl_especie ON tbl_estiercol_n2o.id_especie = tbl_especie.id_especie
INNER JOIN tbl_criterio_medicion ON tbl_estiercol_n2o.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion
INNER JOIN tbl_gestion_mms_estiercol ON tbl_estiercol_n2o.id_gestion_estiercol_mms = tbl_gestion_mms_estiercol.id_gestion_estiercol_mms  $where";
$resfer=$conexion->query($fermentacion);
$consultaAnios = "SELECT DISTINCT anio FROM tbl_estiercol_n2o";
$resultadoAnios = $conexion->query($consultaAnios);


if(mysqli_num_rows($resultadoAnios)==0)
{
	$mensaje="<h1>No hay registros que coincidan con su criterio de búsqueda.</h1>";
}
?>
<html lang="es">

	<head>
		<title>Resumen Estiercol N2O</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

		<link href="css/estilos.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/estilos1.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <div class="containertable">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="poppins-font mb-2">Reporte Estiercol N2O</h1>
            <br>
        </div>

     <!--  descargar excel -->
     <div class="center-vertical">
            <button type="button" class="btn btn-success custom-btn" id="excelButton">Generar Reporte</button>
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
            window.location.href = "estiercol_n2o_reporte.php";
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
                    <th scope="col" class="header-cell">id_ficha</th>
					<th scope="col" class="header-cell">Gestion Estiercol</th>
                    <th scope="col" class="header-cell">Categoria Especie</th>
                    <th scope="col" class="header-cell">Cantidad Especie</th>
                    <th scope="col" class="header-cell">Tasa Excrecion</th>                    
                    <th scope="col" class="header-cell">Masa Animal</th>
                    <th scope="col" class="header-cell">Promedio Anual de Excreción de N</th>
                    <th scope="col" class="header-cell">Fracción de la Excreción Total Anual de Nitrógeno</th>
                    <th scope="col" class="header-cell">N Total Excretado por MMS</th>
                    <th scope="col" class="header-cell">Factor de Emisión para Emisiones Directas de N2O</th>
                    <th scope="col" class="header-cell">Emisiones Directas de N2O de la Gestión del Estiércol</th>
				</tr>

				<?php
                $totalemisiones = 0;
                $totalnexcretado = 0;
                

				while ($selectfer = $resfer->fetch_assoc()) {
                    $totalemisiones +=  $selectfer['emision_directas'] ;
                    $totalnexcretado += $selectfer['n_total_excretado'];
                    

					echo'<tr>
                         <td>'.$selectfer['anio'].'</td>
                         <td>'.$selectfer['id_ficha'].'</td>
						 <td>'.$selectfer['gestion_estiercol'].'</td>
						 <td>'.$selectfer['categoria_especie'].'</td>
                         <td>'.$selectfer['cantidad_especie'].'</td>
                         <td>'.$selectfer['tasa_excrecion'].'</td>
                         <td>'.$selectfer['masa_animal'].'</td>
                         <td>'.$selectfer['promedio_anual_excrecion'].'</td>
                         <td>'.$selectfer['fraccion_excrecion'].'</td>
                         <td>'.$selectfer['n_total_excretado'].'</td>
                         <td>'.$selectfer['factor_emisiones_directas'].'</td>
                         <td>'.$selectfer['emision_directas'].'</td>
						 </tr>';
                            
				}
				?>
                
                <tr>
                    <td colspan="9"></td> <!-- Colspan igual al número total de columnas -->
                    <td>Total Excretado: <?= $totalnexcretado ?></td>
                    <td colspan="1"></td> <!-- Colspan igual al número total de columnas -->
                    <td>Total Emisiones: <?= $totalemisiones ?></td>
                </tr>
			</table>
            
			<?
				echo $mensaje;
			?>
		</section>
	</body>
</html>