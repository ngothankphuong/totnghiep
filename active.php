<?php
  
    // Connect to database 
    include 'connection.php';
	
	date_default_timezone_set('Asia/Ho_Chi_Minh');
  
    // Check if id is set or not if true toggle,
    // else simply go back to the page
    if (isset($_GET['id'])){
  
        // Store the value from get to a 
        // local variable "course_id"
        $course_id=$_GET['id'];
  
        // SQL query that sets the status
        // to 1 to indicate activation.
        $sql="UPDATE camnghi SET SHOWED = 1 WHERE id=" . $course_id;
  
        // Execute the query
        mysqli_query($conn,$sql);
    }
  
    // Go back to course-page.php
    header('location: administrator.php');
?>