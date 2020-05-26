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
	$studentid = filter_input(INPUT_POST,'sid');
	
	if (isset($_POST["submit"]))
	{	

		if(empty($studentid))
		{
			echo "<font color='red'>***YOU MUST FILL THE DATA FIELD.***</font><br/><br/>";
		}	
		
		else
		{	
			$query = "SELECT * FROM gta WHERE StudentId = '". mysqli_real_escape_string($conn,$studentid) ."'";
			$result = mysqli_query($conn,$query);
			
			if (mysqli_num_rows($result) == 1) 
			{
				$row = mysqli_fetch_assoc($result);
				//echo "SectionId: " . $row["SectionId"]. " - MonthlyPay: " . $row["MonthlyPay"]. "-StudentId " . $row["StudentId"]. "";
			
				$secid = $row["SectionId"];
				//echo ".$secid.";
				
				$query1 = "SELECT * FROM section WHERE SectionId = '". mysqli_real_escape_string($conn,$secid) ."'";
				$result1 = mysqli_query($conn,$query1);
				
				if (mysqli_num_rows($result1) == 1) 
				{
					$row1 = mysqli_fetch_assoc($result1);
					//echo "SectionId: " . $row1["SectionId"]. " - CourseId: " . $row1["CourseId"]."";
					
					$couid = $row1["CourseId"];
					$query2 = "SELECT * FROM course WHERE COURSEID = '". mysqli_real_escape_string($conn,$couid) ."'";
					$result2 = mysqli_query($conn,$query2);
					
					if (mysqli_num_rows($result2) == 1) 
					{
						$row2 = mysqli_fetch_assoc($result2);
						//echo "CourseID: " . $row2["CourseID"]. " - CName: " . $row2["CName"]."";
						echo "Course Name: " . $row2["CName"]. " - CourseID: " . $row2["CourseID"]." - SectionID: " . $row1["SectionId"]."";
					}
					
					else 
					{
						echo "<font color='red'>***NO MATCH FOR CourseID IN Course TABLE.***</font><br/><br/>";
						die();
					}	
				}
				
				else 
				{
					echo "<font color='red'>***NO MATCH FOR SectionID IN Section TABLE.***</font><br/><br/>";
					die();
				}
			} 
			
			else 
			{
				echo "<font color='red'>***NO MATCH FOR STUDENTID IN GTA TABLE.***</font><br/><br/>";
				die();
			}
		}
	}	
}	

mysqli_close($conn);
?>