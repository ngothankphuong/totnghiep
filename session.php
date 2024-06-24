<?php
   include('connection.php');
   session_start();
   
   if(!isset($_SESSION['login_userid'])){
      header("location:login.php");
      die();
   }
   
   $user_check = $_SESSION['login_userid'];
   
   $ses_sql = mysqli_query($conn,"select USERID, USERNAME from users where USERID = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['USERID'];
   $login_name = $row['USERNAME'];
   
?>