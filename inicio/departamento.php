<?php
	require_once('../conexion/conexion.php');
?>
<?php

	$sql_departamento = 'SELECT * FROM departamento ORDER BY nombre_depa';
	$statement_departamento= $pdo->prepare($sql_departamento);
	$statement_departamento->execute(array());
	$results_departamento=$statement_departamento->fetchAll();

	$sql_trabajador = 'SELECT trabajador.*, departamento.* FROM trabajador INNER JOIN departamento
	ON trabajador.rfc = departamento.trabajador_rfc';
	$statement_trabajador = $pdo->prepare($sql_trabajador);
	$statement_trabajador->execute();
	$results_trabajador = $statement_trabajador->fetchAll();


?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<title>PHP & SQL</title>
		<link rel="stylesheet" href="../css/materialize.min.css">
		</head>

	<body>
		<!--Import jQuery before materialize.js-->
    	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    	<script type="text/javascript" src="js/materialize.min.js"></script>
    	<div class="navbar-fixed">
        <nav class="teal lighten-2">
            <div class="nav-wrapper">
                <a href="#" class="brand-logo right">Instituto</a>
                <ul id="nav-mobile" class="left side-nav">
                    <li><a href="index.php">Inicio</a></li>
                </ul>
            </div>
        </nav>
    </div>
		<div class="container">
			<div class="row">
				<div class="col s12">
					<h3>Departamento</h3>
					<hr>
					<table class="striped">
				        <thead>
				          <tr>
				              <th>Clave Departamento</th>
				              <th>Nombre departamento</th>
											<th>Rfc Trabajador</th>
				          </tr>
				        </thead>
				        <tbody>
				        	<?php
				        		foreach($results_departamento as $rs) {
				        	?>
				          <tr>
							<td><?php echo $rs['ClaveDepa']?></td>
							<td><?php echo $rs['nombre_depa']?></td>
							<td><?php echo $rs['trabajador_rfc']?></td>
				          </tr>
				          <?php
				          	}
				          ?>
				        </tbody>
				    </table>
				</div>
			</div>
			<div class="col s12">
                <footer class="page-footer teal lighten-2">
                    <div class="footer-copyright">
                        <div class="container">
                        </div>
                    </div>
                </footer>
            </div>
		</div>
	</body>
</html>
