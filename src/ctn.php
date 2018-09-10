<html>
<head><title>Oracle demo</title></head>
<body>
<?php 
    $conn=oci_connect("OracleID","Password","oracle.cise.ufl.edu/orcl");
    If (!$conn)
        echo 'Failed to connect to Oracle';
    else
        echo 'Succesfully connected with Oracle DB';
 
	if ( isset( $_POST['submit'] ) ) {

		$firstname = $_POST['USERNAME'];
		$lastname = $_POST['PASSWORD'];
 
		$stid = oci_parse($conn, "SELECT USERNAME,PASSWORD FROM LOGIN where USERNAME ='$firstname' and PASSWORD='$lastname'");
		oci_execute($stid);
		#header("location:index.html");
		if($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
		{
			header("location:index.html");
		}
		    
		else
		{
			#$_SESSION['msg']="Invalid login ID or Password";
			header("location:login.html");
		}
	}
	oci_close($conn);
?>
 
</body>
</html>