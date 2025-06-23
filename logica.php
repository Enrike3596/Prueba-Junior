<?php
$nombre = $_POST["nombre"] ?? "";
$edad   = $_POST["edad"] ?? "";
$email  = $_POST["email"] ?? "";

function mostrarAlerta($tipo, $titulo, $mensaje, $url) {
    echo "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Alerta</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: '$tipo',
                title: '$titulo',
                text: '$mensaje',
                confirmButtonText: 'Continuar'
            }).then(() => {
                window.location.href = '$url';
            });
        </script>
    </body>
    </html>";
    exit;
}

// Validar edad
if ($edad < 18) {
    mostrarAlerta('error', 'Edad no permitida', 'Debes tener al menos 18 años para registrarte.', 'index.html');
}

try {
    include("conexion.php");

    $stmt = $conexion->prepare("INSERT INTO Mr_Disfraz (Nombre, Edad, Correo_Electronico) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $edad, $email]);

    mostrarAlerta('success', 'Registro exitoso', "¡Bienvenido $nombre!", 'registro.php');

} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        mostrarAlerta('warning', 'Correo duplicado', 'El correo ya está registrado.', 'index.html');
    } else {
        mostrarAlerta('error', 'Error de servidor', 'No se pudo completar el registro.', 'index.html');
    }
}
?>
