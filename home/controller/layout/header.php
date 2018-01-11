<?php

global $loader, $config, $user, $document;

$loader->model('tool/image');

$data['title'] = $document->getTitle();

$data['breadcrumbs'] = $document->getBreadcrumb();

$flash_info = $document->getFlash();

if ($flash_info) {
    $data['flash'] = $flash_info;

    $document->destroyFlash();
}

$data['home'] = urlLink('common/home');
$data['contact'] = urlLink('information/contact');
$data['shopping_cart'] = urlLink('checkout/shopping_cart');
$data['checkout'] = urlLink('checkout/checkout');

$data['name'] = $config->get('config_name');
$data['phone'] = $config->get('config_phone');

if (isFile($config->get('config_logo'))) {
    $data['logo'] = resize($config->get('config_logo'));
} else {
    $data['logo'] = false;
}

// Menu
$loader->model('product/category');

$data['categories'] = array();

$categories = getCategories(0);

foreach ($categories as $category) {
    $children_data = array();

    $children = getCategories($category['category_id']);

    foreach ($children as $child) {
        $filter_data = array(
            'filter_category_id' => $child['category_id'],
        );

        $children_data[] = array(
            'name' => $child['name'],
            'href' => urlLink('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
        );
    }

    // Level 1
    $data['categories'][] = array(
        'name'     => $category['name'],
        'children' => $children_data,
        'column'   => '1',
        'href'     => urlLink('product/category', 'path=' . $category['category_id'])
    );
}

echo $loader->view('layout/header', $data);