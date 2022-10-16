<?php

$servername = "remotemysql.com";
$username = "GBtyfP4tfL";
require("mysql.password.php");
$dbname = "GBtyfP4tfL";
try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 	
    }
catch(PDOException $e)
    {
    echo "<br>PDO error: " . $e->getMessage();
    }

?>