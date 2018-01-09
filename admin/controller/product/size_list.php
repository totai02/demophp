<?php

global $loader, $user, $document, $config;

$document->setTitle('Kích thước sản phẩm');
$document->setBreadcrumb('Kích thước sản phẩm');

$url = '';

if (isset($_GET['page'])) {
    $url .= '&page=' . (int)$_GET['page'];
}

if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

$loader->model('product/size');

$data['sizes'] = array();

$filter_data = array(
    'start' => ($page - 1) * $config->get('local.config.limit_admin'),
    'limit' => $config->get('local.config.limit_admin')
);

$size_total = getTotalSize();

$results = getSizes($filter_data);

foreach ($results as $result) {
    $data['sizes'][] = array(
        'size_id' => $result['size_id'],
        'name'    => $result['name'],
        'edit'    => urlLink('product/size_form', 'size_id=' . $result['size_id'] . $url)
    );
}

$data['add'] = urlLink('product/size_form' . $url);
$data['delete'] = urlLink('product/size_delete' . $url);

$pagination = new Pagination();
$pagination->total = $size_total;
$pagination->page = $page;
$pagination->limit = $config->get('local.config.limit_admin');
$pagination->url = urlLink('product/size_list', '&page={page}');
$data['pagination'] = $pagination->render();

$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

echo $loader->view('product/size_list', $data);