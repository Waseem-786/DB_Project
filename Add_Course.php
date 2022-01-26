<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link rel="stylesheet" href="Signup.css">
</head>
<body>
    <div class="body">

    
        <div class="container">
            <h1>Add Course in University</h1>
            <hr>
            <form method="post">
                
                <label for="CrsID">Course ID</label>
                <input type="text" class="input" id="CrsID" name="CrsID" placeholder="Enter Course ID">
    
                <label for="CrsName">Course Name</label>
                <input type="text" class="input" id="CrsName" name="CrsName" placeholder="Enter Course Name">
                
                <label for="hours">Credit Hours</label>
                <select name="hours" id="hours" class="input">
                    <option value="none">Choose Credit Hours</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>

                <label for="P_CrsName">Pre-Req Course Name</label>
                <select name="P_CrsName" id="P_CrsName" class="input">
                    <option value="none">Choose Pre Req</option>
                    <option value="NULL">NULL</option>
                
<?php
    
$serverName = "WaseemPC,1433";
$connectioninfo = array("DataBase"=>"DB_Project" , "UID"=>"sa", "PWD"=>"344673");
$conn = sqlsrv_connect( $serverName, $connectioninfo );
  
if($conn)
{
    $sql = "Select distinct(CrsName) from Course ;";
    $stmt = sqlsrv_query($conn,$sql);
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) )
    {
        $name = $row[0];
?>
            <option value="<?php echo $name;?>"><?php echo $name;?></option>
<?php            
    }
?>

</select>
        <input type="submit" name="button" class="input" id="button" value="Add Course">
        <a href="Admin_DashBoard.html" id="account">Don't Want to add Course</a>

        </form>
    </div>
</div>

<?php    
    if(isset($_POST['button']))
    {
        $CrsID = $_POST['CrsID'];
        $CrsName = $_POST['CrsName'];
        $P_CrsName = $_POST['P_CrsName'];
        $hours = $_POST['hours'];

        $sql1 = "Select CrsID from Course where CrsName = '$P_CrsName';";
        $stmt1 = sqlsrv_query($conn,$sql1);
        while( $row1 = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_NUMERIC) )
        {
            $pre = $row1[0];
        }
        $sql3 = "insert into Course values('$CrsID','$CrsName',$hours,'$pre');";
        $stmt3 = sqlsrv_query($conn,$sql3);
    }
    else
    {
        die(print_r(sqlsrv_errors(),true));
    }
}
?>
    
        

                
                
</body>
</html>