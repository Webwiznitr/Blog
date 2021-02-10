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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <title>Posts</title>
</head>
<body>
<!--NAVIGATION BAR-->
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
<!--NAVBAR ENDS-->

<!--HEADER-->
<header class="text-white py-3"style="background-image:linear-gradient(360deg, #1B80B2 ,#1B0039);">
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
<!--MAIN AREA ENDS-->
<!--FOOTER-->
<?php require_once ("Backendfooter.php");?>

