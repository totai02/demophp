<?php

global $loader, $user, $document, $config;

$url = '';

if (isset($_GET['page'])) {
    $url .= '&page=' . (int)$_GET['page'];
}

$error = array();

$loader->model('product/size');

if (isMethod('post')) {
    $error = _validateDelete();

    if (!$error) {
        foreach ($_POST['selected'] as $size_id) {
            deleteCategory($size_id);
        }

        $document->setFlash('Bạn đã cập nhật thành công !');

        redirect('product/size_list' . $url);
    } else {
        $document->setFlash($error['warning'], 'error');
        redirect('product/size_list' . $url);
    }
} else {
    $document->setFlash('not post', 'error');
    redirect('product/size_list' . $url);
}

function _validateDelete()
{
    global $user;

    $error = [];

    if (!$user->hasPermission('modify', 'product/size_form')) {
        $error['warning'] = 'Bạn không có quyền chỉnh sửa trang này';
    }

    if(empty($_POST['selected'])){
        $error['warning'] = 'Chưa chọn để xóa !';
    }

    return $error;
}