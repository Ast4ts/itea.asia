<?php /* Template Name: Delete all day dates */

$args = [
    'post_type' => 'post',
    'posts_per_page' => -1,
    'tax_query' => [
        [
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => '23',
        ],
    ],
];

$_posts = get_posts($args);

foreach ($_posts as $_post) {
    delete_post_meta($_post->ID, 'date1');
    delete_post_meta($_post->ID, 'date2');
    delete_post_meta($_post->ID, 'date3');
    delete_post_meta($_post->ID, 'date4');
    delete_post_meta($_post->ID, 'date5');
    delete_post_meta($_post->ID, 'date6');

    delete_post_meta($_post->ID, 'date1-uuid');
    delete_post_meta($_post->ID, 'date2-uuid');
    delete_post_meta($_post->ID, 'date3-uuid');
    delete_post_meta($_post->ID, 'date4-uuid');
    delete_post_meta($_post->ID, 'date5-uuid');
    delete_post_meta($_post->ID, 'date6-uuid');

    delete_post_meta($_post->ID, 'date1-bg-color');
    delete_post_meta($_post->ID, 'date2-bg-color');
    delete_post_meta($_post->ID, 'date3-bg-color');
    delete_post_meta($_post->ID, 'date4-bg-color');
    delete_post_meta($_post->ID, 'date5-bg-color');
    delete_post_meta($_post->ID, 'date6-bg-color');

    echo '+';
}

echo "\n DONE";
