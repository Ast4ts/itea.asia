<?php get_header(); ?>

<section class="broadcrumbs">
    <nav class="container">
        <?php
        if (function_exists('dimox_breadcrumbs')) {
            dimox_breadcrumbs();
        }
        ?>
    </nav>
</section>

<?php pageCoursesItea(); ?>

<?php get_footer(); ?>