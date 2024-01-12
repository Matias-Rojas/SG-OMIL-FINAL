<?php
// Realiza la conexión a la base de datos (puedes reutilizar el código de conexión existente)
// Establecer la conexión a la base de datos
$servername = "localhost";
$db_username = "SG-OMIL";
$db_password = "Sg-omil-2024";
$database = "sg_omil";

$conn = new mysqli($servername, $db_username, $db_password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el rut del usuario vecinal seleccionado desde la solicitud POST
$rut_usuario = isset($_POST["rut_usuario"]) ? $_POST["rut_usuario"] : '';

// Consulta para obtener las capacitaciones asociadas al usuario
$sql_capacitaciones = "SELECT oc.NombreCurso 
                        FROM `sg_omil_seleccionados_capacitacion` AS sc 
                        JOIN sg_omil_ofertascapacitacion AS oc ON sc.OfertaCapacitacionID = oc.OfertaCapacitacionID 
                        JOIN sg_omil_usuariosvecinales AS uv ON sc.UsuarioID = uv.UsuarioID 
                        WHERE uv.Rut = '$rut_usuario'";

$result_capacitaciones = $conn->query($sql_capacitaciones);

$capacitaciones = array();

if ($result_capacitaciones->num_rows > 0) {
    while ($row_capacitacion = $result_capacitaciones->fetch_assoc()) {
        $capacitaciones[] = $row_capacitacion["NombreCurso"];
    }
}

// Generar las opciones del select con las capacitaciones asociadas al usuario
foreach ($capacitaciones as $capacitacion) {
    echo "<option value='$capacitacion'>$capacitacion</option>";
}

$conn->close();
?>
