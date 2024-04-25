<?php
// Configuración de la conexión a la base de datos
$host = "localhost"; // La dirección del servidor PostgreSQL
$port = "5432"; // Puerto de PostgreSQL (por defecto es 5432)
$dbname = "NutriiLife"; // El nombre de tu base de datos
$user = "postgres"; // Tu nombre de usuario de PostgreSQL
$password = "1234"; // Tu contraseña de PostgreSQL

// Realizar la conexión a PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Verificar si la conexión fue exitosa
if (!$conn) {
    die("Error de conexión: " . pg_last_error());
} else {
    echo "Conexión exitosa<br>"; // Mensaje de depuración
}

// Obtener los datos del formulario enviados por POST
$email = $_POST['email'];
$password = $_POST['password'];

// Consulta SQL para verificar las credenciales del usuario
$sql = "SELECT * FROM Usuarios WHERE correo_electronico = '$email' AND contrasena = '$password'";

// Ejecutar la consulta
$result = pg_query($conn, $sql);

// Verificar si se encontró un usuario con las credenciales proporcionadas
if (pg_num_rows($result) > 0) {
    echo "Inicio de sesión exitoso<br>";
    // Aquí puedes redirigir al usuario a una página de inicio de sesión exitosa o realizar otras acciones
} else {
    echo "Credenciales incorrectas<br>";
}

// Cerrar la conexión
pg_close($conn);
?>
