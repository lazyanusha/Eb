<?php
include 'connection.php';
$sql = "SELECT * FROM admins";
$result = mysqli_query($conn, $sql);
$admins = [];
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $admins[] = $row;
  }
} else {
  echo "Error fetching admins: " . mysqli_error($conn);
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
    .action {
      display: flex;
      column-gap: 10px;
      border: none;
      justify-content: center;
    }

    button {
      padding: 8px 15px !important;
      cursor: pointer;
      background: linear-gradient(to top, #7969c7, #2b3454);
      color: #f9f9f9 !important;
      border: none;
    }

    .button1 {
      padding: 8px 15px !important;
      cursor: pointer;
      background: linear-gradient(to top, #7969c7, #f00);
      border: none;
      color: #f9f9f9 !important;
    }

    img {
      height: 50px;
      width: 50px;
      border-radius: 50%;
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
          <!-- <a href="dashboard.php"><button>Back</button></a> -->
        </div>
        <div class="search">
          <a href="add-admin.php">
            <button type="submit">Add Admin</button>
          </a>
        </div>
      </div>
      <div class="more--details">
        <table border="1px" style="border-collapse: collapse; width: 100%">
          <thead>
            <tr>
              <th>Admin id</th>
              <th>Name</th>
              <th>Email</th>
              <th>Contact</th>
              <th>Photo</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($admins as $admin): ?>
              <tr>
                <td><?php echo $admin['admin_id']; ?></td>
                <td><?php echo $admin['fullname']; ?></td>
                <td><?php echo $admin['email']; ?></td>
                <td><?php echo $admin['phone']; ?></td>
                <td><img src="<?php echo $admin['images']; ?>" alt="Admin Image">
                </td>
                <td class="action">
                  <form action="update.php" method="post">
                    <input type="hidden" name="admin_id" value="<?php echo $admin['admin_id']; ?>">
                    <button type="submit" name="update">Update</button>
                  </form>
                  <form action="delete.php" method="post">
                    <input type="hidden" name="admin_id" value="<?php echo $admin['admin_id']; ?>">
                    <button class="button1" type="submit" name="delete"
                      onclick="return confirm('Confirm delete?')">Delete</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="footer"></div>
</body>

</html>