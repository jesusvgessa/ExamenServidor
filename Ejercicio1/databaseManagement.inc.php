<?php
$servidor = "localhost";
$baseDatos = "lindavista";
$usuario = "root";
$pass = "";

function obtenerVivienda($id){
    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['usuario'], $GLOBALS['pass']);
        /*
        La clase PDOStatement es la que trata las sentencias SQL. 
        Una instancia de PDOStatement se crea cuando se llama a PDO->prepare(), 
        y con ese objeto creado se llama a métodos como bindParam() para pasar valores o execute() para ejecutar sentencias. 
        PDO facilita el uso de sentencias preparadas en PHP, que mejoran el rendimiento y la seguridad de la aplicación. 
        Cuando se obtienen, insertan o actualizan datos, el esquema es: PREPARE -> [BIND] -> EXECUTE. 
        Se pueden indicar los parámetros en la sentencia con un interrogante "?" o mediante un nombre específico.
        */
        $sql = $con->prepare("SELECT * from viviendas where id=:id");
        $sql->bindParam(":id", $id); //Para evitar inyecciones SQL
        $sql->execute();
        $row = $sql->fetch(PDO::FETCH_ASSOC); //Recibimos la linea correspondiente en ROW
        $con = null; //Cerramos la conexión
        return $row;
    } catch (PDOException $e) {
        echo $e;
    }
}

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