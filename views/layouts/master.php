<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fashion eCommerce HTML Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    
    <!-- CSS 
    ========================= -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php require_once PATH_VIEW. $style . '.php'; ?>
   
</head>

<body>

    <!-- Main Wrapper Start -->
    <!--Offcanvas menu area start-->
    <div class="off_canvars_overlay">
                
    </div>

    <!--Offcanvas menu area end-->
    
    <!--header area start-->
    <?php require_once PATH_VIEW. 'layouts/partials/header.php'; ?>
    <!--header area end-->

    <!--slider area end-->

    <!-- content -->
    <?php require_once PATH_VIEW. $view . '.php'; ?>

    <!--footer area start-->
    <?php require_once PATH_VIEW. 'layouts/partials/footer.php'; ?>


<!-- JS
============================================ -->


<!--  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<?php if(isset($script)&&$script){
       require_once PATH_VIEW . 'script/'.$script .'.php';

    }?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculateTotalPrice() {
        let totalPrice = 0;
        document.querySelectorAll('.product_price').forEach(function(priceElement) {
            const price = parseFloat(priceElement.dataset.price);
            const quantity = parseInt(priceElement.dataset.quantity);
            if (!isNaN(price) && !isNaN(quantity)) {
                totalPrice += price * quantity;
            }
        });
        return totalPrice.toFixed(2);
    }

    const totalPriceElement = document.querySelector('.total-price');
    const totalPrice = calculateTotalPrice();
    totalPriceElement.innerText = `${totalPrice} đ`;
});
</script>

</body>

</html>