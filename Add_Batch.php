<?php
$serverName = "localhost"; // Change this to your MySQL server name if different
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "DB_Project"; // Your MySQL database name

// Establish connection
$conn = mysqli_connect($serverName, $username, $password, $database);

if (!$conn) {
    echo("Connection failed: ". mysqli_connect_error());
    exit();
}

// Fetch all departments
$deptQuery = "SELECT DeptID, DeptName FROM Department";
$deptResult = mysqli_query($conn, $deptQuery);

if (isset($_POST['button'])) {
    $batch = mysqli_real_escape_string($conn, $_POST['batch']);
    $section = mysqli_real_escape_string($conn, $_POST['section']);
    $DID = mysqli_real_escape_string($conn, $_POST['DID']);

    $sql = "INSERT INTO Batch (batch, DID) VALUES ('$batch', '$DID')";
    $stmt1 = mysqli_query($conn, $sql);

    $sql1 = "INSERT INTO Section (section, batch) VALUES ('$section', '$batch')";
    $stmt = mysqli_query($conn, $sql1);

    if (!$stmt1 || !$stmt) {
        echo("Query failed: ". mysqli_error($conn));
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Batch</title>
    <link rel="stylesheet" href="Signup.css">
</head>
<body>
    <div class="body">
        <div class="container">
            <h1>Add Batch in University</h1>
            <hr>
            <form method="post">
                
                <label for="batch">Batch</label>
                <input type="text" class="input" id="batch" name="batch" placeholder="Enter Batch Name">
    
                <label for="section">Default Section</label>
                <input type="text" class="input" id="section" name="section" placeholder="Enter Section Name">
                
                <label for="DID">Department</label>
                <select class="input" id="DID" name="DID">
                    <?php while ($row = mysqli_fetch_assoc($deptResult)) { ?>
                        <option value="<?php echo $row['DeptID']; ?>"><?php echo $row['DeptName']; ?></option>
                    <?php } ?>
                </select>
                
                <input type="submit" name="button" class="input" id="button" value="Add Batch">
                <a href="Admin_DashBoard.php?email=<?php echo $_GET['email']; ?>" id="account">Don't Want to add Batch</a>
            </form>
        </div>
    </div>
</body>
</html>
