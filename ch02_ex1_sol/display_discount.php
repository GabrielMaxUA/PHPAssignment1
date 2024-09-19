<?php
    // Retrieve form inputs
    $product_description = filter_input(INPUT_POST, 'product_description');
    $list_price = filter_input(INPUT_POST, 'list_price', FILTER_VALIDATE_FLOAT);
    $discount_percent = filter_input(INPUT_POST, 'discount_percent', FILTER_VALIDATE_FLOAT);
    
    $error = ''; // Initialize error message variable
    
    // Validate the inputs
    if(!$product_description) {
        $error = 'Please enter the product name.<br>';
    }
    if($list_price === false || $list_price <= 0) {
        $error .= 'Please enter a valid product price greater than 0.<br>';
    }
    if($discount_percent === false) {
        $error .= 'Please enter a valid discount percentage.<br>';
    } else if($discount_percent < 0 || $discount_percent > 100) {
        $error .= 'Discount should be between 0% and 100%.<br>';
    }
    
    // Only calculate if there are no validation errors
    if (empty($error)) {
        $discount = $list_price * $discount_percent * 0.01; // Calculate discount amount
        $discount_price = $list_price - $discount; // Calculate price after discount
        $tax_rate = 0.08; // 8% tax rate
        $tax_amount = $tax_rate * $discount_price; // Calculate tax amount
        $total = $discount_price + $tax_amount; // Total price after tax
        
        // Format the values for display
        $list_price_f = "$" . number_format($list_price, 2);
        $discount_percent_f = $discount_percent . "%";
        $discount_f = "$" . number_format($discount, 2);
        $discount_price_f = "$" . number_format($discount_price, 2);
        $tax_amount_f = "$" . number_format($tax_amount, 2);
        $total_f = "$" . number_format($total, 2);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <main>
        <h1>Product Discount Calculator</h1>

        <!-- Display errors, if any -->
        <?php if (!empty($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } else { ?>

        <!-- Display the calculated values if no errors -->
        <label>Product Description:</label>
        <span><?php echo htmlspecialchars($product_description); ?></span><br>

        <label>List Price:</label>
        <span><?php echo $list_price_f; ?></span><br>

        <label>Discount Percent:</label>
        <span><?php echo $discount_percent_f; ?></span><br>

        <label>Discount Amount:</label>
        <span><?php echo $discount_f; ?></span><br>

        <label>Discount Price:</label>
        <span><?php echo $discount_price_f; ?></span><br>

        <label>Tax rate:</label>
        <span><?php echo $tax_rate * 100; ?>%</span><br>

        <label>Tax amount:</label>
        <span><?php echo $tax_amount_f; ?></span><br>

        <label>Total:</label>
        <span><?php echo $total_f; ?></span><br>

        <?php } ?>
        
        <label>&nbsp;</label>
        <a href="index.html">Back</a>
    </main>
</body>
</html>
