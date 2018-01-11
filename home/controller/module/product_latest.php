<?php

global $loader, $config;

$setting = $config->get('product_latest_module');

$loader->model('product/product');
$loader->model('tool/image');

$data['heading_title'] = 'Sẳn phẩm khuyến mại';

if((int)$setting['limit']){
    $setting['limit'] = 4;
}

$results = getLatestProducts($setting['limit']);

$data['products'] = array();

foreach ($results as $result) {
    if (isFile($result['image'])) {
        $image = resize($result['image'], $setting['width'], $setting['height']);
    } else {
        $image = noImage($setting['width'], $setting['height']);
    }

    $price = number_format($result['price']);

    if((float)$result['sale']) {
        $special = number_format($result['sale']);
    } else {
        $special = false;
    }

    $data['products'][] = array(
        'product_id'  => $result['product_id'],
        'name'        => $result['name'],
        'description' => substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 200) . '..',
        'thumb'       => $image,
        'price'       => $price,
        'special'     => $special,
        'href'        => urlLink('product/product', 'product_id=' . $result['product_id'])
    );
}

echo $loader->view('module/product_latest', $data);