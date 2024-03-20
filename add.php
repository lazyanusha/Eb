<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .dropdown-btn {
            cursor: pointer;
            position: relative;
        }

        .dropdown-btn i {
            position: absolute;
            color: white;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            transition: transform 0.3s ease;
        }

        .dropdown-content {
            display: none;
            position: inherit;
        }

        .dropdown.active .dropdown-content {
            display: block;
        }

        .dropdown.active .dropdown-btn i {
            transform: translateY(-50%) rotate(90deg);
        }

        .mainform {
            margin: 40px;
            padding: 20px;
            border: 0.5px solid black;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            column-gap: 40px;
        }

        .elements {
            width: 30%;
            padding: 30px;
        }

        .elements input {
            width: 100%;
            padding: 10px;
        }

        .elements button {
            padding: 15px 45px;
        }
        .elements select{
            padding: 10px 40px;
        }
    </style>
</head>

<body>
    <div class="dash--heading">
        <div class="hotel--name">
            <p>Easybookings</p>
        </div>
        <div class="second--part1">
            <div class="search">
                <form action="">
                    <input type="search" placeholder="search here" name="search" />
                    <button type="submit">search</button>
                </form>
            </div>
            <div class="admin--profile">
                <p>Welcome sweetpea.!</p>
                <a href="g-setting.php"> <img src="./images/logo3.png" alt="img"></a>
            </div>
        </div>
    </div>
    <div class="dashboard">
        <div class="sidebar">
            <ul class="main">
                <li>
                    <a href="dashboard.php">
                        <div>Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="guest.php">
                        <div>Guests</div>
                    </a>
                </li>
                <li class="dropdown">
                    <div class="dropdown-btn">
                        Booking Manage
                        <i class="fas fa-chevron-right"></i>
                    </div>
                    <ul class="dropdown-content">
                        <li><a href="booking_request.php">Booking Requests</a></li>
                        <li><a href="all_bookings.php">All Bookings</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <div>Rooms</div>
                    </a>
                </li>
                <li class="dropdown">
                    <div class="dropdown-btn">
                        Manage Hotel
                        <i class="fas fa-chevron-right"></i>
                    </div>
                    <ul class="dropdown-content">
                        <li><a href="roomtype.php">Room Type</a></li>
                        <li><a href="facilities.php">Facilities</a></li>
                    </ul>
                </li>
                <li>
                    <a href="setting.php">
                        <div>Settings</div>
                    </a>
                </li>
            </ul>
        </div>

        <div class="second--section">
            <div class="more--details">
                <h2>Room Type</h2>
                <a href="roomtype.php"><button>Back to list</button></a>
            </div>
            <hr>
            <form class="mainform" action="">
                <div class="container">
                    <div class="elements">
                        <label for="roomtype">Room Type</label><br>
                        <input type="text" required>
                    </div>
                    <div class="elements">
                        <label for="roomcount">Room Count</label><br>
                        <input type="number" required>
                    </div>
                    <div class="elements">
                        <label for="bedtype">Bed Type</label><br>
                        <input type="text" required>
                    </div>
                    <div class="elements">
                        <label for="bedcount">Bed Count</label><br>
                        <input type="number" required>
                    </div>
                    <div class="elements">
                        <label for="Image">Image</label><br>
                        <input type="file" required>
                    </div>
                    <div class="elements">
                        <label for="status">Status</label><br>
                        <select name="" id="">
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>

                </div>
                <hr>
                <div class="elements">
                    <a href="roomtype.php"><button type="submit">Save</button></a>
                </div>
            </form>

        </div>

    </div>
    <div class="footer"></div>

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