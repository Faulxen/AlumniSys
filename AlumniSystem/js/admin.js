let myArray = [];

document.addEventListener('DOMContentLoaded', () => {
    fetch("../../includes/databoard.php")
        .then(response => response.json())
        .then(data => {
            console.log(data);

            for (let i = 0; i < 8; i++) {
                myArray[i] = data[i];
            }
        })
        .catch(error => console.error('Error fetching data:', error));
});

document.addEventListener('DOMContentLoaded', () => {
    // Simulated API call for weather data
    function updateWeather() {
        const weatherIcons = ['fas fa-sun', 'fas fa-cloud-sun', 'fas fa-cloud', 'fas fa-cloud-showers-heavy', 'fas fa-snowflake'];
        const descriptions = ['Sunny', 'Partly Cloudy', 'Cloudy', 'Rainy', 'Snowy'];
        const randomIndex = Math.floor(Math.random() * weatherIcons.length);
        const temperature = Math.floor(Math.random() * 30) + 10; // Random temperature between 10°C and 40°C

        document.querySelector('.weather-icon i').className = weatherIcons[randomIndex];
        document.querySelector('.weather-temp').textContent = `${temperature}°C`;
        document.querySelector('.weather-description').textContent = descriptions[randomIndex];
    }

    updateWeather();
    setInterval(updateWeather, 60000); // Update weather every minute

    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021'],
            datasets: [{
                label: 'Students',
                data: [1000, 2000, 1500, 7000, 3000, 8000, 4000, 10000, 8000, 13000, 17000, 22000],
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function (value, index, values) {
                            return value;
                        }
                    }
                }
            }
        }
    });

    // Demographics Chart
    const demographicsCtx = document.getElementById('demographicsChart').getContext('2d');
    new Chart(demographicsCtx, {
        type: 'doughnut',
        data: {
            labels: ['CITCS', 'CAS', 'CBA', 'CCJ', 'COM', 'CTE', 'IPPG', 'ISW'],
            datasets: [{
                data: myArray,       
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 206, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)',
                    'rgb(255, 159, 64)',
                    'rgb(199, 199, 199)',
                    'rgb(83, 102, 255)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right',
                },
                title: {
                    display: true,
                    text: 'College Departments'
                }
            }
        }
    });
});

document.getElementById('ReqBut').addEventListener('click', function (e) {
    const requestContainer = document.getElementById('requestContainer');
    if (requestContainer.style.display === 'none' || requestContainer.style.display === '') {
        requestContainer.style.display = 'block';
    } else {
        requestContainer.style.display = 'none';
    }
});

document.getElementById('v-pills-settings-tab').addEventListener('click', function (e) {
    const SettingPopup = document.getElementById('SettingPopup');
    if (SettingPopup.style.display === 'none' || SettingPopup.style.display === '') {
        SettingPopup.style.display = 'block';
    } else {
        SettingPopup.style.display = 'none';
    }
});

document.getElementById('SettingButton').addEventListener('click', function (e) {
    document.getElementById('SettingPopup').style.display = 'none';
});





