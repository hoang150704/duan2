 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <?php
        require_once PATH_VIEW_ADMIN . 'layouts/components/breadcrumb.php';
        ?>

     <!-- Main content -->
     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <!-- left column -->
                 <div class="col-md-12">
                     <!-- general form elements -->
                     <div class="card card-primay">
                         <div class="card-header">
                             <a class="btn btn-primary btn-sm" href="<?= BASE_URL_ADMIN . '?act=product-update&id=' . $id ?>">
                                 <h3 class="card-title">Back</h3>
                             </a>
                         </div>
                         <?php if (isset($_SESSION['success'])) : ?>
                             <div class="d-flex align-items-center alert alert-success">

                                 <i class="fas fa-check-circle"></i>
                                 <p class="p-2 m-0"><?= $_SESSION['success'] ?></p>

                             </div>
                             <?php unset($_SESSION['success']) ?>
                         <?php endif ?>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form method="POST" enctype="multipart/form-data">
                             <div class="card-body">
                                 <?php if (isset($_SESSION['errors'])) : ?>
                                     <div class="alert alert-danger">
                                         <ul>
                                             <?php
                                                foreach ($_SESSION['errors'] as $error) : ?>
                                                 <li><?= $error ?></li>
                                             <?php endforeach ?>

                                         </ul>
                                     </div>
                                     <?php unset($_SESSION['errors']) ?>
                                 <?php endif ?>
                                 <div id="notification" class="alert alert-danger" style="display: none;">
                                     <span id="thongbao">Phiên bản đã tồn tại,Hãy lựa chọn phiên bản mới</span>
                                 </div>
                                 <?php foreach ($attribute_names as $attribute_id => $attribute) : ?>
                                     <div class="form-group">
                                         <label for="attribute_<?= $attribute_id ?>"><?= $attribute ?></label>
                                         <select name="attribute_<?= $attribute_id ?>" id="attribute_<?= $attribute_id ?>" class="form-control attribute-select">

                                             <?php foreach ($result as $option) : ?>

                                                 <?php if ($option['attribute_id'] == $attribute_id) : ?>
                                                     <option value="<?= $option['id'] ?>" data-attribute-name="<?= $attribute ?>">
                                                         <?= $option['attribute_value_name'] ?>
                                                     </option>
                                                 <?php endif; ?>
                                             <?php endforeach; ?>
                                         </select>
                                     </div>
                                 <?php endforeach; ?>

                                 <div class="form-group">
                                     <label for="exampleFormControlInput1">Giá</label>
                                     <input type="number" class="form-control" id="exampleFormControlInput1" name="price" value="<?= $lookup['price'] ?>" placeholder="Giá">
                                 </div>

                                 <div class="form-group">
                                     <label for="exampleFormControlInput1">Giá ưu đãi</label>
                                     <input type="number" class="form-control" id="exampleFormControlInput1" name="sale_price" value="<?= $lookup['sale_price'] ?>" placeholder="Giá ưu đãi">
                                 </div>

                                 <div class="form-group">
                                     <label for="exampleFormControlInput1">Số lượng</label>
                                     <input type="number" class="form-control" id="exampleFormControlInput1" name="quantity" value="<?= $lookup['quantity'] ?>" placeholder="Số lượng">
                                 </div>




                             </div>
                             <!-- /.card-body -->

                             <div class="card-footer ">
                                 <button type="submit" class="btn btn-primary " name="submit">Submit</button>
                             </div>

                         </form>
                         <!-- END FORM -->

                     </div>
                     <!-- /.card -->


                 </div>

             </div>
             <!-- /.row -->
         </div><!-- /.container-fluid -->

     </section>

     <!-- /.content -->
 </div>



 <script>
     document.addEventListener('DOMContentLoaded', function() {
         const typeSelect = document.getElementById('type');
         const productNoVariant = document.getElementById('product_no_variant');
         const productVariant = document.getElementById('product_variant');

         typeSelect.addEventListener('change', function() {
             if (this.value == '2') {
                 productNoVariant.style.display = 'none';
                 productVariant.style.display = 'block';
             } else {
                 productNoVariant.style.display = 'block';
                 productVariant.style.display = 'none';
             }
         });
     })
 </script>
 <script>
     var existingVariants = <?php echo json_encode($convertedData); ?>;
     document.addEventListener('DOMContentLoaded', function() {
         let selectedValues = {};

         // Collect currently selected values on page load
         document.querySelectorAll('.attribute-select').forEach(function(select) {
             const attributeName = select.options[select.selectedIndex].dataset.attributeName;
             selectedValues[attributeName] = select.value;
         });

         // Function to check if the selected variant already exists
         function checkExistingVariant() {
             let isExisting = false;

             // Check if selected values match any existing variant
             for (const [variantId, variantAttributes] of Object.entries(existingVariants)) {
                 let matches = true;

                 for (const [attributeName, attributeValues] of Object.entries(variantAttributes)) {
                     if (selectedValues[attributeName] === undefined ||
                         !attributeValues.includes(document.querySelector(`option[value="${selectedValues[attributeName]}"][data-attribute-name="${attributeName}"]`).text)) {
                         matches = false;
                         break;
                     }
                 }

                 if (matches) {
                     isExisting = true;
                     break;
                 }
             }

             // Show or hide the notification and submit button based on existence
             const notification = document.getElementById('notification');
             const submitButton = document.querySelector('.card-footer .btn-primary');

             if (isExisting) {
                 notification.style.display = 'block';
                 submitButton.style.display = 'none';
             } else {
                 notification.style.display = 'none';
                 submitButton.style.display = 'block';
             }
         }

         // Function to update select options based on selected values
         function updateOptions() {
             document.querySelectorAll('.attribute-select').forEach(function(select) {
                 const attributeName = select.options[select.selectedIndex].dataset.attributeName;

                 // Get the original options of the select element
                 let originalOptions = Array.from(select.options).map(option => {
                     return {
                         value: option.value,
                         text: option.text,
                         attributeName: option.dataset.attributeName
                     };
                 });

                 // Clear and reset options
                 select.innerHTML = '';

                 // Re-populate the select element
                 originalOptions.forEach(function(option) {
                     let disableOption = false;

                     // Append the option back to the select element
                     let newOption = document.createElement('option');
                     newOption.value = option.value;
                     newOption.textContent = option.text;
                     newOption.dataset.attributeName = option.attributeName;

                     // Append the option back to the select element
                     select.appendChild(newOption);
                 });

                 // Re-select the previously selected value
                 select.value = selectedValues[attributeName];
             });

             checkExistingVariant(); // Check if the current selections are existing variants
         }

         // Initial call to update options based on default selections
         updateOptions();

         // Add event listener for changes
         document.querySelectorAll('.attribute-select').forEach(function(selectElement) {
             selectElement.addEventListener('change', function() {
                 selectedValues = {}; // Reset selected values
                 document.querySelectorAll('.attribute-select').forEach(function(select) {
                     const attributeName = select.options[select.selectedIndex].dataset.attributeName;
                     selectedValues[attributeName] = select.value;
                 });
                 updateOptions();
             });
         });
     });
 </script>