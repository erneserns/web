<?php
// ACTIVAR ERRORES PARA DEPURACIÓN
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión a la base de datos
$servername = "localhost";  // Servidor MySQL
$username = "netolaneta";         // Usuario de MySQL
$password = "n3t0l4n3t4";   // Contraseña
$dbname = "netolaneta";      // Nombre de la base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar que el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar datos
    $negocio = htmlspecialchars(trim($_POST["negocio"]));
    $giro = htmlspecialchars(trim($_POST["giro"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $direccion = htmlspecialchars(trim($_POST["direccion"]));
    $categoria = htmlspecialchars(trim($_POST["categoria"]));

    // Validar que los campos no estén vacíos
    if (empty($negocio) || empty($giro) || empty($email) || empty($direccion) || empty($categoria)) {
        echo "<p style='color:red;'>Todos los campos son obligatorios.</p>";
        exit();
    }

    // Validar formato del email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color:red;'>Correo electrónico no válido.</p>";
        exit();
    }

    // Preparar la consulta SQL
    $sql = "INSERT INTO negocios (negocio, giro, email, direccion, categoria) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $negocio, $giro, $email, $direccion, $categoria);
    

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<h2>Registro Exitoso</h2>";
        echo "<p><strong>Negocio:</strong> $negocio</p>";
        echo "<p><strong>Giro:</strong> $giro</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Dirección:</strong> $direccion</p>";
        echo "<p><strong>Categoría:</strong> $categoria</p>";
    } else {
        echo "<p style='color:red;'>Error al registrar: " . $conn->error . "</p>";
    }

    // Cerrar conexión
    $stmt->close();
    $conn->close();

} else {
    echo "<p style='color:red;'>Método no permitido.</p>";
}
?>
