<?php
	require_once('../conexion/conexion.php');
	$title = 'Instructores';
	$title_menu = 'Instructores';

	// Consulta para mostrar los datos de la tabla "departamento"
  $sql_departamento = 'SELECT * FROM departamento';
	$statement_departamento= $pdo->prepare($sql_departamento);
	$statement_departamento->execute(array());
	$results_departamento=$statement_departamento->fetchAll();

	$show_form = FALSE;

	if($_POST)
	{
	  	//TODO:UPDATE ARTICLE
	  	$sql_update_details = 'UPDATE departamento SET ClaveDepa = ?, nombre_depa = ?,
			trabajador_rfc = ? WHERE clave_depa_2 = ?';

			$clave_depa = isset($_GET['ClaveDepa']) ? $_GET['ClaveDepa']: '';
			$clave_depa_2 = isset($_POST['clave_depa_2']) ? $_POST['clave_depa_2']: '';
  		$nombre_departamento = isset($_POST['nombre_depa']) ? $_POST['nombre_depa']: '';
  		$trabajador_rfc = isset($_POST['trabajador_rfc']) ? $_POST['trabajador_rfc']: '';

	  	$statement_update_details = $pdo->prepare($sql_update_details);
	  	$statement_update_details->execute(array($clave_depa_2,$nombre_departamento,
			$trabajador_rfc, $clave_depa));
	  	header('Location: modificar_departamento.php');
	}

	if(isset( $_GET['ClaveDepa'] ) )
	{
		//TODO: GET DETAILS
		$show_form = TRUE;
		$sql_update = 'SELECT trabajador.*, departamento.* FROM trabajador INNER JOIN departamento
  	ON trabajador.rfc_trabajador = departamento.trabajador_rfc WHERE ClaveDepa = ?';
		$clave_depa = isset( $_GET['ClaveDepa']) ? $_GET['ClaveDepa'] : 0;

		$statement_update = $pdo->prepare($sql_update);
		$statement_update->execute(array($clave_depa));
		$result_details = $statement_update->fetchAll();
		$rs_details = $result_details[0];

	}

  $sql_status = 'SELECT trabajador.*, departamento.* FROM trabajador INNER JOIN departamento
	ON trabajador.rfc_trabajador = departamento.trabajador_rfc';
  $statement_status = $pdo->prepare($sql_status);
  $statement_status->execute();
  $results_status = $statement_status->fetchAll();
?>
<?php
	include('../extend/header.php');
?>

		<div class="container">
			<div class="row">
				<div class="col s12">
					<h2>Proyecto de actividades complementarias</h2>
					<hr>
					<?php
						if( $show_form )
						{
						?>
						<form method="post">
							<div class="row">
								<div class="input-field col s12">
          							<input value='<?php echo $rs_details['ClaveDepa'] ?>' name='clave_depa_2' type="text">
        						</div>
							</div>
						   <div class="row">
        				<div class="input-field col s12">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input value='<?php echo $rs_details['nombre_depa'] ?>' name='nombre_depa' type="text">
        						</div>
                  </div>
                  <div class="row">
            				<div class="input-field col s12">
    									<select name="trabajador_rfc">
    											<option value="" disabled selected>Elige el nombre del trabajador</option>
                      			<?php
    				        	foreach($results_departamento as $rs) {
    				        	?>
      							<option value="<?php echo $rs['trabajador_rfc']?>"><?php echo $rs['trabajador_rfc']?> </option>
      							<?php
    				          	}
    				        ?>
    						</select>
              </div>
            </div>
        				<input class="btn waves-effect waves-light" type="submit" value="Modificar" />
						</form>
					<?php }
          ?>
          <h3>Departamento</h3>
        <hr>
        <table class="striped">
              <thead>
              <tr>
                  <th>Clave Departamento</th>
                      <th>Nombre Departamento</th>
                      <th>Rfc Trabajador</th>
                      <th colspan="2">Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($results_status as $rs) {
                ?>
                <tr>
            <td><?php echo $rs['ClaveDepa']?></td>
            <td><?php echo $rs['nombre_depa']?></td>
            <td><?php echo $rs['trabajador_rfc']?></td>
            <td><a class="btn waves-effect waves-light" href="modificar_departamento.php?ClaveDepa=<?php
            echo $rs['ClaveDepa']; ?>">Ver detalles</a></td>
						<td><a class="btn waves-effect waves-light red" onclick="delete_departamento('<?php echo $rs["ClaveDepa"]; ?>')" href="#">ELIMINAR</a>
            </tr>
            </tr>
                <?php
                  }
                ?>
            </tbody>
          </table>
        </div>
      </div>
			<?php
				include('../extend/footer.php');
			?>
