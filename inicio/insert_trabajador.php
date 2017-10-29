<?php
	require_once('../conexion/conexion.php');
	$title = 'Agregar un nuevo registro';


	if( $_POST )
	{
  		$sql_insert = 'INSERT INTO trabajador (rfc_trabajador, nombre_trabajador, apellido_paterno_trabajador,
			apellido_materno_trabajador ) VALUES( ?, ?, ?, ? )';
  		$No_rfc = isset($_POST['rfc_trabajador']) ? $_POST['rfc_trabajador']: '';
  		$nombre_trabajador = isset($_POST['nombre_trabajador']) ? $_POST['nombre_trabajador']: '';
  		$apellido_p_trabajador = isset($_POST['apellido_paterno_trabajador']) ? $_POST['apellido_paterno_trabajador']: '';
  		$apellido_m_trabajador = isset($_POST['apellido_materno_trabajador']) ? $_POST['apellido_materno_trabajador']: '';
  		$statement_insert = $pdo->prepare($sql_insert);
  		$statement_insert->execute(array($No_rfc, $nombre_trabajador, $apellido_p_trabajador, $apellido_m_trabajador));
	}
  $sql_trabajador = 'SELECT * FROM trabajador ORDER BY nombre_trabajador';
	$statement_trabajador= $pdo->prepare($sql_trabajador);
	$statement_trabajador->execute(array());
	$results_trabajador=$statement_trabajador->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<title><?php echo $title?></title>
		<link rel="stylesheet" href="../css/materialize.css">
		</head>

	<body>
		<!--Import jQuery before materialize.js-->
    	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    	<script type="text/javascript" src="js/materialize.min.js"></script>
    	<div class="navbar-fixed">
        <nav class="teal lighten-2">
            <div class="nav-wrapper">
                <a href="#" class="brand-logo right">trabajador</a>
                <ul id="nav-mobile" class="left side-nav">
                    <li><a href="index.php">Inicio</a></li>
                </ul>
            </div>
        </nav>
    </div>
		<div class="container">
			<div class="row">
				<div class="col s12">
					<h2>Agregar un nuevo trabajador</h2>
					<hr>
				</div>
			</div>
			<div class="row">
				<form method="post" class="col s12">
					<div class="row">
						<div class="input-field col s12">
          				<input placeholder="RFC" name="rfc_trabajador" type="text">
        				</div>
					</div>
					<div class="row">
        				<div class="input-field col s12">
          				<input placeholder="Nombre" name="nombre_trabajador" type="text">
        				</div>
        				<div class="input-field col s12">
          				<input placeholder="Apellido Paterno" name="apellido_paterno_trabajador" type="text">
        				</div>
        				<div class="input-field col s12">
          				<input placeholder="Apellido Materno" name="apellido_materno_trabajador" type="text">
        				</div>
        			</div>
							<input class="btn waves-effect waves-light" type="submit" value="Agregar" />
        		</form>
      		</div>
          <h3>Trabajador</h3>
					<hr>
					<table class="striped">
				        <thead>
				          <tr>
				              <th>RFC</th>
				              <th>Nombre</th>
											<th>Apellido Paterno</th>
											<th>Apellido Materno</th>

				          </tr>
				        </thead>
				        <tbody>
				        	<?php
				        		foreach($results_trabajador as $rs) {
				        	?>
				          <tr>
							<td><?php echo $rs['rfc_trabajador']?></td>
							<td><?php echo $rs['nombre_trabajador']?></td>
							<td><?php echo $rs['apellido_paterno_trabajador']?></td>
							<td><?php echo $rs['apellido_materno_trabajador']?></td>

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
                            &copy; 2017 CITLALI ARROYO ROMERO
                        </div>
                    </div>
                </footer>
            </div>
		</div>
		<!--  Scripts-->
    	<!--Import jQuery before materialize.js-->
      	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      	<script type="text/javascript" src="../js/materialize.min.js"></script>
      	<script>
      		$(document).ready(function() {
    		$('select').material_select();
  			});
      	</script>
	</body>
</html>
