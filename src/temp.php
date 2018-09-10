<!DOCTYPE html>
<html lang="en">
<link href="css/style2.css" rel="stylesheet">
</head>

<body>
<table>
  <thead>
    <tr>
      <th>Player Name</th>
      <th>Team Name</th>
      <th>Overall Score</th>
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
		$TNAME = $_POST['tname'];
		$stid = oci_parse($conn, "SELECT NAME,TEAMNAME,OVERALL FROM PLAYER,TEAM WHERE PLAYER.TEAMID=TEAM.TEAMID AND TEAMNAME='$TNAME' and ROWNUM<12 ORDER BY OVERALL DESC");
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
	if($flag==0)
	{
		#$_SESSION['msg']="Invalid login ID or Password";
		echo 'Team not found !!!';
		header("location:teamname.php");
		
	}
	
?>

</tbody>
  
</table>
</body>
</html>
