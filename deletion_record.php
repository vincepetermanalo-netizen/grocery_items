<?php require_once 'core/dbConfig.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sql = "DELETE FROM grocery_items WHERE item_id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':id' => $_POST['item_id']
        ]);

        $message = "Record deleted successfully!";
    } catch (PDOException $e) {
        $message = "Database error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Grocery Item</title>
</head>
<body>
    <h2>Delete Grocery Item</h2>

    <?php if (isset($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Item ID to delete:</label>
        <input type="number" name="item_id" required><br><br>

        <button type="submit">Delete Record</button>
    </form>
</body>
</html>