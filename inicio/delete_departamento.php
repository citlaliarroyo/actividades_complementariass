<?php
require_once('../conexion/conexion.php');

$clave_depa = isset( $_GET['ClaveDepa']) ? $_GET['ClaveDepa'] : '0';

$sql ='DELETE FROM departamento WHERE ClaveDepa=?';


$statement = $pdo->prepare($sql);
$statement->execute(array($clave_depa));

$results = $statement->fetchAll();
header('Location: modificar_departamento.php')
?>
