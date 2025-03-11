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

// Fetch all student-course records
$records = [];
$sql = "SELECT SC.StdID, CONCAT(S.FirstName, ' ', S.LastName) AS StudentName, SC.CrsID, C.CrsName, SC.Crs_Start_Date, SC.Crs_End_Date
        FROM Std_Crs AS SC
        INNER JOIN Student AS S ON S.StdID = SC.StdID
        INNER JOIN Course AS C ON C.CrsID = SC.CrsID";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $records[] = $row;
    }
} else {
    echo "Query failed: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Course Record</title>
    <link rel="stylesheet" href="Student_Record.css">
</head>
<body>
    <div class="container">
        <div class="nav">
            <h1>Student Course Record</h1>
            <form class="search" method="post">
                <input type="submit" value="Show All" name="show">
                <input type="search" name="search" id="search">
                <input type="submit" name="submit" id="submit" value="Search">
            </form>
        </div>

        <table>
            <tr id='Main'>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Course Start Date</th>
                <th>Course End Date</th>
            </tr>
            <?php foreach ($records as $row) { ?>
                <tr class='row'>
                    <th><?php echo $row[0]; ?></th>
                    <th><?php echo $row[1]; ?></th>
                    <th><?php echo $row[2]; ?></th>
                    <th><?php echo $row[3]; ?></th>
                    <th><?php echo $row[4]; ?></th>
                    <th><?php echo $row[5]; ?></th>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>

