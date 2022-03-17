<?php
if (array_key_exists('email', $_POST)) {
    $check = array( 'miroslav@itea.ua',
                    'nykolay@itea.ua',
                    'nykolay@gns-it.com',
                    'natalja.kalaputs@itea.ua',
                    'alexandr.kalugnyi@itea.ua',
                    'lemishevskaya.elena@itea.ua',
                    'anastasiia.pasichnyk@itea.ua',
                    'anna.korol@itea.ua',
                    'yarina.ryzhova@itea.ua',
                    'nadezhda.episheva@itea.ua',
    );
    $email = trim(htmlspecialchars($_POST['email']));
    if (in_array($email, $check)) {
        $filepath = '/var/www/html/iteaua_pr/wp-content/uploads/';
        $filename = 'for.excel.'.date('d.m.Y').'.csv';
        $result = fopen($filepath.$filename, 'w');
        $list = array(
                    'Дата опроса',
                    'Название курса',
                    'Инструктор',
                    'Дата курса',
                    'ФИО слушателя',
                    'Телефон',
                    'Дата рождения',
                    'E-mail',
                    'Актуальные курсы',
                    'В целом доволен курсом',
                    'Курс соответствовал ожиданиям',
                    'Порекомендовал бы этот курс',
                    'Применимость знаний на моей работе',
                    'Учебный материал скомпонован понятно и логично',
                    'Обьем изложенного материала достаточный',
                    'Работа преподавателя в целом',
                    'Теоретические знания преподавателя',
                    'Практические знания преподавателя',
                    'Преподаватель использовал примеры из личного опыта',
                    'Практические задания',
                    'Комфорт работы в учебном классе',
                    'Доволен уровнем организации курса',
                    'Доволен работой персонала центра',
                    'Поиск работы в IT',
                    'Достаточно ли инф. на itea.ua',
                    'Подписка по email',
                    'Стать ментором',
                    'Комментарий'
        );
        function change_encoding($val)
        {
            return iconv('UTF-8', 'Windows-1251', $val);
        }
        $list = array_map('change_encoding', $list);
        fputcsv($result, $list, ';');

        $where = '';
        if (array_key_exists('date1', $_POST) && !empty($_POST['date1'])) {
            $where .= " WHERE date_time >= STR_TO_DATE('".trim(htmlspecialchars($_POST['date1']))." 00:00:00', '%Y-%m-%d %H:%i:%s')";
        }
        if (array_key_exists('date2', $_POST) && !empty($_POST['date2'])) {
            $where .= (empty($where) ? " WHERE " : ' AND ');
            $where .= "date_time <= STR_TO_DATE('".trim(htmlspecialchars($_POST['date2']))." 23:59:59', '%Y-%m-%d %H:%i:%s')";
        }

        global $wpdb;
        $table_name = $wpdb->get_blog_prefix() . 'interview';
        $interview  = $wpdb->get_results('SELECT date_time,id_course,name_inst,course_date,name_stud,phone,date_of_birth,email,actual_courses,marks,job_search,enough_info,delivery,mentoring,comment'.
            ' FROM '.$table_name.
            $where, ARRAY_A);

        $interview = stripslashes_deep($interview);
        foreach ($interview as $line) {
            $row = array();
            $row[0] = $line['date_time'];
            $row[1] = get_the_title($line['id_course']);
            $row[2] = $line['name_inst'];
            $row[3] = $line['course_date'];
            $row[4] = $line['name_stud'];
            $row[5] = $line['phone'];
            $row[6] = $line['date_of_birth'];
            $row[7] = $line['email'];
            $row[8] = $line['actual_courses'];
            $marks   = json_decode($line['marks']);
            $row[9]  = $marks[0];
            $row[10] = $marks[1];
            $row[11] = $marks[2];
            $row[12] = $marks[3];
            $row[13] = $marks[4];
            $row[14] = $marks[5];
            $row[15] = $marks[6];
            $row[16] = $marks[7];
            $row[17] = $marks[8];
            $row[18] = $marks[9];
            $row[19] = $marks[10];
            $row[20] = $marks[11];
            $row[21] = $marks[12];
            $row[22] = $marks[13];
            $row[23] = ($line['job_search']  == '1' ? 'Да' : 'Нет');
            $row[24] = ($line['enough_info'] == '1' ? 'Да' : ($line['enough_info'] == '2' ? 'Не посещаю' : 'Нет'));
            $row[25] = ($line['delivery']  == '1' ? 'Да' : 'Нет');
            $row[26] = ($line['mentoring'] == '1' ? 'Да' : 'Нет');
            $row[27] = $line['comment'];
            $row = array_map('change_encoding', $row);
            fputcsv($result, $row, ';');
        }
        fclose($result);

        $theme = 'Опросы с itea.ua/interview';
        $boundary = '--'.md5(uniqid());
        $headers  = 'MIME-Version: 1.0;' . "\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
        $headers .= 'From: ITEA <itea_interview@mail.gns-it.com>' . "\r\n";

        $result = fopen($filepath.$filename, 'r');
        $file   = fread($result, filesize($filepath.$filename));
        fclose($result);

        $multipart  = "\r\n--$boundary\r\n";
        $multipart .= "Content-Type: application/octet-stream; name=\"$filename\"\r\n";
        $multipart .= "Content-Transfer-Encoding: base64\r\n";
        $multipart .= "Content-Disposition: attachment; filename=\"$filename\"\r\n";
        $multipart .= "\r\n";
        $multipart .= chunk_split(base64_encode($file));
        $multipart .= "\r\n--$boundary--\r\n";

        mail($email, $theme, $multipart, $headers);

        if (is_file($filepath.$filename)) {
                    unlink($filepath.$filename);
        }

        echo '<br><h1 align="center">The file is sent to your email.</h1>';
    } else {
        echo '<br><h1 align="center">access denied!</h1>';
    }
} elseif (array_key_exists('itea', $_GET)) {
    ?>
    <br><center><form method="post">
        <input type="email" name="email" size="46" placeholder=" enter your e-mail" value=""><br><br>
        <input type="date" name="date1" placeholder=" from date" value="">
        <input type="date" name="date2" placeholder=" to date" value=""><br><br>
        <input type="submit" value="download file">
    </form></center>
    <?php
} else {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="private">
    <meta name="format-detection" content="telephone=no">
    <meta name="robots" content="noindex">
    <title><?php wp_title(); ?></title>
    <link rel="icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/resume_v7.css" />
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/survey_v5.css" />

    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/relize/js/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/relize/js/jquery-ui/tag-it.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/relize/js/jquery-ui/zendesk.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/js/jquery-bar/dist/themes/fontawesome-stars.css">

    <!--[if IE]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css"><![endif]-->
</head>
<body>
        <div id="loading"><div id="loading-animation"></div></div>
    <main id="b-survey-main">
        <div class="b-survey-container container">
          <div class="b-survey-wrapper">
            <h1 class="b-survey-heading">
                <?php echo get_the_title() ?>
            </h1>
            <div class="b-survey-holder">
                <div class="b-survey-holder-top">
                  <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/survey-logo.png" alt="survey"/>
                </div><!-- black top -->
             <form id="survey-form" method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
              <input type="hidden" name="action" value="interview">
              <input type="hidden" name="verification" value="<?php echo wp_create_nonce('I_am_a_student_ITEA!'); ?>">
              <!-- first survey step BEGIN -->
              <div class="b-resume-form-wrapper col-md-12 active" id="first-step-wrapper">
                <div class="col-md-12 b-survey-step-holder" id="b-survey-first-step">
                  <div class="steps-container">
                    <div class="steps-container--inner">
                       <div class="col-md-2 col-xs-12 red-circle-wrapper">
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
                       <div class="col-md-1 grey-circle">
                          <div>
                           <span></span>
                           <span></span>
                           <span></span>
                          </div>
                       </div>
                        <div class="col-md-2 big-grey-circle-wrapper">
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
                       <div class="col-md-1 grey-circle">
                         <div>
                           <span></span>
                           <span></span>
                           <span></span>
                         </div>
                       </div>
                      <div class="col-md-2 big-grey-circle-wrapper">
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
                            Оценка<br>курса
                         </p>
                       </div>
                        <div class="col-md-1 grey-circle">
                         <div>
                           <span></span>
                           <span></span>
                           <span></span>
                         </div>
                       </div>
                       <div class="col-md-2 big-grey-circle-wrapper">
                         <div class="big-grey-circle-inner-container">
                            <div class="big-grey-circle">
                               <p>
                               04
                               <span>
                                  шаг
                               </span>
                             </p>
                            </div>
                          </div>
                         <p class="big-grey-circle-desc">
                            Оценка<br>преподавателя
                         </p>
                       </div>
                        <div class="col-md-1 grey-circle">
                         <div>
                           <span></span>
                           <span></span>
                           <span></span>
                         </div>
                       </div>
                       <div class="col-md-2 big-grey-circle-wrapper">
                         <div class="big-grey-circle-inner-container">
                            <div class="big-grey-circle">
                               <p>
                               05
                               <span>
                                  шаг
                               </span>
                             </p>
                            </div>
                          </div>
                         <p class="big-grey-circle-desc">
                            Ваши<br>рекомендации
                         </p>
                       </div>
                    </div>
                  </div><!-- 1 round steps END -->
                    <div class="survey-fill-out-wrapper">
                        <span id="survey-fill-out"></span>
                    </div>
                    <div class="b-survey-input-container">
                      <div class="b-survey-input-wrapper">
                          <div class="b-survey-left-heading col-md-2 col-sm-12 col-xs-12">
                           <h3>Основные<br>данные</h3>
                          </div>
                          <div class="b-resume-form-right-block col-md-10 col-sm-12 col-xs-12">
                            <div class="b-resume-input-div survey-select">
                                <span class="survey-required__label">
                                 01 Название курса
                                </span>
                                <div id="courses-list" class="survey_check_error">
                                    <span class="arrow glyphicon glyphicon-menu-down"></span>
                                    <div class="courses-list-option-default">Выберите курс</div>
                                    <div class="courses-list-set">
                                        <input type="text" placeholder="Поиск">
                                        <input name="id_course" type="text" style="display: none;">
                                        <?php
                                        $posts = get_posts([
                                            'numberposts' => -1,
                                            'category'    => '22',
                                            'post_type'   => 'post',
                                            'post_status' => 'publish',
                                            'orderby'     => 'title',
                                        ]);

                                        $options_id = [];
                                        foreach ($posts as $_post) {
                                            $options_id[] = $_post->ID;
                                            echo '<div class="courses-list-option">' . $_post->post_title . '</div>';
                                        }
                                        ?>
                                    </div>
                                    <script>
                                        (function() {
                                            var list = document.querySelector('.courses-list-option-default');
                                            list.addEventListener('click', function(e) {
                                                toggleList();
                                            });
                                            var inp = document.querySelector('#courses-list input'),
                                                options = document.querySelectorAll('#courses-list .courses-list-option'),
                                                data = <?php echo json_encode($options_id); ?>;
                                            for(var i = 0; i < options.length; i++) {
                                                (function(i) {
                                                    options[i].addEventListener('click', function(e) {
                                                        document.querySelector('.courses-list-option-default').innerText = e.target.innerText;
                                                        toggleList();
                                                        document.querySelector('.courses-list-option-default').style.borderColor = 'rgb(0, 166, 81)';
                                                        (document.getElementById('courses-list')).classList.remove('survey_check_error');
                                                        document.querySelector('#courses-list input[name=id_course]').value = data[i];
                                                    });
                                                })(i)
                                            }

                                            inp.addEventListener('input', function(e) {
                                                //Search implementation on Course Name
                                                var reg = new RegExp(e.target.value, 'i');
                                                for(var key in options) {
                                                    if(!options.hasOwnProperty( key )) continue;

                                                    if(!reg.test(options[key].innerText)) {
                                                        options[key].style.display = 'none';
                                                    } else {
                                                        options[key].style.display = 'block';
                                                    }
                                                }
                                            });

                                            function toggleList() {
                                                $('.courses-list-set').toggleClass('active');
                                            }

                                            function setId(i) {
                                                return (function(id) {
                                                    console.log(data[id]);
                                                })(i)
                                            }
                                        })();
                                    </script>
                                </div>
                            </div>
                            <div class="b-resume-input-div">
                                <span>
                                02
                                </span>
                                <input name="name_inst" class="survey_check_error" autocomplete="off" type="text" max="254" placeholder="" id="survey-coach">
                                <p class="placeholder survey-required__label">ФИО инструктора</p>
                            </div>
                          </div>
                      </div><!-- survey input wrapper END -->
                    </div><!-- survey input container END -->
                    <div class="b-survey-input-container">
                        <div class="b-survey-input-wrapper">
                          <div class="b-survey-left-heading col-md-2 col-sm-12 col-xs-12">
                           <h3>Личные<br>данные</h3>
                          </div>
                          <div class="b-resume-form-right-block col-md-10 col-sm-12 col-xs-12">
                            <div class="b-resume-input-div">
                                <span>
                                01
                                </span>
                                <input name="name_stud" class="survey_check_error" autocomplete="off" type="text" max="254" placeholder="" id="survey-listener">
                                <p class="placeholder survey-required__label">ФИО слушателя</p>
                            </div>
                            <div class="b-resume-input-div">
                                <span>
                                02
                                </span>
                                <input name="phone" class="survey_check_error" autocomplete="off" type="text" max="254" placeholder="" id="survey-tel">
                                <p class="placeholder survey-required__label">Телефон</p>
                            </div>
                            <div class="b-resume-input-div">
                                <span>
                                03
                                </span>
                                <input name="date_of_birth" class="survey_check_error" autocomplete="off" type="text" max="254" placeholder="" id="survey-birth">
                                <p class="placeholder survey-required__label">Дата рождения</p>
                            </div>
                            <div class="b-resume-input-div">
                                <span>
                                04
                                </span>
                                <input name="email" class="survey_check_error" autocomplete="off" type="text" max="254" placeholder="" id="survey-email">
                                <p class="placeholder survey-required__label">E-mail</p>
                            </div>
                          </div>
                        </div><!-- survey input wrapper END -->
                    </div><!-- survey input container END -->

                    <div class="b-survey-next-btn">
                       <div id="survey-first-step-btn">
                          <a href="#" id="top">
                             К следующему шагу
                             <span><img src="/wp-content/themes/new-it/relize/img/icons/cv-left-arrow.png"></span>
                          </a>
                       </div>
                    </div>
                </div>
              </div>
              <!-- first survey step end -->

              <!-- second survey step begin -->
              <div class="b-resume-form-wrapper col-md-12" id="second-step-wrapper">
                <div class="col-md-12 b-survey-step-holder" id="b-survey-second-step">
                  <div class="steps-container"><!-- second round steps begin -->
                    <div class="steps-container--inner">
                        <div class="col-md-2 big-grey-circle-wrapper">
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
                             <p class="big-grey-circle-desc">
                                Основные <br>данные
                             </p>
                           </div>
                           <div class="col-md-1 grey-circle">
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
                                Трудоустройство
                             </p>
                           </div>
                           <div class="col-md-1 grey-circle">
                             <div>
                               <span></span>
                               <span></span>
                               <span></span>
                             </div>
                           </div>
                          <div class="col-md-2 big-grey-circle-wrapper">
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
                                Оценка<br>курса
                             </p>
                           </div>
                            <div class="col-md-1 grey-circle">
                             <div>
                               <span></span>
                               <span></span>
                               <span></span>
                             </div>
                           </div>
                           <div class="col-md-2 big-grey-circle-wrapper">
                             <div class="big-grey-circle-inner-container">
                                <div class="big-grey-circle">
                                   <p>
                                   04
                                   <span>
                                      шаг
                                   </span>
                                 </p>
                                </div>
                              </div>
                             <p class="big-grey-circle-desc">
                                Оценка<br>преподавателя
                             </p>
                           </div>
                            <div class="col-md-1 grey-circle">
                             <div>
                               <span></span>
                               <span></span>
                               <span></span>
                             </div>
                           </div>
                           <div class="col-md-2 big-grey-circle-wrapper">
                             <div class="big-grey-circle-inner-container">
                                <div class="big-grey-circle">
                                   <p>
                                   05
                                   <span>
                                      шаг
                                   </span>
                                 </p>
                                </div>
                              </div>
                             <p class="big-grey-circle-desc">
                                Ваши<br>рекомендации
                             </p>
                           </div>
                       </div>
                      </div><!-- second round steps END-->
                      <div class="survey-fill-out-wrapper">
                            <span id="survey-fill-out-2"></span>
                      </div>
                                            <!-- survey input wrapper END -->
                <!-- </div>survey input container END -->
                        <div class="b-survey-input-container">
                            <div class="b-survey-input-wrapper">
                              <div class="b-survey-left-heading col-md-2 col-sm-12 col-xs-12">
                                <h3 class="survey-required__label">Работа<br>в ИТ</h3>
                              </div>
                              <div class="b-resume-form-right-block col-md-10 col-sm-12 col-xs-12">
                                    <p class="b-survey-choose-c">
                                            Нужна ли помощь в поиске работы?
                                    </p>

                                <div class="b-resume-input-div col-md-6 col-sm-6 col-xs-6 b-survey-job-search">
                                   <input type="radio" id="yes" value="yes" name="job_search" class="survey_check_error">
                                   <label for="yes">
                                       <p>Да</p>
                                   </label>
                                </div>
                                <div class="b-resume-input-div col-md-6 col-sm-6 col-xs-6 b-survey-job-search">
                                   <input type="radio" id="no" value="no" name="job_search" class="survey_check_error">
                                   <label for="no">
                                       <p>Нет</p>
                                   </label>
                                </div>
                              </div>
                            </div><!-- wrapper end -->
                        </div><!-- b-survey-input-container -->
                      <div class="b-survey-input-container">
                          <div class="b-survey-input-wrapper">
                              <div class="b-survey-left-heading col-md-2 col-sm-12 col-xs-12">
                                <h3>Интересующие<br>курсы</h3>
                              </div>
                              <div class="b-resume-form-right-block tag-cloud-wrapper col-md-10 col-sm-12 col-xs-12">
                                  <div class="b-resume-input-div completed-courses">
                                      <input type="text" name="actual_courses" id="actual-courses-tags" placeholder="Выберите хотя бы один курс">
                                  </div>
                              </div>
                          </div>
                      </div>
                        
                        <div id="survey-second-step-btn">
                          <a href="#" id="top1">
                            К предыдущему шагу
                            <span><img src="/wp-content/themes/new-it/relize/img/icons/cv-right-arrow.png"></span>
                          </a>
                          <a href="#" id="top2">
                            К следующему шагу
                            <span><img src="/wp-content/themes/new-it/relize/img/icons/cv-left-arrow.png"></span>
                          </a>
                        </div>
                </div><!-- second survey step end-->
              </div>
                <!-- third survey step begin -->
                <div class="b-resume-form-wrapper col-md-12" id="third-step-wrapper">
                    <div class="col-md-12 b-survey-step-holder" id="b-survey-third-step">
                        <div class="steps-container"><!-- third round steps begin -->
                    <div class="steps-container--inner">
                    <div class="col-md-2 big-grey-circle-wrapper">
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
                         <p class="big-grey-circle-desc">
                            Основные <br>данные
                         </p>
                       </div>
                       <div class="col-md-1 grey-circle">
                          <div>
                           <span></span>
                           <span></span>
                           <span></span>
                          </div>
                       </div>
                        <div class="col-md-2 big-grey-circle-wrapper">
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
                        <div class="col-md-1 grey-circle">
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
                            Оценка<br>курса
                         </p>
                       </div>
                       <div class="col-md-1 grey-circle">
                         <div>
                           <span></span>
                           <span></span>
                           <span></span>
                         </div>
                       </div>

                       <div class="col-md-2 big-grey-circle-wrapper">
                         <div class="big-grey-circle-inner-container">
                            <div class="big-grey-circle">
                               <p>
                               04
                               <span>
                                  шаг
                               </span>
                             </p>
                            </div>
                          </div>
                         <p class="big-grey-circle-desc">
                            Оценка<br>преподавателя
                         </p>
                       </div>
                        <div class="col-md-1 grey-circle">
                         <div>
                           <span></span>
                           <span></span>
                           <span></span>
                         </div>
                       </div>
                       <div class="col-md-2 big-grey-circle-wrapper">
                         <div class="big-grey-circle-inner-container">
                            <div class="big-grey-circle">
                               <p>
                               05
                               <span>
                                  шаг
                               </span>
                             </p>
                            </div>
                          </div>
                         <p class="big-grey-circle-desc">
                            Ваши<br>рекомендации
                         </p>
                       </div>
                       </div>
                      </div><!-- third round steps END-->
                      <div class="b-survey-input-container">
                          <div class="b-survey-input-wrapper">
                                        <div class="b-survey-input__legend">
                                        ( 1 - плохо, 5 - отлично )
                                        </div>
                              <div class="b-survey-left-heading col-md-2 col-sm-12 col-xs-12">
                                <h3>Общая <br>оценка</h3>
                              </div>
                              <div class="b-resume-form-right-block col-md-10 col-sm-12 col-xs-12">
                                <div class="col-md-12 b-survey-rate-holder">
                                    <p class="b-survey-rate-desc">
                                        В целом я доволен курсом
                                    </p>
                                    <select name="marks_stars[]" id="overall_mark_q1" class="rateit-range">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-md-12 b-survey-rate-holder">
                                    <p class="b-survey-rate-desc">
                                        Курс соответствовал моим ожиданиям
                                    </p>
                                    
                                    <select name="marks_stars[]" id="overall_mark_q2" class="rateit-range">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-md-12 b-survey-rate-holder">
                                    <p class="b-survey-rate-desc">
                                        Я бы порекомендовал этот курс другим
                                    </p>
                                    
                                    <select name="marks_stars[]" id="overall_mark_q3" class="rateit-range">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                </div>
                              </div>
                          </div>
                      </div><!-- b-survey-input-container end -->
                      <div class="b-survey-input-container">
                          <div class="b-survey-input-wrapper">
                              <div class="b-survey-left-heading col-md-2 col-sm-12 col-xs-12">
                                <h3>Содержание <br>курса</h3>
                              </div>
                              <div class="b-resume-form-right-block col-md-10 col-sm-12 col-xs-12">
                                <div class="col-md-12 b-survey-rate-holder">
                                    <p class="b-survey-rate-desc">
                                        Применимость полученных знаний и навыков на моей работе
                                    </p>
                                    
                                    <select name="marks_stars[]" id="content_courses_q1" class="rateit-range">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-md-12 b-survey-rate-holder">
                                    <p class="b-survey-rate-desc">
                                        Учебный материал скомпонован понятно и логично
                                    </p>
                                    
                                    <select name="marks_stars[]" id="content_courses_q2" class="rateit-range">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-md-12 b-survey-rate-holder">
                                    <p class="b-survey-rate-desc">
                                        Обьем изложенного материала достаточный
                                    </p>
                                    
                                    <select name="marks_stars[]" id="content_courses_q3" class="rateit-range">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                </div>
                              </div>
																<div class="b-resume-form-right-block col-md-10 col-sm-12 col-xs-12">
                                	<p class="b-survey-choose-c b-survey-choose-c-last">
                                  	Довольны ли Вы обучением? Оставьте Ваш комментарий, для нас очень важно Ваше мнение.
                                  </p>
                                  <div class="b-resume-input-div col-md-12 b-survey-job-comment">
                                    <textarea name="comment-step-3"></textarea>
                                  </div>
                                </div>
                          </div>
                      </div><!-- b-survey-input-container end -->

                        <div id="survey-treriy-step-btn">
                          <a href="#" id="top3">
                            К предыдущему шагу
                            <span><img src="/wp-content/themes/new-it/relize/img/icons/cv-right-arrow.png"></span>
                          </a>
                          <a href="#" id="top4">
                            К следующему шагу
                            <span><img src="/wp-content/themes/new-it/relize/img/icons/cv-left-arrow.png"></span>
                          </a>
                        </div>
                    </div><!-- survey-third-step end -->
                </div><!-- third-step-wrapper end -->
                <!-- fourth survey step begin -->
                <div class="b-resume-form-wrapper col-md-12" id="fourth-step-wrapper">
                    <div class="col-md-12 b-survey-step-holder" id="b-survey-fourth-step">
                        <div class="steps-container"><!-- fourth round steps begin -->
                    <div class="steps-container--inner">
                    <div class="col-md-2 big-grey-circle-wrapper">
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
                         <p class="big-grey-circle-desc">
                            Основные <br>данные
                         </p>
                       </div>
                       <div class="col-md-1 grey-circle">
                          <div>
                           <span></span>
                           <span></span>
                           <span></span>
                          </div>
                       </div>
                        <div class="col-md-2 big-grey-circle-wrapper">
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
                        <div class="col-md-1 grey-circle">
                         <div>
                           <span></span>
                           <span></span>
                           <span></span>
                         </div>
                       </div>
                       <div class="col-md-2 big-grey-circle-wrapper">
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
                            Оценка<br>курса
                         </p>
                       </div>
                        <div class="col-md-1 grey-circle">
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
                               04
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
                            Оценка<br>преподавателя
                         </p>
                       </div>
                       <div class="col-md-1 grey-circle">
                         <div>
                           <span></span>
                           <span></span>
                           <span></span>
                         </div>
                       </div>
                       <div class="col-md-2 big-grey-circle-wrapper">
                         <div class="big-grey-circle-inner-container">
                            <div class="big-grey-circle">
                               <p>
                               05
                               <span>
                                  шаг
                               </span>
                             </p>
                            </div>
                          </div>
                         <p class="big-grey-circle-desc">
                            Ваши<br>рекомендации
                         </p>
                       </div>
                       </div>
                      </div><!-- fourth round steps END-->
                      <div class="b-survey-input-container">
                          <div class="b-survey-input-wrapper">
                                            <div class="b-survey-input__legend">
                                                ( 1 - плохо, 5 - отлично )
                                            </div>
                              <div class="b-survey-left-heading col-md-2 col-sm-12 col-xs-12">
                                <h3>Оценка <br>преподавателя</h3>
                              </div>
                              <div class="b-resume-form-right-block col-md-10 col-sm-12 col-xs-12">
                                <div class="col-md-12 b-survey-rate-holder">
                                    <p class="b-survey-rate-desc">
                                        Работа преподавателя в целом
                                    </p>
                                    <select name="marks_stars[]" id="mark_teacher_q1" class="rateit-range">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-md-12 b-survey-rate-holder">
                                    <p class="b-survey-rate-desc">
                                        Теоретические знания преподавателя по теме
                                    </p>
                                    <select name="marks_stars[]" id="mark_teacher_q2" class="rateit-range">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-md-12 b-survey-rate-holder">
                                    <p class="b-survey-rate-desc">
                                        Практические знания по теме
                                    </p>
                                    <select name="marks_stars[]" id="mark_teacher_q3" class="rateit-range">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-md-12 b-survey-rate-holder">
                                    <p class="b-survey-rate-desc">
                                        Преподаватель использовал примеры из личного опыта
                                    </p>
                                    <select name="marks_stars[]" id="mark_teacher_q4" class="rateit-range">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-md-12 b-survey-rate-holder">
                                    <p class="b-survey-rate-desc">
                                        Практические задания по теме
                                    </p>
                                    <select name="marks_stars[]" id="mark_teacher_q5" class="rateit-range">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                </div>
                              </div>
                          </div>
                      </div><!-- b-survey-input-container end -->
                      <div class="b-survey-input-container">
                          <div class="b-survey-input-wrapper">
                              <div class="b-survey-left-heading col-md-2 col-sm-12 col-xs-12">
                                <h3>Оценка <br>учебного центра</h3>
                              </div>
                              <div class="b-resume-form-right-block col-md-10 col-sm-12 col-xs-12">
                                <div class="col-md-12 b-survey-rate-holder">
                                    <p class="b-survey-rate-desc">
                                        Комфорт работы в учебном классе
                                    </p>
                                    <select name="marks_stars[]" id="mark_training-center_q1" class="rateit-range">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-md-12 b-survey-rate-holder">
                                    <p class="b-survey-rate-desc">
                                        Я доволен уровнем организации курса
                                    </p>
                                    <select name="marks_stars[]" id="mark_training-center_q2" class="rateit-range">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-md-12 b-survey-rate-holder">
                                    <p class="b-survey-rate-desc">
                                        Я доволен работой персонала центра
                                    </p>
                                    <select name="marks_stars[]" id="mark_training-center_q3" class="rateit-range">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                </div>
                              </div>
                                    <div class="b-resume-form-right-block col-md-10 col-sm-12 col-xs-12">
                                        <p class="b-survey-choose-c b-survey-choose-c-last">
                                            Довольны ли Вы обучением? Оставьте Ваш комментарий, для нас очень важно Ваше мнение.
                                        </p>
                                        <div class="b-resume-input-div col-md-12 b-survey-job-comment">
                                            <textarea name="comment-step-4"></textarea>
                                        </div>
                                    </div>
                      </div><!-- b-survey-input-container end -->                     
                        <div id="survey-fourth-step-btn">
                          <a href="#" id="top5">
                            К предыдущему шагу
                            <span><img src="/wp-content/themes/new-it/relize/img/icons/cv-right-arrow.png"></span>
                          </a>
                          <a href="#" id="top6">
                            К следующему шагу
                            <span><img src="/wp-content/themes/new-it/relize/img/icons/cv-left-arrow.png"></span>
                          </a>
                        </div>
                    </div><!-- survey-fourth-step end -->
                </div><!-- fourth-step-wrapper end -->
								</div>
                <div class="b-resume-form-wrapper col-md-12" id="fifth-step-wrapper">
                    <div class="col-md-12 b-survey-step-holder" id="b-survey-fifth-step">
                        <div class="steps-container"><!-- fifth round steps begin -->
                    <div class="steps-container--inner">
                    <div class="col-md-2 big-grey-circle-wrapper">
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
                         <p class="big-grey-circle-desc">
                            Основные <br>данные
                         </p>
                       </div>
                       <div class="col-md-1 grey-circle">
                          <div>
                           <span></span>
                           <span></span>
                           <span></span>
                          </div>
                       </div>
                        <div class="col-md-2 big-grey-circle-wrapper">
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
                        <div class="col-md-1 grey-circle">
                         <div>
                           <span></span>
                           <span></span>
                           <span></span>
                         </div>
                       </div>
                       <div class="col-md-2 big-grey-circle-wrapper">
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
                            Оценка<br>курса
                         </p>
                       </div>
                        <div class="col-md-1 grey-circle">
                         <div>
                           <span></span>
                           <span></span>
                           <span></span>
                         </div>
                       </div>

                       <div class="col-md-2 big-grey-circle-wrapper">
                         <div class="big-grey-circle-inner-container">
                            <div class="big-grey-circle">
                               <p>
                               04
                               <span>
                                  шаг
                               </span>
                             </p>
                            </div>
                          </div>
                         <p class="big-grey-circle-desc">
                            Оценка<br>преподавателя
                         </p>
                       </div>
                        <div class="col-md-1 grey-circle">
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
                               05
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
                            Ваши<br>рекомендации
                         </p>
                       </div>
                       </div>
                      </div><!-- fifth round steps END-->
                        <div class="survey-fill-out-wrapper">
                            <span></span>
                        </div>
                      <div class="b-survey-input-container">
                            <div class="b-survey-input-wrapper">
                              <div class="b-survey-left-heading col-md-2 col-sm-12 col-xs-12">
                                <h3>Информация <br>на сайте ITEA</h3>
                              </div>
                                            <div class="b-resume-form-right-block col-md-10 col-sm-12 col-xs-12">
                                    <p class="b-survey-choose-c b-survey-choose-c-last">
                                    Довольны ли Вы обучением? Оставьте Ваш комментарий, для нас очень важно Ваше мнение.
                                    </p>
                                    <div class="b-resume-input-div col-md-12 b-survey-job-comment">
                                        <textarea name="comment"></textarea>
                                    </div>
                                </div>
                              <div class="b-resume-form-right-block col-md-10 col-sm-12 col-xs-12">
                                <p class="b-survey-choose-c survey-required__label">
                                    Достаточно ли Вам информации на нашем сайте www.itea.ua?
                                </p>
                                <div class="b-resume-input-div col-md-4 col-sm-4 col-xs-4 b-survey-job-search">
                                   <input type="radio" id="step5-yes" value="yes" name="enough_info"  class="survey_check_error">
                                   <label for="step5-yes">
                                       <p>Да</p>
                                   </label>
                                </div>
                                <div class="b-resume-input-div col-md-4 col-sm-4 col-xs-4 b-survey-job-search">
                                   <input type="radio" id="step5-no" value="no" name="enough_info" class="survey_check_error">
                                   <label for="step5-no">
                                       <p>Нет</p>
                                   </label>
                                </div>
                                <div class="b-resume-input-div col-md-4 col-sm-4 col-xs-4 b-survey-job-search">
                                   <input type="radio" id="nogo" value="not-go" name="enough_info" class="survey_check_error">
                                   <label for="nogo">
                                       <p>Не посещаю</p>
                                   </label>
                                </div>
                              </div>
                            </div><!-- wrapper end -->
                        </div><!-- b-survey-input-container -->
                        <div class="b-survey-input-container">
                            <div class="b-survey-input-wrapper">
                              <div class="b-survey-left-heading col-md-2 col-sm-12 col-xs-12">
                                <h3>Акции <br>и предложения</h3>
                              </div>
                              <div class="b-resume-form-right-block col-md-10 col-sm-12 col-xs-12">
                                <p class="b-survey-choose-c">
                                    Хотите ли Вы получать информацию про Акции и специальные предложения по <nobr>E-mail?</nobr>
                                </p>
                                <div class="b-resume-input-div col-md-6 col-sm-6 col-xs-6 b-survey-job-search">
                                   <input type="radio" id="yes-5" value="yes" name="delivery" class="survey_check_error">
                                   <label for="yes-5">
                                       <p>Да</p>
                                   </label>
                                </div>
                                <div class="b-resume-input-div col-md-6 col-sm-6 col-xs-6 b-survey-job-search">
                                   <input type="radio" id="no-5" value="no" name="delivery" class="survey_check_error">
                                   <label for="no-5">
                                       <p>Нет</p>
                                   </label>
                                </div>
                              </div>
                              <div class="b-resume-form-right-block col-md-10 col-sm-12 col-xs-12">
                                <p class="b-survey-choose-c">
                                    Хотите ли Вы стать ментором? <a href="https://itea.ua/wp-content/uploads/2016/10/For_mentors.pdf" target="_blank">Узнать больше</a>
                                </p> 
                                <div class="b-resume-input-div col-md-6 col-sm-6 col-xs-6 b-survey-job-search">
                                   <input type="radio" id="yes-6" value="yes" name="mentoring" class="survey_check_error">
                                   <label for="yes-6">
                                       <p>Да</p>
                                   </label>
                                </div>
                                <div class="b-resume-input-div col-md-6 col-sm-6 col-xs-6 b-survey-job-search">
                                   <input type="radio" id="no-6" value="no" name="mentoring" class="survey_check_error">
                                   <label for="no-6">
                                       <p>Нет</p>
                                   </label>
                                </div>
                              </div>
                        
                                </div><!-- wrapper end -->
                        </div><!-- b-survey-input-container -->
                        
                        <div id="survey-fifth-step-btn">
                            <a href="#" id="top7">
                                К предыдущему шагу
                                <span><img src="/wp-content/themes/new-it/relize/img/icons/cv-right-arrow.png"></span>
                            </a>
                            <button type="submit">
                                Завершить анкетирование
                            </button>
                        </div>
                  </div><!-- fifth survey step end-->
                </div><!-- fifth-step-wrapper end -->
            </form>

          </div>
        </div>
     </main>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/masked-input.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/relize/js/jquery-bar/jquery.barrating.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/for_interview_v5.js"></script>

<?php
$listCourses = '';
$posts = get_posts( array(
    'numberposts' => -1,
    'category'    => '22',
    'post_type'   => 'post',
    'orderby'     => 'title'
));
foreach ($posts as $post) {
    setup_postdata($post);
    $listCourses .= "'".$post->post_title."',";
}
$listCourses = str_replace('&#038;', '&', $listCourses);
wp_reset_postdata();
?>
<script type="text/javascript">
    $(document).ready(function () {
        var sampleTags = [<?php echo $listCourses; ?>];
        $("#actual-courses-tags").tagit({
            availableTags: sampleTags,
            showAutocompleteOnFocus: true,
            beforeTagAdded: function(event, ui) {
                if($.inArray(ui.tagLabel, sampleTags)==-1) return false;
            }
        });
    });
</script>

<script src="<?php bloginfo('template_directory'); ?>/relize/js/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/relize/js/tags.min_v2.js"></script>
        <script>var telerTrackerWidgetId="2583c3d0-35b9-44ba-9f0e-6811232d9cac"; var telerTrackerDomain="itea.phonet.com.ua";</script> <script src="//itea.phonet.com.ua/public/widget/call-tracker/lib.js"></script>
</body>
</html>
<?php } ?>
