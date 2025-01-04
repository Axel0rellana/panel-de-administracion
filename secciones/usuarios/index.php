<?php

include("../../bd.php");

if(isset($_GET['txtID'])){
	$txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");
	$sql = "DELETE FROM tbl_usuarios WHERE id=:txtID";
	$consulta = $conexion->prepare($sql);
	$consulta->bindParam(":txtID", $txtID);
	$consulta->execute();
	$mensaje = "Registro eliminado";
	header("location:index.php?mensaje=".$mensaje);
}

$sql = "SELECT * FROM tbl_usuarios";
$consulta = $conexion->prepare($sql);
$consulta->execute();
$lista_tbl_usuarios = $consulta->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include("../../templates/header.php"); ?>

<div class="card">
	<div class="card-header">
		<a class="btn btn-primary" href="crear.php" role="button">Agregar usuario</a>
	</div>

	<div class="card-body">
		<div class="table-resposive-sm">
			<table class="table" id="tabla_id">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre del usuario</th>
						<th>Contraseña</th>
						<th>Correo</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($lista_tbl_usuarios as $usuario) { ?>
						<tr>
							<td><?php echo $usuario['id']; ?></td>
							<td><?php echo $usuario['usuario']; ?></td>
							<td>****</td>
							<td><?php echo $usuario['correo']; ?></td>
							<td>
								<a class="btn btn-warning" href="editar.php?txtID=<?php echo $usuario['id']; ?>" name="btneditar" id="btneditar" role="button">Editar</a>
								<a class="btn btn-danger" href="javascript:borrar(<?php echo $usuario['id']; ?>)" name="btnborrar" id="btnborrar" role="button">Borrar</a>
							</td>
						</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php include("../../templates/footer.php"); ?>