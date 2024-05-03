<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css
"> </link>
</head>
<body>

	<div class="row">
		<div class="col">
			<h1 class="bg-primary text-white p-4 text-center shadow-sm">Student Registration Form</h1>
		</div>
    </div>
    
    <div class="container my-5">
        <h2>List of Students</h2>
        <a class="btn btn-primary mt-3 mb-3" href="/Project/newStudentRegistration.php" role="button">New Student</a>
        <br>
        <table class="table table-bordered table-striped align-middle">
			<thead>
				<tr>
					<th>Roll No</th> 
					<th>Name</th> 
					<th>Email</th> 
					<th>Phone Number</th> 
					<th>Gender</th> 
					<th>Action</th> 
				</tr>
			</thead> 
			<tbody>
			<!-- To Enter data dynamiclly -->
			<?php

			$servername = "localhost";
			$username = "root";
			$password = "#Squl3.8.1P";
			$database = "mini-project";

			$connection = new mysqli($servername, $username, $password, $database);

			if($connection->connect_error) {
				die("Connection failed : " . $connection->connect_error);
			}

			$sql = "SELECT * FROM students";
			$result = $connection->query($sql);
				
				if (mysqli_num_rows($result) > 0) { 
					if(!$result) {
						die("Invalid Queery : " . $connection->error);
					}

					while($row = $result->fetch_assoc()) {
						echo "
							<tr>
								<td>$row[roll]</td> 
								<td>$row[name]</td> 
								<td>$row[email]</td> 
								<td>$row[phone]</td> 
								<td>$row[gender]</td> 
								<td> 
									<a class='btn btn-primary btn-sm' href='/Project/editStudentDetails.php?id=$row[roll]'> Edit
										<!-- <i class='bi bi-pencil-square'></i>  -->
									</a>&nbsp;
									<a class='btn btn-danger btn-sm' href='/Project/deleteStudentDetails.php?id=$row[roll]'> Delete
										<!-- <i class='bi bi-trash-fill'></i> -->
									</a>
								</td>
							</tr>
						";
					}
				} else {
					echo "
						<tr>
							<td class='text-center text-danger fw-bold' colspan='9'>** No records were found **</td>
						</tr>
					";
				}
			?>
			</tbody> 
        </table>
    </div>
</body>
</html>