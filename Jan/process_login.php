<?php
// Incluye el archivo de configuración de la base de datos
include 'dbConf.php';

// Obtener los valores del formulario
$email = $_POST['email'];
$password = $_POST['password'];

try {
    // Establecer una conexión a la base de datos
    $connect = mysqli_connect(DB_HOST, DB_USER, DB_PSW, DB_NAME, DB_PORT);

    // Comprobar si la conexión se ha establecido correctamente
    if ($connect) {
        // Consultar la base de datos para buscar al usuario
        $query = "SELECT * FROM `user` WHERE `email`='$email' AND `password`='$password'";
        $users = mysqli_query($connect, $query);

        // Comprobar si se encontraron resultados
        if (mysqli_num_rows($users) != 0) {
            $user = mysqli_fetch_assoc($users);

            // Iniciar la sesión
            session_start();

            // Guardar variables de sesión
            $_SESSION['LoggedIn'] = true;
            $_SESSION['name'] = $user['name'];
            $_SESSION['rol'] = $user['rol'];
            $_SESSION['user_id'] = $user['user_id'];

            // Redirigir a la página de inicio (index.php)
            header("Location: index.php");
        } else {
            // Si no se encontraron resultados, redirigir de nuevo al formulario de inicio de sesión
            header("Location: login.html?error=1");
        }
    }
} catch (PDOException $e) {
    echo "Error de connexió en " . DB_NAME;
} finally {
    // Cerrar la conexión a la base de datos
    mysqli_close($connect);
}
?>
