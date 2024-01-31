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
tbl_suelos_indirectos_b.id_suelos_indirectos_b,
tbl_fichas.id_ficha,
tbl_suelos_indirectos.nombre_suelo,
tbl_categorias_fichas.categoria_ficha, 
tbl_sector.sector, 
tbl_criterio_medicion.criterio_medicion, 
tbl_suelos_indirectos_b.codigo_categoria,
tbl_suelos_indirectos_b.anio,
tbl_suelos_indirectos_b.categoria_medicion,
tbl_suelos_indirectos_b.cantidad_anual_n,
tbl_suelos_indirectos_b.fraccion_n,
tbl_suelos_indirectos_b.cantidad_animal,
tbl_suelos_indirectos_b.cantidad_orina,
tbl_suelos_indirectos_b.fraccion_materiales,
tbl_suelos_indirectos_b.factor_emision,
tbl_suelos_indirectos_b.cantidad_deposicion,
tbl_suelos_indirectos_b.n2o_volatilizacion,
tbl_suelos_indirectos_b.cantidad_residuos,
tbl_suelos_indirectos_b.cantidad_mineralizado,
tbl_suelos_indirectos_b.fraccion_mineralizado,
tbl_suelos_indirectos_b.cantidad_lixiviacion,
tbl_suelos_indirectos_b.fraccion_lixiviacion,
tbl_suelos_indirectos_b.n2o_lixxiviacion,
tbl_suelos_indirectos_b.total,
tbl_suelos_indirectos_b.hoja, 
tbl_suelos_indirectos_b.referencia,
tbl_suelos_indirectos_b.creado_por,
tbl_suelos_indirectos_b.fecha_creacion,
tbl_suelos_indirectos_b.actualizado_por,
tbl_suelos_indirectos_b.fecha_actualizacion,
tbl_suelos_indirectos_b.estado
FROM tbl_suelos_indirectos_b 
INNER JOIN tbl_fichas ON tbl_suelos_indirectos_b.id_ficha = tbl_fichas.id_ficha 
INNER JOIN tbl_categorias_fichas ON tbl_suelos_indirectos_b.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha 
INNER JOIN tbl_sector ON tbl_suelos_indirectos_b.id_sector = tbl_sector.id_sector 
INNER JOIN tbl_criterio_medicion ON tbl_suelos_indirectos_b.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion
INNER JOIN tbl_suelos_indirectos ON tbl_suelos_indirectos_b.id_suelos_indirectos = tbl_suelos_indirectos.id_suelos_indirectos $where";
$resfer=$conexion->query($fermentacion);
$consultaAnios = "SELECT DISTINCT anio FROM tbl_suelos_indirectos_b";
$resultadoAnios = $conexion->query($consultaAnios);


if(mysqli_num_rows($resultadoAnios)==0)
{
	$mensaje="<h1>No hay registros que coincidan con su criterio de búsqueda.</h1>";
}
?>
<html lang="es">

	<head>
		<title>Reporte Suelos Indirectos Medicion</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

		<link href="css/estilos.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/estilos1.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <div class="containertable">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="poppins-font mb-2">Reporte Suelos Indirectos Medicion</h1>
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
            window.location.href = "suelos_indirectos_reporte.php";
        });
    </script>
       <script>
        document.getElementById("generarReporteButton").addEventListener("click", function() {
            // Redirigir a excel.php al hacer clic en el botón de Excel
            window.location.href = "Reporte_tendencia_suelosindirectos.php";
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
                    <th scope="col" class="header-cell">ID Suelos Indirectos</th>
					<th scope="col" class="header-cell">Cantidad Anual N</th>
                    <th scope="col" class="header-cell">Fraccion N</th>
                    <th scope="col" class="header-cell">Cantidad Animal</th>
                    <th scope="col" class="header-cell">Cantidad Orina</th>
                    <th scope="col" class="header-cell">Fraccion Materiales</th>
                    <th scope="col" class="header-cell">Factor Emision</th>
                    <th scope="col" class="header-cell">Cantidad Deposicion</th>
                    <th scope="col" class="header-cell">N2O Volatilizacion</th>
                    <th scope="col" class="header-cell">Cantidad Residuos</th>
                    <th scope="col" class="header-cell">Cantidad Mineralizado</th>
                    <th scope="col" class="header-cell">Fraccion Mineralizado</th>
                    <th scope="col" class="header-cell">Cantidad Lixiviacion</th>  
                    <th scope="col" class="header-cell">Fraccion Lixiviacion</th>
                    <th scope="col" class="header-cell">N2O Lixiviacion</th>
                    <th scope="col" class="header-cell">Total</th>
				</tr>

				<?php
                
                

				while ($selectfer = $resfer->fetch_assoc()) {
                    
                    

					echo'<tr>
                            <td>'.$selectfer['anio'].'</td>
                            <td>'.$selectfer['id_suelos_indirectos_b'].'</td>
                            <td>'.$selectfer['cantidad_anual_n'].'</td>
                            <td>'.$selectfer['fraccion_n'].'</td>
                            <td>'.$selectfer['cantidad_animal'].'</td>
                            <td>'.$selectfer['cantidad_orina'].'</td>  
                            <td>'.$selectfer['fraccion_materiales'].'</td>
                            <td>'.$selectfer['factor_emision'].'</td>
                            <td>'.$selectfer['cantidad_deposicion'].'</td>
                            <td>'.$selectfer['n2o_volatilizacion'].'</td>
                            <td>'.$selectfer['cantidad_residuos'].'</td>
                            <td>'.$selectfer['cantidad_mineralizado'].'</td>
                            <td>'.$selectfer['fraccion_mineralizado'].'</td>
                            <td>'.$selectfer['cantidad_lixiviacion'].'</td>
                            <td>'.$selectfer['fraccion_lixiviacion'].'</td>
                            <td>'.$selectfer['n2o_lixxiviacion'].'</td>
                            <td>'.$selectfer['total'].'</td>
						 </tr>';
                            
				}
				?>
			</table>
            
			<?
				echo $mensaje;
			?>
		</section>
	</body>
</html>