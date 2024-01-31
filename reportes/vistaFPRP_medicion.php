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

$fermentacion="SELECT tbl_estiercol_fprp_medicion_n.id_fprp_estiercol_medicion, tbl_fichas.id_ficha, tbl_categorias_fichas.categoria_ficha, tbl_estiercol_fprp_medicion_n.nivel_medicion, tbl_estiercol_fprp_n.gestion_estiercol_FPRP, tbl_sector.sector, tbl_estiercol_fprp_medicion_n.anio, tbl_estiercol_fprp_medicion_n.numero_ficha, tbl_categorias_especies.categoria_especie, tbl_especie.especie, tbl_estiercol_fprp_medicion_n.categoria_medicion, tbl_criterio_medicion.criterio_medicion, tbl_estiercol_fprp_medicion_n.cantidad_especie, tbl_estiercol_fprp_medicion_n.promedio_anual_excrecion, tbl_estiercol_fprp_medicion_n.fraccion_excrecion_anual, tbl_estiercol_fprp_medicion_n.emisiones_directas_FPRP, tbl_estiercol_fprp_medicion_n.descripcion, tbl_estiercol_fprp_medicion_n.sigla, tbl_estiercol_fprp_medicion_n.estado, tbl_estiercol_fprp_medicion_n.hoja, tbl_estiercol_fprp_medicion_n.referencia
FROM tbl_estiercol_fprp_medicion_n INNER JOIN tbl_fichas ON tbl_estiercol_fprp_medicion_n.id_ficha = tbl_fichas.id_ficha INNER JOIN tbl_categorias_fichas ON tbl_estiercol_fprp_medicion_n.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha INNER JOIN tbl_estiercol_fprp_n ON tbl_estiercol_fprp_medicion_n.id_gestion_estiercol_FPRP = tbl_estiercol_fprp_n.id_gestion_estiercol_FPRP INNER JOIN tbl_sector ON tbl_estiercol_fprp_medicion_n.id_sector = tbl_sector.id_sector INNER JOIN tbl_categorias_especies ON tbl_estiercol_fprp_medicion_n.id_categoria_especie = tbl_categorias_especies.id_categoria_especie INNER JOIN tbl_especie ON tbl_estiercol_fprp_medicion_n.id_especie = tbl_especie.id_especie INNER JOIN tbl_criterio_medicion ON tbl_estiercol_fprp_medicion_n.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion $where";
$resfer=$conexion->query($fermentacion);
$consultaAnios = "SELECT DISTINCT anio FROM tbl_estiercol_fprp_medicion_n";
$resultadoAnios = $conexion->query($consultaAnios);


if(mysqli_num_rows($resultadoAnios)==0)
{
	$mensaje="<h1>No hay registros que coincidan con su criterio de búsqueda.</h1>";
}
?>
<html lang="es">

	<head>
		<title>Reporte FPRP Medicion</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

		<link href="css/estilos.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/estilos1.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <div class="containertable">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="poppins-font mb-2">Reporte FPRP Medicion</h1>
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
            window.location.href = "fprp_medicion_reporte.php";
        });
    </script>
       <script>
        document.getElementById("generarReporteButton").addEventListener("click", function() {
            // Redirigir a excel.php al hacer clic en el botón de Excel
            window.location.href = "Reporte_tendencia_fprp.php";
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
                    <th scope="col" class="header-cell">Id FPRP Estiercol Medicion</th>
					<th scope="col" class="header-cell">Sistema de Gestion del Estiercol MMS</th>
                    <th scope="col" class="header-cell">Especie / Categoria de Ganado</th>
                    <th scope="col" class="header-cell">Cantidad de Cabezas de la Especie</th>
                    <th scope="col" class="header-cell">Promedio Anual de Excrecion de N por cabeza de la especie </th>
                    <th scope="col" class="header-cell">Fraccion de la Excrecion total Anual de nitrogeno de cada especie </th>
                    <th scope="col" class="header-cell">Emisiones Directas de N2O de la gestion de Estiercol </th>
				</tr>

				<?php
                $totalemisionesdirectas = 0;
                

				while ($selectfer = $resfer->fetch_assoc()) {
                    $totalemisionesdirectas += $selectfer['emisiones_directas_FPRP'];
                    

					echo'<tr>
                            <td>'.$selectfer['anio'].'</td>
                            <td>'.$selectfer['id_fprp_estiercol_medicion'].'</td>
                            <td>'.$selectfer['gestion_estiercol_FPRP'].'</td>  
                            <td>'.$selectfer['especie'].'</td>
                            <td>'.$selectfer['cantidad_especie'].'</td>
                            <td>'.$selectfer['promedio_anual_excrecion'].'</td>
                            <td>'.$selectfer['fraccion_excrecion_anual'].'</td>
                            <td>'.$selectfer['emisiones_directas_FPRP'].'</td>
						 </tr>';
                            
				}
				?>
                
                <tr>
                <td colspan="6">Totales</td>
                    <td><?= $totalemisionesdirectas ?></td>
                </tr>
			</table>
            
			<?
				echo $mensaje;
			?>
		</section>
	</body>
</html>