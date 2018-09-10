<!DOCTYPE html>
<html lang="en">
<link href="css/style2.css" rel="stylesheet">
</head>

<body>
  <table>
  <thead>
	<tr>
      <th>Name</th>
      <th>Age</th>
      <th>Country</th>
	  <th>Attacking</th>
      <th>Defending</th>
      <th>Technical</th>
	  <th>Mental</th>
      <th>Player Id</th>
      <th>Speed</th>
	  <th>Physical</th>
      <th>Team Id</th>
    </tr>
  </thead>
  
  <?php 
			print "<tbody>";
			$conn=oci_connect("OracleID","Password","oracle.cise.ufl.edu/orcl");
			If (!$conn)
				echo 'Failed to connect to Oracle';
			else
				#echo 'Succesfully connected with Oracle DB';
	
		if ( isset( $_POST['submit'] ) ) {
		
		#$result=mysqli_query($conn,"SELECT * FROM books ORDER BY lid ASC;");
		$P1= $_POST['pid1'];
		$P2= $_POST['pid2'];
		$stid = oci_parse($conn,"SELECT * FROM PLAYER WHERE PLAYERID IN (SELECT PLAYERCOMPARE($P1,$P2) FROM DUAL)");
		oci_execute($stid);
		$flag=0;
		while($row = oci_fetch_array($stid,OCI_BOTH))
		{  //if a table is returned, display the table 
          	print "<table border=1>";
                 #$row2 = oci_fetch_array($stid,OCI_NUM);
                 print "<tr>";
                 for($j=0;$j<count($row)-11;$j++)
                    print "<td><strong>$row[$j]</strong></td>";
                 print "</tr>";
			$flag=1;
		} 
	}
	print "</tbody>";
				
?>
  
</table>
</body>
</html>
