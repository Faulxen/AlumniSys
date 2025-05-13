<?php
include '../../../includes/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['studentID'])) {
    $studentID = mysqli_real_escape_string($conn, $_POST['studentID']);

    $sql = "UPDATE registration_reqs SET Rstatus = 'TRUE' WHERE studentID = '$studentID'";
    if ($conn->query($sql) === TRUE) {

        $sql2 = "SELECT * FROM registration_reqs WHERE studentID = '$studentID'";
        $result = $conn->query($sql2);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $firstName = $row['fname'];
            $middleName = $row['mname'];
            $lastName = $row['lname'];
            $email = $row['email'];
            $sex = $row['sex'];
            $birthdate = $row['birthdate'];
            $gradYear = $row['gradYear'];
            $department = $row['department'];
            $program = $row['program'];
            $passcode = $row['passcode'];

            $sql3 = "INSERT INTO studentinfo (fname, mname, lname, email, sex, bdate, program, department, gradyear, passcode)
                     VALUES ('$firstName', '$middleName', '$lastName', '$email', '$sex', '$birthdate', '$program', '$department', '$gradYear', '$passcode')";

            if ($conn->query($sql3) === TRUE) {
                echo "Student info inserted successfully.";
            } else {
                echo "Error inserting student info: " . $conn->error;
            }

        } else {
            echo "Student record not found.";
        }

    } else {
        echo "Error updating status: " . $conn->error;
    }

} else {
    echo "Invalid request.";
}

$conn->close();
?>
