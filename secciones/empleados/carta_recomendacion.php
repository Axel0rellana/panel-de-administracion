<?php
session_start();
include("../../bd.php");
$url_base = "http://localhost/webs/php/proyectos/panel-de-administracion/";
if($_SESSION['logueado'] != true){
  header("location:".$url_base."login.php");
}

if(isset($_GET['txtID'])){
	$txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");
	$sql = "SELECT *, (SELECT nombredelpuesto FROM tbl_puestos WHERE tbl_puestos.id = tbl_empleados.idpuesto limit 1) as puesto FROM tbl_empleados WHERE id=:id";
	$consulta = $conexion->prepare($sql);
	$consulta->bindParam(":id", $txtID);
	$consulta->execute();
	$registro = $consulta->fetch(PDO::FETCH_LAZY);
	$primernombre = $registro['primernombre'];
	$segundonombre = $registro['segundonombre'];
	$primerapellido = $registro['primerapellido'];
	$segundoapellido = $registro['segundoapellido'];
  $nombreCompleto = $primernombre." ".$segundonombre." ".$primerapellido." ".$segundoapellido;
	$foto = $registro['foto'];
	$cv = $registro['cv'];
	$idpuesto = $registro['idpuesto'];
  $puesto = $registro['puesto'];
	$fechadeingreso = $registro['fechadeingreso'];
  $fechaInicio = new DateTime($fechadeingreso);
  $fechaFin = new DateTime(date("Y-m-d"));
  $diferencia = date_diff($fechaInicio, $fechaFin);
}

ob_start();
?>
<!DOCTYPE html>
<html lang="es">
  <head>
   <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#b5dff0" />
    <meta name="description" content="Carta de recomendación" />
    <link rel="icon" href="<?php echo $url_base; ?>src/assets/icons/favicon.ico" />
    <link rel="favicon" href="<?php echo $url_base; ?>src/assets/icons/favicon.png" />
    <link rel="apple-touch-icon" href="<?php echo $url_base; ?>src/assets/icons/apple-touch-icon.png" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url_base; ?>src/styles/index.css" />
    <title>Carta de recomendación</title>
  </head>
  <body class="select-none bg-light">
    
    <h1>Carta de recomendación laboral</h1>
    <br/><br/>
    Buenos Aires, Argentina a <strong><?php echo date('d M Y'); ?></strong>
    <br/><br/>
    A quien pueda interesar:
    <br/><br/>
    Reciba un cordial y respetuoso saludo.
    <br/><br/>
    A través de estas líneas deseo hacer de su conocimiento que el/la Sr(a) <strong><?php echo $nombreCompleto; ?></strong>, quien laboró en su organización durante <strong><?php echo $diferencia->y; ?> año(s)</strong>
    es un ciudadano con una conducta intachable. Ha demostrado ser un gran trabajador, comprometido, responsable y fiel cumplidor de sus tareas.
    Siempre ha manifestado preocupación por mejorar, capacitarse y actualizar sus conocimientos.
    <br/><br/>
    Durante estos años se ha desempeñado como: <strong><?php echo $puesto; ?></strong>
    Es por ello le sugiero considere esta recientemente, con la confianza de que estará siempre a la altura de sus compromisos y responsabilidades.
    <br/><br/>
    Sin más nada a que referirme y, esperando que esta misiva sera tomada en cuenta, dejo mi número de contacto para cualquier información de interés.
    <br/><br/><br/><br/><br/><br/><br/><br/>
    ______________________________________________________________________________________
    Atentamente.
    <br/>
    Ing. Juan Martinez Uh

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
  </body>
</html>
<?php
$HTML = ob_get_clean();

require_once("../../libs/dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$opciones = $dompdf->getOptions();
$opciones->set(array("isRemoteEnabled"=>true));
$dompdf->setOptions($opciones);
$dompdf->loadHTML($HTML);
$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment"=>false));
?>