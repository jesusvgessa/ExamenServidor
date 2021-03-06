<!-- Jesus Vazquez Gessa -->
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
            <h1>EXAMEN DE ENTORNO SERVIDOR</h1>
        </header>
        <nav>
            <ul>
                <li><a href="index.html">Nueva Vivienda</a></li>
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
                $extras="";
                $piscina=array_key_exists("Piscina",$_POST) ? $_POST["Piscina"] : "";
                $jardin=array_key_exists("Jardin",$_POST) ? $_POST["Jardin"] : "";
                $garage=array_key_exists("Garaje",$_POST) ? $_POST["Garaje"] : "";
                if($piscina!=""){
                    $extras .= $_POST["Piscina"];
                }
                if($jardin!="" && $piscina!=""){
                    $extras .= ",".$_POST["Jardin"];
                }else if($jardin!="" && $piscina==""){
                    $extras .= $_POST["Jardin"];
                }
                if($garage!="" && ($jardin!="" || $piscina!="")){
                    $extras .= ",".$_POST["Garaje"];
                }else if($garage!="" && $jardin=="" && $piscina==""){
                    $extras .= $_POST["Garaje"];
                }
            
            //Opcion por defecto de ndormitorios es 3
            function filtroDorm($valor){
                if ($valor == null || $valor == 0 ){
                    $valor = 3;
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
            
            $id = insertaVivienda($_POST["tipo"], $_POST["zona"], seguro($_POST["direccion"]), filtroDorm($_POST["ndormitorios"]), $_POST["precio"], $_POST["tamano"], $extras, $avatar, seguro($_POST["observaciones"]));
            if ($id != 0) {
                echo "<div class='insercion'>";
                echo "<h1>Insercion de vivienda</h1><br>";
                echo "<p>Estos son los datos introducidos</p><br>";
                echo "<ul>";
                echo "<li>Tipo: ".$_POST["tipo"]."</li>";
                echo "<li>Zona: ".$_POST["zona"]."</li>";
                echo "<li>Direccion: ".$_POST["direccion"]."</li>";
                echo "<li>Numero de dormitorios: ".$_POST["ndormitorios"]."</li>";
                echo "<li>Precio: ".$_POST["precio"]."???</li>";
                echo "<li>Tama??o: ".$_POST["tamano"]." metros cuadrados</li>";
                echo "<li>Extras: ".$_POST["extras"]."</li>";
                echo "<li>Foto: ".$avatar."</li>";
                echo "<li>Observaciones: ".$_POST["observaciones"]."</li>";
                echo "</ul><br>";
                echo "<a href='index.html'>[ Insertar otra vivienda ]</a>" ;
                echo "</div>";
            } else {
                echo "<div class='insercion'>";
                echo "<h1>Insercion de vivienda</h1><br>";
                echo "<p>No se ha podido realizar la insercion debido a los siguientes errores:</p><br>";
                echo "<ul>";
                echo "<li>Tipo: </li>";
                echo "<li>Zona: </li>";
                echo "<li>Direccion: </li>";
                echo "<li>Numero de dormitorios: </li>";
                echo "<li>Precio: ???</li>";
                echo "<li>Tama??o: metros cuadrados</li>";
                echo "<li>Extras: </li>";
                echo "<li>Foto: </li>";
                echo "<li>Observaciones: </li>";
                echo "</ul><br>";
                echo "<a href='index.html'>[ Volver ]</a>" ;
                echo "</div>";
            }//Fin Si
        }//Fin Si
        ?>

    </body>
</html>