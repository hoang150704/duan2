<?php
function homeController($search){
    if(!empty($search)){
        $view = 'products/listByCategory';
        $style = 'style/home';
        $script = 'home';
        $listProducts = searchProductByName($search);
        require_once PATH_VIEW . 'layouts/master.php';
    }else{
        
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

}
// 
function err(){
    require_once __DIR__ . '/../404err.php';
}

?>