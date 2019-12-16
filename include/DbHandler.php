<?php
/**
 *
 * @About:      Database connection manager class
 * @File:       Database.php
 * @Date:       $Date:$ Nov-2015
 * @Version:    $Rev:$ 1.0
 * @Developer:  Federico Guzman (federicoguzman@gmail.com)
 **/
class DbHandler {
 
    private $conn;
 
    function __construct() {
        require_once dirname(__FILE__) . './DbConnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }
 
    public function createAuto($array)
    {
        $fecha = date('Y-m-d H:i:s'); 

        $name_persona = $array['name_persona'];
        $barrio = $array['barrio'];
        $wpp = $array['wpp'];

        
        $query = "INSERT INTO taxi_pedidos (name_persona, barrio, hora, wpp) VALUES ('$name_persona', '$barrio', now(), $wpp)";
        return $this->conn->query($query);

    }

    public function obtenerAutos(){
        $sql = "SELECT * FROM taxi_pedidos";
        $result = $this->conn->query($sql);
        $currencyArray = array();
        foreach ($result as $row) {
            $currency = array('id'=>$row["id"], 
                'name_persona'=>$row["name_persona"], 
                'barrio'=>$row["barrio"], 
                'hora'=>$row["hora"],
                'wpp'=>$row["wpp"]);
            $currencyArray[] = $currency;
        }
        return $currencyArray;
    }

    public function borrarAuto($id){
        $sql = "DELETE FROM taxi_pedidos WHERE id=$id";
        $result = $this->conn->query($sql);
        return $result;
    }
 
}
 
?>