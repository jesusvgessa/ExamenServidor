<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/botonera.css">
        <link rel="stylesheet" href="css/view.css">
        <title>Vista detalle</title>
    </head>
    <body>
        
    <?php include "databaseManagement.inc.php";
    $id=$_GET["varId"];
    $vivienda=obtenerVivienda($id);
    if($vivienda["foto"]=='' || !file_exists("fotos/".$vivienda["foto"])){ //Si no tiene foto asociada o se ha eliminado del directorio
        $vivienda["foto"]="noimage.jpg";
    }
    ?>
        <nav>
            <ul>
                <li><a class="active" href="insertarVivienda.php">Nueva Vivienda</a></li>
                <li><a href="lista.php">Lista viviendas</a></li>
            </ul>
        </nav> 

        <div class="container">
            <header>
                <div class="bio">
                    
                    <img <?php echo "src= 'fotos/".$vivienda['foto']."'";?> class="bg"><!--aquí va el link a la imagen-->
                    <div>
                        <h3><?php echo $vivienda["nombre"]?></h3><!--aquí va el valor del texto 1-->
                        <p><?php echo $vivienda["raza"]?></p><!-- aquí va el valor del texto 2--> 
                        <p><?php echo $vivienda["sexo"]?></p><!-- aquí va el valor del texto 3-->
                    </div>
                </div>
            </header>

            <div class="content">
                <div class="data">
                    <ul>
                        <li>
                        <?php echo $vivienda["dni"]?> <!-- aquí va el valor del número 1-->
                            <span>DNI</span><!-- pon aquí el nombre de tu número 1-->
                        </li>
                        <li>
                        <?php echo $vivienda["edad"]?> <!-- aquí va el valor del número 2-->
                            <span>Edad</span><!-- pon aquí el nombre de tu número 2-->
                        </li>
                        <li>
                        <?php echo $vivienda["fechaAlta"]?> <!-- aquí va el valor de la fecha-->
                            <span>Fecha de alta</span><!-- pon aquí el nombre de tu fecha-->
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </body>
</html>