<?php

include 'conn.php';

$userid = $_POST['userNum'];
$pass = $_POST['userPass'];

$sql = "SELECT * FROM admin WHERE adminID= '$userid' AND adminPASS= '$pass'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "admin";
        } else {
            $sql = "SELECT * FROM studentinfo WHERE studentID= '$userid' AND passcode= '$pass'";
            $result2 = $conn->query($sql);
            if ($result2->num_rows > 0) {
                echo "student";
            } else {
                echo "invalid";
            }
        }
?>