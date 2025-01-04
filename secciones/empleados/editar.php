<?php

include("../../bd.php");

if(isset($_GET['txtID'])){
	$txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");
	$sql = "SELECT * FROM tbl_empleados WHERE id=:id";
	$consulta = $conexion->prepare($sql);
	$consulta->bindParam(":id", $txtID);
	$consulta->execute();
	$registro = $consulta->fetch(PDO::FETCH_LAZY);
	$primernombre = $registro['primernombre'];
	$segundonombre = $registro['segundonombre'];
	$primerapellido = $registro['primerapellido'];
	$segundoapellido = $registro['segundoapellido'];
	$foto = $registro['foto'];
	$cv = $registro['cv'];
	$idpuesto = $registro['idpuesto'];
	$fechadeingreso = $registro['fechadeingreso'];
	$sql = "SELECT * FROM tbl_puestos";
	$consulta = $conexion->prepare($sql);
	$consulta->execute();
	$lista_tbl_puestos = $consulta->fetchAll(PDO::FETCH_ASSOC);
}

if($_POST){
	$txtID = (isset($_POST['txtID']) ? $_POST['txtID'] : "");
	$primernombre = (isset($_POST['primernombre']) ? $_POST['primernombre'] : "");
	$segundonombre = (isset($_POST['segundonombre']) ? $_POST['segundonombre'] : "");
	$primerapellido = (isset($_POST['primerapellido']) ? $_POST['primerapellido'] : "");
	$segundoapellido = (isset($_POST['segundoapellido']) ? $_POST['segundoapellido'] : "");
	$idpuesto = (isset($_POST['idpuesto']) ? $_POST['idpuesto'] : "");
	$fechadeingreso = (isset($_POST['fechadeingreso']) ? $_POST['fechadeingreso'] : "");
	$sql = "UPDATE tbl_empleados SET primernombre=:primernombre, segundonombre=:segundonombre, primerapellido=:primerapellido, segundoapellido=:segundoapellido, idpuesto=:idpuesto, fechadeingreso=:fechadeingreso WHERE id=:id";
	$consulta = $conexion->prepare($sql);
	$consulta->bindParam(":primernombre", $primernombre);
	$consulta->bindParam(":segundonombre", $segundonombre);
	$consulta->bindParam(":primerapellido", $primerapellido);
	$consulta->bindParam(":segundoapellido", $segundoapellido);
	$consulta->bindParam(":idpuesto", $idpuesto);
	$consulta->bindParam(":fechadeingreso", $fechadeingreso);
	$consulta->bindParam(":id", $txtID);
	$consulta->execute();
	$fecha = new DateTime();

	$foto = (isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : "");
	$nombreArchivo_foto = (($foto != "") ? $fecha->getTimestamp()."_".$_FILES['foto']['name'] : "");
	$tmp_foto = $_FILES['foto']['tmp_name'];
	if($tmp_foto != ""){
		move_uploaded_file($tmp_foto, "../../src/assets/images/".$nombreArchivo_foto);
		$sql = "SELECT foto FROM tbl_empleados WHERE id=:id";
		$consulta = $conexion->prepare($sql);
		$consulta->bindParam(":id", $txtID);
		$consulta->execute();
		$registro_recuperado = $consulta->fetch(PDO::FETCH_LAZY);
		if(isset($registro_recuperado['foto']) && $registro_recuperado['foto'] != ""){
			if(file_exists("../../src/assets/images/".$registro_recuperado['foto'])){
				unlink("../../src/assets/images/".$registro_recuperado['foto']);
			}
		}
		$sql = "UPDATE tbl_empleados SET foto=:foto WHERE id=:id";
		$consulta = $conexion->prepare($sql);
		$consulta->bindParam(":foto", $nombreArchivo_foto);
		$consulta->bindParam(":id", $txtID);
		$consulta->execute();
	}

	$cv = (isset($_FILES['cv']['name']) ? $_FILES['cv']['name'] : "");
	$nombreArchivo_cv = (($cv != "") ? $fecha->getTimestamp()."_".$_FILES['cv']['name'] : "");
	$tmp_cv = $_FILES['cv']['tmp_name'];
	if($tmp_cv != ""){
		move_uploaded_file($tmp_cv, "../../src/assets/resources/".$nombreArchivo_cv);
		$sql = "SELECT cv FROM tbl_empleados WHERE id=:id";
		$consulta = $conexion->prepare($sql);
		$consulta->bindParam(":id", $txtID);
		$consulta->execute();
		$registro_recuperado = $consulta->fetch(PDO::FETCH_LAZY);
		if(isset($registro_recuperado['cv']) && $registro_recuperado['cv'] != ""){
			if(file_exists("../../src/assets/resources/".$registro_recuperado['cv'])){
				unlink("../../src/assets/resources/".$registro_recuperado['cv']);
			}
		}
		$sql = "UPDATE tbl_empleados SET cv=:cv WHERE id=:id";
		$consulta = $conexion->prepare($sql);
		$consulta->bindParam(":cv", $cv);
		$consulta->bindParam(":id", $txtID);
		$consulta->execute();
	}
	$mensaje = "Registro actualizado";
	header("location:index.php?mensaje=".$mensaje);
}

?>
<?php include("../../templates/header.php"); ?>

<div class="card">
	<div class="card-header bg-dark text-white">
		Datos del empleado
	</div>

	<div class="card-body">
		<form action="" method="post" enctype="multipart/form-data">
			<div class="mb-3">
				<input class="form-control" readonly type="text" name="txtID" id="txtID" placeholder="ID" value="<?php echo $txtID; ?>" />
			</div>

			<div class="mb-3">
				<input class="form-control" type="text" name="primernombre" id="primernombre" placeholder="Primer nombre" autocomplete="off" value="<?php echo $primernombre; ?>" required />
			</div>

			<div class="mb-3">
				<input class="form-control" type="text" name="segundonombre" id="segundonombre" placeholder="Segundo nombre" autocomplete="off" value="<?php echo $segundonombre; ?>" required />
			</div>

			<div class="mb-3">
				<input class="form-control" type="text" name="primerapellido" id="primerapellido" placeholder="Primer apellido" autocomplete="off" value="<?php echo $primerapellido; ?>" required />
			</div>

			<div class="mb-3">
				<input class="form-control" type="text" name="segundoapellido" id="segundoapellido" placeholder="Segundo apellido" autocomplete="off" value="<?php echo $segundoapellido; ?>" required />
			</div>

			<div class="mb-3">
				<label class="form-label" style="cursor:pointer;" for="foto">Foto:</label>
				<br />
				<img class="border border-3 border-success rounded-circle img-fluid mb-3" width="100" src="../../src/assets/images/<?php echo $foto; ?>" alt="<?php echo $primernombre; ?>" />
				<input class="form-control bg-success text-white" type="file" name="foto" id="foto" placeholder="Foto" />
			</div>

			<div class="mb-3">
				<label class="form-label" style="cursor:pointer;" for="cv">CV:</label>
				<br />
				<a class="link-success link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="../../src/assets/resources/<?php echo $cv; ?>" rel="noopener" target="_blank"><?php echo $cv; ?></a>
				<input class="form-control bg-success text-white mt-3" type="file" name="cv" id="cv" placeholder="CV" />
			</div>

			<div class="mb-3">
				<label class="form-label" style="cursor:pointer;" for="idpuesto">Puesto:</label>
				<select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
					<?php foreach ($lista_tbl_puestos as $puesto) { ?>
						<option <?php echo ($idpuesto == $puesto['id']) ? "selected" : ""; ?> value="<?php echo $puesto['id']; ?>"><?php echo $puesto['nombredelpuesto']; ?></option>
					<?php }?>
				</select>
			</div>

			<div class="mb-3">
				<label class="form-label" style="cursor:pointer;" for="fechadeingreso">Fecha de ingreso:</label>
				<input class="form-control" type="date" name="fechadeingreso" id="fechadeingreso" placeholder="Fecha de ingreso" value="<?php echo $fechadeingreso; ?>" required />
			</div>

			<button class="btn btn-success" type="submit">Editar</button>
			<a class="btn btn-danger" href="index.php" role="button">Cancelar</a>
		</form>
	</div>
</div>

<?php include("../../templates/footer.php"); ?>