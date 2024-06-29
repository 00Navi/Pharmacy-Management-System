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
if (isset($_POST['SUPPLIER_NAME'])) {
    $sql = "INSERT INTO SUPPLIER VALUES (NULL, ?, ?, ?, ? , ?, ?, ?)";
	if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param('sssssss',$_POST['SUPPLIER_NAME'],$_POST['SUPPLIER_GENDER'],$_POST['SUPPLIER_EMAIL'],$_POST['SUPPLIER_PHNO'],$_POST['SUPPLIER_ADDRESS'],$_POST['SUPPLIER_CITY'],$_POST['SUPPLIER_STATE']);
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
		<title>Add Supplier</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
        <nav class="navtop">
			<div>
				<h1>Pharmacy Management System</h1>
				<a href="admin.php"><i class="fas fa-user-circle"></i>Home</a>
				<a href="viewsupplier.php"><i class="fas fa-location-arrow"></i>View Supplier</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="login">
			<h1>Add Supplier</h1>
			<form action="addsupplier.php" method="post">
                <label for="SUPPLIER_NAME">Name</label>
                <input type="text" name="SUPPLIER_NAME" placeholder="SUPPLIER_NAME" id="SUPPLIER_NAME" required>
                <label for="CUSTOMER_GENDER">Gender</label>
                <input type="text" name="SUPPLIER_GENDER" placeholder="SUPPLIER_GENDER" id="SUPPLIER_GENDER" required>
                <label for="SUPPLIER_EMAIL">Email</label>
                <input type="email" name="SUPPLIER_EMAIL" placeholder="SUPPLIER_EMAIL" id="SUPPLIER_EMAIL" required>
                <label for="SUPPLIER_PHNO">Phone</label>
                <input type="text" name="SUPPLIER_PHNO" placeholder="SUPPLIER_PHNO" id="SUPPLIER_PHNO" required>
                <label for="SUPPLIER_ADDRESS">ADDRESS</label>
                <input type="text" name="SUPPLIER_ADDRESS" placeholder="SUPPLIER_ADDRESS" id="SUPPLIER_ADDRESS" required>
                <label for="SUPPLIER_CITY">CITY</label>
                <input type="text" name="SUPPLIER_CITY" placeholder="SUPPLIER_CITY" id="SUPPLIER_CITY" required>
                <label for="SUPPLIER_STATE">STATE</label>
                <input type="text" name="SUPPLIER_STATE" placeholder="SUPPLIER_STATE" id="SUPPLIER_STATE" required>
                
            
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



