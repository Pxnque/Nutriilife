<?php
session_start();

// Configuración de la conexión a la base de datos
$host = "localhost";
$port = "5432";
$dbname = "NutriiLife";
$user = "postgres";
$password = "1234";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Error de conexión: " . pg_last_error());
}

$usuario = $_POST['usuario'];
$new_password = $_POST['new_password'];

// Verificar si el usuario existe
$sql_check = "SELECT id FROM usuarios WHERE usuario = '$usuario'";
$result_check = pg_query($conn, $sql_check);

if (pg_num_rows($result_check) > 0) {
    // Actualizar la contraseña
    $sql_update = "UPDATE usuarios SET contrasena = '$new_password' WHERE usuario = '$usuario'";
    $result_update = pg_query($conn, $sql_update);

    if ($result_update) {
        echo "<script>
                alert('Contraseña actualizada con éxito');
                window.location.href = '../Login.html';
              </script>";
    } else {
        echo "<script>
                alert('Error al actualizar la contraseña');
                window.location.href = '../OlvidarContrasena.html';
              </script>";
    }
} else {
    echo "<script>
            alert('Usuario no encontrado');
            window.location.href = '../OlvidarContrasena.html';
          </script>";
}

pg_close($conn);
?>
