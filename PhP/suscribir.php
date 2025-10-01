<?php
session_start();

// Configuración de la conexión a la base de datos
$host = "db";
$port = "5432";
$dbname = "NutriiLife";
$user = "postgres";
$password = "1234";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Error de conexión: " . pg_last_error());
}

$usuario_id = $_POST['usuario_id'];
$plan_nombre = $_POST['plan_nombre'];
$plan_costo = $_POST['plan_costo'];

// Verificar si el usuario ya está suscrito a un plan
$sql_check = "SELECT * FROM suscripciones WHERE usuario_id = $usuario_id";
$result_check = pg_query($conn, $sql_check);

if (pg_num_rows($result_check) > 0) {
    // Usuario ya está suscrito
    echo "Ya está suscrito a un plan.";
} else {
    // Insertar nueva suscripción
    $sql = "INSERT INTO suscripciones (usuario_id, plan_nombre, costo_mensual, fecha_suscripcion) 
            VALUES ($usuario_id, '$plan_nombre', $plan_costo, CURRENT_TIMESTAMP)";
    $result = pg_query($conn, $sql);

    if ($result) {
        echo "Suscripción realizada con éxito.";
    } else {
        echo "Error al realizar la suscripción.";
    }
}

pg_close($conn);
?>
