<?php
/* Database connection settings */
	$servername = "localhost";
    $username = "root";		//put your phpmyadmin username.(default is "root")
    $password = "";			//if your phpmyadmin has a password put it here.(default is "root")
    $dbname = "biometric_attendance_system";
    $dbname2 = "teachers_attendance_system";

	$conn = mysqli_connect($servername, $username, $password, $dbname, $dbname2);
    $conn = mysqli_connect('localhost', 'root', 'password', 'biometric_attendance_system','teachers_attendance_system');

	if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }
?>//
<?php
/* Database connection settings */
	/*$servername = "yourHostname.com";
    $username = "yourUsername";		//put your MySQL username.
    $password = "yourPassword";			//if your MySQL user account has a password put it here.
    $dbname = "yourDatabaseName";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }
?>*/