<?php
$lang = (get_locale() == 'ru_RU');

get_header();
?>

<section class="broadcrumbs">
    <nav class="container">
        <?php
        if (function_exists('dimox_breadcrumbs')) {
            dimox_breadcrumbs();
        }
        global $post;
        $parentcat = $cat;
        ?>
    </nav>
</section>

<div class="container" id="flip-scroll">
    <div class="head-section">
        <h1><?php single_cat_title(); ?></h1>
    </div>

    <div id="mainSlider">
        <?php $news = get_posts(array('category' => ($lang ? 27 : 753) , 'numberposts' => 12, 'order' => 'desc', 'orderby' => 'id')); ?>
        <div class="wrapper-main-slider">
            <div id="main-slider" class="swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach ($news as $news_item){ ?>
                        <?php
                        $id = $news_item->ID;
                        $thumb_id  = get_post_thumbnail_id($id);
                        $thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
                        ?>
                        <div class="swiper-slide">
                            <img src="<?php echo $thumb_url[0]; ?>">
                            <?php
                            $t = wp_get_post_tags($id);
                            if($t) {
                                echo '<div class="category-name">';
                                foreach ($t as $tn) {
                                    echo $tn->name, '<br>';
                                }
                                echo '</div>';
                            }
                            ?>
                            <div class="link">
                                <a class="link" href="<?php echo get_the_permalink($id) ?>">
                                    <h3><?php echo get_the_title($id); ?></h3>
                                </a>
                                <p class="link">
                                    <?php
                                    $tim = get_post_meta($id, 'Время', true);
                                    if ($tim) {
                                        echo '<span class="time">', $tim, '</span>';
                                    }
                                    $loc = get_post_meta($id, 'Локация', true);
                                    if($loc) {
                                        echo '<span class="locate">', $loc, '</span>';
                                    }
                                    ?>
                                </p>
                                <a href="<?php echo (get_post_meta($id, 'Ссылка', true) == '' ? get_the_permalink($id) : get_post_meta($id, 'Ссылка', true)); ?>" class="a-det"><?php echo ($lang ? 'Подробнее' : 'Детальніше'); ?></a>
                            </div>
                            <div class="shodToSlider"></div>
                        </div>
                    <?php } ?>
                </div>
                <div class="additional-clickers"></div>
            </div>
            <div id="tizers-news">
                <h2><?php echo ($lang ? 'Новости и события' : 'Новини та події'); ?></h2>
                <div id="slider-tizer-news" class="swiper-container">
                    <ul class="swiper-wrapper additional-span-info">
                        <?php
                        $ff = true;
                        foreach ($news as $news_item){
                            $id = $news_item->ID;
                            $tim = get_post_meta($id, 'Время', true);
                            ?>
                            <li class="swiper-slide <?php if ($ff==true) { $ff = false; echo "active-nav"; }?>">
                                <div class="date">
                                    <p class="dateZone"><?php echo $tim; ?></p>
                                </div>
                                <span class="title"><?php echo get_the_title($id); ?></span>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="swiper-scrollbar"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="block-news clearfix" >
        <?php
        $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
        query_posts('paged='.$page.'&cat='.($lang ? 25 : 310).'&orderby=date&order=DESC');

        if (have_posts()) {
            echo($eve ? '<div id="course" class="eVe">' : '');
            while (have_posts()) {
                the_post();
                echo '<div class="articleNew">';

                $long = get_post_meta($post->ID, 'long', true);
                $cost = get_post_meta($post->ID, 'cost', true);
                $location = get_post_meta($post->ID, 'location', true);
                $subject = get_post_meta($post->ID, 'Специаьность', true);
                $date_news = get_the_date('j.n.Y');
                ?>

                <div class="post_title">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php
                    $tags = wp_get_post_tags($post->ID);
                    if ($tags[0]->name) {
                        echo '<span class="redLabel">' . $tags[0]->name . '</span>';
                    }

                    if ($date_news) {
                        echo '<p>', ($lang ? 'Дата публикации ' : 'Дата публікації '), $date_news, '</p>';
                    }
                    ?>
                </div>

                <div class="post-excerpt">
                    <?php if (has_post_thumbnail()) { ?>
                        <a href="<?php the_permalink(); ?>" class="newsImg"><?php the_post_thumbnail('thumbnail', array("style" => "float:left; margin: 0 15px 15px 0;")); ?></a>
                    <?php
                    }
                    if (!$eve) the_excerpt();
                    ?>
                </div>

                <div><a href="<?php the_permalink(); ?>" class="btn btn-sm btn-green btn-det"><?php echo ($lang ? 'ПОДРОБНЕЕ' : 'ДЕТАЛЬНІШЕ'); ?></a></div>

                <?php if ($subject) { ?>
                    <div>
                        <ul>
                            <li><?php echo $subject; ?></li>
                        </ul>
                    </div>
                    <?php
                }

                echo '</div>';
            }
            wp_corenavi();
            echo '</div>';
        }
        ?>

    </div>
</div>

<?php get_footer(); ?>