<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/botonera.css">
        <link rel="stylesheet" href="css/form.css">
        <title>Incluir vivienda</title>
    </head>
    <body>
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

        <nav>
            <ul>
                <li><a class="active" href="insertarVivienda.php">Nueva Vivienda</a></li>
                <li><a href="lista.php">Lista viviendas</a></li>
            </ul>
        </nav>
        <form class="form-register" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data"><!-- para enviar archivos -->
            <h2 class="form-titulo">Inserción de vivienda:</h2>
            <p>Introduzca los datos de la vivienda:</p>
            <div class="contenedor-inputs">
                <table>
                    <tr>
                        <td><b>Tipo de vivienda:</b></td>
                        <td>
                            <select name="tipo" class="input-48">
                                <option value="Piso">Piso</option>
                                <option value="Adosado">Adosado</option>
                                <option value="Chalet">Chalet</option>
                                <option value="Casa">Casa</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Zona:</b></td>
                        <td>
                        <select name="zona" class="input-48">
                            <option value="Centro">Centro</option>
                            <option value="Nervion">Nervion</option>
                            <option value="Triana">Triana</option>
                            <option value="Aljarafe">Aljarafe</option>
                            <option value="Macarena">Macarena</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Direccion:</b></td>
                        <td>
                            <input type="text" name="direccion" placeholder="Direccion" class="input-100" required>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Numero de dormitorios:</b></td>
                        <td>
                            <input type="radio" id="1dormitorio" name="ndormitorios" value="1">
                            <label for="1dormitorio">1</label>
                            <input type="radio" id="2dormitorio" name="ndormitorios" value="2">
                            <label for="2dormitorio">2</label>  
                            <input type="radio" id="3dormitorio" name="ndormitorios" value="3">
                            <label for="3dormitorio">3</label>
                            <input type="radio" id="4dormitorio" name="ndormitorios" value="4">
                            <label for="4dormitorio">4</label>
                            <input type="radio" id="5dormitorio" name="ndormitorios" value="5">
                            <label for="5dormitorio">5</label>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Precio:</b></td>
                        <td>
                            <input type="number" name="precio" placeholder="Precio" class="input-48" required>
                            <label for="precio">€</label>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Tamaño:</b></td>
                        <td>
                            <input type="number" name="tamano" placeholder="Tamaño" class="input-100" required>
                            <label for="tamano">metros cuadrados</label>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Extras (maqrue los que proceda):</b></td>
                        <td>
                            <input type="checkbox" id="extra1" name="extras" value="Piscina">
                            <label for="extra1">Piscina</label>
                            <input type="checkbox" id="extra2" name="extras" value="Jardin">
                            <label for="extra2">Jardin</label>
                            <input type="checkbox" id="extra3" name="extras" value="Garaje">
                            <label for="extra3">Garaje</label>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Foto:</b></td>
                        <td>
                            <input type="file" name="avatar" accept="image/png, image/jpeg" class="input-100">
                        </td>
                    </tr>
                    <tr>
                        <td><b>Observaciones:</b></td>
                        <td>
                        <textarea placeholder="Escribe tu mensaje..." name="observaciones" spellcheck="true" rows="8" cols="50" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Insertar vivienda" class="btn-enviar">
                        </td>
                    </tr>
                </table>
                <div id="errores"><?php echo $error; ?></div>
            </div>
        </form>
    </body>
</html>