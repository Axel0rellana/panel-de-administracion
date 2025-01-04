<?php

include("../../bd.php");

if($_POST){
	$nombredelpuesto = (isset($_POST['nombredelpuesto']) ? $_POST['nombredelpuesto'] : "");
	$sql = "INSERT INTO tbl_puestos (id, nombredelpuesto) VALUES (NULL, :nombredelpuesto)";
	$consulta = $conexion->prepare($sql);
	$consulta->bindParam(":nombredelpuesto", $nombredelpuesto);
	$consulta->execute();
	$mensaje = "Registro agregado";
	header("location:index.php?mensaje=".$mensaje);
}

?>
<?php include("../../templates/header.php"); ?>

<div class="card">
	<div class="card-header bg-dark text-white">
		Puestos
	</div>

	<div class="card-body">
		<form action="" method="post" enctype="multipart/form-data">
			<div class="mb-3">
				<input class="form-control" type="text" name="nombredelpuesto" id="nombredelpuesto" placeholder="Nombre del puesto" autocomplete="off" required />
			</div>

			<button class="btn btn-success" type="submit">Agregar</button>
			<a class="btn btn-danger" href="index.php" role="button">Cancelar</a>
		</form>
	</div>
</div>

<?php include("../../templates/footer.php"); ?>