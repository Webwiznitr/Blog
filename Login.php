<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
if(isset($_SESSION["UserId"])){
    Redirect_to("Dashboard.php");
}
if(isset($_POST["Submit"])){
    $UserName = $_POST["Username"];
    $Password = $_POST["Password"];
    if(empty($UserName)||empty($Password)){
        $_SESSION["ErrorMessage"]= "All fields must be filled out";
        Redirect_to("Login.php");
    }else{
        //calling function for login attempt  to check username and password from database

        $Found_Account=Login_Attempt($UserName,$Password);
        if($Found_Account) {
            $_SESSION["UserId"] = $Found_Account["id"];
            $_SESSION["UserName"] = $Found_Account["username"];
            $_SESSION["AdminName"] = $Found_Account["aname"];
            $_SESSION["SuccessMessage"] = "Welcome  " . $_SESSION["AdminName"]."!";
            if (isset($_SESSION["TrackingURL"])) {
                Redirect_to($_SESSION["TrackingURL"]);
            }else{
                Redirect_to("Dashboard.php");
            }
            }else {
            $_SESSION["ErrorMessage"]="Incorrect Username/Password";
            Redirect_to("Login.php");
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
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>Admin Login</title>
</head>
<body>
<!--NAVIGATION BAR STARTS-->

<div class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a href="#" class="navbar-brand " style= "color:aliceblue;">MindSaga</a>
    </div>
</div>

<!--NAVIGATION BAR ENDS-->

<!--HEADER STARTS-->

<!--HEADER ENDS-->

<!--MAIN AREA STARTS-->
<section class="container py-2 mb-4">
    <div class="row">
        <div class="offset-sm-3 col-sm-6" style="min-height:400px;">
            <br><br><br><br>
            <?php
            echo ErrorMessage();
            echo SuccessMessage();
            ?>
            <div class="card bg-secondary text-light">
                <div class="card-header">
                    <h4>WELCOME</h4>
                    <div class="card-body bg-dark">
                    <form class="" action="Login.php" method="post">
                        <div class="form-group">
                            <label for="username"><span class="fieldinfo">Username</span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text-white bg-info"> <i class="fas fa-user"> </i> </span>
                                </div>
                                <input type="text" class="form-control" name="Username" id="username" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password"><span class="fieldinfo">Password</span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text-white bg-info"> <i class="fas fa-lock"> </i> </span>
                                </div>
                                <input type="password" class="form-control" name="Password" id="password" value="">
                            </div>
                        </div>
                        <input type="submit" name="Submit" class="btn btn-info btn-block" value="Login">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br><br><br><br><br><br>

<!--MAIN AREA ENDS-->
<!--FOOTER STARTS-->
<div style="height: 5px; background: cornflowerblue"></div>
<footer class="footer-distributed" id="contact">
    <div class="footer-left">
        <h3>MindSaga <span id="year"></span></h3>
        <p class="footer-links">
            <a href="#" class="nav-link">About Us</a>
            ·
            <a href="index.php" class="nav-link">Blog</a>
            ·
            <a href="#" class="nav-link">Contact Us</a>
            ·
            <a href="#" class="nav-link">Features</a>
            .
        </p>
        <p class="footer-company-name">Made with 💕 by Webwiz</p>
    </div>

    <div class="footer-center">

        <div>
            <i class="fa fa-map-marker"></i>
            <p><span>Loremlaudantium assumenda</span> Odisha, India</p>
        </div>

        <div>
            <i class="fa fa-phone"></i>
            <p>random789</p>
        </div>

        <div>
            <i class="fa fa-envelope"></i>
            <p><a href="">webwiz.nitrkl@gmail.com</a></p>
        </div>

    </div>

    <div class="footer-right">

        <p class="footer-company-about">
            <span>About MindSaga</span>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magni expedita assumenda temporibus sapiente veritatis veniam
        </p>
        <ul class="social">
            <li>
                <a href="#" class="tw" title="Tweet this page!">
                    <i class="icon-twitter"></i>
                </a>
            </li>
            <li>
                <a href="#" class="fb" title="Share this page!">
                    <i class="icon-facebook"></i>
                </a>
            </li>
            <li>
                <a href="#" class="gp" title="Share this page!">
                    <i class="icon-google-plus"></i>
                </a>
            </li>
            <li>
                <a href="#" class="gh" title="Tweet this page!">
                    <i class="icon-github"></i>
                </a>
            </li>
            <li>
                <a href="#" class="insta" title="Tweet this page!">
                    <i class="icon-instagram"></i>
                </a>
            </li>
            <li>
                <a href="#" class="in" title="Tweet this page!">
                    <i class="icon-linkedin"></i>
                </a>
            </li>
        </ul>
    </div>
</footer>
<div style="height: 5px; background: cornflowerblue"></div>
<!----FOOTER ENDS---->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>
    $('#year').text(new Date().getFullYear());
</script>
</body>
</html>
