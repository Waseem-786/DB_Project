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
            
            <label for="StdID">ID</label>
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

            <label for="Institute">Institute</label>
            <input type="text" class="input" name="Institute" id="Institute" placeholder="Enter Your Institute name">

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
            <a href="Admin_DashBoard.html" id="account">Already have an account</a>
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
            
            
            $sql = "Execute Insert_Account '$ID','$fname','$lname','$father_name','$age','$num','$city','$country','$postal_code','$institute','$type','$email','$pass','$confirm';";
            $stmt = sqlsrv_query($conn,$sql);
            
            $errors = sqlsrv_errors();
            if($stmt==true || $error[ 'code'] == 0)
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
