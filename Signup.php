
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "DB_Project";

// Establish connection
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    echo "Connection failed: " . mysqli_connect_error();
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST['ID'];
    $fname = $_POST['FName'];
    $lname = $_POST['LName'];
    $father_name = $_POST['father_name'];
    $age = $_POST['age'];
    $num = $_POST['num'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $postal_code = $_POST['postal_code'];
    $institute = $_POST['Institute'];
    $type = $_POST['type'];
    $email = $_POST['Email'];
    $pass = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    $DID = $_POST['DID'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    if ($pass !== $confirm) {
        die("Passwords do not match.");
    }

    

    $studentID = ($type == 'Student') ? $ID : NULL;
    $facultyID = ($type == 'Faculty') ? $ID : NULL;
    $adminID = ($type == 'Admin') ? $ID : NULL;

        if ($type == "Student") {
            $insertStudentSQL = "INSERT INTO Student (StdID, FirstName, LastName, FatherName, Age, Mobile_Number, City, Country, PostalCode, Institute, DOB, DeptID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CURDATE(), ?)";
            $stmtStudent = $conn->prepare($insertStudentSQL);
            $stmtStudent->bind_param("ssssissssss", $ID, $fname, $lname, $father_name, $age, $num, $city, $country, $postal_code, $institute, $DID);
            $stmtStudent->execute();
            $stmtStudent->close();
        }
        if ($type == "Faculty") {
            $insertFacultySQL = "INSERT INTO Faculty (FacID, FirstName, LastName, FatherName, Age, Mobile_Number, City, Country, PostalCode, Institute, DOB, DeptID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CURDATE(), ?)";
            $stmtFaculty = $conn->prepare($insertFacultySQL);
            $stmtFaculty->bind_param("ssssissssss", $ID, $fname, $lname, $father_name, $age, $num, $city, $country, $postal_code, $institute, $DID);
            $stmtFaculty->execute();
            $stmtFaculty->close();
        }
        if ($type == "Admin") {
            $insertAdminSQL = "INSERT INTO Admin (AdID, FirstName, LastName, FatherName, Age, Mobile_Number, City, Country, PostalCode, Institute, DOB) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CURDATE())";
            $stmtAdmin = $conn->prepare($insertAdminSQL);
            $stmtAdmin->bind_param("ssssisssss", $ID, $fname, $lname, $father_name, $age, $num, $city, $country, $postal_code, $institute);
            $stmtAdmin->execute();
            $stmtAdmin->close();
        }

        $account_sql = "INSERT INTO Account (Email, Password, confirm, Type, StdID, FacID, AdID) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($account_sql);
        $stmt->bind_param("sssssss", $email, $pass, $confirm, $type, $studentID, $facultyID, $adminID);
        
        if ($stmt->execute()) {
            echo "Account created successfully!";
            header("Location: Admin_Dashboard.php?email=$email");
        } else {
            echo "Error: " . $stmt->error;
        }
    $stmt->close();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="Signup.css">
</head>
<body>
    <div class="body">

    
    <div class="container">
        <h1>SignUp Form</h1>
        <hr>
        <form method="post">
            
            <label for="ID">ID</label>
            <input type="text" class="input" id="ID" name="ID" placeholder="Enter Your ID">

            <label for="FirstName">FirstName</label>
            <input type="text" class="input" id="FirstName" name="FName" placeholder="Enter Your Name">
            
            <label for="LastName">LastName</label>
            <input type="text" class="input" id="LastName" name="LName" placeholder="Enter Your Last Name">

            <label for="father_name">Father Name</label>
            <input type="text" class="input" name="father_name" id="father_name" placeholder="Enter Your Father Name">

            <label for="age">Age</label>
            <input type="number" class="input" name="age" id="age" placeholder="Enter Your Age">

            <label for="num">Mobile Number</label>
            <input type="number" class="input" name="num" id="num" placeholder="Enter Your Mobile Number">

            <label for="city">City</label>
            <input type="text" class="input" name="city" id="city" placeholder="Enter Your City Name">

            <label for="country">Country</label>
            <input type="text" class="input" name="country" id="country" placeholder="Enter Your Country Name">

            <label for="postal_code">Postal Code</label>
            <input type="number" class="input" name="postal_code" id="postal_code" placeholder="Enter Postal Code">

            <label for="DID">Department ID</label>
            <input type="text" class="input" id="DID" name="DID" placeholder="Enter Department ID">

            <label for="Institute">Institute</label>
            <select name="Institute" id="Institute" class="input">
                <option value="none">Choose Institute</option>
                <option value="H12">NUST_H12</option>
                <option value="MCS">MCS</option>
                <option value="EME">EME</option>
            </select>

            <label for="type">Account Type</label>
            <select name="type" id="type" class="input">
                <option value="none">Choose Account Type</option>
                <option value="Student">Student</option>
                <option value="Admin">Admin</option>
                <option value="Faculty">Faculty</option>
            </select>

            <label for="Email">Email</label>
            <input type="text" class="input" id="Email" name="Email" placeholder="Enter Your Email">
            
            <label for="Password">Password</label>
            <input type="password" class="input" name="password" id="Password" placeholder="Enter Your Password">
            
            <label for="Password">Confirm Password</label>
            <input type="password" class="input" name="confirm_password" id="Password" placeholder="Re-Enter Your Password">

            <input type="submit" name="button" class="input" id="button" value="SignUp">
            <a href="Admin_DashBoard.php?email=?email=<?php echo $_GET['email']; ?>" id="account">Already have an account</a>
        </form>
    </div>
</body>
</html>

