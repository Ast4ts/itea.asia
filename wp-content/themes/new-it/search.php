<?php get_header(); ?>

<div class="container search-page">
    <div class="block-news clearfix">
        <div id="search_on_pagesearch"><?php get_search_form(); ?></div>
        <div class="articleNew">
            <?php
            $hr = false;
            if (have_posts()):
                while (have_posts()) : the_post();
                    if ($hr == false) {
                        $hr = true;
                    } else {
                        echo "<hr>";
                    } ?>
                    <div>
                        <div class="post_title">
                            <h2>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                        </div>

                        <div class="post-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink() ?>" class="btn btn-sm btn-green btn-det">ПОДРОБНЕЕ</a>
                        <div class="clearfix"></div>
                    </div>

                    <?php
                endwhile;
            else:
                ?>
                По данному запросу ничего не найдено!
                <?php
            endif;
            ?>
        </div>
        <?php
        if (function_exists('wp_corenavi')) wp_corenavi();
        ?>
    </div>
</div>

<?php get_footer(); ?>