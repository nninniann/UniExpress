<?php
$servername = "localhost";
$port = "3306";
$dbname = "midlights";
$username = "annie";
$password = "888";
$driver_options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
 );  

try {
    $dsn = "mysql:host=".$servername.";port=".$port.";dbname=".$dbname;
    $pdo = new PDO($dsn, $username, $password, $driver_options);
} catch (PDOException $e) {
    echo("Internal error, please contact support");
    error_log("error.php, SQL error=".$e->getMessage());
    return;
}
?>

<!-- GRANT ALL ON midlights.* TO 'annie'@'localhost' IDENTIFIED BY '888';
GRANT ALL ON midlights.* TO 'annie'@'127.0.0.1' IDENTIFIED BY '888'; -->
