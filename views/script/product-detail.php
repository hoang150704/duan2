<script src="<?= BASE_URL ?>assets/user/theme_shop/assets/js/plugins.js"></script>

<!-- Main JS -->
<script src="<?= BASE_URL ?>assets/user/theme_shop/assets/js/main.js"></script>
<!--  -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ratingStars = [...document.getElementsByClassName('commentstar')];
        const ratingValue = document.getElementById('rating-value');
        const form = document.getElementById('rating-form');

        ratingStars.forEach((star, index) => {
            star.addEventListener('click', () => {
                ratingStars.forEach((s, i) => {
                    if (i <= index) {
                        s.style.color = 'gold';
                    } else {
                        s.style.color = 'gray';
                    }
                });
                ratingValue.value = index + 1;
            });
        });

    });
</script>
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
        var matchedVariant = null;

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
                matchedVariant = variant;
                break;
            }
        }

        var priceElement = document.getElementById('price');
        var oldPrice = document.getElementById('old_price');
        var quantityElement = document.getElementById('quantity');
        var quantityInput = document.querySelector('input[name="quantity"]');
        var hiddenIdElementId = document.getElementById('product_lookup_id');
        var hiddenIdElementPrice = document.getElementById('price_lookup');
        var outOfStockMessage = document.getElementById('out-of-stock-message');
        var quantityaddtocart = document.getElementById('quantityaddtocart');

        if (matchedVariant) {
            if (matchedVariant['sale_price'] > 0) {
                priceElement.innerText = matchedVariant['sale_price'] + ' đ';
                oldPrice.innerText = matchedVariant['price'] + ' đ';
                hiddenIdElementPrice.value = matchedVariant['sale_price'];
            } else {
                priceElement.innerText = matchedVariant['price'] + ' đ';
                hiddenIdElementPrice.value = matchedVariant['price'];
            }
            quantityElement.innerText = 'Số lượng còn lại: ' + matchedVariant['quantity'];
            quantityInput.setAttribute('max', matchedVariant['quantity']);
            hiddenIdElementId.value = matchedVariant['product_lookup_id'];

            if (matchedVariant['quantity'] == 0) {
                outOfStockMessage.style.display = 'block';
                quantityaddtocart.style.display = 'none';
            } else {
                outOfStockMessage.style.display = 'none';
                quantityaddtocart.style.display = 'block';
            }
        } else {
            priceElement.innerText = '';
            oldPrice.innerText = '';
            quantityElement.innerText = '';
            quantityInput.removeAttribute('max');
            hiddenIdElementId.value = '';
            hiddenIdElementPrice.value = '';
            outOfStockMessage.style.display = 'none';
            quantityaddtocart.style.display = 'none';
        }
    }

    function handleAttributeClick(attributeName, value) {
        var radios = document.querySelectorAll('input[name="' + attributeName + '"]');
        radios.forEach(function(radio) {
            radio.checked = false;
            var label = document.querySelector('label[for="' + radio.id + '"]');
            if (label) {
                label.classList.remove('selected');
            }
        });

        var clickedRadio = document.querySelector('input[name="' + attributeName + '"][value="' + value + '"]');
        if (clickedRadio) {
            clickedRadio.checked = true;
            var clickedLabel = document.querySelector('label[for="' + clickedRadio.id + '"]');
            if (clickedLabel) {
                clickedLabel.classList.add('selected');
            }
        }

        updatePriceAndQuantity();
    }

    document.addEventListener('DOMContentLoaded', function() {
        var defaultVariant = <?php echo json_encode($defaultVariant); ?>;
        if (defaultVariant) {
            for (var attributeName in defaultVariant['attributes']) {
                var value = defaultVariant['attributes'][attributeName][0];
                handleAttributeClick(attributeName, value);
            }
        }
        updatePriceAndQuantity();
    });
</script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInputs = document.querySelectorAll('#quantity-input');

        quantityInputs.forEach(input => {
            input.addEventListener('input', function() {
                const price = parseFloat(this.dataset.price);
                const max = parseInt(this.max);
                const quantity = parseInt(this.value);

                const warning = document.getElementById('quantity-warning');

                if (quantity > max) {
                    this.value = max;
                    warning.style.display = 'block';
                } else {
                    warning.style.display = 'none';
                }

                const total = quantity * price;
                this.closest('tr').querySelector('.product_total').innerText = total.toFixed(2);
            });
        });
    });
</script>
<script>
    var quantityaddtocart = document.getElementById('quantityaddtocart');
    var quantityinputhidden = document.getElementById('quantityinputhidden');
    var outOfStockMessage = document.getElementById('out-of-stock-message');
    if(quantityinputhidden.value == 0){
        quantityaddtocart.style.display = 'none';
        outOfStockMessage.style.display = 'block';
    }
</script>