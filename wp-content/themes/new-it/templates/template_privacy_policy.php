<?php /* Template Name: Страница "Политика" */ ?>
<?php get_header(); ?>

<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700&subset=latin,cyrillic' rel='stylesheet'
      type='text/css'>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/privacy-policy.css">

<div class="page-about-itea">
<section class="broadcrumbs">
    <nav class="container">
        <?php
        if (function_exists('dimox_breadcrumbs')) {
            dimox_breadcrumbs();
        }
        ?>
    </nav>
</section>

<section class="privacy-policy">
    <div class="container">
        <div class="row">
            <article class="col-md-12 text-left">

                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        the_content();
                    }
                }
                ?>

            </article>
        </div>
    </div>
</section>

<?php get_footer(); ?>