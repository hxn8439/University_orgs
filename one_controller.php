<?php

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname="doctoral";

//Create Connection

$conn = new PDO ('mysql:host='.$host.'; dbname='.$dbname, $dbusername, $dbpassword);

//check Connection
if(!$conn)
{
	die("Connection failed");
}	

//start processing

else
{
	$InstructorId = filter_input(INPUT_POST,'InstructorId');
	$FName = filter_input(INPUT_POST,'FName');
	$LName = filter_input(INPUT_POST,'LName');
	$StartDate = filter_input(INPUT_POST,'StartDate');
	$Degree = filter_input(INPUT_POST,'Degree');
	$Rank = filter_input(INPUT_POST,'Rank');
	$Type = filter_input(INPUT_POST,'Type');
	
	$CourseId = filter_input(INPUT_POST, 'CourseId');
	$StudentId = filter_input(INPUT_POST, 'StudentId');

	$query = "INSERT INTO instructor(InstructorId, FName, LName, StartDate, Degree, Rank, Type)
	values('$InstructorId','$FName','$LName','$StartDate','$Degree','$Rank','$Type')";

	$query1 = "INSERT INTO coursestaught(CourseId, InstructorId)values('$CourseId','$InstructorId')";
	
	$query2 = "INSERT INTO phdcommittee(StudentId, InstructorId)values('$StudentId','$InstructorId')";

	if($conn->query($query))
	{
		echo "NEW RECORD ADDED SUCCESSFULLY IN INSTRUCTOR TABLE"; echo'</br>';
	}
	
	if($conn->query($query1))
	{
		echo "NEW RECORD ADDED SUCCESSFULLY IN CourseTaught TABLE"; echo'</br>';
	}
	
	if($conn->query($query2))
	{
		echo "NEW RECORD ADDED SUCCESSFULLY IN phdcommittee TABLE"; echo'</br>';
	}	

	else
	{
		echo "Error:".$query."".$conn->error;
	}		
	
}	

?>
