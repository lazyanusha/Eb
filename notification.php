<?php
session_start();
include 'connection.php';
include 'nav.php';

if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit;
}

if (isset($_SESSION['email'])) {
    $userEmail = $_SESSION['email'];
    $sql_admin = "SELECT fullname, phone FROM admins WHERE email = ?";
    $sql_user = "SELECT fullname, phone FROM users WHERE email = ?";
    $stmt_admin = mysqli_prepare($conn, $sql_admin);
    $stmt_user = mysqli_prepare($conn, $sql_user);

    if ($stmt_admin && $stmt_user) {
        mysqli_stmt_bind_param($stmt_admin, "s", $_SESSION['email']);
        mysqli_stmt_bind_param($stmt_user, "s", $_SESSION['email']);

        if (mysqli_stmt_execute($stmt_admin)) {
            $result_admin = mysqli_stmt_get_result($stmt_admin);
            if ($row_admin = mysqli_fetch_assoc($result_admin)) {
                $guestName = $row_admin['fullname'];
                $contact = $row_admin['phone'];
            }
            mysqli_stmt_close($stmt_admin);
        } else {
            echo "Error executing admin query: " . mysqli_error($conn);
            exit;
        }

        if (empty($guestName)) {
            if (mysqli_stmt_execute($stmt_user)) {
                $result_user = mysqli_stmt_get_result($stmt_user);
                if ($row_user = mysqli_fetch_assoc($result_user)) {
                    $guestName = $row_user['fullname'];
                    $contact = $row_user['phone'];
                } else {
                    echo "User not found.";
                    exit;
                }
            } else {
                echo "Error executing user query: " . mysqli_error($conn);
                exit;
            }
        }
        mysqli_stmt_close($stmt_user);
    } else {
        echo "Error preparing queries: " . mysqli_error($conn);
        exit;
    }
} else {
    echo "User email not found in session.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Notifications</title>
    <link rel="stylesheet" href="./css/dashboard.css">
</head>

<body>
    <div class="table">
        <p>Notifications</p>
        <table>
            <thead>
                <tr>
                    <th>S.no</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch reservation status from the database
                $sql_reservation = "SELECT reservation_status FROM reservations WHERE email = ?";
                $stmt_reservation = mysqli_prepare($conn, $sql_reservation);

                if ($stmt_reservation) {
                    mysqli_stmt_bind_param($stmt_reservation, "s", $_SESSION['email']);
                    if (mysqli_stmt_execute($stmt_reservation)) {
                        $result_reservation = mysqli_stmt_get_result($stmt_reservation);
                        $serialNumber = 1;
                        while ($row_reservation = mysqli_fetch_assoc($result_reservation)) {
                            $reservationStatus = $row_reservation['reservation_status'];
                            switch ($reservationStatus) {
                                case "confirmed":
                                    $notificationMessage = "Congratulations! Your reservation has been confirmed.";
                                    break;
                                case "declined":
                                    $notificationMessage = "You have cancelled the reservation.";
                                    break;
                                case "cancelled":
                                    $notificationMessage = "We are sorry, your reservation has been declined because of various technical problems. Would you like to try on other hotels?";

                                    break;
                                default:
                                    $notificationMessage = "Reservation status oncheck.";
                            }

                            // Display notification message in the HTML table
                            echo '<tr>';
                            echo '<td>' . $serialNumber . '</td>';
                            echo '<td>' . $notificationMessage . '</td>';
                            echo '<td><button>Delete</button></td>';
                            echo '</tr>';

                            $serialNumber++; // Increment serial number
                        }
                    } else {
                        echo "Error executing reservation query: " . mysqli_error($conn);
                        exit;
                    }
                    mysqli_stmt_close($stmt_reservation);
                } else {
                    echo "Error preparing reservation query: " . mysqli_error($conn);
                    exit;
                }
                ?>
            </tbody>

        </table>
    </div>
</body>

</html>
<?php
include 'footer.php';
?>