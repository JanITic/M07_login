<?php
// Inicia la sesión
session_start();

// Incluye la configuración de la base de datos (dbConf.php)
include("dbConf.php");

// Comprueba si el usuario ha iniciado sesión
if ($_SESSION['LoggedIn'] == false) {
    // Si el usuario no ha iniciado sesión, redirige a la página de inicio de sesión
    header('Location: login.html');
} else {
    // Define una función que retorna todos los usuarios
    function allUsers($connect, $query2) {
        // Ejecuta una consulta SQL en la base de datos y retorna el resultado
        $totsUse = mysqli_query($connect, $query2);
        return $totsUse;
    }

    // Intenta conectar a la base de datos utilizando la configuración proporcionada
    $connect = mysqli_connect(DB_HOST, DB_USERS, DB_PSW, DB_NAME, DB_PORT);

    if ($connect) {
        // Comprueba si la cookie tiene algún idioma guardado
        if (isset($_COOKIE["lang"])) {
            // Dependiendo del idioma almacenado en la cookie, muestra saludos y tablas con información de usuarios
            if ($_COOKIE['lang'] == "cat") {
                if ($_SESSION['rol'] == "alumnat") {
                    echo "<h2>Hola " . $_SESSION['name'] . ", ets alumne!</h2>";
                } else {
                    echo "<h2>Hola " . $_SESSION['name'] . ", ets professor!</h2>";
                    ?>
                    <table border="1">
                        <tr>
                            <th>Nom</th>
                            <th>Cognom</th>
                            <th>Email</th>
                        </tr>
                        <?php
                        // Select de todos los usuarios
                        $query2 = "SELECT * FROM `user`";
                        $concat = '';
                        $totUse = allUsers($connect, $query2);
                        while ($use = mysqli_fetch_assoc($totUse)) {
                            $concat .= '<tr>';
                            $concat .= '<td>' . $use['name'] . '</td>';
                            $concat .= '<td>' . $use['surname'] . '</td>';
                            $concat .= '<td>' . $use['email'] . '</td>';
                            $concat .= '</tr>';
                        }
                        echo $concat;
                        ?>
                    </table>
                <?php
                }
            } else if ($_COOKIE["lang"] == "es") {
                if ($_SESSION['rol'] == "alumnat") {
                    echo "<h2>Hola " . $_SESSION['name'] . ", eres alumno!</h2>";
                } else {
                    echo "<h2>Hola " . $_SESSION['name'] . ", eres profesor!</h2>";
                    ?>
                    <table border="1">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                        </tr>
                        <?php
                        // Select de todos los usuarios
                        $query2 = "SELECT * FROM `user`";
                        $concat = '';
                        $totUse = allUsers($connect, $query2);
                        while ($use = mysqli_fetch_assoc($totUse)) {
                            $concat .= '<tr>';
                            $concat .= '<td>' . $use['name'] . '</td>';
                            $concat .= '<td>' . $use['surname'] . '</td>';
                            $concat .= '<td>' . $use['email'] . '</td>';
                            $concat .= '</tr>';
                        }
                        echo $concat;
                        ?>
                    </table>
                <?php
                }
            } else if ($_COOKIE["lang"] == "en") {
                if ($_SESSION['rol'] == "alumnat") {
                    echo "<h2>Hello " . $_SESSION['name'] . ", you are a student!</h2>";
                } else {
                    echo "<h2>Hello " . $_SESSION['name'] . ", you are a teacher!</h2>";
                    ?>
                    <table border="1">
                        <tr>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Email</th>
                        </tr>
                        <?php
                        // Select de todos los usuarios
                        $query2 = "SELECT * FROM `user`";
                        $concat = '';
                        $totUse = allUsers($connect, $query2);
                        while ($use = mysqli_fetch_assoc($totUse)) {
                            $concat .= '<tr>';
                            $concat .= '<td>' . $use['name'] . '</td>';
                            $concat .= '<td>' . $use['surname'] . '</td>';
                            $concat .= '<td>' . $use['email'] . '</td>';
                            $concat .= '</tr>';
                        }
                        echo $concat;
                        ?>
                    </table>
                <?php
                }
            }
        } else {
            // Si no hay una cookie de idioma, muestra saludos y tablas con información de usuarios en un idioma predeterminado
            if ($_SESSION['rol'] == "alumnat") {
                echo "<h2>Hola " . $_SESSION['name'] . ", ets alumne!</h2>";
            } else {
                echo "<h2>Hola " . $_SESSION['name'] . ", ets professor!</h2>";
                ?>
                <table border="1">
                    <tr>
                        <th>Nom</th>
                        <th>Cognom</th>
                        <th>Email</th>
                    </tr>
                    <?php
                    // Select de todos los usuarios
                    $query2 = "SELECT * FROM `user`";
                    $concat = '';
                    $totUse = allUsers($connect, $query2);
                    while ($use = mysqli_fetch_assoc($totUse)) {
                        $concat .= '<tr>';
                        $concat .= '<td>' . $use['name'] . '</td>';
                        $concat .= '<td>' . $use['surname'] . '</td>';
                        $concat .= '<td>' . $use['email'] . '</td>';
                        $concat .= '</tr>';
                    }
                    echo $concat;
                    ?>
                </table>
            <?php
            }
        }
        // Cierra la conexión a la base de datos
        mysqli_close($connect);
    } else {
        // Si no se puede conectar a la base de datos, muestra un mensaje de error
        echo "Error de conexión a la base de datos";
    }
}
?>
<p>
<?php
if (isset($_COOKIE["lang"])) {
    if ($_COOKIE["lang"] == 'cat') {
        // Muestra enlaces para cambiar el idioma y realizar otras acciones según el idioma de la cookie
        ?>
        <a style="color: red" href="idioma.php?lang=cat">Cat</a>
        <a href="idioma.php?lang=es">Es</a>
        <a href="idioma.php?lang=en">En</a>
        <a href="delete.php">Eliminar</a><br><br>
        <a href="userdetails.php?id=<?php echo $_SESSION["user_id"]; ?>">Mostrar més informació</a></br>
        <a href="desconectar.php">Desconnectar</a>
        <?php
    } else if ($_COOKIE["lang"] == 'es') {
        // Muestra enlaces para cambiar el idioma y realizar otras acciones según el idioma de la cookie
        ?>
        <a href="idioma.php?lang=cat">Cat</a>
        <a style="color: red" href="idioma.php?lang=es">Es</a>
        <a href="idioma.php?lang=en">En</a>
        <a href="delete.php">Eliminar</a><br><br>
        <a href="userdetails.php?id=<?php echo $_SESSION["user_id"]; ?>">Mostrar mas información</a></br>
        <a href="desconectar.php">Desconnectar</a>
        <?php
    } else if ($_COOKIE["lang"] == 'en') {
        // Muestra enlaces para cambiar el idioma y realizar otras acciones según el idioma de la cookie
        ?>
        <a href="idioma.php?lang=cat">Cat</a>
        <a href="idioma.php?lang=es">Es</a>
        <a style="color: red" href="idioma.php?lang=en">En</a>
        <a href="delete.php">Delete</a><br><br>
        <a href="userdetails.php?id=<?php echo $_SESSION["user_id"]; ?>">Show more info</a></br>
        <a href="desconectar.php">Disconnect</a>
        <?php
    }
} else {
    // Si no hay una cookie de idioma, muestra enlaces en un idioma predeterminado
    ?>
    <a style="color: red" href="idioma.php?lang=cat">Cat</a>
    <a href="idioma.php?lang=es">Es</a>
    <a href="idioma.php?lang=en">En</a>
    <a href="delete.php">Eliminar</a><br><br>
    <a href="userdetails.php?id=<?php echo $_SESSION["user_id"]; ?>">Mostrar més informació</a></br>
    <a href="desconectar.php">Desconnectar</a>
<?php
}
?>
</p>





                   
