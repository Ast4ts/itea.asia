<?php /* Template Name: Расписание дневных курсов */
hideLangSwitchAndSetCorrectLang();
$lang = (get_locale() == 'ru_RU');
$lang = true;

$year  = (int) date('y');
$month = (int) date('m');
$day   = (int) date('d');

if ($lang) {
	$all_months = array('Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');
} else {
	$all_months = array('Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень');
}

$m1 = $all_months[$month - 1];
$m2 = ($month > 11) ? $all_months[$month - 12] : $all_months[$month];
$m3 = ($month + 1 > 11) ? $all_months[$month - 11] : $all_months[$month + 1];
$m4 = ($month + 2 > 11) ? $all_months[$month - 10] : $all_months[$month + 2];
$m5 = ($month + 3 > 11) ? $all_months[$month - 9]  : $all_months[$month + 3];
$m6 = ($month + 4 > 11) ? $all_months[$month - 8]  : $all_months[$month + 4];

$hid = !is_user_logged_in();
$categories = ($lang ? get_categories('parent=23&orderby=ID') : get_categories('parent=296&orderby=ID'));



/**
 * @param $cat_id
 * @param string $cssClass1
 * @param string $cssClass2
 * @return string
 */
function printCoursesCategory($cat_id, $cssClass1, $cssClass2 = '') {
	global $hid;
	global $year;
	global $month;
	global $day;

	$result = '';
	$posts  = get_posts(array('category' => $cat_id, 'numberposts' => -1, 'order' => 'ASC'));

	foreach ($posts as $post) {

		$all_dates = array();
		$all_dates[0] = get_post_meta(pll_get_post($post->ID, 'ru'), 'date1', true);
		$all_dates[1] = get_post_meta(pll_get_post($post->ID, 'ru'), 'date2', true);
		$all_dates[2] = get_post_meta(pll_get_post($post->ID, 'ru'), 'date3', true);
		$all_dates[3] = get_post_meta(pll_get_post($post->ID, 'ru'), 'date4', true);
		$all_dates[4] = get_post_meta(pll_get_post($post->ID, 'ru'), 'date5', true);
		$all_dates[5] = get_post_meta(pll_get_post($post->ID, 'ru'), 'date6', true);

		if ($all_dates[0] == '' && $all_dates[1] == '' && $all_dates[2] == '' && $all_dates[3] == '' && $all_dates[4] == '' && $all_dates[5] == '' && $hid) {
			continue;
		}

		$dates_bg_color = array();
		$dates_bg_color[0] = get_post_meta(pll_get_post($post->ID, 'ru'), 'date1-bg-color', true);
		$dates_bg_color[1] = get_post_meta(pll_get_post($post->ID, 'ru'), 'date2-bg-color', true);
		$dates_bg_color[2] = get_post_meta(pll_get_post($post->ID, 'ru'), 'date3-bg-color', true);
		$dates_bg_color[3] = get_post_meta(pll_get_post($post->ID, 'ru'), 'date4-bg-color', true);
		$dates_bg_color[4] = get_post_meta(pll_get_post($post->ID, 'ru'), 'date5-bg-color', true);
		$dates_bg_color[5] = get_post_meta(pll_get_post($post->ID, 'ru'), 'date6-bg-color', true);

		$months    = array();
		$ng = '';
		for ($i = 0; $i < sizeof($all_dates); $i++) {

			$text = '';
			$temp = strpos($all_dates[$i], '-');
			if ($temp !== false) {
				$text = trim(mb_substr($all_dates[$i], $temp + 1));
				$all_dates[$i] = trim(mb_substr($all_dates[$i], 0, $temp));
			}

			$mo_m = explode('.', $all_dates[$i]);
			$dif = null;
			if(isset($mo_m[2]) && isset($mo_m[1])){
				if ((int)substr($mo_m[2], -2) > $year) {
					$dif = 12 - $month + $mo_m[1];
				} elseif (((int)substr($mo_m[2], -2) == $year) && ($mo_m[1] > $month || ($mo_m[1] == $month && $mo_m[0] + 1 > $day))) {
					$dif = $mo_m[1] - $month;
				} else {
					continue;
				}
				$months[$dif] .= (empty($dates_bg_color[$i]) ? '<span>' : '<span style="background-color:#'.$dates_bg_color[$i].';">') . $all_dates[$i] . '</span>';
				$months[$dif] .= (empty($text) ? '' : (empty($dates_bg_color[$i]) ? '<span class="date-text">' : '<span class="date-text" style="background-color:#'.$dates_bg_color[$i].';">') . $text . '</span>');
			}
			if(!empty($dates_bg_color[$i])){$ng='has-g';}
		}

		if (sizeof($months) == 0 && $hid) {
			continue;
		}

		$label = "";
		switch (htmlentities(get_post_meta(pll_get_post($post->ID, 'ru'), 'label', true))){
            case "-25":
                $label = "<span style='background-color:#b5002a;color:#fff;border-radius:8px;'>-25%</span>";
                break;
            case "top":
                $label = "<span style='background-color:#f29500;color:#fff;border-radius:8px;'>top</span>";
                break;
            case "new":
                $label = "<span style='background-color:#00a30b;color:#fff;border-radius:8px;'>new</span>";
                break;
            case "old":
                $label = "<span style='background-color:#f29500;color:#fff;border-radius:8px;'>old</span>";
                break;
            case "seldom":
                $label = "<span style='background-color:#a800db;color:#fff;border-radius:8px;'>seldom</span>";
                break;
            case "update":
                $label = "<span style='background-color:#00d15b;color:#fff;border-radius:8px;'>update</span>";
                break;
            case "advanced":
                $label = "<span style='background-color:#4500b5;color:#fff;border-radius:8px;'>advanced</span>";
                break;
        }
		$result .= "<tr class=\"clFix $cssClass1 $cssClass2 $ng\">";
		$result .= '<td class="cent">' .$label. '</td>';
		$result .= '<td class="cent"><span>' .htmlentities(get_post_meta(pll_get_post($post->ID, 'ru'), 'code', true)). '</span></td>';

        $dis = get_post_meta(pll_get_post($post->ID, 'ru'), 'discont', true);

		if (empty($dis)) {
            $result .= '<td><a href="' .get_permalink($post->ID). '">' .htmlentities($post->post_title). '</a></td>';
        } else {
            $result .= '<td><a href="' .get_permalink($post->ID). '" class="b-inforow-courses-item b-inforow-courses-first-item"><span>' .htmlentities($post->post_title). '</span> <span class="b-inforow-courses-discounts-icon"><span class="b-inforow-courses-discounts">-'.$dis.' %</span></span></a></td>';
        }
		$result .= '<td class="cent"><span>' .get_post_meta($post->ID, 'long', true). '</span></td>';
        $cost = get_post_meta(pll_get_post($post->ID, 'ru'), 'cost', true);
        $currency = get_post_meta(pll_get_post($post->ID, 'ru'), 'currency', true) ? ' $' : ' тмт.';
        if (empty($dis)) {
            $result .= '<td class="cent cost"><span>' . $cost . $currency . '</span></td>';
        } else {
            $disPrice = nicePrice(ceil($cost * (100 - $dis) / 100));
            $result .= '<td class="cent cost"><div><span class="text-cross">' . $cost . $currency . '</span><span> ' . $disPrice . $currency . '</span></div></td>';
        }
		$result .= '<td class="cent"><span>' .(isset($months[0])?$months[0]:''). '</span></td>';
		$result .= '<td class="cent"><span>' .(isset($months[1])?$months[1]:''). '</span></td>';
		$result .= '<td class="cent"><span>' .(isset($months[2])?$months[2]:''). '</span></td>';
		$result .= '<td class="cent"><span>' .(isset($months[3])?$months[3]:''). '</span></td>';
		$result .= '<td class="cent"><span>' .(isset($months[4])?$months[4]:''). '</span></td>';
		$result .= '<td class="cent"><span>' .(isset($months[5])?$months[5]:''). '</span></td>';
		$result .= '</tr>';
	}

	return $result;
}
/**
 * END function printCoursesCategory
 */



$all_colors  = ['passion', 'blue', 'green', 'orange', 'lblue', 'purl', 'yellow', 'pink', 'hucki', 'aqua', 'passion'];
$dropdown1_li = '';
$dropdown2_li = '';
$schedule_table = '';

$all_slugs = '';
$categoriesNew = [];
foreach ($categories as $category) {
    switch($category->name) {
        case "Cisco":
            $categoriesNew[1] = $category;
            break;
        case "Microsoft":
            $categoriesNew[2] = $category;
            break;
        case "VMware":
            $categoriesNew[3] = $category;
            break;
        case "Oracle":
            $categoriesNew[4] = $category;
            break;
        case "ITIL":
            $categoriesNew[5] = $category;
            break;
        case "UNIX/Linux":
            $categoriesNew[6] = $category;
            break;
        case "Управление проектами":
            $categoriesNew[7] = $category;
            break;
        case "Программирование":
            $categoriesNew[8] = $category;
            break;
        case "Пользовательские курсы":
            $categoriesNew[9] = $category;
            break;
        case "Teradata":
            $categoriesNew[10] = $category;
            break;
        case "EC-Council":
            $categoriesNew[11] = $category;
            break;
        default:
            $categoriesNew[] = $category;
            break;
    }
};
ksort($categoriesNew);
foreach ($categoriesNew as $category) {
	if (true) { // $category->slug !== 'ec-council'
		$all_slugs .= ' '.$category->slug;
		$dropdown1_li .= "<li data-filter=\".{$category->slug}\"><a href=\"#\">{$category->name}</a></li>";

		$color = array_shift($all_colors);
		$schedule_table .= "<tr class=\"no {$category->slug} {$color} parent-category\">";
		$schedule_table .= '<th colspan="11" class="cent main"><a href="' .get_category_link($category->term_id). '">' .htmlentities($category->cat_name). '</a></th>';
		$schedule_table .= '</tr>';

		$cat_2_level = get_categories("parent=$category->cat_ID&orderby=ID");



		if (empty($cat_2_level)) {
			$schedule_table .= printCoursesCategory($category->cat_ID, $category->slug);
		} else {
			$dropdown2_li.="<li class='store-category {$category->slug}'>{$category->name}</li>";
            if ($category->name == "Cisco") {
                $cat_2_level_new = [];
                foreach ($cat_2_level as $cat) {
                    switch($cat->name) {//cat_name
                        case "Routing&Switching":
                            $cat_2_level_new[1] = $cat;
                            break;
                        case "Unified Communications":
                            $cat_2_level_new[2] = $cat;
                            break;
                        case "Security":
                            $cat_2_level_new[3] = $cat;
                            break;
                        case "Wireless":
                            $cat_2_level_new[4] = $cat;
                            break;
                        case "Service Provider":
                            $cat_2_level_new[5] = $cat;
                            break;
                        case "Unified Contact Center":
                            $cat_2_level_new[6] = $cat;
                            break;
                        case "Network Design":
                            $cat_2_level_new[7] = $cat;
                            break;
                        case "Data Center&Virtualization":
                            $cat_2_level_new[8] = $cat;
                            break;
                        default:
                            $cat_2_level_new[] = $cat;
                            break;
                    }
                }
                ksort($cat_2_level_new);
                foreach (array_reverse($cat_2_level) as $cat) {
                    $all_slugs .= ' '.$cat->slug;
                    $dropdown2_li .= "<li class=\"{$category->slug}\" data-filter=\".{$cat->slug}\"><a href=\"#\">{$cat->cat_name}</a></li>";

                    $schedule_table .= "<tr class=\"no {$category->slug} {$cat->slug} child-category\">";
                    $schedule_table .= '<th colspan="11"><a href="' .get_category_link($cat->term_id). '">' .htmlentities($cat->cat_name). '</a></th>';
                    $schedule_table .= '</tr>';
                    $schedule_table .= printCoursesCategory($cat->cat_ID, $category->slug, $cat->slug);
                }
            } else {
                foreach ($cat_2_level as $cat) {
                    $all_slugs .= ' '.$cat->slug;
                    $dropdown2_li .= "<li class=\"{$category->slug}\" data-filter=\".{$cat->slug}\"><a href=\"#\">{$cat->cat_name}</a></li>";

                    $schedule_table .= "<tr class=\"no {$category->slug} {$cat->slug} child-category\">";
                    $schedule_table .= '<th colspan="11"><a href="' .get_category_link($cat->term_id). '">' .htmlentities($cat->cat_name). '</a></th>';
                    $schedule_table .= '</tr>';
                    $schedule_table .= printCoursesCategory($cat->cat_ID, $category->slug, $cat->slug);
                }
            }
		}
	}
}


get_header();
?>

    <script src="<?php bloginfo('template_directory'); ?>/relize/js/jquery-scrolltofixed.js" type="text/javascript"></script>
    <script type="text/javascript">
      function DropDown(el) {
        this.dd = el;
        this.initEvents();
      }

      DropDown.prototype = {
        initEvents: function () {
          var obj = this;

          // obj.dd.on('click', function (event) {
          //     $(this).toggleClass('active');
          //     event.stopPropagation();
          // });
          //
          // obj.dd.children().each(function () {
          //     var self = $(this);
          //     self.on('click', function () {
          //         self.parent().removeClass('active');
          //     });
          // });
        }
      };

      $(function () {
        var dd = new DropDown($('#dd'));
        var dd1 = new DropDown($('#dd1'));

        $(document).click(function () {
          // all dropdowns
          $('.wrapper-dropdown-2').removeClass('active');
        });
      });
    </script>


    <div class="head-section">
        <div class="container">
            <a class="linkCourseToT" href="<?= get_category_link(($lang ? 23 : 296)); ?>">
                <img src="<?php bloginfo('template_directory'); ?>/relize/img/back-arrow.svg">
							<?=($lang ? 'Курсы по вендорам' : 'Курси по вендорам'); ?>
            </a>
            <h1><?php the_title(); ?></h1>
					<?php /* ?><a class="timetable-link-to-other-courses"
           href="<?= get_permalink(($lang ? 17 : 7863)); ?>"><?= get_the_title(($lang ? 17 : 7863)); ?></a><?php /**/ ?>
        </div>
    </div>

    <div class="container" id="flip-scroll">

        <div class="filters-courses">
            <div class="filters-select">
                <div id="dd" class="wrapper-dropdown-2 filter3" tabindex="1">
                    <div><span class="all-vendors"><?=($lang ? 'Все вендоры' : 'Всі вендори'); ?></span><ul class="chosen-vendors"></ul></div>
                    <div class="nano">
                        <ul class="dropdown nano-content">
                            <li class="current" data-filter="*">
                                <a href="#"><?=($lang ? 'Все вендоры' : 'Всі вендори'); ?></a>
                            </li>
													<?= $dropdown1_li; ?>
                        </ul>
                    </div>
                </div>

                <div id="dd1" class="wrapper-dropdown-2 notactive" tabindex="1">
                    <div><span class="all-technology"><?=($lang ? 'Все технологии' : 'Всі технології'); ?></span><ul class="chosen-vendors chosen-technology"></ul></div>
                    <div class="nano">
                        <ul class="dropdown nano-content">
													<?= $dropdown2_li; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="filters-radio">
                <div class="garanted">
                    <label><input type="radio" name="f-course" value="hide" checked="checked"><span class="circle"></span><span class="text"><?=($lang ? 'Только гарантированные курсы' : 'Тільки гарантовані курси'); ?></span></label>
                </div>
                <div class="all-c">
                    <label><input type="radio" name="f-course"><span class="circle"></span><span class="text"><?=($lang ? 'Все курсы' : 'Всі курси'); ?><span class="info"></span></span></label>
                    <div class="legend">
                        <div class="legend-item"><span class="indicator" style="background-color: #ffffff;"></span><span class="text">- <?=($lang ? 'дата старта курса может меняться' : 'дата старту курсу може змінюватися'); ?></span></div>
                        <div class="legend-item"><span class="indicator" style="background-color: #95c5a9;"></span><span class="text">- <?=($lang ? 'курс гарантирован 100%' : 'курс гарантований 100%'); ?></span></div>
                        <div class="legend-item"><span class="indicator" style="background-color: #eee888;"></span><span class="text">- <?=($lang ? 'для старта курса не хватает еще одного человека' : 'для старту курсу не вистачає ще однієї людини'); ?></span></div>
                    </div>
                </div>
            </div>
        </div>
        <table class="timeTableCourses dayCourse ddddddd">
            <tr class="infoRow <?= $all_slugs; ?> has-g">
                <td><?php ($lang ? 'Лейбл' : 'Лейбл'); ?></td>
                <td><?= ($lang ? 'Код курса' : 'Код курсу'); ?></td>
                <td class="lef"><?= ($lang ? 'Название курса' : 'Назва курсу'); ?></td>
                <td><?= ($lang ? 'Длительность' : 'Тривалість'); ?></td>
                <td><?= ($lang ? 'Цена без НДС' : 'Ціна без ПДВ'); ?></td>
                <td><?= $m1; ?></td>
                <td><?= $m2; ?></td>
                <td><?= $m3; ?></td>
                <td><?= $m4; ?></td>
                <td><?= $m5; ?></td>
                <td><?= $m6; ?></td>
            </tr>
            <tr class="prld-tr"><th colspan="10" align="center" style="text-align: center;"><img src="/wp-content/themes/new-it/images/Spinner-1s-200px.svg" alt="spinner-it" width="48" height="48"></th></tr>
					<?php //echo $schedule_table; ?>
        </table>

        <div class="legend lg-under">
            <div class="legend-item"><span class="indicator" style="background-color: #ffffff;"></span><span class="text">- <?=($lang ? 'дата старта курса может меняться' : 'дата старту курсу може змінюватися'); ?></span></div>
            <div class="legend-item"><span class="indicator" style="background-color: #95c5a9;"></span><span class="text">- <?=($lang ? 'курс гарантирован 100%' : 'курс гарантований 100%'); ?></span></div>
            <div class="legend-item"><span class="indicator" style="background-color: #eee888;"></span><span class="text">- <?=($lang ? 'для старта курса не хватает еще одного человека' : 'для старту курсу не вистачає ще однієї людини'); ?></span></div>
        </div>

        <div style="padding:0 20px 20px;color:#133b54;font-size:10px;">* Курсы, которые проводятся не на территории Украины, читаются нашими партнерами.</div>
    </div>


    <!-- Start SiteHeart code -->
    <script>
      var sheduleTable = <?php if( strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')!==false ||
				strpos($_SERVER['HTTP_USER_AGENT'],'rv:11.0')!==false){echo '\''.html_entity_decode($schedule_table).'\'';}else{echo '`'.html_entity_decode($schedule_table).'`';} ?>;
      $(document).ready(function(){
        setTimeout(function(){
          // $('.timeTableCourses.dayCourse').append(sheduleTable);
          $('.timeTableCourses.dayCourse .prld-tr').remove();
          $('.timeTableCourses.dayCourse tbody').html($('.timeTableCourses.dayCourse tbody').html()+sheduleTable);
          //Select guaranteed course
          var bulo = '';
          $('.timeTableCourses.dayCourse tr.has-g:not(.infoRow)').each(function(){
            if(bulo!=$(this).attr('class')){
              var classes = $(this).attr('class').split(' ').map(function(item){return item.trim();}).filter(function(item){return item!=='clFix';}).filter(function(item){return item!=='has-g';});
              var parent = '';
              classes.forEach(function(element,index){
                if(index==0){
                  $('.timeTableCourses.dayCourse tr.no.parent-category.'+element).addClass('has-g');
                  $('#dd1 .dropdown li.store-category.'+element).addClass('has-g');
                  parent='.'+element;
                }
                if(index==1 && element!=''){
                  $('.timeTableCourses.dayCourse tr.no.child-category.'+element+parent).addClass('has-g');
                  $('#dd1 .dropdown li[data-filter=".'+element+'"]').addClass('has-g');
                }
              });
              bulo=$(this).attr('class');
            }
          });
          $('.filter3 .dropdown li.current[data-filter="*"]').click();
        },1000);
      });
      (function () {
        var widget_id = 806115;
        _shcp = [{widget_id: widget_id, side: 'left', position: 'center'}];
        var lang = (navigator.language || navigator.systemLanguage || navigator.userLanguage || "en")
          .substr(0, 2).toLowerCase();
        var url = "widget.siteheart.com/widget/sh/" + widget_id + "/" + lang + "/widget.js";
        var hcc = document.createElement("script");
        hcc.type = "text/javascript";
        hcc.async = true;
        hcc.src = ("https:" == document.location.protocol ? "https" : "http") + "://" + url;
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hcc, s.nextSibling);
      })();
    </script>
    <!-- End SiteHeart code -->

<?php get_footer(); ?>
