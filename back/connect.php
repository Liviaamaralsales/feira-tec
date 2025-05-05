<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'feira';

$mysqli = new mysqli($hostname, $username, $password, $database);

if($mysqli->error){
    die("Falha na conexão com o banco de dados.");
    echo "$mysqli->error";
}
?>