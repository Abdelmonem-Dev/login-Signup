<?php
include '../db/db.php';

if (isset($_POST['email']) && isset($_POST['pass'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $pass = validate($_POST['pass']);
    $owner_pass = $pass;
    $pass = sha1($pass);

    if (empty($email) || empty($pass)) {
        header("Location: index.php");
        exit();
    }
    $sql = "SELECT * FROM users where email = '$email' and pass='$pass'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        echo "Logged In!";
        if ($email === "abd.almounam1@gmail.com" && $owner_pass === "1e2e3e4e%") {
            header("Location: ../home/owner.php");
        } else {
            header("Location: ../home/home.php");
        }
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
