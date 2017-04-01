<!DOCTYPE html>
<html>
<head>
	<title>Hedge Fund Management System</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="./js/widgEditor.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/login.css" rel="stylesheet">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="./css/style.css">

	<style type="text/css" media="all">
		@import "css/main.css";
		@import "css/widgEditor.css";
		table {
		    font-family: arial, sans-serif;
		    width: 100%; /*most left to right*/
		}

		td, th {
		    border: 1px solid #dddddd;
		    text-align: left;
		    padding: 6px;
		}

		tr:nth-child(even) {
		    background-color: #dddddd;
		}
	</style>
</head>

<body>
	<div id="header">
		<div id="top_area">
			<div id="logo_bar">Hedge Fund Management System for Client</div>
		</div>
	</div>
	<br>
	<br>

<?php
require_once('./db_setup.php');
$sql = "USE gluo3;";
if ($conn->query($sql) === TRUE) {
   // echo "using Database gluo3";
} else {
   echo "Using gluo3 database error: " . $conn->error;
}

// Query:
$username = $_POST['username'];
$password = $_POST['password'];
$user_type = $_POST['user_type'];
$sql = "SELECT * FROM User where user_name = $user_name;";

$result = $conn->query($sql);
$res = $result->fetch_assoc();

if($result->num_rows == 1){
	if($res['password'] != $password){
		echo "Wrong Password";
		// return to homepage
	} else if($user_type == "client"){
?>
   <table class="table table-striped">
      <tr>
		<th>Client Name</th>
		<th>Manager ID</th>
		<th>Management Fees</th>
		<th>Performance Fees</th>
		<th>Stock %</th>
		<th>Bond %</th>
		<th>Value Under Management</th>
		<th>Cash Amount</th>
      </tr>
<?php
$user_id = $res['user_id'];
$sql2 = "SELECT Portfolio.client_id, Portfolio.manager_id, Portfolio.management_fee, Portfolio.performance_fee, Portfolio.value, Portfolio.cash_amount
FROM Portfolio WHERE Portfolio.client_id = $user_id;";
$result2 = $conn->query($sql2);
$res2 = $result2->fetch_assoc()
?>
      <tr>
          <td><?php echo $res2['client_id']?></td>
          <td><?php echo $res2['manager_id']?></td>
          <td><?php echo $res2['management_fee']?></td>
          <td><?php echo $res2['performance_fee']?></td>
          <td><?php echo $res2['value']?></td>
          <td><?php echo $res2['cash_amount']?></td>
      </tr>

<?php
} else {
	// manager page
}
}
}
else {
echo "Cannot find the user name";
// back to homepage
}
?>

    </table>

<?php
$conn->close();
?>  

</body>
</html>
