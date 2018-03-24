<?php
   @session_start();
   include '../Scripts/classes/events.php';
   include '../Scripts/classes/users.php';
  // include '../Scripts/classes/users.php';
   //echo $_SESSION["name"];
   if (!isset($_SESSION["email"]))
   {
      header("location:../index.html");
   }

   $eventObj = new Events();
   $eventObj->connect();
   $email = $_SESSION["email"];
   $events = $eventObj->getMyEvents($email);

  //  $imgObj = new Users();
  //  $imgObj->connect();
  //  $_SESSION["pic"] = $imgObj->getImg($email);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Pict Cafe | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="../plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="../plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style>
    @media only screen and (min-width: 720px) {
      .mar1{
          margin-top: 7%;
      }
    }
    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
          $('.search-box input[type="text"]').on("keyup input", function(){
              /* Get input value on change */
              var term = $(this).val();
              var resultDropdown = $(this).siblings(".result");
              if(term.length){
                  $.get("../Scripts/backend-search.php", {query: term}).done(function(data){
                      // Display the returned data in browser
                      resultDropdown.html(data);
                  });
              } else{
                  resultDropdown.empty();
              }
          });

          // Set search input value on click of result item
          $(document).on("click", ".result p", function(){
              $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
              $(this).parent(".result").empty();
          });
      });
    </script>
  </head>
  <body class="skin-blue">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.html" class="logo"><b>Pict </b>Cafe</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu"><a href="upload.php"><i class="fa fa-plus-square-o"></i></a></li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src='<?=$_SESSION["pic"]?>' class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?=$_SESSION["name"]?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src='<?=$_SESSION["pic"]?>' class="img-circle" alt="User Image" />
                    <p>
                      <?=$_SESSION["name"]?>
                      <small><?=$_SESSION["email"]?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="../Scripts/signOut.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src='<?=$_SESSION["pic"]?>' class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?=$_SESSION["name"]?></p>

              <a href="#"><i class="fa fa-circle text-success"></i> Verified</a>
            </div>
          </div>
          <!-- search form -->
          <form action="../Scripts/searchMediatorForEvents.php" method="get" class="sidebar-form">

            <div class="input-group search-box">

              <input type="text" autocomplete="off" name="q" class="form-control" placeholder="Search..."/>
              <div class="result" style="background-color: white !important;"></div>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>

            </div>
            <!-- <div class="result"></div> -->
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="dash.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>

            <li>
              <a href="upload.php">
                <i class="fa fa-plus-square-o"></i> <span>Upload</span>
              </a>
            </li>
            <li>
              <a href="timeline.php">
                <i class="fa fa-user"></i> <span>Timeline</span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Memory -
            <small>DASHBOARD</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Info boxes -->
          <div class="row mar1">
            <?php
              $count = sizeof($events);
              //echo "<br>rows = ".$count;
              $i=0;
              //echo "<br><br>";
              while($i<$count AND $count<6)
              {
                // echo "<br>Name = ".$events[$i][0];
                // echo "<br>Date = ".$events[$i][1];
                 $link = "event.php?id=".$events[$i][2];
              ?>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text"><big><a href='<?=$link?>'><?=$events[$i][0]?></a></big></span>
                  <span class="info-box-number"><small><?=$events[$i][1]?></small></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
           <?php
               $i++;
              }
            ?>

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>



          </div><!-- /.row -->





          <!-- Info boxes -->


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>P</b>C
        </div>
        <strong>Copyright &copy; 2017 <a href="">Pict Cafe</a>.</strong> All rights reserved.
      </footer>

    </div><!-- ./wrapper -->
    <!-- jQuery 2.1.3 -->
    <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="../plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="../plugins/chartjs/Chart.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard2.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js" type="text/javascript"></script>
  </body>
</html>
