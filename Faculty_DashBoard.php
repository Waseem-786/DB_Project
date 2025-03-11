<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty DashBoard</title>
    <link rel="stylesheet" href="Faculty_DashBoard.css">
</head>
<body>
    <div class="container">
        <div class="container">
            <nav>
                <ul>
                    <li id="list-1"><img src="Icons/menu.png" alt="Loading"></li>
                    <li class="list" id="list-2" onmouseover="showtext(2)" onmouseout="hidetext(2)"><a href=""><img
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
                                src="Icons/attendance.png" alt="Loading"></a>
                        <p id="text-5">Attendance</p>
                    </li>
                    <li class="list" id="list-6" onmouseover="showtext(6)" onmouseout="hidetext(6)"><a href=""><img
                                src="Icons/result.png" alt="Loading"></a>
                        <p id="text-6">Result</p>
                    </li>
    
                    <li class="list" id="list-7" onmouseover="showtext(7)" onmouseout="hidetext(7)"><a href=""><img
                                src="Icons/feedback.png" alt="Loading"></a>
                        <p id="text-7">Feedback</p>
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
<?php
$email = $_GET['email'];

$ServerName = "localhost"; // Update with MySQL server
$UserName = "root"; // Update with MySQL user
$Password = ""; // Update with MySQL password
$Database = "DB_Project";

// Connect to MySQL
$conn = mysqli_connect($ServerName, $UserName, $Password, $Database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch faculty image
$sql3 = "SELECT Fac_Image FROM Faculty F
        INNER JOIN Account A ON A.FacID = F.FacID
        WHERE A.Email = '$email' AND A.type = 'Faculty'";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_array($result3);

// Fetch faculty name
$sql = "SELECT F.FirstName, F.LastName FROM Faculty AS F
        WHERE F.FacID = (SELECT A.FacID FROM Account AS A
                         WHERE A.Email = '$email' AND A.Type = 'Faculty')";
$stmt = mysqli_query($conn, $sql);

$name = "";
if ($row = mysqli_fetch_assoc($stmt)) {
    $name = $row['FirstName'] . " " . $row['LastName'];

    // Fetch Faculty ID
    $sql1 = "SELECT FacID FROM Faculty WHERE FirstName = '{$row['FirstName']}'";
    $stmt1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($stmt1);
    $FacID = $row1['FacID'];
}

?>      
    <div class="profile">
        <img src="<?php echo $row3[0]; ?>" alt="Add Pic">
        <span><?php echo $name; ?></span>
        <a href="/DB_Project/Faculty_Edit_Profile.php?type=Faculty&email=<?php echo $email; ?>">
        <input type="button" value="Edit Profile">
    </a>
    </div>
    
    <div class="courses">
        <span>My Classes</span>
        <div class="subjects">
<?php
// Fetch faculty courses
$sql2 = "SELECT distinct FS.Batch, FS.Section, C.CrsName, FS.ClassName, FS.Class_Start_Time, FS.Class_end_Time 
         FROM Fac_Sec AS FS
         INNER JOIN Section AS S ON S.Batch = FS.Batch
         INNER JOIN Faculty AS F ON F.FacID = FS.FacID
         INNER JOIN Fac_Crs AS FC ON F.FacID = FC.FacID
         INNER JOIN Course AS C ON C.CrsID = FC.CrsID
         WHERE FS.FacID = '$FacID'";
$stmt2 = mysqli_query($conn, $sql2);

while ($row2 = mysqli_fetch_assoc($stmt2)) {
?>
    <div class="subject">
        <p id="section"><?php echo $row2['Batch'].$row2['Section'];?></p>
        <p> Subject : <?php echo $row2['CrsName']; ?></p>
        <p> Class : <?php echo $row2['ClassName']; ?></p>
        <p> Class Start Time : <?php echo $row2['Class_Start_Time']; ?></p>
        <p> Credit End Time : <?php echo $row2['Class_end_Time']; ?></p>
    </div>
<?php
}

?>

        </div>
    </div>
                <div id="Contact_us">
                    <div class="container">
                        <div class="info">
                            <h1>INFO</h1>
                        </div>
                        <div class="cont">
                            <h1>Contact us</h1>
                            <p>NUST - LMS @ SEECS NUST H-12 Islamabad</p>
                            <p>E-mail : lms@seecs.edu.pk</p>
                            <p>LMS Focal Person (Institute Wise)</p>
                        </div>
                        <div class="social_links">
                            <h1>Social Links</h1>
                        </div>
                    </div>
                    <div class="copy_right">
                        <p>2020 © NUST - LMS. All rights reserved.</p>
                    </div>
                </div>
            </section>
        </div>
    
    
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