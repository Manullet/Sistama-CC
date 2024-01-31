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

$fermentacion="SELECT tbl_encalado_medicion_n.id_encalado_medicion, tbl_fichas.id_ficha, tbl_categorias_fichas.categoria_ficha, tbl_encalado_medicion_n.nivel_medicion, tbl_tipos_cal_n.tipo_cal, tbl_sector.sector, tbl_encalado_medicion_n.anio, tbl_encalado_medicion_n.numero_ficha, tbl_criterio_medicion.criterio_medicion, tbl_encalado_medicion_n.sigla, tbl_encalado_medicion_n.descripcion, tbl_encalado_medicion_n.cantidad_anual_pc, tbl_encalado_medicion_n.factor_pc, tbl_encalado_medicion_n.cantidad_anual_dolomita, tbl_encalado_medicion_n.factor_dolomita, tbl_encalado_medicion_n.emision_co_pc, tbl_encalado_medicion_n.creado_por, tbl_encalado_medicion_n.fecha_creacion, tbl_encalado_medicion_n.actualizado_por, tbl_encalado_medicion_n.fecha_actualizacion, tbl_encalado_medicion_n.estado, tbl_encalado_medicion_n.codigo_categoria, tbl_encalado_medicion_n.hoja, tbl_encalado_medicion_n.referencia, tbl_encalado_medicion_n.emision_co_dolomita
FROM tbl_encalado_medicion_n INNER JOIN tbl_fichas ON tbl_encalado_medicion_n.id_ficha = tbl_fichas.id_ficha INNER JOIN tbl_categorias_fichas ON tbl_encalado_medicion_n.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha INNER JOIN tbl_sector ON tbl_encalado_medicion_n.id_sector = tbl_sector.id_sector INNER JOIN tbl_tipos_cal_n ON tbl_encalado_medicion_n.id_tipo_cal = tbl_tipos_cal_n.id_tipo_cal INNER JOIN tbl_criterio_medicion ON tbl_encalado_medicion_n.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion $where";
$resfer=$conexion->query($fermentacion);
$consultaAnios = "SELECT DISTINCT anio FROM tbl_encalado_medicion_n";
$resultadoAnios = $conexion->query($consultaAnios);


if(mysqli_num_rows($resultadoAnios)==0)
{
	$mensaje="<h1>No hay registros que coincidan con su criterio de búsqueda.</h1>";
}
?>
<html lang="es">

	<head>
		<title>Reporte Encalado Medicion</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

		<link href="css/estilos.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/estilos1.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <div class="containertable">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="poppins-font mb-2">Reporte Encalado Medicion</h1>
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
            window.location.href = "encalado_medicion_reporte.php";
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
					<th scope="col" class="header-cell">Tipo de Cal</th>
                    <th scope="col" class="header-cell">Cantidad Anual de Piedra Caliza Cálcica</th>
                    <th scope="col" class="header-cell">Factor de Emision / tons de C / ton de Piedra Caliza</th>
                    <th scope="col" class="header-cell">Cantidad Anual de Dolomita</th>                    
                    <th scope="col" class="header-cell">Factor de Emision / tons de C / ton de Dolomita</th>
                    <th scope="col" class="header-cell">Emision de CO2 Piedra Caliza</th>
                    <th scope="col" class="header-cell">Emision de CO2 Dolomita</th>
				</tr>

				<?php
                $totalEmision = 0;
                

				while ($selectfer = $resfer->fetch_assoc()) {
                    $totalEmision += ($selectfer['emision_co_pc'] + $selectfer['emision_co_dolomita']);
                    

					echo'<tr>
                            <td>'.$selectfer['anio'].'</td>
                            <td>'.$selectfer['tipo_cal'].'</td>
                            <td>'.$selectfer['cantidad_anual_pc'].'</td>
                            <td>'.$selectfer['factor_pc'].'</td>
                            <td>'.$selectfer['cantidad_anual_dolomita'].'</td>
                            <td>'.$selectfer['factor_dolomita'].'</td>
                            <td>'.$selectfer['emision_co_pc'].'</td>
                            <td>'.$selectfer['emision_co_dolomita'].'</td>
						 </tr>';
                            
				}
				?>
                
                <tr>
                <td colspan="5" style="text-align: right;"><strong>Total Emisiones :</strong></td>
                <td colspan="1"><strong><?php echo $totalEmision; ?></strong></td>
                </tr>
			</table>
            
			<?
				echo $mensaje;
			?>
		</section>
	</body>
</html>