<script>
function sendAction(actionType) {
    fetch('includes/switchBulletin.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=' + encodeURIComponent(actionType)
    })
    .then(response => response.text())
    .then(data => {
        console.log('Action sent:', actionType);
        document.getElementById('AjaxOut').innerHTML = data;
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>

<div class="modal fade" id="setevent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
                <div class="modal-body">
                    <div class="w-80 d-flex flex-column align-items-center" style="gap: 10px;">
                        <div class="d-flex flex-wrap justify-content-center" style="gap: 10px;">
                            <?php
                                $categories = ['CA', 'CAS', 'CBA', 'CCJ', 'CITCS', 'COM', 'CTE', 'IPPG', 'ISW'];
                                echo '<button id="allButton" type="button" class="btn btn-outline-success category-button" style="color: #476F30; border-color: #476F30;" data-category="All" onclick="toggleCategory(this, \'All\')">All</button>';
                                foreach ($categories as $category) {
                                echo '<button type="button" class="btn btn-outline-success category-button" style="color: #476F30; border-color: #476F30;" data-category="' . $category . '" onclick="toggleCategory(this, \'' . $category . '\')">' . $category . '</button>';
                            }
                            ?>
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="gap: 10px;">
                              <li class="nav-item" role="presentation">
                                <button class="btn btn-outline-success" style="color: #476F30; border-color: #476F30;" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                                Announcement
                                </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                <button class="btn btn-outline-success" style="color: #476F30; border-color: #476F30;" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                                Event
                                </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                <button class="btn btn-outline-success" style="color: #476F30; border-color: #476F30;" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                                Feed
                                </button>
                              </li>
                            </ul>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-divider"></div>

                    <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="w-100 d-flex flex-column" style="gap: 10px;">
                                          <div class="input-group mb-3">
                                              <span class="input-group-text" id="basic-addon1">
                                                  <i class="material-icons">title</i>
                                              </span>
                                              <input type="text" class="form-control" name="event_name" placeholder="What" required>
                                          </div>
                                          <div class="mb-0 d-flex align-items-start" style="gap: 10px;">
                                              <img class="rounded-circle shadow-1-strong" src="https://pbs.twimg.com/profile_images/1516226364319617026/HZkwR2wl_400x400.jpg" alt="avatar" width="40" height="40" />
                                              <textarea class="form-control" name="event_description" placeholder="Content" rows="4" required></textarea>
                                          </div>
                                          <div class="p-0" style="margin-left: 50px; width: 93.5%; margin-top: 0;">
                                              <span class="" style="margin-left: 8px; top:5px; position: relative; z-index: 1; ">
                                                  <div class="imageupload-output-here" style="display: flex; flex-wrap: wrap; gap: 10px; overflow-x: auto; max-width: 100%; box-sizing: border-box; padding-left: 10px;"></div>
                                                  <div class="btn-group" role="group" aria-label="Text formatting options">
                                                      <input type="file" id="imageUpload1" name="event_images1[]" accept="image/*" style="display: none;" multiple onchange="previewImages(event)">
                                                  </div>
                                                  
                                                  <button type="button" class="btn btn-outline-secondary mt-2 mb-2" onclick="document.getElementById('imageUpload').click();">
                                                      <i class="material-icons">image</i>
                                                  </button>
                                                  <button type="button" class="btn btn-outline-secondary mt-2 mb-2">
                                                      <i class="material-icons">format_bold</i>
                                                  </button>
                                                  <button type="button" class="btn btn-outline-secondary mt-2 mb-2">
                                                      <i class="material-icons">format_italic</i>
                                                  </button>
                                                  <div class="btn-group mt-2 mb-2">
                                                      <button type="button" class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <i class="material-icons" style="margin-right: 5px;">format_align_justify</i>
                                                      </button>
                                                      <div class="dropdown-menu">
                                                          <a class="dropdown-item d-flex align-items-center" href="#" onclick="setTextAlignment('left')">
                                                              <i class="material-icons" style="margin-right: 10px;">format_align_left</i> Align Left
                                                          </a>
                                                          <a class="dropdown-item d-flex align-items-center" href="#" onclick="setTextAlignment('right')">
                                                              <i class="material-icons" style="margin-right: 10px;">format_align_right</i> Align Right
                                                          </a>
                                                          <a class="dropdown-item d-flex align-items-center" href="#" onclick="setTextAlignment('center')">
                                                              <i class="material-icons" style="margin-right: 10px;">format_align_center</i> Align Center
                                                          </a>
                                                          <a class="dropdown-item d-flex align-items-center" href="#" onclick="setTextAlignment('justify')">
                                                              <i class="material-icons" style="margin-right: 10px;">format_align_justify</i> Justify
                                                          </a>
                                                      </div>
                                                  </div>
                                                  <div class="btn-group">
                                                      <button type="button" class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <i class="material-icons" style="margin-right: 5px;">format_list_bulleted</i>
                                                      </button>
                                                      <div class="dropdown-menu">
                                                          <a class="dropdown-item d-flex align-items-center" href="#" onclick="setListStyle('bullet')">
                                                              <i class="material-icons" style="margin-right: 10px;">format_list_bulleted</i> Bulleted List
                                                          </a>
                                                          <a class="dropdown-item d-flex align-items-center" href="#" onclick="setListStyle('number')">
                                                              <i class="material-icons" style="margin-right: 10px;">format_list_numbered</i> Numbered List
                                                          </a>
                                                          <a class="dropdown-item d-flex align-items-center" href="#" onclick="setListStyle('none')">
                                                              <i class="material-icons" style="margin-right: 10px;">format_list_bulleted</i>
                                                              <i class="material-icons" style="visibility: hidden;">format_list_numbered</i> Unlist
                                                          </a>
                                                      </div>
                                                  </div>
                                              </span>
                                          </div>
                        </div>
                                

                      </div>
                      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <form action="../../includes/post-event.php" method="POST" enctype="multipart/form-data">
                                  <input type="hidden" name="post_type" value="Events">
                                  <input type="hidden" id="selectedCategoriesInput" name="selected_categories" value="">
                                  <input type="hidden" name="userName" value="<?php echo $_SESSION['adminName']; ?>">
                                  <div class="w-100 d-flex flex-column" style="gap: 10px;">
                                          <div class="input-group mb-3">
                                              <span class="input-group-text" id="basic-addon1">
                                                  <i class="material-icons">person</i>
                                              </span>
                                              <input type="text" class="form-control" name="event_name" placeholder="What" required>
                                          </div>
                                          <div class="input-group mb-3">
                                              <span class="input-group-text" id="basic-addon2">
                                                  <i class="material-icons">event</i>
                                              </span>
                                              <input type="date" class="form-control" name="event_date" min="<?php echo date('Y-m-d'); ?>" required>
                                              <input type="time" class="form-control" name="event_time" required>
                                          </div>
                                          <div class="input-group mb-3">
                                              <span class="input-group-text" id="basic-addon3">
                                                  <i class="material-icons">place</i>
                                              </span>
                                              <input type="text" class="form-control" name="event_location" placeholder="Where" required>
                                          </div>
                                          <div class="mb-0 d-flex align-items-start" style="gap: 10px;">
                                              <img class="rounded-circle shadow-1-strong" src="https://pbs.twimg.com/profile_images/1516226364319617026/HZkwR2wl_400x400.jpg" alt="avatar" width="40" height="40" />
                                              <textarea class="form-control" name="event_description" placeholder="Content" rows="4" required></textarea>
                                          </div>
                                          <div class="p-0" style="margin-left: 50px; width: 93.5%; margin-top: 0;">
                                              <span class="" style="margin-left: 8px; top:5px; position: relative; z-index: 1; ">
                                                  <div class="imageupload-output-here" style="display: flex; flex-wrap: wrap; gap: 10px; overflow-x: auto; max-width: 100%; box-sizing: border-box; padding-left: 10px;"></div>
                                                  <div class="btn-group" role="group" aria-label="Text formatting options">
                                                      <input type="file" id="imageUpload" name="event_images[]" accept="image/*" style="display: none;" multiple onchange="previewImages(event)">
                                                  </div>
                                                  <div id="imagePreviewContainer" class="p-0" style="display: flex; gap: 10px; overflow-x: auto; max-width: 100%; justify-content: center;"></div>
                                                  
                                                  <button type="button" class="btn btn-outline-secondary mt-2 mb-2" onclick="document.getElementById('imageUpload').click();">
                                                      <i class="material-icons">image</i>
                                                  </button>
                                                  <button type="button" class="btn btn-outline-secondary mt-2 mb-2">
                                                      <i class="material-icons">format_bold</i>
                                                  </button>
                                                  <button type="button" class="btn btn-outline-secondary mt-2 mb-2">
                                                      <i class="material-icons">format_italic</i>
                                                  </button>
                                                  <div class="btn-group mt-2 mb-2">
                                                      <button type="button" class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <i class="material-icons" style="margin-right: 5px;">format_align_justify</i>
                                                      </button>
                                                      <div class="dropdown-menu">
                                                          <a class="dropdown-item d-flex align-items-center" href="#" onclick="setTextAlignment('left')">
                                                              <i class="material-icons" style="margin-right: 10px;">format_align_left</i> Align Left
                                                          </a>
                                                          <a class="dropdown-item d-flex align-items-center" href="#" onclick="setTextAlignment('right')">
                                                              <i class="material-icons" style="margin-right: 10px;">format_align_right</i> Align Right
                                                          </a>
                                                          <a class="dropdown-item d-flex align-items-center" href="#" onclick="setTextAlignment('center')">
                                                              <i class="material-icons" style="margin-right: 10px;">format_align_center</i> Align Center
                                                          </a>
                                                          <a class="dropdown-item d-flex align-items-center" href="#" onclick="setTextAlignment('justify')">
                                                              <i class="material-icons" style="margin-right: 10px;">format_align_justify</i> Justify
                                                          </a>
                                                      </div>
                                                  </div>
                                                  <div class="btn-group">
                                                      <button type="button" class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <i class="material-icons" style="margin-right: 5px;">format_list_bulleted</i>
                                                      </button>
                                                      <div class="dropdown-menu">
                                                          <a class="dropdown-item d-flex align-items-center" href="#" onclick="setListStyle('bullet')">
                                                              <i class="material-icons" style="margin-right: 10px;">format_list_bulleted</i> Bulleted List
                                                          </a>
                                                          <a class="dropdown-item d-flex align-items-center" href="#" onclick="setListStyle('number')">
                                                              <i class="material-icons" style="margin-right: 10px;">format_list_numbered</i> Numbered List
                                                          </a>
                                                          <a class="dropdown-item d-flex align-items-center" href="#" onclick="setListStyle('none')">
                                                              <i class="material-icons" style="margin-right: 10px;">format_list_bulleted</i>
                                                              <i class="material-icons" style="visibility: hidden;">format_list_numbered</i> Unlist
                                                          </a>
                                                      </div>
                                                  </div>
                                              </span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">Submit</button>              
                                  </div>

                                  <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.32);">
                                    <div class="modal-dialog modal-confirm" style="box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.5);">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex flex-column align-items-center">
                                                <div class="icon-box" style="color: white;">
                                                    <i class="material-icons">&#xE876;</i>
                                                </div>
                                                <h4 class="modal-title" style="color: #476F30;">Confirm Post</h4>
                                                <button type="button" class="close" onclick="closeModal();" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to post this content? Please confirm to proceed.</p>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-secondary" onclick="closeModal();">Cancel</button>
                                                <button type="submit" class="btn btn-success" style="background-color: #476F30; border-color: #476F30;" id="postButton" disabled>Post</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function closeModal() {
                                        $('#myModal').modal('hide');
                                    }
                                </script>
                                
                            </form>

                      </div>
                    </div>


                    

                
                
        </div>
    </div>
</div>

<div aria-live="polite" aria-atomic="true">
        <div class="toast-container position-absolute p-3" id="toast-container" style="z-index:9;"></div>
    </div>


<div class="navbar navbar-light bg-light">

    <a class="navbar-brand" style="font-size:40px;text-indent:40px;">Recent Posts</a>
    <ul class="nav nav-pills" id="pills-tab" role="tablist" style="gap: 10px;">
                              <li class="nav-item" role="presentation">
                                <button class="btn btn-outline-success" style="color: #476F30; border-color: #476F30;" id="pills-all" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-postTog" aria-selected="true" onclick="sendAction('ALL')">
                                ALL
                                </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                <button class="btn btn-outline-success" style="color: #476F30; border-color: #476F30;" id="pills-announcement" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-postTog" aria-selected="false" onclick="sendAction('Announcement')">
                                Announcement
                                </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                <button class="btn btn-outline-success" style="color: #476F30; border-color: #476F30;" id="pills-events" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-postTog" aria-selected="false" onclick="sendAction('Event')">
                                Event
                                </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                <button class="btn btn-outline-success" style="color: #476F30; border-color: #476F30;" id="pills-events" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-postTog" aria-selected="false" onclick="sendAction('Feed')">
                                Feed
                                </button>
                              </li>
    </ul>
    <button type="button" data-toggle="modal" data-target="#setevent" class="btn btn-primary" style="background: #476F30; margin-right:40px;">New Post</button>
</div>

<div class="eventpage-list">
    <div class="list-group" id="AjaxOut">
    
<?php
        /*
        $sql = "SELECT * FROM user_posts ORDER BY timePosted DESC LIMIT 10";
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
    */
?>

    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form[action="../../includes/post-event.php"]');
        const postButton = document.getElementById('postButton');
        const modal = document.getElementById('myModal');

        form.addEventListener('input', function () {
            const isValid = form.checkValidity();
            postButton.disabled = !isValid;
        });
    });
</script>

<script>
    function collapseOthers(activeId) {
        const collapses = document.querySelectorAll('.collapse');
        collapses.forEach(collapse => {
            if (collapse.id !== activeId) {
                $(collapse).collapse('hide');
            }
        });
    }

    function previewImages(event) {
        const files = event.target.files;
        const container = document.getElementById('imagePreviewContainer');
        container.innerHTML = '';
        const modalContainer = document.createElement('div');
        modalContainer.id = 'imageModalContainer';
        modalContainer.style.display = 'none';
        modalContainer.style.position = 'fixed';
        modalContainer.style.top = '0';
        modalContainer.style.left = '0';
        modalContainer.style.width = '100%';
        modalContainer.style.height = '100%';
        modalContainer.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
        modalContainer.style.zIndex = '2000'; // Increased z-index for better visibility
        modalContainer.style.justifyContent = 'center';
        modalContainer.style.alignItems = 'center';

        const modalContent = document.createElement('div');
        modalContent.style.position = 'relative';
        modalContent.style.display = 'flex';
        modalContent.style.alignItems = 'center';

        const modalImage = document.createElement('img');
        modalImage.id = 'modalImage';
        modalImage.style.maxWidth = '90%';
        modalImage.style.maxHeight = '90%';
        modalImage.style.margin = 'auto';
        modalImage.style.display = 'block';
        modalContent.appendChild(modalImage);

        const closeModal = document.createElement('button');
        closeModal.innerHTML = '&times;';
        closeModal.style.position = 'absolute';
        closeModal.style.top = '10px';
        closeModal.style.right = '10px';
        closeModal.style.background = 'black';
        closeModal.style.color = 'white';
        closeModal.style.border = 'none';
        closeModal.style.borderRadius = '50%';
        closeModal.style.width = '30px';
        closeModal.style.height = '30px';
        closeModal.style.cursor = 'pointer';
        closeModal.onclick = function () {
            modalContainer.style.display = 'none';
        };
        modalContent.appendChild(closeModal);

        const prevButton = document.createElement('button');
        prevButton.innerHTML = '&#9664;';
        prevButton.style.position = 'absolute';
        prevButton.style.left = '10px';
        prevButton.style.background = 'black';
        prevButton.style.color = 'white';
        prevButton.style.border = 'none';
        prevButton.style.borderRadius = '50%';
        prevButton.style.width = '30px';
        prevButton.style.height = '30px';
        prevButton.style.cursor = 'pointer';
        prevButton.onclick = function () {
            navigateImage(-1);
        };
        modalContent.appendChild(prevButton);

        const nextButton = document.createElement('button');
        nextButton.innerHTML = '&#9654;';
        nextButton.style.position = 'absolute';
        nextButton.style.right = '10px';
        nextButton.style.background = 'black';
        nextButton.style.color = 'white';
        nextButton.style.border = 'none';
        nextButton.style.borderRadius = '50%';
        nextButton.style.width = '30px';
        nextButton.style.height = '30px';
        nextButton.style.cursor = 'pointer';
        nextButton.onclick = function () {
            navigateImage(1);
        };
        modalContent.appendChild(nextButton);

        modalContainer.appendChild(modalContent);
        document.body.appendChild(modalContainer);

        let currentIndex = 0;
        const imageList = [];

        Array.from(files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const imgWrapper = document.createElement('div');
                imgWrapper.style.position = 'relative';
                imgWrapper.style.display = 'inline-block';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100px';
                img.style.maxHeight = '100px';
                img.style.marginRight = '10px';
                img.style.border = '1px solid #ccc';
                img.style.borderRadius = '5px';
                img.style.cursor = 'pointer';
                img.title = 'Click to preview';
                img.onclick = function () {
                    currentIndex = index;
                    modalImage.src = e.target.result;
                    modalContainer.style.display = 'flex';
                };

                const deleteBtn = document.createElement('button');
                deleteBtn.innerHTML = '&times;';
                deleteBtn.style.position = 'absolute';
                deleteBtn.style.top = '0px';
                deleteBtn.style.right = '5px';
                deleteBtn.style.background = 'black';
                deleteBtn.style.color = 'white';
                deleteBtn.style.border = 'none';
                deleteBtn.style.padding = '0';
                deleteBtn.style.borderRadius = '50%';
                deleteBtn.style.width = '20px';
                deleteBtn.style.height = '20px';
                deleteBtn.style.display = 'flex';
                deleteBtn.style.alignItems = 'center';
                deleteBtn.style.justifyContent = 'center';
                deleteBtn.style.cursor = 'pointer';
                deleteBtn.onclick = function () {
                    container.removeChild(imgWrapper);
                    imageList.splice(imageList.indexOf(e.target.result), 1); // Remove the image from the imageList array
                    if (currentIndex >= imageList.length) {
                        currentIndex = imageList.length - 1; // Adjust currentIndex if it exceeds the array length
                    }
                    if (imageList.length === 0) {
                        modalContainer.style.display = 'none'; // Hide modal if no images are left
                    }
                };

                imgWrapper.appendChild(img);
                imgWrapper.appendChild(deleteBtn);
                container.appendChild(imgWrapper);

                imageList.push(e.target.result);
            };
            reader.readAsDataURL(file);
        });

        function navigateImage(direction) {
            currentIndex = (currentIndex + direction + imageList.length) % imageList.length;
            modalImage.src = imageList[currentIndex];
        }
    }
</script>

<script>
    let selectedCategories = [];

    function toggleCategory(button, category) {
        const allButton = document.getElementById('allButton');
        const buttons = document.querySelectorAll('.category-button');
        const selectedCategoriesInput = document.getElementById('selectedCategoriesInput');

        if (category === 'All') {
            if (selectedCategories.length === buttons.length - 1) {
                selectedCategories = [];
                buttons.forEach(btn => btn.classList.remove('active'));
            } else {
                selectedCategories = Array.from(buttons).map(btn => btn.dataset.category).filter(cat => cat !== 'All');
                buttons.forEach(btn => btn.classList.add('active'));
            }
        } else {
            const index = selectedCategories.indexOf(category);
            if (index === -1) {
                selectedCategories.push(category);
                button.classList.add('active');
            } else {
                selectedCategories.splice(index, 1);
                button.classList.remove('active');
            }

            if (selectedCategories.length === buttons.length - 1) {
                allButton.classList.add('active');
            } else {
                allButton.classList.remove('active');
            }
        }
        // Update the hidden input field with the selected categories as a JSON string
        selectedCategoriesInput.value = JSON.stringify({ categories: selectedCategories });
        // Show console log for debugging
        console.log('Selected Categories:', selectedCategories);
        console.log('Selected Categories Input Value:', selectedCategoriesInput.value);

    }



</script>

<script src="../../../js/src/jquery.toast.js"></script>



<?php
    //receive success=1 from header("Location: ../Users/Admin/index.php?success=1");
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<script src="../../../js/src/jquery.toast.js"></script>';
        echo '<script>
            alert("Event posted successfully!");
        </script>';
    }
    //then clean the url
    if (isset($_GET['success'])) {
        unset($_GET['success']);
        $url = strtok($_SERVER["REQUEST_URI"], '?');
        header("Location: $url");
        exit();

    }
    //header("Location: ../Users/Admin/index.php");
?>

