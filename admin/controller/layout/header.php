<?php

global $loader, $config, $user, $document;

$data['heading_title'] = $document->getTitle();

$data['username'] = $user->getUsername();
$data['breadcrumbs'] = $document->getBreadcrumb();

$flash_info = $document->getFlash();

if ($flash_info) {
    $data['flash'] = $flash_info;

    $document->destroyFlash();
}

$loader->model('common/menu');

$menu = getMenu();

foreach ($menu as $id => $item) {
    if (isset($item['children'])) {
        foreach ($item['children'] as $sub_id => $sub_item) {
            if (isset($sub_item['children'])) {
                usort($menu[$id]['children'][$sub_id]['children'], '_compareMenuItems');
            }
        }
        usort($menu[$id]['children'], '_compareMenuItems');
    }
}

usort($menu, '_compareMenuItems');

$data['menu_items'] = $menu;

function _compareMenuItems($item1, $item2)
{
    if (!isset($item1['sort_order'])) {
        return 1;
    }

    if (!isset($item2['sort_order'])) {
        return -1;
    }

    return ($item1['sort_order'] < $item2['sort_order']) ? -1 : 1;
}

echo $loader->view('layout/header', $data);