<?php
    session_start();


    include 'conn.php';

    uploadFiles($_FILES); // Call the function to upload files
    function uploadFiles($files): void {
        if($files['event_images']['name'][0] == '') {
            //insert the post data into the database without images
            $event_name = $_POST['event_name'];
            $event_description = $_POST['event_description'];
            $event_date = $_POST['event_date'];
            $event_time = $_POST['event_time'];
            $postType = $_POST['post_type'];
            $event_location = $_POST['event_location'];
            //selected categories from the form is now ina json format
            $selected_categories = json_decode($_POST['selected_categories'], true);
            //if selected  categories is empty, set it to Array ( [categories] => Array ( [0] => ALL) )
            if (empty($selected_categories)) {
                $selected_categories = array('categories' => array('ALL'));
            } else {
                // If not empty, ensure it's an array
                if (!is_array($selected_categories)) {
                    $selected_categories = array('categories' => array($selected_categories));
                }
            }
            // implode the array into a string to store in the database ALL, category1, category2, etc.
            $selected_categories = implode(', ', $selected_categories['categories']);
            //$userName = $_SESSION['userName']; // Assuming userName is stored in session
            // Check if the user is logged in and has a valid session
            //
            print_r($selected_categories); // Debugging line to check the selected categories
            $userName = !isset($_POST['userName']) ? "Kenzooo" : $_POST['userName']; // Assuming userName is passed from the form
            $userID = 1; // Assuming userID is stored in session
            // Validate and sanitize the input data
            $event_name = htmlspecialchars(strip_tags(trim($event_name)));
            $event_description = htmlspecialchars(strip_tags(trim($event_description)));
            $event_date = htmlspecialchars(strip_tags(trim($event_date)));
            $event_time = htmlspecialchars(strip_tags(trim($event_time)));
            $event_location = htmlspecialchars(strip_tags(trim($event_location)));
            $postType = htmlspecialchars(strip_tags(trim($postType)));
            $timedate = htmlspecialchars(strip_tags(trim($event_date . ' ' . $event_time)));
            $likes = 0; // Assuming likes is 0 for new posts
            $comments = json_encode(array()); // Assuming comments is an empty array for new posts
            
            insertPostData($userID, $postType, $selected_categories, $event_name, $event_description, $timedate, $likes, $comments, ''); // Call the function to insert post data into the database
            //go to the dashboard page
            header("Location: ../Users/Admin/index.php?success=1");
            exit(); // Ensure no further code is executed after the redirect
        }
        else {
            $event_name = $_POST['event_name'];
            $event_description = $_POST['event_description'];
            $event_date = $_POST['event_date'];
            $event_time = $_POST['event_time'];
            $postType = $_POST['post_type'];
            $event_location = $_POST['event_location'];
            //selected categories from the form is now ina json format
            $selected_categories = json_decode($_POST['selected_categories'], true);
            //if selected  categories is empty, set it to Array ( [categories] => Array ( [0] => ALL) ) 
            if (empty($selected_categories)) {
                $selected_categories = array('categories' => array('ALL'));
            } else {
                // If not empty, ensure it's an array
                if (!is_array($selected_categories)) {
                    $selected_categories = array('categories' => array($selected_categories));
                }
            }
            // implode the array into a string to store in the database ALL, category1, category2, etc.
            $selected_categories = implode(', ', $selected_categories['categories']);
            //$userName = $_SESSION['userName']; // Assuming userName is stored in session
            // Check if the user is logged in and has a valid session
            //
            print_r($selected_categories); // Debugging line to check the selected categories
            $userName = !isset($_POST['userName']) ? "Kenzooo" : $_POST['userName']; // Assuming userName is passed from the form
            $userID = 1; // Assuming userID is stored in session
            // Validate and sanitize the input data
            $event_name = htmlspecialchars(strip_tags(trim($event_name)));
            $event_description = htmlspecialchars(strip_tags(trim($event_description)));
            $currenttimedate = date('Ymd_His'); // Get the current date and time
            $event_date = htmlspecialchars(strip_tags(trim($event_date)));
            $event_time = htmlspecialchars(strip_tags(trim($event_time)));
            $event_location = htmlspecialchars(strip_tags(trim($event_location)));
            $postType = htmlspecialchars(strip_tags(trim($postType)));
           

            $timedate = htmlspecialchars(strip_tags(trim($event_date . ' ' . $event_time)));
            $likes = 0; // Assuming likes is 0 for new posts
            $comments = json_encode(array()); // Assuming comments is an empty array for new posts
            $postImage = implode(',', $files['event_images']['name']);
            $image_names1[] = ""; 
            // Check if the user is logged in and has a valid session

            //save the uploaded images to the server filesystem
            $image_names = []; // Array to store the names of uploaded images
            $target_dir = "../images/uploads/users/" .$userName. "/post_" . $currenttimedate . $event_name . "/"; // Directory where images will be uploaded
            $target_dir = str_replace(' ', '_', $target_dir); // Replace spaces with underscores in the directory name
            $target_dir = str_replace(':', '_', $target_dir); // Replace colons with underscores in the directory name
            print_r($target_dir);
            $image_names = $files['event_images']['name'];
            $image_tmp_names = $files['event_images']['tmp_name'];
            $image_types = $files['event_images']['type'];
            $image_sizes = $files['event_images']['size'];
            $file_errors = $files['event_images']['error'];
            // Ensure both arrays have the same number of elements before combining
            if (count($image_names) === count($image_tmp_names)) {
                $files_array = array_combine($image_names, $image_tmp_names);
            } else {
                echo "Error: Mismatch in the number of image names and temporary file names.";
                return;
            }
            
            //create a validation function to check the file types and sizes
            $valid_extensions = ['jpg', 'jpeg', 'png', 'gif']; // Allowed file extensions
            $max_file_size = 5 * 1024 * 1024; // 5MB
            //create the target directory if it doesn't exist
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true); // Create the directory with appropriate permissions
            }
            // Check if the directory was created successfully  or already exists
            if (is_dir($target_dir)) {
                // Directory exists or was created successfully
                echo "<script>alert('Directory created successfully or already exists.');</script>";
            } else {
                // Failed to create the directory
                echo "<script>alert('Failed to create directory.');</script>";
            }
            
            // Loop through each file and validate
            foreach ($files_array as $file_name => $tmp_name) {
                $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                $file_size = $image_sizes[array_search($file_name, $image_names)];
                if (in_array($file_extension, $valid_extensions) && $file_size <= $max_file_size) {
                    //rename the file to avoid conflicts userName_eventName_eventDate_eventTime_index.jpg/png
                    //remove any special characters from the event name
                    $temp_event_name = preg_replace('/[^a-zA-Z0-9_]/', '', $event_name); // Remove special characters
                    $temp_event_name = preg_replace('/\s+/', '_', $temp_event_name); // Replace spaces with underscores
                    
                    $new_file_name = $userName . '_' . $temp_event_name . '_' . $currenttimedate . '_' . $file_name;
                // Move the uploaded file to the target directory
                    if (move_uploaded_file($tmp_name, $target_dir . $new_file_name)) {
                        // File upload successful, store the file name in the array
                        $image_names1[] = $new_file_name;
                        // Insert the post data into the database  
                    } else {
                        // File upload failed
                        echo "Failed to upload file: " . htmlspecialchars($file_name) . "<br>";
                    }
                } else if ($file_errors[array_search($file_name, $image_names)] != UPLOAD_ERR_OK) {
                    // Handle file upload error
                    echo "Error uploading file: " . htmlspecialchars($file_name) . "<br>";
                } else if ($file_size > $max_file_size) {
                    // File size exceeds limit
                    echo "File size exceeds limit for: " . htmlspecialchars($file_name) . "<br>";
                } else if (!in_array($file_extension, $valid_extensions)) {
                    // Invalid file type
                    echo "Invalid file type for: " . htmlspecialchars($file_name) . "<br>";
                } else if ($file_errors[array_search($file_name, $image_names)] != UPLOAD_ERR_OK) {
                    // Handle file upload error
                    echo "Error uploading file: " . htmlspecialchars($file_name) . "<br>";
                } else if ($file_size > $max_file_size) {
                    // File size exceeds limit
                    echo "File size exceeds limit for: " . htmlspecialchars($file_name) . "<br>";
                } else if (!in_array($file_extension, $valid_extensions)) {
                    // Invalid file type
                    echo "Invalid file type for: " . htmlspecialchars($file_name) . "<br>";
                } else {
                    // Invalid file type or size
                    echo "Invalid file type or size for: " . htmlspecialchars($file_name) . "<br>";
                }
        }
        //convert image_names array to a string to store in the database image_names = implode(',', $image_names);
        $image_namesz = implode(', ', $image_names1); // Assuming postImage is a comma-separated string of image names
         // insert the new image_names[] into the database
         
        insertPostData($userID, $postType, $selected_categories, $event_name, $event_description, $timedate, $likes, $comments, $image_namesz); // Call the function to insert post data into the database
        
    }

    }

    function insertPostData($userID, $postType, $department, $contentTitle, $contentBody, $timedate, $likes, $comments, $postImage) {
        global $conn;
            // columns: userID, postType, department, contentTitle, contentBody, timedate, likes, comments, postImage
            $stmt = $conn->prepare("INSERT INTO user_posts (userID, postType, department, contentTitle, contentBody, timedate, likes, comments, postImage) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssssiis", $userID, $postType, $department, $contentTitle, $contentBody, $timedate, $likes, $comments, $postImage);
            // Assuming postImage is a comma-separated string of image names
            $stmt->execute();
            $postID = $stmt->insert_id; // Get the last inserted post ID
            $stmt->close();
            $readStatus = 0; // Assuming readStatus is 0 for new posts
            insertNotifData($department, $postID, $userID, $postType, $readStatus);
             // Ensure no further code is executed after the redirect

    }

    function insertNotifData($department, $postID, $userID, $postType, $readStatus) {
        global $conn;
            // columns: department, postID, userID, postType, readStatus
            // Assuming userID is stored in session
            $stmt = $conn->prepare("INSERT INTO user_notifications (department, postID, userID, contentType, readStatus) VALUES (?, ?, ?, ?, ?)");
            $userID = 0; // Assuming userID is stored in session
            $stmt->bind_param("siisi", $department, $postID, $userID, $postType, $readStatus);
            // Assuming readStatus is a boolean value (0 or 1)
            $stmt->execute();
            $stmt->close();
            
            // Optionally, you can also insert into the user_notifications table if needed
            // For example:
            // insertUserNotifData($userID, $postID);



        // go to the dashboard page
            header("Location: ../Users/Admin/index.php?success=1");
            exit();
    }

   
            ?>