<!DOCTYPE html>
<html lang="en">
<?php

session_start();
if(!isset($_SESSION["admin_user"])){
    header("location:index.html");

} else{
    $uname = $_SESSION['admin_user'];
}
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>DASHBOARD</title>
  <link rel="icon" href="img/images.png" type="image/x-icon"/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">

<style>
select[multiple], select[size] {
    height: auto;
    width: 20px;
}
.pull-right {
    float: right;
    margin: 2px !important;
}

    .map-container{
overflow:hidden;
padding-bottom:56.25%;
position:relative;
height:0;
}
.map-container iframe{
left:0;
top:0;
height:100%;
width:100%;
position:absolute;
}
 #loader{
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('img/lg.flip-book-loader.gif') 50% 50% no-repeat rgb(249,249,249);
        opacity: 1;
    }
#loader{
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('img/lg.flip-book-loader.gif') 50% 50% no-repeat rgb(249,249,249);
        opacity: 1;
    }

    .logo-wrapper {
      display: flex;
      align-items: center;
    }
  </style>

    <script src="jquery.min.js"></script>
<script type="text/javascript">
  $(window).on('load', function(){
    //you remove this timeout
    setTimeout(function(){
          $('#loader').fadeOut('slow');  
      });
      //remove the timeout
      //$('#loader').fadeOut('slow'); 
  });
</script>
</head>

<body class="grey lighten-3">

  <!--Main Navigation-->
  <header>

    <!-- Navbar -->
   
    <!-- Navbar -->
    <?php 

     require_once("include/connection.php");


               $id = mysqli_real_escape_string($conn,$_SESSION['admin_user']);


              $r = mysqli_query($conn,"SELECT * FROM admin_login where admin_user = '$id'") or die (mysqli_error($con));

              $row = mysqli_fetch_array($r);

               $id=$row['admin_user'];
               // $fname=$row['fname'];
               // $lname=$row['lname'];

            ?>
 <div id="loader"></div>
    <!-- Sidebar -->
    <?php include('side_bar.php');?>
    <!-- Sidebar -->

  </header>



  <!--Main layout-->
  <main class="pt-5 mx-lg-5 barchartdata">
    <div class="container-fluid mt-5">

      <!-- Heading -->
      <div class="card mb-4 wow fadeIn">

        <!--Card content-->
        <div class="card-body d-sm-flex justify-content-between">

          <h4 class="mb-2 mb-sm-0 pt-1">
            <a href="dashboard.php">Home Page</a>
            <span>/</span>
            <span>Dashboard</span>
          </h4>
<!-- 
          <form class="d-flex justify-content-center">
       
            <input type="search" placeholder="Type your query" aria-label="Search" class="form-control">
            <button class="btn btn-primary btn-sm my-0 p" type="submit">
              <i class="fas fa-search"></i>
            </button>

          </form> -->

        </div>

      </div>
      <!-- Heading -->

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-9 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card content-->
            <div class="card-body">

              <?php
                    // $con  = mysqli_connect("localhost","root","","barchart");
                    //  if (!$con) {
                    //      # code...
                    //     echo "Problem in database connection! Contact administrator!" . mysqli_error();
                    //  }else{

                       require_once("include/connection.php");

                       $sql = "SELECT *, COUNT(EMAIL) AS count FROM upload_files where NAME != 'EMPTY' GROUP BY TIMERS;";
                       $result = mysqli_query($conn, $sql);
                       $chart_data = "";
                       while ($row = mysqli_fetch_array($result)) { 
                           $date[] = $row['TIMERS'];
                           $counts[] = $row['count'];
                          

                       }

                       $pdf_ = "SELECT *, COUNT(NAME) AS count_name FROM upload_files where NAME like '%.pdf';";
                       $pdf_res = mysqli_query($conn, $pdf_);
                       while ($row = mysqli_fetch_array($pdf_res)) { 
                        $pdf_count[] = $row['count_name'];

                      }

                      $docx_ = "SELECT *, COUNT(NAME) AS count_name FROM upload_files where NAME like '%.docx';";
                       $docx_res = mysqli_query($conn, $docx_);
                       while ($row = mysqli_fetch_array($docx_res)) { 
                        $docx_count[] = $row['count_name'];

                      }

                      $doc_ = "SELECT *, COUNT(NAME) AS count_name FROM upload_files where NAME like '%.doc';";
                       $doc_res = mysqli_query($conn, $doc_);
                       while ($row = mysqli_fetch_array($doc_res)) { 
                        $doc_count[] = $row['count_name'];

                      }

                      $pptx_ = "SELECT *, COUNT(NAME) AS count_name FROM upload_files where NAME like '%.pptx';";
                       $pptx_res = mysqli_query($conn, $pptx_);
                       while ($row = mysqli_fetch_array($pptx_res)) { 
                        $pptx_count[] = $row['count_name'];

                      }
                       
                      $ppt_ = "SELECT *, COUNT(NAME) AS count_name FROM upload_files where NAME like '%.ppt';";
                      $ppt_res = mysqli_query($conn, $ppt_);
                      while ($row = mysqli_fetch_array($ppt_res)) { 
                       $ppt_count[] = $row['count_name'];

                     }

                     $xlsx_ = "SELECT *, COUNT(NAME) AS count_name FROM upload_files where NAME like '%.xlsx';";
                      $xlsx_res = mysqli_query($conn, $xlsx_);
                      while ($row = mysqli_fetch_array($xlsx_res)) { 
                       $xlsx_count[] = $row['count_name'];

                     }

                     $xls_ = "SELECT *, COUNT(NAME) AS count_name FROM upload_files where NAME like '%.xls';";
                      $xls_res = mysqli_query($conn, $xls_);
                      while ($row = mysqli_fetch_array($xls_res)) { 
                       $xls_count[] = $row['count_name'];

                     }

                     $odt_ = "SELECT *, COUNT(NAME) AS count_name FROM upload_files where NAME like '%.odt';";
                      $odt_res = mysqli_query($conn, $odt_);
                      while ($row = mysqli_fetch_array($odt_res)) { 
                       $odt_count[] = $row['count_name'];

                     }
                     
                     
                     
             
                     
                    ?>
                <CENTER><h3 class="page-header" >Count Per Upload File of an Employee  </h3></CENTER>  
      

              <canvas id="myChart"></canvas>

            </div>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-3 mb-4">

          <!--Card-->
          <div class="card mb-4">

            <!-- Card header -->
            <div class="card-header text-center">
              Pie chart
            </div>

            <!--Card content-->
            <div class="card-body">

              <canvas id="pieChart"></canvas>

            </div>

          </div>
          <!--/.Card-->

        
    <!--Copyright-->
    <div class="footer-copyright py-3">
    <p>All right Reserved &copy; <?php echo date('Y');?> Created By:JunilToledo</p>
    </div>
    <!--/.Copyright-->

  </footer>
  <!--/.Footer-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();

  </script>

  <!-- Charts -->
  <script>
    // Line

    const dates = <?php echo json_encode($date); ?>;
    const counts = <?php echo json_encode($counts); ?>;

    const data = {
      labels: dates, // Dates
      datasets: [{
        label: 'Number of Files',
        data: counts, // Number of files for each date
        backgroundColor: 'rgba(54, 162, 235, 0.5)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    };

    // Configuration options
    const options = {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    };

    // Create the chart
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
      type: 'bar',
      data: data,
      options: options
    });

    const pdf = <?php echo json_encode($pdf_count); ?>;
    const docx = <?php echo json_encode($docx_count); ?>;
    const doc = <?php echo json_encode($doc_count); ?>;
    const pptx = <?php echo json_encode($pptx_count); ?>;
    const ppt = <?php echo json_encode($ppt_count); ?>;
    const xlsx = <?php echo json_encode($xlsx_count); ?>;
    const xls = <?php echo json_encode($xls_count); ?>;
    const odt = <?php echo json_encode($odt_count); ?>;

    //pie
    var ctxP = document.getElementById("pieChart").getContext('2d');
    var myPieChart = new Chart(ctxP, {
      type: 'pie',
      data: {
        labels: ["pdf", "docx", "doc", "pptx",  "ppt", "xlsx", "xls", "odt"],
        datasets: [{
          data: [pdf, docx, doc, pptx, ppt, xlsx, xls, odt],
          backgroundColor: ["#ff0006", "#c435b6", "#9e35c4", "#13b1f0", "#1df078", "#d6d61c", "#d6731c", "#0d0d0d"],
          hoverBackgroundColor: ["#ff0006", "#c435b6", "#9e35c4", "#13b1f0", "#1df078", "#d6d61c", "#d6731c", "#0d0d0d"]
        }]
      },
      options: {
        responsive: true,
        legend: false
      }
    });



  
  </script>
</body>
</html>

