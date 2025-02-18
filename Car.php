<?php
require_once "Dbh.php";

class Car extends Dbh
{
    // Insert a new car
    public function insertCar($brand, $model, $year, $price)
    {
        $query = "INSERT INTO cars (brand, model, year, price) VALUES (:brand, :model, :year, :price);";
        $stmt = parent::connect()->prepare($query);
        $stmt->bindParam(":brand", $brand);
        $stmt->bindParam(":model", $model);
        $stmt->bindParam(":year", $year);
        $stmt->bindParam(":price", $price);

        return $stmt->execute();
    }

    // Retrieve all cars
    public function getAllCars()
    {
        $query = "SELECT * FROM cars";
        $stmt = parent::connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update a car
    public function updateCar($id, $brand, $model, $year, $price)
    {
        $query = "UPDATE cars SET brand = :brand, model = :model, year = :year, price = :price WHERE id = :id";
        $stmt = parent::connect()->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":brand", $brand);
        $stmt->bindParam(":model", $model);
        $stmt->bindParam(":year", $year);
        $stmt->bindParam(":price", $price);

        return $stmt->execute();
    }

    // Delete a car
    public function deleteCar($id)
    {
        $query = "DELETE FROM cars WHERE id = :id";
        $stmt = parent::connect()->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
