<?php
//admin
include '../../includes/conn.php';
session_start();

if($result = $conn -> query("SELECT * FROM studentinfo WHERE sex = 'M'")) {
    $mCount = $result->num_rows;
}

if($result = $conn -> query("SELECT * FROM studentinfo WHERE sex = 'F'")) {
    $fCount = $result->num_rows;
}

if($result = $conn -> query("SELECT * FROM studentinfo")) {
    $ALLCount = $result->num_rows;
}

$progcount = [0,0,0,0,0,0,0,0];
if($result = $conn -> query("SELECT * FROM studentinfo WHERE department = 'CITCS'")) {
    $CITCS_count = $result->num_rows;
    $progcount[0] = $CITCS_count;
}
if($result = $conn -> query("SELECT * FROM studentinfo WHERE department = 'CAS'")) {
    $CAS_count = $result->num_rows;
    $progcount[1] = $CAS_count;
}
if($result = $conn -> query("SELECT * FROM studentinfo WHERE department = 'CBA'")) {
    $CBA_count = $result->num_rows;
    $progcount[2] = $CBA_count;
}
if($result = $conn -> query("SELECT * FROM studentinfo WHERE department = 'CCJ'")) {
    $CCJ_count = $result->num_rows;
    $progcount[3] = $CCJ_count;
}
if($result = $conn -> query("SELECT * FROM studentinfo WHERE department = 'COM'")) {
    $COM_count = $result->num_rows;
    $progcount[4] = $COM_count;
}
if($result = $conn -> query("SELECT * FROM studentinfo WHERE department = 'CTE'")) {
    $CTE_count = $result->num_rows;
    $progcount[5] = $CTE_count;
}
if($result = $conn -> query("SELECT * FROM studentinfo WHERE department = 'IPPG'")) {
    $IPPG_count = $result->num_rows;
    $progcount[6] = $IPPG_count;
}
if($result = $conn -> query("SELECT * FROM studentinfo WHERE department = 'ISW'")) {
    $ISW_count = $result->num_rows;
    $progcount[7] = $ISW_count;
}

echo "<script>console.log('Arry Console: " .$progcount[0] . $progcount[1] . $progcount[2] . $progcount[3] . $progcount[4] . $progcount[5] . $progcount[6] . $progcount[7] . "' );</script>";
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://unpkg.com/htmx.org@2.0.4" integrity="sha384-HGfztofotfshcF7+8n44JQL2oJmowVChPTg48S+jvZoztPfvwD79OC/LTtG6dMp+" crossorigin="anonymous"></script>
            <script src="https://unpkg.com/htmx.org@2.0.4/dist/htmx.js" integrity="sha384-oeUn82QNXPuVkGCkcrInrS1twIxKhkZiFfr2TdiuObZ3n3yIeMiqcRzkIcguaof1" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="../../CSS/admin.css">
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <script src="../../js/admin.js"></script>
        </head>

        <?php include "includes/header.php"; ?>

    <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <?php include "includes/dashboard.php"; ?>
        </div>        
        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
            <?php include "includes/accounts.php"; ?>
        </div>
        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab"></div>
        </div>
    </div>
    </div>
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('collapsed');
        }
        function showFilters() {
            document.querySelector('.quick-filters').classList.add('show');
            document.querySelector('.category-filters').classList.add('show');
        }
        document.addEventListener('click', function(event) {
            const searchContainer = document.querySelector('.search-container');
            const searchInputGroup = document.querySelector('.search-input-group');
            const quickFilters = document.querySelector('.quick-filters');
            const categoryFilters = document.querySelector('.category-filters');

            if (!searchContainer.contains(event.target)) {
                quickFilters.classList.remove('show');
                categoryFilters.classList.remove('show');
            }
        });

        function showFilters() {
            document.querySelector('.quick-filters').classList.add('show');
            document.querySelector('.category-filters').classList.add('show');
        }
    </script>
    <script>
        let searchInput = '';
        let departmentFilters = [];
        let quickFilters = [];
        let suggestionFilters = [];

        function selectSuggestion(name, department) {
            const searchInputElement = document.querySelector('.search-input');
            searchInputElement.value = name;
            updateSearchInput(name);

            const filterChips = document.querySelectorAll('.filter-chip');
            filterChips.forEach(chip => {
                if (chip.textContent.trim() === department) {
                    chip.classList.add('active');
                    if (!departmentFilters.includes(department)) {
                        departmentFilters.push(department);
                    }
                } else {
                    chip.classList.remove('active');
                    departmentFilters = departmentFilters.filter(item => item !== chip.textContent.trim());
                }
            });
            console.log(departmentFilters);
            sendFilters();
        }

        function toggleFilter(element, value) {
            if (value === 'All') {
                document.querySelectorAll('.filter-chip').forEach(chip => chip.classList.add('active'));
                departmentFilters = ['CA', 'CAS', 'CBA', 'CCJ', 'CITCS', 'COM', 'CTE', 'IPPG', 'ISW'];
            } else {
                document.querySelector('.filter-chip[onclick*="All"]').classList.remove('active');
                element.classList.toggle('active');
                if (departmentFilters.includes(value)) {
                    departmentFilters = departmentFilters.filter(item => item !== value);
                } else {
                    departmentFilters.push(value);
                }
            }
            console.log(departmentFilters);
            sendFilters();
        }

        function updateSearchInput(value) {
            searchInput = value;
            console.log(searchInput);
            sendFilters();
        }

        function toggleQuickFilter(element, value) {
            element.classList.toggle('active');
            if (quickFilters.includes(value)) {
                quickFilters = quickFilters.filter(item => item !== value);
            } else {
                quickFilters.push(value);
            }
            console.log(quickFilters);
            sendFilters();
        }
        
        function sendFilters() {
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                try {
                    const response = JSON.parse(this.responseText);
                    let output = '';
                    response.forEach(function(item) {
                        const fname = item.fname ?? 'N/A';
                        const lname = item.lname ?? 'N/A';
                        const department = item.department ?? 'N/A';
                        const program = item.program ?? 'N/A';
                        const email = item.email ?? 'N/A';
                        const genAve = item.genAve ?? 'N/A';
                        const studentID = item.studentID ?? 'N/A';
                        const yearG = item.gradYear ?? 'N/A';
                        const id = item.id ?? 'N/A';
                        output += `<tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">${fname} ${lname}</p>
                                        <p class="text-muted mb-0">${email}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">${department}</p>
                                <p class="text-muted mb-0">${program}</p>
                            </td>
                            <td>
                                <span class="badge badge-success rounded-pill d-inline">${studentID}</span>
                            </td>
                            <td>${yearG}</td>
                            <td>${genAve}</td>
                            <td>
                                <button type="button" class="btn btn-link btn-sm btn-rounded" onclick="window.location.href='edit.php?id=${id}'">Edit</button>
                            </td>
                        </tr>`;
                    });
                    document.getElementById('ajaxresponse').innerHTML = output;
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.error('Response:', this.responseText);
                }
            };
            xhttp.open("POST", "../../includes/search.php", true);
            xhttp.setRequestHeader("Content-type", "application/json");
            const data = JSON.stringify({ 
                search: searchInput, 
                departments: departmentFilters, 
                quickFilters: quickFilters, 
                suggestions: suggestionFilters 
            });
            xhttp.send(data);
        }
    </script>
    </script>

                            
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../../js/admin.js"></script>
    <script src="https://unpkg.com/htmx.org@2.0.4/dist/htmx.js" integrity="sha384-oeUn82QNXPuVkGCkcrInrS1twIxKhkZiFfr2TdiuObZ3n3yIeMiqcRzkIcguaof1" crossorigin="anonymous"></script>

</html>

<?php
