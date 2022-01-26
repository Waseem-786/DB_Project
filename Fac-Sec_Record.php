<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Class Record</title>
    <link rel="stylesheet" href="Student_Record.css">
</head>

<body>
    <div class="container">
        <div class="nav">
            <h1>Faculty Class Record</h1>
            <form class="search" method="post">
                <input type="submit" value="Show All" name="show">
                <input type="search" name="search" id="search">
                <input type="submit" name="submit" id="submit" value="Search">
            </form>
        </div>

        <Table>
            <tr id='Main'>
                <th>Class Name</th>
                <th>Batch</th>
                <th>Section</th>
                <th>Faculty ID</th>
                <th>Faculty Name</th>
                <th>Course Name</th>
                <th>Class Start Time</th>
                <th>Class End Time</th>
            </tr>

<?php

$serverName = "WaseemPC";
$connectioninfo = array("DataBase"=>"DB_Project" , "UID"=>"sa", "PWD"=>"344673");
$conn = sqlsrv_connect( $serverName, $connectioninfo );

if($conn)
{
    if(isset($_POST['submit'])==false)  //Default and Show All Condition
    {

        sqlsrv_query($conn,"Alter Table Fac_Sec
        Alter Column Class_start_time varchar(20)");
        sqlsrv_query($conn,"Alter Table Fac_Sec
        Alter Column Class_end_time varchar(20)");

        $sql = "Select FS.ClassName,FS.Batch,FS.Section,FS.FacID,F.FirstName,C.CrsName,FS.Class_start_time,FS.Class_End_Time
         from Fac_Sec as FS
         inner join Faculty as F
         on F.FacID = FS.FacID
         inner join Fac_Crs as FC
         on FC.FacID = F.FacID
         inner join Course as C
         on C.CrsID = FC.CrsID";
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
                    <th><?php echo $row[6]; ?></th>
                    <th><?php echo $row[7]; ?></th>
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


            $sql1 = "Select FS.ClassName,FS.Batch,FS.Section,FS.FacID,F.FirstName,C.CrsName,FS.Class_start_time,FS.Class_End_Time
            from Fac_Sec as FS
            inner join Faculty as F
            on F.FacID = FS.FacID
            inner join Fac_Crs as FC
            on FC.FacID = F.FacID
            inner join Course as C
            on C.CrsID = FC.CrsID
            where 
            FS.ClassName = '$search' OR
            FS.Batch = '$search' OR
            FS.Section = '$search' OR 
            FS.FacID = '$search' OR 
            F.FirstName = '$search' OR 
            C.CrsName = '$search' OR
            FS.Class_start_time = '$search' OR
            FS.Class_end_time = '$search';";
            
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
                <th><?php echo $row[6]; ?></th>
                <th><?php echo $row[7]; ?></th>
            </tr>

<?php
                    }
                }
                else
                {
                    die( print_r( sqlsrv_errors(), true) );
                }
                sqlsrv_query($conn,"Alter Table Fac_Sec
                Alter Column Class_start_time time");
                sqlsrv_query($conn,"Alter Table Fac_Sec
                Alter Column Class_end_time time");
        }
}
?>
        </Table>
    </div>
</body>

</html>