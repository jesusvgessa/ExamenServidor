<?php

$usuario = $_POST['usuario'];
$pass = $_POST['pass'];

//Si el usuario y la contraseña son iguales, inicio sesion
if ($usuario == $pass && $usuario != "" && $pass!=""){
    // Si se usa debe contener (sólo caracteres alfanuméricos) e ir antes de session_start():
    session_id("inicioSesion");

    // Iniciar la sesión
    session_start();

    // Variables de sesión:
    $_SESSION['sesion_iniciada'] = true;
    $_SESSION['username'] = $usuario;
    header("location: paginaprincipal.php");
}else{
    header("location: error.php");
}//Fin Si

?>