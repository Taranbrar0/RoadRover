<?php
require 'database.php'; 

$validation_messages = [];
$success = '';

function validate() {
    global $validation_messages, $success;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['make'])) {
            $validation_messages['make'] = 'Make is required.';
        }

        // Validate model
        if (empty($_POST['model'])) {
            $validation_messages['model'] = 'Model is required.';
        }
        if (empty($_POST['price'])) {
            $validation_messages['price'] = 'Price is required.';
        } elseif (!is_numeric($_POST['price']) || $_POST['price'] <= 0) {
            $validation_messages['price'] = 'Price must be a positive number.';
        }

        if (empty($_POST['year'])) {
            $validation_messages['year'] = 'Year is required.';
        } elseif (!is_numeric($_POST['year']) || $_POST['year'] < 1986 || $_POST['year'] > date("Y")) {
            $validation_messages['year'] = 'Year must be a valid year.';
        }

        if (empty($_POST['transmission'])) {
            $validation_messages['transmission'] = 'Transmission is required.';
        }

        if (empty($_POST['fuelType'])) {
            $validation_messages['fuelType'] = 'Fuel type is required.';
        }


        if (empty($_POST['image'])) {
            $validation_messages['image'] = 'Image URL is required.';
        } elseif (!filter_var($_POST['image'], FILTER_VALIDATE_URL)) {
            $validation_messages['image'] = 'Invalid URL format.';
        }

        if (empty($validation_messages)) {
            $pdo = db_connect(); 
            $query = "INSERT INTO cars (make, model, price, year, transmission, fuelType, image) 
                      VALUES (:make, :model, :price, :year, :transmission, :fuelType, :image)";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':make', $_POST['make']);
            $stmt->bindValue(':model', $_POST['model']);
            $stmt->bindValue(':price', $_POST['price']);
            $stmt->bindValue(':year', $_POST['year']);
            $stmt->bindValue(':transmission', $_POST['transmission']);
            $stmt->bindValue(':fuelType', $_POST['fuelType']);
            $stmt->bindValue(':image', $_POST['image']);

            if ($stmt->execute()) {
                $success = 'Car added successfully!';
            } else {
                $validation_messages['database'] = 'Failed to add car to the database.';
            }

            // Clear POST data to prevent resubmission
            $_POST = [];
        }
    }
}


validate();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Car - RoadRover</title>
    <link rel="stylesheet" href="indexStyle.css">
    <link rel="stylesheet" href="usedCar.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');
        .error { color: red; }
        .success { color: green; }
        .form-container{
            width: 90vw;
            margin-top:20px;
        }
        form{
            display: flex;
            flex-direction:column;
            margin: 10px;
            margin: auto;
            text-align: left;
            background-color: white;
        }
    </style>
    <script src="https://kit.fontawesome.com/0acdc16a88.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
    <nav>
        <ul>
            <span class="leftNav">
                <li><a href="index.html"><i class="fa-solid fa-house"></i></a></li>
                <button class="menuBtn"><i class="fa-solid fa-bars"></i></button>
            </span>
            <span class="rightNav">
                <li><a href="usedCar.php">Used cars</a></li>
                <li><a href="new.php">New Cars</a></li>
                <li><a href="auction.php" style="cursor: none; opacity: 0.2;">Auction</a></li>
                <li><a href="addcar.php" class="specialBtn">Sell your Car</a></li>
            </span>
        </ul>
    </nav> 
    <main>
        <div class="main-container">
            <div class="form-container">
                <h2>Add a New Car</h2>
                <?php if (!empty($success)): ?>
                    <div class="success"><?= ($success) ?></div>
                <?php endif; ?>
                <?php if (!empty($validation_messages['database'])): ?>
                    <span class="error"><?= ($validation_messages['database']) ?></span><br>
                <?php endif; ?>
                <form action="addcar.php" method="post">
                    <label for="make">Make:</label>
                    <input type="text" id="make" name="make" value="<?= ($_POST['make'] ?? '') ?>"><br>
                    <?php if (!empty($validation_messages['make'])): ?>
                        <span class="error"><?= ($validation_messages['make']) ?></span><br>
                    <?php endif; ?>

                    <label for="model">Model:</label>
                    <input type="text" id="model" name="model" value="<?= ($_POST['model'] ?? '') ?>"><br>
                    <?php if (!empty($validation_messages['model'])): ?>
                        <span class="error"><?= ($validation_messages['model']) ?></span><br>
                    <?php endif; ?>

                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" value="<?= ($_POST['price'] ?? '') ?>"><br>
                    <?php if (!empty($validation_messages['price'])): ?>
                        <span class="error"><?= ($validation_messages['price']) ?></span><br>
                    <?php endif; ?>

                    <label for="year">Year:</label>
                    <input type="number" id="year" name="year" value="<?= ($_POST['year'] ?? '') ?>"><br>
                    <?php if (!empty($validation_messages['year'])): ?>
                        <span class="error"><?= ($validation_messages['year']) ?></span><br>
                    <?php endif; ?>

                    <label for="transmission">Transmission:</label>
                    <select name="transmission" id="transmission">
                        <option value="">Select</option>
                        <option value="Automatic" <?= (isset($_POST['transmission']) && $_POST['transmission'] == 'Automatic') ? 'selected' : '' ?>>Automatic</option>
                        <option value="Manual" <?= (isset($_POST['transmission']) && $_POST['transmission'] == 'Manual') ? 'selected' : '' ?>>Manual</option>
                    </select><br>
                    <?php if (!empty($validation_messages['transmission'])): ?>
                        <span class="error"><?= ($validation_messages['transmission']) ?></span><br>
                    <?php endif; ?>

                    <label for="fuelType">Fuel Type:</label>
                    <select name="fuelType" id="fuelType">
                        <option value="">Select</option>
                        <option value="Gasoline" <?= (isset($_POST['fuelType']) && $_POST['fuelType'] == 'Gasoline') ? 'selected' : '' ?>>Gasoline</option>
                        <option value="Electric" <?= (isset($_POST['fuelType']) && $_POST['fuelType'] == 'Electric') ? 'selected' : '' ?>>Electric</option>
                    </select><br>
                    <?php if (!empty($validation_messages['fuelType'])): ?>
                        <span class="error"><?= ($validation_messages['fuelType']) ?></span><br>
                    <?php endif; ?>

                    <label for="image">Image URL:</label>
                    <input type="url" id="image" name="image" value="<?= ($_POST['image'] ?? '') ?>"><br>
                    <?php if (!empty($validation_messages['image'])): ?>
                        <span class="error"><?= ($validation_messages['image']) ?></span><br>
                    <?php endif; ?>

                    <button type="submit">Add Car</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>

