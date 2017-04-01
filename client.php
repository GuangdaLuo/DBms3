<!DOCTYPE html>
<html>
<head>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>

<?php
require_once('./db_setup.php');
$sql = "USE gluo3;";
if ($conn->query($sql) === TRUE) {
   // echo "using Database gluo3";
} else {
   echo "Using gluo3 database error: " . $conn->error;
}

// Query:
$user_id = $_POST['user_id']; // ???
$sql = "SELECT User.user_name,  FROM User where user_id = $user_id;";
#$sql = "SELECT * FROM Students where Username like 'amai2';";

$result = $conn->query($sql);

if($result->num_rows > 0){
 
//$stmt = $conn->prepare("Select * from Students Where Username like ?");
//$stmt->bind_param("s", $username);
//$result = $stmt->execute();
//$result = $conn->query($sql);
?>
   <table class="table table-striped">
      <tr>
         <th>User ID</th>
         <th>Rating</th>
         <th>Location</th>
         <th>Country</th>
      </tr>
<?php
while($row = $result->fetch_assoc()){
?>
      <tr>
          <td><?php echo $row['userID']?></td>
          <td><?php echo $row['rating']?></td>
          <td><?php echo $row['location']?></td>
          <td><?php echo $row['country']?></td>
      </tr>

<?php
}
}
else {
echo "User information not found!";
}
?>

    </table>

<?php
$conn->close();
?>  

</body>
</html>
