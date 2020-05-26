<html>
<head>
<title>Insert Instructor</title>
</head>

<body>
	<div class= "card">
	<form method = "post" action="one_controller.php">
	<fieldset>
	<legend>Create New Instructor </legend>
	<input type="text" name="InstructorId" placeholder="Create Instructor id" required> </br>
	<input type="text" name="FName" placeholder="Enter First Name" required> </br>
	<input type="text" name="LName" placeholder="Enter Last Name" required> </br>
	<input type="text" name="StartDate" placeholder="Enter Start Date e.g. YYYY-MM-DD" required> </br>
	<input type="text" name="Degree" placeholder="Enter Degree" required> </br>
	<input type="text" name="Rank" placeholder="Enter Rank" required> </br>
	<input type="text" name="Type" placeholder="Enter Type" required> </br>
	<input type="text" name="CourseId" placeholder="Enter CourseId To Teach" required> </br>
	<input type="text" name="StudentId" placeholder="Enter StudentId To Pair with Instructor" required> </br>
	<input id="button" type="submit" name="submit">
	
	</fieldset>
	</form>
	</div>
	</body>
	</html>