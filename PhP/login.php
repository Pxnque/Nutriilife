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

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT id, nombre_completo, usuario FROM usuarios WHERE correo_electronico = '$email' AND contrasena = '$password'";
$result = pg_query($conn, $sql);

if (pg_num_rows($result) > 0) {
    $row = pg_fetch_assoc($result);
    $usuario_id = $row['id'];
    $nombre_completo = $row['nombre_completo'];
    $usuario = $row['usuario'];

    // Obtener el plan del usuario
    $sql_plan = "SELECT plan_nombre FROM suscripciones WHERE usuario_id = $usuario_id";
    $result_plan = pg_query($conn, $sql_plan);

    if (pg_num_rows($result_plan) > 0) {
        $row_plan = pg_fetch_assoc($result_plan);
        $plan_nombre = $row_plan['plan_nombre'];
    } else {
        $plan_nombre = "No suscrito";
    }

    echo "<script>
            localStorage.setItem('usuario_id', '$usuario_id');
            localStorage.setItem('nombre_completo', '$nombre_completo');
            localStorage.setItem('usuario', '$usuario');
            localStorage.setItem('plan_nombre', '$plan_nombre');
            alert('Login realizado con éxito');
            window.location.href = '../LandingPage.html';
          </script>";
} else {
    echo "<script>alert('Login realizado sin éxito'); window.location.href = '../Login.html';</script>";
}

pg_close($conn);
?>
