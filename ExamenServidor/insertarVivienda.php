<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Incluir vivienda</title>
    </head>
    <body>
        <header>

        </header>
        <nav>
            <ul>
                <li><a class="active" href="insertarVivienda.php">Nueva Vivienda</a></li>
                <li><a href="lista.php">Lista viviendas</a></li>
            </ul>
        </nav>
    
        <?php include_once "databaseManagement.inc.php";

        $error = "";
        if (count($_POST) > 0) {
            function seguro($valor) {//Funcion para aumentar la seguridad para los strings
                $valor = strip_tags($valor); //Eliminar o limpiar las etiquetas HTML y PHP de una cadena string. Para evitar ataques XSS
                $valor = stripslashes($valor); //Devuelve una cadena con las barras invertidas eliminadas
                $valor = htmlspecialchars($valor); //se usa para escapar caracteres especiales cuando se trabaja con BBDD
                return $valor;
            }//Fin Funcion

            //Para que si no se marca algun extra, no devuelva un valor nulo.
            function filtrarExtras($valor){
                if ($valor == null){
                    $valor = '';
                }//Fin Si
                return $valor;
            }//Fin Funcion

            $avatar = $_FILES["avatar"]["name"];
            //temp es una copia temporal
            $temp = $_FILES['avatar']['tmp_name'];
            if (move_uploaded_file($temp, 'fotos/' . $avatar)) {
                //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                chmod('fotos/' . $avatar, 0777);
            }//Fin Si
            $id = insertaVivienda($_POST["tipo"], $_POST["zona"], seguro($_POST["direccion"]), $_POST["ndormitorios"], $_POST["precio"], $_POST["tamano"], filtrarExtras($_POST["extras"]), $avatar, seguro($_POST["observaciones"]));
            if ($id != 0) {
                header("Location: vista.php?varId=$id");
                exit();
            } else {
                $error = "Datos incorrectos";
            }//Fin Si
        }//Fin Si
        ?>

    </body>
</html>