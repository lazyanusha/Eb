<?php
include 'connection.php';
session_start();

// Function to check if a file is an image
function isImage($file)
{
    $imageTypes = array('image/jpeg', 'image/png', 'image/gif');
    return in_array($file['type'], $imageTypes);
}

// Function to get file size in KB
function getFileSizeKB($file)
{
    return $file['size'] / 1024;
}

// Function to generate a unique filename
function generateUniqueFilename($filename)
{
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $basename = pathinfo($filename, PATHINFO_FILENAME);
    $uniqueName = $basename . '_' . uniqid() . '.' . $extension;
    return $uniqueName;
}

// Check if hotel ID is set in session
if (!isset($_SESSION['hotel_id'])) {
    header("Location: hoteladd.php"); // Redirect to hoteladd.php
    exit();
}

// Retrieve hotel ID from session
$hotelId = $_SESSION['hotel_id'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["image"])) {
        $images = $_FILES["image"];
        $uploadErrors = [];

        for ($i = 0; $i < count($images["name"]); $i++) {
            $file_name = $images["name"][$i];
            $file_tmp = $images["tmp_name"][$i];

            if (!isImage($images['type'][$i])) {
                $uploadErrors[] = "File '{$file_name}' is not an image.";
                continue;
            }

            if (getFileSizeKB($images) > 5120) {
                $uploadErrors[] = "File '{$file_name}' exceeds the maximum file size limit (5MB).";
                continue;
            }

            $uniqueFileName = generateUniqueFilename($file_name);

            $uploadPath = "uploads/" . $uniqueFileName;
            if (move_uploaded_file($file_tmp, $uploadPath)) {
                $sql = "INSERT INTO hotel_images (hotel_id, image_name) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $hotelId, $uniqueFileName);

                if ($stmt->execute()) {
                    echo "Image '{$file_name}' uploaded successfully.";
                } else {
                    $uploadErrors[] = "Error inserting '{$file_name}' into the database.";
                }
            } else {
                $uploadErrors[] = "Error moving '{$file_name}' to upload directory.";
            }
        }

        if (!empty($uploadErrors)) {
            echo "<h2>Upload Errors:</h2>";
            echo "<ul>";
            foreach ($uploadErrors as $error) {
                echo "<li>{$error}</li>";
            }
            echo "</ul>";
        }

        $conn->close(); 
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Upload Image</title>
    <link rel="stylesheet" href="./css/dashboard.css">
    <style>
        .second--section {
            padding: 40px;
        }

        .image-container {
            display: inline-block;
            margin-right: 10px;
            position: relative;
        }

        .remove-button {
            position: absolute;
            top: 5px;
            right: 5px;
            padding: 5px;
            background: linear-gradient(to top, #7969c7, #f00);
            color: #fff;
            border: none;
            cursor: pointer;
            z-index: 1;
        }

        .image-preview {
            width: 150px;
            height: 150px;
            overflow: hidden;
            border: 1px solid #ccc;
            position: relative;
        }

        .image-preview canvas {
            display: block;
            margin: auto;
            max-width: 100%;
            max-height: 100%;
        }

        .divimages {
            border: 1px solid #7969c7;
            min-height: fit-content;
            display: flex;
            flex-direction: column;
            row-gap: 10px;
            padding: 30px !important;
        }

        input[type='submit'] {
            width: 13%;
            padding: 8px 20px !important;
            padding-top: 20px;
            cursor: pointer;
            background: linear-gradient(to top, #7969c7, #2b3454);
            color: #f9f9f9;
        }
    </style>
</head>

<body>
    <!-- heading -->
    <?php include 'dashhead.php'; ?>

    <div class="dashboard">
        <!-- Sidebar Section -->
        <?php include 'sidebar.php'; ?>
        <!-- Main Content Section -->
        <div class="second--section">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                enctype="multipart/form-data">
                <div class="divimages">
                    <label for="images" style="font-size:20px;">Image Gallery:</label>
                    <div id="images-container">
                        <!-- Existing image fields will be displayed here -->
                    </div>
                    <input type="file" name="image[]" accept="image/*" multiple onchange="previewImages(this)">
                    <input type="submit" name="submit" value="Upload Images">
                </div>
            </form>


        </div>
    </div>
    <div class="footer"></div>

    <script>
        function previewImages(input) {
            var container = document.getElementById('images-container');
            container.innerHTML = '';

            if (input.files && input.files.length > 0) {
                for (var i = 0; i < input.files.length; i++) {
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

                            var imageContainer = document.createElement('div');
                            imageContainer.classList.add('image-container');

                            var imagePreview = document.createElement('div');
                            imagePreview.classList.add('image-preview');
                            imagePreview.appendChild(canvas);

                            var removeButton = document.createElement('button');
                            removeButton.textContent = 'Remove';
                            removeButton.classList.add('remove-button');
                            removeButton.addEventListener('click', function () {
                                imageContainer.remove();
                            });

                            imageContainer.appendChild(imagePreview);
                            imageContainer.appendChild(removeButton);
                            container.appendChild(imageContainer);
                        };
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }

    </script>
</body>

</html>