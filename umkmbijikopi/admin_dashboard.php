<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include "admin_header.php";
 
if(isset($_GET['admin_Home'])){
    if($_GET['admin_Home']==20){
        include "admin_katalog.php";
    }else if($_GET['admin_Home']==21){
        include "login.php";
    }else if($_GET['admin_Home']==22){
        include "manage.php";
    }else if($_GET['admin_Home']==23){
        include "pesanan.php";
    }else if($_GET['admin_Home']==24){
        include "admin_produk.php";
    }else if($_GET['admin_Home']==25){
        include "user_dashboard.php";
    }else if($_GET['admin_Home']==26){
        include "admin_tambah_produk.php";
    }else if($_GET['admin_Home']==27){
        include "admin_edit_produk.php";
    }else if($_GET['admin_Home']==28){
        include "admin_user_data.php";
    }else{
        echo "admin_Home";
    }
}else{
    include "admin_home.php";
}


include "admin_footer.php";

?>
