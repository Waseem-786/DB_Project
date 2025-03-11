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

// Fetch batches
$batchQuery = "SELECT DISTINCT Batch FROM Batch";
$batchResult = mysqli_query($conn, $batchQuery);

// Fetch sections
$sectionQuery = "SELECT DISTINCT Section FROM Section";
$sectionResult = mysqli_query($conn, $sectionQuery);

// Fetch faculty
$facultyQuery = "SELECT FacID, CONCAT(FirstName, ' ', LastName) AS FacultyName FROM Faculty";
$facultyResult = mysqli_query($conn, $facultyQuery);

// Fetch courses
$courseQuery = "SELECT CrsID, CrsName FROM Course";
$courseResult = mysqli_query($conn, $courseQuery);

if (isset($_POST['button'])) {
    $cname = $_POST['cname'];
    $batch = $_POST['batch'];
    $section = $_POST['section'];
    $FID = $_POST['FID'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $CrsID = $_POST['CrsID'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    // Check if Faculty ID exists
    $checkFaculty = "SELECT FacID FROM Faculty WHERE FacID = '$FID'";
    $resultFaculty = mysqli_query($conn, $checkFaculty);

    if (mysqli_num_rows($resultFaculty) > 0) {
        // Faculty exists, proceed with the insertion
        $sql = "INSERT INTO Fac_Sec (ClassName, Batch, Section, FacID, Class_Start_Time, Class_End_Time) 
                VALUES ('$cname', '$batch', '$section', '$FID', '$start_time', '$end_time')";

        $sql1 = "INSERT INTO Fac_Crs (FacID, CrsID, Crs_Start_Date, Crs_End_Date) 
                VALUES ('$FID', '$CrsID', '$start', '$end')";

        if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql1)) {
            echo "Class and Course assigned successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "FacID: $FID";
        echo "batch: $batch";
        echo "section: $section";
        echo "Error: Faculty ID does not exist!";
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
    <title>Assignment of Classes</title>
    <link rel="stylesheet" href="Signup.css">
</head>
<body>
    <div class="body">
        <div class="container">
            <h1>Classes Assigned to Faculty</h1>
            <hr>
            <form method="post">
                
                <label for="cname">Class Name</label>
                <select name="cname" id="cname" class="input">
                    <option value="none">Choose Class</option>
                    <option value="CR_31">CR_31</option>
                    <option value="CR_32">CR_32</option>
                    <option value="CR_33">CR_33</option>
                    <option value="CR_34">CR_34</option>
                    <option value="CR_35">CR_35</option>
                    <option value="CR_36">CR_36</option>
                </select>
                
                <label for="batch">Batch</label>
                <select name="batch" id="batch" class="input">
                    <?php while ($row = mysqli_fetch_assoc($batchResult)) { ?>
                        <option value="<?php echo $row['Batch']; ?>"><?php echo $row['Batch']; ?></option>
                    <?php } ?>
                </select>

                <label for="section">Section</label>
                <select name="section" id="section" class="input">
                    <?php while ($row = mysqli_fetch_assoc($sectionResult)) { ?>
                        <option value="<?php echo $row['Section']; ?>"><?php echo $row['Section']; ?></option>
                    <?php } ?>
                </select>
                
                <label for="FID">Faculty</label>
                <select name="FID" id="FID" class="input">
                    <?php while ($row = mysqli_fetch_assoc($facultyResult)) { ?>
                        <option value="<?php echo $row['FacID']; ?>"><?php echo $row['FacultyName']; ?></option>
                    <?php } ?>
                </select>

                
                <label for="CrsID">Course</label>
                <select name="CrsID" id="CrsID" class="input">
                    <?php while ($row = mysqli_fetch_assoc($courseResult)) { ?>
                        <option value="<?php echo $row['CrsID']; ?>"><?php echo $row['CrsName']; ?></option>
                    <?php } ?>
                </select>
    
                <label for="start_time">Class Start Time</label>
                <input type="time" class="input" name="start_time" id="start_time">
                
                <label for="end_time">Class End Time</label>
                <input type="time" class="input" name="end_time" id="end_time">
    
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