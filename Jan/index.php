<?php
// Iniciar la sesión
session_start();

// Comprobar si el usuario está autenticado
if (isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] === true) {
    // Comprobar el rol del usuario
    $nombre = $_SESSION['name'];
    $rol = $_SESSION['rol'];

    // Mostrar el saludo
    echo "<h2>Hola $nombre ets un $rol</h2>";

    // Comprobar si el usuario es un profesor
    if ($rol === "professorat") {
        // Realizar una consulta para obtener todos los usuarios de la base de datos
        include 'dbConf.php';

        $connect = mysqli_connect(DB_HOST, DB_USER, DB_PSW, DB_NAME, DB_PORT);

        if ($connect) {
            $query = "SELECT * FROM `user`";
            $allUsers = mysqli_query($connect, $query);

            if (mysqli_num_rows($allUsers) > 0) {
                // Mostrar la tabla con los usuarios
                echo "<h2>Llista d'usuaris de la base de dades:</h2>";
                echo "<table border='1'>
                      <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Cognom</th>
                        <th>Email</th>
                      </tr>";

                while ($user = mysqli_fetch_assoc($allUsers)) {
                    echo "<tr>";
                    echo "<td>" . $user['user_id'] . "</td>";
                    echo "<td>" . $user['name'] . "</td>";
                    echo "<td>" . $user['surname'] . "</td>";
                    echo "<td>" . $user['email'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            }
        }
    }

    // Agregar enlaces para mostrar información detallada de un usuario y desconectar
    echo "<p><a href='detall_usuari.php'>Mostrar informació detallada de l'usuari</a></p>";
    echo "<p><a href='desconectar.php'>Desconnectar</a></p>";
} else {
    // Si el usuario no está autenticado, redirigir a la página de inicio de sesión
    header("Location: login.html");
}
?>
