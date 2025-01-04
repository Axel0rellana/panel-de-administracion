<?php
  $url_base = "http://localhost/webs/php/proyectos/panel-de-administracion/";

  if($_SESSION['logueado'] != true){
    header("location:".$url_base."login.php");
  }

?>
    </main>
    <footer class="bg-primary text-white text-center py-3 mt-4">
        <?php echo $_SESSION['usuario']; ?> <?php echo date('Y'); ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script type="text/javascript">
    $(document).ready(
      function(){
        $("#tabla_id").DataTable({
          "pageLength": 3,
          lengthMenu: [
            [3,10,25,50],
            [3,10,25,50]
          ],
          "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json",
          },
        });
      }
    );
    </script>
    <script type="text/javascript">
      function borrar(id){
          Swal.fire({
          icon: "error",
          title: "Warning",
          text: "¿Desea borrar el registro?",
          showDenyButton: true,
          denyButtonText: "No",
          denyButtonColor: "#4338ca",
          confirmButtonText: "Yes",
          confirmButtonColor: "#e74c3c",
        }).then((response) => {
          if (response.isConfirmed) {
            window.location = `index.php?txtID=${id}`;
          }
        });
      }
    </script>
  </body>
</html>