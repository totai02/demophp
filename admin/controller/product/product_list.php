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

$data['filters'] = $config->get('local.config.filters');

$loader->model('product/product');

$data['products'] = array();

$filter_data = array(
    'start' => ($page - 1) * $config->get('local.config.limit_admin'),
    'limit' => $config->get('local.config.limit_admin')
);

if (isset($_GET['key'])) {

    if (isset($_GET['search'])){
        foreach (explode(",", $_GET['search']) as $value){
            $filter_data['search'][$value] = true;
        }
    }

    $filter_data['key'] = $_GET['key'];

    $product_total = getTotalProduct($filter_data);

    $results = getProducts($filter_data);

    $data['search_key'] = $_GET['key'];
} else {
    $product_total = getTotalProduct();

    $results = getProducts($filter_data);
}


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
$data['pre_search'] = urlLink('product/product_list' . $url);

$pagination = new Pagination();
$pagination->total = $product_total;
$pagination->page = $page;
$pagination->limit = $config->get('local.config.limit_admin');
$query_url = "";
if (isset($_GET['search'])){
    $query_url .= "&search=" . $_GET['search'];
}
if (isset($_GET['key'])){
    $query_url .= "&key=" . $_GET['key'];
}
$pagination->url = urlLink('product/product_list',$query_url . '&page={page}');
$data['pagination'] = $pagination->render();

$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

echo $loader->view('product/product_list', $data);