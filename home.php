<?php include('db_connect.php') ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', { 'packages': ['corechart', 'bar'] });
    google.charts.setOnLoadCallback(drawPieChart);
    google.charts.setOnLoadCallback(drawBarChart);

    function drawPieChart() {
      var data = google.visualization.arrayToDataTable([
        ['Status', 'Cantidad'],
        <?php
        $conexion = mysqli_connect("localhost", "root", "", "empleado");
        $SQL = "SELECT status AS estado, COUNT(*) as cantidad FROM lista_tareas GROUP BY estado";
        $consulta = mysqli_query($conexion, $SQL);

        while ($resultado = mysqli_fetch_assoc($consulta)) {
          $status = '';
          if ($resultado['estado'] == 0) {
            $status = 'Pendiente';
          } elseif ($resultado['estado'] == 1) {
            $status = 'En proceso';
          } elseif ($resultado['estado'] == 2) {
            $status = 'Completado';
          }
          echo "['" . $status . "', " . $resultado['cantidad'] . "],";
        }
        ?>
      ]);

      var options = {
        is3D: true
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
      chart.draw(data, options);
    }
    ////////////////////////////2////////////////////////////////////////
    function drawPieChart() {
      var data = google.visualization.arrayToDataTable([
        ['Status', 'Cantidad'],
        <?php
        $conexion = mysqli_connect("localhost", "root", "", "empleado");
        $SQL = "SELECT status AS estado, COUNT(*) as cantidad FROM lista_tareas GROUP BY estado";
        $consulta = mysqli_query($conexion, $SQL);

        while ($resultado = mysqli_fetch_assoc($consulta)) {
          $status = '';
          if ($resultado['estado'] == 0) {
            $status = 'Pendiente';
          } elseif ($resultado['estado'] == 1) {
            $status = 'En proceso';
          } elseif ($resultado['estado'] == 2) {
            $status = 'Completado';
          }
          echo "['" . $status . "', " . $resultado['cantidad'] . "],";
        }
        ?>
      ]);

      var options = {
        is3D: true
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart_3d2'));
      chart.draw(data, options);
    }
    function drawBarChart() {
      var data = google.visualization.arrayToDataTable([
        ['Miembro', 'Pendiente', 'En Proceso', 'Completado'],
        <?php
        $conexion = mysqli_connect("localhost", "root", "", "empleado");

        $SQL = "SELECT lista_tareas.status, lista_miembros.firstname FROM lista_tareas
        LEFT JOIN lista_miembros ON lista_tareas.employee_id = lista_miembros.id";
        $consulta = mysqli_query($conexion, $SQL);

        $miembros = array();

        while ($resultado = mysqli_fetch_assoc($consulta)) {
          $nombreMiembro = $resultado['firstname'];
          $idStatus = $resultado['status'];

          if (!isset($miembros[$nombreMiembro])) {
            $miembros[$nombreMiembro] = array('Pendiente' => 0, 'En Proceso' => 0, 'Completado' => 0);
          }

          if ($idStatus == 0) {
            $miembros[$nombreMiembro]['Pendiente']++;
          } elseif ($idStatus == 1) {
            $miembros[$nombreMiembro]['En Proceso']++;
          } elseif ($idStatus == 2) {
            $miembros[$nombreMiembro]['Completado']++;
          }
        }

        foreach ($miembros as $nombre => $status) {
          echo "['$nombre', " . $status['Pendiente'] . ", " . $status['En Proceso'] . ", " . $status['Completado'] . "],";
        }
        ?>
      ]);

      var options = {
        chart: {
          title: 'Status por Miembro',
        },
        bars: 'horizontal'
      };

      var chart = new google.charts.Bar(document.getElementById('barchart_material'));
      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
    
  </script>
<?php
$twhere ="";
if($_SESSION['login_type'] != 1)
  $twhere = "  ";
?>
<!-- Info boxes -->
<?php if($_SESSION['login_type'] == 2): ?>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM lista_departamentos ")->num_rows; ?></h3>

                <p>Total de Departmentos</p>
              </div>
              <div class="icon">
                <i class="fa fa-th-list"></i>
              </div>
            </div>
          </div>
           <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM lista_cargos")->num_rows; ?></h3>

                <p>Total de Cargos</p>
              </div>
              <div class="icon">
                <i class="fa fa-list-alt"></i>
              </div>
            </div>
          </div>
           <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM users")->num_rows; ?></h3>

                <p>Total de Usuarios</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM lista_miembros")->num_rows; ?></h3>

                <p>Total de Miembros</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-friends"></i>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM lista_evaluadores")->num_rows; ?></h3>

                <p>Total de Evaluadores</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-secret"></i>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM lista_tareas")->num_rows; ?></h3>

                <p>Total de Tareas</p>
              </div>
              <div class="icon">
                <i class="fa fa-tasks"></i>
              </div>
            </div>
          </div>

          

          
      </div>
      <h1>Gráfico: Estado de las tareas</h1>
         <div id="piechart_3d" style="margin: 20px  ; width: 500px; height: 200px;" ></div>
      
          <h1>Gráfico: Tareas asignadas por miembro</h1>
  <div id="barchart_material" style="margin: 10px auto;
  width: 1000px;
  height: 500px;"></div>

<?php else: ?>
   <div class="col-12">
          <div class="card">
            <div class="card-body">
              Bienvenid@ <?php echo $_SESSION['login_name'] ?>!
            </div>
          </div>
      </div>
      <h1>Gráfico: Estado de las tareas</h1>
         <div id="piechart_3d2" style="margin: 20px  ; width: 500px; height: 200px;" ></div>
      
          <h1>Gráfico: Tareas asignadas por miembro</h1>
  <div id="barchart_material" style="margin: 10px auto;
  width: 1000px;
  height: 500px;"></div>
<?php endif; ?>
