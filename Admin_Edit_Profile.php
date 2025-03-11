<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="Edit_Profile.css">
</head>
<body>

    <div class="container">
        <nav>
            <ul>
                <li id="list-1"><img src="Icons/menu.png" alt="Loading"></li>
                    
                <li class="list" id="list-2" onmouseover="showtext(2)" onmouseout="hidetext(2)"><a href="Admin_DashBoard.php?email=<?php echo $_GET['email']; ?>"><img
                                src="Icons/dashboard.png" alt="Loading"></a>
                        <p id="text-2">DashBoard</p>
                    </li>
                <li class="list" id="list-3" onmouseover="showtext(3)" onmouseout="hidetext(3)"><a href=""><img
                            src="Icons/home.png" alt="Loading"></a>
                    <p id="text-3">Home</p>
                </li>
                <li class="list" id="list-4" onmouseover="showtext(4)" onmouseout="hidetext(4)"><a href=""><img
                            src="Icons/view-shedule.png" alt="Loading"></a>
                    <p id="text-4">Calender</p>
                </li>
                <li class="list" id="list-5" onmouseover="showtext(5)" onmouseout="hidetext(5)"><a href=""><img
                            src="Icons/education.png" alt="Loading"></a>
                    <p id="text-5">My Courses</p>
                </li>
                <li class="list" id="list-6" onmouseover="showtext(6)" onmouseout="hidetext(6)"><a href=""><img
                            src="Icons/result.png" alt="Loading"></a>
                    <p id="text-6">Result</p>
                </li>

                <li class="list" id="list-7" onmouseover="showtext(7)" onmouseout="hidetext(7)"><a href=""><img
                            src="Icons/files.png" alt="Loading"></a>
                    <p id="text-7">Private Files</p>
                </li>
            </ul>
        </nav>


        <section>
            <!-- This is Section -->
            <div class="logo">

                <img src="/DB_Project/Images/LMS Logo.png" alt="Loading">

                <div class="right">
                    <span id='currentDate'></span>
                </div>
            </div>
            <div class="profile">

<?php
$email = $_GET['email'];

$ServerName = "WASEEMPC,1433";
$connectioninfo = array("Database"=>"DB_Project","UID"=>"sa","PWD"=>"344673");
$conn = sqlsrv_connect($ServerName,$connectioninfo);
if($conn)
{
    $sql3 = "Select Ad_Image from Admin as Ad
            inner join Account as A
            on A.StdID = Ad.AdID
            where A.Email = '$email' and A.type = 'Admin';";
    $stmt3 = sqlsrv_query($conn,$sql3);
    $row3 = sqlsrv_fetch_array($stmt3);

    $sql4 = "Select Ad.FirstName,Ad.LastName from Admin as Ad
            where Ad.AdID = (Select A.AdID from Account as A
                            where A.Email = '$email' AND A.Type ='Admin');";
    $stmt4 = sqlsrv_query($conn,$sql4);
    
    $name = "";
    while( $row4 = sqlsrv_fetch_array($stmt4,SQLSRV_FETCH_NUMERIC))
    {
        $name = $row4[0];
        $name = $name." ";
        $name = $name.$row4[1];
    }
?>
                <img src="<?php echo $row3[0]; ?>" alt="Add Pic">
                <span><?php echo $name; ?></span>
            </div>
            <div class="edit">
                <span><?php echo $name; ?></span>
                <form class="input" method="post">


<?php
    $type = $_GET['type'];
        $sql = "Select FirstName,LastName,FatherName,Age,Mobile_Number,City,Country,PostalCode,Ad_Image,Institute,Ad.DOB,A.Email from Admin as Ad
                inner join Account as A
                on A.StdID = Ad.AdID
                where email = '$email' and type = '$type';";
        $stmt = sqlsrv_query($conn,$sql);
        if($stmt)
        {
            $row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_NUMERIC);
        }
        else
        {
            die(print_r(sqlsrv_errors(),true));
        }
    }
?>


                    <label for="fname">First Name</label>
                    <input type="text" name="fname" id="fname" value="<?php echo $row[0]; ?>">

                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname" value="<?php echo $row[1]; ?>">

                    <label for="father_name">Father Name</label>
                    <input type="text" name="father_name" id="father_name" value="<?php echo $row[2];?>">
                    
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" value="<?php echo $row[3]; ?>">

                    <label for="number">Mobile Number</label>
                    <input type="number" name="number" id="number" value="<?php echo $row[4]; ?>">

                    <label for="city">City/Town</label>
                    <input type="text" name="city" id="city" value="<?php echo $row[5]; ?>">
                    
                    <label for="country">Counrty</label>
                    <input type="text" id="country" name="country" value="<?php echo $row[6]; ?>">
                    
                    <label for="postal_code">Postal Code</label>
                    <input type="text" id="postal_code" name="postal_code" value="<?php echo $row[7]; ?>">

                    <label for="current_pic">Current Picture</label>
                    <img src="<?php echo $row[8]; ?>" alt="Loading" height=150px width=150px>
                    <label for="pic">Picture</label>
                    <input type="file" name="pic" id="pic" value="<?php echo $row[8]; ?>">
                    
                    <label for="institute">Institute</label>
                    <input type="text" id="institute" name="institute" value="<?php echo $row[9]; ?>">
                    
                    <label for="batch">Batch</label>
                    <input type="text" name="batch" id="batch" value="<?php echo $row[10]; ?>">
                    
                    <label for="section">Section</label>
                    <input type="text" name="section" id="section" value="<?php echo $row[11]; ?>">
<?php
sqlsrv_query($conn,"Alter Table Student Alter Column DOB varchar(10)");
?>                    
                    <label for="DOB">Date of Birth</label>
                    <input type="date" name="DOB" id="DOB" value="<?php echo $row[12]; ?>">
                    
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="<?php echo $row[13]; ?>">
                    
                    <input type="submit" name="button" id="button" value="Update">
                </from>
            </div>
        </section>
    </div>
<?php
    if(isset($_POST['button']))
    {
        $sql1 = "Select StdID from Student where FirstName = '$row[0]';";
        $stmt = sqlsrv_query($conn,$sql1);
        $StdID = sqlsrv_fetch_array($stmt);
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $father_name = $_POST['father_name'];
        $age = $_POST['age'];
        $num = $_POST['number'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $postal_code = $_POST['postal_code'];
        $Img = $_POST['pic'];
        $institute = $_POST['institute'];
        $batch = $_POST['batch'];
        $section = $_POST['section'];
        $DOB = $_POST['DOB'];
        $email_1 = $_POST['email'];

        $Img = "/DB_Project/Images/".$Img;
        
        sqlsrv_configure('WarningsReturnAsErrors',0);
        $sql3 = "update Student
        set FirstName = '$fname' , LastName = '$lname', FatherName='$father_name', Age= $age , Mobile_Number='$num', City='$city',Country='$country', PostalCode = $postal_code ,
        Std_Image = '$Img' , Institute = '$institute',Batch = '$batch',Section = '$section',DOB = '$DOB'
        where StdID = '$StdID[0]';";
        $stmt3 = sqlsrv_query($conn,$sql3);

        $sql5 = "Update Account
        set Email = '$email_1'
        where StdID = '$FacID[0]';";

        $stmt5 = sqlsrv_query($conn,$sql5);

        if($stmt3)
        {
            sqlsrv_query($conn,"Alter Table Student Alter Column DOB Date");
        }
        else
        {
            die(print_r(sqlsrv_errors(),true));
        }
    }
?>


    <script>
        let t = new Date();

        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        document.getElementById("currentDate").innerHTML = monthNames[t.getMonth()] + ", " + t.getDate() + " " + t.getFullYear() + " " + t.getHours() + ":" + t.getMinutes() + ":" + t.getSeconds();
    </script>

    <script>
        function showtext(a) {
            if (a == 2) {
                let para = document.getElementById('text-2');
                para.style.visibility = 'visible';
            }
            else if (a == 3) {
                let para = document.getElementById('text-3');
                para.style.visibility = 'visible';
            }
            else if (a == 4) {
                let para = document.getElementById('text-4');
                para.style.visibility = 'visible';
            }
            else if (a == 5) {
                let para = document.getElementById('text-5');
                para.style.visibility = 'visible';
            }
            else if (a == 6) {
                let para = document.getElementById('text-6');
                para.style.visibility = 'visible';
            }
            else if (a == 7) {
                let para = document.getElementById('text-7');
                para.style.visibility = 'visible';
            }
        }
        function hidetext(a) {
            if (a == 2) {
                let para = document.getElementById('text-2');
                para.style.visibility = 'hidden';
            }
            else if (a == 3) {
                let para = document.getElementById('text-3');
                para.style.visibility = 'hidden';
            }
            else if (a == 4) {
                let para = document.getElementById('text-4');
                para.style.visibility = 'hidden';
            }
            else if (a == 5) {
                let para = document.getElementById('text-5');
                para.style.visibility = 'hidden';
            }
            else if (a == 6) {
                let para = document.getElementById('text-6');
                para.style.visibility = 'hidden';
            }
            else if (a == 7) {
                let para = document.getElementById('text-7');
                para.style.visibility = 'hidden';
            }
        }
    </script>


</body>
</html>