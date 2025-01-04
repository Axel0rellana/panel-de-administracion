<?php

include("../../bd.php");

if($_POST){
	$primernombre = (isset($_POST['primernombre']) ? $_POST['primernombre'] : "");
	$segundonombre = (isset($_POST['segundonombre']) ? $_POST['segundonombre'] : "");
	$primerapellido = (isset($_POST['primerapellido']) ? $_POST['primerapellido'] : "");
	$segundoapellido = (isset($_POST['segundoapellido']) ? $_POST['segundoapellido'] : "");
	$foto = (isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : "");
	$cv = (isset($_FILES['cv']['name']) ? $_FILES['cv']['name'] : "");
	$idpuesto = (isset($_POST['idpuesto']) ? $_POST['idpuesto'] : "");
	$fechadeingreso = (isset($_POST['fechadeingreso']) ? $_POST['fechadeingreso'] : "");
	$sql = "INSERT INTO tbl_empleados (id, primernombre, segundonombre, primerapellido, segundoapellido, foto, cv, idpuesto, fechadeingreso) VALUES (NULL, :primernombre, :segundonombre, :primerapellido, :segundoapellido, :foto, :cv, :idpuesto, :fechadeingreso)";
	$consulta = $conexion->prepare($sql);
	$consulta->bindParam(":primernombre", $primernombre);
	$consulta->bindParam(":segundonombre", $segundonombre);
	$consulta->bindParam(":primerapellido", $primerapellido);
	$consulta->bindParam(":segundoapellido", $segundoapellido);
	$fecha = new DateTime();
	$nombreArchivo_foto = (($foto != "") ? $fecha->getTimestamp()."_".$_FILES['foto']['name'] : "");
	$tmp_foto = $_FILES['foto']['tmp_name'];
	if($tmp_foto != ""){
		move_uploaded_file($tmp_foto, "../../src/assets/images/".$nombreArchivo_foto);
	}
	$nombreArchivo_cv = (($cv != "") ? $fecha->getTimestamp()."_".$_FILES['cv']['name'] : "");
	$tmp_cv = $_FILES['cv']['tmp_name'];
	if($tmp_cv != ""){
		move_uploaded_file($tmp_cv, "../../src/assets/resources/".$nombreArchivo_cv);
	}
	$consulta->bindParam(":foto", $nombreArchivo_foto);
	$consulta->bindParam(":cv", $nombreArchivo_cv);
	$consulta->bindParam(":idpuesto", $idpuesto);
	$consulta->bindParam(":fechadeingreso", $fechadeingreso);
	$consulta->execute();
	$mensaje = "Registro agregado";
	header("location:index.php?mensaje=".$mensaje);
}

$sql = "SELECT * FROM tbl_puestos";
$consulta = $conexion->prepare($sql);
$consulta->execute();
$lista_tbl_puestos = $consulta->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include("../../templates/header.php"); ?>

<div class="card">
	<div class="card-header bg-dark text-white">
		Datos del empleado
	</div>

	<div class="card-body">
		<form action="" method="post" enctype="multipart/form-data">
			<div class="mb-3">
				<input class="form-control" type="text" name="primernombre" id="primernombre" placeholder="Primer nombre" autocomplete="off" required />
			</div>

			<div class="mb-3">
				<input class="form-control" type="text" name="segundonombre" id="segundonombre" placeholder="Segundo nombre" autocomplete="off" required />
			</div>

			<div class="mb-3">
				<input class="form-control" type="text" name="primerapellido" id="primerapellido" placeholder="Primer apellido" autocomplete="off" required />
			</div>

			<div class="mb-3">
				<input class="form-control" type="text" name="segundoapellido" id="segundoapellido" placeholder="Segundo apellido" autocomplete="off" required />
			</div>

			<div class="mb-3">
				<label class="form-label" style="cursor:pointer;" for="foto">Foto:</label>
				<input class="form-control bg-success text-white" type="file" name="foto" id="foto" placeholder="Foto" required />
			</div>

			<div class="mb-3">
				<label class="form-label" style="cursor:pointer;" for="cv">CV:</label>
				<input class="form-control bg-success text-white" type="file" name="cv" id="cv" placeholder="CV" required />
			</div>

			<div class="mb-3">
				<label class="form-label" style="cursor:pointer;" for="idpuesto">Puesto:</label>
				<select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
					<?php foreach ($lista_tbl_puestos as $puesto) { ?>
						<option value="<?php echo $puesto['id']; ?>"><?php echo $puesto['nombredelpuesto']; ?></option>
					<?php }?>
				</select>
			</div>

			<div class="mb-3">
				<label class="form-label" style="cursor:pointer;" for="fechadeingreso">Fecha de ingreso:</label>
				<input class="form-control" type="date" name="fechadeingreso" id="fechadeingreso" placeholder="Fecha de ingreso" required />
			</div>

			<button class="btn btn-success" type="submit">Agregar</button>
			<a class="btn btn-danger" href="index.php" role="button">Cancelar</a>
		</form>
	</div>
</div>

<?php include("../../templates/footer.php"); ?>