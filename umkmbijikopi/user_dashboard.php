<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("login.php");
    exit;
}
include "user_header.php";
 
if(isset($_GET['user_Home'])){
    if($_GET['user_Home']==11){
        include "user_katalog.php";
    }else if($_GET['user_Home']==12){
        include "login.php";
    }else if($_GET['user_Home']==13){
        include "pesanan.php";
    }else if($_GET['user_Home']==14){
        include "checkout.php";
    }else if($_GET['user_Home']==15){
        include "user_dashboard.php";
    }else if($_GET['user_Home']==16){
        include "admin_dashboard.php";
    }else if($_GET['user_Home']==17){
        include "tentang_kami.php";
    
    }else{
        echo "Home";
    }
}else{
    include "user_home.php";
}


include "user_footer.php";

?>


