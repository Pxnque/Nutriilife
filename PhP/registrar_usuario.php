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
$nombre = $_POST['nombre'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];

// Preparar la consulta SQL
$sql = "INSERT INTO Usuarios (nombre_completo, numero_celular, correo_electronico, usuario, contrasena) 
        VALUES ('$nombre', '$celular', '$email', '$usuario', '$password')";

// Ejecutar la consulta
$result = pg_query($conn, $sql);

// Verificar si la consulta fue exitosa
if ($result) {
    echo "Usuario registrado exitosamente<br>";
} else {
    echo "Error al registrar el usuario: " . pg_last_error($conn) . "<br>"; // Mostrar el error de la base de datos
}

// Cerrar la conexión
pg_close($conn);
?>
