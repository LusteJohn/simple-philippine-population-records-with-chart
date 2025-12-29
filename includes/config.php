<?php
class config {
    function connectDB() {
        require_once("conn.php");
        $db =  new mysqli(H, U, P, DB, PR);
        
        return $db;
    }
}
?>