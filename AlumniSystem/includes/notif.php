<?php

    include "conn.php";

    $adminID = $_GET['adminID'];


$response = ['rows' => []]; // Initialize response array


// step 1: priority check for unread notifications where userID = $adminID and PostID = <post id> and readStatus = false
// step 2: if no unread notifications, check if there are unread notifications from userID = 0 and PostID = <post id> and readStatus = false
// step 3: if no unread notifications, check if there are read notifications from userID = $adminID and PostID = <post id> and readStatus = true

// Step 1: Check for unread notifications for the admin
$query = "SELECT * FROM user_notifications 
          WHERE userID = $adminID 
          AND readStatus = false 
          ORDER BY postID DESC";

$result = mysqli_query($conn, $query);

// Step 2: If no unread notifications, fetch 5 most recent read notifications
if (mysqli_num_rows($result) == 0) {
    // Check for unread notifications from userID = 0
    $query = "SELECT * FROM user_notifications 
              WHERE userID = 0 
              AND readStatus = false 
              ORDER BY postID DESC";
    $result = mysqli_query($conn, $query);

    // If still no unread notifications, check for read notifications
    if (mysqli_num_rows($result) == 0) {
        // Check for read notifications for the admin
        $query = "SELECT * FROM user_notifications 
                  WHERE userID = $adminID 
                  AND readStatus = true 
                  ORDER BY postID DESC LIMIT 5";
    } else {
        // If unread notifications from userID = 0 exist, fetch them
        $query = "SELECT * FROM user_notifications 
                  INNER JOIN user_posts ON user_notifications.postID = user_posts.postID
                  INNER JOIN admin ON admin.adminID = user_posts.userID
                  WHERE user_notifications.userID = 0 
                  AND user_notifications.readStatus = false
                  ORDER BY user_notifications.postID DESC";
    }
} else {
    $query = "SELECT * FROM user_notifications 
              INNER JOIN user_posts ON user_notifications.postID = user_posts.postID
              INNER JOIN admin ON admin.adminID = user_posts.userID
              WHERE user_notifications.userID = $adminID 
              AND user_notifications.readStatus = true 
              ORDER BY user_notifications.postID DESC";
}

// Execute final query
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Step 4: Build response array
while ($row = mysqli_fetch_assoc($result)) {
    $response['rows'][] = [
        $row['postID'],
        $row['userID'],
        $row['contentTitle'],
        $row['contentBody'],
        $row['timedate'],
        $row['readStatus']
    ];
}

// Step 5: Send JSON to AJAX
echo json_encode($response);

?>