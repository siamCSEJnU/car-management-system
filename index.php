<?php
require_once "Car.php";

$car = new Car();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add"])) {
        $brand = htmlspecialchars($_POST["brand"]);
        $model = htmlspecialchars($_POST["model"]);
        $year = htmlspecialchars($_POST["year"]);
        $price = htmlspecialchars($_POST["price"]);
        $car->insertCar($brand, $model, $year, $price);
    } elseif (isset($_POST["update"])) {
        $id = $_POST["id"];
        $brand = htmlspecialchars($_POST["brand"]);
        $model = htmlspecialchars($_POST["model"]);
        $year = htmlspecialchars($_POST["year"]);
        $price = htmlspecialchars($_POST["price"]);
        $car->updateCar($id, $brand, $model, $year, $price);
    }
}

// Handle delete action
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $car->deleteCar($id);
}

// Fetch all cars
$cars = $car->getAllCars();

// Fetch car details for editing
$editCar = null;
if (isset($_GET["edit"])) {
    $editCarId = $_GET["edit"];
    foreach ($cars as $car) {
        if ($car["id"] == $editCarId) {
            $editCar = $car;
            break;
        }
    }
}

?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Car Management System</h2>

        <!-- Add/Edit Car Form -->
        <form method="POST" class="mb-4 w-50 mx-auto">
            <input type="hidden" name="id" value="<?= $editCar ? $editCar["id"] : '' ?>">
            <div class="mb-3">
                <label for="brand" class="form-label">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand" value="<?= $editCar ? $editCar["brand"] : '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" class="form-control" id="model" name="model" value="<?= $editCar ? $editCar["model"] : '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <input type="number" class="form-control" id="year" name="year" value="<?= $editCar ? $editCar["year"] : '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= $editCar ? $editCar["price"] : '' ?>" required>
            </div>
            <button type="submit" name="<?= $editCar ? 'update' : 'add' ?>" class="btn btn-primary">
                <?= $editCar ? 'Update' : 'Add' ?> Car
            </button>
            <?php if ($editCar): ?>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            <?php endif; ?>
        </form>


        <!-- Display Car List -->
        <h2 class="text-center mb-4">Car Items</h2>
        <table class="table table-bordered w-50 mx-auto">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cars as $car): ?>
                    <tr>
                        <td><?= $car['id'] ?></td>
                        <td><?= $car['brand'] ?></td>
                        <td><?= $car['model'] ?></td>
                        <td><?= $car['year'] ?></td>
                        <td>$<?= number_format($car['price'], 2) ?></td>
                        <td>
                            <a href="index.php?edit=<?= $car["id"] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="index.php?delete=<?= $car["id"] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>