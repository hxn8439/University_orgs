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
	die("Connection failed" . mysqli_connect_error());
}	

//start processing

else
{
	$sidd = filter_input(INPUT_POST,'sid');
	
	if (isset($_POST["submit"]))
	{	

		if(empty($sidd))
		{
			echo "<font color='red'>***YOU MUST FILL THE DATA FIELD.***</font><br/><br/>";
		}	
		
		else
		{	
			$query = "SELECT * FROM selfsupport WHERE StudentId = '". mysqli_real_escape_string($conn,$sidd) ."'";
			$result = mysqli_query($conn,$query);
			
			if (mysqli_num_rows($result) == 1) 
			{
				$row = mysqli_fetch_assoc($result);
				//echo "StudentId: " . $row["StudentId"]."";
			
				$selfsupportstuid = $row["StudentId"];
				//echo ".$selfsupportstuid.";
				
				$query1 = "SELECT * FROM milestonespassed WHERE StudentId = '". mysqli_real_escape_string($conn,$selfsupportstuid) ."'";
				$result1 = mysqli_query($conn,$query1);
				
				if (mysqli_num_rows($result1) == 1) 
				{
					echo "<font color='red'>***MATCHED FOR StudentID IN MilESTONEPASSED TABLE.***</font><br/><br/>";
					echo "<font color='red'>***THE STUDENT'S MILESTONE HAS ALREADY MET THE MINIMUM CLASSIFICATION.***</font><br/><br/>";
					die();
				}
				
				else 
				{
					echo "<font color='red'>***THE STUDENT'S MILESTONE DOES NOT MEET THE MINIMUM CLASSIFICATION.***</font><br/><br/>";
					
					$query2 = "DELETE FROM phdstudent WHERE phdstudent.StudentId = '$sidd'";
				 	
					if (mysqli_query($conn, $query2))
					{
						echo "Deleted successfully in Phdstudent table, student is no longer in the database.</font><br/><br/>";
					}

					
					else 
					{
						echo "<font color='red'>***NO MATCH FOR StudentID IN phdstudent TABLE. It does not exist in the table***</font><br/><br/>";
						die();
					}	
					
					
					$query3 = "DELETE FROM selfsupport WHERE selfsupport.StudentId = '$sidd'";
					
					if (mysqli_query($conn, $query3))
					{
						echo "Deleted successfully in selfsupport table, student is no longer in the database.</font><br/><br/>";
					}

					else 
					{
						echo "<font color='red'>***NO MATCH FOR StudentID IN SelfSupport TABLE. It does not exist in the table***</font><br/><br/>";
						die();
					}
				}
			} 
			
			else 
			{
				echo "<font color='red'>***NO MATCH FOR STUDENTID IN SelfSupport TABLE.***</font><br/><br/>";
				die();
			}
		}
	}	
}	

mysqli_close($conn);
?>