<?php include('php/auth.php'); ?>
<?php 
require 'php/config.php';

// Initialize filter variables
$from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
$to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';

// Define report types and their respective fields
$report_types = [
    'Crime' => ['table' => 'crime_reports', 'date_field' => 'reportDate'],
    'Incident' => ['table' => 'incident_reports', 'date_field' => 'submitted_at'],
    'Disaster' => ['table' => 'disaster_reports', 'date_field' => 'reportedAt'],
    'Complain' => ['table' => 'complaint_reports', 'date_field' => 'submitted_at']
];

// Base query and conditions
$query_parts = [];
$params = [];
$types = "";

foreach ($report_types as $category => $details) {
    $query = "SELECT '$category' AS category, id, {$details['date_field']} AS date_time, status FROM {$details['table']} WHERE status = 'Resolved'";
    
    $conditions = [];
    if (!empty($from_date)) {
        $conditions[] = "{$details['date_field']} >= ?";
        $params[] = "$from_date 00:00:00";
        $types .= "s";
    }
    if (!empty($to_date)) {
        $conditions[] = "{$details['date_field']} <= ?";
        $params[] = "$to_date 23:59:59";
        $types .= "s";
    }
    if (!empty($type) && $type === $category) {
        $conditions[] = "'$category' = ?";
        $params[] = $type;
        $types .= "s";
    }
    
    if (!empty($conditions)) {
        $query .= " AND " . implode(' AND ', $conditions);
    }
    
    $query_parts[] = $query;
}

// Combine queries with UNION ALL
$final_query = implode(' UNION ALL ', $query_parts) . " ORDER BY date_time DESC";

$stmt = $conn->prepare($final_query);
if ($types) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
if (!$result) {
    die('Query failed: ' . $conn->error);
}
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
    <title>Public Incident Reporting System - Sent Reports</title>
    <link rel="stylesheet" href="sent-report1.css">
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
                    <a href="dashboard.php">
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
                        <i class="fa-solid fa-table"></i>
                        <p>Incident Categories</p>
                    </a>

                    <a href="notification.php">
                        <i class="fa-solid fa-bell"></i>
                        <p>Notification</p>
                    </a>

                    <a href="sent-reports.php" id="active">
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
                        <h1>Sent Reports</h1>
                    </div>
                </div>
                <div class="options">

                    <button id="theme-switch">
                        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px"
                            fill="#e3e3e3">
                            <path
                                d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q10 0 20.5.67 10.5.66 24.17 2-37.67 31-59.17 77.83T444-660q0 90 63 153t153 63q53 0 99.67-20.5 46.66-20.5 77.66-56.17 1.34 12.34 2 21.84.67 9.5.67 18.83 0 150-105 255T480-120Z" />
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px"
                            fill="#e3e3e3">
                            <path
                                d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-446.67H40v-66.66h160v66.66Zm720 0H760v-66.66h160v66.66ZM446.67-760v-160h66.66v160h-66.66Zm0 720v-160h66.66v160h-66.66ZM260-655.33l-100.33-97 47.66-49 96 100-43.33 46Zm493.33 496-97.66-100.34 45-45.66 99.66 97.66-47 48.34Zm-98.66-541.34 97.66-99.66 49 47L702-656l-47.33-44.67ZM159.33-207.33 259-305l46.33 45.67-97.66 99.66-48.34-47.66Z" />
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
    <form method="GET" action="sent-reports.php">
        <div class="top">
            <div class="calendar">
                <div class="from">
                    <p>From: </p>
                    <input type="date" name="from_date" value="<?php echo htmlspecialchars($from_date); ?>">
                </div>
                <div class="to">
                    <p>To: </p>
                    <input type="date" name="to_date" value="<?php echo htmlspecialchars($to_date); ?>">
                </div>
                <div class="filter-date">
                    <button type="submit">Filter</button>
                </div>
            </div>
            <div class="filter">
                <div class="filter-select">
                    <p>Type: </p>
                    <select name="type">
                        <option value="" <?php echo $type === '' ? 'selected' : ''; ?>>All</option>
                        <option value="Complain" <?php echo $type === 'Complain' ? 'selected' : ''; ?>>Complain</option>
                        <option value="Crime" <?php echo $type === 'Crime' ? 'selected' : ''; ?>>Crime</option>
                        <option value="Disaster" <?php echo $type === 'Disaster' ? 'selected' : ''; ?>>Disaster</option>
                        <option value="Incident" <?php echo $type === 'Incident' ? 'selected' : ''; ?>>Incident</option>
                    </select>
                </div>
                <div class="filter-type">
                    <button type="submit">Search</button>
                </div>
            </div>
        </div>
    </form>
                <div class="middle">
                    <div class="table-wrapper">
                        <table class="first-table">
                            <thead>
                <tr>
                    <th>Date and Time</th>
                    <th>Report Category</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
<tbody>
    <?php 
    $hasData = false;
    while ($row = $result->fetch_assoc()): 
        $hasData = true;
    ?>
        <tr>
            <td><?php echo htmlspecialchars($row['date_time']); ?></td>
            <td><?php echo htmlspecialchars($row['category']); ?></td>
            <td><?php echo htmlspecialchars($row['status']); ?></td>
            <td class="action-box">
                <a href="php/generate_pdf.php?id=<?php echo $row['id']; ?>&category=<?php echo $row['category']; ?>" class="actionBtn">View</a>
                <a href="delete_report.php?id=<?php echo $row['id']; ?>&category=<?php echo $row['category']; ?>" class="actionBtn">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
    <?php if (!$hasData): ?>
        <tr>
            <td colspan="4" style="text-align: center;">No <?php echo $type ? $type : 'reports'; ?> resolved</td>
        </tr>
    <?php endif; ?>
</tbody>

                        </table>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
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

        // Tawagin agad ang function at i-refresh ang count tuwing 5 seconds
        updateNotificationCount();
        setInterval(updateNotificationCount, 5000);

        // Toggle dropdown menu visibility
        document.querySelectorAll('.dropdown-btn').forEach(button => {
            button.addEventListener('click', function (event) {
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
            option.addEventListener('click', function (event) {
                const dropdown = this.closest('.dropdown'); // Find the dropdown
                dropdown.classList.add('open'); // Keep dropdown open
            });
        });

        // Function to add new rows dynamically (simulating data addition)
        function addNewRow(date, description, type) {
            const tableBody = document.querySelector('#incidentTable tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${date}</td>
                <td>${description}</td>
                <td>${type}</td>
                <td class="action-box">
                    <a href="#" class="actionBtn">View</a>
                    <a href="#" class="actionBtn">Delete</a>
                </td>
            `;
            tableBody.appendChild(newRow);
            updateNotificationCount(); // Update the notification count when a new row is added
        }
        

    </script>

</body>

</html>