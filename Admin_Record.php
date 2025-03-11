<?php
$serverName = "localhost";
$username = "root";
$password = "";
$database = "DB_Project";

// Establish connection
$conn = mysqli_connect($serverName, $username, $password, $database);

if (!$conn) {
    echo "<script>alert('Connection failed: " . mysqli_connect_error() . "');</script>";
    exit();
}

$records = [];
if (!isset($_POST['submit'])) { // Default and Show All Condition
    $sql = "SELECT Ad.AdID, Ad.FirstName, Ad.LastName, Ad.FatherName, Ad.age, Ad.Mobile_Number, Ad.City, Ad.Country, Ad.PostalCode, Ad.Institute, Ad.DOB, A.Email 
            FROM Admin AS Ad
            INNER JOIN Account AS A ON Ad.AdID = A.AdID";
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

    $sql1 = "SELECT Ad.AdID, Ad.FirstName, Ad.LastName, Ad.FatherName, Ad.age, Ad.Mobile_Number, Ad.City, Ad.Country, Ad.PostalCode, Ad.Institute, Ad.DOB, A.Email 
             FROM Admin AS Ad
             INNER JOIN Account AS A ON Ad.AdID = A.AdID
             WHERE Ad.AdID = '$search' OR FirstName = '$search' OR LastName = '$search' OR FatherName = '$search' OR  
                   Mobile_Number = '$search' OR City = '$search' OR Country = '$search' OR A.Email = '$search' OR 
                   Institute = '$search' OR Age = '$search' OR PostalCode = '$search' OR DOB = '$search'";
    
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
    <title>Admin Record</title>
    <link rel="stylesheet" href="Student_Record.css">
</head>
<body>
    <div class="container">
        <div class="nav">
            <h1>Admin Record</h1>
            <form class="search" method="post">
                <input type="submit" value="Show All" name="show">
                <input type="search" name="search" id="search">
                <input type="submit" name="submit" id="submit" value="Search">
            </form>
        </div>

        <table>
            <tr id='Main'>
                <th>Admin ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Father Name</th>
                <th>Age</th>
                <th>Mobile Number</th>
                <th>City</th>
                <th>Country</th>
                <th>Postal Code</th>
                <th>Institute</th>
                <th>Date of Birth</th>
                <th>Email</th>
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
                    <th><?php echo htmlspecialchars($row[8]); ?></th>
                    <th><?php echo htmlspecialchars($row[9]); ?></th>
                    <th><?php echo htmlspecialchars($row[10]); ?></th>
                    <th><?php echo htmlspecialchars($row[11]); ?></th>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
