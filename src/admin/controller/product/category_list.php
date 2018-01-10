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

$loader->model('product/category');

$data['categories'] = array();

$filter_data = array(
    'start' => ($page - 1) * $config->get('local.config.limit_admin'),
    'limit' => $config->get('local.config.limit_admin')
);

$category_total = getTotalCategory();

$results = getCategories($filter_data);

foreach ($results as $result) {
    $data['categories'][] = array(
        'category_id' => $result['category_id'],
        'name'        => $result['parent_id'] ? ('------ ' . $result['name']) : $result['name'],
        'status'      => $result['status'],
        'edit'        => urlLink('product/category_form', 'category_id=' . $result['category_id'] . $url)
    );
}

$data['add'] = urlLink('product/category_form' . $url);
$data['delete'] = urlLink('product/category_delete' . $url);

$pagination = new Pagination();
$pagination->total = $category_total;
$pagination->page = $page;
$pagination->limit = $config->get('local.config.limit_admin');
$pagination->url = urlLink('product/category_list', '&page={page}');
$data['pagination'] = $pagination->render();

$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

echo $loader->view('product/category_list', $data);