<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Batch</title>
    <link rel="stylesheet" href="Signup.css">
</head>
<body>
    <div class="body">

    
        <div class="container">
            <h1>Add Batch in University</h1>
            <hr>
            <form method="post">
                
                <label for="batch">Batch</label>
                <input type="text" class="input" id="batch" name="batch" placeholder="Enter Batch Name">
    
                <label for="section">Default Section</label>
                <input type="text" class="input" id="section" name="section" placeholder="Enter Section Name">
                
                <label for="DID">Department ID</label>
                <input type="text" class="input" id="DID" name="DID" placeholder="Enter Department ID">
                
                <input type="submit" name="button" class="input" id="button" value="Add Batch">
                <a href="Admin_DashBoard.php" id="account">Don't Want to add Batch</a>
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
        $batch = $_POST['batch'];
        $section = $_POST['section'];
        $DID = $_POST['DID'];
        $sql = "insert into Batch values('$batch','$DID');";
        $stmt1 = sqlsrv_query($conn,$sql);

        $sql1 = "insert into Section values('$section','$batch');";
        $stmt = sqlsrv_query($conn,$sql1);
    }
    else
    {
        die(print_r(sqlsrv_errors(),true));
    }
}
?>
    
                
</body>
</html>