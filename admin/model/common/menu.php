<?php

$menu = [];

function getMenu()
{
    $menu['dashboard'] = [
        'id'         => 'dashboard',
        'text'       => 'Dashboard',
        'icon'       => 'fa-dashboard',
        'href'       => urlLink('common/dashboard'),
        'sort_order' => 1
    ];

    // Customer
    $menu['product'] = [
        'id'         => 'product',
        'text'       => 'Sản phẩm',
        'icon'       => 'fa-user',
        'href'       => '#',
        'class'      => 'parent',
        'sort_order' => 2
    ];
    $menu['product']['children'] = [
        'category'  => array(
            'text'       => 'Danh mục',
            'href'       => urlLink('product/category_list'),
            'sort_order' => 1,
        ),
        'product'   => array(
            'text'       => 'Sản phẩm',
            'href'       => urlLink('product/product_list'),
            'sort_order' => 2,
        ),
        'color'     => array(
            'text'       => 'Màu',
            'href'       => urlLink('product/color_list'),
            'sort_order' => 3,
        ),
        'attribute' => array(
            'text'       => 'Thuộc tính',
            'href'       => urlLink('product/attribute_list'),
            'sort_order' => 4,
        )
    ];

    $menu['module'] = [
        'id'         => 'module',
        'text'       => 'Mô-đun',
        'icon'       => 'fa-bar-chart',
        'href'       => urlLink('extension/module'),
        'class'      => 'parent',
        'sort_order' => 4
    ];

    // Setting
    $menu['setting'] = [
        'id'         => 'setting',
        'text'       => 'Thiết lập',
        'icon'       => 'fa-cog',
        'href'       => '#',
        'class'      => 'parent',
        'sort_order' => 4
    ];
    $menu['setting']['children'] = [
        'settings' => array(
            'text'       => 'Cấu hình',
            'href'       => urlLink('setting/setting'),
            'sort_order' => 1,
        ),
        'users'    => array(
            'text'       => 'User',
            'href'       => '#',
            'sort_order' => 2,
            'children'   => array(
                'users'       => array(
                    'text' => 'User',
                    'href' => urlLink('user/user_list'),
                ),
                'user_groups' => array(
                    'text' => 'Nhóm user',
                    'href' => urlLink('user/user_group_list'),
                ),
            )
        ),
    ];

    /*// Tool
    $menu['tool'] = [
        'id'         => 'tool',
        'text'       => trans('common/menu.text_tool'),
        'icon'       => 'fa-wrench',
        'href'       => '#',
        'class'      => 'parent',
        'sort_order' => 2
    ];
    $menu['tool']['children'] = [
        'random_name'          => array(
            'text'       => trans('common/menu.text_random_name'),
            'href'       => urlLink('tool/random_name'),
            'sort_order' => 1,
        ),
        'random_brand_name'    => array(
            'text'       => trans('common/menu.text_random_brand_name'),
            'href'       => urlLink('tool/random_brand_name'),
            'sort_order' => 2,
        ),
        'random_brand_service' => array(
            'text'       => trans('common/menu.text_random_brand_service'),
            'href'       => urlLink('tool/random_brand_service'),
            'sort_order' => 3,
        ),
        'cache_manager'        => array(
            'text'       => trans('common/menu.text_cache_manager'),
            'href'       => urlLink('tool/cache_manager'),
            'sort_order' => 4,
        ),
        'get_fb_cookie'        => array(
            'text'       => trans('common/menu.text_get_fb_cookie'),
            'href'       => urlLink('tool/get_fb_cookie'),
            'sort_order' => 5,
        ),
    ];

    // Blog
    $menu['blog'] = [
        'id'         => 'blog',
        'text'       => trans('common/menu.text_blog'),
        'icon'       => 'fa-pencil',
        'href'       => '#',
        'class'      => 'parent',
        'sort_order' => 3
    ];
    $menu['blog']['children'] = [
        'category' => array(
            'text'       => trans('common/menu.text_category'),
            'href'       => urlLink('blog/category'),
            'sort_order' => 1,
        ),
        'blog'     => array(
            'text'       => trans('common/menu.text_blog'),
            'href'       => urlLink('blog/blog'),
            'sort_order' => 2,
        )
    ];

    // Report
    $menu['report'] = [
        'id'         => 'report',
        'text'       => trans('common/menu.text_report'),
        'icon'       => 'fa-flag',
        'href'       => '#',
        'class'      => 'parent',
        'sort_order' => 3
    ];
    $menu['report']['children'] = [
        'api' => array(
            'text'       => trans('common/menu.text_report_api'),
            'href'       => urlLink('report/api'),
            'sort_order' => 1,
        ),
    ];*/

    return $menu;
}