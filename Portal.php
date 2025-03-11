<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Portal</title>
    <link rel="stylesheet" href="Portal.css">
</head>

<body>
    <div class="container">
        <nav class="logo">
            <img src="/DB_Project/Images/LMS Logo.png" alt="Loading" height="70px">
            <div class="right">
                <span id='currentDate'></span>
            </div>
        </nav>

        <section>
            <form action="" method="post" class="login">
                <h3>Access to the platform</h3>
                <label for="Email">Email</label>
                <input type="text" class="input" id="Email" name="Email" placeholder="Enter Your Email">
        
                <label for="Password">Password</label>
                <input type="password" class="input" name="password" id="Password" placeholder="Enter Your Password">
        
                <input type="submit" name="button" class="input" id="button" value="Login">
            </form>
        </section>
    </div>

    <script>
        let t = new Date();
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        document.getElementById("currentDate").innerHTML = monthNames[t.getMonth()] + ", " + t.getDate() + " " + t.getFullYear() + " " + t.getHours() + ":" + t.getMinutes() + ":" + t.getSeconds();
    </script>
    
<?php
    $type = isset($_GET['type']) ? $_GET['type'] : '';

    $servername = "localhost";
    $username = "root"; // Change if needed
    $password = ""; // Change if needed
    $dbname = "DB_Project";

    // Establish connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['button'])) {
        $email = $_POST['Email'];
        $pass = $_POST['password'];

        // Use prepared statement
        $sql = "SELECT * FROM Account WHERE Email = ? AND Password = ? AND Type = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $email, $pass, $type);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                if ($type == 'Student') {
                    header("Location: Student_DashBoard.php?email=$email");
                } elseif ($type == 'Faculty') {
                    header("Location: Faculty_DashBoard.php?email=$email");
                } else {
                    header("Location: Admin_DashBoard.php?email=$email");
                }
                exit();
            } else {
                echo "<p class='incorrect' style='color: red; margin: -80px 0px 0px 70%;'>Email or Password is Incorrect</p>";
            }
        } else {
            die("Query preparation failed: " . mysqli_error($conn));
        }
    }

    mysqli_close($conn);
?>
</body>
</html>

