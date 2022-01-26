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
        $type = $_GET['type'];  //From Account Type file Get Selected value.
        
        $ServerName = "WASEEMPC,1433";
        $connectioninfo = array("Database"=>"DB_Project","UID"=>"sa","PWD"=>"344673");
        $conn = sqlsrv_connect($ServerName,$connectioninfo);
        if($conn)
        {
            if(isset($_POST['button']))
            {
                $email = $_POST['Email'];
                $pass = $_POST['password'];
                
                $sql = "Select * from Account
                        where Email = '$email' AND Password = '$pass' AND Type = '$type'";
                $stmt = sqlsrv_query($conn,$sql);

                if(sqlsrv_fetch($stmt) == true)
                {
                    if($type == 'Student')
                        header("Location:Student_DashBoard.php?email=$email");
                    else if($type == 'Faculty')
                        header("Location:Faculty_DashBoard.php?email=$email");
                    else
                        header("Location:Admin_DashBoard.php?email=$email");
                }
                else
                {
                    ?>
                    <style>
                        .incorrect{
                            color: red;
                            margin: -80px 0px 0px 70%;
                        }
                    </style>
                    <p class='incorrect'><?php echo "Email or Password is Incorrect"; ?></p> 
                    <?php
                }
            }
        }
    ?>
</body>
</html>