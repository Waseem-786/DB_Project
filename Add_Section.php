<?php
$serverName = "localhost"; // Change this to your MySQL server name if different
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "DB_Project"; // Your MySQL database name

// Establish connection
$conn = mysqli_connect($serverName, $username, $password, $database);

if (!$conn) {
    echo "<script>alert('Connection failed: " . mysqli_connect_error() . "');</script>";
    exit();
}

// Fetch all batches
$batchQuery = "SELECT Batch FROM Batch";
$batchResult = mysqli_query($conn, $batchQuery);

if (isset($_POST['button'])) {
    $section = mysqli_real_escape_string($conn, $_POST['section']);
    $batch = mysqli_real_escape_string($conn, $_POST['batch']);

    $sql = "INSERT INTO Section (Section, Batch) VALUES ('$section', '$batch')";
    $stmt = mysqli_query($conn, $sql);

    if (!$stmt) {
        echo "<script>alert('Query failed: " . mysqli_error($conn) . "');</script>";
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
    <title>Add Section</title>
    <link rel="stylesheet" href="Signup.css">
</head>
<body>
    <div class="body">
        <div class="container">
            <h1>Add Section in Batch</h1>
            <hr>
            <form method="post">
                
                <label for="section">Section</label>
                <input type="text" class="input" id="section" name="section" placeholder="Enter Section name">
    
                <label for="batch">Batch</label>
                <select class="input" id="batch" name="batch">
                    <?php while ($row = mysqli_fetch_assoc($batchResult)) { ?>
                        <option value="<?php echo $row['Batch']; ?>"><?php echo $row['Batch']; ?></option>
                    <?php } ?>
                </select>
                
                <input type="submit" name="button" class="input" id="button" value="Add Section">
                <a href="Admin_DashBoard.php?email=<?php echo $_GET['email']; ?>" id="account">Don't Want to add Section</a>
            </form>
        </div>
    </div>
</body>
</html>
