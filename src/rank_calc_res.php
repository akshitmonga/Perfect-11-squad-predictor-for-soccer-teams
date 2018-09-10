<!DOCTYPE html>
<html lang="en">
<link href="css/style2.css" rel="stylesheet">
</head>

<body>
  <table>
  <thead>
	<tr>
      <th>Player ID</th>
      <th>Name</th>
      <th>Age</th>
	  <th>Salary</th>
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
		$M1= $_POST['manager'];
		$stid = oci_parse($conn,"SELECT ROWNUM AS RANK, NAME, AGE, SALARY FROM 
(SELECT P.NAME, P.AGE, S.SALARY FROM PLAYER P , PLAYERSALARY S WHERE P.PLAYERID= S.PLAYERID AND P.TEAMID 
IN (SELECT TEAMID FROM MANAGER WHERE MANAGERID = '$M1') ORDER BY S.SALARY DESC )");
		oci_execute($stid);
		$flag=0;
		while($row = oci_fetch_array($stid,OCI_BOTH))
		{  //if a table is returned, display the table 
          	print "<table border=1>";
                 #$row2 = oci_fetch_array($stid,OCI_NUM);
                 print "<tr>";
                 for($j=0;$j<count($row)-4;$j++)
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
