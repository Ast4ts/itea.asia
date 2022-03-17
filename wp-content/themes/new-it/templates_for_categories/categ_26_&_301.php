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
        ?>
    </nav>
</section>

<div class="container" id="flip-scroll">
    <div class="head-section">
        <h1><?php single_cat_title(); ?></h1>
    </div>

    <div class="block-news clearfix" style="width: calc(100% - 220px); clear:none; float:left;">

        <!-- <div class="col-md-6 col-sm-12 col-xs-12 block">
            <div class="col-md-12 col-sm-12 col-xs-12 top">
                <h2><a href="#">Владислав Сидоренко</a></h2>
                <img src="">
                <p>Инструктор-консультант ITIL, COBIT, ISO27k, HR. Авторизованный тренер ITIL. Менеджер по качеству ИТ, Аудитор ИТ Имеет большой опыт в планировании, построении и аудите...</p>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12 bottom">
                <a href="#">Методология</a>
                <button type="button" data-toggle="modal" data-target="#myModal">Подробнее</button>
            </div>
        </div> -->

        <?php
        function the_excerpt_max_charlength($charlength, $id)
        {
            $el = get_post($id);
            $excerpt = $el->post_excerpt;
            $charlength++;

            if (mb_strlen($excerpt) > $charlength) {
                $subex = mb_substr($excerpt, 0, $charlength - 5);
                $exwords = explode(' ', $subex);
                $excut = -(mb_strlen($exwords[count($exwords) - 1]));
                if ($excut < 0) {
                    echo mb_substr($subex, 0, $excut);
                } else {
                    echo $subex;
                }
                echo '...';
            } else {
                echo $excerpt;
            }
        }

        $args = array('numberposts' => -1, 'category' => ($lang ? 26 : 301));
        $teachers = get_posts($args);

        foreach ($teachers as $teacher) {

            $link = get_post_meta($teacher->ID, 'Ид курса', true);

            $link = get_category_link($link);

            echo '<div class="dayInstructor">';

            echo '<div class="dayInstructorTop">';
            echo '<h2><a href="' . get_the_permalink($teacher->ID) . '">' . get_the_title($teacher->ID) . '</a></h2>';
            echo get_the_post_thumbnail($teacher->ID, array(150, 150), array('class' => "meta__avatar"));
            echo "<p>" . the_excerpt_max_charlength(150, $teacher->ID) . "</p>";
            echo '</div>';
            echo '<div class="dayInstructorBottom">',
            '<ul><li><a href="', $link, '">', get_post_meta($teacher->ID, 'Специаьность', true),
            '</a></li></ul><a href="', get_the_permalink($teacher->ID), '" >', ($lang ? 'Подробнее' : 'Докладніше'), '</a></div>';
            echo '</div>';
        }
        ?>

    </div>
</div>

<!-- Start SiteHeart code -->
<script>
    (function () {
        var widget_id = 806115;
        _shcp = [{widget_id: widget_id, side: 'left', position: 'center'}];
        var lang = (navigator.language || navigator.systemLanguage
        || navigator.userLanguage || "en")
            .substr(0, 2).toLowerCase();
        var url = "widget.siteheart.com/widget/sh/" + widget_id + "/" + lang + "/widget.js";
        var hcc = document.createElement("script");
        hcc.type = "text/javascript";
        hcc.async = true;
        hcc.src = ("https:" == document.location.protocol ? "https" : "http")
            + "://" + url;
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hcc, s.nextSibling);
    })();
</script>
<!-- End SiteHeart code -->

<?php get_footer(); ?>