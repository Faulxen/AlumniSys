<div>
        <!-- Modal -->
    <?php if (isset($_SESSION['logged-in-modal']) && $_SESSION['logged-in-modal'] == "logged_in"): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                $('#exampleModal').modal('show');
            }, 1000);
            });
            function clearSession() {
            <?php unset($_SESSION['logged-in-modal']); ?>
            }
        </script>
    <?php endif; ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Logged in Successfully</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Welcome Admin to the Dashboard
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="clearSession()">Okay</button>
                <script>
                    function clearSession() {
                        <?php unset($_SESSION['logged-in-modal']); ?>
                    }
                </script>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
<div class="d-flex">
    <nav class="sidebar d-flex flex-column flex-shrink-0 position-fixed" style="z-index: 1050;">
        <button class="toggle-btn" onclick="toggleSidebar()">
            <i class="fas fa-chevron-left"></i>
        </button>

        <div class="NavBarlogo">
            <div class="logo">
                <img src="../../images/logo.png" alt="Logo" width="100" height="100" class="logo-img">
            </div>
            <div class="NavBarlogoText hide-on-collapse">
                <p class="headerText">Pamantasan ng Lungsod ng Muntinlupa<br><span>CITCS Alumni Society</span></p>
            </div>
        </div>

        <div class="nav flex-column">
            <a href="#v-pills-home" class="sidebar-link active text-decoration-none p-3" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                <i class="fas fa-home me-3"></i>
                <span class="hide-on-collapse">Home</span>
            </a>
            <a href="#v-pills-profile" class="sidebar-link text-decoration-none p-3" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                </i><i class="fas fa-box me-3"></i>
                <span class="hide-on-collapse">Bulletin</span>
            </a>
            <a href="#v-pills-messages" class="sidebar-link text-decoration-none p-3" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                <i class="fas fa-users me-3"></i>
                <span class="hide-on-collapse">Accounts</span>
            </a>
            <a href="#v-pills-settings" class="sidebar-link text-decoration-none p-3" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                <i class="fas fa-gear me-3"></i>
                <span class="hide-on-collapse">Settings</span>
            </a>
        </div>

        <div class="profile-section mt-auto p-4">
            <div class="d-flex align-items-center">
                <img src="../../../images/user_icon.png" style="height:60px" class="rounded-circle ayatoprof" alt="Profile">
                <div class="ms-3 profile-info">
                    <h6 class="text-white mb-0">
                        <?php
                            echo $_SESSION['adminName'] . " " . $_SESSION['adminLName'];
                        ?>
                    </h6>
                    <small class="text-muted">
                        <?php
                            echo $_SESSION['adminType'];
                        ?>
                    </small>
                </div>
            </div>
        </div>
    </nav>

    <main class="main-content w-100 p-0 z-index-0 pos-rel">
        <div class="container-fluid p-0 m-0">
            <nav class="navbar navbar-dark w-100" style="background: linear-gradient(135deg, #1C1F22 0%, #1C1F22 100%);">
                <h3 class="acceslvl">
                    <?php
                    echo $_SESSION['adminType'] . " Level Access";
                    ?>
                </h3>
                <h2 class="h-10 w-20 p-0-10" style="color:#476F30"></h2>
                <div style="display: flex; align-items: center; gap: 10px;">
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle border border-white" style="background: #476F30" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Notifications <span class="badge badge-light" id="notif-badge">
                <input type="hidden" name="notif-badge" id="notif-badge-adminID" value="1">
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item" type="button">Action</button>
            <button class="dropdown-item" type="button">Another action</button>
            <button class="dropdown-item" type="button">Something else here</button>
            <div class="dropdown-divider"></div>
            <button class="dropdown-item" type="button">See more...</button>
        </div>
    </div>
    <div>
    <a href="../../includes/logout.php" class="btn btn-primary border border-white" style="background: #476F30">Logout</a>
    </div>
</div>

            </nav>

<script>
    //make a function that lively updates the notification badge without using api and use ajax
    //dom onload
    

    document.addEventListener("DOMContentLoaded", function () {
        setInterval(function () {
            const xhttp = new XMLHttpRequest();
            const adminID = document.getElementById("notif-badge-adminID").value;

            xhttp.onload = function () {
                if (this.status === 200) {
                    const res = JSON.parse(this.response);
                    console.log(res);
                    if (res.error) {
                        console.error(res.error);
                        return;
                    }
                    if (res.rows && res.rows.length > 0) {
                        document.getElementById("notif-badge").innerText = res.rows.length;

                        // Optionally, update the dropdown with notification details
                        const dropdownMenu = document.querySelector(".dropdown-menu");
                        dropdownMenu.innerHTML = ""; // Clear existing items

                        res.rows.forEach(row => {
                            const notificationItem = document.createElement("button");
                            notificationItem.className = "dropdown-item";
                            notificationItem.type = "button";
                            notificationItem.textContent = `${row[2]}: ${row[3]} (${row[4]})`;
                            dropdownMenu.appendChild(notificationItem);
                        });

                        const divider = document.createElement("div");
                        divider.className = "dropdown-divider";
                        dropdownMenu.appendChild(divider);

                        const seeMore = document.createElement("button");
                        seeMore.className = "dropdown-item";
                        seeMore.type = "button";
                        seeMore.textContent = "See more...";
                        dropdownMenu.appendChild(seeMore);
                    } else {
                        document.getElementById("notif-badge").innerText = "0";
                    }
                } else {
                    console.error("Error fetching notifications:", this.statusText);
                }
            };

            xhttp.open("GET", `../../../includes/notif.php?adminID=${adminID}`, true);
            xhttp.send();
        }, 1000); // Refresh every 1 second
    });

    
</script>