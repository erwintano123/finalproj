<?php
$servername = "sql102.infinityfree.com";
$username = "if0_37770773";
$password = "92A1Z2DP5e";
$database = "if0_37770773_enrollment";

$connection = new mysqli($servername, $username, $password, $database);

$name = "";
$email = "";
$age = "";
$gender = "";
$course = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $age = $_POST["age"];  // Corrected variable from $phone to $age
    $gender = $_POST["gender"];  // Corrected variable from $address to $gender
    $course = $_POST["course"];

    do {
        if (empty($name) || empty($email) || empty($age) || empty($gender) || empty($course)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Prepare and bind statement with the correct types
        $stmt = $connection->prepare("INSERT INTO enrollments (name, email, age, gender, course) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $name, $email, $age, $gender, $course);  // Corrected data type for age

        $result = $stmt->execute();
        if (!$result) {
            $errorMessage = "Invalid query: " . $stmt->error;
            break;
        }

        // Clear form fields after successful insertion
        $name = "";
        $email = "";
        $age = "";
        $gender = "";
        $course = "";

        $successMessage = "Student added correctly";

        // Redirect to another page
        header("Location: client.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Enroll Now</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
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
                <label class="col-sm-3 col-form-label">Age</label>  <!-- Fixed label from 'age' to 'Age' -->
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="age" value="<?php echo $age; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Gender</label>  <!-- Fixed label from 'gender' to 'Gender' -->
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="gender" value="<?php echo $gender; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Course</label>  <!-- Fixed label from 'course' to 'Course' -->
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="course" value="<?php echo $course; ?>">
                </div>
            </div>
            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                 <div class='offset-sm-3 col-sm-6'>
                 <div class='alert alert-success alert-dismissible fade show' role='alert'>
                 <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                </div>
                </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-6 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-6 d-grid">
                    <a class="btn btn-outline-primary" href="/client.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
