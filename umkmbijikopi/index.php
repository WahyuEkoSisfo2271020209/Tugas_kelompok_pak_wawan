<?php 
include "header.php";
 
//Isi atau Content 
//http://localhost/lat3/index.php
//http://localhost/lat3/index.php?menu=1
if(isset($_GET['Home'])){
    if($_GET['Home']==1){
        include "katalog.php";
    }else if($_GET['Home']==2){
        include "login.php";
    }else if($_GET['Home']==3){
        include "register.php";
    }else if($_GET['Home']==6){
        include "user_dashboard.php";
    }else if($_GET['Home']==7){
        include "admin_dashboard.php";
    }else{
        echo "Home";
    }
}else{
    include "home.php";
}


include "footer.php";

?>


    
