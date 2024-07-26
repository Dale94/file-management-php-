<!DOCTYPE html>
<html lang="en">
<?php

// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['status'])) {
  header('Location: index.html');
  }

?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>ADD DOCUMENT</title>
  <link rel="icon" href="super_admin/img/images.png" type="image/x-icon"/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">

    <script src="js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="medias/css/dataTable.css" />
    <script src="medias/js/jquery.dataTables.js" type="text/javascript"></script>
    <!-- end table-->
    <script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
      $('#dtable').dataTable({
                "aLengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                "iDisplayLength": 10
                //"destroy":true;
            });
  })
    </script>

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

    table{
   overflow-y:scroll;
   height:300px;
   display:block;
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
<?php
  include('side_bar.php');
?>
  <!--Main Navigation-->
  <header>

    <!-- Sidebar -->


    </div>
<!--end modaluser-->

  </header>
  <!--Main Navigation-->
 <div id="loader"></div>
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
  
<hr>
 
 <div class="">

 <table id="dtable" class = "table table-striped">
     <thead>

    <th>ID</th>
    <th>NAME</th>
    <th>EMAIL</th>
    <th>DELETED FILES</th>
     <th>DEPARTMENT</th>   
     <th>ACTIONS</th>   

</thead>
<tbody>

    
    <tr>
        <?php 

        $department_name = $_GET['department'];
   
        require_once("include/connection.php");

      $query = mysqli_query($conn,"SELECT department.name as department_name, login_user.id as user_id, login_user.name as user_name, login_user.email_address as email FROM `login_user` INNER JOIN `department` ON department.id = login_user.department where department.name = '$department_name'") or die (mysqli_error($con));
      
      if(mysqli_num_rows($query) < 1) {
        echo"<td>No Admin in this department</td>";
        echo"<td>NONE</td>";
        echo"<td>NONE</td>";
        echo"<td>NONE</td>";
        echo"<td>NONE</td>";
      }else{
        $query_data =$query;
      
      
      while($file=mysqli_fetch_array($query_data)){
         $id =  $file['user_id'];
         $name =  $file['user_name'];
         $email =  $file['email'];
         $department =  $file['department_name'];

         $files_q = "SELECT * FROM archived_files where name='$name'";
         $files_result = mysqli_query($conn, $files_q);
         $t_files = mysqli_num_rows($files_result);
    
      ?>
      <td><?php echo  $id; ?></td>
      <td><?php echo $name; ?></td>
       <td><?php echo $email; ?></td>
       <td><?php echo $t_files; ?></td>
       <td><?php echo $department; ?></td>
       <td><a href="show_user_archive.php?user_name=<?php echo $name; ?>"><button class="btn btn-info"><i class="fa fa-file "></i> VIEW FILES</button></a></td>
    </tr>
<?php } }?>
</tbody>
   </table>
    </div>  
    <!--Copyright-->
    <hr></div>
    <!--/.Copyright-->

  </footer>
  <!--/.Footer-->

<!-- Card -->
  <!-- /Start your project here-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>

  <script type="text/javascript" src="js/popper.min.js"></script>

  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <script type="text/javascript" src="js/mdb.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>   
<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.3/css/dataTables.responsive.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/1.0.3/js/dataTables.responsive.js"></script>

</body>

</html>
