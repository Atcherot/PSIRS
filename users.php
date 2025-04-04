<?php include('php/auth.php'); ?>
<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'php/config.php';

// Fetch user data
$sql = "SELECT * FROM users"; // Adjust this query based on your needs
$result = $conn->query($sql);
$users = [];

if ($result->num_rows > 0) {
    // Fetch all users into an array
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Close the connection
$conn->close();
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
    <title>Public Incident Reporting System - Users</title>
    <link rel="stylesheet" href="user.css">
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

                    <a href="users.php" id="active">
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
                        <h1>Users</h1>
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
                        <button id="searchBtn" class="search-button search-btn">Search</button>
                    </div>
                    <div class="add-user">
                        <button id="addUserBtn" class="addButton add-user-btn">Add User</button>

                        <div id="addUserModal" class="modal">
                            <div class="modal-container">
                                <div class="modal-content">
                                    <p>Add New User</p>
                                    <form id="addUserForm" class="modal-form" action="add_user.php" method="POST">
                                        <div class="modal-group">
                                            <label for="firstName">First Name</label>
                                            <input type="text" id="firstName" name="firstName" required>
                                        </div>

                                        <div class="modal-group">
                                            <label for="lastName">Last Name</label>
                                            <input type="text" id="lastName" name="lastName" required>
                                        </div>

                                        <div class="modal-group">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email" required>
                                        </div>

                                        <div class="modal-group">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" name="password">
                                        </div>

                                        <div class="modal-group">
                                            <label for="role">Role</label>
                                            <select id="role" name="role" required>
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                        <div class="buttons">
                                            <a href="users.php" class="backBtn">Back</a>
                                            <button type="submit" class="submitBtn submit-btn">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom">
                    <div class="box">
                        <table class="user-table">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?php echo $user['id']; ?></td> <!-- Adjust 'id' based on your database column name -->
                                        <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                                        <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                                        <td> <!-- Properly close the previous <td> -->
                                            <button class="actionBtn editBtn" onclick="openEditModal(<?php echo $user['id']; ?>)">Edit</button>
                                            <button class="actionBtn deleteBtn" onclick="deleteUser(<?php echo $user['id']; ?>)">Delete</button>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
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


        document.getElementById('searchBtn').addEventListener('click', function() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase(); // Get the value of the search input
            const rows = document.querySelectorAll('.user-table tbody tr'); // Get all user rows from the table

            // Loop through all rows to check if the search matches
            rows.forEach(row => {
                const firstName = row.cells[2].textContent.toLowerCase(); // First name from the table cell
                const lastName = row.cells[1].textContent.toLowerCase(); // Last name from the table cell
                const email = row.cells[3].textContent.toLowerCase(); // Email from the table cell
                const role = row.cells[4].textContent.toLowerCase(); // Role from the table cell

                // Check if the row should be displayed based on the search input
                const matchesSearch = firstName.includes(searchInput) || lastName.includes(searchInput) || email.includes(searchInput) || role.includes(searchInput);

                if (matchesSearch) {
                    row.style.display = ''; // Show row if it matches
                } else {
                    row.style.display = 'none'; // Hide row if it doesn't match
                }
            });
        });
        // Get the modal
        var modal = document.getElementById("addUserModal");

        // Get the button that opens the modal
        var btn = document.getElementById("addUserBtn");

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function openEditModal(userId) {
            console.log('Opening edit modal for user ID:', userId); // Debugging

            // Fetch user data using AJAX
            fetch(`php/get_user.php?id=${userId}`)
                .then(response => response.json())
                .then(data => {
                    console.log('User data fetched:', data); // Debugging

                    // Populate the modal form with user data
                    document.getElementById("firstName").value = data.first_name;
                    document.getElementById("lastName").value = data.last_name;
                    document.getElementById("email").value = data.email;
                    document.getElementById("role").value = data.role;

                    // Set form submission for editing
                    document.getElementById("addUserForm").onsubmit = function(event) {
                        event.preventDefault(); // Prevent default form submission
                        editUser(userId); // Call the edit user function with the user ID
                    };

                    // Open the modal for editing
                    document.getElementById("addUserModal").style.display = "block";
                })
                .catch(error => console.error('Error fetching user data:', error));
        }

        function editUser(userId) {
            const formData = new FormData(document.getElementById("addUserForm"));
            formData.append('id', userId); // Ensure the user ID is passed for editing

            fetch('php/edit_user.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    console.log('Edit response:', data); // Debugging
                    alert(data); // Alert the response from the server
                    location.reload(); // Reload the page to reflect changes
                })
                .catch(error => console.error('Error editing user:', error));
        }

        function deleteUser(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                // Prepare form data
                const formData = new FormData();
                formData.append('id', userId);

                // Make an AJAX request to delete the user
                fetch('php/delete_user.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert(data); // Alert the response from the server
                        location.reload(); // Reload the page to reflect changes
                    })
                    .catch(error => console.error('Error deleting user:', error));
            }
        }
    </script>
</body>

</html>