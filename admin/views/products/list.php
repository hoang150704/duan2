<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <?php
  require_once PATH_VIEW_ADMIN . 'layouts/components/breadcrumb.php';
  ?>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <a class="btn btn-primary btn-sm" href="<?= BASE_URL_ADMIN . '?act=product-create' ?>">
                <h3 class="card-title">Thêm sản phẩm</h3>
              </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php if (isset($_SESSION['success'])) : ?>
                <div class="d-flex align-items-center alert alert-success">

                  <i class="fas fa-check-circle"></i>
                  <p class="p-2 m-0"><?= $_SESSION['success'] ?></p>

                </div>

                <?php unset($_SESSION['success']) ?>
              <?php endif ?>
              <!--  -->
              <?php if (isset($_SESSION['delete'])) : ?>
                <div class="d-flex align-items-center alert alert-success">

                  <i class="fas fa-check-circle"></i>
                  <p class="p-2 m-0"><?= $_SESSION['delete'] ?></p>

                </div>

                <?php unset($_SESSION['delete']) ?>
              <?php endif ?>
              <table id="example2" class="table table-bordered ">
                <thead>
                  <tr>
                    <th>Hành động</th>
                    <th>Id</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Ảnh sản phẩm</th>

                  </tr>
                </thead>


                <tbody>
                  <?php foreach ($products as $product) : ?>
                    <tr>
                      <td>
                        <a class="btn btn-info btn-sm" href="<?= BASE_URL_ADMIN . '?act=product-detail&id=' . $product['product_id'] ?>">Chi tiết</a>
                        <a class="btn btn-warning btn-sm" href="<?= BASE_URL_ADMIN . '?act=product-update&id=' . $product['product_id'] ?>">Sửa</a>
                        <a class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn xóa không!!!!') " href="<?= BASE_URL_ADMIN . '?act=product-delete&id=' . $product['product_id'] ?>">Xóa</a>
                      </td>
                      <td><?= $product['product_id'] ?></td>
                      <td><?= $product['product_name'] ?> </td>
                      <td><?= $product['category_name'] ?></td>
                      <td><img src="<?= BASE_URL . $product['main_image']   ?>" alt="" width="50px"> </td>

                    </tr>
                  <?php endforeach; ?>

              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>