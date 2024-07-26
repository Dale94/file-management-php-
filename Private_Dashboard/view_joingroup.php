<!DOCTYPE html>
<html lang="en">
<?php

// Inialize session
session_start();

include 'include/connection.php';
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['admin_user'])) {
header('Location: index.html');
}

$encoded_hashed_group_name = $_GET['group_name'];

// URL decode the hashed_group_name
$hashed_group_name = urldecode($encoded_hashed_group_name);

// Query the database to find the matching group_name
$query = mysqli_query($conn, "SELECT * FROM group_names WHERE MD5(group_name) = '$hashed_group_name'");
if ($row = mysqli_fetch_assoc($query)) {
    $original_group_name = $row['group_name'];
    // Now you have the original group_name
    $group_name = $original_group_name;

    // Proceed with your logic using $group_name

    // Now you can use $group_name in your queries or other operations
} else {
    // Handle the case where no matching group_name is found
    echo "Invalid group name!";
}

?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>VIEW JOINGROUP</title>
  <link rel="icon" href="Private_Dashboard/img/images.png" type="image/x-icon"/>
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
  $id = $_SESSION['admin_user'];
  include('side_bar.php');
?>
  <!--Main Navigation-->
  <header>
  <?php
    require_once("include/connection.php");


    $id = mysqli_real_escape_string($conn,$_SESSION['admin_user']);


   $r = mysqli_query($conn,"SELECT * FROM admin_login where admin_user = '$id'") or die (mysqli_error($con));

   $row = mysqli_fetch_array($r);

    $id=$row['admin_user'];
    $name = $row['name'];
    $department = $row['department'];
    // $fname=$row['fname'];
    // $lname=$row['lname'];

 ?>


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
            <span>Joined Group</span>
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

  <!-- Table -->
  <Form name="multiple_files" method="post" action="delete_group_members.php">
                    <!-- Heading -->
                    <div class="">
                    <!--   <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalRegisterForm">Add File</button> -->
                    <?php
                            // Original group_name
                            $original_group_name = $group_name;

                            // Hash the group_name using md5 (you can use other hashing algorithms as well)
                            $hashed_group_name = md5($original_group_name);

                            // URL encode the hashed group_name
                            $encoded_hashed_group_name = urlencode($hashed_group_name);
                    ?>
                    <input type="hidden" name= "name" value="<?php echo ucwords(htmlentities($group_name)); ?>" class="form-control" readonly="">
                    <a href="add_groupfile.php?group_name=<?php echo $encoded_hashed_group_name; ?>"><button type="button" class="btn btn-success"><i class="fas fa-file-medical"></i>  Add File</button></a>
                    <button type="submit" class="btn btn-danger" name="delete"><i class="fa fa-trash"></i> Delete Files</button>
                    <button type="submit" class="btn btn-primary" name="download"><i class="fa fa-download"></i> Download Files</button>
                    </div>

                    <div class="table-responsive">
                        <table id="dtable" class="table table-bordered" cellspacing="0" width="100%" >
                        <thead>

                        <th>Select</th>
                        <th>Filename</th>
                        <th>Uploader</th> 
                        <th>Date/Time Upload</th>
                    </thead>
                    <tbody>

                        
                        <tr>
                            <?php 
                    
                            require_once("include/connection.php");

                        $query = mysqli_query($conn,"SELECT DISTINCT id, file_name, department_id, time FROM group_files WHERE group_name != 'NONE' AND group_name = '$group_name'group by file_name DESC") or die (mysqli_error($con));
                        $query_empty = mysqli_query($conn,"SELECT DISTINCT id, file_name, department_id, time FROM group_files WHERE group_name = 'NONE' group by file_name DESC") or die (mysqli_error($con));
                        
                        if(mysqli_num_rows($query) < 1) {
                            $query_data = $query_empty;
                        }else{
                            $query_data =$query;
                        }
                        
                        while($file=mysqli_fetch_array($query_data)){
                            $id =  $file['id'];
                            $name =  $file['file_name'];
                            $departmentId =  $file['department_id'];
                            $time =  $file['time'];

                            $department_name = 'None'; // Default value if no department is found
                            $query_d = mysqli_query($conn,"SELECT * FROM department WHERE id = '$departmentId'") or die (mysqli_error($con));
                            if(mysqli_num_rows($query_d) > 0) {
                                $depp = mysqli_fetch_array($query_d);
                                $department_name = $depp['name'];
                            }



                        
                        ?>
                        <td><input name="checkbox[]" type="checkbox" value="<?php echo $id; ?>"></td>
                        <input type="hidden" name= "ID" value="<?php echo ucwords(htmlentities($id)); ?>" class="form-control" readonly="">

                        </form>
                        <td><?php echo  $name; ?></td>
                        <td><?php echo $department_name?></td>
                        <td><?php echo $time; ?></td>

                        </tr>
                    <?php } ?>
                    </div>
    <!--Copyright-->

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
