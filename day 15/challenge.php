<?php
session_start();

$user = "root";
$pass = "";
$server = "localhost";
$dbname = "dbdiar";

try {
    $conn = new PDO("mysql:host=$server; dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Fetching data from the table
    $stmt = $conn->prepare("SELECT id, title, description, quantity, price FROM products");
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Table</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Product List</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any records to display
                if ($items) {
                    foreach ($items as $item) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($item['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['title']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['description']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['quantity']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['price']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
