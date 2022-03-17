<?php /* Template Name: registration_evening */

$lang = (get_locale() == 'ru_RU');

get_header();
?>

<?php
if ( !empty($_POST['id_course']) ){
    $id_course = $_POST['id_course'];
} else {
    $id_course = -1;
}

if (!empty($_POST['price'])) {
    $full_price = $_POST['price'];
} else {
    $full_price = false;
}

if (!empty($_POST['parts_price'])) {
    $parts_price = $_POST['parts_price'];
} else {
    $parts_price = false;
}
?>

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/registration_evening.css" />

<div class="container regDiv">
    <section id="contact-evening">

        <div class="container_12">
            <div class="grid_6">
            <h1><?php echo ($lang ? 'Анкета для записи' : 'Анкета для запису'); ?> <span class="heading"><?php echo ($lang ? 'на занятия' : 'на заняття'); ?></span></h1>
                <form id="cnt-order" method="POST" action="">

                    <div class="items ">
                      <?php if (($id_course == -1)){ ?>
                        <div class="group">
                            <select name="course" required>
                                <option selected="selected"><?php echo ($lang ? 'Выберите курс' : 'Оберіть курс'); ?></option>
                                <?php 
                                        $posts = get_posts( array(
                                        'numberposts'     => -1, // тоже самое что posts_per_page
                                        'category'        => '22',
                                        'post_type'       => 'post',
                                        'orderby'         => 'title'

                                      ) );
                                      foreach($posts as $post){ setup_postdata($post);
                                         echo '<option value="'.get_the_title().'">'.get_the_title().'</option>';
                                      }
                                      wp_reset_postdata();
                                 ?>
                            </select>
                        </div>
                      <?php } else { ?>
                          <h3 class="course-heading"> <?php echo get_the_title($id_course); ?> </h3>
                          <input type="hidden" name="course" value="<?php echo get_the_title($id_course); ?>">
                      <?php } ?>

                        <p class="b-courses-sing-up-hidden-tip">
                            <?php echo ($lang ? 'Пожалуйста, заполните все поля формы' : 'Будь ласка, заповніть всі поля форми'); ?>
                        </p>

                        <div class="group">
                          <label id="label-name"><span class="red">* </span><?php echo ($lang ? 'Имя и Фамилия' : 'Ім’я та Прізвище'); ?></label>
                          <input name="name" type="text" id="course-sign-up-name" required data-location="bottom" data-message="<?php echo ($lang ? 'Введите ваше имя!' : 'Введіть ваше ім\'я!'); ?>" pattern="^[a-zA-Zа-яА-ЯіІїЇєЄґҐёЁ'][a-zA-Zа-яА-Я-' іІїЇєЄґҐёЁ]+[a-zA-Zа-яА-ЯіІїЇєЄґҐёЁ']?$">
                          <span class="highlight"></span>
                          <span class="bar"></span>
                        </div>

                        <div class="group">
                          <label id="label-home"><span class="red">* </span>Телефон</label>
                          <input name="phone" type="tel" required autocomplete="off" id="maskTel" data-location="bottom" data-message="<?php echo ($lang ? 'Введите ваш телефон!' : 'Введіть ваш телефон!'); ?>">
                          <span class="highlight"></span>
                          <span class="bar"></span>
                        </div>

                        <div class="group">
                          <label id="label-email"><span class="red">* </span>E-mail</label>
                          <input name="mail" type="email" id="course-sign-up-email" required data-location="bottom" data-message="<?php echo ($lang ? 'Введите корректный' : 'Введіть коректний'); ?> e-mail!" value="">
                          <span class="highlight"></span>
                          <span class="bar"></span>
                        </div>

                        <?php
                        if(in_category(105, $id_course) || in_category(226, $id_course)){
                        ?>
                            <div class="group">
                                <label id="name_of_child"><span class="red">* </span><?php echo ($lang ? 'Имя ребенка' : "Ім'я дитини"); ?></label>
                                <input name="name_of_child" type="text" required data-location="bottom" value=""
                                       data-message="<?php echo ($lang ? 'Введите имя Вашего ребенка!' : "Введіть ім'я Вашої дитини!"); ?>"  pattern="^[a-zA-Zа-яА-ЯіІїЇєЄґҐёЁ'][a-zA-Zа-яА-Я-' іІїЇєЄґҐёЁ]+[a-zA-Zа-яА-ЯіІїЇєЄґҐёЁ']?$">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                            </div>
                            <div class="group">
                                <label id="age_of_child"><span class="red">* </span><?php echo ($lang ? 'Возраст ребенка' : 'Вік дитини'); ?></label>
                                <input name="age_of_child" type="text" required data-location="bottom" value=""
                                       data-message="<?php echo ($lang ? 'Введите корректный возраст Вашего ребенка!' : 'Введіть коректний вік Вашої дитини!'); ?>" pattern="[0-9]{1,2}">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                            </div>
                        <?php } ?>

                        <div class="group">
                          <label id="label-comment"><?php echo ($lang ? 'Комментарий' : 'Коментарі'); ?></label>
                          <input name="coment" type="text" class="comment" data-location="bottom" data-message="<?php echo ($lang ? 'Комментарий' : 'Коментарі'); ?>">
                          <span class="highlight"></span>
                          <span class="bar"></span>
                        </div>

                    </div>

                    <input type="hidden" name="type" value="evening">
                    <?php echo (empty($full_price ) ? '' : '<input type="hidden" name="price"  value="'. $full_price .'">'); ?>
                    <?php echo (empty($parts_price) ? '' : '<input type="hidden" name="parts_price" value="'. $parts_price.'">'); ?>

                    <button class="submit"><div class="progress"></div><span><?php echo ($lang ? 'Отправить заявку' : 'Відправити заявку'); ?></span></button>

                    <p class="hiddenText">
                      <?php if($lang){ ?>
                        *Отправляя заявку, я даю согласие на обработку моих <br> персональных данных. Компания ИТЕА обязуется не <br> передавать данную информацию 3-лицам.
                       <?php } else { ?>
                        *Відправляючи заявку, я даю згоду на обробку моїх <br> персональних даних. Компанія ITEA зобов'язується не <br> передавати цю інформацію 3-особам.
                       <?php } ?>
                    </p>

                </form>
            </div>

            <div class="grid_6 info">
                <h2><?php echo ($lang ? 'Свяжитесь с нами' : 'Зв\'яжіться з нами'); ?></h2>
                <div class="contact-info">
                <img src="<?php bloginfo('template_directory'); ?>/images/registration_evening/mobile.png" alt="">
                <p class="lightText"><?php echo ($lang ? 'Возникли вопросы? Желаете записаться напрямую по телефону? Звоните прямо сейчас!' : 'Виникли питання? Бажаєте записатися по телефону? Дзвоніть прямо зараз!'); ?></p>
                <p class="phone"><strong class="red">+38 (044) 599-01-79</strong></p>
                </div>

                <div class="panda-image-reg">
                  <img src="<?php bloginfo('template_directory'); ?>/images/registration_evening/panda_table.png" alt="">
                </div>
            </div>

            <div class="main-text">
              <h2><?php echo ($lang ? 'Записавшись на курс Вы гарантированно получаете:' : 'Записавшись на курс, Ви гарантовано отримуєте:'); ?></h2>
              <div class="features">
                <div class="column">
                  <div class="top-column">
                    <img src="<?php bloginfo('template_directory'); ?>/images/registration_evening/test.png" alt="">
                    <p class="column-text"><?php echo ($lang ? 'Предварительное тестирование' : 'Попереднє тестування'); ?> <span class="heading"><?php echo ($lang ? 'для определения уровня' : 'для визначення рівня'); ?></span></p>
                  </div>
                  <div class="bottom-column">
                    <img src="<?php bloginfo('template_directory'); ?>/images/registration_evening/money.png" alt="">
                    <p class="column-text"><?php echo ($lang ? 'Возможность оплаты частями' : 'Можливість оплати частинами'); ?></p>
                  </div>
                </div>
                <div class="column">
                  <div class="top-column">
                    <img src="<?php bloginfo('template_directory'); ?>/images/registration_evening/clock.png" alt="">
                    <p class="column-text"><?php echo ($lang ? 'Вечерний и дневной формат' : 'Вечірня та денна форма'); ?> <span class="heading"> <?php echo ($lang ? 'обучения' : 'навчання'); ?></span></p>
                  </div>
                  <div class="bottom-column">
                    <img src="<?php bloginfo('template_directory'); ?>/images/registration_evening/univer.png" alt="">
                    <p class="column-text"><?php echo ($lang ? 'Сертификат об окончании' : 'Сертифікат про закінчення'); ?></p>
                  </div>
                </div>
                <div class="column">
                  <div class="top-column last-of">
                    <img src="<?php bloginfo('template_directory'); ?>/images/registration_evening/table.png" alt="">
                    <p class="column-text"><?php echo ($lang ? 'Стажировка в ИТ-компаниях' : 'Стажування кращих студентів'); ?> <span class="heading"><?php echo ($lang ? 'лучшим студентам' : 'в IT-компаніях'); ?></span></p>
                  </div>
                  <div class="bottom-column last-of">
                    <img src="<?php bloginfo('template_directory'); ?>/images/registration_evening/junk-food.png" alt="">
                    <p class="column-text"><?php echo ($lang ? 'Помощь в трудоустройстве' : 'Допомога у працевлаштуванні'); ?></p>
                  </div>
                </div>                                      
              </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
$( document ).ready(function() {
$(function() {
  var labelName  = $("#label-name");
  var labelTel   = $("#label-home");
  var labelEmail = $("#label-email");
  var labelNameChild = $('#name_of_child');
  var labelAgeChild  = $('#age_of_child');
  var labelComment = $("#label-comment");
  var labelNameInput =  $("#label-name+input");
  var labelTelInput = $("#label-home+input");
  var labelEmailInput = $("#label-email+input");
  var labelNameChildInput = $('#name_of_child+input');
  var labelAgeChildInput  = $('#age_of_child+input');
  var labelCommentInput = $("#label-comment+input");

    labelNameInput.add(labelTelInput).add(labelEmailInput).add(labelNameChildInput).add(labelAgeChildInput).add(labelCommentInput).keyup(function() {
        if($(this).val().length) {
            $(this).prev().hide();
        } else {
            $(this).prev().show();
        }
    });

    labelName.add(labelTel).add(labelEmail).add(labelNameChild).add(labelAgeChild).add(labelComment).click(function(){
        $(this).next().focus();
        $(this).hide();
    });

    labelNameInput.add(labelTelInput).add(labelEmailInput).add(labelNameChildInput).add(labelAgeChildInput).add(labelCommentInput).blur(function() {
         if($(this).val().length) {
            $(this).prev().hide();
        } else {
            $(this).prev().show();
        }
    });

    $( "#maskTel" ).click(function(){
        $(this).focus();
        labelTel.hide();
    });

    $( "#maskTel" ).focus(function(){
        labelTel.hide();
    });

    if(labelNameInput.val() !== '') {
        $("label").hide()
    }
});
});
</script>

<?php get_footer(); ?>