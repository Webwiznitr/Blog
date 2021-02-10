<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php $SearchQueryParameter = $_GET["id"];?>
<?php
//setting connection of name submit
if(isset($_POST["Submit"])) {
    $Name = $_POST["CommenterName"];
    $Email = $_POST["CommenterEmail"];
    $Comment = $_POST["CommenterThoughts"];
    date_default_timezone_set("Asia/Kolkata");
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%Y %H: %M: %S", $CurrentTime);

    if (empty($Name)||empty($Email)||empty($Comment)){
        $_SESSION["ErrorMessage"] = "All fields must be filled out";
        Redirect_to("FullPost.php?id=$SearchQueryParameter");
    } elseif (strlen($Comment)>500) {
        $_SESSION["ErrorMessage"] = "comment length should be less than 500 character";
        Redirect_to("FullPost.php?id=$SearchQueryParameter");
    } else{
        //Query to insert comment in database when everything is good
        global $ConnectingDB;
        $sql = "INSERT INTO comments(datetime,name,email,comment,approvedby,status,post_id)VALUES(:datetime,:name ,:email,:comment,'Pending','OFF',:postIdFromURL)";
        $stmt = $ConnectingDB->prepare($sql);

        //binding the values

        $stmt->bindValue(':datetime', $DateTime);
        $stmt->bindValue(':name', $Name);
        $stmt->bindValue(':email', $Email);
        $stmt->bindValue(':comment', $Comment);
        $stmt->bindValue(':postIdFromURL', $SearchQueryParameter);
        $Execute = $stmt->execute();


        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Comment submitted Successfully";
            Redirect_to("FullPost.php?id=$SearchQueryParameter");
        } else {
            $_SESSION["ErrorMessage"] = "something went wrong... Try Again !";
            Redirect_to("FullPost.php?id=$SearchQueryParameter");
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
    <title>Full Post</title>
    <style media="screen">
        .heading{
            font-family: Bitter,Georgia,"Times New Roman",Times,serif;
            font-weight: bold;
            color: #005E90;
        }
        .heading:hover{
            color: #0090DB;
        }
    </style>
</head>
<body>
<!--NAVIGATION BAR STARTS-->
<div class="navbar navbar-expand-lg navbar-light bg-custom">
    <div class="container-fluid">
        <a href="#" class="navbar-brand " style= "color:aliceblue;">MindSaga</a>
        <button style="background-color: #BEC9F2;" class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#Rcollapse">
            <span class="navbar-toggle-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="Rcollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="index.php?page=1" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">About Us</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=1" class="nav-link">Blog</a>
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
<!--NAVIGATION BAR ENDS-->

<!--HEADER STARTS-->
<div class="container">
    <div class="row mt-4">

        <!--main area starts---->

        <div class="col-sm-8 mt-4">
            <?php
            echo ErrorMessage();
            echo SuccessMessage();
            ?>

            <?php
            $ConnectingDB;
            if(isset($_GET["SearchButton"])){
                $Search = $_GET["Search"];
                $sql="SELECT * FROM posts 
                WHERE datetime LIKE :Search
                OR title LIKE :Search
                OR category LIKE :Search 
                OR post LIKE :Search";
                $stmt = $ConnectingDB->prepare($sql);
                $stmt->bindvalue(':Search','%'.$Search.'%');
                $stmt->execute();
            }

            else{
                $PostIdFromURL = $_GET["id"];
                if(!isset($PostIdFromURL)){
                    $_SESSION["ErrorMessage"]="Bad Request !";
                    Redirect_to("index.php");
                }
                $sql = "SELECT * FROM posts WHERE id= '$PostIdFromURL'";
                $stmt = $ConnectingDB->query($sql);
            }
            while ($DataRows = $stmt->fetch()){
                $PostId = $DataRows["id"];
                $DateTime = $DataRows["datetime"];
                $PostTitle = $DataRows["title"];
                $Category  = $DataRows["category"];
                $Admin = $DataRows["author"];
                $Image = $DataRows["image"];
                $PostDescription = $DataRows["post"];

                ?>
                <div class="card">
                    <img src="Uploads/<?php echo htmlentities($Image); ?>" style="max-height: 500px;" class="img-fluid card-img-top"/>
                    <div class="card-body">
                        <h4 class="card-title"><?php echo htmlentities($PostTitle)?></h4>
                        <small class="text-muted">Written by <?php echo htmlentities($Admin);?> on <?php echo htmlentities($DateTime); ?></small>

                        <hr>
                        <p class="card-text">
                            <?php  echo nl2br($PostDescription) ?>
                        </p>

                    </div>
                </div>

            <?php } ?>
            <br>
            <br>
                   <!--starting of comment part.-->
                       <!--fetching existing comments from database-->
                       <span class="fieldinfo">Comments</span>
                       <br><br>
                       <?php
                       global $ConnectingDB;
                       $sql ="SELECT * FROM comments WHERE post_id='$SearchQueryParameter' AND status='ON'";
                       $stmt =$ConnectingDB->query($sql);
                       while ($DataRows = $stmt->fetch()){
                           $CommentDate = $DataRows['datetime'];
                           $CommenterName = $DataRows['name'];
                           $CommentContent = $DataRows['comment'];

                       ?>
            <div>
                <div class="media CommentBackground">
                    <img class="d-block img-fluid align-self-center" src="images/comment.png" alt="">
                    <div class="media-body ml-2 ">
                        <h6 class="lead"><?php echo $CommenterName; ?></h6>
                        <p class="small"><?php echo $CommentDate; ?></p>
                        <p><?php echo $CommentContent; ?></p>
                    </div>
                </div>
            </div>
                            <hr>
            <?php } ?>
                       <!--ends of fetching commenting parts-->

            <div >
               <form class="" action="FullPost.php?id=<?php echo $SearchQueryParameter ?>" method="post">
                   <div class="card mb-3">
                       <div class="card-header">
                           <h5 class="Fieldinfo">Want to share something with this post we are here for you</h5>
                       </div>
                       <div class="card-body">
                           <div class="form-group">
                               <div class="input-group">
                                   <div class="input-group-prepend">
                                       <span class="input-group-text"><i class="fas fa-user"></i></span>
                                   </div>
                                   <input class="form-control" type="text" name="CommenterName" placeholder="want your name" value="">
                               </div>
                           </div>
                           <div class="form-group">
                               <div class="input-group">
                                   <div class="input-group-prepend">
                                       <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                   </div>
                                   <input class="form-control" type="email" name="CommenterEmail" placeholder="want your Email" value="">
                               </div>
                           </div>
                           <div class="form-group">
                               <textarea name="CommenterThoughts" class="form-control" cols="800" rows="6"></textarea>
                           </div>
                           <div class="">
                               <button type="submit" name="Submit" class="btn btn-primary">Submit</button>
                           </div>
                       </div>
                   </div>
               </form>
            </div>
        </div>
        <?php require_once ("footer.php");?>



