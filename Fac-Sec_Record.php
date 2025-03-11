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

$records = [];
if (!isset($_POST['submit'])) { // Default and Show All Condition
    $sql = "SELECT FS.ClassName, FS.Batch, FS.Section, FS.FacID, CONCAT(F.FirstName, ' ', F.LastName) AS FacultyName, C.CrsName, FS.Class_start_time, FS.Class_End_Time
            FROM Fac_Sec AS FS
            INNER JOIN Faculty AS F ON F.FacID = FS.FacID
            INNER JOIN Fac_Crs AS FC ON FC.FacID = F.FacID
            INNER JOIN Course AS C ON C.CrsID = FC.CrsID";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
            $records[] = $row;
        }
    } else {
        echo "Query failed: " . mysqli_error($conn);
    }
}

if (isset($_POST['submit'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    $sql1 = "SELECT FS.ClassName, FS.Batch, FS.Section, FS.FacID, CONCAT(F.FirstName, ' ', F.LastName) AS FacultyName, C.CrsName, FS.Class_start_time, FS.Class_End_Time
            FROM Fac_Sec AS FS
            INNER JOIN Faculty AS F ON F.FacID = FS.FacID
            INNER JOIN Fac_Crs AS FC ON FC.FacID = F.FacID
            INNER JOIN Course AS C ON C.CrsID = FC.CrsID
            WHERE FS.ClassName = '$search' OR FS.Batch = '$search' OR FS.Section = '$search' OR 
                  FS.FacID = '$search' OR F.FirstName = '$search' OR C.CrsName = '$search' OR 
                  FS.Class_start_time = '$search' OR FS.Class_end_time = '$search'";
    $result1 = mysqli_query($conn, $sql1);

    if ($result1) {
        while ($row = mysqli_fetch_array($result1, MYSQLI_NUM)) {
            $records[] = $row;
        }
    } else {
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
    <title>Faculty Class Record</title>
    <link rel="stylesheet" href="Student_Record.css">
</head>
<body>
    <div class="container">
        <div class="nav">
            <h1>Faculty Class Record</h1>
            <form class="search" method="post">
                <input type="submit" value="Show All" name="show">
                <input type="search" name="search" id="search">
                <input type="submit" name="submit" id="submit" value="Search">
            </form>
        </div>

        <table>
            <tr id='Main'>
                <th>Class Name</th>
                <th>Batch</th>
                <th>Section</th>
                <th>Faculty ID</th>
                <th>Faculty Name</th>
                <th>Course Name</th>
                <th>Class Start Time</th>
                <th>Class End Time</th>
            </tr>
            <?php foreach ($records as $row) { ?>
                <tr class='row'>
                    <th><?php echo htmlspecialchars($row[0]); ?></th>
                    <th><?php echo htmlspecialchars($row[1]); ?></th>
                    <th><?php echo htmlspecialchars($row[2]); ?></th>
                    <th><?php echo htmlspecialchars($row[3]); ?></th>
                    <th><?php echo htmlspecialchars($row[4]); ?></th>
                    <th><?php echo htmlspecialchars($row[5]); ?></th>
                    <th><?php echo htmlspecialchars($row[6]); ?></th>
                    <th><?php echo htmlspecialchars($row[7]); ?></th>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
