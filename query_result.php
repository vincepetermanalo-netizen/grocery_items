<?php require_once 'core/dbConfig.php';

try {
    $sql = "SELECT item_id, name, category, brand, price, unit, stock_quantity
            FROM grocery_items
            ORDER BY item_id";

    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '<p>Database error: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</p>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Items</title>
</head>
<body>
    <h2>Grocery Items</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Item ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Unit</th>
            <th>Stock Quantity</th>
        </tr>

        <?php foreach ($results as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['item_id']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['category']); ?></td>
                <td><?php echo htmlspecialchars($row['brand']); ?></td>
                <td><?php echo htmlspecialchars($row['price']); ?></td>
                <td><?php echo htmlspecialchars($row['unit']); ?></td>
                <td><?php echo htmlspecialchars($row['stock_quantity']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>