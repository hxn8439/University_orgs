<?php

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname="doctoral";

//Create Connection
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

//check Connection
if(!$conn)
{
	die("Connection failed");
}	

//start processing

else
{
	$sidd = filter_input(INPUT_POST,'sid');
	$FName = filter_input(INPUT_POST,'FName');
	$LName = filter_input(INPUT_POST,'LName');
	
	if (isset($_POST["submit"]))
	{
		
		if(empty($FName))
		{
			echo "<font color='red'>***YOU MUST FILL ALL DATA FIELDS.***</font><br/><br/>";
		}	
		
		if(empty($LName))
		{
			echo "<font color='red'>***YOU MUST FILL ALL DATA FIELDS.***</font><br/><br/>";
		}
		
		else
		{	
			$query = "SELECT * FROM gra WHERE StudentId = '". mysqli_real_escape_string($conn,$sidd) ."'";
			$result = mysqli_query($conn,$query);
			
			
			if (mysqli_num_rows($result)) 
			{
				$sql = "UPDATE phdstudent SET FName='".$FName."',LName='".$LName."' WHERE StudentId='".$sidd."'";
				
				if(mysqli_query($conn, $sql))
				{
					echo "NEW RECORD ADDED SUCCESSFULLY IN PHDSTUDENT TABLE"; echo'</br>';
				}
				
				else
				{
					echo "Error updating record: " . mysqli_error($conn);
				}
			} 
			
			else 
			{
				echo "<font color='red'>***NO MATCH FOR STUDENTID IN GRA TABLE.***</font><br/><br/>";
				die();
			}
		}
	}	
}	

mysqli_close($conn);
?>
