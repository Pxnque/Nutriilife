<?php
// Configuración de la conexión a la base de datos
$host = "localhost"; // La dirección del servidor PostgreSQL
$port = "5432"; // Puerto de PostgreSQL (por defecto es 5432)
$dbname = "NutriiLife"; // El nombre de tu base de datos
$user = "postgres"; // Tu nombre de usuario de PostgreSQL
$password = "2121"; // Tu contraseña de PostgreSQL

// Realizar la conexión a PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Verificar si la conexión fue exitosa
if (!$conn) {
    die("Error de conexión: " . pg_last_error());
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
   
    header("Location: ../Login.html");
    echo "<script>alert('Usuario registrado con éxito');</script>";
} else {
    echo "<script>alert('Error al registrar el usuario');</script>";
    header("Location: ../Registro.html");
}

// Cerrar la conexión
pg_close($conn);
?>
