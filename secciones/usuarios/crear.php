<?php

include("../../bd.php");

if($_POST){
	$usuario = (isset($_POST['usuario']) ? $_POST['usuario'] : "");
	$password = (isset($_POST['password']) ? $_POST['password'] : "");
	$correo = (isset($_POST['correo']) ? $_POST['correo'] : "");
	$sql = "INSERT INTO tbl_usuarios (id, usuario, password, correo) VALUES (NULL, :usuario, :password, :correo)";
	$consulta = $conexion->prepare($sql);
	$consulta->bindParam(":usuario", $usuario);
	$consulta->bindParam(":password", $password);
	$consulta->bindParam(":correo", $correo);
	$consulta->execute();
	$mensaje = "Registro agregado";
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
				<input class="form-control" type="text" name="usuario" id="usuario" placeholder="Nombre del usuario" autocomplete="off" required />
			</div>

			<div class="mb-3">
				<input class="form-control" type="password" name="password" id="password" placeholder="Escriba su contraseña" autocomplete="off" required />
			</div>

			<div class="mb-3">
				<input class="form-control" type="email" name="correo" id="correo" placeholder="Escriba su correo" autocomplete="off" required />
			</div>

			<button class="btn btn-success" type="submit">Agregar</button>
			<a class="btn btn-danger" href="index.php" role="button">Cancelar</a>
		</form>
	</div>
</div>

<?php include("../../templates/footer.php"); ?>