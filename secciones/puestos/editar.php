<?php

include("../../bd.php");

if(isset($_GET['txtID'])){
	$txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");
	$sql = "SELECT * FROM tbl_puestos WHERE id=:id";
	$consulta = $conexion->prepare($sql);
	$consulta->bindParam(":id", $txtID);
	$consulta->execute();
	$puesto = $consulta->fetch(PDO::FETCH_LAZY);
	$nombredelpuesto = $puesto['nombredelpuesto'];
}

if($_POST){
	$txtID = (isset($_POST['txtID']) ? $_POST['txtID'] : "");
	$nombredelpuesto = (isset($_POST['nombredelpuesto']) ? $_POST['nombredelpuesto'] : "");
	$sql = "UPDATE tbl_puestos SET nombredelpuesto=:nombredelpuesto WHERE id=:id";
	$consulta = $conexion->prepare($sql);
	$consulta->bindParam(":nombredelpuesto", $nombredelpuesto);
	$consulta->bindParam(":id", $txtID);
	$consulta->execute();
	$mensaje = "Registro actualizado";
	header("location:index.php?mensaje=".$mensaje);
}

?>
<?php include("../../templates/header.php"); ?>

<div class="card">
	<div class="card-header bg-dark text-white">
		Puesto
	</div>

	<div class="card-body">
		<form action="" method="post" enctype="multipart/form-data">
			<div class="mb-3">
				<input class="form-control" readonly type="text" name="txtID" id="txtID" placeholder="ID" value="<?php echo $txtID; ?>" />
			</div>

			<div class="mb-3">
				<input class="form-control" type="text" name="nombredelpuesto" id="nombredelpuesto" placeholder="Nombre del puesto" value="<?php echo $nombredelpuesto; ?>" autocomplete="off" required />
			</div>

			<button class="btn btn-success" type="submit">Editar</button>
			<a class="btn btn-danger" href="index.php" role="button">Cancelar</a>
		</form>
	</div>
</div>

<?php include("../../templates/footer.php"); ?>