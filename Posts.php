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
    <title>Posts</title>
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
                    <a href="#" class="nav-link"><i class="fas fa-user text-success"></i> My Profile</a>
                </li>
                <li class="nav-item">
                    <a href="Dashboard.php" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Posts</a>
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
                <h1> <i class="fas fa-blog" style="color: #27aae1;"></i> Blog Posts</h1>
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
                <a href="ApproveComments.php" class="btn btn-success btn-block">
                    <i class="fas fa-check"></i> Approve Comments
                </a>
            </div>
    </div>
</header>
<!--HEADER-->


<!--MAIN AREA-->
<section class="container py-2 mb-4">
    <div class="row">
        <div class="col-lg-12">
            <?php
            echo ErrorMessage();
            echo SuccessMessage();
            ?>
            <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date & Time</th>
                    <th>Author</th>
                    <th>Banner</th>
                    <th>Comments</th>
                    <th>Action</th>
                    <th>Live Preview</th>
                </tr>
                </thead>
                <?php
                global $ConnectingDB;
                $sql = "SELECT* FROM posts";
                $stmt = $ConnectingDB->query($sql);
                $sr = 0;
                while ($DataRows = $stmt->fetch()){
                    $Id       = $DataRows["id"];
                    $DateTime = $DataRows["datetime"];
                    $PostTitle= $DataRows["title"];
                    $Category = $DataRows["category"];
                    $Admin    = $DataRows["author"];
                    $Image    = $DataRows["image"];
                    $PostTest = $DataRows["post"];
                    $sr++;
                ?>
                    <tbody>
                <tr>
                    <td><?php echo $sr ?></td>
                    <td> <?php
                        if (strlen($PostTitle)>20){$PostTitle= substr($PostTitle,0,20).'..';}
                         echo $PostTitle;
                        ?>
                        </td>
                    <td>
                        <?php
                        if (strlen($Category)>8){$Category= substr($Category,0,8).'..';}
                        echo $Category;
                        ?>
                    </td>
                    <td>
                        <?php
                        if (strlen($DateTime)>11){$DateTime= substr($DateTime,0,11).'..';}
                        echo $DateTime;
                        ?>
                    </td>
                    <td>
                        <?php
                        if (strlen($Admin)>6){$Admin= substr($Admin,0,6).'..';}
                        echo $Admin;
                        ?>
                    </td>
                    <td><img src="Uploads/<?php echo $Image; ?>" width="50px;" height="50px;"</td>
                    <td>
                        <?php
                        $Total=ApproveCommentsAccordingtoPost($Id);
                        if($Total>0) {
                            ?>
                            <span class="badge badge-success">
                                     <?php
                                     echo $Total; ?>
                                 </span>
                        <?php } ?>
                        </span>
                        <?php
                        $Total=DisApproveCommentsAccordingtoPost($Id);
                        if($Total>0) {
                            ?>
                            <span class="badge badge-danger">
                                     <?php
                                     echo $Total; ?>
                                 </span>
                        <?php } ?>
                        </span>
                    </td>
                    <td>
                        <a href="EditPost.php?id=<?php echo $Id;?>" ><span class="btn btn-warning">Edit</span></a>
                        <a href="DeletePost.php?id=<?php echo $Id; ?>"><span class="btn btn-danger">Delete</span></a>
                    </td>
                    <td><a href="FullPost.php?id=<?php echo $Id; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
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

