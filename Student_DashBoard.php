<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student DashBoard</title>
    <link rel="stylesheet" href="Student_Dashboard.css">
</head>

<body>
    <div class="container">
        <nav>
            <ul>
                <li id="list-1"><img src="Icons/menu.png" alt="Loading"></li>
                <li class="list" id="list-2"><a href=""><img src="Icons/dashboard.png" alt="Loading"></a>
                    <p id="text-2">DashBoard</p>
                </li>
                <li class="list" id="list-3"><a href=""><img src="Icons/home.png" alt="Loading"></a>
                    <p id="text-3">Home</p>
                </li>
                <li class="list" id="list-4"><a href=""><img src="Icons/view-shedule.png" alt="Loading"></a>
                    <p id="text-4">Calendar</p>
                </li>
                <li class="list" id="list-5"><a href=""><img src="Icons/education.png" alt="Loading"></a>
                    <p id="text-5">My Courses</p>
                </li>
                <li class="list" id="list-6"><a href=""><img src="Icons/result.png" alt="Loading"></a>
                    <p id="text-6">Result</p>
                </li>
                <li class="list" id="list-7"><a href=""><img src="Icons/files.png" alt="Loading"></a>
                    <p id="text-7">Private Files</p>
                </li>
            </ul>
        </nav>

        <section>
            <div class="logo">
                <img src="/DB_Project/Images/LMS Logo.png" alt="Loading">
                <div class="right">
                    <span id='currentDate'></span>
                </div>
            </div>
            <div class="profile">
                <?php
                $email = $_GET['email'];
                $conn = new mysqli("localhost", "root", "", "DB_Project");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                $sql3 = "SELECT Std_Image FROM Student INNER JOIN Account ON Account.StdID = Student.StdID WHERE Account.Email = '$email' AND Account.type = 'Student'";
                $result3 = $conn->query($sql3);
                if ($result3->num_rows > 0) {
                    $row3 = $result3->fetch_assoc();
                ?>
                <img src="<?php echo $row3['Std_Image']; ?>" alt="Profile Picture">
                <?php }
                
                $sql = "SELECT FirstName, LastName FROM Student WHERE StdID = (SELECT StdID FROM Account WHERE Email = '$email' AND Type = 'Student')";
                $result = $conn->query($sql);
                $name = "";
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $name = $row["FirstName"] . " " . $row["LastName"];
                    }
                }
                ?>
                <span><?php echo $name; ?></span>
                <a href="/DB_Project/Student_Edit_Profile.php?email=<?php echo $email; ?>&type=Student"><input type="button" value="Edit Profile"></a>
            </div>
            <div class="courses">
                <span>Enrolled Subjects/Courses</span>
                <div class="subjects">
                <?php
                $sql1 = "SELECT StdID FROM Student WHERE FirstName = (SELECT FirstName FROM Student WHERE StdID = (SELECT StdID FROM Account WHERE Email = '$email' AND Type = 'Student'))";
                $result1 = $conn->query($sql1);
                $StdID = "";
                if ($result1->num_rows > 0) {
                    while ($row1 = $result1->fetch_assoc()) {
                        $StdID = $row1['StdID'];
                    }
                }
                
                $sql2 = "SELECT Course.CrsName, Course.CreditHours, Faculty.FirstName, Faculty.LastName, Fac_Sec.ClassName, Fac_Sec.Class_Start_Time, Fac_Sec.Class_end_Time FROM Course INNER JOIN Std_Crs ON Std_Crs.CrsID = Course.CrsID INNER JOIN Fac_Crs ON Course.CrsID = Fac_Crs.CrsID INNER JOIN Faculty ON Faculty.FacID = Fac_Crs.FacID INNER JOIN Fac_Sec ON Fac_Sec.FacID = Faculty.FacID WHERE Std_Crs.StdID = '$StdID'";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                ?>
                <div class="subject">
                    <p id="Crs"><?php echo $row2['CrsName']; ?></p>
                    <p>Credit Hours: <?php echo $row2['CreditHours']; ?></p>
                    <p>Instructor: <?php echo $row2['FirstName'] . " " . $row2['LastName']; ?></p>
                    <p>Class Name: <?php echo $row2['ClassName']; ?></p>
                    <p>Start Time: <?php echo $row2['Class_Start_Time']; ?></p>
                    <p>End Time: <?php echo $row2['Class_end_Time']; ?></p>
                </div>
                <?php
                    }
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
        document.getElementById("currentDate").innerHTML = new Date().toLocaleString();
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
