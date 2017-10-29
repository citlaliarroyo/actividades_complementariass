<?php
	require_once('../conexion/conexion.php');
	$title = 'Solicitudes';
	$title_menu = 'Solicitudes';

	// Consulta para mostrar los datos de la tabla "solicitud"
  $sql_solicitud = 'SELECT * FROM solicitud';
	$statement_solicitud= $pdo->prepare($sql_solicitud);
	$statement_solicitud->execute(array());
	$results_solicitud=$statement_solicitud->fetchAll();

	$show_form = FALSE;

	if($_POST)
	{
	  	//TODO:UPDATE ARTICLE
	  	$sql_update_details = 'UPDATE solicitud SET folio = ?, asunto = ?,
			fecha = ?, lugar = ?, instituto_clave_instituto = ?, instructor_rfc_instructor = ?, estudiante_No_control_estudiante = ?
			WHERE folio_2 = ?';

		  $folio = isset($_GET['folio']) ? $_GET['folio']: '';
		  $folio_2 = isset($_POST['folio_2']) ? $_POST['folio_2']: '';
  		$asunto = isset($_POST['asunto']) ? $_POST['asunto']: '';
  		$fecha = isset($_POST['fecha']) ? $_POST['fecha']: '';
  		$lugar = isset($_POST['lugar']) ? $_POST['lugar']: '';
  		$instituto_clave = isset($_POST['instituto_clave_instituto']) ? $_POST['instituto_clave_instituto']: '';
  		$instructor_rfc = isset($_POST['instructor_rfc_instructor']) ? $_POST['instructor_rfc_instructor']: '';
      $estudiante_No_contro = isset($_POST['estudiante_No_control_estudiante']) ? $_POST['estudiante_No_control_estudiante']: '';

	  	$statement_update_details = $pdo->prepare($sql_update_details);
	  	$statement_update_details->execute(array($folio_2, $asunto,
			$fecha,$lugar,$instituto_clave,$instructor_rfc,$estudiante_No_contro,$folio ));
	  	header('Location: modificar_solicitud.php');
	}

	if(isset( $_GET['folio'] ) )
	{
		//TODO: GET DETAILS
		$show_form = TRUE;
		$sql_update = 'SELECT solicitud.*, instituto.nombre_instituto, instructor.nombre_instructor, estudiante.nombre_estudiante FROM solicitud
  	INNER JOIN instituto ON instituto.clave_instituto = solicitud.instituto_clave_instituto INNER JOIN instructor ON instructor.rfc_instructor = solicitud.instructor_rfc_instructor
  	INNER JOIN estudiante ON estudiante.No_control = solicitud.estudiante_No_control_estudiante WHERE folio_2 = ?';
		$folio = isset( $_GET['folio']) ? $_GET['folio'] : 0;

		$statement_update = $pdo->prepare($sql_update);
		$statement_update->execute(array($folio));
		$result_details = $statement_update->fetchAll();
		$rs_details = $results_solicitud[0];

	}

	$sql_status = 'SELECT solicitud.*, instituto.nombre_instituto, instructor.nombre_instructor, estudiante.nombre_estudiante FROM solicitud
	INNER JOIN instituto ON instituto.clave_instituto = solicitud.instituto_clave_instituto INNER JOIN instructor ON instructor.rfc_instructor = solicitud.instructor_rfc_instructor
	INNER JOIN estudiante ON estudiante.No_control = solicitud.estudiante_No_control_estudiante';
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
          							<input value='<?php echo $rs_details['folio'] ?>' name='folio_2' type="text">
        						</div>
							</div>
							<div class="row">
        						<div class="input-field col s12">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input value='<?php echo $rs_details['asunto'] ?>' name='asunto' type="text">
        						</div>
        						<div class="input-field col s12">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          							<input value="<?php echo $rs_details['fecha'] ?>" name="fecha" type="text">
        						</div>
        						<div class="input-field col s12">
        							<!--<i class="material-icons prefix">account_circle</i>-->
          						<input value="<?php echo $rs_details['lugar'] ?>" name="lugar" type="text">
        						</div>
        					</div>
        					<div class="row">
        						<div class="input-field col s12">
    								<select name="instituto_clave_instituto">
			      						<option value="" disabled selected>Elige la clave del instituto</option>
                        <?php
                        foreach($results_solicitud as $rs){
                         ?>
                         <option value="<?php echo $rs['instituto_clave_instituto']?>"><?php echo $rs['instituto_clave_instituto']?></option>
                         	<?php
   				          					}
   				        				?>
                        </select>
                      </div>
                      </div>
                      <div class="row">
            						<div class="input-field col s12">
        								<select name="instructor_rfc_instructor">
    			      						<option value="" disabled selected>Elige el rfc del instructor</option>
                            <?php
                            foreach($results_solicitud as $rs){
                             ?>
                             <option value="<?php echo $rs['instructor_rfc_instructor']?>"><?php echo $rs['instructor_rfc_instructor']?></option>
                             	<?php
       				          					}
       				        				?>
                            </select>
                          </div>
                          </div>
                          <div class="row">
                						<div class="input-field col s12">
            								<select name="estudiante_No_control_estudiante">
        			      						<option value="" disabled selected>Elige el numero de control del estudiante</option>
                                <?php
                                foreach($results_solicitud as $rs){
                                 ?>
                                 <option value="<?php echo $rs['estudiante_No_control_estudiante']?>"><?php echo $rs['estudiante_No_control_estudiante']?></option>
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
				    <h3>Solicitud</h3>
				    <table class="striped">
					  <thead>
					    <tr>
                <th>Folio</th>
                <th>Asunto</th>
                <th>Fecha</th>
                <th>Lugar</th>
                <th>Instituto Clave</th>
                <th>Instructor Rfc</th>
                <th>No Control Estudiante</th>
				        <th colspan="2">Acción</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php
				        	foreach($results_solicitud as $rs2) {
				        ?>
					    <tr>
					    	<td><?php echo $rs2['folio']?></td>
							<td><?php echo $rs2['asunto']?></td>
							<td><?php echo $rs2['fecha']?></td>
							<td><?php echo $rs2['lugar']?></td>
							<td><?php echo $rs2['instituto_clave_instituto']?></td>
							<td><?php echo $rs2['instructor_rfc_instructor']?></td>
              <td><?php echo $rs2['estudiante_No_control_estudiante']?></td>
							<td><a class="btn waves-effect waves-light" href="modificar_solicitud.php?folio=<?php
							echo $rs2['folio']; ?>">Ver detalles</a></td>
							<td><a class="btn waves-effect waves-light red" onclick="delete_solicitud(<?php echo $rs2['folio']; ?>)" href="#">ELIMINAR</a>
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
