<?php
session_start();

include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = isset($_POST["userName"]) ? $_POST["userName"] : '';
    $middleName = isset($_POST["userMName"]) ? $_POST["userMName"] : '';
    $lastName = isset($_POST["userLName"]) ? $_POST["userLName"] : '';
    $sex = isset($_POST["sex"]) ? $_POST["sex"] : '';
    $email = isset($_POST["userEmail"]) ? $_POST["userEmail"] : '';
    $birthdate = isset($_POST["bdate"]) ? $_POST["bdate"] : '';
    $studentID = isset($_POST["oldID"]) ? $_POST["oldID"] : '';
    $gradYear = isset($_POST["gradyear"]) ? $_POST["gradyear"] : '';
    $department = isset($_POST["dept"]) ? $_POST["dept"] : '';
    $program = isset($_POST["prog"]) ? $_POST["prog"] : '';
    $password = isset($_POST["userPassReg"]) ? $_POST["userPassReg"] : '';
    $confirmPassword = isset($_POST["CuserPass"]) ? $_POST["CuserPass"] : '';


    if (empty($firstName) || empty($middleName)|| empty($lastName) || empty($sex)|| empty($email) || empty($birthdate) || empty($studentID) || empty($password) || empty($confirmPassword)) {
        echo "<p>All fields are required!</p>";
        exit();
    }

    if ($password !== $confirmPassword) {
        echo "<p>Passwords do not match!</p>";
        exit();
    }

    $sqlCheckEmail = "SELECT * FROM studentinfo WHERE email = '$email'";
    $resultEmailCheck = $conn->query($sqlCheckEmail);
    if ($resultEmailCheck->num_rows > 0) {
        echo "<p>Email is already registered!</p>";
        exit();
    }

    $sqlInsert = "INSERT INTO registration_reqs (fname, mname, lname, email, sex, birthdate, studentID, gradyear, department, program, passcode) 
                  VALUES ('$firstName', '$middleName', '$lastName', '$email', '$sex', '$birthdate', '$studentID', '$gradYear', '$department', '$program', '$password')";

    if ($conn->query($sqlInsert) === TRUE) {
        echo "
        <div id='RegToast' class='toastreg' role='alert' aria-live='assertive' aria-atomic='true'>
            <div class='d-flex'>
                <div class='toast-body'>
                    <p>Registration Successful! You may now exit the page and wait for the email confirmation within 1-3 business days.</p>
                </div>
            </div>
        </div>
        ";
        exit();
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>
