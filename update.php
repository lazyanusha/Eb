<?php
session_start();

include 'connection.php';
include 'nav.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
function hashPassword($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}


$loggedInEmail = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $loggedInEmail);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password1'];
    $hashedPassword = hashPassword($password);


    // Check if image file is uploaded
    if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sql_users = "UPDATE users SET fullname=?, email=?, phone=?, password=?, images=? WHERE email=?";
            $stmt_users = mysqli_prepare($conn, $sql_users);
            mysqli_stmt_bind_param($stmt_users, "ssssss", $fullname, $email, $phone, $hashedPassword, $target_file, $loggedInEmail);

            $sql_admins = "UPDATE admins SET fullname=?, email=?, phone=?, password=?, images=? WHERE email=?";
            $stmt_admins = mysqli_prepare($conn, $sql_admins);
            mysqli_stmt_bind_param($stmt_admins, "ssssss", $fullname, $email, $phone, $hashedPassword, $target_file, $loggedInEmail);

            if (mysqli_stmt_execute($stmt_users)) {
                if (mysqli_stmt_execute($stmt_admins)) {
                    if ($email != $loggedInEmail) {
                        $_SESSION['email'] = $email;
                    }

                    echo "<script>alert('User details updated successfully!!'); window.location='dashboard.php';</script>";
                    exit();
                } else {
                    echo "Error updating admin details: " . mysqli_error($conn);
                }
            } else {
                echo "Error updating user details: " . mysqli_error($conn);
            }

            // Close the statements
            mysqli_stmt_close($stmt_users);
            mysqli_stmt_close($stmt_admins);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Error: " . $_FILES["image"]["error"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Update </title>
    <link rel="stylesheet" href="./css/dashboard.css">
    <style>
        input[type='submit'] {
            width: 10%;
            align-self: center;
            border: none;
        }

        button,
        input[type='submit'] {
            padding: 9px 25px !important;
            cursor: pointer;
            background: linear-gradient(to top, #7969c7, #2b3454);
            color: #f9f9f9 !important;
            border: none;
        }

        form {
            padding: 0px 50px;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            justify-content: center;
        }

        .container {
            height: 60vh;
            display: flex;
            justify-content: space-evenly !important;
            column-gap: 50px;
            align-items: center;
            flex-wrap: wrap;
            padding: 6px 40px;
            background-color: #f9f9f9;
            border: 1px solid #7969c7;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>


    <div class="contain">
        <div class="heading">
            <div class="part">
                <h2>User Details...</h2>
            </div>
            <div class="search">
                <a href="admin.php">
                    <button type="submit">Back</button>
                </a>
            </div>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            onsubmit="return validateForm()" enctype="multipart/form-data">

            <div class="container">
                <div class="elements">
                    <label for="fname">Full Name:</label>
                    <input type="text" id="fname" name="fname" value="<?php echo $user['fullname']; ?>" required />
                </div>
                <div class="elements">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required />
                </div>
                <div class="elements">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo $user['phone']; ?>" required />
                </div>
                <div class="elements">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password1" required />
                    <div id="passwordFeedback"></div>
                </div>
                <div class="elements">
                    <label for="password">Confirm password:</label>
                    <input type="password" id="password2" name="password2" required />
                </div>
                <div>
                    <label for="image">Profile Picture:</label>
                    <input type="file" name="image" id="image">
                </div>
            </div>
            <input type="submit" name="update" value="Save changes" onclick="return confirm('Confirm update?')" />
        </form>
    </div>


    </div>

    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("password2").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match");
                return false;
            }
            var strength = 0;
            if (password.length >= 8) strength += 1;
            if (password.match(/[a-z]+/)) strength += 1;
            if (password.match(/[A-Z]+/)) strength += 1;
            if (password.match(/[0-9]+/)) strength += 1;
            if (password.match(/[\W_]+/)) strength += 1;

            var feedback = "";
            switch (strength) {
                case 0:
                case 1:
                case 2:
                    feedback = "Weak";
                    break;
                case 3:
                case 4:
                    feedback = "Moderate";
                    break;
                case 5:
                    feedback = "Strong";
                    break;
            }
            document.getElementById("passwordFeedback").innerText = "Password Strength: " + feedback;
            return strength >= 3;
        }
        function formatPhoneNumber(input) {
            var phoneNumber = input.value.replace(/\D/g, '');
            if (phoneNumber.length > 10) {
                phoneNumber = phoneNumber.slice(0, 10);
            }
            var formattedPhoneNumber = phoneNumber.replace(/(\d{3})(\d{3})(\d{4})/, '$1$2$3');
            input.value = formattedPhoneNumber;
        }
    </script>
</body>

</html>
<?php
include 'footer.php';
?>