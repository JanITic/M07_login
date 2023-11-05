<?php
    // Creem la cookie
    setcookie("lang", $_GET["lang"], time()+600);
    header("Location: dashboard.php")
?>