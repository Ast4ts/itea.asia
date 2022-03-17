<?php
if( !empty($_GET['id']) ){
    global $wpdb;
    $table_name = $wpdb->get_blog_prefix() . 'resume';
    $r_id   = preg_replace('/[^a-z0-9]/i','',$_GET['id']);
    $resume = $wpdb->get_row('SELECT name,date_birth,email,phone,address,about_me,linkedin,facebook,portfolio,w1_places,w1_positions,w1_duties,w1_periods,w2_places,w2_positions,w2_duties,w2_periods,edu1_names,edu1_specialties,edu2_names,edu2_specialties,courses,tag_cloud,personal_qualities,eng,link_to_photo,confirm'.
                            ' FROM '.$table_name.
                            ' WHERE uniqid = \''.$r_id.'\''.
                            ' LIMIT 1' , ARRAY_A);

    if(empty($resume)){
        wp_redirect( get_permalink(7633) ); exit;
    } else {
        $resume = stripslashes_deep($resume);
    }

    switch ($resume['eng']) {
        case 2:
            $eng = 'Pre-intermediate';
            break;
        case 3:
            $eng = 'Intermediate';
            break;
        case 4:
            $eng = 'Upper intermediate';
            break;
        case 5:
            $eng = 'Advanced';
            break;
        default:
            $eng = 'Beginner';
    }

    function short_link($link){
        if( mb_strpos($link, 'www.') !== false ){
            $short = mb_substr($link, mb_strpos($link, 'www.')+4);
        } elseif (mb_strpos($link, '://') !== false){
            $short = mb_substr($link, mb_strpos($link, '://')+3);
        } else {
            $short = $link;
        }
        return $short;
    }
    $resume['linkedin']  = urldecode($resume['linkedin']);
    $resume['facebook']  = urldecode($resume['facebook']);
    $resume['portfolio'] = urldecode($resume['portfolio']);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="format-detection" content="telephone=no">
    <title><?php wp_title(); ?></title>
     <?php wp_head(); ?>
    <link rel="icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/styles.css" />

    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/resume_v7.css" />
    <link href="https://fonts.googleapis.com/css?family=Cuprum" rel="stylesheet">

    <!--[if IE]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css"><![endif]-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        ::-webkit-input-placeholder {color:#9E9E9E; font-size: 17px; letter-spacing: 1px;}
        ::-moz-placeholder          {color:#9E9E9E; font-size: 17px; letter-spacing: 1px;}
        :-moz-placeholder           {color:#9E9E9E; font-size: 17px; letter-spacing: 1px;}
        :-ms-input-placeholder      {color:#9E9E9E; font-size: 17px; letter-spacing: 1px;}
    </style>
 </head>
 <body>
    <div class="container b-cv-result">
      <img class="b-cv-logo" src="<?php bloginfo('template_directory'); ?>/relize/img/icons/ITEA_logo.svg" alt="anketa"/>

      <div class="edit">
        <div class="edit-tooltip">
            <span class="glyphicon glyphicon-info-sign"  data-toggle="tooltip" data-placement="top" title="Пароль для редактирования был выслан на Ваш e-mail в момент создания данного резюме."></span>
        </div>
          <div class="edit-content">
          <span class="glyphicon glyphicon-pencil"></span> Редактировать
        </div>
        <form class="go-to-edit-form" method="post" action="<?php echo get_permalink(9571); ?>">
          <input type="hidden" name="id" value="<?php echo $r_id; ?>">
          <input type="password" name="pass" class="edit-pass" placeholder="Введите пароль">
          <button class="submited" type="submit"><span class="glyphicon glyphicon-arrow-right"></span></button>
        </form>
      </div>
      <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();

            $(function(){
                $('.edit').click(function(){
                    $(this).addClass('go-to-edit');
                    $('[data-toggle="tooltip"]').tooltip();
                    $('.edit-pass').focus();
                });
            });
            $(function () {
                var resume_email_length = $('.resume__email').text().length;
                if(resume_email_length > 18){
                    $('.resume__email').css({
                        'font-size': '16px'
                    })
                } else if(resume_email_length > 25){
                    $('.resume__email').css({
                        'font-size': '14px'
                    })
                } else if(resume_email_length > 30){
                    $('.resume__email').css({
                        'font-size' : '12px'
                    })
                }
            })
        });
      </script>
      <h1 class="b-cv-result-heading">Анкета студента</h1>
      <div class="b-cv-result-wrapper col-md-12">
        <div class="col-md-5 col-sm-12 b-cv-result--left-wrapper">
          <img class="b-cv-result-ava" src="/wp-content/themes/new-it/relize/img/icons/long-logo.png" alt="itea">
          <div class="b-cv-result-logo-container">
            <img src="<?php echo $resume['link_to_photo']; ?>" alt="Ваше фото">
          </div>

          <p id="cv-result-name"><?php echo $resume['name']; ?></p>
          <?php if (!empty($resume['date_birth'])) { ?>
            <p id="cv-result-birth"><span>Дата рождения:</span><br><?php echo $resume['date_birth']; ?></p>
          <?php } ?>
          <p id="cv-result-about"><span>о себе:</span><br><?php echo html_entity_decode($resume['about_me']); ?></p>
          <p class="cv-result-p resume__email"><span><img src="/wp-content/themes/new-it/relize/img/icons/cv-icon-1.png" alt="itea"></span><?php echo $resume['email']; ?></p>
          <p class="cv-result-p"><span><img src="/wp-content/themes/new-it/relize/img/icons/cv-icon-3.png" alt="itea"></span><?php echo $resume['phone']; ?></p>
          <?php
          if (!empty($resume['address'])) { ?>
              <p class="cv-result-p"><span><img src="/wp-content/themes/new-it/relize/img/icons/cv-icon-2.png" alt="itea"></span><?php echo $resume['address']; ?></p>
          <?php
          }
          if (!empty($resume['linkedin'])) { ?>
            <a href="<?php echo $resume['linkedin']; ?>" class="cv-result-a"><span><img src="/wp-content/themes/new-it/relize/img/icons/linkedin.png" alt="itea"></span>My Linkedin</a>
          <?php
          }
          if (!empty($resume['facebook'])) { ?>
            <a href="<?php echo $resume['facebook']; ?>" class="cv-result-a"><span><img src="/wp-content/themes/new-it/relize/img/icons/facebook.png" alt="itea"></span>My Facebook</a>
          <?php
          }
          if (!empty($resume['portfolio'])) { ?>
            <a href="<?php echo $resume['portfolio']; ?>" class="cv-result-a"><span><img src="/wp-content/themes/new-it/relize/img/icons/bag.png" alt="itea"></span>My Portfolio</a>
          <?php } ?>

        </div>
        <div class="col-md-7 col-sm-12 b-cv-result--right-wrapper">

          <div class="b-cv-result--right__item">
            <div class="b-cv-resume-expects">
                  <?php
                  if ($resume['confirm'] == '1') {
                      echo '<div><p class="agree"><span class="glyphicon glyphicon-ok"></span> Pезюме подтверждено администрацией ITEA</p></div>';
                  } else {
                      echo '<div><p class="wait"><span class="glyphicon glyphicon-hourglass"></span> Pезюме ожидает подтверждения администрацией ITEA</div></p>';
                  }
                  ?>
            </div>
          </div>
            <?php if ($resume['w1_places'] || $resume['w2_places']) { ?>
            <div class="b-cv-result-exp-wrapper">

              <div>
                  <div style="margin: 20px 0">
                      <span>
                        <img src="/wp-content/themes/new-it/relize/img/icons/bag.png" alt="itea">
                      </span>
                      <h2 class="b-cv-result-exp-decore">Опыт работы</h2>
                  </div>
                <div class="b-cv-result-exp__item">
                  <p class="b-cv-result-exp__item--company"><?php echo html_entity_decode($resume['w1_places']); ?></p>
                  <p class="b-cv-period"><?php echo $resume['w1_periods']; ?></p>
                </div>
                <div class="b-cv-result-exp__item">
                  <p class="b-cv-result-exp__item--position"><?php echo html_entity_decode($resume['w1_positions']); ?></p>
                  <p class="b-cv-result-exp__item--duties"><?php echo html_entity_decode($resume['w1_duties']); ?></p>
                </div>
              </div>
              <div>
                <div class="b-cv-result-exp__item">
                  <p class="b-cv-result-exp__item--company"><?php echo html_entity_decode($resume['w2_places']); ?></p>
                  <p class="b-cv-period"><?php echo $resume['w2_periods']; ?></p>
                </div>
                <div class="b-cv-result-exp__item">
                  <p class="b-cv-result-exp__item--position"><?php echo html_entity_decode($resume['w2_positions']); ?></p>
                  <p class="b-cv-result-exp__item--duties"><?php echo html_entity_decode($resume['w2_duties']); ?></p>
                </div>
              </div>

            </div> <!-- exp wrapper end -->
            <?php } ?>

          <div class="b-cv-result-edu-wrapper">
                <div style="width: 100%;">
                    <div style="margin: 20px 0">
                        <span>
                          <img src="/wp-content/themes/new-it/relize/img/icons/educ.png" alt="itea">
                        </span>
                            <h2 class="b-cv-result-exp-decore">Образование</h2>
                    </div>
                  <div class="b-cv-result-edu__item">
                    <p class="b-cv-result-edu__item--uni"><?php echo html_entity_decode($resume['edu1_names']); ?></p>
                    <p class="b-cv-result-edu__item--uni"><?php echo html_entity_decode($resume['edu2_names']); ?></p>
                  </div>
                    <div class="b-cv-result-edu__item">
                        <p class="b-cv-result-edu__item--specialty"><?php echo html_entity_decode($resume['edu1_specialties']); ?></p>
                        <p class="b-cv-result-edu__item--specialty"><?php echo html_entity_decode($resume['edu2_specialties']); ?></p>
                    </div>
                </div>
          </div>

          <div class="b-cv-result-edu-wrapper">
                 <div style="margin: 20px 0; width: 100%;">
                     <span>
                      <img src="/wp-content/themes/new-it/relize/img/icons/bedge.png" alt="itea">
                     </span>
                     <h2 class="b-cv-result-exp-decore">КУРСЫ ITEA</h2>
                     <?php
                     $stack = explode(',', $resume['courses']);
                     foreach($stack as $item) {
                         echo '<div class="col-md-6 b-cv-result-courses__item"><p>';
                         echo get_the_title($item);
                         echo get_the_post_thumbnail($item, 'thumbnail');
                         echo '</p></div>';
                     }
                     ?>
                 </div>
          </div>

          <div class="b-cv-result--right__item">
            <div class="col-md-12 b-cv-result-skills-wrapper">
              <h2>
                Навыки и умения:
              </h2>
              <p>
                  <?php
                  $stack = explode(',', $resume['tag_cloud']);
                  foreach($stack as $item) {
                      echo '<span class="b-cv-skills-span">', $item, '</span>';
                  }
                  ?>
              </p>
              <h2>
                Личные качества:
              </h2>
              <p><?php echo html_entity_decode($resume['personal_qualities']); ?></p>
              <h2>
                Владение языками:
              </h2>
              <div class="col-md-12 b-cv-result-langs__item">
                <p><span><img src="/wp-content/themes/new-it/relize/img/icons/cv-en.png" alt="itea"></span> <?php echo $eng; ?></p>
              </div>
            </div>
          </div>

        </div> <!-- right block wrapper end -->
      </div><!-- wrapper end -->
    </div><!-- container end -->
    <?php wp_footer(); ?>
    <script>var telerTrackerWidgetId="2583c3d0-35b9-44ba-9f0e-6811232d9cac"; var telerTrackerDomain="itea.phonet.com.ua";</script> <script src="//itea.phonet.com.ua/public/widget/call-tracker/lib.js"></script>
 </body>
</html>

<?php } else {
    get_header();
?>
    <div id="loading"><div id="loading-animation"></div></div>
    <div class="b-resume-container container">
      <h1 class="b-resume-main-heading">Анкета студента</h1>
      <div class="b-resume-wrapper col-md-12">
       <div class="b-resume-black-logo"></div>

       <div class="b-resume-form col-md-12">
        <form id="student-cv-form" method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" enctype="multipart/form-data">
         <input type="hidden" name="action" value="form_to_resume">
         <input type="hidden" name="verification" value="<?php echo wp_create_nonce('ITEA_of_the_best!'); ?>">
         <div class="b-resume-form-wrapper col-md-12 active" id="first-step-wrapper">
         <div class="col-md-12 col-sm-12 col-xs-12 b-resume-form-step-container active" id="first-step">
            <div class="steps-container">
              <div class="steps-container--inner">
               <div class="col-md-2 col-sm-2 col-xs-12 red-circle-wrapper">
                 <div class="red-circle-inner-container">
                    <div class="red-archide red-archideLeft">
                        <div class="red-arc"></div>
                    </div>
                    <div class="red-circle">
                       <p>
                       01
                       <span>
                          шаг
                       </span>
                     </p>
                    </div>
                    <div class="red-archide">
                        <div class="red-arc"></div>
                    </div>
                  </div>
                 <p class="red-circle-desc">
                    Основные <br>данные
                 </p>
               </div>
               <div class="col-md-1 col-sm-1 grey-circle">
                  <div>
                   <span></span>
                   <span></span>
                   <span></span>
                  </div>
               </div>
                <div class="col-md-2 col-sm-2 big-grey-circle-wrapper">
                 <div class="big-grey-circle-inner-container">
                    <div class="big-grey-circle">
                       <p>
                       02
                       <span>
                          шаг
                       </span>
                     </p>
                    </div>
                  </div>
                 <p class="big-grey-circle-desc">
                    Образование и <br>опыт работы
                 </p>
               </div>
               <div class="col-md-1 col-sm-1 grey-circle">
                 <div>
                   <span></span>
                   <span></span>
                   <span></span>
                 </div>
               </div>
              <div class="col-md-2 col-sm-2 big-grey-circle-wrapper">
                 <div class="big-grey-circle-inner-container">
                    <div class="big-grey-circle">
                       <p>
                       03
                       <span>
                          шаг
                       </span>
                     </p>
                    </div>
                  </div>
                 <p class="big-grey-circle-desc">
                    Навыки и <br>умения
                 </p>
               </div>
               </div>
             </div>  <!-- steps container end -->

             <div class="col-md-12 fill-out-wrapper">
                 <span id="fill-out"></span>
             </div>

             <div class="b-resume-left-heading col-md-4 col-sm-12 col-xs-12">
               <h3>Основные<br>данные</h3>
             </div>
             <div class="b-resume-form-right-block col-md-8 col-sm-12 col-xs-12">
                <div class="b-resume-input-div">
                    <span>
                    01
                    </span>
                    <input type="text" name="name" maxlength="250" autocomplete="off" class="regular_input check_error" id="student-name">
                    <p class="placeholder required-field__label">Имя Фамилия</p>
                </div>
                <div class="b-resume-input-div">
                    <span>
                    02
                    </span>
                    <input name="date_birth" class="regular_input check_error" autocomplete="off" type="text" maxlength="250" placeholder="" id="b-resume-birth">
                    <p class="placeholder required-field__label">Дата рождения</p>
                </div>
                <div class="b-resume-input-div">
                    <span>
                    03
                    </span>
                    <input type="text" name="email" maxlength="250" autocomplete="off" class="regular_input check_error" id="student-email">
                    <p class="placeholder required-field__label">E-mail</p>

                </div>
                <div class="b-resume-input-div">
                    <span>
                    04
                    </span>
                    <input type="text" name="phone" maxlength="250" autocomplete="off" class="regular_input check_error" id="student-tel">
                    <p class="placeholder required-field__label">Номер телефона</p>
                </div>
                <div class="b-resume-input-div">
                    <span>
                    05
                    </span>
                    <input type="text" name="address" maxlength="250" autocomplete="off" class="regular_input" id="student-address">
                    <p class="placeholder">Адрес</p>

                </div>
                <div class="b-resume-input-div">
                    <span>
                    06
                    </span>
                    <textarea name="about_me" class="regular_input check_error" id="about_me"></textarea>
                    <p class="placeholder required-field__label">О себе</p>

                </div>
                <div class="b-resume-input-div">
                    <span>
                    07
                    </span>
                    <input type="text" name="linkedin" maxlength="400" autocomplete="off">
                    <p class="placeholder">Ссылка на профиль в Linkedin</p>

                </div>
                 <div class="b-resume-input-div">
                    <span>
                    08
                    </span>
                    <input type="text" name="facebook" maxlength="400" autocomplete="off">
                    <p class="placeholder">Ссылка на профиль в Facebook</p>

                </div>
                 <div class="b-resume-input-div">
                    <span>
                    09
                    </span>
                     <input type="text" name="portfolio" maxlength="400" autocomplete="off">
                     <p class="placeholder">Ссылка на портфолио</p>

                 </div>

             </div>

             <div class="col-md-12">
               <div id="first-step-btn">
                  <a href="#">
                    К следующему шагу
                    <span><img src="/wp-content/themes/new-it/relize/img/icons/cv-left-arrow.png"></span>
                  </a>
               </div>
              </div>
              </div>
         </div><!-- first step end resume-form-wrapper end-->

        <!-- second step begin -->

         <div class="b-resume-form-wrapper col-md-12 hidden" id="second-step-wrapper">

          <div class="col-md-12 col-sm-12 col-xs-12 b-resume-form-step-container" id="second-step">
             <div class="steps-container">
              <div class="steps-container--inner">
               <div class="col-md-2 col-sm-2 big-grey-circle-wrapper">
                 <div class="big-grey-circle-inner-container">
                    <div class="big-grey-circle">
                       <p>
                       01
                       <span>
                          шаг
                       </span>
                     </p>
                    </div>
                  </div>
                 <p class="red-circle-desc">
                    Основные <br>данные
                 </p>
               </div>
               <div class="col-md-1 col-sm-1 grey-circle small-red-circle">
                  <div>
                   <span></span>
                   <span></span>
                   <span></span>
                  </div>
               </div>

               <div class="col-md-2 col-xs-12 red-circle-wrapper">
                 <div class="red-circle-inner-container">
                    <div class="red-archide red-archideLeft">
                        <div class="red-arc"></div>
                    </div>
                    <div class="red-circle">
                       <p>
                       02
                       <span>
                          шаг
                       </span>
                     </p>
                    </div>
                    <div class="red-archide">
                        <div class="red-arc"></div>
                    </div>
                  </div>
                 <p class="red-circle-desc">
                    Образование и <br>опыт работы
                 </p>
               </div>
               <div class="col-md-1 col-sm-1 grey-circle">
                 <div>
                   <span></span>
                   <span></span>
                   <span></span>
                 </div>
               </div>
              <div class="col-md-2 col-sm-2 big-grey-circle-wrapper">
                 <div class="big-grey-circle-inner-container">
                    <div class="big-grey-circle">
                       <p>
                       03
                       <span>
                          шаг
                       </span>
                     </p>
                    </div>
                  </div>
                 <p class="big-grey-circle-desc">
                    Навыки и <br>умения
                 </p>
               </div>
               </div>
             </div>  <!-- steps container end -->

              <div class="col-md-12 col-sm-12 col-xs-2 fill-out-wrapper">
                  <span id="fill-out-second"></span>
              </div>

            <div class="b-resume-left-heading col-md-4 col-sm-12 col-xs-12">
                <h3>Опыт <br>работы</h3>
            </div>
            <div class="b-resume-form-right-block col-md-8 col-sm-12 col-xs-12">
              <div class="b-resume-add-job-show">
                  <input id="add_place" type="button" value="Добавить место работы" class="js-open-block">
              </div>
              <div class="b-resume-form-right-block-hide">
                <div class="b-resume-input-div">
                    <span>
                    01
                    </span>
                    <input type="text" name="w1_places" maxlength="400" autocomplete="off" class="regular_input" id="w1_places">
                    <p class="placeholder">Место</p>

                </div>
                <div class="b-resume-input-div">
                    <span>
                    02
                    </span>
                    <input type="text" name="w1_positions" maxlength="250" autocomplete="off" class="regular_input" id="w1_positions">
                    <p class="placeholder">Должность</p>

                </div>
                <div class="b-resume-input-div">
                    <span>
                    03
                    </span>
                    <textarea name="w1_duties" class="regular_input" id="w1_duties" maxlength="900"></textarea>
                    <p class="placeholder">Обязанности</p>
                </div>
                <div class="b-resume-input-div dates">
                    <span>
                    04
                    </span>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <input type="text" name="w1_periods_1" autocomplete="off" id="date-1">
                    <p class="placeholder">Период работы</p>

                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 b-resume-input-experince">
<!--                        <span class="glyphicon glyphicon-info-sign"  data-toggle="tooltip" data-placement="top" title="Нынешнее время"></span>-->
                        <input type="text" name="w1_periods_2" autocomplete="off" id="date-2">
                        <p class="placeholder">Период работы</p>
                        <span>Если Вы еще работаете, оставьте это поле не заполненым</span>
                    </div>
                </div>
                <div class="b-resume-input-div grid1">
                    <div class="form_to_resume-add-job">
                      <div class="b-resume-input-div">
                        <span>
                        01
                        </span>
                        <input type="text" name="w2_places" maxlength="400" autocomplete="off" class="regular_input-second">
                        <p class="placeholder">Место</p>

                      </div>
                      <div class="b-resume-input-div">
                        <span>
                        02
                        </span>
                        <input type="text" name="w2_positions" maxlength="250" autocomplete="off" class="regular_input-second">
                        <p class="placeholder">Должность</p>

                      </div>
                      <div class="b-resume-input-div">
                        <span>
                        03
                        </span>
                        <textarea name="w2_duties" class="regular_input-second" id="w2_duties" maxlength="900"></textarea>
                        <p class="placeholder">Обязанности</p>

                      </div>
                      <div class="b-resume-input-div dates">
                          <span>
                          04
                          </span>
                          <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" name="w2_periods_1" autocomplete="off" id="date-3-second">
                            <p class="placeholder">Период работы</p>

                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-6 b-resume-input-experince">
                            <input type="text" name="w2_periods_2" autocomplete="off" id="date-4-second">
                            <p class="placeholder">Период работы</p>
                            <span>Если Вы еще работаете, оставьте это поле не заполненым</span>
                          </div>
                      </div>
                    </div>
                    <div class="b-resume-add-job">
                        <input type="button" value="Добавить место работы" class="btn-add-job">
                    </div>
                  </div>
                </div>
            </div>


         <div class="col-md-12">
            <div class="b-resume-left-heading col-md-4 col-sm-12 col-xs-12">
                <h3 class="required-field__label">Образование</h3>
            </div>
            <div class="b-resume-form-right-block col-md-8 col-sm-12 col-xs-12">
                <div class="b-resume-input-div">
                    <span>
                    01
                    </span>
                    <input type="text" name="edu1_names" maxlength="250" autocomplete="off" class="regular_input check_error" id="edu1_names">
                    <p class="placeholder required-field__label">Название учреждения</p>

                </div>
                <div class="b-resume-input-div">
                    <span>
                    02
                    </span>
                    <input type="text" name="edu1_specialties" maxlength="250" autocomplete="off" class="regular_input check_error" id="edu1_specialties">
                    <p class="placeholder required-field__label">Специальность</p>

                </div>
                <div class="b-resume-input-div grid2">
                    <div class="form_to_resume-add-education">
                      <div class="b-resume-input-div">
                        <span>
                        01
                        </span>
                        <input type="text" name="edu2_names" maxlength="250" autocomplete="off" class="regular_input-second">
                        <p class="placeholder">Название учреждения</p>

                      </div>
                      <div class="b-resume-input-div">
                        <span>
                        02
                        </span>
                        <input type="text" name="edu2_specialties" maxlength="250" autocomplete="off" class="regular_input-second">
                        <p class="placeholder">Специальность</p>

                      </div>
                    </div>
                    <div class="b-resume-add-edu">
                        <input type="button" value="Добавить место учебы" class="btn-add-education">
                    </div>
                </div>
            </div>

            <div id="second-step-btn">
                  <a href="#">
                    К предыдущему шагу
                    <span><img src="/wp-content/themes/new-it/relize/img/icons/cv-right-arrow.png"></span>
                  </a>
                  <a href="#">
                    К следующему шагу
                    <span><img src="/wp-content/themes/new-it/relize/img/icons/cv-left-arrow.png"></span>
                  </a>
               </div>
         </div>
        </div>
      </div>
        <!-- second step end -->
        <!-- third step begin -->

         <div class="b-resume-form-wrapper col-md-12 hidden" id="third-step-wrapper">
          <div class="col-md-12 col-sm-12 col-xs-12 b-resume-form-step-container" id="third-step">
          <div class="steps-container">
              <div class="steps-container--inner">
               <div class="col-md-2 col-sm-2 big-grey-circle-wrapper">
                 <div class="big-grey-circle-inner-container">
                    <div class="big-grey-circle">
                       <p>
                       01
                       <span>
                          шаг
                       </span>
                     </p>
                    </div>
                  </div>
                 <p class="red-circle-desc">
                    Основные <br>данные
                 </p>
               </div>
               <div class="col-md-1 col-sm-1 grey-circle small-red-circle">
                  <div>
                   <span></span>
                   <span></span>
                   <span></span>
                  </div>
               </div>

              <div class="col-md-2 col-sm-2 big-grey-circle-wrapper">
                 <div class="big-grey-circle-inner-container">
                    <div class="big-grey-circle">
                       <p>
                       02
                       <span>
                          шаг
                       </span>
                     </p>
                    </div>
                  </div>
                 <p class="red-circle-desc">
                     Образование и <br>опыт работы
                 </p>
               </div>
               <div class="col-md-1 col-sm-1 grey-circle small-red-circle">
                 <div>
                   <span></span>
                   <span></span>
                   <span></span>
                 </div>
               </div>
               <div class="col-md-2 col-xs-12 red-circle-wrapper">
                 <div class="red-circle-inner-container">
                    <div class="red-archide red-archideLeft">
                        <div class="red-arc"></div>
                    </div>
                    <div class="red-circle">
                       <p>
                       03
                       <span>
                          шаг
                       </span>
                     </p>
                    </div>
                    <div class="red-archide">
                        <div class="red-arc"></div>
                    </div>
                  </div>
                 <p class="red-circle-desc">
                    Навыки и <br>умения
                 </p>
               </div>
               </div>
             </div>  <!-- steps container end -->
            <div class="b-resume-left-heading col-md-4 col-sm-12 col-xs-12">
                <h3 class="required-field__label">Пройденные <br>курсы</h3>
            </div>
            <div class="b-resume-form-right-block tag-cloud-wrapper col-md-8 col-sm-12 col-xs-12">
                <div class="b-resume-input-div b-resume-input-div-course">
                   <input id="courses" type="text" name="courses" hidden>
                    <ul class="b-resume__course-list">
                        <li class="b-resume__course-list-item--new">
                            <input id="b-resume__course-list-item--search" type="text">
                        </li>
                    </ul>
                    <ul class="b-resume__course-menu">
                        <li class="b-resume__course-menu-item">AGILE / SCRUM</li>
                        <li class="b-resume__course-menu-item">Agile Project Management (PM Advanced)</li>
                        <li class="b-resume__course-menu-item">Angular 2</li>
                        <li class="b-resume__course-menu-item">Angular 4 (базовый)</li>
                        <li class="b-resume__course-menu-item">Angular 4 (продвинутый)</li>
                        <li class="b-resume__course-menu-item">Business Аnalysis</li>
                        <li class="b-resume__course-menu-item">Business Analysis advanced</li>
                        <li class="b-resume__course-menu-item">Copywriting</li>
                        <li class="b-resume__course-menu-item">Data Science/Machine Learning Fundamentals</li>
                        <li class="b-resume__course-menu-item">DevOps</li>
                        <li class="b-resume__course-menu-item">Digital-стратегия</li>
                        <li class="b-resume__course-menu-item">Email-маркетинг</li>
                        <li class="b-resume__course-menu-item">Frontend Advanced</li>
                        <li class="b-resume__course-menu-item">HR management</li>
                        <li class="b-resume__course-menu-item">ICND1</li>
                        <li class="b-resume__course-menu-item">ICND2</li>
                        <li class="b-resume__course-menu-item">IT-рекрутинг</li>
                        <li class="b-resume__course-menu-item">JavaScript Professional</li>
                        <li class="b-resume__course-menu-item">JavaScript базовый курс</li>
                        <li class="b-resume__course-menu-item">JavaScript продвинутый курс</li>
                        <li class="b-resume__course-menu-item">jQuery</li>
                        <li class="b-resume__course-menu-item">Node.js</li>
                        <li class="b-resume__course-menu-item">Project Management</li>
                        <li class="b-resume__course-menu-item">Project Management Professional / PMP</li>
                        <li class="b-resume__course-menu-item">Python для Data Science</li>
                        <li class="b-resume__course-menu-item">QA automation</li>
                        <li class="b-resume__course-menu-item">React.js</li>
                        <li class="b-resume__course-menu-item">React Native (базовый)</li>
                        <li class="b-resume__course-menu-item">React Native (продвинутый)</li>
                        <li class="b-resume__course-menu-item">Social Media Marketing (SMM)</li>
                        <li class="b-resume__course-menu-item">TypeScript</li>
                        <li class="b-resume__course-menu-item">UI Design</li>
                        <li class="b-resume__course-menu-item">Unity3D</li>
                        <li class="b-resume__course-menu-item">UX Design</li>
                        <li class="b-resume__course-menu-item">Vue.js</li>
                        <li class="b-resume__course-menu-item">Базовый курс C#</li>
                        <li class="b-resume__course-menu-item">Базовый курс C++</li>
                        <li class="b-resume__course-menu-item">Базовый курс IOS</li>
                        <li class="b-resume__course-menu-item">Базовый курс Java</li>
                        <li class="b-resume__course-menu-item">Базовый курс PHP</li>
                        <li class="b-resume__course-menu-item">Базовый курс Python</li>
                        <li class="b-resume__course-menu-item">Базовый курс QA</li>
                        <li class="b-resume__course-menu-item">Веб-разработка на Python/Django</li>
                        <li class="b-resume__course-menu-item">Графический дизайн</li>
                        <li class="b-resume__course-menu-item">Курс "Маленький интеллектуал" (2 класс)</li>
                        <li class="b-resume__course-menu-item">Курс "Маленький интеллектуал" (3 класс)</li>
                        <li class="b-resume__course-menu-item">Курс "Маленький интеллектуал" (4 класс)</li>
                        <li class="b-resume__course-menu-item">Курс HTML &amp; CSS</li>
                        <li class="b-resume__course-menu-item">Курс HTML5 &amp; CSS3</li>
                        <li class="b-resume__course-menu-item">Курс контекстной рекламы</li>
                        <li class="b-resume__course-menu-item">Курсы по созданию сайтов для 5-7 классов</li>
                        <li class="b-resume__course-menu-item">Курсы программирования для 8-10 классов</li>
                        <li class="b-resume__course-menu-item">Основы программирования</li>
                        <li class="b-resume__course-menu-item">Основы дизайна и графические редакторы</li>
                        <li class="b-resume__course-menu-item">Программирование под Android (базовый)</li>
                        <li class="b-resume__course-menu-item">Программирование под Android (продвинутый)</li>
                        <li class="b-resume__course-menu-item">Программирование на R for Data Science</li>
                        <li class="b-resume__course-menu-item">Продвинутый курс C#</li>
                        <li class="b-resume__course-menu-item">Продвинутый курс C++</li>
                        <li class="b-resume__course-menu-item">Продвинутый курс IOS</li>
                        <li class="b-resume__course-menu-item">Продвинутый курс Java</li>
                        <li class="b-resume__course-menu-item">Продвинутый курс PHP</li>
                        <li class="b-resume__course-menu-item">Продвинутый курс Python</li>
                        <li class="b-resume__course-menu-item">Продвинутый курс QA</li>
                        <li class="b-resume__course-menu-item">Разработка Java веб-приложений</li>
                        <li class="b-resume__course-menu-item">Геймдизайн</li>
                        <li class="b-resume__course-menu-item">Big Data</li>
                    </ul>
                </div>
            </div>
          </div>

         <div class="b-resume-form-wrapper col-md-12">
            <div class="b-resume-left-heading col-md-4 col-sm-12 col-xs-12">
                <h3 class="required-field__label">Знания <br>и навыки</h3>
            </div>
            <div class="b-resume-form-right-block col-md-8 col-sm-12 col-xs-12">
                <div id="textarea" class="b-resume-textarea">
                    <input type="text" name="tag_cloud" id="mySingleFieldTags" maxlength="1900">
                </div>
            </div>
         </div>
             <div class="col-md-12">
                 <div class="b-resume-left-heading col-md-4 col-sm-12 col-xs-12">
                     <h3 class="required-field__label">Личные<br>качества</h3>
                 </div>
                 <div class="b-resume-form-right-block col-md-8 col-sm-12 col-xs-12">
                     <textarea name="personal_qualities" rows="3" maxlength="1900" class="regular_input check_error b-resume__textarea" id="personal_qualities"></textarea>
                 </div>
             </div>
         <div class="col-md-12" id="cv-eng-level">
            <div class="b-resume-left-heading col-md-4 col-sm-12 col-xs-12">
                <h3 class="required-field__label">Уровень <br>английского</h3>
            </div>
            <div class="b-resume-form-right-block col-md-8 col-sm-12 col-xs-12">
              <div class="b-resume-form-english__item">

                  <input type="radio" name="eng" value="1" id="beg">
                  <label for="beg">
                    <p class="b-cv-level">
                        <div class="level-wrapper">
                           <p>BEGINNER</p>
                        </div>

                          <strong>Начальный <br>уровень</strong>
                      </p>
                  </label>
              </div>
              <div class="b-resume-form-english__item">
                  <input type="radio" name="eng" value="2" id="pre-int">
                  <label for="pre-int">
                    <p class="b-cv-level">
                        <div class="level-wrapper">
                           <p>PRE-<br>INTERMEDIATE</p>
                        </div>

                          <strong>Элементарный<br>уровень</strong>
                      </p>
                  </label>
               </div>
              <div class="b-resume-form-english__item">
                  <input type="radio" name="eng" value="3" id="int">
                  <label for="int">
                    <p class="b-cv-level">
                        <div class="level-wrapper">
                           <p>INTERMEDIATE</p>
                        </div>

                          <strong>Средний<br>уровень</strong>
                      </p>
                  </label>
              </div>
              <div class="b-resume-form-english__item">
                  <input type="radio" name="eng" value="4" id="upper-int">
                  <label for="upper-int">
                     <p class="b-cv-level">
                        <div class="level-wrapper">
                           <p>UPPER INTERMEDIATE</p>
                        </div>

                          <strong>Высокий <br>уровень</strong>
                      </p>
                  </label>
              </div>
              <div class="b-resume-form-english__item">
                  <input type="radio" name="eng" value="5" id="adv">
                  <label for="adv">
                   <p class="b-cv-level">
                        <div class="level-wrapper">
                           <p>ADVANCED</p>
                        </div>

                          <strong>Продвинутый <br>уровень</strong>
                      </p>
                  </label>
              </div>

            </div>
         </div>

         <div class="col-md-12" id="pub-offer-block">
            <div class="b-resume-left-heading col-md-4 col-sm-12 col-xs-12">
                <h3 class="required-field__label">Публичная<br>оферта</h3>
            </div>
            <div class="b-resume-form-right-block col-md-8 col-sm-12 col-xs-12">
                <p class="b-survey-choose-c">Вы согласны с<a href="/wp-content/uploads/2017/03/Publichnaya-offerta.pdf" target="_blank">условиями публичной оферты</a>?</p>
            </div>
            <div class="b-resume-input-div col-md-6 col-sm-6 col-xs-6 b-resume-pub-offer">
                <input type="checkbox" name="public_offer" value="consent" id="pub-offer">
                <label for="pub-offer">Да</label>
            </div>
         </div>

         <div class="col-md-12 b-croppie-upload">
                <div class="actions">
                    <div class="file-btn">
                        <label class="file-upload hidden">
                          <input type="file" name="link_to_photo" id="upload" />
                          <input type="hidden" name="cropped_image" id="upload2" value="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEBLAEsAAD/4iOISUNDX1BST0ZJTEUAAQEAACN4bGNtcwIQAABtbnRyUkdCIFhZWiAH3wALAAoADAASADhhY3NwKm5peAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA9tYAAQAAAADTLWxjbXMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAtkZXNjAAABCAAAALBjcHJ0AAABuAAAARJ3dHB0AAACzAAAABRjaGFkAAAC4AAAACxyWFlaAAADDAAAABRiWFlaAAADIAAAABRnWFlaAAADNAAAABRyVFJDAAADSAAAIAxnVFJDAAADSAAAIAxiVFJDAAADSAAAIAxjaHJtAAAjVAAAACRkZXNjAAAAAAAAABxzUkdCLWVsbGUtVjItc3JnYnRyYy5pY2MAAAAAAAAAAAAAAB0AcwBSAEcAQgAtAGUAbABsAGUALQBWADIALQBzAHIAZwBiAHQAcgBjAC4AaQBjAGMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAHRleHQAAAAAQ29weXJpZ2h0IDIwMTUsIEVsbGUgU3RvbmUgKHdlYnNpdGU6IGh0dHA6Ly9uaW5lZGVncmVlc2JlbG93LmNvbS87IGVtYWlsOiBlbGxlc3RvbmVAbmluZWRlZ3JlZXNiZWxvdy5jb20pLiBUaGlzIElDQyBwcm9maWxlIGlzIGxpY2Vuc2VkIHVuZGVyIGEgQ3JlYXRpdmUgQ29tbW9ucyBBdHRyaWJ1dGlvbi1TaGFyZUFsaWtlIDMuMCBVbnBvcnRlZCBMaWNlbnNlIChodHRwczovL2NyZWF0aXZlY29tbW9ucy5vcmcvbGljZW5zZXMvYnktc2EvMy4wL2xlZ2FsY29kZSkuAAAAAFhZWiAAAAAAAAD21gABAAAAANMtc2YzMgAAAAAAAQxCAAAF3v//8yUAAAeTAAD9kP//+6H///2iAAAD3AAAwG5YWVogAAAAAAAAb6AAADj1AAADkFhZWiAAAAAAAAAknwAAD4QAALbEWFlaIAAAAAAAAGKXAAC3hwAAGNljdXJ2AAAAAAAAEAAAAAABAAIABAAFAAYABwAJAAoACwAMAA4ADwAQABEAEwAUABUAFgAYABkAGgAbABwAHgAfACAAIQAjACQAJQAmACgAKQAqACsALQAuAC8AMAAyADMANAA1ADcAOAA5ADoAOwA9AD4APwBAAEIAQwBEAEUARwBIAEkASgBMAE0ATgBPAFEAUgBTAFQAVQBXAFgAWQBaAFwAXQBeAF8AYQBiAGMAZABmAGcAaABpAGsAbABtAG4AbwBxAHIAcwB0AHYAdwB4AHkAewB8AH0AfgCAAIEAggCDAIUAhgCHAIgAiQCLAIwAjQCOAJAAkQCSAJMAlQCWAJcAmACaAJsAnACdAJ8AoAChAKIApAClAKYApwCoAKoAqwCsAK0ArwCwALEAsgC0ALUAtgC3ALkAugC7ALwAvgC/AMAAwQDCAMQAxQDGAMcAyQDKAMsAzADOAM8A0ADRANMA1ADVANcA2ADZANoA3ADdAN4A4ADhAOIA5ADlAOYA6ADpAOoA7ADtAO8A8ADxAPMA9AD2APcA+AD6APsA/QD+AP8BAQECAQQBBQEHAQgBCgELAQ0BDgEPAREBEgEUARUBFwEYARoBGwEdAR8BIAEiASMBJQEmASgBKQErAS0BLgEwATEBMwE0ATYBOAE5ATsBPAE+AUABQQFDAUUBRgFIAUoBSwFNAU8BUAFSAVQBVQFXAVkBWgFcAV4BYAFhAWMBZQFnAWgBagFsAW4BbwFxAXMBdQF2AXgBegF8AX4BfwGBAYMBhQGHAYkBigGMAY4BkAGSAZQBlgGXAZkBmwGdAZ8BoQGjAaUBpwGpAasBrAGuAbABsgG0AbYBuAG6AbwBvgHAAcIBxAHGAcgBygHMAc4B0AHSAdQB1gHYAdoB3AHeAeEB4wHlAecB6QHrAe0B7wHxAfMB9QH4AfoB/AH+AgACAgIEAgcCCQILAg0CDwISAhQCFgIYAhoCHQIfAiECIwIlAigCKgIsAi4CMQIzAjUCOAI6AjwCPgJBAkMCRQJIAkoCTAJPAlECUwJWAlgCWgJdAl8CYQJkAmYCaQJrAm0CcAJyAnUCdwJ5AnwCfgKBAoMChgKIAosCjQKQApIClQKXApoCnAKfAqECpAKmAqkCqwKuArACswK1ArgCuwK9AsACwgLFAsgCygLNAs8C0gLVAtcC2gLdAt8C4gLkAucC6gLsAu8C8gL1AvcC+gL9Av8DAgMFAwgDCgMNAxADEwMVAxgDGwMeAyADIwMmAykDLAMuAzEDNAM3AzoDPQM/A0IDRQNIA0sDTgNRA1QDVgNZA1wDXwNiA2UDaANrA24DcQN0A3cDegN9A4ADggOFA4gDiwOOA5EDlAOYA5sDngOhA6QDpwOqA60DsAOzA7YDuQO8A78DwgPFA8kDzAPPA9ID1QPYA9sD3wPiA+UD6APrA+4D8gP1A/gD+wP+BAIEBQQIBAsEDwQSBBUEGAQcBB8EIgQlBCkELAQvBDMENgQ5BD0EQARDBEcESgRNBFEEVARXBFsEXgRiBGUEaARsBG8EcwR2BHkEfQSABIQEhwSLBI4EkgSVBJkEnASgBKMEpwSqBK4EsQS1BLgEvAS/BMMExgTKBM4E0QTVBNgE3ATgBOME5wTqBO4E8gT1BPkE/QUABQQFCAULBQ8FEwUWBRoFHgUiBSUFKQUtBTEFNAU4BTwFQAVDBUcFSwVPBVIFVgVaBV4FYgVmBWkFbQVxBXUFeQV9BYEFhAWIBYwFkAWUBZgFnAWgBaQFqAWsBa8FswW3BbsFvwXDBccFywXPBdMF1wXbBd8F4wXnBesF7wX0BfgF/AYABgQGCAYMBhAGFAYYBhwGIQYlBikGLQYxBjUGOQY+BkIGRgZKBk4GUwZXBlsGXwZjBmgGbAZwBnQGeQZ9BoEGhQaKBo4GkgaXBpsGnwakBqgGrAaxBrUGuQa+BsIGxgbLBs8G1AbYBtwG4QblBuoG7gbyBvcG+wcABwQHCQcNBxIHFgcbBx8HJAcoBy0HMQc2BzoHPwdDB0gHTQdRB1YHWgdfB2MHaAdtB3EHdgd7B38HhAeJB40HkgeXB5sHoAelB6kHrgezB7cHvAfBB8YHygfPB9QH2QfdB+IH5wfsB/EH9Qf6B/8IBAgJCA0IEggXCBwIIQgmCCsILwg0CDkIPghDCEgITQhSCFcIXAhhCGYIawhwCHUIegh/CIQIiQiOCJMImAidCKIIpwisCLEItgi7CMAIxQjKCM8I1AjZCN8I5AjpCO4I8wj4CP0JAwkICQ0JEgkXCR0JIgknCSwJMQk3CTwJQQlGCUwJUQlWCVsJYQlmCWsJcQl2CXsJgQmGCYsJkQmWCZsJoQmmCasJsQm2CbwJwQnGCcwJ0QnXCdwJ4gnnCe0J8gn4Cf0KAgoICg0KEwoZCh4KJAopCi8KNAo6Cj8KRQpKClAKVgpbCmEKZgpsCnIKdwp9CoMKiAqOCpQKmQqfCqUKqgqwCrYKvArBCscKzQrTCtgK3grkCuoK7wr1CvsLAQsHCwwLEgsYCx4LJAsqCy8LNQs7C0ELRwtNC1MLWQtfC2QLagtwC3YLfAuCC4gLjguUC5oLoAumC6wLsgu4C74LxAvKC9AL1gvcC+IL6QvvC/UL+wwBDAcMDQwTDBkMIAwmDCwMMgw4DD4MRQxLDFEMVwxdDGQMagxwDHYMfQyDDIkMjwyWDJwMogyoDK8MtQy7DMIMyAzODNUM2wzhDOgM7gz1DPsNAQ0IDQ4NFQ0bDSENKA0uDTUNOw1CDUgNTw1VDVwNYg1pDW8Ndg18DYMNiQ2QDZYNnQ2kDaoNsQ23Db4NxQ3LDdIN2Q3fDeYN7A3zDfoOAQ4HDg4OFQ4bDiIOKQ4vDjYOPQ5EDkoOUQ5YDl8OZg5sDnMOeg6BDogOjg6VDpwOow6qDrEOuA6+DsUOzA7TDtoO4Q7oDu8O9g79DwQPCw8SDxkPIA8nDy4PNQ88D0MPSg9RD1gPXw9mD20PdA97D4IPiQ+QD5gPnw+mD60PtA+7D8IPyg/RD9gP3w/mD+0P9Q/8EAMQChASEBkQIBAnEC8QNhA9EEQQTBBTEFoQYhBpEHAQeBB/EIYQjhCVEJ0QpBCrELMQuhDCEMkQ0BDYEN8Q5xDuEPYQ/REFEQwRFBEbESMRKhEyETkRQRFIEVARVxFfEWcRbhF2EX0RhRGNEZQRnBGkEasRsxG7EcIRyhHSEdkR4RHpEfAR+BIAEggSDxIXEh8SJxIuEjYSPhJGEk4SVRJdEmUSbRJ1En0ShBKMEpQSnBKkEqwStBK8EsQSzBLUEtsS4xLrEvMS+xMDEwsTExMbEyMTKxMzEzsTRBNME1QTXBNkE2wTdBN8E4QTjBOUE50TpROtE7UTvRPFE80T1hPeE+YT7hP2E/8UBxQPFBcUIBQoFDAUOBRBFEkUURRaFGIUahRzFHsUgxSMFJQUnBSlFK0UthS+FMYUzxTXFOAU6BTxFPkVARUKFRIVGxUjFSwVNBU9FUUVThVXFV8VaBVwFXkVgRWKFZMVmxWkFawVtRW+FcYVzxXYFeAV6RXyFfoWAxYMFhQWHRYmFi8WNxZAFkkWUhZaFmMWbBZ1Fn4WhhaPFpgWoRaqFrMWuxbEFs0W1hbfFugW8Rb6FwMXDBcUFx0XJhcvFzgXQRdKF1MXXBdlF24XdxeAF4kXkhecF6UXrhe3F8AXyRfSF9sX5BftF/cYABgJGBIYGxgkGC4YNxhAGEkYUhhcGGUYbhh3GIEYihiTGJwYphivGLgYwhjLGNQY3hjnGPAY+hkDGQwZFhkfGSkZMhk7GUUZThlYGWEZaxl0GX4ZhxmRGZoZpBmtGbcZwBnKGdMZ3RnmGfAZ+hoDGg0aFhogGioaMxo9GkYaUBpaGmMabRp3GoEaihqUGp4apxqxGrsaxRrOGtga4hrsGvUa/xsJGxMbHRsnGzAbOhtEG04bWBtiG2wbdRt/G4kbkxudG6cbsRu7G8UbzxvZG+Mb7Rv3HAEcCxwVHB8cKRwzHD0cRxxRHFscZRxwHHochByOHJgcohysHLYcwRzLHNUc3xzpHPQc/h0IHRIdHB0nHTEdOx1FHVAdWh1kHW8deR2DHY4dmB2iHa0dtx3BHcwd1h3hHesd9R4AHgoeFR4fHioeNB4+HkkeUx5eHmgecx59Hogekx6dHqgesh69Hsce0h7cHuce8h78HwcfEh8cHycfMh88H0cfUh9cH2cfch98H4cfkh+dH6cfsh+9H8gf0h/dH+gf8x/+IAggEyAeICkgNCA/IEogVCBfIGogdSCAIIsgliChIKwgtyDCIM0g2CDjIO4g+SEEIQ8hGiElITAhOyFGIVEhXCFnIXIhfiGJIZQhnyGqIbUhwCHMIdch4iHtIfgiBCIPIhoiJSIwIjwiRyJSIl4iaSJ0In8iiyKWIqEirSK4IsMizyLaIuYi8SL8IwgjEyMfIyojNSNBI0wjWCNjI28jeiOGI5EjnSOoI7QjvyPLI9Yj4iPuI/kkBSQQJBwkKCQzJD8kSyRWJGIkbiR5JIUkkSScJKgktCS/JMsk1yTjJO4k+iUGJRIlHiUpJTUlQSVNJVklZSVwJXwliCWUJaAlrCW4JcQl0CXcJecl8yX/JgsmFyYjJi8mOyZHJlMmXyZrJncmhCaQJpwmqCa0JsAmzCbYJuQm8Cb9JwknFSchJy0nOSdGJ1InXidqJ3YngyePJ5snpye0J8AnzCfZJ+Un8Sf9KAooFigjKC8oOyhIKFQoYChtKHkohiiSKJ4oqyi3KMQo0CjdKOko9ikCKQ8pGykoKTQpQSlNKVopZylzKYApjCmZKaYpsim/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ZNRk6WT+ZRNlKWU+ZVNlaGV9ZZNlqGW9ZdJl6GX9ZhJmJ2Y9ZlJmZ2Z9ZpJmp2a9ZtJm6Gb9ZxJnKGc9Z1NnaGd+Z5NnqWe+Z9Rn6Wf/aBRoKmg/aFVoamiAaJZoq2jBaNZo7GkCaRdpLWlDaVhpbmmEaZlpr2nFadtp8GoGahxqMmpIal1qc2qJap9qtWrKauBq9msMayJrOGtOa2RremuQa6ZrvGvSa+hr/mwUbCpsQGxWbGxsgmyYbK5sxGzabPBtBm0cbTNtSW1fbXVti22hbbhtzm3kbfpuEW4nbj1uU25qboBulm6tbsNu2W7wbwZvHG8zb0lvYG92b4xvo2+5b9Bv5m/9cBNwKnBAcFdwbXCEcJpwsXDHcN5w9HELcSJxOHFPcWZxfHGTcapxwHHXce5yBHIbcjJySHJfcnZyjXKkcrpy0XLocv9zFnMsc0NzWnNxc4hzn3O2c81z5HP6dBF0KHQ/dFZ0bXSEdJt0snTJdOB093UOdSZ1PXVUdWt1gnWZdbB1x3XedfZ2DXYkdjt2UnZqdoF2mHavdsd23nb1dwx3JHc7d1J3aneBd5h3sHfHd9539ngNeCV4PHhUeGt4gniaeLF4yXjgePh5D3kneT55VnlueYV5nXm0ecx543n7ehN6KnpCelp6cXqJeqF6uHrQeuh7AHsXey97R3tfe3Z7jnume7571nvufAV8HXw1fE18ZXx9fJV8rXzFfNx89H0MfSR9PH1UfWx9hH2cfbR9zX3lff1+FX4tfkV+XX51fo1+pX6+ftZ+7n8Gfx5/N39Pf2d/f3+Xf7B/yH/gf/mAEYApgEGAWoBygIqAo4C7gNSA7IEEgR2BNYFOgWaBf4GXgbCByIHhgfmCEoIqgkOCW4J0goyCpYK+gtaC74MHgyCDOYNRg2qDg4Obg7SDzYPlg/6EF4QwhEiEYYR6hJOErITEhN2E9oUPhSiFQYVahXKFi4Wkhb2F1oXvhgiGIYY6hlOGbIaFhp6Gt4bQhumHAocbhzSHTYdnh4CHmYeyh8uH5If9iBeIMIhJiGKIe4iViK6Ix4jgiPqJE4ksiUaJX4l4iZGJq4nEid6J94oQiiqKQ4pdinaKj4qpisKK3Ir1iw+LKItCi1uLdYuOi6iLwovbi/WMDowojEKMW4x1jI+MqIzCjNyM9Y0PjSmNQo1cjXaNkI2pjcON3Y33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"/>
                          <span>Выберите файл</span>
                        </label>
                    </div>
                    <div class="crop">
                        <div class="b-resume-left-heading col-md-4 col-sm-12 col-xs-12">
                            <h3 class="required-field__label">Фото<br>профиля</h3>
                            <p style="text-align: right;padding-right: 35px;">Размер фото не должен<br ct-phonet="true"> превышать 2мб</p>
                        </div>
                        <div id="upload-demo">
                            <label></label>
                        </div>
                        <div id="result" class="croppie-result"></div>
                        <div class="upload-result-btn"><span class="upload-result">Обрезать</span></div>
                    </div>

                </div>
         </div>
         <div class="col-md-12 fill-out-wrapper">
             <span id="fill-out-third"></span><br>
         </div>

         <div id="third-step-btn">
            <a href="">
                К предыдущему шагу
                <span><img src="/wp-content/themes/new-it/relize/img/icons/cv-right-arrow.png"></span>
            </a>
            <a href="">
                <input type="submit" value="Получить резюме" id="b-resume-form--create">
                <span><img src="/wp-content/themes/new-it/relize/img/icons/cv-left-arrow.png"></span>
            </a>
         </div>
         </div>
        </form>
       </div>
     </div>
    </div>

<?php
$listCourses = '';
$posts = get_posts( array(
    'numberposts'     => -1,
    'category'        => '22',
    'post_type'       => 'post',
    'orderby'         => 'title'
) );
foreach($posts as $post){
    setup_postdata($post);
    $listCourses .= "'".$post->post_title."',";
}
$listCourses = str_replace('&#038;', '&', $listCourses);
wp_reset_postdata();
?>

<template>
    <div id="myApp">
        <v-select :value.sync="selected" :options="options"></v-select>
    </div>
</template>

<script src="<?php bloginfo('template_directory'); ?>/relize/js/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/relize/js/tags.min_v2.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/masked-input.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/relize/js/croppie.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/for_resume_v10.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/resume_composing.js"></script>

    <?php if(false) { //dev block?>
    <script>
        //to pass entering data while testing/development
        document.body.onload = passTheForm;

        function passTheForm() {
            console.log('filling the form');
            var resumeEls = { name: 'FirstName SecName', date_birth: '222222', email: 'test@mail.com', phone: '2222222222', address: 'st. Adress, bld. 5', about_me: 'User self description', edu1_names: 'edu names, edu namehere2', edu1_specialties: 'education specialities' };
            var form = document.getElementById('student-cv-form');
            var els = form.elements;
            for(var el in resumeEls) {
                els[el].value = resumeEls[el]
            }
            //this is fast KOSTIL but for dev its OK
            setTimeout(function() {
                document.querySelector('#first-step-btn a').click();
                document.querySelector('#second-step-btn a:last-of-type').click();
            },100);
        }
    </script>
    <?php } ?>
<?php
    get_footer();
}
?>
