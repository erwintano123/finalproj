<?php
$host = 'sql102.infinityfree.com'; 
$dbname = 'if0_37770773_enrollment';
$username = 'if0_37770773'; 
$password = '92A1Z2DP5e'; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $stmt = $conn->prepare("INSERT INTO enrollments (name, age, gender, email, course) VALUES (:name, :age, :gender, :email, :course)");
    
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':course', $course);
    
    $stmt->execute();
    
    echo "Enrollment successful!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
