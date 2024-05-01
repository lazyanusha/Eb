<?php

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password1'];

    // Check if image file is uploaded
    if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insert data into the database
            $sql = "INSERT INTO admins (fullname, email, phone, password, images) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssss", $fullname, $email, $phone, $password, $target_file);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['admin_id'] = $admin_id;
                echo "<script>alert('Admin added successfully');</script>";
                header("Location: admin.php");
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
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
    <title>Admins </title>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        input[type='submit'],
        button {
            padding: 8px 20px !important;
            cursor: pointer;
            background: linear-gradient(to top, #7969c7, #2b3454);
            color: #f9f9f9;
        }

        button {
            padding: 8px 25px !important;
            cursor: pointer;
            background: linear-gradient(to top, #7969c7, #2b3454);
            color: #f9f9f9 !important;
            border: none;
        }

        form {
            padding: 0px 50px;
        }

        .container {
            padding: 30px;
            display: flex;
            justify-content: flex-start !important;
            column-gap: 50px;
            align-items: flex-start;
            flex-wrap: wrap;
            padding: 6px 40px;
            background-color: #f9f9f9;
            border: 1px solid #7969c7;
            row-gap: 50px;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <?php include 'dashhead.php'; ?>

    <div class="dashboard">
        <!-- Sidebar Section -->
        <?php include 'sidebar.php'; ?>

        <div class="second--section">
            <div class="heading">
                <div class="part">
                    <h2>Admin Details...</h2>
                </div>
                <div class="search">
                    <a href="admin.php">
                        <button type="submit">Back</button>
                    </a>
                </div>
            </div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                enctype="multipart/form-data">

                <div class="container">
                    <div class="elements">
                        <label for="fname">Full Name:</label>
                        <input type="text" id="fname" name="fname" required />
                    </div>
                    <div class="elements">

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required />
                    </div>

                    <div class="elements">
                        <label for="phone">Phone Number:</label>
                        <input type="tel" id="phone" name="phone" />
                    </div>

                    <div class="elements">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password1" required />
                    </div>


                    <div class="elements">
                        <label for="password">Confirm password:</label>
                        <input type="password" id="password2" name="password2" required />
                    </div>

                    <label for="image">Profile Picture:</label>
                    <input type="file" name="image" id="image">

                </div>

                <input type="submit" name="update_admin" value="Add Admin" />
            </form>

        </div>

        <div class="footer"></div>
</body>

</html>