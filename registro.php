<?php

include("conexion.php"); // Incluir el archivo de conexión a la base de datos

// Consultar y mostrar todos los registros

try {
    $a = $conexion->prepare("SELECT * FROM Mr_Disfraz"); // Preparar la consulta SQL para seleccionar todos los registros
    
    $a->execute();
    $registros = $a->fetchAll(PDO::FETCH_ASSOC); // Obtener todos los registros de la tabla
    }
catch (PDOException $e) { // Manejar cualquier error que ocurra durante la conexión o la consulta
    // Mostrar un mensaje de error si ocurre un problema al consultar los datos
    echo "<br>Error al consultar los datos: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registros</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-base-200 p-6">
  <div class="overflow-x-auto max-w-5xl mx-auto bg-base-100 shadow-md rounded-box">
    <table class="table table-zebra w-full">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Edad</th>
          <th>Correo</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($registros as $index => $fila): ?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($fila['Nombre']) ?></td>
            <td><?= htmlspecialchars($fila['Edad']) ?></td>
            <td><?= htmlspecialchars($fila['Correo_Electronico']) ?></td>
            <td>
              <a href="eliminar.php?id=<?= $fila['id'] ?>" 
                 class="btn btn-sm btn-error"
                 onclick="return confirm('¿Estás seguro de eliminar este registro?');">
                 Eliminar
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div class="text-center mt-6">
      <a href="index.html" class="btn btn-outline btn-primary">Volver al Inicio</a>
    </div>
  </div>
</body>
</html>
