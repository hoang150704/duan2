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
                            <a class="btn btn-primary btn-sm" href="<?= BASE_URL_ADMIN . '?act=attribute' ?>">
                                <h3 class="card-title">Back to list</h3>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <?php if (isset($_SESSION['success'])) : ?>
                <div class="d-flex align-items-center alert alert-success">
                
                  <i class="fas fa-check-circle"></i>
                  <p class="p-2 m-0"><?=$_SESSION['success'] ?></p>
                  
                </div>

                <?php unset($_SESSION['success']) ?>
                <?php endif ?>
                <!--  -->
                <?php if (isset($_SESSION['delete'])) : ?>
                <div class="d-flex align-items-center alert alert-success">
                
                  <i class="fas fa-check-circle"></i>
                  <p class="p-2 m-0"><?=$_SESSION['delete'] ?></p>
                  
                </div>

                <?php unset($_SESSION['delete']) ?>
                <?php endif ?>
                            <table id="example2" class="table table-bordered table-hover">
                                <tr>
                                    <td>
                                        <b> <span>Trường dữ liệu</span></b>
                                    </td>
                                    <td>
                                        <b> <span>Dữ liệu</span></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>ID</p>
                                    </td>
                                    <td>
                                        <p><?= $attribute['id'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Tên thuộc tính</p>
                                    </td>
                                    <td>
                                        <p><?= $attribute['attribute_name'] ?></p>
                                    </td>
                                </tr>
                            </table>

                        </div>

                        <div class="card-header">
                            <p class="alert alert-success">Giá trị thuộc tính</p>
                            <a class="btn btn-primary btn-sm" href="<?= BASE_URL_ADMIN . '?act=attributeValue-create&id=' . $attribute['id'] ?>">
                                <h3 class="card-title">Thêm giá trị thuộc tính</h3>
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Tên giá trị thuộc tính</th>
                                       
                                        <th>Hành động</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php foreach ($attributeValues as $attributeValue) : ?>
                                        <tr>
                                            <td><?= $attributeValue['id'] ?></td>
                                            <td><?= $attributeValue['attribute_value_name'] ?></td>
                                            
                                            <td>
                                                <a class="btn btn-warning btn-sm" href="<?= BASE_URL_ADMIN . '?act=attributeValue-update&idat='.$attribute['id'] .'&id=' . $attributeValue['id']  ?>">Sửa</a>
                                                <a class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn xóa không!!!!') " href="<?= BASE_URL_ADMIN . '?act=attributeValue-delete&idat='.$attribute['id'] .'&id=' . $attributeValue['id'] ?>">Xóa</a>
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