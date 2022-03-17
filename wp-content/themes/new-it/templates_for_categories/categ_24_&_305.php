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

<div class="container vacancies-wrap">
    <div class="head-section ">
        <h1><?php single_cat_title(); ?></h1>
        <p><?php if($lang):?>Мы всегда рады видеть в своей команде молодых профессионалов с горящими глазами, только вместе мы сможем добиться действительно выдающихся результатов
          <?php else:?>Ми завжди раді бачити у своїй команді молодих професіоналів з вогнем у очах, тільки разом ми зможемо домогтися дійсно видатних результатів<?php endif;?></p>

        <a class="btn-more" href="<?php if ($lang) : ?>https://about.itea.ua/<?php else : ?>https://about.itea.ua/ua/<?php endif; ?>">

            <?php if($lang): ?>
              <span>Узнать больше об ІТЕА</span>
          <?php else: ?>
               <span>Дізнатися більше про ІТЕА</span>
          <?php endif; ?>
        </a>

    </div>

    <div class="vacancy-list">
    <?php
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'post',
        'category'  => get_queried_object_id(),
        'orderby'   => 'date',
        'order'     => 'DESC',
    );
    $posts = get_posts($args);

    foreach ($posts as $post)
    {
        $v_title   = get_post_meta($post->ID, 'Название', true);
        $v_wage    = get_post_meta($post->ID, 'Зарплата', true);
        $v_require = get_post_meta($post->ID, 'Требования', true);
        $v_city    = get_post_meta($post->ID, 'Город', true);
        $v_company = get_post_meta($post->ID, 'Компания', true);
        $v_type    = get_post_meta($post->ID, 'Вид занятости', true);
        ?>
        <a class="vacancy-list-item" href="<?php echo get_permalink($post->ID); ?>">
            <figure style="background-image: url(<?php echo get_the_post_thumbnail_url( $post->ID, 'large' ); ?>)">
                <?php echo get_the_post_thumbnail( $post->ID, 'large' );?>
            </figure>
            <div>
                <h2><?php echo $post->post_title; ?></h2>
                <span class="city"><?php echo $v_city; ?></span>
            </div>
        </a>
    <?php
    }

    if (empty($posts))
    {
        ?>

        <div class="vacancy-list-no-vacancy">
            <?php echo $lang ? 'На данный момент открытых вакансий нет.' : 'На даний момент відкритих вакансій немає.'; ?>
        </div>

    <?php
    }
    ?>
    </div>
</div>

<div class="vacancies-wrap">
    <div class="tell-talant">
        <p class="question"><?php if($lang):?>Хочешь преподавать в ITEA?<?php else:?>Хочеш викладати в ITEA?<?php endif;?></p>
        <p class="text"><?php if($lang):?>Расскажи нам о своем таланте и стань частью команды<?php else:?>Розкажи нам про свій талант та стань частиною нашої команди<?php endif;?></p>
        <div class="tell-btn"><a href="mailto:hr@itea.ua"><?php if($lang):?>Рассказать о своем таланте<?php else:?>Розповісти про свій талант<?php endif;?></a></div>
    </div>
</div>

    <script>
        document.querySelector('.content').style.backgroundColor = '#ffffff';
    </script>

<?php get_footer(); ?>
