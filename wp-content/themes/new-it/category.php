<?php
$cat_ID = get_query_var('cat');

if (cat_is_ancestor_of(22, $cat_ID) || cat_is_ancestor_of(219, $cat_ID)) {
    require_once('templates_for_categories/categ_22_&_219__children.php'); exit;
}

get_header();

$lang = (get_locale() == 'ru_RU');
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

    <?php
    $_cats = get_categories("parent=$cat_ID&numberposts=-1&orderby=ID");

    // Сделано не мной. Зачем так сделано я так и не понял. Менять не стал в силу сохранения историчности сего кода! :)
    if ($cat_ID == ($lang ? '35' : '340')) {
        $b = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($_cats as $key) {

            switch ($key->name) {
                case 'Windows Server 2012':
                    $b[0] = $key;
                    break;
                case 'Windows Server 2016':
                    $b[1] = $key;
                    break;
                case 'Microsoft Windows 10':
                    $b[2] = $key;
                    break;
                case 'Microsoft Windows 8':
                    $b[3] = $key;
                    break;
                case 'Microsoft Windows 7':
                    $b[4] = $key;
                    break;
                case 'Microsoft Exchange Server 2013':
                    $b[5] = $key;
                    break;
                case 'Microsoft SQL Server 2014':
                    $b[6] = $key;
                    break;
                case 'Microsoft SQL Server 2012':
                    $b[7] = $key;
                    break;
                case 'Microsoft SharePoint Server 2013':
                    $b[8] = $key;
                    break;
                case 'Microsoft System Center 2012':
                    $b[9] = $key;
                    break;
                case 'Visual Studio 2012':
                    $b[10] = $key;
                    break;
                case 'Windows Azure':
                    $b[11] = $key;
                    break;
                case 'Microsoft Lync Server 2013':
                    $b[12] = $key;
                    break;
                default:
                    $b[] = $key;
                    break;
            }
        }
        if(in_array(0, $b)){
            $b = array_filter($b, function($element) {
                return !empty($element);
            });
        }
        $_cats = $b;
    }

    $rr = get_ancestors($cat_ID, 'category');

    if ((!empty($_cats) || ($rr[count($rr) - 1] == 23) || $rr[count($rr) - 1] == 296) && ($cat_ID != 22)) {

        echo '<div class="head-section"><h1>';
        single_term_title();
        echo '</h1></div>';

        echo '<div class="block-news clearfix"' . ($cat_ID == 24 ? ' style="width: calc(100% - 220px); clear:none; float:left;"' : '') . '>';

        echo '<table class="timeTableCourses">';

        if (($rr[count($rr) - 1] == 23 || $rr[count($rr) - 1] == 296) && empty($_cats)) {

            $_posts = get_posts("cat=$cat_ID&numberposts=-1");

            $option .= get_cat_name($cat_ID);

            echo '<tr class="infoRow"><td>';
            echo($lang ? '' : ''), '</td><td class="lef name-courses">';
            echo($lang ? 'Код курса' : 'Код курсу'), '</td><td class="lef name-courses">';
            echo($lang ? 'Название' : 'Назва'), '</td><td class="kod-exem">';
            echo($lang ? 'Код экзамена' : 'Код екзамену'), '</td><td class="duration">';
            echo($lang ? 'Длительность' : 'Тривалість'), '</td><td class="price">';
            echo($lang ? 'Цена без НДС' : 'Ціна без ПДВ');
            echo '</td></tr>';

            foreach ($_posts as $postt) {

                setup_postdata($postt);

                $typeCurrency = (get_post_meta(pll_get_post($postt->ID, 'ru'), 'currency', true)) ? ' $' : ' тмт.';
                $l = get_the_permalink($postt->ID);
                $label = "";
                switch (htmlentities(get_post_meta(pll_get_post($postt->ID, 'ru'), 'label', true))){
                    case "-25":
                        $label = "<span style='background-color:#b5002a;color:#fff;border-radius:8px;display:block;padding: 0 15px;'>-25%</span>";
                        break;
                    case "top":
                        $label = "<span style='background-color:#f29500;color:#fff;border-radius:8px;display:block;padding: 0 15px;'>top</span>";
                        break;
                    case "new":
                        $label = "<span style='background-color:#00a30b;color:#fff;border-radius:8px;display:block;padding: 0 15px;'>new</span>";
                        break;
                    case "old":
                        $label = "<span style='background-color:#f29500;color:#fff;border-radius:8px;display:block;padding: 0 15px;'>old</span>";
                        break;
                    case "seldom":
                        $label = "<span style='background-color:#a800db;color:#fff;border-radius:8px;display:block;padding: 0 15px;'>seldom</span>";
                        break;
                    case "update":
                        $label = "<span style='background-color:#00d15b;color:#fff;border-radius:8px;display:block;padding: 0 15px;'>update</span>";
                        break;
                    case "advanced":
                        $label = "<span style='background-color:#4500b5;color:#fff;border-radius:8px;display:block;padding: 0 15px;'>advanced</span>";
                        break;
                }

                echo "<tr><td  class=\"cent\">".$label."</td>";
                echo "<td  class=\"cent\">";
                echo get_post_meta(pll_get_post($postt->ID, 'ru'), 'code', true) . "</td><td class='name-courses'><a href='$l'>";
                echo get_the_title($postt->ID) . "</a></td><td class='cent kod-exem'>";
                echo get_post_meta(pll_get_post($postt->ID, 'ru'), 'testing', true) . "</td><td class='cent duration'>";
                echo get_post_meta($postt->ID, 'long', true) . "</td><td class='cent price'>";
                echo get_post_meta(pll_get_post($postt->ID, 'ru'), 'cost', true) . $typeCurrency;

                echo '</td></tr>';
            }

        } else {
            $loop = true;
            foreach ($_cats as $category) {

                //if  ($loop == true) {$loop = false;continue;}
                $option .= $category->cat_name;

                echo "<tr class='name-row'><th colspan=\"6\"><a href=" . get_category_link($category->term_id) . ">$option</a></th></tr>";
                $option = "";
                $args = array('category' => $category->cat_ID, 'order' => 'ASC', 'numberposts' => -1);
                $posts = get_posts($args);

                echo '<tr class="infoRow"><td>';
                echo($lang ? '' : ''), '</td><td class="lef name-courses">';
                echo($lang ? 'Код курса' : 'Код курсу'), '</td><td class="lef name-courses">';
                echo($lang ? 'Название' : 'Назва'), '</td><td class="kod-exem">';
                echo($lang ? 'Код экзамена' : 'Код екзамену'), '</td><td class="duration">';
                echo($lang ? 'Длительность' : 'Тривалість'), '</td><td class="price">';
                echo($lang ? 'Цена без НДС' : 'Ціна без ПДВ');
                echo '</td></tr>';

                foreach ($posts as $post) {

                    setup_postdata($post);
                    $l = get_the_permalink($post->ID);
                    $typeCurrency = (get_post_meta(pll_get_post($post->ID, 'ru'), 'currency', true)) ? ' $' : ' тмт.';
                    $label = "";
                    switch (htmlentities(get_post_meta(pll_get_post($post->ID, 'ru'), 'label', true))){
                        case "-25":
                            $label = "<span style='background-color:#b5002a;color:#fff;border-radius:8px;display:block;padding: 0 15px;'>-25%</span>";
                            break;
                        case "top":
                            $label = "<span style='background-color:#f29500;color:#fff;border-radius:8px;display:block;padding: 0 15px;'>top</span>";
                            break;
                        case "new":
                            $label = "<span style='background-color:#00a30b;color:#fff;border-radius:8px;display:block;padding: 0 15px;'>new</span>";
                            break;
                        case "old":
                            $label = "<span style='background-color:#f29500;color:#fff;border-radius:8px;display:block;padding: 0 15px;'>old</span>";
                            break;
                        case "seldom":
                            $label = "<span style='background-color:#a800db;color:#fff;border-radius:8px;display:block;padding: 0 15px;'>seldom</span>";
                            break;
                        case "update":
                            $label = "<span style='background-color:#00d15b;color:#fff;border-radius:8px;display:block;padding: 0 15px;'>update</span>";
                            break;
                        case "advanced":
                            $label = "<span style='background-color:#4500b5;color:#fff;border-radius:8px;display:block;padding: 0 15px;'>advanced</span>";
                            break;
                    }

                    echo "<tr><td  class=\"cent\">".$label."</td>";
                    echo "<td  class=\"cent\">";
                    echo get_post_meta(pll_get_post($post->ID, 'ru'), 'code', true) . "</td><td class='name-courses'><a href='$l'>";
                    echo get_the_title($post->ID) . "</a></td><td class='cent kod-exem'>";
                    echo get_post_meta(pll_get_post($post->ID, 'ru'), 'testing', true) . "</td><td class='cent duration'>";
                    echo get_post_meta($post->ID, 'long', true) . "</td><td class='cent price'>";
                    echo get_post_meta(pll_get_post($post->ID, 'ru'), 'cost', true) . $typeCurrency;

                    echo '</td></tr>';
                }
                wp_reset_postdata();
            }
        }
        echo '</table>';
        ?>



      <?php
      $cat_description = category_description($cat_ID);
      if (mb_strlen($cat_description) < 1222) {?>
          <div>
              <?php echo $cat_description; ?>
          </div>
      <?php } else {  ?>
          <div class="read-more-text">
            <div class="spoiler spoiler-shadow">
                <?php echo $cat_description; ?>
            </div>
            <button class="readmore">
                <?php echo $lang ? 'Читать далее' : 'Читати далі'; ?>
            </button>
          </div>
      <?php } ?>



        <?php
    } else {
        echo '<div class="head-section"></div>';
        echo '<div class="block-news clearfix"' . ($cat_ID == 24 ? ' style="width: calc(100% - 220px); clear:none; float:left;"' : '') . '>';

        $eve   = (($rr[count($rr) - 1] == 22) || ($rr[count($rr) - 1] == 219));
        $order = (!$eve ? 'ASC' : 'DESC');

        $page = (get_query_var('paged') ? get_query_var('paged') : 1);
        query_posts("paged=$page&cat=$cat_ID&order=$order");
        if (have_posts()):
            echo($eve ? '<div id="course" class="eVe">' : '');

            echo($eve ? '</div>' : '');
        endif;

        echo '</div>'; // end block div class="block-news clearfix"
    }
    ?>

</div>


<?php
if ($cat_ID == 25) {
    $menu_options = array(
        'menu' => 'fLeftSide',
        'container' => 'nav',
        'container_class' => '',
        'container_id' => '',
        'menu_id' => '');
    wp_nav_menu($menu_options);
}
?>

<?php get_footer(); ?>
