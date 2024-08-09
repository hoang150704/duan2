  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Trang chi tiết sản phẩm</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active"><?= $product['product_name'] ?></li>
                      </ol>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

          <!-- Default box -->
          <div class="card card-solid">
              <div class="card-body">
                  <div class="row">
                      <div class="col-12 col-sm-6">
                          <h3 class="d-inline-block d-sm-none"><?= $product['product_name'] ?></h3>
                          <div class="col-12">
                              <img src="<?= BASE_URL . $product['main_image'] ?>" class="product-image" alt="Product Image">
                          </div>
                          <div class="col-12 product-image-thumbs">
                              <?php foreach ($images as $key => $vale) : ?>
                                  <div class="product-image-thumb <?php if ($key == 0) {
                                                                        echo "active";
                                                                    } ?>"><img src="<?= BASE_URL . $vale['image'] ?>" alt="Product Image"></div>
                              <?php endforeach ?>
                          </div>
                      </div>
                      <div class="col-12 col-sm-6">
                          <h3 class="my-3"><?= $product['product_name'] ?></h3>
                          <p></p>

                          <hr>

                          <div class="bg-gray py-2 px-3 mt-4">
                              <?php if ($product['sale_price'] == 0) : ?>
                                  <?php if ($product['price'] == 0) : ?>
                                      <h2 class="mb-0">
                                          Liên hệ
                                      </h2>
                                  <?php else : ?>
                                      <h2 class="mb-0">
                                          <?= $product['price'] ?> VND
                                      </h2>
                                  <?php endif ?>
                              <?php else : ?>

                                  <h2 class="mb-0">
                                      <?= $product['sale_price'] ?> VND
                                  </h2>
                                  <h4 class="mt-0">
                                      <s> <small> <?= $product['price'] ?> VND</small></s>
                                  </h4>
                              <?php endif ?>

                          </div>
                          <p class="mt-3">Danh mục: <?= $product['category_name'] ?></p>
                          <p>Mô tả: <?= $product['des'] ?></p>
                      </div>
                  </div>
                  <div class="row mt-3 border rounded p-2" style="display: <?php if($product['attribute_value_id'] == 0){echo "none";} ?>;">
                      <div class="col-12 d-flex justify-content-between align-items-center">
                          <h4>Danh sách biến thể</h4>
                          <a href="<?= BASE_URL_ADMIN . '?act=product-lookup-insert&id=' . $id ?>">Thêm phiên bản</a>
                      </div>
                      <div class="row mt-3 border rounded p-2" style="width: 100%;">
                          <table class="table" style="width: 100%;">
                              <thead>
                                  <tr>
                                      <th scope="col">ID</th>
                                      <th scope="col">Biến thể</th>
                                      <th>Giá</th>
                                      <th>Giá ưu đãi</th>
                                      <th>Số lượng</th>

                                  </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($result as $key => $value) : ?>
                                      <tr>
                                          <th scope="row"><?= $key ?></th>

                                          <td>
                                              |<?php foreach ($value['variants'] as $variant) : ?>
                                              <?= $variant ?>|
                                          <?php endforeach ?>
                                          </td>
                                          <td><?= $value['price'] ?></td>
                                          <td><?= $value['sale_price'] ?></td>
                                          <td><?= $value['quantity'] ?></td>

                                      </tr>
                                  <?php endforeach ?>
                              </tbody>
                          </table>
                      </div>
                  </div>
                  <div class="row mt-4">
                      <nav class="w-100">
                          <div class="nav nav-tabs" id="product-tab" role="tablist">
                              <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Bình luận</a>
                          </div>
                      </nav>
                      <div class="tab-content p-3" id="nav-tabContent">
                          <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                              <h4><?= $countListComment ?> Bình luận</h4>

                              <!-- COMMENT 1 - START -->
                              <?php foreach ($listComments as $comments) : ?>
                                  <div class="media row">
                                      <a class="pull-left col-1" href="#"><img class="media-object" src="<?= BASE_URL . $comments['avatar'] ?>" alt=""></a>
                                      <div class="media-body col-10">
                                          <h4 class="media-heading"><?= $comments['fullname'] ?></h4>
                                          <div class=" product_ratting">
                                              <ul>
                                                  <?php
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        if ($i <= $comments['rating']) {
                                                            // Sao vàng
                                                            echo '<li><i class="fa fa-star" style="color: gold;"></i></li>';
                                                        } else {
                                                            // Sao xám
                                                            echo '<li><i class="fa fa-star" style="color: gray;"></i></li>';
                                                        }
                                                    }
                                                    ?>
                                              </ul>
                                          </div>
                                          <p><?= $comments['comment_content'] ?>.</p>
                                          <ul class="list-unstyled list-inline media-detail pull-left">
                                              <li><i class="fa fa-calendar"></i><?= $comments['date_comment'] ?></li>

                                          </ul>
                                          <ul class="list-unstyled list-inline media-detail pull-right">

                                          </ul>
                                      </div>

                                  </div>
                                  <?php if (!empty($comments['reply'])) : ?>
                                      <div class="row">
                                          <p class="alert alert-success mb-2">Admin: <?= $comments['reply'] ?></p>
                                      </div>
                                  <?php endif ?>
                              <?php endforeach ?>
                              <!-- COMMENT 1 - END -->
                          </div>
                      </div>
                  </div>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->