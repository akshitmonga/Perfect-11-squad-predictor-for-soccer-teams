<!DOCTYPE html>
<html lang="en">
<link href="css/style3.css" rel="stylesheet">
</head>

<body>
  <?php 

		print "<tbody>";
		$conn=oci_connect("OracleID","Password","oracle.cise.ufl.edu/orcl");
		If (!$conn)
			echo 'Failed to connect to Oracle';
			else
				#echo 'Succesfully connected with Oracle DB';
	
		if ( isset( $_POST['submit'] ) ) {
		
		$P1= $_POST['player'];
		$M1= $_POST['manager'];
		$stid = oci_parse($conn,"DELETE FROM PLAYER WHERE PLAYER.PLAYERID ='$P1' AND PLAYER.TEAMID IN ( SELECT MANAGER.TEAMID FROM TEAM,MANAGER WHERE TEAM.TEAMID = MANAGER.TEAMID AND MANAGER.MANAGERID ='$M1')");
		oci_execute($stid);
		$flag=0;
		echo "Player Deleted !!!!";
	}
	print "</tbody>";  
				
?>
  
</table>
</body>
</html>
