<?php
function dashboard(){
    $title = 'Dashboard';
    $view = 'dashboard';
    $script = 'dashboard';
    $style = 'dashboard';
    $order = count(listAllOrderProcessing('order_shop'));
    $user = count(listAllAccountUser());
    $date = date('Y-m-d');
    $list_total_money_day = listAllOrderTotalMoneyOnDAY($date);
    $total_money_day = 0;
    foreach($list_total_money_day as $total){
        $total_money_day = $total_money_day + $total['total_money'];
    }
    $allOrder = getCountOrder();
    $allCancel = getCountCancel();
    $percentCancel =$allCancel['order_count'] / $allOrder['order_count'] *100;
    $dailyRevenues = getDailyRevenue();
    
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}