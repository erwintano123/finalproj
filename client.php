<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of enrollee</h2>

        <!-- Using d-flex to align the buttons horizontally -->
        <div class="d-flex justify-content-start mb-3">
            <!-- "New Client" button -->
            <a class="btn btn-primary me-2" href="/create.php" role="button">Enroll Now</a>

            <a class="btn btn-secondary" href="/search.php" role="button">Search</a>
            
        </div>

        <table class="table">    
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>age</th>
                <th>gender</th>
                <th>course</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
$servername = "sql102.infinityfree.com";
$username = "if0_37770773";
$password = "92A1Z2DP5e";
$database = "if0_37770773_enrollment";
            
            $conn = new mysqli($servername, $username, $password, $database);
            

            if ($conn->connect_error) { 
                die("Connection failed: " . $conn->connect_error); 
            }

            $sql = "SELECT * FROM clients";
            $result = $conn->query($sql);

            if (!$result) {
                die("Invalid query: " . $conn->error);
            }

            while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[age]</td>
                    <td>$row[gender]</td>
                    <td>$row[course]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='edit.php?id=$row[id]'>Update</a>
                        <a class='btn btn-danger btn-sm' href='delete.php?id=$row[id]'>Delete</a>
                    </td>
                </tr>
                ";
            }
            ?>
        </tbody>
        </table>
    </div>
</body>
</html>
