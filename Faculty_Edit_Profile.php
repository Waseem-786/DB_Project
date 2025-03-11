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
                    
                <li class="list" id="list-2" onmouseover="showtext(2)" onmouseout="hidetext(2)"><a href="Faculty_DashBoard.php?email=<?php echo $_GET['email']; ?>"><img
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

$ServerName = "localhost"; // Change to your MySQL host
$DBName = "DB_Project";
$Username = "root"; // Change to your MySQL username
$Password = ""; // Change to your MySQL password

$conn = mysqli_connect($ServerName, $Username, $Password, $DBName);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql3 = "SELECT Fac_Image FROM Faculty F
        INNER JOIN Account A ON A.FacID = F.FacID
        WHERE A.Email = '$email' AND A.type = 'Faculty'";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_array($result3);

$sql4 = "SELECT F.FirstName, F.LastName FROM Faculty F
        WHERE F.FacID = (SELECT A.FacID FROM Account A
                         WHERE A.Email = '$email' AND A.Type ='Faculty')";
$result4 = mysqli_query($conn, $sql4);

$name = "";
while ($row4 = mysqli_fetch_array($result4, MYSQLI_NUM)) {
    $name = $row4[0] . " " . $row4[1];
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
$sql = "SELECT FirstName, LastName, FatherName, Age, Mobile_Number, City, Country, PostalCode, Fac_Image, Institute, DOB, A.Email FROM Faculty F
        INNER JOIN Account A ON A.FacID = F.FacID
        WHERE email = '$email' AND type = '$type'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_NUM);
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
                 
                    <label for="DOB">Date of Birth</label>
                    <input type="date" name="DOB" id="DOB" value="<?php echo $row[10]; ?>">
                    
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="<?php echo $row[11]; ?>">
                    
                    <input type="submit" name="button" id="button" value="Update">
                </from>
            </div>
        </section>
    </div>
<?php
    if(isset($_POST['button']))
    {
        $sql1 = "SELECT FacID FROM Faculty WHERE FirstName = '$row[0]'";
        $result = mysqli_query($conn, $sql1);
        $FacID = mysqli_fetch_array($result);
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
        $DOB = $_POST['DOB'];
        $email_1 = $_POST['email'];

        $Img = "/DB_Project/Images/".$Img;

        // sqlsrv_configure('WarningsReturnAsErrors',0);


    
        $sql3 = "UPDATE Faculty SET FirstName = '$fname', LastName = '$lname', FatherName='$father_name', Age= $age, Mobile_Number='$num', City='$city', Country='$country', PostalCode = '$postal_code', Fac_Image = '$Img', DOB = '$DOB', Institute = '$institute' WHERE FacID = '$FacID[0]'";
        mysqli_query($conn, $sql3);
    
        $sql5 = "UPDATE Account SET Email = '$email_1' WHERE FacID = '$FacID[0]'";
        mysqli_query($conn, $sql5);
    }
    mysqli_close($conn);
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