<?php

global $loader, $document, $config, $cart;

$document->setTitle($config->get('config_name'));

$loader->model('tool/image');

$data['products'] = array();

foreach ($cart->getProducts() as $product) {
    if (isFile($product['image'])) {
        $image = resize($product['image'], 100, 100);
    } else {
        $image = false;
    }

    $data['products'][] = array(
        'product_id' => $product['product_id'],
        'name'       => $product['name'],
        'quantity'   => $product['quantity'],
        'price'      => $product['price'],
        'thumb'      => $image
    );
}

$data['content_maintop'] = $loader->controller('layout/content_maintop');
$data['content_top'] = $loader->controller('layout/content_top');
$data['column_left'] = $loader->controller('layout/column_left');
$data['column_right'] = $loader->controller('layout/column_right');
$data['content_bottom'] = $loader->controller('layout/content_bottom');
$data['content_mainbottom'] = $loader->controller('layout/content_mainbottom');
$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

echo $loader->view('checkout/shopping_cart', $data);
