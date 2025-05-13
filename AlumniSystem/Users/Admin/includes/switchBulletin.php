<?php

include '../../../includes/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

$sql = "SELECT * FROM user_posts ORDER BY timePosted DESC LIMIT 10";

    if ($action === 'ALL') {
        $sql = "SELECT * FROM user_posts ORDER BY timePosted DESC LIMIT 10";
    } elseif ($action === 'Announcement') {
        $sql = "SELECT * FROM user_posts WHERE postType = 'Announcement' ORDER BY timePosted DESC LIMIT 10";
    } elseif ($action === 'Event') {
        $sql = "SELECT * FROM user_posts WHERE postType = 'Event' ORDER BY timePosted DESC LIMIT 10";
    } elseif ($action === 'Feed') {
        $sql = "SELECT * FROM user_posts WHERE postType = 'Feed' ORDER BY timePosted DESC LIMIT 10";
    }else {
        
    }
} else {
    echo "Error";
}


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $postType = $row["postType"];
        if ($postType == "Event") {
            $postType = '<i class="material-icons" style="color: #476F30;">event</i>';
        } elseif ($postType == "Announcement") {
            $postType = '<i class="material-icons" style="color: #476F30;">announcement</i>';
        } else {
            $postType = '<i class="material-icons" style="color: #476F30;">feed</i>';
        }
        $contentBody = htmlspecialchars($row["contentBody"]);
        if (strlen($contentBody) > 200) {
            $truncatedContent = substr($contentBody, 0, 200);
            $contentBodyz = htmlspecialchars_decode($truncatedContent) . '... <button class="btn btn-link read-more" data-toggle="collapse" data-target="#collapseExample' . $i . '">Read more</button>';
        }
        $timePosted = strtotime($row["timePosted"]);
        $timePosted = date("F j, Y, g:i a", $timePosted);
        echo '
            <a class="list-group-item list-group-item-action"
                data-toggle="collapse"
                href="#collapseExample' . $i . '"
                role="button"
                aria-expanded="false"
                aria-controls="collapseExample' . $i . '"
                onclick="collapseOthers(\'collapseExample' . $i . '\')">

                <div class="d-flex w-100 align-items-center">
                    <div style="flex-shrink: 0; margin-right: 10px; display: flex; align-items: center; justify-content: center; width: 40px; height: 40px;">
                        ' . $postType . '
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1">' . htmlspecialchars($row['postType']) . ': ' . htmlspecialchars($row["contentTitle"]) . '</h5>
                            <small class="text-muted">' . $timePosted . '</small>
                        </div>
                        <div class="collapse" id="collapseExample' . $i . '">
                            <div class="d-flex flex-start align-items-center m-1">
                                <img class="rounded-circle shadow-1-strong me-3 mr-2"
                                    src="https://pbs.twimg.com/profile_images/1516226364319617026/HZkwR2wl_400x400.jpg" alt="avatar" width="40"
                                    height="40" />
                                <div>
                                    <h6 class="fw-bold text-primary mb-1" data-bs-toggle="tooltip" data-bs-placement="right" title="Kamisato Ayato - Shared publicly - Jan 2020">
                                        Kamisato Ayato
                                    </h6>
                                    <p class="text-muted small mb-0">
                                        ' . $timePosted . '
                                    </p>
                                </div>
                                </div>
                            <p class="mb-0 ml-5 mr-4">
                                ' . $contentBodyz . '
                            </p>
                            </div>
                        </div>
                </div>
            </a>
        ';
        $i++;
    }
}