<!-- Jesus Vazquez Gessa -->
<?php
$servidor = "localhost";
$baseDatos = "lindavista";
$usuario = "root";
$pass = "";

function obtenerTodas(){
    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['usuario'], $GLOBALS['pass']);
        $sql = $con->prepare("SELECT id, tipo, zona, direccion ,ndormitorios, precio, tamano, extras, foto, observaciones from viviendas ORDER BY precio;");
        $sql->execute();
        $miArray = [];
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) { //Haciendo uso de PDO iremos creando el array dinámicamente
            $miArray[] = $row; //https://www.it-swarm-es.com/es/php/rellenar-php-array-desde-while-loop/972445501/
        }
        $con = null;
    } catch (PDOException $e) {
        echo $e;
    }
    return $miArray;
}

function insertaVivienda($tipo, $zona, $direccion, $ndormitorios, $precio, $tamano, $extras ,$foto ,$observaciones){
    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['usuario'], $GLOBALS['pass']);
        $sql = $con->prepare("INSERT into viviendas values(null,:tipo,:zona,:direccion,:ndormitorios,:precio,:tamano,(:extras),:foto,:observaciones)");
        $sql->bindParam(":tipo", $tipo);
        $sql->bindParam(":zona", $zona);
        $sql->bindParam(":direccion", $direccion);
        $sql->bindParam(":ndormitorios", $ndormitorios);
        $sql->bindParam(":precio", $precio);
        $sql->bindParam(":tamano", $tamano);
        $sql->bindParam(":extras", $extras);
        $sql->bindParam(":foto", $foto);
        $sql->bindParam(":observaciones", $observaciones);
        $sql->execute();
        $id = $con->lastInsertId();
        $con = null;
    } catch (PDOException $e) {
        echo $e;
    }
    return $id;
}

?>