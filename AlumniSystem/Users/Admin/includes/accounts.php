<div class="bg-light h-100">
    <div class="container py-3">
                <div class="search-container">
                    <div class="search-wrapper">
                        <div class="search-header">
                            <div class="search-input-group">
                                <input type="text" class="search-input form-control" placeholder="Search student, year, department.." onfocus="showFilters()" oninput="updateSearchInput(this.value)">
                                <i class="fas fa-search search-icon"></i>
                            </div>

                            <div class="quick-filters collapse">
                                <span class="quick-filter" onclick="toggleFilter(this, '2015')">2015</span>
                                <span class="quick-filter" onclick="toggleFilter(this, '2019')">2019</span>
                                <span class="quick-filter" onclick="toggleFilter(this, 'Last School Year')">Last School Year</span>
                            </div>

                            <div class="category-filters collapse">
                                <div class="filter-chip" onclick="toggleFilter(this, 'All')">
                                    <i class="fas fa-globe"></i> All
                                </div>
                                <div class="filter-chip" onclick="toggleFilter(this, 'CA')">
                                    <i class="fas fa-calculator"></i> CA
                                </div>
                                <div class="filter-chip" onclick="toggleFilter(this, 'CAS')">
                                    <i class="fas fa-flask"></i> CAS
                                </div>
                                <div class="filter-chip" onclick="toggleFilter(this, 'CBA')">
                                    <i class="fas fa-briefcase"></i> CBA
                                </div>
                                <div class="filter-chip" onclick="toggleFilter(this, 'CCJ')">
                                    <i class="fas fa-balance-scale"></i> CCJ
                                </div>
                                <div class="filter-chip" onclick="toggleFilter(this, 'CITCS')">
                                    <i class="fas fa-laptop-code"></i> CITCS
                                </div>
                                <div class="filter-chip" onclick="toggleFilter(this, 'COM')">
                                    <i class="fas fa-bullhorn"></i> COM
                                </div>
                                <div class="filter-chip" onclick="toggleFilter(this, 'CTE')">
                                    <i class="fas fa-chalkboard-teacher"></i> CTE
                                </div>
                                <div class="filter-chip" onclick="toggleFilter(this, 'IPPG')">
                                    <i class="fas fa-landmark"></i> IPPG
                                </div>
                                <div class="filter-chip" onclick="toggleFilter(this, 'ISW')">
                                    <i class="fas fa-users"></i> ISW
                                </div>

                                <div class="suggestions">
                                    <div class="suggestion-item" onclick="selectSuggestion('Reynier Apurillo', 'CITCS')">
                                        Reynier Apurillo<span class="suggestion-category">in CITCS</span>
                                    </div>
                                    <div class="suggestion-item" onclick="selectSuggestion('Jeremiah Escleto', 'COM')">
                                        Jeremiah Escleto <span class="suggestion-category">in COM</span>
                                    </div>
                                    <div class="suggestion-item" onclick="selectSuggestion('Jhon Arthur Suerte', 'CAS')">
                                        Jhon Arthur Suerte <span class="suggestion-category">in CAS</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="RegReqBut">
                        <button id="ReqBut">See Registration<br>Requests</button>
                    </div>
                </div>
    </div>
                                <div class="container py-3">
                                    <table class="table align-middle mb-0 bg-white w-100">
                                        <thead class="bg-light">
                                            <tr>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Student ID</th>
                                            <th>Year Graduated</th>
                                            <th>General Average</th>
                                            <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ajaxresponse">
                                        </tbody>
                                    </table>
                                </div>
                </div>
                </div>
            </div>
            </div>
    </div>
    
</div>
<script src="../../../js/admin.js"></script>
<script>
document.getElementById('ReqBut').addEventListener('click', function (e) {
    location.href = "includes/registerEntry.php";
});
</script>
