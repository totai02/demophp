<?php

global $loader, $user, $document, $config;

$document->setTitle('Màu sản phẩm');
$document->setBreadcrumb('Màu sản phẩm');

$url = '';

if (isset($_GET['page'])) {
    $url .= '&page=' . (int)$_GET['page'];
}

if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

$loader->model('product/color');

$data['colors'] = array();

$filter_data = array(
    'start' => ($page - 1) * $config->get('local.config.limit_admin'),
    'limit' => $config->get('local.config.limit_admin')
);

$color_total = getTotalColor();

$results = getColors($filter_data);

foreach ($results as $result) {
    $data['colors'][] = array(
        'color_id' => $result['color_id'],
        'name'    => $result['name'],
        'edit'    => urlLink('product/color_form', 'color_id=' . $result['color_id'] . $url)
    );
}

$data['add'] = urlLink('product/color_form' . $url);
$data['delete'] = urlLink('product/color_delete' . $url);

$pagination = new Pagination();
$pagination->total = $color_total;
$pagination->page = $page;
$pagination->limit = $config->get('local.config.limit_admin');
$pagination->url = urlLink('product/color_list', '&page={page}');
$data['pagination'] = $pagination->render();

$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

echo $loader->view('product/color_list', $data);