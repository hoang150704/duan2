<?php

$product = $groupedData[$id];
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $product['product_name']; ?></title>
    <script>
        function updatePriceAndQuantity() {
            var selectedAttributes = {};
            var attributes = document.querySelectorAll('input[type="radio"]:checked');
            
            attributes.forEach(function(attribute) {
                var name = attribute.name;
                var value = attribute.value;
                selectedAttributes[name] = value;
            });

            var variants = <?php echo json_encode($product['variants']); ?>;
            
            for (var key in variants) {
                var variant = variants[key];
                var match = true;

                for (var attributeName in variant['attributes']) {
                    if (variant['attributes'][attributeName][0] !== selectedAttributes[attributeName]) {
                        match = false;
                        break;
                    }
                }

                if (match) {
                    document.getElementById('price').innerText = 'Giá: ' + variant['price'];
                    document.getElementById('quantity').innerText = 'Số lượng: ' + variant['quantity'];
                    break;
                }
            }
        }
    </script>
</head>
<body>
    <h1><?php echo $product['product_name']; ?></h1>
    <img src="<?php echo $product['main_image']; ?>" alt="<?php echo $product['product_name']; ?>" style="width: 200px;">
    <p><?php echo nl2br($product['des']); ?></p>
    
    <?php
    $attributes = [];
    foreach ($product['variants'] as $variant) {
        foreach ($variant['attributes'] as $key => $value) {
            if (!isset($attributes[$key])) {
                $attributes[$key] = [];
            }
            foreach ($value as $val) {
                if (!in_array($val, $attributes[$key])) {
                    $attributes[$key][] = $val;
                }
            }
        }
    }

    foreach ($attributes as $attributeName => $attributeValues) {
        echo '<div>';
        echo '<h3>' . $attributeName . '</h3>';
        foreach ($attributeValues as $value) {
            echo '<label><input type="radio" name="' . $attributeName . '" value="' . $value . '" onclick="updatePriceAndQuantity()">' . $value . '</label><br>';
        }
        echo '</div>';
    }
    ?>
    
    <div id="price">Giá: </div>
    <div id="quantity">Số lượng: </div>
</body>
</html>
