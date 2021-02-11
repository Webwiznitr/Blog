<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/7f6ee3d237.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <title>Mind Saga</title>
    <style>
        .heading{
            font-family: Bitter,Georgia,"Times New Roman",Times,serif;
            font-weight: bold;
            color: blue;
        }
    </style>
</head>
<body>
<!--NAVIGATION BAR STARTS-->
<div class="navbar navbar-expand-lg navbar-light bg-custom">
    <div class="container-fluid">
        <a href="#" class="navbar-brand " style= "color:aliceblue; font-family: mindsagacustom;">MindSaga</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#NavbarContent" aria-controls="NavbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
<!--        CONTENT WHEN NAVBAR IS COLLAPSE-->
        <div class="collapse navbar-collapse" id="NavbarContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="index.php" class="nav-link active" style= "color:white ; font-weight: bolder; ">Home</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link " style= "color:white ; font-weight: bolder; ">About Us</a>
                </li>
                <li class="nav-item">
                    <a href="index.php" class="nav-link " style= "color:white ; font-weight: bolder; ">Blog</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link " style= "color:white ; font-weight: bolder; " >Contact Us</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" style= "color:white ; font-weight: bolder; ">Features</a>
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
<!--NAVIGATION BAR ends-->

<!--HEADER STARTS-->
<div class="container-fluid">
    <div class="row mt-5">
            <!--main area starts---->
        <div class="col-sm-8">
            <?php
            global $ConnectingDB;
             //sql query when search button is active
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

            }//Query when pagination is active
            elseif (isset($_GET["page"])){
                $Page = $_GET["page"];
                if($Page==0||$Page<1){
                    $ShowPostFrom=0;
                }else {
                    $ShowPostFrom = ($Page * 5) - 5;
                }
                $sql = "SELECT * FROM posts ORDER BY id desc LIMIT $ShowPostFrom,5";
                $stmt = $ConnectingDB->query($sql);
            }
//            query when category is active in URL tab
            elseif(isset($_GET["category"])){
                $Category = $_GET["category"];
                $sql = "SELECT * FROM posts  WHERE category='$Category' ORDER BY id desc";
                $stmt = $ConnectingDB->query($sql);
            }
              //the default SQL query
            else{
                $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,4";
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
                <div class="col-sm-6 mb-2 test">
                   <div class="card h-100" style="border-radius: 2rem; box-shadow: 4px 11px 7px -2px skyblue;  margin: 0 auto; float: none;">
                     <img src="Uploads/<?php echo htmlentities($Image); ?>" style="max-height: 350px;" class="img-fluid card-img-top"/>
                      <div class="card-body">
                         <h4 class="card-title"><?php echo htmlentities($PostTitle)?></h4>
                         <small class="text-muted">Category: <span class="text-dark"> <a href="index.php?category=<?php echo htmlentities($Category); ?>"> <?php echo htmlentities($Category); ?> </a></span> & Written by <span class="text-muted"> <a href="Profile.php?username=<?php echo htmlentities($Admin); ?>"> <?php echo htmlentities($Admin); ?></a></span> On <span class="text-muted"><?php echo htmlentities($DateTime); ?></span></small>
                         <span style="float: right" class="badge badge-dark text-light px-3 py-2 mt-2">Comments
                                <?php echo ApproveCommentsAccordingtoPost($PostId);?>
                         </span>
                         <hr>
                         <p class="card-text px-4">
                             <?php if (strlen($PostDescription)>150){$PostDescription = substr($PostDescription,0,150).'...';} echo htmlentities($PostDescription) ?>
                         </p>
                         <a href="FullPost.php?id=<?php echo $PostId; ?>" style="float: right" class="px-2 py-2">
                              <span class="btn btn-sm btn-info px-1" style="float: right;"> Read More >></span>
                         </a>
                     </div>
                  </div>
                </div>
            <?php } ?>

            <!--pagination-->
             <nav>
                 <ul class="pagination pagination-lg">
<!--                     backward button-->
                     <?php
                     if(isset($Page)){
                         if($Page>1){

                             ?>
                             <li class="page-item">
                                 <a href="index.php?page=<?php echo $Page-1; ?>" class="page-link">&laquo;</a>
                             </li>
                         <?php } }?>
                    <?php
                      global $ConnectingDB;
                      $sql = "SELECT COUNT(*) FROM posts";
                      $stmt = $ConnectingDB->query($sql);
                      $RowPagination=$stmt->fetch();
                      $TotalPosts=array_shift($RowPagination);
                               //echo $TotalPosts."<br>";
                      $PostPagination=$TotalPosts/5;
                      $PostPagination=ceil($PostPagination);
                              // echo $PostPagination;
                       for ($i=1; $i<=$PostPagination ; $i++){
                          if(isset($Page)){
                             if($i==$Page){
                    ?>
                                  <li class="page-item active">
                                       <a href="index.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                                  </li>

                                  <?php
                                     }else{
                                  ?>

                                 <li class="page-item">
                                       <a href="index.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                                 </li>
                                 <?php
                                      } } }
                                 ?>
<!--                       forward button-->
                     <?php
                     if(isset($Page)&&!empty($Page)){
                          if($Page+1<=$PostPagination){

                     ?>
                     <li class="page-item">
                         <a href="index.php?page=<?php echo $Page+1; ?>" class="page-link">&raquo;</a>
                     </li>
                     <?php } }?>
                </ul>
            </nav>
        </div>
<!--        side area and footer-->
        <?php require_once ("footer.php");?>

