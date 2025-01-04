<?php

include("../../bd.php");

if(isset($_GET['txtID'])){
	$txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");
	$sql = "DELETE FROM tbl_puestos WHERE id=:txtID";
	$consulta = $conexion->prepare($sql);
	$consulta->bindParam(":txtID", $txtID);
	$consulta->execute();
	$mensaje = "Registro eliminado";
	header("location:index.php?mensaje=".$mensaje);
}

$sql = "SELECT * FROM tbl_puestos";
$consulta = $conexion->prepare($sql);
$consulta->execute();
$lista_tbl_puestos = $consulta->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include("../../templates/header.php"); ?>
<div class="card">
	<div class="card-header">
		<a class="btn btn-primary" href="crear.php" role="button">Agregar puesto</a>
	</div>

	<div class="card-body">
		<div class="table-resposive-sm">
			<table class="table" id="tabla_id">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre del puesto</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($lista_tbl_puestos as $puesto) { ?>
						<tr>
							<td><?php echo $puesto['id']; ?></td>
							<td><?php echo $puesto['nombredelpuesto']; ?></td>
							<td>
								<a class="btn btn-warning" href="editar.php?txtID=<?php echo $puesto['id']; ?>" name="btneditar" id="btneditar" role="button">Editar</a>
								<a class="btn btn-danger" href="javascript:borrar(<?php echo $puesto['id']; ?>)" name="btnborrar" id="btnborrar" role="button">Borrar</a>
							</td>
						</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php include("../../templates/footer.php"); ?>