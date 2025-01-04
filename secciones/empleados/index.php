<?php

include("../../bd.php");

if(isset($_GET['txtID'])){
	$txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");
	$sql = "SELECT foto, cv FROM tbl_empleados WHERE id=:id";
	$consulta = $conexion->prepare($sql);
	$consulta->bindParam(":id", $txtID);
	$consulta->execute();
	$registro_recuperado = $consulta->fetch(PDO::FETCH_LAZY);
	if(isset($registro_recuperado['foto']) && $registro_recuperado['foto'] != ""){
		if(file_exists("../../src/assets/images/".$registro_recuperado['foto'])){
			unlink("../../src/assets/images/".$registro_recuperado['foto']);
		}
	}
	if(isset($registro_recuperado['cv']) && $registro_recuperado['cv'] != ""){
		if(file_exists("../../src/assets/resources/".$registro_recuperado['cv'])){
			unlink("../../src/assets/resources/".$registro_recuperado['cv']);
		}
	}
	$sql = "DELETE FROM tbl_empleados WHERE id=:id";
	$consulta = $conexion->prepare($sql);
	$consulta->bindParam(":id", $txtID);
	$consulta->execute();
	$mensaje = "Registro eliminado";
	header("location:index.php?mensaje=".$mensaje);
}

$sql = "SELECT *, (SELECT nombredelpuesto FROM tbl_puestos WHERE tbl_puestos.id = tbl_empleados.idpuesto limit 1) as puesto FROM tbl_empleados";
$consulta = $conexion->prepare($sql);
$consulta->execute();
$lista_tbl_empleados = $consulta->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include("../../templates/header.php"); ?>

<div class="card">
	<div class="card-header">
		<a class="btn btn-primary" href="crear.php" role="button">Agregar empleado</a>
	</div>

	<div class="card-body">
		<div class="table-resposive-sm">
			<table class="table" id="tabla_id">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Foto</th>
						<th>CV</th>
						<th>Puesto</th>
						<th>Fecha de ingreso</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($lista_tbl_empleados as $empleado) { ?>
						<tr>
							<td><?php echo $empleado['id']; ?></td>
							<td><?php echo $empleado['primernombre']; ?> <?php echo $empleado['segundonombre']; ?> <?php echo $empleado['primerapellido']; ?> <?php echo $empleado['segundoapellido']; ?></td>
							<td>
								<img class="border border-3 border-success rounded img-fluid" width="50" src="../../src/assets/images/<?php echo $empleado['foto']; ?>" alt="<?php echo $empleado['primernombre']; ?>" />
							</td>
							<td>
								<a
									class="link-success link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
									href="../../src/assets/resources/<?php echo $empleado['cv']; ?>"
									rel="noopener"
									target="_blank"
								>
									<?php echo $empleado['cv']; ?>
								</a>
							</td>
							<td><?php echo $empleado['puesto']; ?></td>
							<td><?php echo $empleado['fechadeingreso']; ?></td>
							<td>
								<a class="btn btn-success" href="carta_recomendacion.php?txtID=<?php echo $empleado['id']; ?>" role="button">Carta</a>
								<a class="btn btn-warning" href="editar.php?txtID=<?php echo $empleado['id']; ?>" role="button">Editar</a>
								<a class="btn btn-danger" href="javascript:borrar(<?php echo $empleado['id']; ?>)" role="button">Borrar</a>
							</td>
						</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php include("../../templates/footer.php"); ?>