<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Images</title>
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <div class="divimages">
            <label for="images">Images:</label>
            <div id="images-container">
                <!-- Existing image fields will be displayed here -->
            </div>
            <button type="button" onclick="addImageField()">Add Image</button>
            <input type="submit" name="submit" value="Upload Images">
        </div>
    </form>

    <script>
        // Function to add image field dynamically
        function addImageField() {
            var imageField = `
                <div class="image-field">
                    <label for="image">Image:</label>
                    <input type="file" name="image[]" accept="image/*" onchange="previewImage(this)">
                    <div class="image-preview"></div>
                    <button type="button" onclick="removeImageField(this)">Remove</button>
                </div>
            `;
            var container = document.getElementById('images-container');
            var div = document.createElement('div');
            div.innerHTML = imageField.trim();
            container.appendChild(div.firstChild);
        }

        // Function to remove image field
        function removeImageField(element) {
            element.parentNode.remove();
        }

        // Function to preview selected image
        function previewImage(input) {
            var preview = input.parentNode.querySelector('.image-preview');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var img = new Image();
                    img.src = e.target.result;
                    img.onload = function () {
                        var canvas = document.createElement('canvas');
                        var ctx = canvas.getContext('2d');
                        canvas.width = 150;
                        canvas.height = 150;
                        ctx.drawImage(img, 0, 0, 150, 150);
                        preview.innerHTML = '';
                        preview.appendChild(canvas);
                    };
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.innerHTML = '';
            }
        }
    </script>
</body>

</html>

<?php
session_start();

// Check if hotel ID is set in session
if (!isset($_SESSION['hotel_id'])) {
    echo "Hotel ID is not set in the session.";
    // You may redirect the user to another page or display an error message
    exit();
}

// Retrieve hotel ID from session
$hotelId = $_SESSION['hotel_id'];

include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if any file is uploaded
    if (isset($_FILES["image"])) {
        $images = $_FILES["image"];
        // Loop through each uploaded file
        for ($i = 0; $i < count($images["name"]); $i++) {
            $file_name = $images["name"][$i];
            $file_tmp = $images["tmp_name"][$i];
            // Move the uploaded file to a desired directory
            move_uploaded_file($file_tmp, "uploads/" . $file_name);

            // Insert file name into the database
            $sql = "INSERT INTO hotel_images (hotel_id, image_name) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $hotelId, $file_name);

            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        $conn->close(); // Close the database connection after the loop
    }
}
?>
