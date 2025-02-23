
<?php
// ACTIVAR ERRORES PARA DEPURACIÓN
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Datos de conexión a la base de datos
$host = "localhost";
$db_user = "netolaneta";
$db_password = "n3t0l4n3t4";
$db_name = "netolaneta";

// Establecer conexión con la base de datos
$conexion = mysqli_connect($host, $db_user, $db_password, $db_name);

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consultar los datos de la tabla negocios
$sql = "SELECT * FROM negocios";
$resultado = mysqli_query($conexion, $sql);

// Crear la tabla HTML para mostrar los datos
 echo '<link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>


<div class="container">
<h2>Datos de la Tabla Negocios</h2>
<table border="1" class="table">
<tr><th>Negocio</th><th>Giro</th><th>E-mail</th><th>Direccion</th><th>Categoria</th></tr>';



while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    echo "<td>".$fila['negocio']."</td>";
    echo "<td>".$fila['giro']."</td>";
    echo "<td>".$fila['email']."</td>";
    echo "<td>".$fila['direccion']."</td>";
    echo "<td>".$fila['categoria']."</td>";
    echo "</tr>";
    }

echo "</table>";

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
