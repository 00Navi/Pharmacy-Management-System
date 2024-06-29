<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'pharmacylogin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$stmt = $con->prepare('SELECT * FROM SUPPLIER');
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>View Supplier</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Pharmacy Management System</h1>
				<a href="admin.php"><i class="fas fa-user-circle"></i>Home</a>
				<a href="addsupplier.php"><i class="fas fa-location-arrow"></i>Add Supplier</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Supplier Details</h2>
			<div>
				<table>
					<tr>
						<th>SUPPLIER_ID</th>
						<th>SUPPLIER_NAME</th>
                        <th>SUPPLIER_GENDER</th>
						<th>SUPPLIER_EMAIL</th>
						<th>SUPPLIER_PHNO</th>
                        <th>SUPPLIER_ADDRESS</th>
                        <th>SUPPLIER_CITY</th>
                        <th>SUPPLIER_STATE</th>
					</tr>
<?php
while($data = $result->fetch_assoc()) {
?>
					<tr>
						<td><?=$data['SUPPLIER_ID']?></td>
						<td><?=$data['SUPPLIER_NAME']?></td>
                        <td><?=$data['SUPPLIER_GENDER']?></td>
						<td><?=$data['SUPPLIER_EMAIL']?></td>
						<td><?=$data['SUPPLIER_PHNO']?></td>
						<td><?=$data['SUPPLIER_ADDRESS']?></td>
                        <td><?=$data['SUPPLIER_CITY']?></td>
                        <td><?=$data['SUPPLIER_STATE']?></td>
					</tr>
<?php
}
$stmt->close();
?>
				</table>
			</div>
		</div>
	</body>
</html>