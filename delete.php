<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['admin_id'])) {
        $admin_id = $_POST['admin_id'];
        $sql = "DELETE FROM admins WHERE admin_id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "i", $admin_id); 
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Entry deleted successfully.');</script>";
            header("Location: admin.php");
            
            exit();
        } else {

            echo "Error: " . mysqli_error($conn);
        }

      
        mysqli_stmt_close($stmt);
    } else {
        echo "Admin ID not provided.";
    }
}
