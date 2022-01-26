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
                <li class="list" id="list-2" onmouseover="showtext(2)" onmouseout="hidetext(2)"><a href="Student_DashBoard.php?email=$email"><img
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

                <img src="LMS Logo.png" alt="Loading">

                <div class="right">
                    <span id='currentDate'></span>
                </div>
            </div>
            <div class="profile">
                <img src="" alt="Add Pic">
                <span>Waseem Shahzad</span>
            </div>
            <div class="edit">
                <span>Waseem Shahzad</span>
                <div class="input">
                    <label for="ID">ID Number</label>
                    <input type="number" name="ID" id="ID">

                    <label for="fname">First Name</label>
                    <input type="text" name="fname" id="fname">

                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname">

                    <label for="father_name">Father Name</label>
                    <input type="text" name="father_name" id="father_name">

                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email">

                    <label for="city">City/Town</label>
                    <input type="text" name="city" id="city">

                    <label for="country">Counrty</label>
                    <input type="text" id="country" name="country">

                    <label for="current_pic">Current Picture</label>
                    <img src="" alt="Loading">
                    <label for="pic">Add Picture</label>
                    <input type="file" name="pic" id="pic">


                    <label for="institute">Institute</label>
                    <input type="text" id="institute" name="institute">

                    <label for="dept">Department</label>
                    <input type="text" name="dept" id="dept">

                    <label for="number">Mobile Number</label>
                    <input type="number" name="number" id="number">

                    <label for="batch">Batch</label>
                    <input type="text" name="batch" id="batch">

                    <label for="section">Section</label>
                    <input type="text" name="section" id="section">
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