<!DOCTYPE html>
<html lang="en">
<?php
// include('Private_Dashboard/include/connection.php');
session_start();
if(!isset($_SESSION["email_address"])){
    header("location:../login.html");

} 

?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Material Design Bootstrap</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">


<!-- 
<link href="css/addons/datatables.min.css" rel="stylesheet">
<script href="js/addons/datatables.min.js" rel="stylesheet"></script>
<link href="css/addons/datatables-select.min.css" rel="stylesheet">
<script href="js/addons/datatables-select.min.js" rel="stylesheet"></script> -->


<!-- <link rel="stylesheet" id="font-awesome-style-css" href="http://phpflow.com/code/css/bootstrap3.min.css" type="text/css" media="all">
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script> -->
    <script src="js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="media/css/dataTable.css" />
    <script src="media/js/jquery.dataTables.js" type="text/javascript"></script>
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
    <style type="text/css">
      select[multiple], select[size] {
    height: auto;
    width: 20px;
}
.pull-right {
    float: right;
    margin: 2px !important;
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
 /*   #dtable{
 display: block;

  overflow-x: scroll;
  width: 600px;
    }*/



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

<body style="padding:0px; margin:0px; background-color:#fff;font-family:arial,helvetica,sans-serif,verdana,'Open Sans'">
  <?php 

     require_once("include/connection.php");


   $id = mysqli_real_escape_string($conn,$_SESSION['email_address']);


  $r = mysqli_query($conn,"SELECT * FROM login_user where id = '$id'") or die (mysqli_error($con));

  $row = mysqli_fetch_array($r);

   $id=$row['email_address'];
   // $fname=$row['fname'];
   // $lname=$row['lname'];

?>
  <!-- Start your project here-->
<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color fixed-top">
    <a class="navbar-brand" href="#"><img src="js/img/Files_Download.png" width="33px" height="33px"> <font color="#F0B56F">F</font>ile <font color="#F0B56F">M</font>anagement <font color="#F0B56F">S</font>ystem</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
    aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
    <ul class="navbar-nav ml-auto">
      <!-- <li class="nav-item active">
        <a class="nav-link" href="#">
          <i class="fab fa-facebook-f"></i> Facebook
          <span class="sr-only">(current)</span>
        </a>
      </li>-->
   
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
           <font color="black">Welcome!,</font> <?php echo ucwords(htmlentities($id)); ?> <i class="fas fa-user-circle"></i> Login </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
           <a class="dropdown-item" href="history_log.php"> <i class="fas fa-chalkboard-teacher"></i> User Logged</a>
          <a class="dropdown-item" href="Logout.php"><i class="fas fa-sign-in-alt"></i> LogOut</a>

        </div>
      </li>
    </ul>
  </div>
</nav>
<br>
<!--/.Navbar -->
<br><Br><br>
<!-- Card -->
<div class="container">
  <div class="row">
     <div class="col-md-9">
    <div class="">
    <!--   <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalRegisterForm">Add File</button> -->
    <a href="home.php"><button type="button" class="btn btn-info"><i class="fas fa-chevron-circle-left"></i>  Home</button></a>
    </div>
<hr>
  <table id="dtable" class = "table table-striped" style="">
     <thead>

    <!-- <th>ID</th> -->
    <th>USER LOGGED</th>    
     <th>YOUR IP</th>
     <th>HOST</th>
     <th>ACTION</th> 
     <th>TIMEIN</th>
     <th>ACTION</th> 
     <th>TIMEOUT</th>


</thead>
<tbody>

    
    <tr>
        <?php 
   
        require_once("include/connection.php");

      $query = mysqli_query($conn,"SELECT * from history_log") or die (mysqli_error($conn));
      while($file=mysqli_fetch_array($query)){
       //  $id =  $file['id'];
         $name =  $file['email_address'];
         $ip =  $file['ip'];
         $host =  $file['host'];
         $action =  $file['action'];
         $logintime =  $file['login_time'];
         $actions =  $file['actions'];
         $logouttime =  $file['logout_time'];
      
    
      ?>
     
      <!-- <td><?php echo  $id; ?></td> -->
      <td><?php echo $name; ?></td>
       <td><?php echo $ip; ?></td>
      <td><?php echo $host; ?></td>
      <td><?php echo $action; ?></td>
      <td><?php echo $logintime; ?></td>
      <td><?php echo $actions; ?></td>
      <td><?php echo $logouttime; ?></td>

    </tr>
<?php } ?>
</tbody>
   </table>
    </div>
 


</script>


 <div class="col-md-3" style="border-top: 4px solid #17a2b8;border-radius: 4px;  box-shadow: 0px 1px 1px 0px  #6c757d;"><br>
  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
      aria-controls="pills-home" aria-selected="true">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
      aria-controls="pills-profile" aria-selected="false">About</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
      aria-controls="pills-contact" aria-selected="false">Contact</a>
  </li>
</ul>
<div class="tab-content pt-2 pl-1" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <img src="img/nel.jpg" class="rounded" alt="..."><hr>
    <div class="">
     
     <div class=""><p><b style="font-size: 1.1em">Full Name:</b>Toledo, Junil A.</p></div>
     <div class=""><p><b style="font-size: 1.1em">Position:</b>Software Engineer</p></div>

  </div>
  <hr>
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
   <h6 style="font-size: 1.1em">file management system (fMS)</h6><Hr>
  is a system (based on computer programs in the case of the management of digital documents) used to track, manage and store documents and reduce paper. Most are capable of keeping a record of the various versions created and modified by different users (history tracking).</div>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"><h6 style="font-size: 1.1em">Contact Number</h6><Hr><br><div class=""><p><b style="font-size: 1.1em">Cellphone #:</b>09991050748</p></div><p><b style="font-size: 1.1em">Address :</b>Antipolo City</p>
</div><hr><br>
<!--   <div class="card">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Cras justo odio</li>
    <li class="list-group-item">Dapibus ac facilisis in</li>
    <li class="list-group-item">Vestibulum at eros</li>
  </ul>
</div><br> -->
   <!-- Card -->
<div class="card" style="border-top: 4px solid #17a2b8;border-radius: 4px;">

  <!-- Card image -->
  <div class="view overlay">

      <div class="mask rgba-white-slight"></div>
    </a>
  </div>

  <!-- Card content -->
  <div class="card-body">

    <!-- Title -->
    <h4 class="card-title">File Document</h4><hr>
    <!-- Text -->

    <ul>
      <li> <p>Ensuring changes and revisions are clearly identified</p></li>
      <li> <p>Ensuring that documents remain legible and identifiable</p></li>
      <li> <p>Preventing “unintended” use of obsolete documents</p></li>
    </ul>
    <!-- Button -->
<!--     <a href="#" class="btn btn-primary">Button</a> -->

  </div>

</div>
<!-- Card -->

 </div>
</div>
</div>


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
