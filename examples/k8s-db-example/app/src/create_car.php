<?php
// Include the database connection file
include 'connection.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $model = $_POST['model'];
    $year = $_POST['year'];

    try {
        $insertSql = "INSERT INTO cars (name, model, year) VALUES (:name, :model, :year)";
        $stmt = $pdo->prepare($insertSql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':model', $model);
        $stmt->bindParam(':year', $year);
        $stmt->execute();
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        $errorMessage = "Error creating car: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Car</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Create New Car</h1>

        <?php if (isset($errorMessage)): ?>
            <div class="error">
                <p><?php echo $errorMessage; ?></p>
            </div>
        <?php endif; ?>

        <form method="POST" action="create_car.php">
            <label for="name">Car Name</label>
            <input type="text" name="name" id="name" required>

            <label for="model">Car Model</label>
            <input type="text" name="model" id="model" required>

            <label for="year">Car Year</label>
            <input type="number" name="year" id="year" required>

            <button type="submit">Create Car</button>
        </form>

        <a href="index.php" class="btn">Back to Cars List</a>
    </div>
</body>
</html>
