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

// Fetch all courses for prerequisite selection
$courseQuery = "SELECT CrsName FROM Course";
$courseResult = mysqli_query($conn, $courseQuery);

if (isset($_POST['button'])) {
    $CrsID = mysqli_real_escape_string($conn, $_POST['CrsID']);
    $CrsName = mysqli_real_escape_string($conn, $_POST['CrsName']);
    $P_CrsName = mysqli_real_escape_string($conn, $_POST['P_CrsName']);
    $hours = mysqli_real_escape_string($conn, $_POST['hours']);

    $pre = "NULL"; // Default to NULL
    if ($P_CrsName != "NULL" && $P_CrsName != "none") {
        $sql1 = "SELECT CrsID FROM Course WHERE CrsName = '$P_CrsName'";
        $stmt1 = mysqli_query($conn, $sql1);
        if ($row1 = mysqli_fetch_array($stmt1, MYSQLI_NUM)) {
            $pre = "'" . $row1[0] . "'"; // Properly format for SQL query
        }
    }

    $sql3 = "INSERT INTO Course (CrsID, CrsName, CreditHours, Pre_Req) VALUES ('$CrsID', '$CrsName', $hours, $pre)";
    $stmt3 = mysqli_query($conn, $sql3);

    
    if (!$stmt3) {
        echo "'Query failed: " . mysqli_error($conn);
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
    <title>Add Course</title>
    <link rel="stylesheet" href="Signup.css">
</head>
<body>
    <div class="body">
        <div class="container">
            <h1>Add Course in University</h1>
            <hr>
            <form method="post">
                
                <label for="CrsID">Course ID</label>
                <input type="text" class="input" id="CrsID" name="CrsID" placeholder="Enter Course ID">
    
                <label for="CrsName">Course Name</label>
                <input type="text" class="input" id="CrsName" name="CrsName" placeholder="Enter Course Name">
                
                <label for="hours">Credit Hours</label>
                <select name="hours" id="hours" class="input">
                    <option value="none">Choose Credit Hours</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>

                <label for="P_CrsName">Pre-Req Course Name</label>
                <select name="P_CrsName" id="P_CrsName" class="input">
                    <option value="none">Choose Pre Req</option>
                    <option value="NULL">NULL</option>
                    <?php while ($row = mysqli_fetch_assoc($courseResult)) { ?>
                        <option value="<?php echo $row['CrsName']; ?>"><?php echo $row['CrsName']; ?></option>
                    <?php } ?>
                </select>
                
                <input type="submit" name="button" class="input" id="button" value="Add Course">
                <a href="Admin_DashBoard.php?email=<?php echo $_GET['email']; ?>" id="account">Don't Want to add Course</a>
            </form>
        </div>
    </div>
</body>
</html>
