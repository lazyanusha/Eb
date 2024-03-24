<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .dashboard {
            background-color: #ffffff;
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

        .image-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .remove-btn {
            margin-left: auto;
            color: red;
            font-size: 14px;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        .dividend {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 10px 30px;
        }

        .service {
            width: 49%;
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
            width: 49%;
            display: flex;
            flex-wrap: wrap;
            height: 28vh;
            border: 1px solid #ccc;
            overflow-y: auto;
            background-color: white;
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
                        <li><a href="roomtype.php">Room Type</a></li>
                        <li><a href="facilities.php">Facilities</a></li>
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
                    <form class="mainform" action="">
                        <div class="container">
                            <!-- Form Elements Section -->
                            <div class="elements">
                                <label for="roomtype">Hotel Name</label><br>
                                <input type="text" required>
                            </div>
                            <div class="elements">
                                <label for="roomcount">Room Count</label><br>
                                <input type="number" required>
                            </div>
                        </div>
                        <div class="description">
                            <label for="description">Description</label>
                            <textarea name="description" id="" cols="121" rows="20"></textarea>
                        </div>
                        <div class="dividend">
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
                                <label for="images">Images:</label>
                                <div id="images-container">
                                    <!-- Existing image fields will be displayed here -->
                                </div>
                                <button type="button" onclick="addImageField()">Add Image</button>
                            </div>
                        </div>
                        <div class="dividend">
                            <div class="service">
                                <label for="beds">Beds:</label>
                                <div id="beds-container">
                                    <!-- JavaScript will dynamically add input fields for bed entries here -->
                                </div>
                                <button type="button" onclick="addBedField()">Add Bed</button>
                            </div>
                            <div class="room">
                                <label for="roomcount">Room Count</label><br>
                                <input type="number" required>
                            </div>
                        </div>
                        <div class="elements">
                            <label for="status">Status</label><br>
                            <select name="" id="">
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                        <hr>
                        <div class="elements">
                            <a href="roomtype.php"><button type="submit">Save</button></a>
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
                <label for="service-description">Description:</label>
                <textarea name="service-description[]" placeholder="Enter service description"></textarea>
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
        function addBedField() {
            var bedField = `
            <div class="bed-field">
                <label for="bed-type">Bed Type:</label>
                <input type="text" name="bed-type[]" placeholder="Enter bed type">
                <label for="bed-quantity">Quantity:</label>
                <input type="number" name="bed-quantity[]" value="0" min="0">
                <button type="button" onclick="removeBedField(this)">Remove</button>
            </div>
        `;
            var container = document.getElementById('beds-container');
            var div = document.createElement('div');
            div.innerHTML = bedField.trim();
            container.appendChild(div.firstChild);
        }

        // Function to remove bed field
        function removeBedField(element) {
            element.parentNode.remove();
        }


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