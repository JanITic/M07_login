<?php
session_start();
include("dbConf.php");

$connect = mysqli_connect(DB_HOST, DB_USERS, DB_PSW, DB_NAME, DB_PORT);

// Comprueba si el usuario está autenticado
if (!isset($_SESSION['LoggedIn']) || $_SESSION['LoggedIn'] !== true) {
    // Si no está autenticado, redirige a la página de inicio de sesión
    header("Location: login.html");
    exit;
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $query = "SELECT * FROM `user` WHERE `user_id` = $userId";
    $result = mysqli_query($connect, $query);

    // Comprueba la consulta
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        echo "Informació detallada de l'usuari:<br>";
        echo "Nom: " . $user['name'] . "<br>";
        echo "Cognom: " . $user['surname'] . "<br>";
        echo "Email: " . $user['email'] . "<br>";
        echo "Rol: " . $user['rol'] . "<br>";
        echo "Contrasenya: " . $user['password'] . "<br>";
        echo "ID: " . $user['user_id'] . "<br>";
        echo "Actiu: " . $user['active'] . "<br>";

        // Agrega un enlace para volver a "dashboard.php"
        echo '<a href="dashboard.php">Tornar</a>';
    } else {
        echo "Usuari no trobat.";
    }
} else {
    echo "Falta el parámetro 'id' en la URL.";
}
?>

