<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Establecer la conexión a la base de datos
$servername = "localhost";
$db_username = "SG-OMIL";
$db_password = "Sg-omil-2024";
$database = "sg_omil";

// Conecta a la base de datos
$conn = new mysqli($servername, $db_username, $db_password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si se ha enviado el ID para eliminar
if (isset($_GET['id'])) {
    $deleteId = $_GET['id'];

    // Realiza la eliminación en la base de datos
    $sqlDelete = "DELETE FROM sg_omil_derivacion_oportunidad_laboral WHERE id = $deleteId";

    if ($conn->query($sqlDelete) === TRUE) {
        echo "Derivacion eliminada correctamente.";
        header("Location: derivacionesEmpleo.php");
        exit();
    } else {
        echo "Error al eliminar Derivacion: " . $conn->error;
    }
} else {
    echo "ID de Derivacion no proporcionado.";
}

// Cierra la conexión
$conn->close();
?>
