<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Course Record</title>
    <link rel="stylesheet" href="Student_Record.css">
</head>

<body>
    <div class="container">
        <div class="nav">
            <h1>Student Course Record</h1>
            <form class="search" method="post">
                <input type="submit" value="Show All" name="show">
                <input type="search" name="search" id="search">
                <input type="submit" name="submit" id="submit" value="Search">
            </form>
        </div>

        <Table>
            <tr id='Main'>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Course Start Date</th>
                <th>Course End Date</th>
            </tr>

<?php

$serverName = "WaseemPC";
$connectioninfo = array("DataBase"=>"DB_Project" , "UID"=>"sa", "PWD"=>"344673");
$conn = sqlsrv_connect( $serverName, $connectioninfo );

if($conn)
{
    if(isset($_POST['submit'])==false)  //Default and Show All Condition
    {

        sqlsrv_query($conn,"Alter Table Std_Crs
        Alter Column Crs_Start_Date varchar(20)");
        sqlsrv_query($conn,"Alter Table Std_Crs
        Alter Column Crs_End_Date varchar(20)");

        $sql = "Select SC.StdID,S.FirstName,SC.CrsID,C.CrsName,SC.Crs_Start_Date,SC.Crs_End_Date
         from Std_Crs as SC
         inner join Student as S
         on S.StdID = SC.StdID
         inner join Course as C
         on C.CrsID = SC.CrsID";
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
                    <th><?php echo $row[4]; ?></th>
                    <th><?php echo $row[5]; ?></th>
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


            $sql1 = "Select SC.StdID,S.FirstName,SC.CrsID,C.CrsName,SC.Crs_Start_Date,SC.Crs_End_Date
            from Std_Crs as SC
            inner join Student as S
            on S.StdID = SC.StdID
            inner join Course as C
            on C.CrsID = SC.CrsID
            where 
            SC.StdID = '$search' OR
            S.FirstName = '$search' OR
            SC.CrsID = '$search' OR 
            C.CrsName = '$search' OR 
            SC.Crs_Start_Date = '$search' OR 
            SC.Crs_End_Date = '$search';";
            
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
                <th><?php echo $row[4]; ?></th>
                <th><?php echo $row[5]; ?></th>
            </tr>

<?php
                    }
                }
                else
                {
                    die( print_r( sqlsrv_errors(), true) );
                }
                sqlsrv_query($conn,"Alter Table Std_Crs
                Alter Column Crs_Start_Date date");
                sqlsrv_query($conn,"Alter Table Std_Crs
                Alter Column Crs_End_Date date");
        }
}
?>
        </Table>
    </div>
</body>

</html>