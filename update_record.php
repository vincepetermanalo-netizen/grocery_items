<?php require_once 'core/dbConfig.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sql = "UPDATE grocery_items
                SET name = :name,
                    category = :category,
                    brand = :brand,
                    price = :price,
                    unit = :unit,
                    stock_quantity = :stock_quantity,
                    expiry_date = :expiry_date,
                    organic = :organic,
                    supplier = :supplier,
                    country = :country
                WHERE item_id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':name' => $_POST['name'],
            ':category' => $_POST['category'],
            ':brand' => $_POST['brand'],
            ':price' => $_POST['price'],
            ':unit' => $_POST['unit'],
            ':stock_quantity' => $_POST['stock_quantity'],
            ':expiry_date' => $_POST['expiry_date'],
            ':organic' => isset($_POST['organic']) ? 1 : 0,
            ':supplier' => $_POST['supplier'],
            ':country' => $_POST['country'],
            ':id' => $_POST['item_id']
        ]);

        $message = "Record updated successfully!";
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
    <title>Update Grocery Item</title>
</head>
<body>
    <h2>Update Grocery Item</h2>

    <?php if (isset($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Item ID:</label>
        <input type="number" name="item_id" required><br><br>

        <label>Name:</label>
        <input type="text" name="name" value="Carbonell Extra Virgin Olive Oil" required><br><br>

        <label>Category:</label>
        <input type="text" name="category" value="condiments"><br><br>

        <label>Brand:</label>
        <input type="text" name="brand" value="Carbonell"><br><br>

        <label>Price:</label>
        <input type="number" step="0.01" name="price" value="7.99"><br><br>

        <label>Unit:</label>
        <input type="text" name="unit" value="bottle"><br><br>

        <label>Stock Quantity:</label>
        <input type="number" name="stock_quantity" value="35"><br><br>

        <label>Expiry Date:</label>
        <input type="date" name="expiry_date" value="2028-06-30"><br><br>

        <label>Organic:</label>
        <input type="checkbox" name="organic" value="1"><br><br>

        <label>Supplier:</label>
        <input type="text" name="supplier" value="Aceites Carbonell"><br><br>

        <label>Country:</label>
        <input type="text" name="country" value="spain"><br><br>

        <button type="submit">Update Record</button>
    </form>
</body>
</html>