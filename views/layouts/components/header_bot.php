<?php
$listAllCategories = listAll('category');

?>
<div class="header_bottom sticky-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="main_menu_inner">
                            <div class="main_menu"> 
                                <nav>  
                                    <ul>
                                        <li class="active"><a href="<?= BASE_URL ?>">Trang chủ </a></li>
                                        <li><a href="#">Sản phẩm <i class="fa fa-angle-down"></i></a>
                                            <ul class="sub_menu pages">
                                                <?php foreach($listAllCategories as $category): ?>
                                                <li><a href="<?= BASE_URL .'?act=product-list&id='.$category['id']?>"><?=$category['category_name'] ?></a></li>
                                                <?php endforeach ?>
                                            </ul>
                                        </li>
                                        <!-- <li><a href="about.html">Tra cứu đơn hàng</a></li> -->
                                        <li><a href="contact.html">Liên hệ</a></li>
                                    </ul>   
                                </nav> 
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>