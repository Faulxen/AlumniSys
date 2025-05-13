<?php
session_start();

include 'conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userNum = isset($_POST["userNum"]) ? $_POST["userNum"] : '';
    $userPass = isset($_POST["userPass"]) ? $_POST["userPass"] : '';

    

    if (empty($userNum) || empty($userPass)) {
        ?>
        <p>Inavlid username or password</p>
        <?php
    } else {


        $sql = "SELECT * FROM admin WHERE adminID= '$userNum' AND adminPASS= '$userPass'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            session_start();
            $_SESSION['logged-in-modal'] = "logged_in";
            $row = $result->fetch_assoc();
            $_SESSION['adminID'] = $row['adminID'];
            $_SESSION['adminName'] = $row['adminName'];
            $_SESSION['adminMName'] = $row['adminMName'];
            $_SESSION['adminLName'] = $row['adminLName'];
            $_SESSION['adminType'] = $row['adminType'];
            header("Location: ../Users/Admin/index.php");
            exit();
        }elseif($result->num_rows == 0){
            $sql = "SELECT * FROM studentinfo WHERE studentID= '$userNum' AND passcode= '$userPass'";
            $result2 = $conn->query($sql);
            if ($result2->num_rows > 0) {
                session_start();
                $_SESSION['logged-in-modal'] = "logged_in";
                $row = $result2->fetch_assoc();
                $_SESSION['department'] = $row['department'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['mname'] = $row['mname'];
                $_SESSION['lname'] = $row['lname'];
                $_SESSION['studentID'] = $row['studentID'];
                echo "<script>console.log('".$_SESSION['department']."');</script>";
                $dept = $row['department'];

                if(!isset($dept) || empty($dept) || $dept == "") {
                    echo "<script>alert('Invalid department');</script>";
                } else {
                    $_SESSION['logged-in-modal'] = "logged_in";
                    header("Location: ../Users/$dept/$dept.php");
                }

                exit();
            } else {
                ?>
                <p>Invalid username or password</p>
                <?php
            }
        }else{
            ?>
            <p>Inavlid username or password</p>
            <?php
        }
    }
}