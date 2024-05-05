<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'connection.php';
function isImage($fileType)
{
    $imageTypes = array('image/jpeg', 'image/png', 'image/gif');
    return in_array($fileType, $imageTypes);
}

function getFileSizeKB($file)
{
    return $file['size'] / 1024;
}
function generateUniqueFilename($filename)
{
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $basename = pathinfo($filename, PATHINFO_FILENAME);
    $uniqueName = $basename . '_' . uniqid() . '.' . $extension;
    return $uniqueName;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["image"])) {
        $maxFiles = 20; 
        $fileCount = count($_FILES['image']['name']);

        if ($fileCount > $maxFiles) {
            echo "You can upload a maximum of $maxFiles files.";
            exit;
        }

        $images = $_FILES["image"];
        $uploadErrors = [];

        // Retrieve hotel_id from session or any other source
        if (isset($_SESSION['hotel_id'])) {
            $hotel_id = $_SESSION['hotel_id'];

            // Loop through each image
            for ($i = 0; $i < count($images["name"]); $i++) {
                $file_name = $images["name"][$i];
                $file_tmp = $images["tmp_name"][$i];

                if (!isImage($images['type'][$i])) {
                    $uploadErrors[] = "File '{$file_name}' is not an image.";
                    continue;
                }

                if (getFileSizeKB($images[$i]) > 5120) {
                    $uploadErrors[] = "File '{$file_name}' exceeds the maximum file size limit (5MB).";
                    continue;
                }

                $uniqueFileName = generateUniqueFilename($file_name);

                $uploadPath = "uploads/" . $uniqueFileName;
                if (move_uploaded_file($file_tmp, $uploadPath)) {
                    $sql = "INSERT INTO hotel_images (hotel_id, image_name) VALUES (?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("is", $hotel_id, $uniqueFileName);
                    if ($stmt->execute()) {
                        echo "<script>alert('Images added successfully!!'); window.location='hoteladd.php';</script>";
                    } else {
                        echo "<script>alert('Error inserting '{$file_name}' into the database:'); window.location='imagegallery.php';</script>";
                    }

                } else {
                    echo "<script>alert('Error moving '{$file_name}' to upload directory.'); window.location='imagegallery.php';</script>";
                }
            }
        } else {
            echo "<script>alert('Hotel id not found!'); window.location='imagegallery.php';</script>";
        }

        if (!empty($uploadErrors)) {
            echo "<script>alert('Please check the file format!'); window.location='imagegallery.php';</script>";

        }
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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