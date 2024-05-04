<?php
include 'connection.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/dashboard.css">
    <style>

    </style>
</head>

<body>
    <!-- heading -->
    <?php
    include 'dashhead.php';
    ?>

    <div class="dashboard">
        <!-- Sidebar Section -->
        <?php
        include 'sidebar.php';
        ?>
        <!-- Main Content Section -->
        <div class="second--section">
            <!-- Part Section -->
            <div class="part">
                <h2>Hotel Description</h2>
                <a href="dashboard.php"><button>Back</button></a>
            </div>

            <!-- Part Two Section -->
            <div class="part--two">
                <!-- Main Form Section -->
                <form class="mainform" action="save_data.php" method="POST" enctype="multipart/form-data">
                    <div class="container">
                        <!-- Form Elements Section -->
                        <div class="elements">
                            <label for="hotelName">Hotel Name</label><br>
                            <input type="text" name="hotelName" required>
                        </div>
                        <div class="elements">
                            <label for="hotelLocation">Hotel Location</label><br>
                            <input type="text" name="hotelLocation" required>
                        </div>
                        <div class="elements">
                            <label for="hotelEmail">Hotel Email</label><br>
                            <input type="email" name="hotelEmail" required>
                        </div>
                        <div class="elements">
                            <label for="hotelContact">Hotel Contact:</label><br>
                            <input type="tel" id="hotelContact" name="hotelContact" oninput="formatPhoneNumber(this)"
                                maxlength="10" pattern="[0-9]{10}" required />
                        </div>
                    </div>
                    <div>
                        <label for="description">Description</label>
                        <div>
                            <textarea name="description" id="description" cols="121" rows="20"></textarea>
                        </div>

                    </div>
                    <!-- Services Section -->
                    <div class="service">
                        <label for="services">Services:</label>
                        <div id="services-container">
                            <!-- Existing service fields will be displayed here -->
                        </div>
                        <button type="button" onclick="addServiceField()">Add Service</button>
                    </div>

                    <!-- Rooms Section -->
                    <div class="service">
                        <label for="rooms">Rooms:</label>
                        <div id="room-container">
                            <!-- JavaScript will dynamically add input fields for room entries here -->
                        </div>
                        <button type="button" onclick="addRoomField()">Add Room</button>
                    </div>


                    <!-- Images Section -->
                    <div class="divimages">
                        <label for="imageUpload">Featured Image:</label>
                        <input type="file" id="imageUpload" name="image" accept="image/*">
                    </div>

                    <div class="image-preview" id="imagePreview"></div>
                    <div class="elements">
                        <label for="hotelContact">Ratings:</label><br>
                        <input type="number" name="ratings" required>
                    </div>
                    <hr>
                    <div class="submit">
                        <button type="submit">Save</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
    <!-- Footer Section -->
    <div class="footer">
    </div>

    <!-- JavaScript Code Section -->
    <script>
        // Add event listeners to format textarea input as a bulleted list
        const textarea = document.getElementById('myTextarea');

        textarea.addEventListener('input', function (event) {
            const lines = this.value.split('\n');
            for (let i = 0; i < lines.length; i++) {
                if (lines[i].trim() !== '' && lines[i].charAt(0) !== '•') {
                    lines[i] = '• ' + lines[i];
                }
            }

            // Set the textarea content to the formatted bulleted list
            this.value = lines.join('\n');
        });

        textarea.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                const cursorPos = this.selectionStart;
                const currentLine = this.value.substring(0, cursorPos).split('\n').pop();

                if (currentLine.trim().startsWith('•')) {
                    event.preventDefault();

                    const remainingText = this.value.substring(cursorPos);
                    const newValue = this.value.substring(0, cursorPos) + '\n' + remainingText;
                    this.value = newValue;

                    this.selectionStart = this.selectionEnd = cursorPos + 1;
                }
            } else if (event.key === 'Backspace') {
                const cursorPos = this.selectionStart;
                const currentLine = this.value.substring(0, cursorPos).split('\n').pop();
                if (currentLine.trim() === '•' && cursorPos === currentLine.length) {
                    event.preventDefault();

                    const newValue = this.value.substring(0, cursorPos - 2) + this.value.substring(cursorPos);
                    this.value = newValue;

                    this.selectionStart = this.selectionEnd = cursorPos - 2;
                }
            }
        });


        // Function to add service field dynamically
        function addServiceField() {
            var serviceField = `
            <div class="service-field">
                <label for="service-name">Service Name:</label>
                <input type="text" name="service-name[]" placeholder="Enter service name">
                <button type="button" onclick="removeServiceField(this)">Remove</button>
            </div>
        `;
            var container = document.getElementById('services-container');
            var div = document.createElement('div');
            div.innerHTML = serviceField.trim();
            container.appendChild(div.firstChild);
        }

        // Function to remove service field
        function removeServiceField(element) {
            element.parentNode.remove();
        }

        function addRoomField() {
            var roomField = `
        <div class="room-field">
            <label for="room-type">Room Type:</label>
            <select class="reservation--info" name="room-type[]" id="room-type">
            <option value="" disabled selected>Select type of room</option>
            <option value="normal">Normal Room</option>
            <option value="luxury">Luxury Room</option>
            <option value="deluxe">Deluxe Room</option>
            <option value="king">King Size</option>
          </select>
            <label for="room-quantity">Quantity:</label>
            <input type="number" name="room-quantity[]" value="0" min="0">
            <label for="price">Price per Room:</label>
            <input type="number" name="price[]" value="0" min="0">
            <button type="button" onclick="removeRoomField(this)">Remove</button>
        </div>
    `;
            var container = document.getElementById('room-container');
            var div = document.createElement('div');
            div.innerHTML = roomField.trim();
            container.appendChild(div.firstChild);
        }
        function removeRoomField(element) {
            element.parentNode.remove();
        }



        // Function to preview selected image
        const imageUpload = document.getElementById('imageUpload');
        const imagePreview = document.getElementById('imagePreview');

        imageUpload.addEventListener('change', function () {
            const file = this.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                const img = new Image();
                img.src = e.target.result;
                img.onload = function () {
                    imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview Image">`;
                };
            };

            if (file) {
                if (file.type.match('image.*')) {
                    reader.readAsDataURL(file);
                } else {
                    // Clear the input field and the preview if the selected file is not an image
                    imageUpload.value = '';
                    imagePreview.innerHTML = '';
                    alert('Please select only image files.');
                }
            }
        });

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