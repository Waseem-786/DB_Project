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
                <div class="profile">
                    <img src="/DB_Project/Images/Ali_Tahir.jpeg" alt="Add Pic">

<?php
$email = $_GET['email'];

$ServerName = "WASEEMPC,1433";
$connectioninfo = array("Database"=>"DB_Project","UID"=>"sa","PWD"=>"344673");
$conn = sqlsrv_connect($ServerName,$connectioninfo);
if($conn)
{
    $sql = "Select F.FirstName,F.LastName from Faculty as F
            where F.FacID = (Select A.FacID from Account as A
                            where A.Email = '$email' AND A.Type ='Faculty');";
    $stmt = sqlsrv_query($conn,$sql);
    
    $name = "";
    while( $row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_NUMERIC))
    {
        $name = $row[0];
        $name = $name." ";
        $name = $name.$row[1];
        $sql1 = "Select FacID from Faculty where FirstName = '$row[0]'";
        $stmt1 = sqlsrv_query($conn,$sql1);
    }

?>      
                    <span>
                        <?php echo $name; ?>
                    </span>
                    <a href="/DB_Project/Edit_Profile.html"><input type="button" value="Edit_Profile"></a>
    
                </div>
                <div class="courses">
                    <span>My Classes</span>
                    <div class="subjects">
<?php

while($row1 = sqlsrv_fetch_array($stmt1,SQLSRV_FETCH_NUMERIC))
{
    $FacID =  $row1[0];
}

$sql2 = "Select FS.Batch,FS.Section,C.CrsName,FS.ClassName,FS.Class_Start_Time,FS.Class_end_Time from Fac_Sec as FS
        inner join Section S
        on S.Batch = FS.Batch
        inner join Faculty as F
        on F.FacID = FS.FacID
        inner join Fac_Crs as FC
        on F.FacID = FC.FacID
        inner join Course as C
        on C.CrsID = FC.CrsID
        where FS.FacID = '$FacID';";
$stmt2 = sqlsrv_query($conn,$sql2);
while($row2 = sqlsrv_fetch_array($stmt2,SQLSRV_FETCH_NUMERIC))
{
?>
    <div class="subject">
        <p id="section"><?php echo $row2[0].$row2[1];?></p>
        <p> Subject : <?php echo $row2[2]; ?></p>
        <p> Class : <?php echo $row2[3]; ?></p>
        <p> Class Start Time : <?php echo $row2[4]; ?></p>
        <p> Credit End Time : <?php echo $row2[5]; ?></p>
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