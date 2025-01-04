<?php
  session_start();
  $url_base = "http://localhost/webs/php/proyectos/panel-de-administracion/";

  if($_SESSION['logueado'] != true){
    header("location:".$url_base."login.php");
  }

?>
<!DOCTYPE html>
<html lang="es">
  <head>
   <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#b5dff0" />
    <meta name="description" content="Panel de administración" />
    <link rel="icon" href="<?php echo $url_base; ?>src/assets/icons/favicon.ico" />
    <link rel="favicon" href="<?php echo $url_base; ?>src/assets/icons/favicon.png" />
    <link rel="apple-touch-icon" href="<?php echo $url_base; ?>src/assets/icons/apple-touch-icon.png" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url_base; ?>src/styles/index.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Panel de administración</title>
  </head>
  <body class="select-none bg-light">

    <nav class="navbar navbar-expand-lg bg-primary navbar-dark mb-4">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $url_base; ?>">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $url_base; ?>secciones/empleados/">Empleados</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $url_base; ?>secciones/puestos/">Puestos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $url_base; ?>secciones/usuarios/">Usuarios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $url_base; ?>cerrar.php">Cerrar sesión</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="container">
    <?php if(isset($_GET['mensaje'])){ ?>
      <script type="text/javascript">
        Swal.fire({
          icon: "success",
          title: "Success",
          text: "<?php echo $_GET['mensaje']; ?>",
          timer: 2000,
          confirmButtonColor: "#2ecc71",
        });
      </script>
    <?php }?>