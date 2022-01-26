<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Department</title>
    <link rel="stylesheet" href="Signup.css">
</head>
<body>
    <div class="body">

    
        <div class="container">
            <h1>Add Department in University</h1>
            <hr>
            <form method="post">
                
                <label for="DID">Department ID</label>
                <input type="text" class="input" id="DID" name="DID" placeholder="Enter Department ID">
    
                <label for="name">Department Name</label>
                <input type="text" class="input" id="name" name="name" placeholder="Enter Department Name">
                
                <label for="location">Location</label>
                <input type="text" class="input" id="location" name="location" placeholder="Enter Department Locatin">
                
                <input type="submit" name="button" class="input" id="button" value="Add Department">
                <a href="Admin_DashBoard.php" id="account">Don't Want to add Department</a>
            </form>
        </div>
    </div>

<?php
    
$serverName = "WaseemPC,1433";
$connectioninfo = array("DataBase"=>"DB_Project" , "UID"=>"sa", "PWD"=>"344673");
$conn = sqlsrv_connect( $serverName, $connectioninfo );
  
if($conn)
{
    if(isset($_POST['button']))
    {
        $DID = $_POST['DID'];
        $name = $_POST['name'];
        $location = $_POST['location'];

        $sql = "insert into Department values('$DID','$name','$location');";
        $stmt = sqlsrv_query($conn,$sql);
    }
    else
    {
        die(print_r(sqlsrv_errors(),true));
    }
}
?>
    
                
</body>
</html>