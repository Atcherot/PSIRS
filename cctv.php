<?php include('php/auth.php'); ?>
<?php
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    exit();
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
    <title>Public Incident Reporting System - Users</title>
    <link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet">
<script src="https://vjs.zencdn.net/7.10.2/video.js"></script>
    <link rel="stylesheet" href="cctv.css">
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
                                <a href="cctv.php" id="active">CCTVs</a>
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
                        <h1>CCTVs</h1>
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
                <div class="box">
                    <div class="cctv cctv-1">
                        <img id="cctv1" src="https://192.168.8.105:8080/video" width="100%" height="455" alt="Live CCTV Feed">
                        <canvas id="canvas1" width="800" height="455" style="display:none;"></canvas>
                    </div>
                    <div class="cctv cctv-2">
                        <img id="cctv2" src="" width="100%" height="455" alt="Live CCTV Feed">
                        <canvas id="canvas2" width="725" height="455" style="display:none;"></canvas>
                    </div>
                    <div class="cctv cctv-3">
                        <img id="cctv3" src="" width="100%" height="455" alt="Live CCTV Feed">
                        <canvas id="canvas3" width="725" height="455" style="display:none;"></canvas>
                    </div>
                    <div class="cctv cctv-4">
                        <img id="cctv4" src="" width="100%" height="455" alt="Live CCTV Feed">
                        <canvas id="canvas4" width="725" height="455" style="display:none;"></canvas>
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
        const cctvs = [
            { id: 'cctv1', canvasId: 'canvas1', lastFrame: null },
            { id: 'cctv2', canvasId: 'canvas2', lastFrame: null },
            { id: 'cctv3', canvasId: 'canvas3', lastFrame: null },
            { id: 'cctv4', canvasId: 'canvas4', lastFrame: null }
        ];

        function checkMotion(cctv) {
    const img = document.getElementById(cctv.id);
    const canvas = document.getElementById(cctv.canvasId);
    if (!canvas || !img) return; // ✅ Prevent errors if elements are missing

    const ctx = canvas.getContext('2d');

    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
    const frame = ctx.getImageData(0, 0, canvas.width, canvas.height);

    if (cctv.lastFrame) {
        let motionDetected = false;
        for (let i = 0; i < frame.data.length; i += 4) {
            const diff = Math.abs(frame.data[i] - cctv.lastFrame.data[i]) > 20;
            if (diff) {
                motionDetected = true;
                break;
            }
        }

        if (motionDetected) {
            console.log('Motion detected on:', cctv.id);
            fetch('report_incident.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ camera: cctv.id, timestamp: new Date().toISOString() })
            });
        }
    }

    cctv.lastFrame = frame;
}

    </script>

</body>

</html>