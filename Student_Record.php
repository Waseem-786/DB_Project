<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Record</title>
    <link rel="stylesheet" href="Student_Record.css">
</head>

<body>
    <div class="container">
        <div class="nav">
            <h1>Student Record</h1>
            <form class="search" method="post">
                <input type="submit" value="Show All" name="show">
                <input type="search" name="search" id="search">
                <input type="submit" name="submit" id="submit" value="Search">
            </form>
        </div>

        <Table>
            <tr id='Main'>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Father Name</th>
                <th>Age</th>
                <th>Mobile Number</th>
                <th>City</th>
                <th>Country</th>
                <th>Postal Code</th>
                <th>Institute</th>
                <th>Batch</th>
                <th>Section</th>
                <th>Date of Birth</th>
                <th>Email</th>
            </tr>

<?php

$serverName = "WaseemPC";
$connectioninfo = array("DataBase"=>"DB_Project" , "UID"=>"sa", "PWD"=>"344673");
$conn = sqlsrv_connect( $serverName, $connectioninfo );

if($conn)
{
    if(isset($_POST['submit'])==false)  //Default and Show All Condition
    {

        $sql = "Select S.StdID,FirstName,LastName,FatherName,age,Mobile_Number,City,Country,PostalCode,Institute,DOB,Batch,Section,Email from Student as S 
        inner join Account as A
        on S.StdID = A.StdID";
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
                    <th><?php echo $row[8]; ?></th>
                    <th><?php echo $row[9]; ?></th>
                    <th><?php echo $row[10]; ?></th>
                    <th><?php echo $row[11]; ?></th>
                    <th><?php echo $row[12]; ?></th>
                    <th><?php echo $row[13]; ?></th>
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

            sqlsrv_query($conn,"Alter Table Student
            Alter Column Age varchar(10)");
            sqlsrv_query($conn,"Alter Table Student
            Alter Column PostalCode varchar(20)");
            sqlsrv_query($conn,"Alter Table Student
            Alter Column DOB varchar(20)");

            $sql1 = "Select S.StdID,FirstName,LastName,FatherName,age,Mobile_Number,City,Country,PostalCode,Institute,DOB,Batch,Section,Email from Student as S 
            inner join Account as A
            on S.StdID = A.StdID
            where 
            S.StdID = '$search' OR 
            FirstName = '$search' OR 
            LastName = '$search' OR 
            FatherName = '$search' OR  
            Mobile_Number = '$search' OR 
            City = '$search' OR 
            Country = '$search' OR  
            A.Email = '$search' OR 
            Institute = '$search' OR 
            Batch = '$search' OR 
            Section = '$search' OR
            Age = '$search' OR
            PostalCode = '$search' OR
            DOB = '$search';";
            
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
                <th><?php echo $row[8]; ?></th>
                <th><?php echo $row[9]; ?></th>
                <th><?php echo $row[10]; ?></th>
                <th><?php echo $row[11]; ?></th>
                <th><?php echo $row[12]; ?></th>
                <th><?php echo $row[13]; ?></th>
            </tr>

<?php
                    }
                }
                else
                {
                    die( print_r( sqlsrv_errors(), true) );
                }
                sqlsrv_query($conn,"Alter Table Student
                Alter Column Age int");
                sqlsrv_query($conn,"Alter Table Student
                Alter Column PostalCode int");
                sqlsrv_query($conn,"Alter Table Student
                Alter Column DOB Date");
        }
}
?>
        </Table>
    </div>
</body>

</html>