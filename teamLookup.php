<?php


$conn = mysqli_connect("ix-dev.cs.uoregon.edu", "jackson", "password", "TrackProject", "3747")
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>Team Lookup</title>
  </head>
  
  <body bgcolor="white">
  
  
  <hr>

<?php
  
$teamName = $_POST['teamName'];

$teamName = mysqli_real_escape_string($conn, $teamName);

$query = "SELECT t.team_name, l.location_name, l.city, count(a.ssn) from teams as t left join locations as l on t.location_code = l.location_code right join athletes as a on a.team_code = t.team_code where t.team_name =";
$query = $query."'".$teamName;."' group by t.team_code;";

?>

<p>
The query:
<p>
<?php
print $query;
?>

<hr>
<p>
Result of query:
<p>
<?php
$result = mysqli_query($conn, $query)
	or die(mysqli_error($conn));
print "<pre>";
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
		  {
			  		      print "\n";
					      		          print "Name: $row[0] Location: $row[1] City: $row[2] #Athletes: $row[3]";
					      		        }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>

<p>
<hr>

<p>
<a href="manuFactLookupphp.txt" >Contents</a>
of the PHP program that created this page. 	 
 
</body>
</html>
