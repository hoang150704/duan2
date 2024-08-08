<?php
function homeController(){

    $view = 'home';
    $style = 'style/home';
    $script = 'home';
    $listAllCategories = listAll('category');
    $listProduct = [];
    foreach ($listAllCategories as $category){
        $listProduct[$category['id']] = listProductByCategoryLimit($category['id'],8); 
    }
    $newProduct = listProductLimit(9);
    require_once PATH_VIEW.'layouts/master.php';
}
// 
function err(){
    require_once __DIR__ . '/../404err.php';
}

?>