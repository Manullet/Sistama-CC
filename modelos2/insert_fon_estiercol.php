<?php
include '../php/conexion_be.php';

// Obtener los valores de los campos (ajusta según cómo obtienes los datos)
$sistema_id = $_POST['id_sistema'];
$especie_id = $_POST['id_especie'];
$cantidad_a_val = number_format($_POST['cantidad_a_edit'], 3, '.', ''); // 5 decimales, punto como separador
$promedio_b_val = number_format($_POST['promedio_b_edit'], 5, '.', '');  // 5 decimales, punto como separador
$fraccion_c_val = number_format($_POST['fraccion_c_edit'], 5, '.', '')/100;   // 5 decimales, punto como separador
$cantidad_nitrogeno_d_val = number_format($_POST['cantidad_nitrogeno_d_edit'], 2, '.', '')/100;   // 2 decimales, punto como separador
$cantidad_nitrogeno_e_val = number_format($_POST['cantidad_nitrogeno_e_edit'], 2, '.', '')/100;  // 2 decimales, punto como separador
$cantidad_nitrogeno_f_val = number_format($_POST['cantidad_nitrogeno_f_edit'], 5, '.', '');  // 5 decimales, punto como separador


// Calcular el valor de G
$cantidad_g_val = $cantidad_a_val * $promedio_b_val * $fraccion_c_val * $cantidad_nitrogeno_e_val
                + $cantidad_a_val * $fraccion_c_val * $cantidad_nitrogeno_f_val;

// Llamada al procedimiento almacenado
$sql = "INSERT INTO tbl_fon (id_sistema, id_especie, cantidad_a, promedio_b, fraccion_c, cantidad_nitrogeno_d, cantidad_nitrogeno_e, cantidad_nitrogeno_f, cantidad_g) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Preparar la consulta SQL
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "iiidddddd", $sistema_id, $especie_id, $cantidad_a_val, $promedio_b_val, $fraccion_c_val, $cantidad_nitrogeno_d_val, $cantidad_nitrogeno_e_val, $cantidad_nitrogeno_f_val, $cantidad_g_val);

// Ejecutar la consulta
if (mysqli_stmt_execute($stmt)) {
    header("Location: ../bienvenida.php?success=true");
} else {
    echo "Error al ejecutar el procedimiento almacenado: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>
