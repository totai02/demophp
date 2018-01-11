<?php

global $loader, $document, $config;

$loader->model('product/category');
$loader->model('product/product');
$loader->model('tool/image');

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$data['breadcrumbs'] = array();

$data['breadcrumbs'][] = array(
    'text' => 'Trang chủ',
    'href' => urlLink('common/home')
);

if (isset($_GET['path'])) {
    $url = '';

    $path = '';

    $parts = explode('_', (string)$_GET['path']);

    $category_id = (int)array_pop($parts);

    foreach ($parts as $path_id) {
        if (!$path) {
            $path = (int)$path_id;
        } else {
            $path .= '_' . (int)$path_id;
        }

        $category_info = getCategory($path_id);

        if ($category_info) {
            $data['breadcrumbs'][] = array(
                'text' => $category_info['name'],
                'href' => urlLink('product/category', 'path=' . $path . $url)
            );
        }
    }
} else {
    $category_id = 0;
}

$category_info = getCategory($category_id);

if ($category_info) {
    $document->setTitle($category_info['name']);

    $data['heading_title'] = $category_info['name'];
    $data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'utf-8');

    $data['categories'] = array();

    $results = getCategories($category_id);

    foreach ($results as $result) {
        $filter_data = array(
            'filter_category_id'  => $result['category_id'],
            'filter_sub_category' => true
        );

        $data['categories'][] = array(
            'name' => $result['name'],
            'href' => urlLink('product/category', 'path=' . $_GET['path'] . '_' . $result['category_id'] . $url)
        );
    }

    $data['products'] = array();

    $filter_data = array(
        'filter_category_id' => $category_id,
        'start'              => ($page - 1) * $config->get('local.config.limit_home'),
        'limit'              => $config->get('local.config.limit_home')
    );

    $product_total = getTotalProducts($filter_data);

    $results = getProducts($filter_data);

    foreach ($results as $result) {
        if ($result['image']) {
            $image = resize($result['image'], 228, 228);
        } else {
            $image = noImage(228, 228);
        }

        $price = number_format($result['price']);

        if ((float)$result['sale']) {
            $sale = number_format($result['sale']);
        } else {
            $sale = false;
        }

        $data['products'][] = array(
            'product_id'  => $result['product_id'],
            'thumb'       => $image,
            'name'        => $result['name'],
            'description' => substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 200) . '..',
            'price'       => $price,
            'sale'        => $sale,
            'href'        => urlLink('product/product', 'path=' . $_GET['path'] . '&product_id=' . $result['product_id'] . $url)
        );
    }

    $pagination = new Pagination();
    $pagination->total = $product_total;
    $pagination->page = $page;
    $pagination->limit = $config->get('local.config.limit_home');
    $pagination->url = urlLink('product/category', 'path=' . $_GET['path'] . $url . '&page={page}');

    $data['pagination'] = $pagination->render();
} else {
    exit('Không tìm thấy danh mục');
}

$data['content_maintop'] = $loader->controller('layout/content_maintop');
$data['content_top'] = $loader->controller('layout/content_top');
$data['column_left'] = $loader->controller('layout/column_left');
$data['column_right'] = $loader->controller('layout/column_right');
$data['content_bottom'] = $loader->controller('layout/content_bottom');
$data['content_mainbottom'] = $loader->controller('layout/content_mainbottom');
$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

echo $loader->view('product/category', $data);
