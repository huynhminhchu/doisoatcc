<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
};
</style>
</head>
<body>

<form method ="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
	<label for="start">Start month:</label>
	<input type="month" id="start" name="start" min="2020-12" value="2020-12">
	<input type="submit" name="submit" value="Submit"> 
</form>



<?php 

echo "Goodbye World!";
echo "<br>";
$select_month = $_POST["start"];
$user = 'test';
$password = 'test@123';
$dbname = 'testdb';
$servername = 'mariadb';
$mysqli = new mysqli($servername, $user, $password,$dbname);


if ($mysqli->connect_error){
  die('Connection error: ' . $mysqli->connect_error);
}
echo "Current year-month:";
echo $select_month . "<br>";
$sql = "SELECT * FROM Data WHERE concat(year(date),'-',month(date)) = '" . $select_month . "'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  echo "<table>
    <tr>
      <th>Date</th>
      <th>Total call momo-tpcom</th>
      <th>Total call tpcom</th>
      <th>Rate_lech</th>
      <th>Total duration momo-tpcom</th>
      <th>Total duration tpcom</th>
      <th>Rate_lech_duration</th>
    </tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr>
      <td>" . $row['date']. "</td>
      <td>" . $row['momo_tpcom_total']. "</td>
      <td>" . $row['tpcom_total']. "</td>
      <td>"  . $row['rate_chenh_lech_call']. "</td>
      <td>"  . $row['momo_tpcom_duration']. "</td>
      <td>"  . $row['tpcom_duration']. "</td>
      <td>"  . $row['rate_chenh_lech_duration']. "</td>
    </tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
$mysqli->close();
?>
</body>
</html>
