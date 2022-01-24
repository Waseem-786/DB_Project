<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <link rel="stylesheet" href="Signup.css">
</head>
<body>
    <div class="body">
    
    <div class="container">
        <h1>Delete Account</h1>
        <hr>
        <form method="post">
            
            <label for="StdID">ID</label>
            <input type="text" class="input" id="ID" name="ID" placeholder="Enter Your ID">

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
            
            <input type="submit" name="button" class="input" id="button" value="Delete">
            <a href="Admin_DashBoard.html" id="account">Don't want to delete</a>
        </form>
    </div>
</div>
    <?php
    $ServerName = "WASEEMPC,1433";
    $connectioninfo = array("Database"=>"DB_Project","UID"=>"sa","PWD"=>"344673");
    $conn = sqlsrv_connect($ServerName,$connectioninfo);
    if($conn)
    {
        if(isset($_POST['button']))
        {
            $ID = $_POST['ID'];
            $type = $_POST['type'];
            $email = $_POST['Email'];
            $pass = $_POST['password'];
            
            $sql = "Execute Delete_Account '$ID','$type','$email','$pass'";
            $stmt = sqlsrv_query($conn,$sql);
            
            if($stmt==true)
            {
                header("Location: Admin_Dashboard.html");
            }
            else
            {
                echo "Query Not executed.";
                die(print_r(sqlsrv_errors(),true));
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
