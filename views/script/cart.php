<!-- Plugins JS -->

<script src="<?= BASE_URL ?>assets/user/theme_shop/assets/js/plugins.js"></script>

<!-- Main JS -->
<script src="<?= BASE_URL ?>assets/user/theme_shop/assets/js/main.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInputs = document.querySelectorAll('.quantity-input');

        quantityInputs.forEach(input => {
            input.addEventListener('input', function() {
                const price = parseFloat(this.dataset.price);
                const stock = parseInt(this.dataset.stock);
                const quantity = parseInt(this.value);

                const warning = this.nextElementSibling;

                if (quantity > stock) {
                    this.value = stock;
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
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.remove-product').forEach(function (removeLink) {
            removeLink.addEventListener('click', function (e) {
                e.preventDefault();
                
                if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                    const index = this.getAttribute('data-index');
                    document.getElementById('product-' + index).style.display = 'none';
                    
                    // Optionally, mark the item for removal by setting a hidden input value
                    document.querySelector(`input[name="remove[${index}]"]`).value = '1';
                }
            });
        });
    });
</script>
