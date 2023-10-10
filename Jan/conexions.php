<?php
define("DB_HOST","localhost");
define("DB_NAME","users");
define("DB_USERS","root");
define("DB_PSW","");

define("DB_PORT","3306");


$connect = mysqli_connect(DB_HOST, DB_USERS, DB_PSW, DB_NAME, DB_PORT);

// Comprovar la connexió
if (!$connect) {
   echo "Error de conexió: ". mysqli_connect_error();
}else {
    $insert = "INSERT INTO `user`(`user_id`, `name`, `surname`, `password`, `email`, `rol`, `active`) VALUES ($user_id','name','surname','password','email','rol','active')";    
    $query = "";
    $user = mysqli_query($connect, $query);
}


?>