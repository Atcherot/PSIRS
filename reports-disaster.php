<?php include('php/auth.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Public Incident Reporting System - Reports</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="report-styles1.css">
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
                                <a href="reports-disaster.php" id="active">Disaster</a>
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
                        <h1>Incident Reports - Disaster</h1>
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
                    <div class="search-box">
                        <input type="text" id="searchInput" placeholder="Search..." class="search-bar">
                        <select id="roleFilter" class="filter-select">
                            <option value="">Filter</option>
                            <option value="admin">Incident</option>
                            <option value="user">Crime</option>
                            <option value="user">Complain</option>
                            <option value="user">Disaster</option>
                        </select>
                        <button id="searchBtn" class="search-button search-btn">Search</button>
                    </div>
                    <div class="delete-reports">
                        <div class="delete-all">
                            <button>Delete All</button>
                        </div>
                        <div class="delete-multiple">
                            <i class="fa-solid fa-trash" title="Delete Selected"></i>
                        </div>
                    </div>
                </div>
                <div class="bottom">
                    <div class="box">
                        <table id="datatable" class="user-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Type of Disaster</th>
                                    <th>Location</th>
                                    <th>Date / Time</th>
                                    <th>Status</th>
                                    <th>Name of sender</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
// Database connection
include('php/config.php');

// Initialize search and filter variables
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$filter = isset($_GET['filter']) ? trim($_GET['filter']) : '';

// Construct the query
$query = "SELECT dr.*, rd.first_name, rd.last_name, rd.phone_number FROM disaster_reports dr LEFT JOIN reporters_disaster rd ON dr.id = rd.report_id WHERE 1";

// Add search condition if search term is provided
if (!empty($search)) {
    $query .= " AND (dr.disasterType LIKE '%" . mysqli_real_escape_string($conn, $search) . "%' OR rd.first_name LIKE '%" . mysqli_real_escape_string($conn, $search) . "%' OR rd.last_name LIKE '%" . mysqli_real_escape_string($conn, $search) . "%')";
}

// Add filter condition if filter is provided
if (!empty($filter)) {
    $query .= " AND dr.disasterType = '" . mysqli_real_escape_string($conn, $filter) . "'";
}

// Execute the query
$result = mysqli_query($conn, $query);

// Fetch results and display them
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><input type='checkbox' name='selected[]' value='" . htmlspecialchars($row['id']) . "'></td>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['disasterType']) . "</td>";
        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
        echo "<td>" . htmlspecialchars($row['reportedAt']) . "</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "<td>" . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . "<br>Phone: " . htmlspecialchars($row['phone_number']) . "</td>";
        echo "<td class='actionBtn'>
    <a href='php/disaster_pdf.php?id=" . htmlspecialchars($row['id']) . "' class='actionButton' target='_blank'>View</a>
    <a href='#' class='actionButton' onclick='deleteReport(" . htmlspecialchars($row['id']) . ")'>Delete</a>
    <a href='#' class='actionButton' onclick='sendReport(" . htmlspecialchars($row['id']) . ")'>Send</a>
</td>";

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>No reports found</td></tr>";
}
?>


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
        function deleteReport(id) {
            if (confirm("Are you sure you want to delete this report?")) {
                fetch('delete-disaster.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${encodeURIComponent(id)}`,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert(data.message);
                        location.reload(); // I-refresh ang page para makita ang updated status
                        const row = document.querySelector(`tr[data-id='${id}']`);
                        if (row) row.remove();
                    } else {
                        alert(`Error: ${data.message}`);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("An unexpected error occurred. Please try again.");
                });
            }
        }
       function sendReport(reportId) {
    if (confirm('Are you sure you want to verify this report?')) {
        fetch(`php/get_reportdisaster_status.php?id=${reportId}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Report Status Response:', data); // Debugging line

            if (data.success) {
                if (data.status === 'verified') {
                    alert('This report has already been verified.');
                    return;
                }

                fetch(`php/update_status_disaster.php?id=${reportId}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Update Status Response:', data); // Debugging line

                    if (data.success) {
                        alert('Report has been verified.');
                        location.reload();
                    } else {
                        alert('Failed to verify the report: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error updating report:', error);
                    alert('An error occurred while verifying the report.');
                });
            } else {
                alert('Failed to fetch report status.');
            }
        })
        .catch(error => {
            console.error('Error fetching report status:', error);
            alert('An error occurred while fetching the report status.');
        });
    }
}
        // Handle search and filter actions
document.getElementById('searchBtn').addEventListener('click', () => {
    const searchValue = document.getElementById('searchInput').value;
    const filterValue = document.getElementById('roleFilter').value;
    window.location.href = `reports-disaster.php?search=${encodeURIComponent(searchValue)}&filter=${encodeURIComponent(filterValue)}`;
});

// Handle filter change to automatically search
document.getElementById('roleFilter').addEventListener('change', () => {
    const searchValue = document.getElementById('searchInput').value;
    const filterValue = document.getElementById('roleFilter').value;
    window.location.href = `reports-disaster.php?search=${encodeURIComponent(searchValue)}&filter=${encodeURIComponent(filterValue)}`;
});
$(document).ready(function() {
        $('#datatable').DataTable({
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>",
                },
            },
            drawCallback: function() {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded')
            },
        })
        var a = $('#datatable-buttons').DataTable({
            lengthChange: !1,
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>",
                },
            },
            drawCallback: function() {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded')
            },
            buttons: ['copy', 'excel', 'pdf', 'colvis'],
        })
        a
            .buttons()
            .container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)'),
            $('.dataTables_length select').addClass('form-select form-select-sm'),
            $('#selection-datatable').DataTable({
                select: {
                    style: 'multi'
                },
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>",
                    },
                },
                drawCallback: function() {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded')
                },
            }),
            $('#key-datatable').DataTable({
                keys: !0,
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>",
                    },
                },
                drawCallback: function() {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded')
                },
            }),
            a
            .buttons()
            .container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)'),
            $('.dataTables_length select').addClass('form-select form-select-sm'),
            $('#alternative-page-datatable').DataTable({
                pagingType: 'full_numbers',
                drawCallback: function() {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded'),
                        $('.dataTables_length select').addClass('form-select form-select-sm')
                },
            }),
            $('#scroll-vertical-datatable').DataTable({
                scrollY: '350px',
                scrollCollapse: !0,
                paging: !1,
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>",
                    },
                },
                drawCallback: function() {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded')
                },
            }),
            $('#complex-header-datatable').DataTable({
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>",
                    },
                },
                drawCallback: function() {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded'),
                        $('.dataTables_length select').addClass('form-select form-select-sm')
                },
                columnDefs: [{
                    visible: !1,
                    targets: -1
                }],
            }),
            $('#state-saving-datatable').DataTable({
                stateSave: !0,
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>",
                    },
                },
                drawCallback: function() {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded'),
                        $('.dataTables_length select').addClass('form-select form-select-sm')
                },
            })
    })
    </script>
</body>

</html>