<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fontawesome-free-5.15.4-web/css/all.min.css">
    <title>Lista elementos</title>
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
    <table class="styled-table">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Zona</th>
                <th>Dormitorios</th>
                <th>Precio</th>
                <th>Tamaño</th>
                <th>Extras</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php include_once "databaseManagement.inc.php";
            // error_reporting(0);

            $listaViviendas = obtenerTodas();

            for ($i=0;$i<sizeof($listaViviendas);$i++){
                echo "<tr>";
                echo "<td>".$listaViviendas[$i]['tipo']."</td>";
                echo "<td>".$listaViviendas[$i]['zona']."</td>";
                echo "<td>".$listaViviendas[$i]['ndormitorios']."</td>";
                echo "<td>".$listaViviendas[$i]['precio']."</td>";
                echo "<td>".$listaViviendas[$i]['tamano']."</td>";
                echo "<td>".$listaViviendas[$i]['extras']."</td>";
                echo "<td><a href='vista.php?varId=".$listaViviendas[$i]['id']."'><i class='fas fa-images'></i></a></td>";
                echo "</tr>";
            }//Fin Para

            ?>
        </tbody>
    </table>
</body>
</html>