  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/admin/dist/css/adminlte.min.css">
  <!--  -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/thinline.css">
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

  </style>
  

  