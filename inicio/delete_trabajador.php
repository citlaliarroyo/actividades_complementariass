<?php
require_once('../conexion/conexion.php');

	$rfc = isset( $_GET['rfc_trabajador']) ? $_GET['rfc_trabajador'] : '0';

$sql ='DELETE FROM trabajador WHERE rfc_trabajador=?';


$statement = $pdo->prepare($sql);
$statement->execute(array($rfc));

$results = $statement->fetchAll();
header('Location: modificar_trabajador.php')
?>
