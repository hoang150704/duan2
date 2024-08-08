<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Dashbord'  ?> - Admin</title>
    
    <?php if(isset($style)&&$style){
       require_once PATH_VIEW_ADMIN . 'styles/'.$style .'.php';

    } ?>
    <style>
        img.img-circle{
            width: 70px;
            height: 70px;
            object-fit: cover;
        }
    </style>
    
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <?php require_once PATH_VIEW_ADMIN. 'layouts/partials/preloader.php'; ?>

        <!-- Navbar -->
        <?php require_once PATH_VIEW_ADMIN. 'layouts/partials/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php require_once PATH_VIEW_ADMIN. 'layouts/partials/silebar.php'; ?>
        <!-- Content Wrapper. Contains page content -->
        <?php require_once PATH_VIEW_ADMIN. $view . '.php'; ?>
        <!-- /.content-wrapper-footer -->
        <?php require_once PATH_VIEW_ADMIN. 'layouts/partials/footer.php'; ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

   
    <?php
    if(isset($script)&&$script){
       require_once PATH_VIEW_ADMIN . 'script/'.$script .'.php';

    }
    if(isset($script2)&&$script2){
        require_once PATH_VIEW_ADMIN . 'script/'.$script2 .'.php';
 
     }
    ?>
    
</body>

</html>