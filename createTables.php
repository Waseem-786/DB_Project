<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "DB_Project";

// Establish connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to create table if not exists
function createTable($conn, $sql, $tableName) {
    if (mysqli_query($conn, $sql)) {
        //echo "Table $tableName created successfully or already exists.<br>";
    } else {
        echo "Error creating table $tableName: " . mysqli_error($conn) . "<br>";
    }
}

// SQL Queries to create tables
$tables = [
    "Department" => "CREATE TABLE IF NOT EXISTS Department (
        DeptID VARCHAR(10) PRIMARY KEY,
        DeptName VARCHAR(20),
        DeptLocation VARCHAR(20)
    )",
    "Batch" => "CREATE TABLE IF NOT EXISTS Batch (
        Batch VARCHAR(10) PRIMARY KEY,
        DeptID VARCHAR(10),
        FOREIGN KEY (DeptID) REFERENCES Department(DeptID)
    )",
    "Student" => "CREATE TABLE IF NOT EXISTS Student (
        StdID VARCHAR(10) PRIMARY KEY,
        FirstName VARCHAR(20),
        LastName VARCHAR(20),
        FatherName VARCHAR(20),
        Age INT,
        Mobile_Number VARCHAR(20),
        City VARCHAR(30),
        Country VARCHAR(20),
        PostalCode INT,
        Std_Image VARCHAR(100),
        Institute VARCHAR(10),
        Batch VARCHAR(10),
        Section VARCHAR(2),
        DOB DATE,
        DeptID VARCHAR(10),
        FOREIGN KEY (DeptID) REFERENCES Department(DeptID)
    )",
    "Faculty" => "CREATE TABLE IF NOT EXISTS Faculty (
        FacID VARCHAR(10) PRIMARY KEY,
        FirstName VARCHAR(20),
        LastName VARCHAR(20),
        FatherName VARCHAR(20),
        Age INT,
        Mobile_Number VARCHAR(20),
        City VARCHAR(30),
        Country VARCHAR(20),
        PostalCode INT,
        Fac_Image VARCHAR(100),
        Institute VARCHAR(10),
        DOB DATE,
        DeptID VARCHAR(10),
        FOREIGN KEY (DeptID) REFERENCES Department(DeptID)
    )",
    "Admin" => "CREATE TABLE IF NOT EXISTS Admin (
        AdID VARCHAR(10) PRIMARY KEY,
        FirstName VARCHAR(20),
        LastName VARCHAR(20),
        FatherName VARCHAR(20),
        Age INT,
        Mobile_Number VARCHAR(20),
        City VARCHAR(30),
        Country VARCHAR(20),
        PostalCode INT,
        Ad_Image VARCHAR(100),
        Institute VARCHAR(10),
        DOB DATE
    )",
    "Account" => "CREATE TABLE IF NOT EXISTS Account (
        Email VARCHAR(30) UNIQUE,
        Password VARCHAR(30) NOT NULL,
        confirm VARCHAR(30) NOT NULL,
        Type VARCHAR(20),
        StdID VARCHAR(10),
        FacID VARCHAR(10),
        AdID VARCHAR(10),
        FOREIGN KEY (FacID) REFERENCES Faculty(FacID),
        FOREIGN KEY (StdID) REFERENCES Student(StdID),
        FOREIGN KEY (AdID) REFERENCES Admin(AdID)
    )",
    "Course" => "CREATE TABLE IF NOT EXISTS Course (
        CrsID VARCHAR(10) PRIMARY KEY,
        CrsName VARCHAR(20),
        CreditHours INT,
        Pre_Req VARCHAR(10),
        FOREIGN KEY (Pre_Req) REFERENCES Course(CrsID)
    )",
    "Std_Crs" => "CREATE TABLE IF NOT EXISTS Std_Crs (
        StdID VARCHAR(10),
        CrsID VARCHAR(10),
        Crs_Start_Date DATE,
        Crs_End_Date DATE,
        FOREIGN KEY (StdID) REFERENCES Student(StdID),
        FOREIGN KEY (CrsID) REFERENCES Course(CrsID),
        PRIMARY KEY(StdID, CrsID)
    )",
    "Fac_Crs" => "CREATE TABLE IF NOT EXISTS Fac_Crs (
        FacID VARCHAR(10),
        CrsID VARCHAR(10),
        Crs_Start_Date DATE,
        Crs_End_Date DATE,
        FOREIGN KEY (FacID) REFERENCES Faculty(FacID),
        FOREIGN KEY (CrsID) REFERENCES Course(CrsID),
        PRIMARY KEY(FacID, CrsID)
    )",
    "Section" => "CREATE TABLE IF NOT EXISTS Section (
        Section CHAR(1),
        Batch VARCHAR(10),
        FOREIGN KEY (Batch) REFERENCES Batch(Batch),
        PRIMARY KEY(Batch, Section)
    )",
    "Fac_Sec" => "CREATE TABLE IF NOT EXISTS Fac_Sec (
        ClassName VARCHAR(10),
        Batch VARCHAR(10),
        Section CHAR(1),
        FacID VARCHAR(10),
        Class_Start_Time TIME,
        Class_End_Time TIME,
        FOREIGN KEY (Batch, Section) REFERENCES Section(Batch, Section),
        FOREIGN KEY (FacID) REFERENCES Faculty(FacID)
    )",
    "Messages" => "CREATE TABLE IF NOT EXISTS Messages (
        Sender_StdID VARCHAR(10),
        Sender_FacID VARCHAR(10),
        Sender_AdID VARCHAR(10),
        Messages VARCHAR(80),
        Receiver_StdID VARCHAR(10),
        Receiver_FacID VARCHAR(10),
        Receiver_AdID VARCHAR(10),
        FOREIGN KEY (Sender_FacID) REFERENCES Faculty(FacID),
        FOREIGN KEY (Sender_StdID) REFERENCES Student(StdID),
        FOREIGN KEY (Sender_AdID) REFERENCES Admin(AdID),
        FOREIGN KEY (Receiver_FacID) REFERENCES Faculty(FacID),
        FOREIGN KEY (Receiver_StdID) REFERENCES Student(StdID),
        FOREIGN KEY (Receiver_AdID) REFERENCES Admin(AdID)
    )"
];

// Execute all table creation queries
foreach ($tables as $tableName => $sql) {
    createTable($conn, $sql, $tableName);
}


// Insert a Default Admin Record if not exists
$adminId = "Admin";
$adminEmail = "admin@gmail.com";
$adminPassword = "admin"; // Change for better security (use hashed passwords)

// Insert into Admin table if not exists
$insertAdminSQL = "INSERT INTO Admin (AdID, FirstName, LastName, FatherName, Age, Mobile_Number, City, Country, PostalCode, Ad_Image, Institute, DOB) 
VALUES ('$adminId', 'Admin', 'User', 'Superuser', 35, '1234567890', 'Headquarters', 'CountryX', 12345, 'default_admin.jpg', 'HQ', '1985-01-01')
ON DUPLICATE KEY UPDATE AdID=AdID;";

if (mysqli_query($conn, $insertAdminSQL)) {
    //echo "Admin record exists or inserted successfully.<br>";
} else {
    echo "Error inserting admin: " . mysqli_error($conn) . "<br>";
}

// Insert into Account table if not exists
$insertAccountSQL = "INSERT INTO Account (Email, Password, confirm, Type, AdID) 
VALUES ('$adminEmail', '$adminPassword', '$adminPassword', 'Admin', '$adminId')
ON DUPLICATE KEY UPDATE Email=Email;";

if (mysqli_query($conn, $insertAccountSQL)) {
    //echo "Admin account exists or inserted successfully.<br>";
} else {
    echo "Error inserting admin account: " . mysqli_error($conn) . "<br>";
}



// Close connection
mysqli_close($conn);
?>

