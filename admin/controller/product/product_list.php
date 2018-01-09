<?php

global $loader, $user, $document, $config;

$document->setTitle('Danh mục sản phẩm');
$document->setBreadcrumb('Danh mục sản phẩm');

$url = '';

if (isset($_GET['page'])) {
    $url .= '&page=' . (int)$_GET['page'];
}

if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

$loader->model('product/product');

$data['products'] = array();

$filter_data = array(
    'start' => ($page - 1) * $config->get('local.config.limit_admin'),
    'limit' => $config->get('local.config.limit_admin')
);

$product_total = getTotalProduct();

$results = getProducts($filter_data);

foreach ($results as $result) {
    $data['products'][] = array(
        'product_id' => $result['product_id'],
        'name'       => $result['name'],
        'status'     => $result['status'],
        'edit'       => urlLink('product/product_form', 'product_id=' . $result['product_id'] . $url)
    );
}

$data['add'] = urlLink('product/product_form' . $url);
$data['delete'] = urlLink('product/product_delete' . $url);

$pagination = new Pagination();
$pagination->total = $product_total;
$pagination->page = $page;
$pagination->limit = $config->get('local.config.limit_admin');
$pagination->url = urlLink('product/product_list', '&page={page}');
$data['pagination'] = $pagination->render();

$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

echo $loader->view('product/product_list', $data);