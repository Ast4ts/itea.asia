<?php
$lang = (get_locale() == 'ru_RU');

get_header();
?>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/relize/css/style1.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/teacher_evening_v3.css">

<section class="broadcrumbs">
    <nav class="container">
        <?php
        if (function_exists('dimox_breadcrumbs')) {
            	dimox_breadcrumbs();
        }
        ?>
    </nav>
</section>

<div class="container" id="flip-scroll">
    <div class="head-section">
		<h1><?php single_cat_title(); ?></h1>
    </div>

    <div class="block-news clearfix" style = "width: calc(100% - 220px); clear:none; float:left;">

<!--        <button id="menu-toggle" class="menu-toggle"><span>Menu</span></button>-->
<!--	    <div id="theSidebar" class="sidebar">-->
<!--            <button class="close-button fa fa-fw fa-close"></button>-->
<!--            <div class="codrops-links">-->
<!--                <a class="codrops-icon codrops-icon--prev" href="http://tympanus.net/Tutorials/MotionBlurEffect/" title="Previous Demo"><span>Previous Demo</span></a>-->
<!--                <a class="codrops-icon codrops-icon--drop" href="http://tympanus.net/codrops/?p=23872" title="Back to the article"><span>Back to the Codrops article</span></a>-->
<!--            </div>-->
<!--            <h1><span>Animated<span> Grid Layout</h1>-->
<!--            <nav class="codrops-demos">-->
<!--                <a class="current-demo" href="index.html">Demo 1</a>-->
<!--                <a href="index2.html">Demo 2</a>-->
<!--            </nav>-->
<!--            <div class="related">-->
<!--                <h3>Related Demos</h3>-->
<!--                <a href="http://tympanus.net/Development/BookPreview/">Book Preview</a>-->
<!--                <a href="http://tympanus.net/Tutorials/ThumbnailGridExpandingPreview/">Thumbnail Grid</a>-->
<!--                <a href="http://tympanus.net/Development/3DGridEffect/">3D Grid Effect</a>-->
<!--            </div>-->
<!--        </div>-->

        <div id="theGrid" class="main">
            <?php
            global $post;
            $args = array( 'numberposts'=> -1,  'category' => ($lang ? 77 : 299) );
            $teachers = get_posts( $args );
            ?>

            <section class="old_grid">
                <?php
                foreach ($teachers as $teacher) {
                    echo '<a class="old__grid__item" href="' .get_permalink($teacher->ID). '">';
                    echo '<h2 class="title title--preview">'. get_the_title($teacher->ID).'</h2>';
                    echo '<div class="loader"></div>';
                    echo '<span class="category">'. get_post_meta($teacher->ID, 'Специальность', true).'</span>';
                    echo '<div class="meta meta--preview">';
                    echo get_the_post_thumbnail( $teacher->ID, array(150,150), array('class' => 'meta__avatar') );
                    echo '</div>';
                    echo '</a>';
                }
                ?>
            </section>
        </div>
    </div>
</div>

<!--<script src="--><?php //bloginfo('template_directory'); ?><!--/relize/js/classie.js"></script>-->

<?php get_footer(); ?>