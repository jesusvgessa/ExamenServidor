<?php

// Continuar la sesión
session_start();

if(isset($_SESSION['sesion_iniciada']) == true ){
    $usuario = $_SESSION['username'];

    echo "<p>Hola, bienvenido de nuevo a nuestra aplicación <b>".$usuario."</b></p><br>";

    echo "<a href='salir.php'>[ Salir ]</a>";
}else{
    echo "<h2>Todavia no se ha introducido usuario y contraseña</h2><br>";

    echo "<a href='index.html'>[ Volver ]</a>";
}//Fin si

?>