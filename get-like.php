<?php 
include('includes/config.php');

$postid=$_GET["q"];
$uid=$_GET["uid"];

//echo $postid ." - " .$uid;

if( $uid!="undefined" ){
    $qur=mysqli_query($con,"INSERT INTO postlike(uid, pid, date, time, status) VALUES ('$uid','$postid','$datenow','$timenow','active')");
    
    echo '
    <button class="btn-primary btn-xs" style="color:white;" readonly >
        <i class="fa fa-thumbs-up" style="color:green;"></i> Liked
    </button> | <button class="btn-primary btn-xs" onclick="share()" ><i class="fa fa-share"></i> Share</button>';
    
}
else{
    echo '<a href="https://thelivemodels.com/register.php">Create Account For Like This Post</a>';
}


?>