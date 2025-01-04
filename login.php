<?php
  session_start();
  $url_base = "http://localhost/webs/php/proyectos/panel-de-administracion/";

  if($_POST){
    include("bd.php");
    $usuario = (isset($_POST['usuario']) ? $_POST['usuario'] : "");
    $password = (isset($_POST['password']) ? $_POST['password'] : "");
    $sql = "SELECT *, count(*) as n_usuario FROM tbl_usuarios WHERE usuario=:usuario AND password=:password";
    $consulta = $conexion->prepare($sql);
    $consulta->bindParam(":usuario", $usuario);
    $consulta->bindParam(":password", $password);
    $consulta->execute();
    $registro = $consulta->fetch(PDO::FETCH_LAZY);
    if($registro['n_usuario']>0){
      $_SESSION['usuario'] = $registro['usuario'];
      $_SESSION['logueado'] = true;
      header("location:index.php");
    }else{
      $mensaje = "Error: El usuario o contraseña son incorrectos";
    }
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
    <link rel="stylesheet" type="text/css" href="<?php echo $url_base; ?>src/styles/index.css" />
    <title>Panel de administración</title>
  </head>
  <body class="select-none bg-light">

    <main class="container">
      <div class="row mt-4">
        <div class="col-md-4">
          
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              Login
            </div>
            <div class="card-body">
              <?php if(isset($mensaje)){ ?>
                <div class="alert alert-danger" role="alert">
                  <strong><?php echo $mensaje; ?></strong>
                </div>
              <?php }?>
              <form action="" method="post">
                <div class="mb-3">
                  <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Escriba su usuario" autocomplete="off" required />
                </div>
                <div class="mb-3">
                  <input class="form-control" type="password" name="password" id="password" placeholder="Escriba su contraseña" autocomplete="off" required />
                </div>
                <button class="btn btn-primary btn-sm" type="submit">Iniciar sesión</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
  </body>
</html>