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
    <title>Public Incident Reporting System - Users</title>
    <link rel="stylesheet" href="incident-categories.css">
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

                    <a href="incident-categories.php" id="active">
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
                        <h1>Incident Categories</h1>
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
                    <div class="notification">
                        <a href="notification.php">
                            <i class="fa-solid fa-bell"></i>
                            <span class="notification-count hidden">0</span>
                        </a>
                    </div>
                </div>
            </header>
            <section>
                <div class="bottom">
                    <div class="box">
                        <div class="table-wrapper">
                            <table class="first-table">
                                <thead>
                                    <tr>
                                        <th>Active Category</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr data-category="incident">
                                        <td>Incident</td>
                                        <td>Active</td>
                                        <td class="action-box">
                                            <a href="#" class="actionBtn">Disable</a>
                                        </td>
                                    </tr>
                                    <tr data-category="crime">
                                        <td>Crime</td>
                                        <td>Active</td>
                                        <td class="action-box">
                                            <a href="#" class="actionBtn">Disable</a>
                                        </td>
                                    </tr>
                                    <tr data-category="disaster">
                                        <td>Disaster</td>
                                        <td>Active</td>
                                        <td class="action-box">
                                            <a href="#" class="actionBtn">Disable</a>
                                        </td>
                                    </tr>
                                    <tr data-category="complain">
                                        <td>Complain</td>
                                        <td>Active</td>
                                        <td class="action-box">
                                            <a href="#" class="actionBtn">Disable</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-wrapper">
                            <table class="second-table">
                                <thead>
                                    <tr>
                                        <th>Inactive Category</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
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
        // Toggle notification dropdown on bell click
        document.querySelector('.fa-bell').addEventListener('click', function () {
            const dropdown = document.getElementById('notification-dropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });

        // Function to add notifications dynamically
        function addNotification(message) {
            const notificationList = document.getElementById('notification-list');
            const li = document.createElement('li');
            li.textContent = message;
            notificationList.appendChild(li);
        }

        // Table Enable / Disable
        document.addEventListener("DOMContentLoaded", () => {
            // Load category states from localStorage when the page loads
            loadCategoryStates();

            // Add event listeners to action buttons
            const actionButtons = document.querySelectorAll('.actionBtn');
            actionButtons.forEach(button => {
                button.addEventListener('click', function () {
                    toggleCategoryStatus(this);
                });
            });

            // Save category states to localStorage whenever the page is unloaded or navigated away
            window.addEventListener('beforeunload', saveCategoryState);
        });

        // Save the state of the categories to localStorage
        function saveCategoryState() {
            const categories = [];
            const rows = document.querySelectorAll('tr[data-category]');
            rows.forEach(row => {
                const categoryId = row.getAttribute("data-category");
                const status = row.querySelector('td:nth-child(2)').textContent.trim();
                const table = row.closest('table').classList.contains('first-table') ? 'first' : 'second';
                categories.push({ categoryId, status, table });
            });
            localStorage.setItem('categoryStates', JSON.stringify(categories));
        }

        // Load the category states from localStorage
        function loadCategoryStates() {
            const storedCategories = JSON.parse(localStorage.getItem('categoryStates')) || [];
            storedCategories.forEach(category => {
                const row = document.querySelector(`tr[data-category="${category.categoryId}"]`);
                if (row) {
                    const statusCell = row.querySelector('td:nth-child(2)');
                    const actionBtn = row.querySelector('.actionBtn');

                    // Set the status and button text based on saved state
                    statusCell.textContent = category.status;
                    actionBtn.textContent = category.status === 'Active' ? 'Disable' : 'Enable';

                    // Move the row based on the saved table position
                    const targetTable = category.table === 'first'
                        ? document.querySelector('.first-table tbody')
                        : document.querySelector('.second-table tbody');

                    targetTable.appendChild(row); // Move the row to the correct table
                }
            });

            // Check for the third active category and adjust the layout
            adjustCategoryWidth();
        }

        // Function to handle toggling category status and moving rows
        function toggleCategoryStatus(button) {
            const row = button.closest('tr');
            const statusCell = row.querySelector('td:nth-child(2)');
            const currentStatus = statusCell.textContent.trim();
            const newStatus = currentStatus === 'Active' ? 'Inactive' : 'Active';

            // Change the status and button text
            statusCell.textContent = newStatus;
            button.textContent = newStatus === 'Active' ? 'Disable' : 'Enable';

            // Move the row between tables based on status
            const sourceTable = row.closest('table');
            const targetTable = newStatus === 'Inactive'
                ? document.querySelector('.second-table tbody')
                : document.querySelector('.first-table tbody');

            if (sourceTable !== targetTable) {
                targetTable.appendChild(row); // Move the row to the new table
            }

            saveCategoryState(); // Save the updated state immediately after any change

            // After toggling, adjust the layout
            adjustCategoryWidth();
        }

        // Function to adjust the layout when the third category is active
        function adjustCategoryWidth() {
            const activeCategories = document.querySelectorAll('.first-table tbody tr[data-category]:not([style*="display: none"])');
            if (activeCategories.length >= 3) {
                activeCategories[2].classList.add('expand-width');
            } else {
                const rows = document.querySelectorAll('.first-table tbody tr');
                rows.forEach(row => row.classList.remove('expand-width'));
            }
        }

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
    </script>

</body>

</html>