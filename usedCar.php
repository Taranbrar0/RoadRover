<?php
require 'database.php';

// Establish database connection
$pdo = db_connect();

$cars = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $make = $_GET['make'] ?? '';
    $model = $_GET['model'] ?? '';
    $min_price = $_GET['min_price'] ?? '';
    $max_price = $_GET['max_price'] ?? '';
    $year = $_GET['year'] ?? '';
    $transmission = $_GET['transmission'] ?? '';
    $fuel_type = $_GET['fuel_type'] ?? '';

    $query = "SELECT * FROM cars WHERE 1=1";
    if ($make) $query .= " AND make = :make";
    if ($model) $query .= " AND model LIKE :model";
    if ($min_price) $query .= " AND price >= :min_price";
    if ($max_price) $query .= " AND price <= :max_price";
    if ($year) $query .= " AND year = :year";
    if ($transmission) $query .= " AND transmission = :transmission";
    if ($fuel_type) $query .= " AND fuelType = :fuel_type";

    $stmt = $pdo->prepare($query);

    if ($make) $stmt->bindValue(':make', $make);
    if ($model) $stmt->bindValue(':model', '%' . $model . '%');
    if ($min_price) $stmt->bindValue(':min_price', $min_price);
    if ($max_price) $stmt->bindValue(':max_price', $max_price);
    if ($year) $stmt->bindValue(':year', $year);
    if ($transmission) $stmt->bindValue(':transmission', $transmission);
    if ($fuel_type) $stmt->bindValue(':fuel_type', $fuel_type);

    $stmt->execute();
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoadRover</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');
    </style>
    <link rel="stylesheet" href="indexStyle.css">
    <link rel="stylesheet" href="usedCar.css">
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
                <li><a href="#" style="cursor: none; opacity: 0.2;">Auction</a></li>
                <li><a href="addcar.php" class="specialBtn">SellyourCar</a></li>
            </span>
        </ul>
    </nav> 
    <div class="trendItems">
        <h3>Discover value and reliability with our hand-picked selection of pre-owned vehicles</h3>
        <div class="btnContainer">
            <button style="background-color: darkgray;">More Details</button>
            <button>Test Drive</button>
        </div>
        <img class="used" src="images/pexels-alekseyihnatov-6128309-removebg-preview (1).jpg" alt="cartitleimage">
    </div>
    <main>
        <h2>Pre Owned</h2>
        <div class="main-container">
            <div class="form-container">
                <form action="usedCar.php" method="get">

                    <label for="make">Make:</label>

                    <select name="make" id="make">
                        <option value="">Any</option>
                        <option value="Toyota">Toyota</option>
                        <option value="Mercedes">Mercedes</option>
                        <option value="Ford">Ford</option>
                        <option value="Audi">Audi</option>
                        <option value="Range Rover">Range Rover</option>
                    </select><br>

                    <label for="model">Model:</label>
                    <input type="text" id="model" name="model" placeholder="Model name"><br>

                    <label for="min_price">Min Price:</label>
                    <input type="number" id="min_price" name="min_price" placeholder="Min Price"><br>

                    <label for="max_price">Max Price:</label>
                    <input type="number" id="max_price" name="max_price" placeholder="Max Price"><br>

                    <label for="year">Year:</label>
                    <select name="year" id="year">
                        <option value="">Any</option>
                        <option value="2023">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2021">2020</option>
                        <option value="2021">2019</option>
                        <option value="2021">2018</option>
                    </select><br>

                    <label for="transmission">Transmission:</label>
                    <select name="transmission" id="transmission">
                        <option value="">Any</option>
                        <option value="Automatic">Automatic</option>
                        <option value="Manual">Manual</option>
                    </select><br>

                    <label for="fuel_type">Fuel Type:</label>
                    <select name="fuel_type" id="fuel_type">
                        <option value="">Any</option>
                        <option value="Gasoline">Gasoline</option>
                        <option value="Electric">Electric</option>
                    </select><br>

                    <button type="submit">Search</button>
                </form>
            </div>
            <div class="content-container">
                <div class="wrapper">                 
                    <div class="container">
                        <div class="Cars">
                            <?php foreach ($cars as $car): ?>
                            <div class="car">
                                <img src="<?= ($car['image'] ?? '') ?>" alt="Car Image">
                                <!-- <p><?= ($car['description'] ?? '') ?></p> -->
                                <p>Make: <?= htmlspecialchars($car['make'] ?? 'N/A') ?></p>
                                <p>Model: <?= ($car['model'] ?? 'N/A') ?></p>
                                <p>Price: <?= ($car['price'] ?? 'N/A') ?></p>
                                <p>Year: <?= ($car['year'] ?? 'N/A') ?></p>
                                <p>Transmission: <?= ($car['transmission'] ?? 'N/A') ?></p>
                                <!-- <p>Fuel Type: <?= ($car['fuel_type'] ?? 'N/A') ?></p> -->
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carLogo-container">
                    <div id="carLogo">
                        <img src="images\car.png" alt="car">
                    </div>
                </div>
        </div>
    </main>
    
</body>
</html>
