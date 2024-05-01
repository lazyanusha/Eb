<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .dropdown-btn {
            cursor: pointer;
            position: relative;
            color: #6869ce;
        }

        .dropdown-btn i {
            position: absolute;
            color: #6869ce;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            transition: transform 0.3s ease;
        }

        .dropdown-content {
            background-color: #f9f9f9;
            color: #6869ce;
            display: none;
        }

        .dropdown.active .dropdown-content {
            display: block;

        }

        .dropdown-btn:hover,
        .dropdown-btn i:hover {
            color: #6869ce;
        }

        .dropdown:hover {
            background-color: #f9f9f9 !important;
        }

        .dropdown.active .dropdown-btn i {
            transform: translateY(-50%) rotate(90deg);
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <!-- Main Navigation Links -->
        <ul class="main">
            <li><a href="dashboard.php">
                    <div>Dashboard</div>
                </a></li>
            <li>
                <a href="admin.php">
                    <div>
                        Admins
                    </div>
                </a>
            </li>
            <li>
                <a href="bookingmanage.php">
                    <div>
                        Booking Manage
                    </div>
                </a>
            </li>
            <li>
                <a href="rooms.php">
                    <div>Rooms</div>
                </a>
            </li>
            <li class="dropdown">
                <div class="dropdown-btn">
                    Manage Hotel
                    <i class="fas fa-chevron-right"></i>
                </div>
                <ul class="dropdown-content">
                    <li><a href="hoteladd.php">Add Hotel</a></li>
                    <li><a href="imagegallery.php">Image Gallery</a></li>
                    <li><a href="hotel-list.php">Hotels list</a></li>
                </ul>
            </li>
            <li><a href="logout.php">
                    <div  onclick="return confirm('Are you sure you want to logout?')">Log out</div>
                </a></li>
        </ul>
    </div>

    <script>
        document.querySelectorAll('.dropdown-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const parent = this.parentElement;
                parent.classList.toggle('active');
            });
        });

    </script>
</body>

</html>