
<div class="container py-4">
    <h1 class="text-center mb-4">PLMUN Alumni Data Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="dashboard-card weather-widget">
                    <div class="weather-icon">
                        <i class="fas fa-sun"></i>
                    </div>
                    <div class="weather-temp">25°C</div>
                    <div class="weather-description">Sunny</div>
                    <div class="weather-location">New York, NY</div>
                </div>
                <div class="dashboard-card">
                    <h3>Quick Stats</h3>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon text-primary">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-value">24</div>
                                <div class="stat-label">Total Users</div>
                            </div>
                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="stat-card">
                                                <div class="stat-icon text-success">
                                                    <i class="fas fa-user-graduate"></i>
                                                </div>
                                                <div class="stat-value">
                                                    <?= htmlspecialchars($ALLCount ?? 'N/A') ?>
                                                </div>
                                                <div class="stat-label">Total Graduates</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="stat-card">
                                                <div class="stat-icon text-info">
                                                    <img src="../../images/female.png" alt="female-icon" class="iconFemale">
                                                </div>
                                                <div class="stat-value">
                                                    <?= htmlspecialchars($fCount ?? 'N/A') ?>
                                                </div>

                                                <div class="stat-label">Female Graduates</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="stat-card">
                                                <div class="stat-icon text-warning">
                                                    <img src="../../images/male.png" alt="male-icon" class="iconMale">
                                                </div>
                                                <div class="stat-value">
                                                    <?= htmlspecialchars($mCount ?? 'N/A') ?>
                                                </div>
                                                <div class="stat-label">Male Graduates</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="dashboard-card">
                                    <h3>Yearly Graduates</h3>
                                    <canvas id="revenueChart"></canvas>
                                </div>
                                <div class="dashboard-card">
                                    <h3>College Departments Graduates</h3>
                                    <canvas id="demographicsChart"></canvas>
                                </div>
        </div>
    </div>
</div>  