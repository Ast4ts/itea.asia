<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/relize/css/style1.css">

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

    <div class="gal">

<?php
if (have_posts()):
    while (have_posts()) : the_post();
    ?>

    <div class="galItem">

    <?php if (has_post_thumbnail()) { ?>
        <a href="<?php the_permalink() ?>" ><?php the_post_thumbnail(array(300,200)); ?></a>
    <?php } ?>

    <h4> <a href="<?php the_permalink() ?>" class="title"> <?php the_title(); ?> </a></h4>

    </div>

    <?php
    endwhile;
    echo "<div class='gallery-pagination' style='width: 100%;clear: both;'>";
    wp_corenavi();
    echo "</div>";
endif;
?>

    </div>
</div>

<?php get_footer(); ?>