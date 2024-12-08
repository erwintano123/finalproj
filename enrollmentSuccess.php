<?php
$servername = "sql102.infinityfree.com";
$username = "if0_37770773";
$password = "92A1Z2DP5e";
$dbname = "if0_37770773_enrollment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_id = $_GET['id'];

$sql = "SELECT * FROM students WHERE id = $student_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h1>Enrollment Successful!</h1>";
    echo "<p>Name: " . $row['name'] . "</p>";
    echo "<p>Age: " . $row['age'] . "</p>";
    echo "<p>Gender: " . $row['gender'] . "</p>";
    echo "<p>Email: " . $row['email'] . "</p>";
    echo "<p>Course: " . $row['course'] . "</p>";
} else {
    echo "Student not found.";
}

$conn->close();
?>

<form action="courses.html" method="get">
    <button type="submit">Exit</button>
</form>
