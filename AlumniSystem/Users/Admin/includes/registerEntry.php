<?php
include '../../../includes/conn.php';
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Approve Registrations</title>
            <link rel="stylesheet" href="../../../CSS/admin.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <script src="https://unpkg.com/htmx.org@2.0.4" integrity="sha384-HGfztofotfshcF7+8n44JQL2oJmowVChPTg48S+jvZoztPfvwD79OC/LTtG6dMp+" crossorigin="anonymous"></script>
            <script src="https://unpkg.com/htmx.org@2.0.4/dist/htmx.js" integrity="sha384-oeUn82QNXPuVkGCkcrInrS1twIxKhkZiFfr2TdiuObZ3n3yIeMiqcRzkIcguaof1" crossorigin="anonymous"></script>
            <script src="../../../js/admin.js"></script>
        </head>

        <body class="RegApBody">
            <button class="close-button" id="xReqBut">Return</button>
            <div class = "requestContainer" id="requestContainer">
                <div class="requestBox">
                    <div class="requestHeader">
                        <h3>Registration Requests</h3>
                    </div>
                    <br>
                    <div class="requestContent">
                        <table class="table align-middle mb-0 bg-white w-100">
                            <thead class="bg-light">
                                <tr class="HeadtableRow">
                                    <th class="nameTable">Name</th>
                                    <th>Student ID</th>
                                    <th>Sex</th>
                                    <th>Birthdate</th>
                                    <th>Email</th>
                                    <th>Grad. Year</th>
                                    <th>Department</th>
                                    <th>Program</th>
                                    <th class="actionsRow">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="requestTableBody">
                                <?php
                                    $sql = "SELECT * FROM registration_reqs WHERE Rstatus = 'FALSE'";
                                    $result = $conn->query($sql);
                                    
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                echo '
                                                    <tr class="tableRow">
                                                        <th class="nameTable">' . htmlspecialchars($row["lname"]) . ', ' . htmlspecialchars($row["mname"]) . ', ' . htmlspecialchars($row["fname"]) . '</th>
                                                        <th>' . htmlspecialchars($row["studentID"]) . '</th>
                                                        <th>' . htmlspecialchars($row["sex"]) . '</th>
                                                        <th>' . htmlspecialchars($row["birthdate"]) . '</th>
                                                        <th>' . htmlspecialchars($row["email"]) . '</th>
                                                        <th>' . htmlspecialchars($row["gradYear"]) . '</th>
                                                        <th>' . htmlspecialchars($row["department"]) . '</th>
                                                        <th>' . htmlspecialchars($row["program"]) . '</th>
                                                        <th>
                                                            <button class="AdmitBtn" data-studentid="' . htmlspecialchars($row["studentID"]) . '">Admit</button>
                                                            <button class="RejectBtn" id="RejectBtn">Reject</button>
                                                        </th>
                                                    </tr>
                                                    ';
                                            }
                                        } else {
                                            echo "No feeds found.";
                                        }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </body>
        <div class="LogoutPopup" id="ConfPopup">Confirm Admission?<br>
            <button class="LogoutButton LogoutYes" id="ConfirmAdmitBtn">Yes</button>
            <button class="LogoutButton" id="noConfirm">No</button>
        </div>
</html>
<script>
    let selectedStudentID = null; 
    
    document.getElementById('xReqBut').addEventListener('click', function () {
        location.href = "../index.php";
    });

    document.getElementById('noConfirm').addEventListener('click', function () {
        document.getElementById('ConfPopup').style.display = 'none';
        selectedStudentID = null;
    });

    document.querySelectorAll('.AdmitBtn').forEach(button => {
        button.addEventListener('click', function () {
            selectedStudentID = this.getAttribute('data-studentid');
            document.getElementById('ConfPopup').style.display = 'block';
        });
    });

    document.getElementById('ConfirmAdmitBtn').addEventListener('click', function () {
        if (!selectedStudentID) return;

        fetch('admit.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'studentID=' + encodeURIComponent(selectedStudentID)
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            document.getElementById('ConfPopup').style.display = 'none';
            selectedStudentID = null;
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>