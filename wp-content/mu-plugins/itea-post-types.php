<?php

function target_post_types() {


        register_post_type('FAQ', array(
        'supports' => array('title', 'excerpt'),
        'public' => true,
        'publicly_queryable' => false,
        'labels' => array(
            'name' => 'FAQ',
            'add_new_item' => 'Add New FAQ',
            'edit_item' => 'Edit FAQ',
            'all_items' => 'All FAQs',
            'singular_name' => 'FAQ'
        ),
        'menu_icon' => 'dashicons-list-view'
    ));

    register_post_type('reviews', array(
        'supports' => array('title', 'thumbnail', 'excerpt'),
        'public' => true,
        'publicly_queryable' => false,
        'labels' => array(
            'name' => 'Отзывы Пользователей',
            'add_new_item' => 'Add Review',
            'edit_item' => 'Edit Review',
            'all_items' => 'All Reviews',
            'singular_name' => 'Review'
        ),
        'menu_icon' => 'dashicons-admin-comments'
    ));
//
//    register_post_type('advantages', array(
//        'supports' => array('title', 'thumbnail'),
//        'public' => true,
//        'publicly_queryable' => false,
//        'labels' => array(
//            'name' => 'Advantages (main)',
//            'add_new_item' => 'Add New Advantage',
//            'edit_item' => 'Edit Advantage',
//            'all_items' => 'All Advantages',
//            'singular_name' => 'Advantage'
//        ),
//        'menu_icon' => 'dashicons-list-view'
//    ));
//
//    register_post_type('services', array(
//        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
//        'public' => true,
//        'labels' => array(
//            'name' => 'Services',
//            'add_new_item' => 'Add New Service',
//            'edit_item' => 'Edit Service',
//            'all_items' => 'All Services',
//            'singular_name' => 'Service'
//        ),
//        'menu_icon' => 'dashicons-thumbs-up'
//    ));
//
//    register_post_type('doctor', array(
//        'supports' => array('title', 'editor', 'thumbnail', 'comments', 'excerpt'),
//        'public' => true,
//        'labels' => array(
//            'name' => 'Doctors',
//            'add_new_item' => 'Add New Doctor',
//            'edit_item' => 'Edit Doctor',
//            'all_items' => 'All Doctors',
//            'singular_name' => 'Doctor'
//        ),
//        'menu_icon' => 'dashicons-admin-users'
//    ));
//
//    register_post_type('cancer', array(
//        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
//        'public' => true,
////        'rewrite' => array( 'slug' => 'cancer'),
////        'has_archive' => false,
//        'labels' => array(
//            'name' => 'Cancer Types',
//            'add_new_item' => 'Add Type',
//            'edit_item' => 'Edit Type',
//            'all_items' => 'All Types',
//            'singular_name' => 'Cancer Type'
//        ),
//        'menu_icon' => 'dashicons-admin-settings'
//    ));
//
//    register_post_type('phones', array(
//        'supports' => array('title'),
//        'public' => true,
//        'labels' => array(
//            'name' => 'Phones',
//            'add_new_item' => 'Add New Phone',
//            'edit_item' => 'Edit Phone',
//            'all_items' => 'All Phones',
//            'singular_name' => 'Phone'
//        ),
//        'menu_icon' => 'dashicons-phone'
//    ));

}

add_action('init', 'target_post_types');
