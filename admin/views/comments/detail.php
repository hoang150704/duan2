  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <a href="<?= BASE_URL_ADMIN . '?act=comments' ?>" class="btn btn-primary">Back to list</a>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Chi tiết đánh giá</li>
                      </ol>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-md-3">

                      <!-- Profile Image -->
                      <div class="card card-primary card-outline" style="border: none;">
                          <div class="card-body box-profile pt-2">
                              <p class="alert alert-success p-2 m-0" align="center">Khách hàng đánh giá</p>
                              <hr class="m-0">
                              <div class="text-center mt-2">
                                  <img class="profile-user-img img-fluid img-circle" src="<?= BASE_URL . $comment['avatar'] ?>" alt="User profile picture">
                              </div>

                              <h3 class="profile-username text-center"><?= ucfirst($comment['username']) ?></h3>

                              <p class="text-muted text-center"><?= ucfirst($comment['fullname']) ?></p>

                              <ul class="list-group list-group-unbordered mb-3">
                                  <li class="list-group-item d-flex">
                                      <b>Số điện thoại:</b>
                                      <p><?= $comment['phone'] ?> </p>
                                  </li>
                                  <li class="list-group-item d-flex">
                                      <b>Email:</b>
                                      <p><?= $comment['email'] ?></i></p>
                                  </li>
                                  <li class="list-group-item d-flex">
                                      <b>Ngày đánh giá:</b>
                                      <p><?= $comment['date_comment'] ?></p>
                                  </li>
                                  <li class="list-group-item d-flex">
                                      <b>Đánh giá:</b>
                                      <p><?= $comment['rating'] ?> <i class="fas fa-star" style="color: #FFD43B;"></i></p>
                                  </li>
                              </ul>
                          </div>
                          <!-- /.card-body -->
                      </div>
                      <!-- /.card -->

                  </div>
                  <!-- /.col -->
                  <div class="col-md-9">
                      <div class="card">
                          <div class="card-header p-2">
                              <ul class="nav nav-pills">
                                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Nội dung đánh giá</a></li>
                              </ul>
                          </div><!-- /.card-header -->
                          <div class="card-body">
                              <div class="tab-content">
                                  <div class="active tab-pane" id="activity">
                                      <div class="post">
                                          <div class="row mb-3 ms-2">
                                              <b>Sản phẩm được đánh giá:</n>
                                          </div>
                                          <div class="row gap-3">
                                              <div class="col-2">
                                                  <img src="<?= BASE_URL . $comment['main_image'] ?>" width="100px" alt="">
                                              </div>
                                              <div>
                                                  <p><b><?= $comment['product_name'] ?></b></p>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Post -->
                                      <hr>
                                      <div class="post">
                                          <div class="row mb-3 mt-2">
                                              <b>Nội dung đánh giá:</n>
                                          </div>
                                          <!-- /.user-block -->
                                          <p style="color: black;"><?= $comment['comment_content'] ?></p>

                                          
                                              <?php if ($comment['reply'] == null) : ?>
                                                  <a href="<?=BASE_URL_ADMIN.'?act=comment-reply&id='.$comment['id']?>" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Trả lời</a>
                                              <?php else : ?>
                                          <p class="alert alert-success"><?= $comment['reply'] ?></p>
                                          <a href="<?=BASE_URL_ADMIN.'?act=comment-reply&id='.$comment['id']?>" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Sửa</a>
                                            <?php endif ?>
                                      <span class="float-right">
                                      </span>
                                      </p>
                                      </div>

                                  </div>
                              </div>
                              <!-- /.tab-content -->
                          </div><!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                  </div>
                  <!-- /.col -->
              </div>
              <!-- /.row -->
          </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->