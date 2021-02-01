<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 Confirm_Login(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scal=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/7f6ee3d237.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <title>Dashboard</title>
</head>
<body>
<!--NAVIGATION BAR-->
<div style="height: 10px; background: cornflowerblue"></div>
<div class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a href="#" class="navbar-brand">THINK HARD</a>
        <button style="background-color: #BEC9F2;" class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#Rcollapse">
            <span class="navbar-toggle-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="Rcollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="MyProfile.php" class="nav-link"><i class="fas fa-user text-success"></i> My Profile</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="Posts.php" class="nav-link">Posts</a>
                </li>
                <li class="nav-item">
                    <a href="Categories.php" class="nav-link">Categories</a>
                </li>

                <li class="nav-item">
                    <a href="Admins.php" class="nav-link">Manage Admins</a>
                </li>
                <li class="nav-item">
                    <a href="Comments.php" class="nav-link">Comments</a>
                </li>
                <li class="nav-item">
                    <a href="index.php" class="nav-link">GO Live</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="Logout.php" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>

    </div>
</div>
<div style="height: 10px; background: cornflowerblue"></div>
<!--NAVBAR-->

<!--HEADER-->
<header class="bg-dark text-white py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1> <i class="fas fa-cog" style="color: #27aae1;"></i> Dashboard</h1>
            </div>
            <div class="col-lg-3 mb-2">
                <a href="Addnewpost.php" class="btn btn-primary btn-block">
                    <i class="fas fa-edit"></i> Add New Post
                </a>
            </div>
            <div class="col-lg-3 mb-2">
                <a href="Categories.php" class="btn btn-info btn-block">
                    <i class="fas fa-folder-plus"></i> Add New category
                </a>
            </div>
            <div class="col-lg-3 mb-2">
                <a href="Admins.php" class="btn btn-warning btn-block">
                    <i class="fas fa-user-plus"></i> Add New Admin
                </a>
            </div>
            <div class="col-lg-3 mb-2">
                <a href="Comments.php" class="btn btn-success btn-block">
                    <i class="fas fa-check"></i> Manage Comments
                </a>
            </div>
    </div>
</header>
<!--HEADER-->


<!--MAIN AREA-->
<section class="container py-2 mb-4">
    <div class="row">

               <!-- left side starts-->
            <div class="col-lg-2 d-none d-md-block">
                      <div class="card text-center bg-dark text-white mb-3">
                         <div class="card-body">
                              <h1 class="lead">Posts</h1>
                              <h4 class="display-5">
                                    <i class="fab fa-readme"></i>
                                    <?php
                                     TotalPosts();
                                    ?>
                              </h4>
                         </div>
                     </div>

                     <div class="card text-center bg-dark text-white mb-3">
                         <div class="card-body">
                              <h1 class="lead">Categories</h1>
                              <h4 class="display-5">
                                 <i class="fab fa-folder"></i>
                                  <?php
                                  TotalCategories();
                                  ?>
                             </h4>
                        </div>
                    </div>

                    <div class="card text-center bg-dark text-white mb-3">
                        <div class="card-body">
                            <h1 class="lead">Admins</h1>
                            <h4 class="display-5">
                               <i class="fas fa-user"></i>
                                <?php
                                TotalAdmins();
                                ?>
                            </h4>
                       </div>
                    </div>

                    <div class="card text-center bg-dark text-white mb-3">
                        <div class="card-body">
                            <h1 class="lead">Comments</h1>
                            <h4 class="display-5">
                                <i class="fas fa-comments"></i>
                                <?php
                                TotalComments();
                                ?>
                            </h4>
                        </div>
                    </div>
            </div>
              <!--left-side ends-->

              <!--right area starts-->
            <div class="col-lg-10">
                <?php
                echo ErrorMessage();
                echo SuccessMessage();
                ?>
            <h1>Top Posts</h1>
                <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Date&Time</th>
                        <th>Author</th>
                        <th>Comments</th>
                        <th>Details</th>
                    </tr>
                    </thead>
                    <?php
                    $SrNo = 0;
                    global $ConnectingDB;
                    $sql="SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
                    $stmt=$ConnectingDB->query($sql);
                    while($DataRows=$stmt->fetch()){
                        $PostId = $DataRows["id"];
                        $DateTime = $DataRows["datetime"];
                        $Author = $DataRows["author"];
                        $Title =  $DataRows["title"];
                        $SrNo++;
                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo $SrNo;?></td>
                        <td><?php echo $Title;?></td>
                        <td><?php echo $DateTime;?></td>
                        <td><?php echo $Author;?></td>
                        <td>
                                <?php
                                $Total=ApproveCommentsAccordingtoPost($PostId);
                                if($Total>0) {
                                ?>
                                 <span class="badge badge-success">
                                     <?php
                                    echo $Total; ?>
                                 </span>
                                 <?php } ?>
                                 </span>
                                <?php
                                $Total=DisApproveCommentsAccordingtoPost($PostId);
                                if($Total>0) {
                                    ?>
                                    <span class="badge badge-danger">
                                     <?php
                                     echo $Total; ?>
                                 </span>
                                <?php } ?>
                                </span>
                        </td>
                        <td><a target="_blank" href="FullPost.php?id="><?php echo $PostId; ?></a><span class="btn btn-info">Preview</span></td>
                    </tr>
                    </tbody>
                    <?php } ?>
                </table>
                </div>
            </div>
    </div>
</section>
<!--MAIN AREA-->
<!--FOOTER-->
<div style="height: 5px; background: cornflowerblue"></div>
<footer class="bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="lead text-center">THINK HARD  |  <span id="year"></span>&copy: -----All right reserved</p>
            </div>
        </div>
    </div>
</footer>
<div style="height: 5px; background: cornflowerblue"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>
    $('#year').text(new Date().getFullYear());
</script>
</body>
</html>

