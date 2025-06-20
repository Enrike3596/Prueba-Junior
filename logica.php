<?php

// Obtener datos del formulario

$nombre = $_POST["nombre"] ?? "";
$edad   = $_POST["edad"] ?? "";
$email  = $_POST["email"] ?? "";

// Validar edad
if ($edad < 18) {
    echo "<h2>No cumples con la edad  para el registro.</h2>";
    echo "<a href='index.html' class='btn btn-outline btn-primary'>Volver al Inicio</a>";
    exit;
} else {
    echo "Gracias por registrarse";
}
echo "<br>";

// Conexión y guardado en la base de datos
try {
    // Establecer conexión con la base de datos
    include("conexion.php");

    // Preparar la consulta SQL
    $stmt = $conexion->prepare(
        "INSERT INTO Mr_Disfraz (Nombre, Edad, Correo_Electronico) VALUES (?, ?, ?)"
    );

    // Ejecutar la consulta con los datos del formulario
    $stmt->execute([$nombre, $edad, $email]);

    header("Location: registro.php"); // Redireccionar a la página de registros
    exit;
} catch (PDOException $e) {
    echo "Error al guardar en la base de datos: " . $e->getMessage();
}
?>