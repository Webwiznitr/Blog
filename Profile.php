<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
$SearchQueryParameter = $_GET["username"];
global   $ConnectingDB;
$sql    =  "SELECT aname,aheadline,abio,aimage FROM admins WHERE username=:userName";
$stmt   =  $ConnectingDB->prepare($sql);
$stmt   -> bindValue(':userName', $SearchQueryParameter);
$stmt   -> execute();
$Result = $stmt->rowcount();
if( $Result==1 ){
    while ( $DataRows   = $stmt->fetch() ) {
        $ExistingName     = $DataRows["aname"];
        $ExistingBio      = $DataRows["abio"];
        $ExistingImage    = $DataRows["aimage"];
        $ExistingHeadline = $DataRows["aheadline"];
    }
}else {
    $_SESSION["ErrorMessage"]="Bad Request !!";
    Redirect_to("index.php?page=1");
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
    <link rel="stylesheet" href="css/main.css">
    <title>Profile</title>
</head>
<body>
<!--NAVIGATION BAR STARTS-->
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
                        <a href="index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">Blog</a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Features</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <form class="form-inline d-none d-sm-block" action="index.php">
                        <div class="form-group">
                            <input class="form-control mr-2" type="text" name="Search" placeholder="Search here" value="">
                            <button  class="btn btn-primary" name="SearchButton">Go</button>
                        </div>
                    </form>
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
            <div class="col-md-6">
            <h1><i class="fas fa-user text-success mr-2" style="color: #27aae1;"></i> <?php echo$ExistingName; ?></h1>
                <h3><?php echo $ExistingHeadline; ?></h3>
            </div>
        </div>
    </div>
</header>
<!--HEADER ENDS-->
<section class="container py-2 mb-4">
    <div class="row">
        <div class="col-md-3">
            <img src="images/<?php echo $ExistingImage; ?>" class="d-block img-fluid mb-3 rounded-circle" alt="">
        </div>
        <div class="col-md-9" style="min-height:400px;">
            <div class="card">
                <div class="card-body">
                    <p class="lead"> <?php echo $ExistingBio; ?> </p>
                </div>
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
