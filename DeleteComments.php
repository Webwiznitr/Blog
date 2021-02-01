<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php Confirm_Login(); ?>
<?php
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login(); ?>
<?php
if(isset($_GET["id"])){
    $SearchQueryParameter = $_GET["id"];
    global $ConnectingDB;
    $Admin =  $_SESSION["AdminName"];
    $sql = "DELETE FROM comments  WHERE id='$SearchQueryParameter'";
    $Execute = $ConnectingDB->query($sql);
    if($Execute){
        $_SESSION["SuccessMessage"]="Comment Deleted Successfully ! ";
        Redirect_to("Comments.php");
    }else{
        $_SESSION["ErrorMessage"]="Something went wrong.Try Again !";
        Redirect_to("Comments.php");
    }
}
?>