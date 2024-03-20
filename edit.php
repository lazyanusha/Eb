<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .dashboard{
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
        .part--one ul li{
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
    <div class="dash--heading">
        <div class="hotel--name">
            <p>Easybookings</p>
        </div>
        <div class="second--part1">
            <div class="search">
                <form action="">
                    <input type="search" placeholder="search here" name="search" />
                    <button type="submit">search</button>
                </form>
            </div>
            <div class="admin--profile">
                <p>Welcome sweetpea.!</p>
                <a href="g-setting.php"> <img src="./images/logo3.png" alt="img"></a>
            </div>
        </div>
    </div>
    <div class="dashboard">
        <div class="sidebar">
            <ul class="main">
                <li>
                    <a href="dashboard.php">
                        <div>Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="guest.php">
                        <div>Guests</div>
                    </a>
                </li>
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
                <li>
                    <a href="#">
                        <div>Rooms</div>
                    </a>
                </li>
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
                <li>
                    <a href="setting.php">
                        <div>Settings</div>
                    </a>
                </li>
            </ul>
        </div>

        <div class="second--section">
            <div class="part">
                <h2>Room Type</h2>
                <a href="roomtype.php"><button>Back to the list</button></a>
            </div>
            <div class="part--zero">
                <div class="part--one">
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
                <div class="part--two">
                    <form class="mainform" action="">
                        <div class="container">
                            <div class="elements">
                                <label for="roomtype">Room Type</label><br>
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
                            <div class="service">
                                <label for="services">Services</label>
                                <textarea name="services" id="myTextarea" cols="10" rows="10"></textarea>
                            </div>

                            <div class="divimages">
                                <input type="file" id="imageInput" multiple accept="image/*">
                                <div id="imageContainer"></div>
                            </div>

                        </div>
                        <div class="dividend">
                            <div class="service">
                                <label for="beds">Beds</label>
                                <textarea name="beds" id="myTextarea" cols="10" rows="5"></textarea>
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
    </div>
    </div>
    <div class="footer"></div>

    <script>
        document.querySelectorAll('.dropdown-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const parent = this.parentElement;
                parent.classList.toggle('active');
            });
        });

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

        // for multiple images
        const imageInput = document.getElementById('imageInput');
        const imageContainer = document.getElementById('imageContainer');

        imageInput.addEventListener('change', function (event) {
            const files = event.target.files;

            // Check if files are selected
            if (files.length === 0) {
                // No files selected or selection canceled
                return;
            }
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function (e) {
                    const dataURL = e.target.result;
                    const img = document.createElement('img');
                    img.src = dataURL;
                    img.style.maxWidth = '200px';
                    img.style.height = '150px';
                    img.style.objectFit = 'cover';
                    img.style.marginBottom = '5px';
                    img.style.position = 'relative';

                    // Create a remove button for each image
                    const removeBtn = document.createElement('button');
                    removeBtn.innerHTML = '&#10006;';
                    removeBtn.className = 'remove-btn';
                    removeBtn.style.position = 'absolute';
                    removeBtn.style.top = '0';
                    removeBtn.style.right = '0';
                    removeBtn.style.fontSize = '12px';
                    removeBtn.style.backgroundColor = 'transparent';
                    removeBtn.style.border = 'none';
                    removeBtn.style.cursor = 'pointer';
                    removeBtn.addEventListener('click', function () {
                        imageContainer.removeChild(container);
                    });

                    const container = document.createElement('div');
                    container.className = 'image-container';
                    container.style.position = 'relative';
                    container.appendChild(img);
                    container.appendChild(removeBtn);

                    imageContainer.appendChild(container);
                };

                reader.readAsDataURL(file);
            }
        });



    </script>
</body>

</html>