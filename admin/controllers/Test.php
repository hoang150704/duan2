<?php
function testCreate(){
    $script = 'create';
    $script2 = 'tinyMCE';
    $style = 'create';
    $title = 'Thêm sản phẩm';
    $view = 'test/create';
    if (!empty($_POST)) {
        $files = $_FILES['image'];
        echo '<pre>';
        
        print_r($files);
        echo '</pre>';
        $fileNameArr = $files['name'];
        
        if( $files['size'][0] >0){
            for($i = 0; $i < count($fileNameArr); $i++){
                $file=[
                    'name'=>$files['name'][$i],
                    'type' => $files['type'][$i],
                    'tmp_name' => $files['tmp_name'][$i],
                    'error' => $files['error'][$i],
                    'size' => $files['size'][$i]
                ];
                $fileUpdate[]=uploadFlie($file,'uploads/');
          
            }
        }else{
            print_r("Bạn chưa nhập file") ;
        }
        debug($fileUpdate);
    }

    require_once PATH_VIEW_ADMIN . 'test/create.php';
}

