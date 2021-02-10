<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login(); ?>

 <?php
  if(isset($_POST["Submit"])){                                        //setting connection of name submit
    $Category = $_POST["CategoryTitle"];
    $Admin =  $_SESSION["UserName"];
    date_default_timezone_set("Asia/Kolkata");
    $CurrentTime=time();
    $DateTime=strftime("%B-%d-%Y %H: %M: %S",$CurrentTime);


    if(empty($Category)){                                              //assigning variable to name of "CatagoryTitle"
        $_SESSION["ErrorMessage"] = "All fields must be filled out";
        Redirect_to("Categories.php");
    }elseif (strlen($Category)<2){
        $_SESSION["ErrorMessage"] = "category title should be greater than 2 character";
        Redirect_to("Categories.php");
    }elseif (strlen($Category)>49) {
        $_SESSION["ErrorMessage"] = "category title should be less than 50 character";
        Redirect_to("Categories.php");
    }else{
       //Query to insert category in database when everything is good

        $sql = "INSERT INTO category(title,author,datetime)VALUES(:categoryName,:adminName,:dateTime)";
        $stmt = $ConnectingDB->prepare($sql);

        //binding the values

        $stmt->bindValue(':categoryName',$Category);
        $stmt->bindValue(':adminName',$Admin);
        $stmt->bindValue(':dateTime',$DateTime);
        $Execute=$stmt->execute();

        if($Execute){
            $_SESSION["SuccessMessage"]="Category with id : ".$ConnectingDB->lastInsertId() ."''Added Successfully";
            Redirect_to("Categories.php");
        }else{
            $_SESSION["ErrorMessage"]= "something went wrong... Try Again !";
            Redirect_to("Categories.php");
        }
    }

  }

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
    <title>Categories</title>
</head>
<body>
<?php  ?>
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
<!--NAVBAR-->

<!--HEADER-->
<header class="text-white py-3"style="background-image:linear-gradient(360deg, #1B80B2 ,#1B0039);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><i class="fas fa-edit" style="color:#27aae1;"></i> Manage Categories</h1>
            </div>
        </div>
    </div>
</header>
<!--HEADER-->

<!--MAIN AREA-->
<section class="container py-2 mb-4">
  <div class="row">
      <div class="offset-lg-1 col-lg-10" style="min-height: 540px;">
          <?php
                 echo ErrorMessage();
                 echo SuccessMessage();
          ?>
          <form class="" action="Categories.php" method="post">
              <div class="card bg-secondary text-light mb-3">
                  <div class="card-header">
                      <h1>Add New Category</h1>
                  </div>
                  <div class="card-body bg-dark">
                      <div class="form-group">
                          <label for="title"><span class="fieldinfo">Category Title :</span></label>
                          <input class="form-control" type="text" name="CategoryTitle" placeholder="Type title here">
                      </div>
                      <div class="row">
                          <div class="col-lg-6 mb-2">
                              <a href="#" class="btn btn-warning btn-block"> <i class="fas fa-arrow-left"></i> Back to dashboard</a>
                          </div>
                          <div class="col-lg-6 mb-2">
                              <button type="Submit" name="Submit" class="btn btn-success btn-block">
                                  <i class="fas fa-check"></i> Publish
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
          </form>
         <!--delete category-->
          <h2>Existing Categories</h2>
          <div class="table-responsive">
          <table class="table table-striped table-hover">
              <thead class="thead-dark">
              <tr>
                  <th>No. </th>
                  <th>Date&Time</th>
                  <th>Category Name</th>
                  <th>Creator Name</th>
                  <th>Action</th>
              </tr>
              </thead>
              <?php
              global $ConnectingDB;
              $sql = "SELECT * FROM category  ORDER BY id desc";
              $Execute = $ConnectingDB->query($sql);
              $SrNo = 0;
              while ($DataRows=$Execute->fetch()){
                  $CategoryId = $DataRows["id"];
                  $CategoryDate = $DataRows["datetime"];
                  $CategoryName = $DataRows["title"];
                  $CreatorName = $DataRows["author"];
                  $SrNo++;
                  ?>
                  <tbody>
                  <tr>
                      <td><?php echo htmlentities($SrNo); ?></td>
                      <td><?php echo htmlentities($CategoryDate); ?></td>
                      <td><?php echo htmlentities($CategoryName); ?></td>
                      <td><?php echo htmlentities($CreatorName); ?></td>
                      <td><a href="DeleteCategory.php?id=<?php echo $CategoryId;?>" class="btn btn-danger">Delete</a></td>

                  </tr>
                  </tbody>
              <?php }?>
          </table>
          </div>
      </div>
  </div>
</section>

<!--FOOTER-->
<?php require_once ("Backendfooter.php");?>

