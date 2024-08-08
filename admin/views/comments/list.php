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
              <form action="" method="post" class="row border">
                <div class="form-group col-5">
                  <label for="exampleInputcategory_id1">Admin Reply</label>
                  <select name="reply" id="exampleInputcategory_id1" class="form-control">
                    <option value="1" <?= ($replyFilter == 1) ? 'selected' : '' ?>>Tất cả</option>
                    <option value="2" <?= ($replyFilter == 2) ? 'selected' : '' ?>>Chưa trả lời bình luận</option>
                    <option value="3" <?= ($replyFilter == 3) ? 'selected' : '' ?>>Đã trả lời bình luận</option>
                  </select>
                </div>
                <div class="form-group col-5">
                  <label for="exampleInputcategory_id1">Lọc</label>
                  <select name="status" id="exampleInputcategory_id1" class="form-control">
                    <option value="1" <?= ($statusFilter == 1) ? 'selected' : '' ?>>Mới nhất</option>
                    <option value="2" <?= ($statusFilter == 2) ? 'selected' : '' ?>>Cũ nhất</option>
                  </select>
                </div>
                <div class="col-2 d-flex justify-content-center align-items-center pt-3">
                  <button class="btn btn-primary">Lọc</button>
                </div>
              </form>
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
                    <th>Người bình luận</th>
                    <th>Ngày bình luận</th>
                    <th>Đánh giá(sao)</th>
                    <th>Admin phản hồi</th>
                  </tr>
                </thead>


                <tbody>
                  <?php foreach ($comments as $comment) : ?>
                    <tr>
                      <td> <a class="btn btn-success btn-sm" href="<?= BASE_URL_ADMIN . '?act=comment-detail&id=' . $comment['id'] ?>">Chi tiết</a>
                        <a class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn xóa không!!!!') " href="<?= BASE_URL_ADMIN . '?act=comment-delete&id=' . $comment['id'] ?>">Xóa</a>
                      </td>
                      <td><?= $comment['id'] ?></td>
                      <td><?= $comment['username'] ?></td>
                      <td><?= $comment['date_comment'] ?></td>
                      <td class="d-flex align-items-center justify-content-center"><?= $comment['rating'] ?> <p class="p-1"></p> <i class="fas fa-star" style="color: #FFD43B;"></i></td>
                      <td class="p-2">
                        <?php if ($comment['reply'] ==  null) : ?>
                          <p class="alert alert-warning m-0 p-2" role="alert">Chưa phản hồi khách hàng</p>
                        <?php else : ?>
                          <p class="alert alert-success m-0 p-2" role="alert">Đã phản hồi</p>
                        <?php endif ?>
                      </td>

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