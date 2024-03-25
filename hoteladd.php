<?php
session_start();
// Check if a success message is set
if (isset ($_SESSION['success_message'])) {
    // Display the success message
    echo "<div class='success-message'>" . $_SESSION['success_message'] . "</div>";

    // Unset the success message to prevent it from being displayed again
    unset($_SESSION['success_message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
   <link rel="stylesheet" href="./css/dash.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .dashboard {
            background-color: #ffffff;
        }

        div {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #343434;
        }

        .dropdown-btn {
            cursor: pointer;
            position: relative;
        }

        .dropdown-btn i {
            position: absolute;
            color: white;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            transition: transform 0.3s ease;
        }

        .dropdown-content {
            display: none;
            position: inherit;
        }

        .dropdown.active .dropdown-content {
            display: block;
        }

        .dropdown.active .dropdown-btn i {
            transform: translateY(-50%) rotate(90deg);
        }

        .part {
            display: flex;
            justify-content: space-between;
        }

        .part--zero {
            display: flex;
            flex-wrap: wrap;
        }

        .part--one {
            width: 20%;
            background-color: #f9f9f9;
            padding: 10px;
        }

        .part--one ul li {
            list-style-type: none;
            padding: 10px 0;
        }

        .part--two {
            width: 75%;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            column-gap: 40px;
        }

        .elements {
            width: 47%;
            padding: 30px;
        }

        .elements input {
            width: 100%;
            padding: 10px;
        }

        .elements button {
            padding: 15px 45px;
        }

        .description {
            padding: 10px 30px;
            width: 100%;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            resize: none;

        }

        .remove-btn {
            margin-left: auto;
            color: red;
            font-size: 14px;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }


        .room {
            width: 49%;
        }

        .room input {
            width: 100%;
            padding: 10px;
        }

        .elements select {
            padding: 10px 40px;
        }

        .divimages {
            margin-bottom: 10px;
        }

        .image-preview {
            max-width: 300px;
            max-height: 300px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <!-- Dash Heading Section -->
    <div class="dash--heading">
        <!-- Hotel Name and Profile Section -->
        <div class="hotel--name">
            <p>Easybookings</p>
        </div>
        <div class="second--part1">
            <!-- Search Form -->
            <div class="search">
                <form action="">
                    <input type="search" placeholder="search here" name="search" />
                    <button type="submit">search</button>
                </form>
            </div>
            <!-- Admin Profile Section -->
            <div class="admin--profile">
                <p>Welcome sweetpea.!</p>
                <a href="g-setting.php">
                    <img src="./images/logo3.png" alt="img">
                </a>
            </div>
        </div>
    </div>

    <!-- Dashboard Container -->
    <div class="dashboard">
        <!-- Sidebar Section -->
        <div class="sidebar">
            <!-- Main Navigation Links -->
            <ul class="main">
                <li><a href="dashboard.php">
                        <div>Dashboard</div>
                    </a></li>
                <li><a href="guest.php">
                        <div>Guests</div>
                    </a></li>
                <li class="dropdown">
                    <div class="dropdown-btn">
                        Booking Manage
                        <i class="fas fa-chevron-right"></i>
                    </div>
                    <ul class="dropdown-content">
                        <li><a href="booking_request.php">Booking Requests</a></li>
                        <li><a href="all_bookings.php">All Bookings</a></li>
                    </ul>
                </li>
                <li><a href="#">
                        <div>Rooms</div>
                    </a></li>
                <li class="dropdown">
                    <div class="dropdown-btn">
                        Manage Hotel
                        <i class="fas fa-chevron-right"></i>
                    </div>
                    <ul class="dropdown-content">
                        <li><a href="hoteladd.php">Add Hotel</a></li>
                        <li><a href="imagegallery.php">Image Gallery</a></li>
                    </ul>
                </li>
                <li><a href="setting.php">
                        <div>Settings</div>
                    </a></li>
            </ul>
        </div>

        <!-- Main Content Section -->
        <div class="second--section">
            <!-- Part Section -->
            <div class="part">
                <h2>Hotel Description</h2>
                <a href="roomtype.php"><button>Back to the list</button></a>
            </div>

            <!-- Part Zero Section -->
            <div class="part--zero">
                <!-- Part One Section -->
                <div class="part--one">
                    <!-- Side Navigation Links -->
                    <ul class="list">
                        <a href="edit.php">
                            <li>Room Description</li>
                        </a>
                        <a href="room.php">
                            <li>Room Number</li>
                        </a>
                        <a href="imagegallery.php">
                            <li>Image Gallery</li>
                        </a>
                    </ul>
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
                                <label for="hotelContact">Hotel Contact</label><br>
                                <input type="text" name="hotelContact" required>
                            </div>
                        </div>
                        <div class="description">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="121" rows="20"></textarea>
                        </div>
                        <!-- Services Section -->
                        <div class="service">
                            <label for="services">Services:</label>
                            <div id="services-container">
                                <!-- Existing service fields will be displayed here -->
                            </div>
                            <button type="button" onclick="addServiceField()">Add Service</button>
                        </div>

                        <!-- Images Section -->
                        <div class="divimages">
                            <label for="imageUpload">Featured Image:</label>
                            <input type="file" id="imageUpload" name="image" accept="image/*">
                        </div>
                        <div class="image-preview" id="imagePreview"></div>

                        <!-- Rooms Section -->
                        <div class="dividend">
                            <div class="service">
                                <label for="rooms">Rooms:</label>
                                <div id="room-container">
                                    <!-- JavaScript will dynamically add input fields for room entries here -->
                                </div>
                                <button type="button" onclick="addRoomField()">Add Room</button>
                            </div>
                        </div>
                        <hr>
                        <div class="elements">
                            <button type="submit">Save</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
    <!-- Footer Section -->
    <div class="footer">
        <!-- Add your footer content here -->
    </div>

    <!-- JavaScript Code Section -->
    <script>
        // Add event listeners to dropdown buttons to toggle their visibility
        document.querySelectorAll('.dropdown-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const parent = this.parentElement;
                parent.classList.toggle('active');
            });
        });

        // Add event listeners to format textarea input as a bulleted list
        const textarea = document.getElementById('myTextarea');

        textarea.addEventListener('input', function (event) {
            const lines = this.value.split('\n'); // Split textarea content into lines

            // Loop through each line and format as a bulleted list item
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

        // Function to add bed field dynamically
        // function addBedField() {
        //     var bedField = `
        //     <div class="bed-field">
        //         <label for="bed-type">Bed Type:</label>
        //         <input type="text" name="bed-type[]" placeholder="Enter bed type">
        //         <label for="bed-quantity">Quantity:</label>
        //         <input type="number" name="bed-quantity[]" value="0" min="0">
        //         <button type="button" onclick="removeBedField(this)">Remove</button>
        //     </div>
        // `;
        //     var container = document.getElementById('beds-container');
        //     var div = document.createElement('div');
        //     div.innerHTML = bedField.trim();
        //     container.appendChild(div.firstChild);
        // }

        // Function to remove bed field
        // function removeBedField(element) {
        //     element.parentNode.remove();
        // }

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

        // Function to remove room field
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

    </script>
</body>

</html>