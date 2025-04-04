<?php include('php/auth.php'); ?>
<?php
// Include the database connection
include 'php/config.php';

// Query to get the count of Crime reports
$crimeQuery = "SELECT COUNT(*) as count FROM crime_reports";
$crimeResult = mysqli_query($conn, $crimeQuery);
$crimeCount = mysqli_fetch_assoc($crimeResult)['count'];

// Query to get the count of Incident reports
$incidentQuery = "SELECT COUNT(*) as count FROM incident_reports";
$incidentResult = mysqli_query($conn, $incidentQuery);
$incidentCount = mysqli_fetch_assoc($incidentResult)['count'];

// Query to get the count of Complain reports
$complainQuery = "SELECT COUNT(*) as count FROM complaint_reports";
$complainResult = mysqli_query($conn, $complainQuery);
$complainCount = mysqli_fetch_assoc($complainResult)['count'];

// Query to get the count of Disaster reports
$disasterQuery = "SELECT COUNT(*) as count FROM disaster_reports";
$disasterResult = mysqli_query($conn, $disasterQuery);
$disasterCount = mysqli_fetch_assoc($disasterResult)['count'];

// Query to fetch notifications (latest 5 unread)
$notificationQuery = "SELECT * FROM notifications WHERE status = 'unread' ORDER BY created_at DESC LIMIT 5";
$notificationResult = mysqli_query($conn, $notificationQuery);
$notifications = [];
while ($row = mysqli_fetch_assoc($notificationResult)) {
    $notifications[] = $row['message'];
}

// Initialize an array to hold monthly counts
$monthlyReports = array_fill(0, 12, 0);

// Table names and their respective date columns
$tables = [
    'crime_reports' => 'reportDate',
    'incident_reports' => 'submitted_at',
    'complaint_reports' => 'submitted_at',
    'disaster_reports' => 'reportedAt'
];

// Fetch counts from each report table
foreach ($tables as $table => $dateColumn) {
    $query = "SELECT MONTH($dateColumn) AS month, COUNT(*) AS count 
              FROM $table 
              WHERE YEAR($dateColumn) = YEAR(CURDATE())
              GROUP BY MONTH($dateColumn)";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        $monthlyReports[$row['month'] - 1] += (int)$row['count'];
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Public Incident Reporting System - Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <script type="text/javascript" src="dashboard.js" defer></script>
</head>

<body>
    <div class="container">
        <nav>
            <div class="logo">
                <img src="images/logo.png" alt="">
            </div>
            <div class="tabs">
                <div class="upper">
                    <a href="dashboard.php" id="active">
                        <i class='bx bxs-dashboard'></i>
                        <p>Dashboard</p>
                    </a>

                    <div class="dropdown">
                        <a href="#" class="dropdown-btn">
                            <i class='bx bxs-file'></i>
                            <p>Incident Reports</p>
                            <i class='bx bx-chevron-down dropdown-arrow'></i>
                        </a>
                        <div class="dropdown-content">
                            <div>
                                <a href="reports-crime.php">Crime</a>
                            </div>
                            <div>
                                <a href="reports-incident.php">Incident</a>
                            </div>
                            <div>
                                <a href="reports-complain.php">Complain</a>
                            </div>
                            <div>
                                <a href="reports-disaster.php">Disaster</a>
                            </div>
                        </div>
                    </div>

                    <a href="users.php">
                        <i class="fa-solid fa-user"></i>
                        <p>Users</p>
                    </a>

                    <div class="dropdown">
                        <a href="#" class="dropdown-btn">
                            <i class="fa-solid fa-tv"></i>
                            <p>Monitoring</p>
                            <i class='bx bx-chevron-down dropdown-arrow'></i>
                        </a>
                        <div class="dropdown-content">
                            <div>
                                <a href="cctv.php">CCTVs</a>
                            </div>
                            <div>
                                <a href="cctv-reports.php">Reports</a>
                            </div>
                        </div>
                    </div>

                    <a href="incident-categories.php">
                        <i class="fa-solid fa-square"></i>
                        <p>Incident Categories</p>
                    </a>

                    <a href="notification.php">
                        <i class="fa-solid fa-bell"></i>
                        <p>Notification</p>
                    </a>

                    <a href="sent-reports.php">
                        <i class="fa-solid fa-paper-plane"></i>
                        <p>Sent Reports</p>
                    </a>
                </div>
                <div class="lower">
                    <a href="php/logout.php">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <p>Log Out</p>
                    </a>
                </div>
            </div>
        </nav>

        <main>
            <header>
                <div class="title">
                    <div class="text">
                        <h1>Dashboard</h1>
                    </div>
                </div>
                <div class="options">

                    <button id="theme-switch">
                        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px"
                            fill="#e3e3e3">
                            <path
                                d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q10 0 20.5.67 10.5.66 24.17 2-37.67 31-59.17 77.83T444-660q0 90 63 153t153 63q53 0 99.67-20.5 46.66-20.5 77.66-56.17 1.34 12.34 2 21.84.67 9.5.67 18.83 0 150-105 255T480-120Z" />
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e3e3e3">
                            <path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-446.67H40v-66.66h160v66.66Zm720 0H760v-66.66h160v66.66ZM446.67-760v-160h66.66v160h-66.66Zm0 720v-160h66.66v160h-66.66ZM260-655.33l-100.33-97 47.66-49 96 100-43.33 46Zm493.33 496-97.66-100.34 45-45.66 99.66 97.66-47 48.34Zm-98.66-541.34 97.66-99.66 49 47L702-656l-47.33-44.67ZM159.33-207.33 259-305l46.33 45.67-97.66 99.66-48.34-47.66Z" />
                        </svg>
                    </button>

                    <div>
                        <i class="fa-solid fa-message"></i>
                    </div>

                    <div>
                        <div class="notification">
                            <a href="notification.php">
                                <i class="fa-solid fa-bell"></i>
                                <span class="notification-count hidden">0</span>
                            </a>
                        </div>
                    </div>

                </div>
            </header>
            <section>
                <div class="top">
                    <div class="monthly">
                        <div class="stats-left">
                            <p><?php echo $crimeCount; ?></p>
                        </div>
                        <div class="stats-right">
                            <div class="stats-right-top">
                                <p>Most reported incident this month</p>
                            </div>
                            <div class="stats-right-bottom">
                                <p>Crime</p>
                            </div>
                        </div>
                    </div>
                    <div class="yearly">
                        <div class="stats-left">
                            <p><?php echo $incidentCount; ?></p>
                        </div>
                        <div class="stats-right">
                            <div class="stats-right-top">
                                <p>Most reported incident this year</p>
                            </div>
                            <div class="stats-right-bottom">
                                <p>Incident</p>
                            </div>
                        </div>
                    </div>
                    <div class="monthly">
                        <div class="stats-left">
                            <p><?php echo $complainCount; ?></p>
                        </div>
                        <div class="stats-right">
                            <div class="stats-right-top">
                                <p>Least reported incident this month</p>
                            </div>
                            <div class="stats-right-bottom">
                                <p>Complain</p>
                            </div>
                        </div>
                    </div>
                    <div class="yearly">
                        <div class="stats-left">
                            <p><?php echo $disasterCount; ?></p>
                        </div>
                        <div class="stats-right">
                            <div class="stats-right-top">
                                <p>Least reported incident this year</p>
                            </div>
                            <div class="stats-right-bottom">
                                <p>Disaster</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="middle">
                    <div class="box">
                        <canvas id="reportsChart"></canvas>
                    </div>
                    <div class="box">
                        <canvas id="reportsPieChart"></canvas>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        // Function to check for new reports
function checkForNewReports() {
    fetch('php/check_new_reports.php')
        .then(response => response.json())
        .then(data => {
            const newReports = data.new_reports;
            if (newReports > 0) {
                // Alert the user if there are new reports
                alert(`You have ${newReports} new reports!`);

                // Optionally, update the notification count on the dashboard
                updateNotificationCount();
            }
        })
        .catch(error => console.error('Error checking for new reports:', error));
}

// Function to update the notification count
function updateNotificationCount() {
    fetch('php/get_notification_count.php')
        .then(response => response.json())
        .then(data => {
            const notificationCountElements = document.querySelectorAll('.notification-count');
            notificationCountElements.forEach(countElement => {
                countElement.textContent = data.count;
                countElement.classList.toggle('hidden', data.count == 0);
            });
        })
        .catch(error => console.error('Error fetching notification count:', error));
}

// Check for new reports every 10 seconds
checkForNewReports();
setInterval(checkForNewReports, 10000);
        // Toggle notification dropdown on bell click
        document.querySelector('.fa-bell').addEventListener('click', function() {
            const dropdown = document.getElementById('notification-dropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });

        // Data for the Pie Chart
        const pieData = {
            labels: ['Crime', 'Incident', 'Complain', 'Disaster'],
            datasets: [{
                label: 'Report Types',
                data: [<?php echo $crimeCount; ?>, <?php echo $incidentCount; ?>, <?php echo $complainCount; ?>, <?php echo $disasterCount; ?>],
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
                hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
            }]
        };

        const pieConfig = {
            type: 'pie',
            data: pieData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        };

        const reportsPieChart = new Chart(
            document.getElementById('reportsPieChart').getContext('2d'),
            pieConfig
        );

        const monthlyReports = <?php echo json_encode($monthlyReports); ?>;
    const barData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label: 'Total Users',
            data: monthlyReports,
            backgroundColor: '#36A2EB',
            borderColor: '#36A2EB',
            borderWidth: 1
        }]
    };

    const barConfig = {
        type: 'bar',
        data: barData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    };

    const reportsChart = new Chart(
        document.getElementById('reportsChart').getContext('2d'),
        barConfig
    );

        // Toggle dropdown menu visibility
        document.querySelectorAll('.dropdown-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevent click from closing dropdown

                // Close all other dropdowns
                document.querySelectorAll('.dropdown').forEach(dropdown => {
                    if (dropdown !== this.parentElement) {
                        dropdown.classList.remove('open');
                    }
                });

                // Toggle the clicked dropdown
                const dropdown = this.parentElement;
                dropdown.classList.toggle('open');
            });
        });

        // Keep dropdown open when clicking on an option
        document.querySelectorAll('.dropdown-content a').forEach(option => {
            option.addEventListener('click', function(event) {
                const dropdown = this.closest('.dropdown'); // Find the dropdown
                dropdown.classList.add('open'); // Keep dropdown open
            });
        });
    </script>

</body>

</html>