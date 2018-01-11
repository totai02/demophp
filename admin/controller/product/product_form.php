<?php

global $loader, $user, $document, $config;

$document->setTitle('Nhóm tài khoản');
$document->setBreadcrumb('Nhóm tài khoản');
$document->setBreadcrumb('Thêm tài khoản');

$url = '';

if (isset($_GET['page'])) {
    $url .= '&page=' . (int)$_GET['page'];
}

$loader->model('product/product');
$loader->model('tool/image');

$error = array();

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $product_info = _getProductOrError($_GET['product_id']);

    if (!is_array($product_info)) {
        exit($product_info);
    }

    $data['is_edit'] = true;
    $data['action'] = urlLink('product/product_form', 'product_id=' . $_GET['product_id'] . $url);
} else {
    $product_id = 0;
    $data['is_edit'] = false;
    $data['action'] = urlLink('product/product_form' . $url);
}

$data['cancel'] = urlLink('product/product_list' . $url);

if (isMethod('post')) {
//    var_dump($_POST);
//    die;
    $error = _validateForm();

    if (!$error) {
        if (!empty($product_info)) {
            editProduct($_GET['product_id'], $_POST);
        } else {
            addProduct($_POST);
        }

        $document->setFlash('Bạn đã cập nhật thành công !');

        redirect('product/product_list' . $url);
    }
}

if (isset($error['warning'])) {
    $data['error_warning'] = $error['warning'];
} else {
    $data['error_warning'] = '';
}

if (isset($error['name'])) {
    $data['error_name'] = $error['name'];
} else {
    $data['error_name'] = '';
}

if (isset($_POST['name'])) {
    $data['name'] = $_POST['name'];
} elseif (!empty($product_info)) {
    $data['name'] = $product_info['name'];
} else {
    $data['name'] = '';
}

if (isset($_POST['description'])) {
    $data['description'] = $_POST['description'];
} elseif (!empty($product_info)) {
    $data['description'] = $product_info['description'];
} else {
    $data['description'] = '';
}

if (isset($_POST['tag'])) {
    $data['tag'] = $_POST['tag'];
} elseif (!empty($product_info)) {
    $data['tag'] = $product_info['tag'];
} else {
    $data['tag'] = '';
}

if (isset($_POST['price'])) {
    $data['price'] = $_POST['price'];
} elseif (!empty($product_info)) {
    $data['price'] = $product_info['price'];
} else {
    $data['price'] = '';
}

if (isset($_POST['product_category'])) {
    $data['product_category'] = $_POST['product_category'];
} elseif ($product_id) {
    $data['product_category'] = array();

    foreach (getProductCategories($product_id) as $category) {
        $data['product_category'][] = $category['category_id'];
    }
} else {
    $data['product_category'] = array();
}

// get category
$loader->model('product/category');

$data['categories'] = array();

$results = getCategories();

foreach ($results as $result) {
    $data['categories'][] = array(
        'category_id' => $result['category_id'],
        'name'        => $result['parent_id'] ? ('------ ' . $result['name']) : $result['name'],
    );
}

// get color
$loader->model('product/color');

$data['colors'] = array();

$results = getColors();

foreach ($results as $result) {
    $data['colors'][] = array(
        'color_id' => $result['color_id'],
        'name'     => $result['name'],
    );
}

// get attribute
$loader->model('product/attribute');

if (isset($_POST['product_attribute'])) {
    $product_attributes = $_POST['product_attribute'];
} elseif ($product_id) {
    $product_attributes = getProductAttribute($product_id);
} else {
    $product_attributes = array();
}

$data['product_attributes'] = array();

foreach ($product_attributes as $product_attribute) {
    $data['product_attributes'][] = array(
        'attribute_id' => $product_attribute['attribute_id'],
        'description'  => $product_attribute['description'],
        'sort_order'   => $product_attribute['sort_order'],
    );
}

$data['attributes'] = getAttributes();

// get sale
if (isset($_POST['product_sale'])) {
    $data['product_sales'] = $_POST['product_sale'];
} elseif ($product_id) {
    $product_sales = getProductSale($product_id);

    $data['product_sales'] = array();

    foreach (getProductSale($product_id) as $product_sale) {
        $data['product_sales'][] = array(
            'price'   => $product_sale['price'],
            'from_at' => date('m/d/Y', $product_sale['from_at']),
            'to_at'   => date('m/d/Y', $product_sale['to_at']),
        );
    }
} else {
    $data['product_sales'] = array();
}

if (isset($_POST['image'])) {
    $data['image'] = $_POST['image'];
} elseif (!empty($product_info)) {
    $data['image'] = $product_info['image'];
} else {
    $data['image'] = '';
}

if (isFile($data['image'])) {
    $data['thumb'] = resize($data['image'], 100, 100);
} else {
    $data['thumb'] = noImage();
}


$data['no_image'] = noImage();

// get image
if (isset($_POST['product_image'])) {
    $product_images = $_POST['product_image'];
} elseif ($product_id) {
    $product_images = getProductImage($product_id);
} else {
    $product_images = array();
}

$data['product_images'] = array();

foreach ($product_images as $product_image) {
    if (isFile($product_image['image'])) {
        $thumb = resize($product_image['image'], 100, 100);
    } else {
        $thumb = noImage();
    }

    $data['product_images'][] = array(
        'image' => $product_image['image'],
        'thumb' => $thumb
    );
}

if (isset($_POST['product_color'])) {
    $data['product_color'] = $_POST['product_color'];
} elseif ($product_id) {
    $data['product_color'] = array();

    foreach (getProductColor($product_id) as $color) {
        $data['product_color'][] = $color['color_id'];
    }
} else {
    $data['product_color'] = array();
}

if (isset($_POST['status'])) {
    $data['status'] = $_POST['status'];
} elseif (!empty($product_info)) {
    $data['status'] = $product_info['status'];
} else {
    $data['status'] = '1';
}


$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

function _validateForm()
{
    global $user;

    $error = [];

    if (!$user->hasPermission('modify', 'product/product_form')) {
        $error['warning'] = 'Bạn không có quyền chỉnh sửa trang này';
    }

    if (strlen($_POST['name']) < 2 || strlen($_POST['name']) > 255) {
        $error['name'] = 'Tên phải từ 2 cho đến 255 ký tự';
    }

    return $error;
}

function _getProductOrError($product_id)
{
    $product_info = getProduct($product_id);

    if ($product_info) {
        return $product_info;
    } else {
        global $loader;

        $data['header'] = $loader->controller('layout/header');
        $data['footer'] = $loader->controller('layout/footer');

        return $loader->view('error/not_found', $data);
    }
}

echo $loader->view('product/product_form', $data);