<?php

include 'connection.php';

if (isset($_GET['id'])) {
    $carId = $_GET['id'];

    try {
        $selectSql = "SELECT * FROM cars WHERE id = :id";
        $stmt = $pdo->prepare($selectSql);
        $stmt->bindParam(':id', $carId);
        $stmt->execute();
        $car = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $errorMessage = "Error fetching car data: " . $e->getMessage();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $model = $_POST['model'];
        $year = $_POST['year'];

        try {
            $updateSql = "UPDATE cars SET name = :name, model = :model, year = :year WHERE id = :id";
            $stmt = $pdo->prepare($updateSql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':model', $model);
            $stmt->bindParam(':year', $year);
            $stmt->bindParam(':id', $carId);
            $stmt->execute();
            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            $errorMessage = "Error updating car: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Car</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Update Car</h1>

        <?php if (isset($errorMessage)): ?>
            <div class="error">
                <p><?php echo $errorMessage; ?></p>
            </div>
        <?php endif; ?>

        <?php if (isset($car)): ?>
            <form method="POST" action="update_car.php?id=<?php echo $car['id']; ?>">
                <label for="name">Car Name</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($car['name']); ?>" required>

                <label for="model">Car Model</label>
                <input type="text" name="model" id="model" value="<?php echo htmlspecialchars($car['model']); ?>" required>

                <label for="year">Car Year</label>
                <input type="number" name="year" id="year" value="<?php echo htmlspecialchars($car['year']); ?>" required>

                <button type="submit">Update Car</button>
            </form>
        <?php endif; ?>

        <a href="index.php" class="btn">Back to Cars List</a>
    </div>
</body>
</html>
