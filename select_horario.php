<?php
require_once('conection.php');
   $horario           = $_POST['start'];
   $empleado          = $_POST['empleado'];
   $servicio          = $_POST['servicio'];
   $fecha             = explode(" ", $horario);

   $sql               = "SELECT id, start, start_fecha, start_horas, end_horas FROM events WHERE start_fecha = '$fecha[0]'";
   $events            = mysqli_query($conn, $sql);
   $i                 = 0;
   if(mysqli_num_rows($events)>0){
   while ($data = mysqli_fetch_array($events)) {
   $test_start[$i] = $data['start_horas'];
   $test_end[$i]   = $data['end_horas'];
   $i++;
   }

   $sql_h    = "SELECT id, hora_inicio, hora_final FROM horarios_turnos";
   $events_h = mysqli_query($conn, $sql_h);
   $h        = 0;
   while ($data_h = mysqli_fetch_array($events_h)) {
   $test_h_ini[$h] = $data_h['hora_inicio'];
   $test_h_end[$h] = $data_h['hora_final'];
   $h++;
   }

   $resultado_inicio  = array_diff($test_h_ini, $test_start);
   $resultado_final   = array_diff($test_h_end, $test_end);
   $cantidad_horarios = count($test_h_ini) ;
}
?> 
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>Modern Business - Start Bootstrap Template</title>
      <!-- Favicon-->
      <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
      <!-- Bootstrap icons-->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
      <!-- Core theme CSS (includes Bootstrap)-->
      <link href="css/styles.css" rel="stylesheet" />
      <link href='css/fullcalendar.css' rel='stylesheet' />
      <style>
         body {
         padding-top: 70px;
         }
         #calendar {
         max-width: 800px;
         }
         .col-centered{
         float: none;
         margin: 0 auto;
         }
      </style>
   </head>
   <body class="d-flex flex-column h-100" style="padding-top: 0px;">
      <main class="flex-shrink-0">
         <!-- Navigation-->
         <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
               <a class="navbar-brand" href="index.html">Centro Odontologico</a>
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                     <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                     <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                     <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                     <li class="nav-item"><a class="nav-link" href="pricing.html">Pricing</a></li>
                     <li class="nav-item"><a class="nav-link" href="faq.html">FAQ</a></li>
                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownBlog" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Blog</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownBlog">
                           <li><a class="dropdown-item" href="blog-home.html">Blog Home</a></li>
                           <li><a class="dropdown-item" href="blog-post.html">Blog Post</a></li>
                        </ul>
                     </li>
                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownPortfolio" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Portfolio</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownPortfolio">
                           <li><a class="dropdown-item" href="portfolio-overview.html">Portfolio Overview</a></li>
                           <li><a class="dropdown-item" href="portfolio-item.html">Portfolio Item</a></li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </div>
         </nav>
         <!-- Page Content-->
         <section class="py-5">
            <div class="container px-5 my-5">
            <form class="form-horizontal" method="POST" action="insert_personal_info.php">
                  <div class="modal-header">
                     <h4 class="modal-title" id="myModalLabel">Seleccione el horario que de su Turno:</h4>
                  </div>
                  <div class="modal-body">
                     <div class="form-group">
                        <label for="color" class="col-sm-2 control-label">horario</label>
                        <div class="col-sm-10">
                           <select name="horario" class="form-control" id="empleado">
                              <?php
                              if(mysqli_num_rows($events)>0){
                                 for($j = 0; $j <= $cantidad_horarios; $j++){
                                    echo "<option style='color:#000;'value=".$resultado_inicio[$j]."-".$resultado_final[$j].">".$resultado_inicio[$j]."-".$resultado_final[$j]."</option>";
                                 }
                              }else{
                                 echo "<option style='color:#000;'value='08:00:00-09:00:00'>08:00:00-09:00:00</option>";
                                 echo "<option style='color:#000;'value='09:00:00-10:00:00'>09:00:00-10:00:00</option>";
                                 echo "<option style='color:#000;'value='10:00:00-11:00:00'>10:00:00-11:00:00</option>";
                                 echo "<option style='color:#000;'value='11:00:00-12:00:00'>11:00:00-12:00:00</option>";
                                 echo "<option style='color:#000;'value='12:00:00-13:00:00'>12:00:00-13:00:00</option>";
                                 echo "<option style='color:#000;'value='13:00:00-14:00:00'>13:00:00-14:00:00</option>";
                                 echo "<option style='color:#000;'value='14:00:00-15:00:00'>14:00:00-15:00:00</option>";
                                 echo "<option style='color:#000;'value='15:00:00-16:00:00'>15:00:00-16:00:00</option>";
                                 echo "<option style='color:#000;'value='16:00:00-17:00:00'>16:00:00-17:00:00</option>";
                                 echo "<option style='color:#000;'value='17:00:00-18:00:00'>17:00:00-18:00:00</option>";
                              }
                              ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group" >
                        <label for="start" class="col-sm-2 control-label">Para el dia:</label>
                        <div class="col-sm-10">
                           <?php $show_fecha = explode(" ", $horario); ?>
                           <input type="text" class="form-control" placeholder="<?php echo $show_fecha[0]?>" readonly>
                           <input style="display: none;" type="text" name="start" class="form-control" id="start" value="<?php echo $horario;?>" readonly>
                        </div>
                     </div>
                     <div class="form-group" style="display: none;">
                                 <div class="col-sm-10">
                                    <input type="text" name="empleado" class="form-control" id="title" placeholder="Titulo" value="<?php echo $empleado?>">
                                 </div>
                              </div>
                              <div class="form-group" style="display: none;">
                                 <div class="col-sm-10">
                                    <input type="text" name="servicio" class="form-control" id="title" placeholder="Titulo" value="<?php echo $servicio?>">
                                 </div>
                              </div>
                  </div>
                  <div class="modal-footer">
                     <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
               </form>
                     </div>
            </div>
         </section>
      </main>
      <!-- Footer-->
      <footer class="bg-dark py-4 mt-auto">
         <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
               <div class="col-auto">
                  <div class="small m-0 text-white">Copyright &copy; Your Website 2022</div>
               </div>
               <div class="col-auto">
                  <a class="link-light small" href="#!">Privacy</a>
                  <span class="text-white mx-1">&middot;</span>
                  <a class="link-light small" href="#!">Terms</a>
                  <span class="text-white mx-1">&middot;</span>
                  <a class="link-light small" href="#!">Contact</a>
               </div>
            </div>
         </div>
      </footer>
      <!-- Bootstrap core JS-->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
      <script src="js/scripts.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
      <script src="assets/demo/chart-area-demo.js"></script>
      <script src="assets/demo/chart-bar-demo.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
      <script src="js/datatables-simple-demo.js"></script>
      <script src="js/jquery.js"></script>
      <!-- Bootstrap Core JavaScript -->
      <script src="js/bootstrap.min.js"></script>
      <!-- FullCalendar -->
      <script src='js/moment.min.js'></script>
      <script src='js/fullcalendar/fullcalendar.min.js'></script>
      <script src='js/fullcalendar/fullcalendar.js'></script>
      <script src='js/fullcalendar/locale/es.js'></script>
   </body>
</html>



