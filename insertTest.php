<?php


$conn = mysqli_connect("ix-dev.cs.uoregon.edu", "jackson", "password", "TrackProject", "3747")
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>Track Testing Final Project</title>
  </head>
  
  <body bgcolor="white">
  
  
  <hr>

<?php
  
$iID = $_POST['iID'];
$iResult = $_POST['iResult'];
$iSessionID = $_POST['iSessionID'];
$iSSN = $_POST['iSSN'];
$iType = $_POST['iType'];

$iID = mysqli_real_escape_string($conn, $iID);
$iResult = mysqli_real_escape_string($conn, $iResult);
$iSessionID = mysqli_real_escape_string($conn, $iSessionID);
$iSSN = mysqli_real_escape_string($conn, $iSSN);
$iType = mysqli_real_escape_string($conn, $iType);

$query = "INSERT INTO tests (testID, result, test_sessionID, athlete_ssn, test_type) VALUES (";
$query = $query.$iID.", '".$iResult."', ".$iSessionID.", '".$iSSN."', '".$iType."');";

?>

<p>
The query:
<p>
<?php
print $query;
?>

<hr>
<p>
Result of query (if it's anything other than an error, then its a success):
<p>
<?php
$result = mysqli_query($conn, $query)
or die(mysqli_error($conn));
print "<pre>";
print $result;
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>

<p>
<hr>

<p>
<a href="insertTest.txt" >Contents</a>
of the PHP program that created this page. 	 
 <a href="TrackTestingLookup.html" >Go back to the Home Page</a> 
</body>
</html>
