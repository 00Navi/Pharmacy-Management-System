<?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'pharmacylogin';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$insertion_status = "NONE";
if (isset($_POST['CUSTOMER_NAME'])) {
    $sql = "INSERT INTO CUSTOMER VALUES (NULL, ?, ?, ?, ?)";
	if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param('ssss',$_POST['CUSTOMER_NAME'],$_POST['CUSTOMER_EMAIL'],$_POST['CUSTOMER_PHNO'],$_POST['CUSTOMER_GENDER']);
        $result = $stmt->execute();
        if ($result) {
            $insertion_status = "SUCCESS";
        } else {
            $insertion_status = "FAIL";
        }
		$stmt->close();
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Add Customer</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
        <nav class="navtop">
			<div>
				<h1>Pharmacy Management System</h1>
				<a href="admin.php"><i class="fas fa-user-circle"></i>Home</a>
				<a href="viewcustomer.php"><i class="fas fa-location-arrow"></i>View Customer</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="login">
			<h1>Add Customer</h1>
			<form action="addcustomer.php" method="post">
                <label for="CUSTOMER_NAME">Name</label>
                <input type="text" name="CUSTOMER_NAME" placeholder="CUSTOMER_NAME" id="CUSTOMER_NAME" required>
                <label for="CUSTOMER_EMAIL">Email</label>
                <input type="email" name="CUSTOMER_EMAIL" placeholder="CUSTOMER_EMAIL" id="CUSTOMER_EMAIL" required>
                <label for="CUSTOMER_PHNO">Phone</label>
                <input type="text" name="CUSTOMER_PHNO" placeholder="CUSTOMER_PHNO" id="CUSTOMER_PHNO" required>
                <label for="CUSTOMER_GENDER">Gender</label>
                <input type="text" name="CUSTOMER_GENDER" placeholder="CUSTOMER_GENDER" id="CUSTOMER_GENDER" required>
            
                <input type="submit" value="Submit">
			</form>
        </div>
<?php
if ($insertion_status == "SUCCESS") {
?>
    echo '<script>alert("Added Successfully")</script>';
<?php
} else if ($insertion_status == "FAIL") {
?>
        echo '<script>alert("Failed")</script>';
<?php
}
?>
	</body>
</html>



