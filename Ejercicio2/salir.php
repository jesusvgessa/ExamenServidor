<?php

// Continuar la sesión
session_start();

if( isset($_SESSION['sesion_iniciada']) == true ){
    //Borrar variables de la sesion.
    session_unset(); 

    // Destruye el resto de información sobre la sesión
    session_destroy();

    //Vuelve al inicio de sesion
    header("location: index.html");
}else{
    echo "<h2>Todavia no se ha introducido usuario y contraseña</h2><br>";

    echo "<a href='index.html'>[ Volver ]</a>";
}//Fin Si

?>