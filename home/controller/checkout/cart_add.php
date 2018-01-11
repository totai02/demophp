<?php

global $loader, $cart;

$json = array();

if (isset($_POST['product_id'])) {
    $product_id = (int)$_POST['product_id'];
} else {
    $product_id = 0;
}

$loader->model('product/product');

$product_info = getProduct($product_id);

if ($product_info) {
    if (isset($_POST['quantity'])) {
        $quantity = (int)$_POST['quantity'];
    } else {
        $quantity = 1;
    }
    
    if (!$json) {
        $cart->add($_POST['product_id'], $_POST['quantity']);

        $json['success'] = sprintf('Thêm sản phẩm vào giỏ hàng thành công', urlLink('product/product', 'product_id=' . $_POST['product_id']), $product_info['name'], urlLink('checkout/cart'));

        // Totals
        $loader->model('extension/extension');

        $total_data = array();
        $total = 0;

        $json['total'] = sprintf('mục', $cart->countProducts(), number_format($total));
    } else {
        $json['redirect'] = str_replace('&amp;', '&', urlLink('product/product', 'product_id=' . $_POST['product_id']));
    }
}

header('Content-Type: application/json');
echo json_encode($json);