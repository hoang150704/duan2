<?php
// List comment
function commentListAll()
{
    $title = 'Danh sách đánh giá';
    $view = 'comments/list';
    $script = 'listUser';
    $style = 'table';
    $replyFilter = 1;
    $statusFilter = 1;

    // Kiểm tra nếu người dùng đã submit form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['reply'])) {
            $replyFilter = (int)$_POST['reply'];
        }
        if (isset($_POST['status'])) {
            $statusFilter = (int)$_POST['status'];
        }
    }

    // Gọi model với giá trị lọc
    $comments = listAllForComment($replyFilter, $statusFilter);

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};
// chi tiết comment
function commentShowOne($id)
{
    $title = 'Chi tiết';
    $view = 'comments/detail';
    $script = 'listUser';
    $style = 'table';
    $comment = showOneForComment($id);

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};
// Trả lời bình luận
function commentReply($id)
{
    $title = 'Cập nhật thông tin ';
    $view = 'comments/update';
    $script = 'create';
    $style = 'create';
    $comment = showOne('comment',$id);
    if (!empty($_POST)) {
        $data = [
            "reply" => $_POST['reply'] ?? $comment['reply'],
        ];
        update('comment',$id,$data);
        $_SESSION['success'] = "Thành công";
        header('Location:' . BASE_URL_ADMIN . '?act=comment-reply&id=' . $id);
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
};
// Xóa bình luận
function commentDelete($id)
{
    delete_hidden('comment', $id);
    $_SESSION['delete'] = 'Bạn đã xóa thành công';
    header('Location:' . BASE_URL_ADMIN . '?act=comments');
    exit();
};
