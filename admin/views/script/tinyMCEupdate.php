<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.2.1/tinymce.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script>


<script>
  function generateVariants(arrays, prefix = [], index = 0) {
    if (index === arrays.length) {
        return [prefix];
    }

    var result = [];
    
    for (var i = 0; i < arrays[index].length; i++) {
        result = result.concat(generateVariants(arrays, prefix.concat(arrays[index][i]), index + 1));
    }

    return result;
}

function updateFieldsAndVariants() {
    var dynamicFieldsContainer = document.getElementById('dynamicFieldsContainer');
    dynamicFieldsContainer.innerHTML = ''; // Clear previous fields
    
    var selectedValues = Array.from(document.getElementById('attributes').selectedOptions).map(option => option.value);
    var attributeValueArrays = [];

    selectedValues.forEach(value => {
        var number = value;
        var attributeValueOptions = <?= json_encode($listAllAttributeValues) ?>[number];

        if (attributeValueOptions) {
            var fieldDiv = document.createElement('div');
            fieldDiv.className = 'form-group';
            fieldDiv.innerHTML = `
                <label for="value_${number}">Giá trị thuộc tính</label>
                <select name="attribute_value_id_${number}[]" id="attribute_values${number}" class="form-control" multiple>
                    ${attributeValueOptions.map(value => `<option value="${value.id}" data-text="${value.attribute_value_name}">${value.attribute_value_name}</option>`).join('')}
                </select>
            `;
            dynamicFieldsContainer.appendChild(fieldDiv);
        }
    });

    updateVariants();
    updateVariantsOnChange(); // Thêm dòng này để cập nhật sự kiện thay đổi
}

function updateVariants() {
    var attributeValueArrays = Array.from(document.querySelectorAll('#dynamicFieldsContainer select')).map(select => 
        Array.from(select.selectedOptions).map(option => ({
            id: option.value,
            text: option.getAttribute('data-text')
        }))
    );

    var variants = generateVariants(attributeValueArrays);
    var variantsContainer = document.getElementById('variantsContainer');
    variantsContainer.innerHTML = variants.map(variant => {
        var idPrefix = variant.map(attr => attr.id).join('_');
        return `
            <div class="variant">
                <p class="alert alert-info">${variant.map(attr => attr.text).join(', ')}</p>
                <div class="form-group">
                    <label for="price_${idPrefix}">Giá thường</label>
                    <input type="number" class="form-control" id="price_${idPrefix}" placeholder="Giá sản phẩm" name="variants[${idPrefix}][price]">
                </div>
                <div class="form-group">
                    <label for="sale_price_${idPrefix}">Giá ưu đãi</label>
                    <input type="number" class="form-control" id="sale_price_${idPrefix}" placeholder="Giá ưu đãi" name="variants[${idPrefix}][sale_price]">
                </div>
                <div class="form-group">
                    <label for="quantity_${idPrefix}">Số lượng</label>
                    <input type="number" class="form-control" id="quantity_${idPrefix}" placeholder="Số lượng sản phẩm" name="variants[${idPrefix}][quantity]">
                </div>
                ${variant.map(attr => `
                    <input type="hidden" name="variants[${idPrefix}][attributes][]" value="${attr.id}">
                `).join('')}
            </div>
        `;
    }).join('');
}

function updateVariantsOnChange() {
    var selectElements = document.querySelectorAll('#dynamicFieldsContainer select');

    selectElements.forEach(select => {
        select.addEventListener('change', updateVariants);
    });
}

document.getElementById('addAttribute').addEventListener('click', function() {
    updateFieldsAndVariants();
});

</script>


<script>
  tinymce.init({
    selector: 'textarea#content',
    height: 600,
    plugins: [
      'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
      'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
      'insertdatetime', 'media', 'table', 'help', 'wordcount'
    ],
    toolbar: 'undo redo | blocks | ' +
      'bold italic backcolor | alignleft aligncenter ' +
      'alignright alignjustify | bullist numlist outdent indent | ' +
      'removeformat | help',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
  });
</script>
<script>
  var currentImage = null;

  function saveCurrentImage() {
    const fileInput = document.querySelector('#main_image');
    if (fileInput.files[0]) {
      currentImage = fileInput.files[0];
    }
  }

  function handleFileChange() {
    const fileInput = document.querySelector('#main_image');
    const previewMainImage = document.querySelector('#main_image_preview');
    const file = fileInput.files[0];

    if (!file && currentImage) {
      // No new file selected, restore the previous file
      fileInput.files = new DataTransfer().files;
      const dataTransfer = new DataTransfer();
      dataTransfer.items.add(currentImage);
      fileInput.files = dataTransfer.files;
      previewMainImage.src = URL.createObjectURL(currentImage);
      return;
    }

    const reader = new FileReader();
    reader.addEventListener("load", function() {
      previewMainImage.src = reader.result;
    }, false);

    if (file) {
      reader.readAsDataURL(file);
    }
  }
//   

</script>
