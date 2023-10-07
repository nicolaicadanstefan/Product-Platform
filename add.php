<?php
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
    
    // Check if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $type = $_POST['productType'];
        
        switch($type) {
            case 'DVD':
                // Set the properties for the dvd product
                $dvd = new DVD();
                $dvd->set_sku($_POST['sku']);
                $dvd->set_name($_POST['name']);
                $dvd->set_price((float)$_POST['price']);
                $dvd->set_size((int)$_POST['size']);
                
                $sku = $dvd->get_sku();
                $name = $dvd->get_name();
                $price = $dvd->get_price();
                $size = $dvd->get_size();

                // Insert into products table
                $productQuery = "INSERT INTO products (sku, name, price, product_type) VALUES ('$sku', '$name', $price, 'DVD')";
                
                if ($conn->query($productQuery) === TRUE) {
                    // The last inserted id to be used as a foreign key in the dvd_table
                    $last_id = $conn->insert_id;
                    
                    // Insert into dvd_table using the last inserted id
                    $dvdQuery = "INSERT INTO dvd_table (product_id, size) VALUES ($last_id, $size)";
                    $conn->query($dvdQuery);
                }
                $conn->close();
                break;

            case 'Book':
                // Set the properties for the book product
                $book = new Book();
                $book->set_sku($_POST['sku']);
                $book->set_name($_POST['name']);
                $book->set_price((float)$_POST['price']);
                $book->set_weight((float)$_POST['weight']);
                
                $sku = $book->get_sku();
                $name = $book->get_name();
                $price = $book->get_price();
                $weight = $book->get_weight();

                $productQuery = "INSERT INTO products (sku, name, price, product_type) VALUES ('$sku', '$name', $price, 'Book')";

                if ($conn->query($productQuery) === TRUE) {
                    // The last inserted id to be used as a foreign key in the book_table
                    $last_id = $conn->insert_id;
                    
                    // Insert into book_table using the last inserted id
                    $bookQuery = "INSERT INTO book_table (product_id, weight) VALUES ($last_id, $weight)";
                    $conn->query($bookQuery);
                }
                $conn->close();
                break;

            case 'Furniture':
                // Set the properties for the furniture product
                $furniture = new Furniture();
                $furniture->set_sku($_POST['sku']);
                $furniture->set_name($_POST['name']);
                $furniture->set_price((float)$_POST['price']);
                $furniture->set_height((float)$_POST['height']);
                $furniture->set_width((float)$_POST['width']);
                $furniture->set_length((float)$_POST['length']);

                $sku = $furniture->get_sku();
                $name = $furniture->get_name();
                $price = $furniture->get_price();
                $height = $furniture->get_height();
                $width = $furniture->get_width();
                $length = $furniture->get_length();

                $query = "INSERT INTO furniture_table (sku, name, price, height, width, length) VALUES ('$sku', '$name', $price, $height, $width, $length)";

                $productQuery = "INSERT INTO products (sku, name, price, product_type) VALUES ('$sku', '$name', $price, 'Furniture')";

                if ($conn->query($productQuery) === TRUE) {
                    // The last inserted id to be used as a foreign key in the furniture_table
                    $last_id = $conn->insert_id;
                    
                    // Insert into furniture_table using the last inserted id
                    $bookQuery = "INSERT INTO furniture_table (product_id, height, width, length) VALUES ($last_id, $height, $width, $length)";
                    $conn->query($bookQuery);
                }
                $conn->close();
                break;
            }
        }
?>
<!DOCTYPE html>
<head>
    <meta name = "viewport" content="width=device-width, initial-scale=1.0">
    <meta charset = "utf-8"/>
    <title>Scandiweb Test Assignment</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./style.css"/>
    <script src="./index.js"></script>
</head>

<script>
    // This code update the form by product type
    $(document).ready(function() {
        const setTypeVisibility = () => {
            const selectedValue = $('#productType').val();
            
            // Hide all and remove required
            $('.product-specific').addClass('d-none').find('input, select, textarea').prop('required', false);

            switch(selectedValue) {
                case 'DVD':
                    $('#dvd-container').removeClass('d-none').find('input').prop('required', true);
                    break;
                case 'Book':
                    $('#book-container').removeClass('d-none').find('input').prop('required', true);
                    break;
                case 'Furniture':
                    $('#furniture-container .form-group').removeClass('d-none').find('input').prop('required', true);
                    break;
            }
        };

        $('#productType').on('change', setTypeVisibility).trigger('change');
    });
</script>

<body>

<div class="container mt-3">
    <div class="d-flex justify-content-between">
        <h1 class="align-self-start">Product Add</h1>
        <div>
            <button class="btn btn-primary mr-2 mt-4" name="add-btn" form="product-form" type="submit" id="add-product-btn">SAVE</button>
            <a href="./index.php" class="btn btn-danger mt-4" name="cancel-btn" form="cancel-form" id="delete-product-btn">CANCEL</a>
        </div>
    </div>
</div>

    <hr class="hr-header my-4">

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center"></div>
        <form id="product-form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
            <div id="notification" class="notification" style="display: none;"></div>
            <div class="form-group">
                <label for="sku">SKU:</label>
                <input type="text" class="form-control" id="sku" name="sku" placeholder="Enter details" required>
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter details" required>
            </div>

            <div class="form-group">
                <label for="price">Price ($):</label>
                <input type="number" min="0" class="form-control" id="price" name="price" placeholder="Enter details" required>
            </div>

            <div class="form-group">
                <label for="productType">Type Switcher:</label>
                <select class="form-control" id="productType" name="productType">
                    <option value="type">Type Switcher</option>
                    <option value="DVD">DVD</option>
                    <option value="Book">Book</option>
                    <option value="Furniture">Furniture</option>
                </select>
            </div>

            <!-- Fields for products -->
            <div id="dvd-container" class="form-group d-none product-specific">
                <label for="sizeinput">Size (MB):</label>
                <input type="number" min="0" class="form-control" name="size" id="sizeinput" required>
            </div>

            <div id="book-container" class="form-group d-none product-specific">
                <label for="weightinput">Weight (KG):</label>
                <input type="number" min="0" class="form-control" name="weight" id="weightinput" required>
            </div>

            <div id="furniture-container">
                <div class="form-group d-none product-specific">
                    <label for="heightinput">Height (CM):</label>
                    <input type="number" min="0" class="form-control" name="height" id="heightinput" required>
                </div>
                
                <div class="form-group d-none product-specific">
                    <label for="widthinput">Width (CM):</label>
                    <input type="number" min="0" class="form-control" name="width" id="widthinput" required>
                </div>

                <div class="form-group d-none product-specific">
                    <label for="lengthinput">Length (CM):</label>
                    <input type="number" min="0" class="form-control" name="length" id="lengthinput" required>
                </div>
            </div>

        </form>
    </div>
</div>


<?php include 'footer.php'; ?>
</body>
</html>