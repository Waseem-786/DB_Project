<?php
$serverName = "localhost"; // Change this to your MySQL server name if different
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "DB_Project"; // Your MySQL database name

// Establish connection
$conn = mysqli_connect($serverName, $username, $password, $database);

if (!$conn) {
    echo "Connection failed: " . mysqli_connect_error();
    exit();
}

// Fetch all courses for dropdown
$courseQuery = "SELECT CrsID, CrsName FROM Course";
$courseResult = mysqli_query($conn, $courseQuery);

// Fetch all students for dropdown
$studentQuery = "SELECT StdID, CONCAT(FirstName, ' ', LastName) AS StudentName FROM Student";
$studentResult = mysqli_query($conn, $studentQuery);

if (isset($_POST['button'])) {
    $StdID = mysqli_real_escape_string($conn, $_POST['StdID']);
    $CrsID = mysqli_real_escape_string($conn, $_POST['CrsID']);
    $start = mysqli_real_escape_string($conn, $_POST['start']);
    $end = mysqli_real_escape_string($conn, $_POST['end']);

    $sql = "INSERT INTO Std_Crs (StdID, CrsID, Crs_Start_Date, Crs_End_Date) VALUES ('$StdID', '$CrsID', '$start', '$end')";
    $stmt = mysqli_query($conn, $sql);
    
    if (!$stmt) {
        echo "Query failed: " . mysqli_error($conn);
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
    <title>Enrollment</title>
    <link rel="stylesheet" href="Signup.css">
</head>
<body>
    <div class="body">
        <div class="container">
            <h1>Student Enrollment in Course</h1>
            <hr>
            <form method="post">
                
                <label for="StdID">Student</label>
                <select class="input" id="StdID" name="StdID">
                    <?php while ($row = mysqli_fetch_assoc($studentResult)) { ?>
                        <option value="<?php echo $row['StdID']; ?>"><?php echo $row['StudentName']; ?></option>
                    <?php } ?>
                </select>
                
                <label for="CrsID">Course</label>
                <select class="input" id="CrsID" name="CrsID">
                    <?php while ($row = mysqli_fetch_assoc($courseResult)) { ?>
                        <option value="<?php echo $row['CrsID']; ?>"><?php echo $row['CrsName']; ?></option>
                    <?php } ?>
                </select>
    
                <label for="start">Course Start Date</label>
                <input type="date" class="input" id="start" name="start">
                
                <label for="end">Course End Date</label>
                <input type="date" class="input" id="end" name="end">
                
                <input type="submit" name="button" class="input" id="button" value="Add Course">
                <a href="Admin_DashBoard.php?email=<?php echo $_GET['email']; ?>" id="account">Don't Want to add Course</a>
            </form>
        </div>
    </div>
</body>
</html>
