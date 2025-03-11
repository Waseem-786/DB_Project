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

$courses = [];
if (!isset($_POST['submit'])) { // Default and Show All Condition
    $sql = "SELECT * FROM Course";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
            $courses[] = $row;
        }
    } else {
        echo "Query failed: " . mysqli_error($conn);
    }
}

if (isset($_POST['submit'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    $sql1 = "SELECT * FROM Course WHERE CrsID = '$search' OR CrsName = '$search' OR CreditHours = '$search' OR Pre_Req = '$search'";
    $result1 = mysqli_query($conn, $sql1);

    if ($result1) {
        
        while ($row = mysqli_fetch_array($result1, MYSQLI_NUM)) {
            $courses[] = $row;
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
    <title>Course Record</title>
    <link rel="stylesheet" href="Student_Record.css">
</head>
<body>
    <div class="container">
        <div class="nav">
            <h1>Course Record</h1>
            <form class="search" method="post">
                <input type="submit" value="Show All" name="show">
                <input type="search" name="search" id="search">
                <input type="submit" name="submit" id="submit" value="Search">
            </form>
        </div>

        <table>
            <tr id='Main'>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Credit Hours</th>
                <th>Pre Req</th>
            </tr>
            <?php foreach ($courses as $row) { ?>
                <tr class='row'>
                    <th><?php echo $row[0]; ?></th>
                    <th><?php echo $row[1]; ?></th>
                    <th><?php echo $row[2]; ?></th>
                    <th><?php echo $row[3] ? $row[3] : 'NULL'; ?></th>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
