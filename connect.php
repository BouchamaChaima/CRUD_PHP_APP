<?php
$servername = "localhost";
$dbname = "simple";
$username = "cham";
$pw = "_@Bdx35BYGfc8wef";

try {
    $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $pw);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>