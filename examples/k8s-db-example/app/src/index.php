<?php
// Include the database connection file
include 'connection.php';

// Fetch car data from the database
try {
    $sql = "SELECT * FROM cars";
    $stmt = $pdo->query($sql);

    // Fetch all cars as an associative array
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle any errors
    $errorMessage = "Error fetching car data: " . $e->getMessage();
}

// Handle delete operation
if (isset($_GET['delete'])) {
    $carId = $_GET['delete'];
    try {
        $deleteSql = "DELETE FROM cars WHERE id = :id";
        $stmt = $pdo->prepare($deleteSql);
        $stmt->bindParam(':id', $carId);
        $stmt->execute();
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        $errorMessage = "Error deleting car: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Cars List</h1>
        <?php if (isset($errorMessage)): ?>
            <div class="error">
                <p><?php echo $errorMessage; ?></p>
            </div>
        <?php endif; ?>

        <a href="create_car.php" class="btn">Create New Car</a>

        <?php if (isset($cars) && count($cars) > 0): ?>
            <table id="carsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cars as $car): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($car['id']); ?></td>
                            <td><?php echo htmlspecialchars($car['name']); ?></td>
                            <td><?php echo htmlspecialchars($car['model']); ?></td>
                            <td><?php echo htmlspecialchars($car['year']); ?></td>
                            <td>
                                <a href="update_car.php?id=<?php echo $car['id']; ?>" class="btn">Update</a>
                                <a href="?delete=<?php echo $car['id']; ?>" class="btn-delete">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No cars found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
