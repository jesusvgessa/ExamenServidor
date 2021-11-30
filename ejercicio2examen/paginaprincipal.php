<!-- Jesus Vazquez Gessa -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ejercicio1examen/css/style.css">
    <title>Document</title>
</head>
<body>

<div class="form">
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
</div>

</body>
</html>