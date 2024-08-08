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
                          <!-- <h4>Available Colors</h4>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-default text-center active">
                  <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked>
                  Green
                  <br>
                  <i class="fas fa-circle fa-2x text-green"></i>
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_a2" autocomplete="off">
                  Blue
                  <br>
                  <i class="fas fa-circle fa-2x text-blue"></i>
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_a3" autocomplete="off">
                  Purple
                  <br>
                  <i class="fas fa-circle fa-2x text-purple"></i>
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_a4" autocomplete="off">
                  Red
                  <br>
                  <i class="fas fa-circle fa-2x text-red"></i>
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_a5" autocomplete="off">
                  Orange
                  <br>
                  <i class="fas fa-circle fa-2x text-orange"></i>
                </label>
              </div>

              <h4 class="mt-3">Size <small>Please select one</small></h4>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                  <span class="text-xl">S</span>
                  <br>
                  Small
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_b2" autocomplete="off">
                  <span class="text-xl">M</span>
                  <br>
                  Medium
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_b3" autocomplete="off">
                  <span class="text-xl">L</span>
                  <br>
                  Large
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_b4" autocomplete="off">
                  <span class="text-xl">XL</span>
                  <br>
                  Xtra-Large
                </label>
              </div> -->

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