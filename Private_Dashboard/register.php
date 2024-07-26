<?php 

require_once("include/connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>REGISTER</title>
  <link rel="icon" href="img/images.png" type="image/x-icon"/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">

  <style type="text/css">
      body{
       background-image: url("img/honey_im_subtle.png");
      }
        #loader{
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('img/loading.gif') 50% 50% no-repeat rgb(249,249,249);
        opacity: 1;
    }

    </style>
</head>

<body style="padding:0px; margin:0px; background-image: url('img/snrm.jpg'); background-color: no-repeat; background-size: 100% 110%; font-family:arial,helvetica,sans-serif,verdana,'Open Sans';">

  <!-- Start your project here-->
<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark orange lighten-1">
    <a class="navbar-brand" href="index.html"><img src="img/images.png" width="33px" height="33px"> <font color="##74e874">L</font>GU <font color="##74e874">F</font>ile <font color="#74e874">M</font>anagement <font color="#74e874">S</font>ystem</a>
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
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fab fa-instagram"></i> Instagram</a>
      </li> -->
  <!--     <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i> Login </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
          <a class="dropdown-item" href="#">Login</a>

        </div>
      </li> -->
    </ul>
  </div>
</nav>
<!--/.Navbar -->
<br><Br>
<!-- Card -->
<div class="container col-md-5">
 <!-- Card -->
 <div class="card" style="background-color: rgba(255, 255, 255, 0.585);">
 <div id="loader"></div>
    <!-- Card body -->
    <div class="card-body">

        <!-- Material form register -->
        <form action="register_.php" method="POST">
            <p class="h4 text-center py-4">ADMIN SECURITY</p>

            <!-- Material input text -->

            <div class="md-form">
              <i class="fa fa-user prefix black-text"></i>
              <input type="text" id="materialFormCardEmailEx" name="username" class="form-control" >
              <label for="materialFormCardEmailEx" class="font-weight-light">Your full name</label>
          </div>
            <div class="md-form">
                <i class="fa fa-envelope prefix black-text"></i>
                <input type="email" id="materialFormCardEmailEx" name="email_address" class="form-control" >
                <label for="materialFormCardEmailEx" class="font-weight-light">Your email</label>
            </div>
            <!-- Material input password -->
            <div class="md-form">
                <i class="fa fa-lock prefix black-text"></i>
                <input type="password" id="materialFormCardPasswordEx" name="user_password" class="form-control">
                <label for="materialFormCardPasswordEx" class="font-weight-light">Your password</label>
            </div>
            <div class="md-form">
              <i class="fa fa-lock prefix black-text"></i>
              <input type="password" id="materialFormCardPasswordEx" name="confirm_password" class="form-control">
              <label for="materialFormCardPasswordEx" class="font-weight-light">Confirm your password</label>
          </div>
          <div class="md-form">
            <select id="materialFormCardPasswordEx" name="department" class="form-control">
              <?php
                  $query = mysqli_query($conn,"SELECT * FROM department") or die (mysqli_error($con));
                  while($department=mysqli_fetch_array($query)){
                    $name = $department['name'];
                    $id = $department['id'];

              ?>
                <option value="<?php echo $id ?>"><?php echo $name?></option>
              <?php }?> 
              
            </select>
        </div>

            <div class="text-center py-4 mt-3">
                <button class="btn btn-warning btn-lg btn-block" name = "register" id="register" type="submit">Register</button>
            </div>
            <div class="text-center py-4 mt-3">
                <h7>already have an accont? <a href="index.html">SIGN IN</a> </h7>
                
            </div>
      

        </form>
        <!-- Material form register -->

    </div>

    <!-- Card body -->

</div>
<!-- Card --></div>
<footer class="text-center py-4 mt-3" style="background-color: rgba(206, 209, 154, 0.585);margin-left: 30%;margin-right: 30%;border-radius:4px;    margin-bottom: 5px;">
  <!-- <p>All right Reserved &copy; <?php echo date('Y');?> Created By:JunilToledo</p> -->
</footer>
<!-- Card -->
  <!-- /Start your project here-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
</body>

<script type="text/javascript">
   $("#login").on("click", function () {
   
          uservalidate();
          passvalidate();
   
         if (uservalidate() === true
          && passvalidate() === true
   
          ) {
   
   };
   
   
   });
   
   
   function uservalidate() {
   if ($('#materialFormCardEmailEx').val() == '') { 
       $('#materialFormCardEmailEx').css('border-color', '#dc3545');
    return false;
     } else {
      $('#materialFormCardEmailEx').css('border-color', '#28a745'); 
       return true;
   }
   
   };
   
   function passvalidate() {
   if ($('#materialFormCardPasswordEx').val() == '') { 
    $('#materialFormCardPasswordEx').css('border-color', '#dc3545');
    return false;
     } else {
      $('#materialFormCardPasswordEx').css('border-color', '#28a745'); 
       return true;
   }
   
   };
   
   
</script>
  <script src = "jss/jquery.js"></script>
  <script src = "jss/bootstrap.js"></script>
  <script src = "jss/login.js"></script>
  <script src="jquery.min.js"></script>
<script type="text/javascript">
  $(window).on('load', function(){
    //you remove this timeout
    setTimeout(function(){
          $('#loader').fadeOut('slow');  
      }, 1000);
      //remove the timeout
      //$('#loader').fadeOut('slow'); 
  });
</script>
</html>
</body>
