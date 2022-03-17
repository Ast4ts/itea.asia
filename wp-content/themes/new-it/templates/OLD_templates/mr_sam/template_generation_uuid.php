<?php /* Template Name: Генерация UUID для всех курсов */

$num_added_uuid = 0;

$categories = get_categories('child_of=22');
foreach ($categories as $category) {

    $term_meta_uuid = get_term_meta($category->term_id, 'uuid_for_itea_crm', true);
    if (empty($term_meta_uuid)) {
        $num_added_uuid++;
        delete_term_meta($category->term_id, 'uuid_for_itea_crm');
        update_term_meta($category->term_id, 'uuid_for_itea_crm', GenerationUUIDHelper::uuid('ROAD'));
    }

    $courses = get_posts(array('category' => $category->term_id, 'numberposts' => -1));
    foreach($courses as $course) {
        $post_meta_uuid = get_post_meta($course->ID, 'uuid_for_itea_crm', true);
        if (empty($post_meta_uuid)) {
            $num_added_uuid++;
            delete_post_meta($course->ID, 'uuid_for_itea_crm');
            update_post_meta($course->ID, 'uuid_for_itea_crm', GenerationUUIDHelper::uuid('CURS'));
        }
    }
}



$categories = get_categories('parent=23');
foreach ($categories as $category) {
    $term_meta_uuid = get_term_meta($category->term_id, 'uuid_for_itea_crm', true);
    if (empty($term_meta_uuid)) {
        $num_added_uuid++;
        delete_term_meta($category->term_id, 'uuid_for_itea_crm');
        update_term_meta($category->term_id, 'uuid_for_itea_crm', GenerationUUIDHelper::uuid('ROAD'));
    }

    $cat_2_level = get_categories("parent=$category->term_id");

    if (empty($cat_2_level)) {
        $posts = get_posts(array('category' => $category->term_id, 'numberposts' => -1));
        foreach ($posts as $post) {
            $post_meta_uuid = get_post_meta($post->ID, 'uuid_for_itea_crm', true);
            if (empty($post_meta_uuid)) {
                $num_added_uuid++;
                delete_post_meta($post->ID, 'uuid_for_itea_crm');
                update_post_meta($post->ID, 'uuid_for_itea_crm', GenerationUUIDHelper::uuid('CURS'));
            }
        }
    } else {
        foreach ($cat_2_level as $cat) {
            $term_meta_uuid = get_term_meta($cat->term_id, 'uuid_for_itea_crm', true);
            if (empty($term_meta_uuid)) {
                $num_added_uuid++;
                delete_term_meta($cat->term_id, 'uuid_for_itea_crm');
                update_term_meta($cat->term_id, 'uuid_for_itea_crm', GenerationUUIDHelper::uuid('ROAD'));
            }

            $posts = get_posts(array('category' => $cat->term_id, 'numberposts' => -1));
            foreach ($posts as $post) {
                $post_meta_uuid = get_post_meta($post->ID, 'uuid_for_itea_crm', true);
                if (empty($post_meta_uuid)) {
                    $num_added_uuid++;
                    delete_post_meta($post->ID, 'uuid_for_itea_crm');
                    update_post_meta($post->ID, 'uuid_for_itea_crm', GenerationUUIDHelper::uuid('CURS'));
                }
            }
        }
    }
}

echo '<pre>'; var_dump($num_added_uuid);
