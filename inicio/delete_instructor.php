<?php
require_once('../conexion/conexion.php');

$rfc = isset( $_GET['rfc_instructor']) ? $_GET['rfc_instructor'] : '0';

$sql ='DELETE FROM instructor WHERE rfc_instructor=?';


$statement = $pdo->prepare($sql);
$statement->execute(array($rfc));

$results = $statement->fetchAll();
header('Location: modificar_instructor.php')
?>
