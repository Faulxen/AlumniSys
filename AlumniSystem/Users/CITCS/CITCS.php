<?php
include '../../includes/conn.php';
session_start();
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <link rel="stylesheet" href="../../CSS/Users.css">
</head>

<body class="userbody">
  
  <div class="NavBar">
    <div class="NavBarlogo">
      <div class="logo">
        <img src="../../images/logo.png" alt="Logo" width="100" height="100" class="logo-img">
      </div>
      <div class="NavBarlogoText">
        <p class="headerText">Pamantasan ng Lungsod ng Muntinlupa<br>CITCS Alumni Society</p>
      </div>
    </div>
    <div class="nav-links">
      <div class="notifs" id="notifButton">Notifications</div>
      <div class="moreIcon"><img class="moreIMG" src="../../images/more_logo.png" id="moreIMG"></div>
    </div>
  </div>
  <!-- MAIN CARD -->
  <div class="mainCard">
    <div class="cardNav">
      <div id="AnnSwitch" class="cardNavText">Announcements</div>
      <div id="EventSwitch" class="cardNavText">Events</div>
      <div id="FeedSwitch" class="cardNavText">Feed</div>
    </div>

    
    <!-- ANNOUNCEMENT BOXES -->
    <div class="AnnBoxCon" id="AnnBoxCon">
      <?php
        $sql = "SELECT * FROM user_posts WHERE postType = 'Announcement' AND (department LIKE '%ALL%' OR department LIKE '%CITCS%') ORDER BY timePosted DESC";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="AnnBox ContentBox" id="AnnBox">
                        <div class="Ann">
                          <h2>ANNOUNCEMENT: ' . htmlspecialchars($row["contentTitle"]) . '</h2>
                          <p>posted at: ' . htmlspecialchars($row["timedate"]) . '</p>
                          <p>' . htmlspecialchars($row["contentBody"]) . '</p>
                          <p><img class="socIcon" src="../../images/like.png"> ' . $row["likes"] . ' 
                            <img class="socIcon" src="../../images/comment.png"> ' . $row["comments"] . '</p>
                        </div>
                      </div>
                      ';
              }
        } else {
            echo "No announcements found.";
        }
      ?>
    </div>

    <!-- EVENT BOXES -->
    <div class="EventsBoxCon" id="EventsBoxCon">
      <?php
        $sql = "SELECT * FROM user_posts WHERE (postType = 'Events' OR postType = 'Event') AND (department LIKE '%ALL%' OR department LIKE '%CITCS%') ORDER BY timePosted DESC";
        $result = $conn->query($sql);
        
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo '<div class="EventsBox ContentBox" id="EventsBox">
                          <div class="Ann">
                            <h2>EVENT: ' . htmlspecialchars($row["contentTitle"]) . '</h2>
                            <p>posted at: ' . htmlspecialchars($row["timedate"]) . '</p>
                            <p>' . htmlspecialchars($row["contentBody"]) . '</p>
                            <p><img class="socIcon" src="../../images/like.png"> ' . $row["likes"] . ' 
                              <img class="socIcon" src="../../images/comment.png"> ' . $row["comments"] . '</p>
                          </div>
                        </div>
                        ';
              }
          } else {
              echo "No events found.";
          }
      ?>
    </div>
    <!-- FEED BOXES -->
    <div class="FeedBoxCon" id="FeedBoxCon">
      <?php
          $sql = "SELECT * FROM user_posts WHERE postType = 'Feed' AND (department LIKE '%ALL%' OR department LIKE '%CITCS%') ORDER BY timePosted DESC";
          $result = $conn->query($sql);
          
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="FeedBox ContentBox" id="FeedBox">
                            <div class="Ann">
                               <h2>FEED: ' . htmlspecialchars($row["contentTitle"]) . '</h2>
                              <p>posted at: ' . htmlspecialchars($row["timedate"]) . '</p>
                              <p>' . htmlspecialchars($row["contentBody"]) . '</p>
                              <p><img class="socIcon" src="../../images/like.png"> ' . $row["likes"] . ' 
                                <img class="socIcon" src="../../images/comment.png"> ' . $row["comments"] . '</p>
                            </div>
                          </div>
                          ';
                }
            } else {
                echo "No feeds found.";
            }
      ?>
    </div>
  </div>
  <!-- MAIN CARD END-->

  <div class="InfoBar" id="InfoBar">
    <div class="UserInfo">
      <div><img src="../../images/user_icon.png" class="userInfoBarIcon"></div>
      <?php
      $sql = "SELECT fname, lname, department FROM studentinfo WHERE studentID = '{$_SESSION['studentID']}'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          echo '<div class="userName">' . htmlspecialchars($row["fname"]) . ' ' . htmlspecialchars($row["lname"]) . '
          <br>' . htmlspecialchars($row["department"]) . '</div>';
      } else {
          echo '<div>UserName <br> Course</div>';
      }

      ?>
    </div>
    <hr class="hrDefault">
    <div class="UserBars">
      <button class="profileBar" id="profileButton">Profile</button>
      <button class="profileBar" id="settingsButton">Settings</button>
      <button class="profileBar" id="helpButton">Help</button>
      <button class="profileBar" id="logoutButton">Logout</button>
    </div>
  </div>

  <div class="NotifBar" id="NotifBar">
    <h2>Notifications</h2>
    <div class="NotifBox">
      <?php
        $sql = "
        SELECT * 
        FROM user_notifications 
        INNER JOIN user_posts ON user_notifications.postID = user_posts.postID
        WHERE user_notifications.department IN ('ALL', 'CITCS')
        ORDER BY user_posts.timedate DESC
        ";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row["postType"] == "Ann") {
                    echo '<div class="NotifText"> New Annoucement: ' . htmlspecialchars($row["contentTitle"]) . '</div>';
                } elseif ($row["postType"] == "Events") {
                    echo '<div class="NotifText"> New Event: ' . htmlspecialchars($row["contentTitle"]) . '</div>';
                } elseif ($row["postType"] == "Feed") {
                    echo '<div class="NotifText"> New Feed: ' . htmlspecialchars($row["contentTitle"]) . '</div>';
                }
            }
        } else {
            echo '<div class="NotifText">No notifications found.</div>';
        }
      ?>
    </div>
  </div>
  
  <div>
  </div>
</body>

<div class="LogoutPopup" id="LogoutPopup">Are you sure you want to log out?
    <button class="LogoutButton LogoutYes" id="yesLogout">Yes</button>
    <button class="LogoutButton" id="noLogout">No</button>
</div>

<div class="SettingPopup" id="SettingPopup">
  <div>Settings</div>
  <hr class="hrDefault">
    <p>Enable Notifications<nobr>
      <label class="toggle-switch">
        <input type="checkbox">
        <span class="slider"></span></p>
      </label>
    <p>Enable Event Reminder<nobr>
      <label class="toggle-switch">
        <input type="checkbox">
        <span class="slider"></span></p>
      </label>
    <p>Show Profile<nobr>
      <label class="toggle-switch">
        <input type="checkbox">
        <span class="slider"></span></p>
      </label>
      <button class="SettingButton" id="SettingButton">Close</button>
</div>

</html>
<script src="../../js/Users.js"></script>