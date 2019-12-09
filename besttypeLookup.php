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
  
$aType = $_POST['aType'];

$aType = mysqli_real_escape_string($conn, $aType);

$query = "select table1.test_type, table1.result, fname, lname, team_name, athlete_type, type_events from(
	select MIN(cast(result as DECIMAL(10,2))) as result, test_type from tests left join athletes on athlete_ssn = ssn  where athlete_type =  '";
$query = $query.$aType."' and 
( test_type = '100M' OR  test_type = '60M' OR  test_type = '400M' )
GROUP BY test_type 
UNION
select MAX(cast(result as unsigned)), test_type from tests left join athletes on athlete_ssn = ssn  where athlete_type = '".$aType."' and 
( test_type = 'CLEAN' OR  test_type = 'SQUAT' OR  test_type = 'VERTICAL' or test_type = 'BROAD')
GROUP BY test_type
) as table1 left join 
(
select atype.athlete_type, atype.type_events, a.fname, a.lname, tea.team_name, t.test_type, t.result
from tests as t left join athletes as a on a.ssn = t.athlete_ssn left join teams as tea on a.team_code = tea.team_code left join athlete_type as atype on atype.athlete_type = a.athlete_type
) as table2 on table1.result = table2.result and table1.test_type = table2.test_type
where athlete_type = '".$aType."';";

?>

<p>
The gross query:
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
					      		          print "Test: $row[0]       Result: $row[1]         Name: $row[2] $row[3]   Team: $row[4]     AthleteType: $row[5]       Events Included: $row[6]";
					      		        }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>

<p>
<hr>

<p>
<a href="besttypeLookup.txt" >Contents</a>
of the PHP program that created this page. 	 
 <a href="TrackTestingLookup.html" >Go back to the Home Page</a> 
</body>
</html>
