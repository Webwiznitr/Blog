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
    <link rel="stylesheet" href="css/main.css">
    <title>Comments</title>
</head>
<body>
<!--NAVIGATION BAR STARTS-->
<div style="height: 10px; background: cornflowerblue"></div>
<div class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a href="#" class="navbar-brand">THINK HARD</a>
        <button style="background-color: #BEC9F2;" class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarcollapse">
            <span class="navbar-toggle-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarcollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="MyProfile.php" class="nav-link"><i class="fas fa-user text-success"></i> My Profile</a>
            </li>
            <li class="nav-item">
                <a href="Dashboard.php" class="nav-link">Dashboard</a>
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
                <a href="index.php?page=1" class="nav-link">GO Live</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="Logout.php" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
        </div>

    </div>
</div>
<div style="height: 10px; background: cornflowerblue"></div>
<!--NAVIGATION BAR ENDS-->

<!--HEADER STARTS-->
<header class="bg-dark text-white py-3">
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
<!--FOOTER ENDS-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>
    $('#year').text(new Date().getFullYear());
</script>
</body>
</html>
