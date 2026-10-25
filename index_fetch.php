<?php require_once 'core/dbConfig.php'; 

try {
    // Fetching a single row by ID using a prepared statement
    $sql_single = "SELECT item_id, name, brand, price, stock_quantity FROM grocery_items WHERE item_id = :id";
    $stmt_single = $pdo->prepare($sql_single);
    $stmt_single->execute([':id' => 1]); // Change ID to one that exists

    // fetch() returns the next row from the result set
    $single_row = $stmt_single->fetch(PDO::FETCH_ASSOC);

    // Fetching rows one-by-one in a loop
    $sql_loop = "SELECT item_id, name, brand, price, stock_quantity FROM grocery_items ORDER BY item_id LIMIT 10";
    $stmt_loop = $pdo->query($sql_loop);

    // Collecting the rows fetched one-by-one to display
    $rows = [];
    while ($row = $stmt_loop->fetch(PDO::FETCH_ASSOC)) {
        $rows[] = $row;
    }

} catch (PDOException $e) {
    echo '<p>Database error: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</p>';
    exit;
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>PDO::fetch() demonstration</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        pre { background:#f7f7f7; padding: 12px; border: 1px solid #ddd; overflow: auto; }
    </style>
</head>
<body>
    <h1>PDO::fetch() demonstration</h1>

    <h2>Single Row Fetched with fetch()</h2>
    <p>print_r() output wrapped in &lt;pre&gt; for readability:</p>
    <pre><?php print_r($single_row); ?></pre>

    <h2>Rows Fetched one-by-one inside a loop</h2>
    <p>Each iteration calles fetch() to get the next row; results collected and printed below:</p>
    <pre><?php print_r($rows); ?></pre>

    <?php if (!empty($rows)): ?>
        <h3>Quick Table Preview</h3>
        <table border="1" cellpadding="6" cellspacing="0">
            <thead>
                <tr><th>ID</th><th>Name</th><th>Brand</th><th>Price</th><th>Stock</th></tr>
    </thead>
        <tbody>
            <?php foreach ($rows as $r): ?>
                <tr>
                    <td><?= htmlspecialchars($r['item_id']) ?></td>
                    <td><?= htmlspecialchars($r['name']) ?></td>
                    <td><?= htmlspecialchars($r['brand']) ?></td>
                    <td><?- htmlspecialchars(number_formal((float)$r['price'], 2)) ?></td>
                    <td><?= htmlspecialchars($r['stock_quantity']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    <?php endif; ?>

</body>
</html>
        