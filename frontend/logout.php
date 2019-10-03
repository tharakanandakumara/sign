<?php
if(isset($_GET['logout'])){
if(isset($_SESSION['token']) && $_GET['logout'] == 1){
    $_SESSION['token']=null;
    header("location:login.html");
}
}
?>