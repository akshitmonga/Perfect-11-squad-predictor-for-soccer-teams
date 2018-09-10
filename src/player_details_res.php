<!DOCTYPE html>
<html lang="en">
<link href="css/style2.css" rel="stylesheet">
</head>

<body>
  <table>
  <thead>
	<tr>
      <th>Team Name</th>
      <th>Manager Name</th>
      <th>Player Name</th>
	  <th>Age</th>
      <th>Country</th>
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
		
		$P1= $_POST['player'];
		$stid = oci_parse($conn,"SELECT T.TEAMNAME, M.NAME AS MANAGERNAME, P.NAME AS PLAYERNAME, P.AGE, P.COUNTRY, S.SALARY FROM MANAGER M, TEAM T, PLAYER P, 
PLAYERSALARY S WHERE P.PLAYERID=S.PLAYERID AND M.TEAMID=P.TEAMID AND T.TEAMID=P.TEAMID AND P.PLAYERID='$P1'");
		oci_execute($stid);
		$flag=0;
		while($row = oci_fetch_array($stid,OCI_BOTH))
		{  //if a table is returned, display the table 
          	print "<table border=1>";
                 print "<tr>";
                 for($j=0;$j<count($row)-6;$j++)
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
