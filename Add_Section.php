<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Section</title>
    <link rel="stylesheet" href="Signup.css">
</head>
<body>
    <div class="body">

    
        <div class="container">
            <h1>Add Section in Batch</h1>
            <hr>
            <form method="post">
                
                <label for="section">Section</label>
                <input type="text" class="input" id="section" name="section" placeholder="Enter Section name">
    
                <label for="batch">Batch</label>
                <input type="text" class="input" id="batch" name="batch" placeholder="Enter Batch Name">
                
                <input type="submit" name="button" class="input" id="button" value="Add Section">
                <a href="Admin_DashBoard.php" id="account">Don't Want to add Section</a>
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
        $section = $_POST['section'];
        $batch = $_POST['batch'];

        $sql = "insert into Section values('$section','$batch');";
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