<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Nutriilife";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario enviados por AJAX
$data = json_decode(file_get_contents("php://input"), true);

// Obtener los datos individuales
$nombre = $data['nombre'];
$celular = $data['celular'];
$email = $data['email'];
$usuario = $data['usuario'];
$password = $data['password'];

// Preparar la consulta SQL para insertar los datos en la tabla de usuarios
$sql = "INSERT INTO usuarios (nombre_completo, numero_celular, correo_electronico, usuario, contrasena) VALUES ('$nombre', '$celular', '$email', '$usuario', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Usuario registrado exitosamente";
} else {
    echo "Error al registrar el usuario: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
