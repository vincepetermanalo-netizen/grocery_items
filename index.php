<?php require_once 'core/dbConfig.php'; 

try {
    // Selecting a few columns to keep output readable
    $sql = "SELECT item_id, name, brand, price, stock_quantity FROM grocery_items ORDER BY item_id LIMIT 100";
    $stmt = $pdo->query($sql);

    // fetchAll() example (returns an array of rows)
    $items = $stmt->fetchAll();
} catch (PDOException $e) {
    // Simple error output
    echo '<p>Database Error: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</p>';
    exit;
}   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>fetchAll() demo</title>
</head>
<body>
    <h1>PDO::fetchAll() demonstration</h1>

    <!-- print_r() wrapped in <pre? for readable formatted PHP array output -->
    <pre><?php print_r($items); ?></pre>
</body>
</html>