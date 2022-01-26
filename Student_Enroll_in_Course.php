<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment</title>
    <link rel="stylesheet" href="Signup.css">
</head>
<body>
    <div class="body">

    
        <div class="container">
            <h1>Student Enrollment in Course</h1>
            <hr>
            <form method="post">
                
                <label for="StdID">ID</label>
                <input type="text" class="input" id="StdID" name="StdID" placeholder="Enter Student ID">
                
                <label for="CrsID">Course ID</label>
                <input type="text" class="input" id="CrsID" name="CrsID" placeholder="Enter Course ID">
    
                <label for="start">Course Start Date</label>
                <input type="date" class="input" id="start" name="start" placeholder="Enter Course Start Date">
                
                <label for="end">Course End Date</label>
                <input type="date" class="input" id="end" name="end" placeholder="Enter Course End Date">
                
                <input type="submit" name="button" class="input" id="button" value="Add Course">
                <a href="Admin_DashBoard.html" id="account">Don't Want to add Course</a>

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
        $StdID = $_POST['StdID'];
        $CrsID = $_POST['CrsID'];
        $start = $_POST['start'];
        $end = $_POST['end'];

        $sql = "insert into Std_Crs values('$StdID','$CrsID','$start','$end');";
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