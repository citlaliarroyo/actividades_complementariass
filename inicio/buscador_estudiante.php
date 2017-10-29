<?php
	require_once('../conexion/conexion.php');
?>
<?php
	$sql_estudiante = 'SELECT * FROM estudiante WHERE nombre_estudiante LIKE :search';
	$search_terms = isset($_GET['nombre_estudiante'])? $_GET["nombre_estudiante"]: '';
	$arr_sql_terms[':search'] = '%' . $search_terms .'%';
	$statement_estudiante = $pdo->prepare($sql_estudiante);
	$statement_estudiante->execute($arr_sql_terms);
	$results_estudiante = $statement_estudiante->fetchAll();

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
                <a href="#" class="brand-logo right">Estudiantes</a>
                <ul id="nav-mobile" class="left side-nav">
                    <li><a href="index.php">Inicio</a></li>
                </ul>
            </div>
        </nav>
    </div>
		<div class="container">
			<div class="row">
				<div class="col s12">
					<h2>Buscador sencillo con like</h2>
					<hr>
					<form method="get">
							<div class="row">
								<div class="col s12">
									<label>Ingrese el nombre del estudiante
										<input type="text" name="nombre_estudiante" placeholder="ej. Jose">
											<input class="button" type="submit" value="Buscar"/>
										</label>
									</div>
								</div>
							</form>
					<h3>Estudiantes</h3>
					<hr>
					<table class="striped">
				        <thead>
				          <tr>
				              <th>Numero Control</th>
				              <th>Nombre Estudiante</th>
				              <th>Apellido Paterno Estudiante</th>
				              <th>Apellido Materno Estudiante</th>
				              <th>Semestre</th>
				              <th>carrera_clave</th>
				          </tr>
				        </thead>
				        <tbody>
				        	<?php
				        		foreach($results_estudiante as $rs) {
				        	?>
				          <tr>
							<td><?php echo $rs['No_control']?></td>
							<td><?php echo $rs['nombre_estudiante']?></td>
							<td><?php echo $rs['apellido_paterno_estudiante']?></td>
							<td><?php echo $rs['apellido_materno_estudiante']?></td>
							<td><?php echo $rs['semestre']?></td>
							<td><?php echo $rs['carrera_clave_carrera']?></td>
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
