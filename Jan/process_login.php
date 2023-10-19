<?php
include 'dbConf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $conn = new mysqli(DB_HOST, DB_USER, DB_PSW, DB_NAME, DB_PORT);

    if ($conn->connect_error) {
        echo "Error de conexión a la base de datos: " . $conn->connect_error;
    } else {
        $query = "SELECT user_id, name, surname, email, rol FROM user WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($query);
//hacer con foreach
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $rol = $row["rol"];

            if ($rol === "estudiant") {
                echo "Nombre: " . $row["name"] . "<br>";
                echo "Apellido: " . $row["surname"] . "<br>";
                echo "Email: " . $row["email"];
            } elseif ($rol === "professor") {
                echo "Nombre del profesor: " . $row["name"] . "<br>";
                echo "Apellido del profesor: " . $row["surname"] . "<br>";

                $allUsersQuery = "SELECT name, surname, email FROM user";
                $allUsersResult = $conn->query($allUsersQuery);

                if ($allUsersResult->num_rows > 0) {
                    echo "<h2>Información de todos los usuarios:</h2>";
                    while ($userRow = $allUsersResult->fetch_assoc()) {
                        echo "Nombre: " . $userRow["name"] . ", Apellido: " . $userRow["surname"] . ", Email: " . $userRow["email"] . "<br>";
                    }
                }
            }
        } else {
            header("Location: login.html?error=1");
        }

        $conn->close();
    }
}
?>


