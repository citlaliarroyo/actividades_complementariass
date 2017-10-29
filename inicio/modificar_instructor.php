<?php
	require_once('../conexion/conexion.php');
	$title = 'Instructores';
	$title_menu = 'Instructores';

	// Consulta para mostrar los datos de la tabla "act_complementaria"
	$sql_act = 'SELECT * FROM act_complementaria';
	$statement = $pdo->prepare($sql_act);
	$statement->execute();
	$results = $statement->fetchAll();

	$show_form = FALSE;

	if($_POST)
	{
	  	//TODO:UPDATE ARTICLE
	  	$sql_update_details = 'UPDATE instructor SET rfc_instructor = ?, nombre_instructor = ?,
			apellido_paterno_instructor = ?, apellido_maerno_instructor = ?, act_complementaria_clave_act= ?
			WHERE rfc_2 = ?';

			$rfc = isset($_GET['rfc_instructor']) ? $_GET['rfc_instructor']: '';
			$rfc_2 = isset($_POST['rfc_2']) ? $_POST['rfc_2']: '';
  		$nombre_instructor = isset($_POST['nombre_instructor']) ? $_POST['nombre_instructor']: '';
  		$apellido_p_instructor = isset($_POST['apellido_paterno_instructor']) ? $_POST['apellido_paterno_instructor']: '';
  		$apellido_m_instructor = isset($_POST['apellido_materno_instructor']) ? $_POST['apellido_materno_instructor']: '';
  		$act_complementaria_clave_act = isset($_POST['act_complementaria_clave_act']) ? $_POST['act_complementaria_clave_act']: '';

	  	$statement_update_details = $pdo->prepare($sql_update_details);
	  	$statement_update_details->execute(array($rfc_2,$nombre_instructor,
			$apellido_p_instructor,$apellido_m_instructor,$act_complementaria_clave_act, $rfc));
	  	header('Location: modificar_instructor.php');
	}

	if(isset( $_GET['rfc_instructor'] ) )
	{
		//TODO: GET DETAILS
		$show_form = TRUE;
		$sql_update = 'SELECT instructor.*, act_complementaria.nombre_act FROM instructor INNER JOIN act_complementaria
		ON act_complementaria.clave_act = instructor.act_complementaria_clave_act WHERE rfc_instructor = ?';
		$rfc = isset( $_GET['rfc_instructor']) ? $_GET['rfc_instructor'] : 0;

		$statement_update = $pdo->prepare($sql_update);
		$statement_update->execute(array($rfc));
		$result_details = $statement_update->fetchAll();
		$rs_details = $result_details[0];

	}

  $sql_status = 'SELECT instructor.*, act_complementaria.nombre_act FROM instructor INNER JOIN act_complementaria
  ON act_complementaria.clave_act = instructor.act_complementaria_clave_act';
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
          							<input placeholder='<?php echo $rs_details['rfc_instructor'] ?>' name='rfc_2' type="text">
        						</div>
							</div>
						   <div class="row">
        				<div class="input-field col s12">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input placeholder='<?php echo $rs_details['nombre_instructor'] ?>' name='nombre_instructor' type="text">
        						</div>
                  </div>
                    <div class="row">
        						<div class="input-field col s12">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input placeholder="<?php echo $rs_details['apellido_paterno_instructor'] ?>" name="apellido_paterno_instructor" type="text">
        						</div>
                  </div>
                    <div class="row">
        						<div class="input-field col s12">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          						<input placeholder="<?php echo $rs_details['apellido_materno_instructor'] ?>" name="apellido_materno_instructor" type="text">
        						</div>
                  </div>
        					  <div class="row">
            				<div class="input-field col s12">
    									<select name="act_complementaria_clave_act">
    											<option value="" disabled selected>Elige el nombre de la actividad</option>
                      			<?php
    				        	foreach($results as $rs) {
    				        	?>
      							<option value="<?php echo $rs['clave_act']?>"><?php echo $rs['nombre_act']?> </option>
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
          <h3>Instructor</h3>
        <hr>
        <table class="striped">
              <thead>
              <tr>
                  <th>RFC</th>
                      <th>Nombre</th>
                      <th>Apellido Paterno</th>
                      <th>Apellido Materno</th>
                      <th>Actividad complementaria</th>
                        <th colspan="2">Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($results_status as $rs) {
                ?>
                <tr>
            <td><?php echo $rs['rfc_instructor']?></td>
            <td><?php echo $rs['nombre_instructor']?></td>
            <td><?php echo $rs['apellido_paterno_instructor']?></td>
            <td><?php echo $rs['apellido_materno_instructor']?></td>
            <td><?php echo $rs['act_complementaria_clave_act']?></td>
            <td><a class="btn waves-effect waves-light" href="modificar_instructor.php?rfc_instructor=<?php
            echo $rs['rfc_instructor']; ?>">Ver detalles</a></td>
						<td><a class="btn waves-effect waves-light red" onclick="delete_instructor('<?php echo $rs["rfc_instructor"]; ?>')" href="#">ELIMINAR</a>
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
