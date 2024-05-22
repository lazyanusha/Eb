<?php
include 'connection.php';
// session_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$loggedInEmail = isset($_SESSION['email']) ? $_SESSION['email'] : null;
$guestName = '';
$profileImagePath = '';

// If user is logged in, retrieve user details
if ($loggedInEmail) {
    // Prepare SQL statements for checking admin and regular user status
    $sql_admin = "SELECT fullname, email, images FROM admins WHERE email = ?";
    $sql_user = "SELECT fullname, email, images FROM users WHERE email = ?";
    $stmt_admin = mysqli_prepare($conn, $sql_admin);
    $stmt_user = mysqli_prepare($conn, $sql_user);

    if ($stmt_admin && $stmt_user) {
        mysqli_stmt_bind_param($stmt_admin, "s", $loggedInEmail);
        mysqli_stmt_bind_param($stmt_user, "s", $loggedInEmail);

        mysqli_stmt_execute($stmt_admin);
        $result_admin = mysqli_stmt_get_result($stmt_admin);

        if ($row_admin = mysqli_fetch_assoc($result_admin)) {
            $guestName = $row_admin['fullname'];
            $profileImagePath = $row_admin['images'];
        } else {
            mysqli_stmt_execute($stmt_user);
            $result_user = mysqli_stmt_get_result($stmt_user);

            if ($row_user = mysqli_fetch_assoc($result_user)) {
                $guestName = $row_user['fullname'];
                $profileImagePath = $row_user['images'];
            }
        }
        mysqli_stmt_close($stmt_admin);
        mysqli_stmt_close($stmt_user);  
    } else {
        echo "Error: Unable to prepare SQL statements.";
        exit();
    }
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
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
                <?php if ($loggedInEmail): ?>
                <div class="dropdown" onclick="toggleDropdown()">
                    <p><?php echo htmlspecialchars($loggedInEmail); ?></p>
                    <?php if (!empty($profileImagePath) && file_exists($profileImagePath)): ?>
                    <img src="<?php echo htmlspecialchars($profileImagePath); ?>" alt="Profile Picture">
                    <?php else: ?>
                    <div class="default-profile-image"><?php echo htmlspecialchars(generateProfilePicture($guestName)); ?></div>
                    <?php endif; ?>
                    <div class="drop">
                        <div class="dropdown-content">
                            <a href="ubooking.php">Bookings</a>
                            <a href="notification.php">Notifications</a>
                            <a href="update.php">Update Profile</a>
                            <a href="logout.php" onclick="confirmLogout(event)">Log Out</a>
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
        function confirmLogout(event) {
            if (!confirm("Are you sure you want to logout?")) {
                event.preventDefault();
            }
        }

        function toggleDropdown() {
            var dropdown = document.querySelector('.dropdown');
            dropdown.classList.toggle('clicked');
        }
    </script>
</body>

</html>
