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
              <div class="row align-items-center">
                <form action="" method="post" class="col-md-6 d-flex align-items-center">
                  <select name="status_id" id="exampleInputcategory_id1" class="form-control">
                    <option value="0" <?= ($status_id == 0) ? 'selected' : '' ?>>Tất cả</option>
                    <?php foreach ($status_orders as $status_order) : ?>

                      <option value="<?= $status_order['id'] ?>" <?= ($status_id == $status_order['id']) ? 'selected' : '' ?> ><?= $status_order['status_order_name'] ?></option>
                    <?php endforeach ?>

                  </select>
                  <button class="btn btn-primary ml-2">Lọc</button>
                </form>
                <form class="col-md-6 d-flex justify-content-end align-items-center" method="post">
                  <input class="form-control" type="search" name="order_code" placeholder="Tìm kiếm theo mã đơn hàng" aria-label="Search">
                  <button class="btn btn-outline-success ml-2" type="submit">Search</button>
                </form>
              </div>
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
                    <th>Mã đơn hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Tình trạng đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                  </tr>
                </thead>


                <tbody>
                  <?php foreach ($orders as $order) : ?>
                    <tr>
                      <td>
                        <a class="btn btn-info btn-sm" href="<?= BASE_URL_ADMIN . '?act=order-detail&id=' . $order['id'] ?>">Chi tiết</a>
                        <a class="btn btn-warning btn-sm" href="<?= BASE_URL_ADMIN . '?act=order-update&id=' . $order['id'] ?>">Sửa</a>
                        <a class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn xóa không!!!!') " href="<?= BASE_URL_ADMIN . '?act=order-delete&id=' . $order['id'] ?>">Xóa</a>
                      </td>
                      <td><?= $order['order_code'] ?></td>
                      <td><?= $order['fullname'] ?> </td>
                      <td>
                        <p class="btn btn-primary"><?= $order['status_name'] ?></p>
                      </td>
                      <td> <?= $order['date_order'] ?></td>
                      <td> <?= $order['total_money'] ?></td>
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