<?php

global $loader, $document, $config;

$data['breadcrumbs'] = array();

$data['breadcrumbs'][] = array(
    'text' => 'Trang chủ',
    'href' => urlLink('common/home')
);

$loader->model('product/category');
$loader->model('product/product');
$loader->model('tool/image');
var_dump($_SESSION);
if (isset($_GET['path'])) {
    $path = '';

    $parts = explode('_', (string)$_GET['path']);

    $category_id = (int)array_pop($parts);

    foreach ($parts as $path_id) {
        if (!$path) {
            $path = $path_id;
        } else {
            $path .= '_' . $path_id;
        }

        $category_info = getCategory($path_id);

        if ($category_info) {
            $data['breadcrumbs'][] = array(
                'text' => $category_info['name'],
                'href' => urlLink('product/category', 'path=' . $path)
            );
        }
    }

    // Set the last category breadcrumb
    $category_info = getCategory($category_id);

    if ($category_info) {
        $url = '';

        if (isset($_GET['sort'])) {
            $url .= '&sort=' . $_GET['sort'];
        }

        if (isset($_GET['order'])) {
            $url .= '&order=' . $_GET['order'];
        }

        if (isset($_GET['page'])) {
            $url .= '&page=' . $_GET['page'];
        }

        if (isset($_GET['limit'])) {
            $url .= '&limit=' . $_GET['limit'];
        }

        $data['breadcrumbs'][] = array(
            'text' => $category_info['name'],
            'href' => urlLink('product/category', 'path=' . $_GET['path'] . $url)
        );
    }
}

if (isset($_GET['search']) || isset($_GET['tag'])) {
    $url = '';

    if (isset($_GET['search'])) {
        $url .= '&search=' . $_GET['search'];
    }

    if (isset($_GET['tag'])) {
        $url .= '&tag=' . $_GET['tag'];
    }

    if (isset($_GET['description'])) {
        $url .= '&description=' . $_GET['description'];
    }

    if (isset($_GET['category_id'])) {
        $url .= '&category_id=' . $_GET['category_id'];
    }

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_search'),
        'href' => urlLink('product/search', $url)
    );
}

if (isset($_GET['product_id'])) {
    $product_id = (int)$_GET['product_id'];
} else {
    $product_id = 0;
}

$product_info = getProduct($product_id);

if ($product_info) {
    $url = '';

    if (isset($_GET['path'])) {
        $url .= '&path=' . $_GET['path'];
    }

    if (isset($_GET['search'])) {
        $url .= '&search=' . $_GET['search'];
    }

    if (isset($_GET['tag'])) {
        $url .= '&tag=' . $_GET['tag'];
    }

    if (isset($_GET['description'])) {
        $url .= '&description=' . $_GET['description'];
    }

    if (isset($_GET['category_id'])) {
        $url .= '&category_id=' . $_GET['category_id'];
    }

    $data['breadcrumbs'][] = array(
        'text' => $product_info['name'],
        'href' => urlLink('product/product', $url . '&product_id=' . $_GET['product_id'])
    );

    $document->setTitle($product_info['name']);

    $data['heading_title'] = $product_info['name'];

    $data['product_id'] = (int)$_GET['product_id'];

    if ($product_info['image']) {
        $data['popup'] = resize($product_info['image'], 500, 500);
    } else {
        $data['popup'] = '';
    }

    if ($product_info['image']) {
        $data['thumb'] = resize($product_info['image'], 228, 228);
    } else {
        $data['thumb'] = '';
    }

    $data['images'] = array();

    $results = getProductImages($_GET['product_id']);

    foreach ($results as $result) {
        $data['images'][] = array(
            'popup' => resize($result['image'], 500, 500),
            'thumb' => resize($result['image'], 75, 75)
        );
    }

    $data['price'] = number_format($product_info['price']);

    $data['sale'] = number_format($product_info['sale']);

    $data['minimum'] = 1;
    $data['description'] = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');
    $data['attributes'] = getProductAttributes($_GET['product_id']);
    $data['colors'] = getProductColors($_GET['product_id']);

    $data['tags'] = array();

    if ($product_info['tag']) {
        $tags = explode(',', $product_info['tag']);

        foreach ($tags as $tag) {
            $data['tags'][] = array(
                'tag'  => trim($tag),
                'href' => urlLink('product/search', 'tag=' . trim($tag))
            );
        }
    }

    updateViewed($_GET['product_id']);

    $data['content_maintop'] = $loader->controller('layout/content_maintop');
    $data['content_top'] = $loader->controller('layout/content_top');
    $data['column_left'] = $loader->controller('layout/column_left');
    $data['column_right'] = $loader->controller('layout/column_right');
    $data['content_bottom'] = $loader->controller('layout/content_bottom');
    $data['content_mainbottom'] = $loader->controller('layout/content_mainbottom');
    $data['header'] = $loader->controller('layout/header');
    $data['footer'] = $loader->controller('layout/footer');

    echo $loader->view('product/product', $data);
} else {
    exit('Không tìm thấy sản phẩm');
}