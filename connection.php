<?php
	/* $servername = '10.1.64.12';
	$username = "root";
	$password = "ctump@cusc";
	$dbname = "totnghiep"; ..*/
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "totnghiep";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	mysqli_set_charset($conn,'UTF8');
?>