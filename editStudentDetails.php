<?php

    $servername = "";
    $username = "";
    $password = "";
    $database = "";

    $connection = new mysqli($servername, $username, $password, $database);


    $roll = "";
    $name = "";
    $email = "";
    $phone = "";
    $gender = "";

    $errorMessage = "";
    $successMessage = "";

    if( $_SERVER['REQUEST_METHOD'] == 'GET') {
        
        if ( !isset($_GET["id"])) {
            header("location: /Student_Registration_Form/index.php");
            exit;
        }
        
        $roll = $_GET["id"];

        $sql = "SELECT * FROM students WHERE roll=$roll";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();

        if( !$row) {
            header("location: /Student_Registration_Form/index.php");
            exit;
        }

        $roll = $row["roll"];
        $name = $row["name"];
        $email = $row["email"];
        $phone = $row["phone"];
        $gender = $row["gender"];
    
    } else {

        $roll = $_POST["roll"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $gender = $_POST["gender"];

        do {

            if( empty($roll) || empty($name) || empty($email) || empty($phone) || empty($gender)) {
                $errorMessage = "All fields are required";
                break;
            }
            
            $sql = "UPDATE students " . 
                    "SET roll = '$roll', name = '$name', email = '$email', phone = '$phone', gender = '$gender'" . 
                    "WHERE roll = $roll";
            
            try {
                
                if ($connection->query($sql) === TRUE) {
                    $successMessage =  "Student registered successfully";

                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;

                }

            } catch (mysqli_sql_exception $e) {
                $errorMessage = $e->getMessage();
                break;

            }
            
            // Set a session variable to indicate success
            session_start();
            $_SESSION['success_message'] = "Student details updated successfully!";
    
            header("location: /Student_Registration_Form/index.php");
            exit;
    
        } while(true);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Registration</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> </link>
    </head>
    <body>
        <div class="row">
            <div class="col">
                <h1 class="bg-primary text-white p-4 text-center shadow-sm">Edit Student Details</h1>
            </div>
        </div>

        <div class="container my-5"> 
            <h2>Student Details</h2>

            <?php 
            if( !empty($errorMessage) ) {

                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div> 
                ";
            }
            ?>

            <!-- No action bcoz same file passing data -->
            <form method="POST"> 
                <input type="hidden" name="id" value="<?php echo $roll; ?>">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Roll No</label>
                    <div class="col-sm-6">
                        <input type="text" class="col-md-1 form-control" name="roll" value="<?php echo $roll; ?>">
                    </div>
                </div> 
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                    </div>
                </div> 
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                    </div>
                </div> 
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Phone Number</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                    </div>
                </div> 
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Gender</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="gender" value="<?php echo $gender; ?>">
                    </div>
                </div> 

                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a class="btn btn-outline-primary" href="/Student_Registration_Form/index.php" role="button">Cancel</a>
                    </div>
                </div> 
            </form>
        </div> 
    </body>
</html>
