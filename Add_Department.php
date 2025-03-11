<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Department</title>
    <link rel="stylesheet" href="Signup.css">
</head>
<body>
    <div class="body">

    
        <div class="container">
            <h1>Add Department in University</h1>
            <hr>
            <form method="post">
                
                <label for="DID">Department ID</label>
                <input type="text" class="input" id="DID" name="DID" placeholder="Enter Department ID">
    
                <label for="name">Department Name</label>
                <input type="text" class="input" id="name" name="name" placeholder="Enter Department Name">
                
                <label for="location">Location</label>
                <input type="text" class="input" id="location" name="location" placeholder="Enter Department Locatin">
                
                <input type="submit" name="button" class="input" id="button" value="Add Department">
                <a href="Admin_DashBoard.php?email=<?php echo $_GET['email']; ?>" id="account">Don't Want to add Department</a>
            </form>
        </div>
    </div>

<?php
$serverName = "localhost"; // Change this to your MySQL server name if different
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "DB_Project"; // Your MySQL database name

// Establish connection
$conn = mysqli_connect($serverName, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['button'])) {
    $DID = mysqli_real_escape_string($conn, $_POST['DID']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    $sql = "INSERT INTO Department (DeptID, Deptname, Deptlocation) VALUES ('$DID', '$name', '$location')";
    $stmt = mysqli_query($conn, $sql);

    if (!$stmt) {
        die("Query failed: " . mysqli_error($conn));
    }
}

mysqli_close($conn);
?>
    
                
</body>
</html>