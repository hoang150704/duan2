  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/admin/dist/css/adminlte.min.css">
  <!--  -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/thinline.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/css/multi-select-tag.css">
  <style>
    .image-container {
      position: relative;
      display: inline-block;
      margin: 5px;
    }

    .image-container img {
      width: 110px;
    }

    .remove-button {
      position: absolute;
      top: 2px;
      right: 5px;
      background: none;
      /* Loại bỏ nền */
      border: none;
      /* Loại bỏ viền */
      width: 20px;
      height: 20px;
      display: flex;
      /* Sử dụng flex để căn giữa biểu tượng */
      align-items: center;
      /* Căn giữa theo chiều dọc */
      justify-content: center;
      /* Căn giữa theo chiều ngang */
      cursor: pointer;
      display: none;
    }

    .image-container:hover .remove-button {
      display: block;
    }
    .variant_input ul{
        padding: 5px;
        margin: 0;
        list-style: none;
        display: flex;
        flex-wrap: wrap;
        border: 1px solid #5556;
        border-radius: 5px;
    }
    #form-control{
        border: 1px solid #5556;
        border-radius: 5px;
        height: 37px;
        width: 200px;
    }
    .variant_input li{
        padding: 5px;
        margin: 0 5px 5px 0;
        border: 1px solid #5556;
        border-radius: 5px;
        display: flex;
        align-items: center;
    }
    .variant_input li .remove{
        width: 12px;
        height: 12px;
        background-image: url(http://localhost:8080/duan/uploads/remove.png);
        background-size: cover;
        margin-left: 10px;
    }
    #inputVariant{
        order: 1;
        border: none;
        outline: none;
    }
    #class-variant{
        display: flex;
    }
    #custom_image_preview_container {
    display: flex;
    flex-wrap: wrap;
}

.custom-image-container {
    position: relative;
    margin: 5px;
}

.custom-image {
    width: 110px;
    height: auto;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.custom-remove-button {
    position: absolute;
    top: 5px;
    right: 5px;
    background: none;
    border: none;
    cursor: pointer;
}
  </style>
  

  