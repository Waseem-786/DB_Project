<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Record</title>
    <link rel="stylesheet" href="Student_Record.css">
</head>

<body>
    <div class="container">
        <div class="nav">
            <h1>Student Record</h1>
            <form class="search" method="post">
                <input type="submit" value="Show All" name="show">
                <input type="search" name="search" id="search">
                <input type="submit" name="submit" id="submit" value="Search">
            </form>
        </div>

        <Table>
            <tr id='Main'>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Father Name</th>
                <th>Age</th>
                <th>Mobile Number</th>
                <th>City</th>
                <th>Country</th>
                <th>Postal Code</th>
                <th>Institute</th>
                <th>Batch</th>
                <th>Section</th>
                <th>Date of Birth</th>
                <th>Email</th>
                <th>Department</th>
            </tr>


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

if (!isset($_POST['submit'])) { // Default and Show All Condition
    $sql = "SELECT S.StdID, FirstName, LastName, FatherName, Age, Mobile_Number, City, Country, PostalCode, Institute, DOB, Batch, Section, Email, S.DeptId 
            FROM Student AS S 
            INNER JOIN Account AS A ON S.StdID = A.StdID";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
            echo "<tr class='row'>";
            foreach ($row as $cell) {
                echo "<th>$cell</th>";
            }
            echo "</tr>";
        }
    } else {
        die("Query failed: " . mysqli_error($conn));
    }
}

if (isset($_POST['submit'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    $sql1 = "SELECT S.StdID, FirstName, LastName, FatherName, Age, Mobile_Number, City, Country, PostalCode, Institute, DOB, Batch, Section, Email 
             FROM Student AS S 
             INNER JOIN Account AS A ON S.StdID = A.StdID 
             WHERE S.StdID = '$search' OR 
                   FirstName = '$search' OR 
                   LastName = '$search' OR 
                   FatherName = '$search' OR  
                   Mobile_Number = '$search' OR 
                   City = '$search' OR 
                   Country = '$search' OR  
                   A.Email = '$search' OR 
                   Institute = '$search' OR 
                   Batch = '$search' OR 
                   Section = '$search' OR
                   Age = '$search' OR
                   PostalCode = '$search' OR
                   DOB = '$search'";

    $result1 = mysqli_query($conn, $sql1);

    if ($result1) {
        while ($row = mysqli_fetch_array($result1, MYSQLI_NUM)) {
            echo "<tr class='search'>";
            foreach ($row as $cell) {
                echo "<th>$cell</th>";
            }
            echo "</tr>";
        }
    } else {
        die("Query failed: " . mysqli_error($conn));
    }
}

mysqli_close($conn);
?>

        </Table>
    </div>
</body>

</html>