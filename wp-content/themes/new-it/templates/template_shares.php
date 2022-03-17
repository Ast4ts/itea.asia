<?php /* Template Name: Страница "Акции" */

$lang = (get_locale() == 'ru_RU');

get_header();
?>

<section class="broadcrumbs">
    <nav class="container">
        <?php
        if (function_exists('dimox_breadcrumbs')) {
                dimox_breadcrumbs();
        }
        ?>
    </nav>
</section>

<div class="container">
    <div class="head-section">
        <h1><?php the_title(); ?></h1>
    </div>

    <div class="block-news clearfix">
         
        <?php
	    //query_posts(array('posts_per_page' => -1, 'meta_key' => 'discont', 'meta_value' => '0', 'meta_compare' => '!='));
        query_posts(array('posts_per_page' => -1, 'cat' => ($lang ? 22 : 219) ));
        if (have_posts()) {
            echo '<div class="eVe" id="course">';

            while (have_posts()) { the_post();
                $cours_id = get_the_ID();

                $di = (int) get_post_meta(pll_get_post($cours_id, 'ru'), 'discont', true);
                if($di <= 0){ continue; }

                $pr = (int) get_post_meta(pll_get_post($cours_id, 'ru'), 'cost', true);
                $ti = get_post_meta(pll_get_post($cours_id, 'ru'), 'long', true);
                echo '<div class="grid_3 item val_cours">';
                    echo '<div class="img">';
                        if ($di > 0) {
                            echo '<div class="val_course-discount"><span>-', $di, '%</span></div>';
                        }
                        echo get_the_post_thumbnail($cours_id);
                        echo '<a href="', get_the_permalink($cours_id), '" class="view" title=', ($lang ? '"Перейти к курсу">Просмотреть' : '"Перейти до курсу"> Переглянути'), '</a>';
                    echo '</div>';
                    echo '<h3>', get_the_title(), '</h3>';

                    if ($di > 0) {
                        echo '<div class="course_price"><span>', $pr, '</span>';
                        $new_pr = nicePrice(ceil($pr * (100 - $di) / 100));
                        echo '<span>', $new_pr, ' тмт.</span></div>';
                    } else {
                        echo '<div class="course_price"><span>', $pr, ' тмт.</span></div>';
                    }

                    if($ti){
                        echo '<p>', ($lang ? 'Длительность курса: ' : 'Тривалість курсу: '), $ti, ($lang ? ' ч.' : ' год.'), '</p>';
                    }
                echo '</div>';
            }
            echo '</div>';
        }
        ?>

    </div>
</div>

<?php get_footer(); ?>