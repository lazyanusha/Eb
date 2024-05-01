<?php
session_start();
include 'connection.php';
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit(); 
}

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
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/dashboard.css">
</head>

<body>
    <div class="dash--heading">
        <div class="hotel--name">
           <a href="dashboard.php"> <img src="./images/logo3.png" alt="img"></a>
        </div>
        <div class="admin--profile">
            <?php
            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $sql = "SELECT email, fullname FROM admins WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) === 1) {
                    $row = mysqli_fetch_assoc($result);
                    $adminEmail = $row["email"];
                    $adminFullname = $row["fullname"];
                    echo '<p>' . $adminEmail . '</p>';

                    // Check if profile image exists, otherwise display initials
                    $profileImagePath = 'profile_images/' . generateProfilePicture($adminFullname) . '.png';
                    if (file_exists($profileImagePath)) {
                        echo '<img src="' . $profileImagePath . '" alt="Profile Picture">';
                    } else {
                        echo '<div class="default-profile-image">' . generateProfilePicture($adminFullname) . '</div>';
                    }
                } else {
                    echo "Admin details not found.";
                }
            } else {
                echo "Admin email not found in session.";
            }
            ?>
        </div>

    </div>
</body>

</html>
