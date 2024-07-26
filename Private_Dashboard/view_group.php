<!DOCTYPE html>
<html lang="en">
<?php
// Initialize session
session_start();

// Check if the username session is NOT set then this page will jump to the login page
if (!isset($_SESSION['admin_user'])) {
    header('Location: index.html');
}



?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>VIEW GROUP</title>
    <link rel="icon" href="img/images.png" type="image/x-icon"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="js/jquery-1.8.3.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="medias/css/dataTable.css" />
    <!-- DataTables JS -->
    <script src="medias/js/jquery.dataTables.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!-- DataTables initialization -->
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function(){
            $('#dtable').dataTable({
                "aLengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                "iDisplayLength": 10
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

        .map-container {
            overflow: hidden;
            padding-bottom: 56.25%;
            position: relative;
            height: 0;
        }

        .map-container iframe {
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            position: absolute;
        }

        #loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('img/lg.flip-book-loader.gif') 50% 50% no-repeat rgb(249,249,249);
            opacity: 1;
        }

        table {
            overflow-y: scroll;
            height: 300px;
            display: block;
        }
    </style>

    <!-- Hide loader after page load -->
    <script type="text/javascript">
        $(window).on('load', function(){
            setTimeout(function(){
                $('#loader').fadeOut('slow');
            });
        });
    </script>
</head>

<body class="grey lighten-3">

    <!-- Main Navigation -->
    <?php 
        $id = $_SESSION['admin_user'];
        include('side_bar.php');
    ?>
    <header>
        <?php
            require_once("include/connection.php");
            $id = mysqli_real_escape_string($conn,$_SESSION['admin_user']);
            $r = mysqli_query($conn,"SELECT * FROM admin_login where admin_user = '$id'") or die (mysqli_error($con));
            $row = mysqli_fetch_array($r);
            $id = $row['admin_user'];
            $department_ = $row['department'];
            $name__ = $row['name'];
        ?>
    </header>

    <!-- Main layout -->
    <main class="pt-5 mx-lg-5 barchartdata">
        <div class="container-fluid mt-5">
            <!-- Heading -->
            <div class="card mb-4 wow fadeIn">
                <!-- Card content -->
                <div class="card-body d-sm-flex justify-content-between">
                    <h4 class="mb-2 mb-sm-0 pt-1">
                        <a href="dashboard.php">Home Page</a>
                        <span>/</span>
                        <span>View Group</span>
                    </h4>
                </div>
            </div>
            <!-- Heading -->

            <!-- Two equal-width columns -->
            <div class="row">
                <div class="col-md-6">
                    <h2>User Groups</h2>
                    <!-- Add button and group list here -->
                    <div>
                        <a data-toggle="modal" data-target="#addgroupmodal"><button type="button" class="btn btn-info"><i class="fas fa-plus"></i> Create group</button></a>
                    </div>
                    <?php
                        $query = mysqli_query($conn,"SELECT DISTINCT group_name, id FROM group_names WHERE creator != 'NONE' AND department = '$department_'  group by group_name DESC") or die (mysqli_error($con));
                        $query_empty = mysqli_query($conn,"SELECT DISTINCT group_name, id FROM group_names WHERE creator = 'NONE' group by group_name DESC") or die (mysqli_error($con));
                        if(mysqli_num_rows($query) < 1) {?>
                            <div class="card">
                                <div class="card-body">
                                     No group created
                                </div>
                            </div></a>

                            <?php
                        } else {
                            $query;
                        }
                        while ($group_ = mysqli_fetch_array($query)) {
                            
                            // Original group_name
                            $original_group_name = $group_['group_name'];

                            // Hash the group_name using md5 (you can use other hashing algorithms as well)
                            $hashed_group_name = md5($original_group_name);

                            // URL encode the hashed group_name
                            $encoded_hashed_group_name = urlencode($hashed_group_name);
                            ?>

                            <a href="view_group_detail.php?group_name=<?php echo $encoded_hashed_group_name; ?>">

                            <div class="card">
                                <div class="card-body">
                                     <?php echo $group_['group_name']; ?>
                                </div>
                            </div></a>
                    <?php } ?>
                </div>

                <div class="col-md-6">
                    <h2>Joined Groups</h2>
                    <?php
                        $query = mysqli_query($conn,"SELECT DISTINCT group_name, department_id FROM group_members WHERE department_id = '$department_'  group by group_name DESC") or die (mysqli_error($con));
                        // $query_empty = mysqli_query($conn,"SELECT DISTINCT group_name, department_id FROM group_members WHERE department_id = '0' group by group_name DESC") or die (mysqli_error($con));
                        if(mysqli_num_rows($query) < 1) {?>
                            <div class="card">
                                <div class="card-body">
                                     No group join
                                </div>
                            </div></a>
                        <?php
                        } else {
                            $query;
                        }
                        while ($group_ = mysqli_fetch_array($query)) { 
                            $original_group_name = $group_['group_name'];

                            // Hash the group_name using md5 (you can use other hashing algorithms as well)
                            $hashed_group_name = md5($original_group_name);

                            // URL encode the hashed group_name
                            $encoded_hashed_group_name = urlencode($hashed_group_name);
                            ?>
                            <a href="view_joingroup.php?group_name=<?php echo $encoded_hashed_group_name; ?>">

                                <div class="card">
                                    <div class="card-body">
                                        <?php echo $group_['group_name']; ?>
                                        
                                    </div>
                                </div></a>
                    <?php } ?>
                </div>
            </div>
            <!-- Two equal-width columns -->
        </div>
    </main>
    <!-- Main layout -->

    <!-- Footer -->

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.3/css/dataTables.responsive.css">
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/1.0.3/js/dataTables.responsive.js"></script>

    <!-- Add group modal -->
    <div class="modal fade" id="addgroupmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form method="POST">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold"><i class="fas fa-user-plus"></i> Add group</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                        </div>
                        <div class="md-form mb-5">
                            <i class="fas fa-user prefix grey-text"></i>
                            <input type="text" id="orangeForm-name" name="group__name" class="form-control validate" required="">
                            <label data-error="wrong" data-success="right" for="orangeForm-name">Group name</label>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button class="btn btn-info" name="group_create">Create group</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Add group modal -->
</body>
</html>

<?php
if (isset($_POST['group_create'])) {
    $g_name = $_POST['group__name'];
    $sql = "INSERT INTO group_names (group_name, creator, department) VALUES ('$g_name', '$name__', '$department_')";
    if (mysqli_query($conn, $sql)) {
        echo '<script type = "text/javascript">
                  alert("Group created");
                  window.location = "view_group.php";
              </script>';
    }
}
?>
