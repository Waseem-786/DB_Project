<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Record</title>
    <link rel="stylesheet" href="Student_Record.css">
</head>

<body>
    <div class="container">
        <div class="nav">
            <h1>Course Record</h1>
            <form class="search" method="post">
                <input type="submit" value="Show All" name="show">
                <input type="search" name="search" id="search">
                <input type="submit" name="submit" id="submit" value="Search">
            </form>
        </div>

        <Table>
            <tr id='Main'>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Credit Hours</th>
                <th>Pre Req</th>
            </tr>

<?php

$serverName = "WaseemPC";
$connectioninfo = array("DataBase"=>"DB_Project" , "UID"=>"sa", "PWD"=>"344673");
$conn = sqlsrv_connect( $serverName, $connectioninfo );

if($conn)
{
    if(isset($_POST['submit'])==false)  //Default and Show All Condition
    {

        $sql = "Select * from Course";
        $stmt = sqlsrv_query($conn,$sql);
        if($stmt)
        {
            while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) )
            {
    
?>
                <tr class='row'>
                    <th><?php echo $row[0]; ?></th>
                    <th><?php echo $row[1]; ?></th>
                    <th><?php echo $row[2]; ?></th>
                    <th><?php echo $row[3]; ?></th>
                </tr>

<?php
            }
        }
        else
        {
            die( print_r( sqlsrv_errors(), true) );
        }
    }
?>


<?php
    if(isset($_POST['submit']))
        {
            $search = $_POST['search'];

            sqlsrv_query($conn,"Alter Table Course
            Alter Column CreditHours varchar(10)");

            $sql1 = "Select * from Course
            where 
            CrsID = '$search' OR 
            CrsName = '$search' OR 
            CreditHours = $search OR 
            Pre_Req = '$search';";
            
            $stmt1 = sqlsrv_query($conn,$sql1);

                if($stmt1==true)
                {
?>
            <style>
                .row {
                    display: none;
                }
            </style>
<?php                    
                    while( $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_NUMERIC) )
                    {
?>
            <tr class='search'>
                <th><?php echo $row[0]; ?></th>
                <th><?php echo $row[1]; ?></th>
                <th><?php echo $row[2]; ?></th>
                <th><?php echo $row[3]; ?></th>
            </tr>

<?php
                    }
                }
                else
                {
                    die( print_r( sqlsrv_errors(), true) );
                }
                sqlsrv_query($conn,"Alter Table Course
                Alter Column CreditHours int");
        }
}
?>
        </Table>
    </div>
</body>

</html>