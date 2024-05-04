<?php
include 'connection.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Retrieve logged-in user's email
$loggedInEmail = $_SESSION['email'];

// Check if the logged-in user is an admin or a regular user
$sql_admin = "SELECT fullname, email, images FROM admins WHERE email = ?";
$sql_user = "SELECT fullname, email, images FROM users WHERE email = ?";
$stmt_admin = mysqli_prepare($conn, $sql_admin);
$stmt_user = mysqli_prepare($conn, $sql_user);

if ($stmt_admin && $stmt_user) {
    mysqli_stmt_bind_param($stmt_admin, "s", $loggedInEmail);
    mysqli_stmt_bind_param($stmt_user, "s", $loggedInEmail);

    if (mysqli_stmt_execute($stmt_admin)) {
        $result_admin = mysqli_stmt_get_result($stmt_admin);
        if ($row_admin = mysqli_fetch_assoc($result_admin)) {
            $guestName = $row_admin['fullname'];
            $logEmail = $row_admin['email'];
            $profileImagePath = $row_admin['images']; // Set profile image path
        } else {
            if (mysqli_stmt_execute($stmt_user)) {
                $result_user = mysqli_stmt_get_result($stmt_user);
                if ($row_user = mysqli_fetch_assoc($result_user)) {
                    $guestName = $row_user['fullname'];
                    $logEmail = $row_user['email'];
                    $profileImagePath = $row_user['images']; // Set profile image path
                }
            }
        }
        mysqli_stmt_close($stmt_admin);
    } else {
        echo "Error executing admin query: " . mysqli_error($conn);
        exit;
    }
} else {
    echo "Error: Unable to prepare SQL statements.";
    exit;
}

// Function to generate profile picture initials
function generateProfilePicture($fullname)
{
    $names = explode(" ", $fullname);
    $firstInitial = strtoupper(substr($names[0], 0, 1));
    $lastInitial = isset($names[1]) ? strtoupper(substr($names[1], 0, 1)) : '';
    return $firstInitial . $lastInitial;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="./css/home.css">
</head>

<body>
    <nav>
        <div class="navigation_bar">

            <div class="logo">
                <a href="landing.php"><img src="./images/logo3.png" alt="logo"></a>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="landing.php">Home</a></li>
                    <li><a href="Aboutus.php">About Us</a></li>
                    <li><a href="hotellist.php">Hotels</a></li>
                    <li><a href="contact_us.php">Contact Us</a></li>
                </ul>
            </div>
            <div class="admin--profile">
                <?php if (isset($logEmail)): ?>
                <div class="dropdown" onclick="toggleDropdown()">
                    <p><?php echo $logEmail; ?></p>
                    <?php if (!empty($profileImagePath) && file_exists($profileImagePath)): ?>
                    <img src="<?php echo $profileImagePath; ?>" alt="Profile Picture">
                    <?php else: ?>
                    <div class="default-profile-image"><?php echo generateProfilePicture($guestName); ?></div>
                    <?php endif; ?>
                    <div class="drop">
                        <div class="dropdown-content">
                            <a href="ubooking.php">Bookings</a>
                            <a href="notification.php">Notifications</a>
                            <a href="update.php">Update Profile</a>
                            <a href="logout.php" onclick="confirmLogout()">Log Out</a>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <a href="login.php">Log In</a>
                <a href="signup.php">Sign Up</a>
                <?php endif; ?>
            </div>

        </div>
    </nav>

    <script>
        function confirmLogout() {
            var logout = confirm("Are you sure you want to logout?");
            if (logout) {
                window.location.href = "logout.php";
            }
        }

        function toggleDropdown() {
            var dropdown = document.querySelector('.dropdown');
            dropdown.classList.toggle('clicked');
        }
        
    </script>

</body>

</html>
