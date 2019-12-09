<?php


$conn = mysqli_connect("ix-dev.cs.uoregon.edu", "jackson", "password", "stores7", "3747")
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>Jackson's HW4</title>
  </head>
  
  <body bgcolor="white">
  
  
  <hr>

<?php
  
$manufact = $_POST['manufact'];

$manufact = mysqli_real_escape_string($conn, $manufact);

$query = "SELECT DISTINCT c.fname, c.lname, s.description 
	from orders as o left join customer as c on o.customer_num = c.customer_num left join items as i on o.order_num = i.order_num left join manufact as m on i.manu_code = m.manu_code left join stock as s on i.stock_num = s.stock_num
where m.manu_name = ";
$query = $query."'".$manufact."' ORDER BY 2;";

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
		          print "$row[0]  $row[1] $row[2]";
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
