<?php
    session_start();

    include 'Product.class.php';
    include 'DVD.class.php';
    include 'Book.class.php';
    include 'Furniture.class.php';
    include 'connection.php';

    $conn = OpenCon();

    // if($conn){
    //     echo "Connection succesfully!";
    // }else{
    //     echo "Connection unsuccesfully!";
    // }
    
    if(isset($_POST['delete']) && !empty($_POST['delete'])) {
        $productIdsToDelete = $_POST['delete'];
        
        // Prepare the statement dynamically based on the number of items to delete
        $placeholders = implode(',', array_fill(0, count($productIdsToDelete), '?'));
        $stmt = $conn->prepare("DELETE FROM products WHERE product_id IN ($placeholders)");
        
        $types = str_repeat("i", count($productIdsToDelete));
        $stmt->bind_param($types, ...$productIdsToDelete);
        
        if(!$stmt->execute()) {
            die("Deletion failed: " . $stmt->error);
        } else {
            $_SESSION['product_deleted'] = true; // Setting a session variable upon successful deletion.
            header('Location: index.php');
            exit;
        }
    }

    $sql = "SELECT p.product_id, p.sku, p.name, p.price, p.product_type,";
    $sql .= "d.size as dvd_size, b.weight as book_weight, ";
    $sql .= "f.height as furniture_height, f.width as furniture_width, f.length as furniture_length ";
    $sql .= "FROM products p ";
    $sql .= "LEFT JOIN dvd_table d ON p.product_id = d.product_id ";
    $sql .= "LEFT JOIN book_table b ON p.product_id = b.product_id ";
    $sql .= "LEFT JOIN furniture_table f ON p.product_id = f.product_id ";
    $sql .= "ORDER BY p.product_id";

    $products = mysqli_query($conn, $sql);

    if(!$products) {
        die("Query failed: " . mysqli_error($conn));
    }
?>
<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8"/>
    <title>Scandiweb Test Assignment</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./style.css"/>
    <script src="./index.js"></script>
</head>

<body>

<?php
    if (isset($_SESSION['product_deleted']) && $_SESSION['product_deleted']) {
        echo "<script> showNotification('The products have been deleted.', 5000); </script>";
        // $_SESSION['product_deleted'] = false; // Resetting the session variable.
    }
?>

<form action="index.php" method="post" id="delete-form">
    <div id="notification" class="notification" style="display: none;"></div>
    <div class="title-and-buttons">
        <h1 class="align-self-start mt-3 ml-4 mb-3">Product List</h1>
        <div class="header-container">
            <a href="./add.php">
                <button type="button" class="btn btn-primary mr-2 mt-3" id="add-product-btn">ADD</button>
            </a>
            <button name="mass-delete-btn" class="btn btn-danger mt-3 mr-5" type="submit" id="delete-product-btn">MASS DELETE</button>
        </div>
    </div>
    <hr class="hr-header">
    <div class="grid-container">
    <?php
        while($product = mysqli_fetch_assoc($products)) {
            $specific_attribute = "";

            switch($product['product_type']) {
                case 'DVD':
                    $specific_attribute = "Size: {$product['dvd_size']}MB";
                    break;
                case 'Book':
                    $specific_attribute = "Weight: {$product['book_weight']}Kg";
                    break;
                case 'Furniture':
                    $specific_attribute = "Dimensions: {$product['furniture_height']}x{$product['furniture_width']}x{$product['furniture_length']}";
                    break;
            }
    ?>
        <div class="card">
            <input type="checkbox" name="delete[]" value="<?php echo $product['product_id']; ?>">
            <span class="checkmark"></span>
            <div class="product-details">
                <div><?php echo $product['sku']; ?></div>
                <div><?php echo $product['name']; ?></div>
                <div><?php echo "$" . $product['price']; ?></div>
                <div><?php echo $specific_attribute; ?></div>
            </div>
        </div>
    <?php
        }
    ?>
    </div>
</form>

<?php include 'footer.php'; ?>
</body>

</html>