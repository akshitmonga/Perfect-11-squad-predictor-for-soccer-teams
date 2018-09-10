<!DOCTYPE html>
<html lang="en">
<link href="css/style2.css" rel="stylesheet">
</head>

<body>
  <table>
  <thead>
	<tr>
      <th>Player ID</th>
      <th>Player Name</th>
      <th>Age</th>
	  <th>Country</th>
      <th>Overall</th>
      <th>Team Id</th>
	  <th>Manager Name</th>
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
		$M= $_POST['manager'];
		$stid = oci_parse($conn,"SELECT TEAM.NAME,TEAM.TEAMID FROM TEAM,DUMMY WHERE TEAM.TEAMID = DUMMY.TEAMID AND ROWNUM<100 ORDER BY DUMMY.OVERALL DESC");
		oci_execute($stid);
		$flag=0;
		while($row = oci_fetch_array($stid,OCI_BOTH))
		{  //if a table is returned, display the table 
          	print "<table border=1>";
                 #$row2 = oci_fetch_array($stid,OCI_NUM);
                 print "<tr>";
                 for($j=0;$j<count($row)-3;$j++)
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
