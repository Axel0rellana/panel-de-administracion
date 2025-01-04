<?php

include("../../bd.php");

if(isset($_GET['txtID'])){
	$txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");
	$sql = "SELECT * FROM tbl_usuarios WHERE id=:id";
	$consulta = $conexion->prepare($sql);
	$consulta->bindParam(":id", $txtID);
	$consulta->execute();
	$registo = $consulta->fetch(PDO::FETCH_LAZY);
	$usuario = $registo['usuario'];
	$password = $registo['password'];
	$correo = $registo['correo'];
}

if($_POST){
	$txtID = (isset($_POST['txtID']) ? $_POST['txtID'] : "");
	$usuario = (isset($_POST['usuario']) ? $_POST['usuario'] : "");
	$password = (isset($_POST['password']) ? $_POST['password'] : "");
	$correo = (isset($_POST['correo']) ? $_POST['correo'] : "");
	$sql = "UPDATE tbl_usuarios SET usuario=:usuario, password=:password, correo=:correo WHERE id=:id";
	$consulta = $conexion->prepare($sql);
	$consulta->bindParam(":usuario", $usuario);
	$consulta->bindParam(":password", $password);
	$consulta->bindParam(":correo", $correo);
	$consulta->bindParam(":id", $txtID);
	$consulta->execute();
	$mensaje = "Registro actualizado";
	header("location:index.php?mensaje=".$mensaje);
}

?>
<?php include("../../templates/header.php"); ?>

<div class="card">
	<div class="card-header bg-dark text-white">
		Datos del usuario
	</div>

	<div class="card-body">
		<form action="" method="post" enctype="multipart/form-data">
			<div class="mb-3">
				<input class="form-control" readonly type="text" name="txtID" id="txtID" placeholder="ID" value="<?php echo $txtID; ?>" />
			</div>

			<div class="mb-3">
				<input class="form-control" type="text" name="usuario" id="usuario" placeholder="Nombre del usuario" autocomplete="off" value="<?php echo $usuario ?>" required />
			</div>

			<div class="mb-3">
				<input class="form-control" type="password" name="password" id="password" placeholder="Escriba su contraseña" autocomplete="off" value="<?php echo $password; ?>" required />
			</div>

			<div class="mb-3">
				<input class="form-control" type="email" name="correo" id="correo" placeholder="Escriba su correo" autocomplete="off" value="<?php echo $correo; ?>" required />
			</div>

			<button class="btn btn-success" type="submit">Editar</button>
			<a class="btn btn-danger" href="index.php" role="button">Cancelar</a>
		</form>
	</div>
</div>

<?php include("../../templates/footer.php"); ?>