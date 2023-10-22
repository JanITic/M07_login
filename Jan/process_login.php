<?php
// Incluir el archivo de configuración de la base de datos
include 'dbConf.php';

// Obtener los valores del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Función para obtener todos los usuarios
function getAllUsers($connection, $query) {
    $result = mysqli_query($connection, $query);
    return $result;
}

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
            foreach ($users as $user) {
                // Comprobar el rol del usuario
                if ($user['rol'] == "alumnat") {
                    echo "soc un alumne<br>";
                    echo "Nom: " . $user['name'] . "<br>";
                    echo "Cognom: " . $user['surname'] . "<br>";
                    echo "Email: " . $user['email'] . "<br>";
                } else {
                    echo "Hola " . $user['name'] . " " . ", ets professor!!<br><br>";

                    // Consultar la base de datos para obtener información de todos los usuarios
                    $query2 = "SELECT name, surname FROM `user`";
                    $allUsers = getAllUsers($connect, $query2);

                    echo "La llista d'usuaris de la base de dades es:<br>";
                    foreach ($allUsers as $use) {
                        echo "Nom i cognom: " . $use['name'] . " " . $use['surname'] . "<br>";
                    }
                }
            }
        } else {
            // Si no se encontraron resultados, redirigir de nuevo al formulario de inicio de sesión
            include('login.html');
            echo "Els valors són incorrectes";
        }
    }
} catch (PDOException $e) {
    echo "Error de connexió en " . DB_NAME;
} finally {
    // Cerrar la conexión a la base de datos
    mysqli_close($connect);
}
?>

