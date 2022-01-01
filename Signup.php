<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="Signup.css">
</head>
<body>
    <div class="container">
        <h1>SignUp Form</h1>
        <a href="signup.php" class="h1">SignUp</a>
        <a href="Login.php" class="h1">Login</a>
        <hr>
        <form method="post">
            
            <label for="FirstName">FirstName</label>
            <input type="text" class="input" id="FirstName" name="FName" placeholder="Enter Your Name">
            
            <label for="LastName">LastName</label>
            <input type="text" class="input" id="LastName" name="LName" placeholder="Enter Your Last Name">
            
            <label for="Email">Email</label>
            <input type="text" class="input" id="Email" name="Email" placeholder="Enter Your Email">
            
            <label for="Password">Password</label>
            <input type="password" class="input" name="password" id="Password" placeholder="Enter Your Password">
            
            <label for="Password">Confirm Password</label>
            <input type="password" class="input" name="confirm_password" id="Password" placeholder="Re-Enter Your Password">
            
            <input type="submit" name="button" class="input" id="button" value="SignUp">
            <a href="Login.php" id="account">Already have an account</a>
        </form>
    </div>

    <?php
    $ServerName = "WASEEMPC,1433";
    $connectioninfo = array("Database"=>"DB_Project","UID"=>"sa","PWD"=>"344673");
    $conn = sqlsrv_connect($ServerName,$connectioninfo);
    if($conn)
    {
        if(isset($_POST['button']))
        {
            $fname = $_POST['FName'];
            $lname = $_POST['LName'];
            $email = $_POST['Email'];
            $pass = $_POST['password'];
            $confirm = $_POST['confirm_password'];
            $sql = "insert into Signup values('$fname','$lname','$email','$pass','$confirm');";
            $stmt = sqlsrv_query($conn,$sql);
            if($stmt==true)
            {
                header("Location: Login.php");
            }
            else
            {
                echo "Query Not executed.";
                // die(print_r(sqlsrv_errors(),true));
            }
        }
    }
    else
    {
        die(print_r(sqlsrv_errors(),true));
    }
    ?>
</body>
</html>
