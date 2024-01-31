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

$fermentacion="SELECT tbl_fon.id_fon, tbl_fichas.id_ficha, tbl_categorias_fichas.categoria_ficha, tbl_fon.nivel_medicion, tbl_sector.sector, tbl_fon.anio, tbl_gestion_mms_estiercol.gestion_estiercol, tbl_categorias_especies.categoria_especie, tbl_especie.especie, tbl_criterio_medicion.criterio_medicion, tbl_fon.numero_ficha, tbl_fon.categoria_medicion, tbl_fon.cantidad_especie, tbl_fon.promedio_b, tbl_fon.fraccion_c, tbl_fon.cantidad_nitrogeno_d, tbl_fon.cantidad_nitrogeno_e, tbl_fon.cantidad_nitrogeno_f, tbl_fon.cantidad_g, tbl_fon.estado
FROM tbl_fon
INNER JOIN tbl_fichas ON tbl_fon.id_ficha = tbl_fichas.id_ficha
INNER JOIN tbl_categorias_fichas ON tbl_fon.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha
INNER JOIN tbl_sector ON tbl_fon.id_sector = tbl_sector.id_sector
INNER JOIN tbl_categorias_especies ON tbl_fon.id_categoria_especie = tbl_categorias_especies.id_categoria_especie
INNER JOIN tbl_especie ON tbl_fon.id_especie = tbl_especie.id_especie
INNER JOIN tbl_gestion_mms_estiercol ON tbl_fon.id_gestion_estiercol_mms = tbl_gestion_mms_estiercol.id_gestion_estiercol_mms
INNER JOIN tbl_criterio_medicion ON tbl_fon.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion $where";
$resfer=$conexion->query($fermentacion);
$consultaAnios = "SELECT DISTINCT anio FROM tbl_fon";
$resultadoAnios = $conexion->query($consultaAnios);


if(mysqli_num_rows($resultadoAnios)==0)
{
	$mensaje="<h1>No hay registros que coincidan con su criterio de búsqueda.</h1>";
}
?>
<html lang="es">

	<head>
		<title>Reporte FON</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

		<link href="css/estilos.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/estilos1.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <div class="containertable">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="poppins-font mb-2">Reporte FON</h1>
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
            window.location.href = "fon_reporte.php";
        });
    </script>
       <script>
        document.getElementById("generarReporteButton").addEventListener("click", function() {
            // Redirigir a excel.php al hacer clic en el botón de Excel
            window.location.href = "Reporte_tendencia_encalado.php";
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
                    <th scope="col" class="header-cell">Id Fon</th>
					<th scope="col" class="header-cell">Promedio b</th>
                    <th scope="col" class="header-cell">Promedio c</th>
                    <th scope="col" class="header-cell">Cantidad de nitrógeno del estiércol gestionado para la categoría de ganado T que se pierde en el sistema de gestión del estiércol S,</th>
                    <th scope="col" class="header-cell">Cantidad de nitrógeno del estiércol gestionado para la categoría de ganado T que se pierde en el sistema de gestión del estiércol S,</th>
                    <th scope="col" class="header-cell">Cantidad de nitrógeno de las camas (a aplicar para almacenamiento de sólidos y MMS de cama profunda si se utiliza una cama orgánica conocida)</th>
                    <th scope="col" class="header-cell">Cantidad anual de de estiércol animal, compost, lodos cloacales y otros aportes de N aplicada a los suelos</th>             
				</tr>

				<?php
                $totalCantidadG = 0;
                

				while ($selectfer = $resfer->fetch_assoc()) {
                    $totalCantidadG +=$selectfer['cantidad_g'];
                    

					echo'<tr>
                            <td>'.$selectfer['anio'].'</td>
                            <td>'.$selectfer['id_fon'].'</td>
                            <td>'.$selectfer['promedio_b'].'</td>  
                            <td>'.$selectfer['fraccion_c'].'</td>
                            <td>'.$selectfer['cantidad_nitrogeno_d'].'</td>
                            <td>'.$selectfer['cantidad_nitrogeno_e'].'</td>
                            <td>'.$selectfer['cantidad_nitrogeno_f'].'</td>
                            <td>'.$selectfer['cantidad_g'].'</td>
						 </tr>';
                            
				}
				?>
                
                <tr>
                <td colspan="6">Totales</td>
                    <td><?= $totalCantidadG ?></td>
                </tr>
			</table>
            
			<?
				echo $mensaje;
			?>
		</section>
	</body>
</html>