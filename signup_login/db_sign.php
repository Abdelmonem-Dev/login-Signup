<?php
include '../db/db.php';

if (isset($_POST['uname']) && isset($_POST['email']) && isset($_POST['pass'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $uname = validate($_POST['uname']);
    $email = validate($_POST['email']);
    $pass = validate($_POST['pass']);
    $pass = sha1($pass);
}

if (empty($uname)) {
    header("Location: index1.php");
    exit();
} else if (empty($email)) {
    header("Location: index1.php");
    exit();
} else if (empty($pass)) {
    header("Location: index1.php");
    exit();
}

$sql = "INSERT INTO users (uname,email,pass)
    values('$uname','$email','$pass')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

header('location: ../home/home.php');
exit();
