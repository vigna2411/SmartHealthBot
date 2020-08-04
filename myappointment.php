<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
<title>Table with database</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script>
var d=sessionStorage.getItem('Doctor');
var h=sessionStorage.getItem('Hospital');
document.cookie=h;
document.cookie=d;
</script>
<style>
table {
border-collapse: collapse;
width: 100%;
color: #588c7e;
font-family: monospace;
font-size: 25px;
text-align: left;
}
th {
background-color: #588c7e;
color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}
</style>
</head>
<body>

<a href="chat.php" class="btn btn-primary btn-lg" style="float:right;margin:2%">Go Back</a>
<h1><center>Appointments</center></h1>
<table>
<tr>
<th>Name</th>

<th>Email</th>

<th>Hospital</th>
<th>Timeslot</th>
<th>Date</th>

</tr>

<?php
 $conn = mysqli_connect("localhost", "root", "", "bookingcalendar");
// Check connection
$jay=$_SESSION['email_id'];
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM bookings WHERE email='$jay'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<td>" . $row["name"]. "</td><td>" . $row["email"] . "</td><td>"
. $row["hospital_doctor"]. "</td><td>" . $row["timeslot"] . "</td><td>" . $row["date"] . "</td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
</table>
</body>
</html>