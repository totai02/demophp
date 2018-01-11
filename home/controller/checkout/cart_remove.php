<?php

global $loader, $cart;

$json = array();

// Remove
if (isset($_POST['key'])) {
    $cart->remove($_POST['key']);

    unset($_SESSION['vouchers'][$_POST['key']]);

    $_SESSION['success'] = 'Xóa thành công';

    $total_data = array();
    $total = 0;

    $json['total'] = sprintf('mục', $cart->countProducts(), number_format($total));
}

header('Content-Type: application/json');
echo json_encode($json);