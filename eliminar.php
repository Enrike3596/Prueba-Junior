<?php
// eliminar un dato de la base de datos
$id = $_GET['id'] ?? null; // Obtener el ID del registro a eliminar desde la URL

if ($id) { // Verificar si se ha proporcionado un ID
    // Conectar a la base de datos y eliminar el registro con el ID proporcionado
    try {
        include("conexion.php");
        $a = $conexion->prepare("DELETE FROM Mr_Disfraz WHERE id = ?"); // preparar la consulta SQL para eliminar un registro
        $a->execute([$id]); // ejecutar la consulta con el ID proporcionado
        // Si la consulta se ejecuta correctamente, redireccionar a la página de registros

        header("Location: registro.php"); // redireccionar a la pagina principal
        exit;
    } catch (PDOException $e) { // Manejar cualquier error que ocurra durante la conexión o la consulta
        // Mostrar un mensaje de error si ocurre un problema al eliminar el registro
        echo "<p class='text-danger'>Error al eliminar el registro: " . $e->getMessage() . "</p>";
    }
}

?>