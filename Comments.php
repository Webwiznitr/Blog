<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scal=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/7f6ee3d237.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <title>Comments</title>
</head>
<body>
<!--NAVIGATION BAR STARTS-->
<div class="navbar navbar-expand-lg navbar-light bg-custom">
    <div class="container">
        <a href="#" class="navbar-brand " style= "color:aliceblue; font-family: mindsagacustom;">MindSaga</a>
        <button class="navbar-toggler ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#Rcollapse" aria-controls="Rcollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="Rcollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item" >
                    <a href="MyProfile.php" class="nav-link" style= "color:white ; font-weight: bolder;">My Profile</a>
                </li>
                <li class="nav-item">
                    <a href="Dashboard.php" class="nav-link" style= "color:white ; font-weight: bolder;">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="Posts.php" class="nav-link" style= "color:white ; font-weight: bolder;">Posts</a>
                </li>
                <li class="nav-item">
                    <a href="Categories.php" class="nav-link"style= "color:white ; font-weight: bolder;">Categories</a>
                </li>

                <li class="nav-item">
                    <a href="Admins.php" class="nav-link" style= "color:white ; font-weight: bolder;">Manage Admins</a>
                </li>
                <li class="nav-item">
                    <a href="Comments.php" class="nav-link" style= "color:white ; font-weight: bolder;">Comments</a>
                </li>
                <li class="nav-item">
                    <a href="index.php" class="nav-link" style= "color:white ; font-weight: bolder;">GO Live</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" ><a href="Logout.php" class="nav-link text-warning" ><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>

    </div>
</div>
<!--NAVIGATION BAR ENDS-->

<!--HEADER STARTS-->
<header class="text-white py-3"style="background-image:linear-gradient(360deg, #1B80B2 ,#1B0039);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <h1><i class="fas fa-comments"></i> Manage Comments</h1>
            </div>
        </div>
    </div>
</header>
<!--HEADER ENDS-->
<section class="container py-2 mb-4">
    <div class="row" style="min-height: 30px;">
        <div class="col-lg-12" style="min-height: 400px;">
            <?php
            echo ErrorMessage();
            echo SuccessMessage();
            ?>
            <h2>Un-Approved Comments</h2>
            <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>No. </th>
                        <th>Date&Time</th>
                        <th>Name</th>
                        <th>Comment</th>
                        <th>Approve</th>
                        <th>Action</th>
                        <th>Details</th>
                    </tr>
                </thead>
              <?php
               global $ConnectingDB;
               $sql = "SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
               $Execute = $ConnectingDB->query($sql);
               $SrNo = 0;
                while ($DataRows=$Execute->fetch()){
                  $CommentId = $DataRows["id"];
                  $DateTimeOfComment = $DataRows["datetime"];
                  $CommenterName = $DataRows["name"];
                  $CommentContent= $DataRows["comment"];
                  $CommentPostId = $DataRows["post_id"];
                  $SrNo++;
              ?>
              <tbody>
                 <tr>
                    <td><?php echo htmlentities($SrNo); ?></td>
                    <td><?php echo htmlentities($DateTimeOfComment); ?></td>
                    <td><?php echo htmlentities($CommenterName); ?></td>
                    <td><?php echo htmlentities($CommentContent); ?></td>
                    <td><a href="ApproveComments.php?id=<?php echo $CommentId;?>" class="btn btn-success">Approve</a></td>
                     <td><a href="DeleteComments.php?id=<?php echo $CommentId;?>" class="btn btn-danger">Delete</a></td>
                    <td><a class="btn btn-primary" href="FullPost.php?id<?php echo $CommentPostId; ?>" target="_blank">Live preview</a></td>
                  </tr>
              </tbody>
                 <?php }?>
            </table>
            </div>

              <!-- approved comments-->
            <h2>Approved Comments</h2>
            <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                <tr>
                    <th>No. </th>
                    <th>Date&Time</th>
                    <th>Name</th>
                    <th>Comment</th>
                    <th>Revert</th>
                    <th>Action</th>
                    <th>Details</th>
                </tr>
                </thead>
                <?php
                global $ConnectingDB;
                $sql = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
                $Execute = $ConnectingDB->query($sql);
                $SrNo = 0;
                while ($DataRows=$Execute->fetch()){
                    $CommentId = $DataRows["id"];
                    $DateTimeOfComment = $DataRows["datetime"];
                    $CommenterName = $DataRows["name"];
                    $CommentContent= $DataRows["comment"];
                    $CommentPostId = $DataRows["post_id"];
                    $SrNo++;
                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo htmlentities($SrNo); ?></td>
                        <td><?php echo htmlentities($DateTimeOfComment); ?></td>
                        <td><?php echo htmlentities($CommenterName); ?></td>
                        <td><?php echo htmlentities($CommentContent); ?></td>
                        <td style="min-width:140px;"><a href="DisApproveComments.php?id=<?php echo $CommentId;?>" class="btn btn-warning">Dis-Approve</a></td>
                        <td style="min-width:140px;"><a href="DeleteComments.php?id=<?php echo $CommentId;?>" class="btn btn-danger">Delete</a></td>
                        <td style="min-width:140px;"><a class="btn btn-primary" href="FullPost.php?id<?php echo $CommentPostId; ?>" target="_blank">Live preview</a></td>
                    </tr>
                    </tbody>
                <?php }?>
            </table>
            </div>
        </div>
    </div>
</section>

<!--FOOTER STARTS-->
<?php require_once ("Backendfooter.php");?>
