<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Signup.css">
</head>
<body>
    <div class="container">
        <h1>Login Form</h1>
            <a href="signup.php" class="h1">SignUp</a>
            <a href="Login.php" class="h1">Login</a>
        <hr>
        <form action="" method="post">

            <label for="Email">Email</label>
            <input type="text" class="input" id="Email" name="Email" placeholder="Enter Your Email">
    
            <label for="Password">Password</label>
            <input type="password" class="input" name="password" id="Password" placeholder="Enter Your Password">
    
            <input type="submit" name="button" class="input" id="button" value="Login">
            <a href="signup.php" id="account">don't have an account</a>

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
            $email = $_POST['Email'];
            $pass = $_POST['password'];
            $sql = "Select Email,Password from Signup
                    where Email = '$email' and Password = '$pass'";
            $stmt = sqlsrv_query($conn,$sql);
            if(!$stmt)
            {
                echo "Query Not executed.";
                // die(print_r(sqlsrv_errors(),true));
            }
            else
            {
                if(sqlsrv_fetch($stmt) == true)
                {
                    header("Location: DashBoard.html");
                }
                else
                {
                    echo "Email or Password is incorrect.";
                }
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