<?php require_once 'core/dbConfig.php';

// Handle form submission for INSERT
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sql = "INSERT INTO grocery_items
                (name, category, brand, price, unit, stock_quantity, expiry_date, organic, supplier, country)
                VALUES
                (:name, :category, :brand, :price, :unit, :stock_quantity, :expiry_date, :organic, :supplier, :country)";

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
            ':country' => $_POST['country']
        ]);

        $message = "Record inserted successfully!";
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
    <title>Insert Grocery Item</title>
</head>
<body>
    <h2>Insert Grocery Item</h2>

    <?php if (isset($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required><br><br>

        <label>Category:</label>
        <input type="text" name="category" value="staples"><br><br>

        <label>Brand:</label>
        <input type="text" name="brand" value="La Fallera"><br><br>

        <label>Price:</label>
        <input type="number" step="0.01" name="price" value="2.49"><br><br>

        <label>Unit:</label>
        <input type="text" name="unit" value="bag"><br><br>

        <label>Stock Quantity:</label>
        <input type="number" name="stock_quantity" value="50"><br><br>

        <label>Expiry Date:</label>
        <input type="date" name="expiry_date"><br><br>

        <label>Organic:</label>
        <input type="checkbox" name="organic" value="1"><br><br>

        <label>Supplier:</label>
        <input type="text" name="supplier" value="La Fallera S.A."><br><br>

        <label>Country:</label>
        <input type="text" name="country" value="spain"><br><br>

        <button type="submit">Insert Record</button>
    </form>
</body>
</html>