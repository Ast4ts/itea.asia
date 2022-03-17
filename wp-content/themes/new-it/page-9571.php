<?php
if( !empty($_POST['id']) ){
    get_header();

    global $wpdb;
    $table_name = $wpdb->get_blog_prefix() . 'resume';
    $r_id   = preg_replace('/[^a-z0-9]/i','',$_POST['id']);
    $r_pass = $wpdb->get_var('SELECT password FROM '.$table_name.' WHERE uniqid = \''.$r_id.'\'');

    $role_admin = post_password_required(9486);
    $role_user = !( is_null($r_pass) ? false : $r_pass == md5($_POST['pass']) );

    if($role_admin && $role_user){
        echo '<div class="container"><br><h1>Неудача. Попробуйте <a href="#" onclick="history.back();return false;" style="text-decoration:underline;">верифицироваться еще раз</a>.</h1></div>';
    } else {
        $resume = $wpdb->get_row('SELECT name,date_birth,email,phone,address,about_me,linkedin,facebook,portfolio,w1_places,w1_positions,w1_duties,w1_periods,w2_places,w2_positions,w2_duties,w2_periods,edu1_names,edu1_specialties,edu2_names,edu2_specialties,courses,tag_cloud,personal_qualities,eng,link_to_photo,confirm,comment'.
            ' FROM '.$table_name.
            ' WHERE uniqid = \''.$r_id.'\''.
            ' LIMIT 1' , ARRAY_A);

        if(empty($resume)){
            wp_redirect( get_permalink(7633) ); exit;
        } else {
            $resume = stripslashes_deep($resume);
        }

        $resume['linkedin']  = urldecode($resume['linkedin']);
        $resume['facebook']  = urldecode($resume['facebook']);
        $resume['portfolio'] = urldecode($resume['portfolio']);

        $w1_periods_1 = '';
        $w1_periods_2 = '';
        $w2_periods_1 = '';
        $w2_periods_2 = '';
        if(!empty($resume['w1_periods'])){
            $w1_periods_1 = mb_substr($resume['w1_periods'], 0, 10);
            if(mb_strlen($resume['w1_periods'])>20){
                $w1_periods_2 = mb_substr($resume['w1_periods'], -10);
            }
        }
        if(!empty($resume['w2_periods'])){
            $w2_periods_1 = mb_substr($resume['w2_periods'], 0, 10);
            if(mb_strlen($resume['w1_periods'])>20){
                $w2_periods_2 = mb_substr($resume['w2_periods'], -10);
            }
        }
        ?>
        <div id="loading"><div id="loading-animation"></div></div>
        <div class="page-edit-container container">
            <div class="row">
                <h1 class="b-resume-h1">Анкета студента</h1>
                <div class="b-resume-wrapper">
                    <div class="b-resume-black-logo">
                    </div>
                </div>
                <div class="col-md-12">
                    <form id="student-cv-form" method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="form_to_update_resume">
                        <input type="hidden" name="id" value="<?php echo $r_id; ?>">
                        <input type="hidden" name="verification" value="<?php echo wp_create_nonce($r_id.($role_admin ? 'you_mortal' : 'gns+itea')); ?>">
                        <?php
                        if (!$role_admin) {
                            ?>
                            <div class="checked">
                                <div>
                                    <input type="radio" name="confirm" id="confirm-0" value="0" <?php echo (!$resume['confirm'] ? 'checked' : ''); ?>> <label for="confirm-0">Не подтверждено</label>
                                </div>
                                <div>
                                    <input type="radio" name="confirm" id="confirm-1" value="1" <?php echo ( $resume['confirm'] ? 'checked' : ''); ?>> <label for="confirm-1">Подтверждено</label>
                                </div>
                            </div>

                            <div class="b-resume-input-div">
                                <p class="placeholder" style="height: 229px;">Комментарий, относительно данного студента :</p>
                                <textarea name="comment"><?php echo $resume['comment']; ?></textarea>
                            </div>
                            <hr>
                            <div class="b-resume-input-div">
                                <p class="placeholder" style="height: 229px;">Создать новый ПАРОЛЬ студенту :</p>
                                <input type="text" name="new_pass" maxlength="12" autocomplete="off" style="display:inline; width: 200px;">
                            </div>
                            <hr><br><br><br>
                            <?php
                        }
                        ?>
                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">01</span>
                            <p class="placeholder" style="height: 229px;">Имя Фамилия :</p>
                            <input type="text" name="name" maxlength="250" autocomplete="off" class="regular_input check_error" id="student-name" value="<?php echo $resume['name']; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">02</span>
                            <p class="placeholder" style="height: 229px;">Дата рождения :</p>
                            <input type="text" name="date_birth" maxlength="250" autocomplete="off" class="regular_input check_error" id="b-resume-birth" value="<?php echo $resume['date_birth']; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">03</span>
                            <p class="placeholder" style="height: 229px;">E-mail :</p>
                            <input type="text" name="email" maxlength="250" autocomplete="off" class="regular_input check_error" id="student-email" value="<?php echo $resume['email']; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">04</span>
                            <p class="placeholder" style="height: 229px;">Номер телефона :</p>
                            <input type="text" name="phone" maxlength="250" autocomplete="off" class="regular_input check_error" id="student-tel" value="<?php echo $resume['phone']; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">05</span>
                            <p class="placeholder" style="height: 229px;">Адрес :</p>
                            <input type="text" name="address" maxlength="250" autocomplete="off" class="regular_input check_error" id="student-address" value="<?php echo $resume['address']; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">06</span>
                            <p class="placeholder" style="height: 229px;">О себе :</p>
                            <textarea name="about_me" class="regular_input check_error" id="about_me"><?php echo $resume['about_me']; ?></textarea>
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">07</span>
                            <p class="placeholder" style="height: 229px;">Ссылка на профиль в Linkedin :</p>
                            <input type="text" name="linkedin" maxlength="400" autocomplete="off" value="<?php echo $resume['linkedin']; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">08</span>
                            <p class="placeholder" style="height: 229px;">Ссылка на профиль в Facebook :</p>
                            <input type="text" name="facebook" maxlength="400" autocomplete="off" value="<?php echo $resume['facebook']; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">09</span>
                            <p class="placeholder" style="height: 229px;">Ссылка на портфолио :</p>
                            <input type="text" name="portfolio" maxlength="400" autocomplete="off" value="<?php echo $resume['portfolio']; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">10</span>
                            <p class="placeholder" style="height: 229px;">Опыт работы (место 1) :</p>
                            <input type="text" name="w1_places" maxlength="400" autocomplete="off" class="regular_input" id="w1_places" value="<?php echo $resume['w1_places']; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">11</span>
                            <p class="placeholder" style="height: 229px;">Должность :</p>
                            <input type="text" name="w1_positions" maxlength="250" autocomplete="off" class="regular_input" id="w1_positions" value="<?php echo $resume['w1_positions']; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">12</span>
                            <p class="placeholder" style="height: 229px;">Обязанности :</p>
                            <textarea name="w1_duties" class="regular_input" id="w1_duties" maxlength="900"><?php echo $resume['w1_duties']; ?></textarea>
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">13</span>
                            <p class="placeholder" style="height: 229px;">Период работы (с) :</p>
                            <input type="text" name="w1_periods_1" autocomplete="off" id="date-1" value="<?php echo $w1_periods_1; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">14</span>
                            <p class="placeholder" style="height: 229px;">Период работы (до) :</p>
                            <input type="text" name="w1_periods_2" autocomplete="off" id="date-2" value="<?php echo $w1_periods_2; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">15</span>
                            <p class="placeholder" style="height: 229px;">Опыт работы (место 2) :</p>
                            <input type="text" name="w2_places" maxlength="400" autocomplete="off" class="regular_input-second" value="<?php echo $resume['w2_places']; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">16</span>
                            <p class="placeholder" style="height: 229px;">Должность :</p>
                            <input type="text" name="w2_positions" maxlength="250" autocomplete="off" class="regular_input-second" value="<?php echo $resume['w2_positions']; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">17</span>
                            <p class="placeholder" style="height: 229px;">Обязанности :</p>
                            <textarea name="w2_duties" class="regular_input" id="w1_duties" maxlength="900"><?php echo $resume['w2_duties']; ?></textarea>
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">18</span>
                            <p class="placeholder" style="height: 229px;">Период работы (с) :</p>
                            <input type="text" name="w2_periods_1" autocomplete="off" id="date-3-second" value="<?php echo $w2_periods_1; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">19</span>
                            <p class="placeholder" style="height: 229px;">Период работы (до) :</p>
                            <input type="text" name="w2_periods_2" autocomplete="off" id="date-4-second" value="<?php echo $w2_periods_2; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">20</span>
                            <p class="placeholder" style="height: 229px;">Образование (Название учреждения 1) :</p>
                            <input type="text" name="edu1_names" maxlength="250" autocomplete="off" class="regular_input check_error" id="edu1_names" value="<?php echo $resume['edu1_names']; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">21</span>
                            <p class="placeholder" style="height: 229px;"> Специальность :</p>
                            <input type="text" name="edu1_specialties" maxlength="250" autocomplete="off" class="regular_input check_error" id="edu1_specialties" value="<?php echo $resume['edu1_specialties']; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">22</span>
                            <p class="placeholder" style="height: 229px;">Образование (Название учреждения 2) :</p>
                            <input type="text" name="edu2_names" maxlength="250" autocomplete="off" class="regular_input-second" value="<?php echo $resume['edu2_names']; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">23</span>
                            <p class="placeholder" style="height: 229px;">Специальность :</p>
                            <input type="text" name="edu2_specialties" maxlength="250" autocomplete="off" class="regular_input-second" value="<?php echo $resume['edu2_specialties']; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">24</span>
                            <?php print_r($resume['courses']);?>
                            <p class="placeholder" style="height: 229px;">Пройденные курсы:</p>

                            <?php
                            echo '<ul id="myULTags">';
                            $courses = explode(',', $resume['courses']);
                            foreach ($courses as $cours){
                                $name = get_the_title($cours);
                                if(empty($name)){ continue; }
                                echo '<li>',$name,'</li>';
                            }
                            if(in_array(8519,$courses)){echo '<li>ICND1</li>';}
                            if(in_array(8521,$courses)){echo '<li>ICND2</li>';}
                            echo '</ul>';
                            ?>
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">25</span>
                            <p class="placeholder" style="height: 229px;">Знания и навыки:</p>
                            <input type="text" name="tag_cloud" id="mySingleFieldTags" style="display:none;" value="<?php echo $resume['tag_cloud']; ?>">
                        </div>

                        <div class="b-resume-input-div">
                            <span class="b-resume-input-span">26</span>
                            <p class="placeholder" style="height: 229px;">Личные качества:</p>
                            <input type="text" name="personal_qualities" maxlength="1900" autocomplete="off" class="regular_input check_error" id="personal_qualities" value="<?php echo $resume['personal_qualities']; ?>">
                        </div>
                        <div class="b-resume-input-div b-resume-english">
                            <span class="b-resume-input-span">27</span>
                            <p class="placeholder" style="height: 229px;">Уровень английского :
                            </p>

                            <div class="b-resume-form-block">
                                <div class="b-resume-form-english__item">
                                    <input type="radio" name="eng" value="1" id="beginner"  <?php echo ($resume['eng']=='1' ? 'checked' : ''); ?>>
                                    <label for="beginner">
                                        <p class="b-cv-level"></p>
                                        <div class="level-wrapper"><p>BEGINNER</p></div>
                                        <strong>Начальный <br>уровень</strong>
                                        <p></p>
                                    </label>
                                </div>
                                <div class="b-resume-form-english__item">
                                    <input type="radio" name="eng" value="2" id="pre-int"   <?php echo ($resume['eng']=='2' ? 'checked' : ''); ?>>
                                    <label for="pre-int">
                                        <p class="b-cv-level"></p>
                                        <div class="level-wrapper"><p>PRE-<br>INTERMEDIATE</p></div>
                                        <strong>Элементарный<br>уровень</strong>
                                        <p></p>
                                    </label>
                                </div>
                                <div class="b-resume-form-english__item">
                                    <input type="radio" name="eng" value="3" id="int" <?php echo ($resume['eng']=='3' ? 'checked' : ''); ?>>
                                    <label for="int">
                                        <p class="b-cv-level"></p>
                                        <div class="level-wrapper"><p>INTERMEDIATE</p></div>
                                        <strong>Средний<br>уровень</strong>
                                        <p></p>
                                    </label>
                                </div>
                                <div class="b-resume-form-english__item">
                                    <input type="radio" name="eng" value="4" id="upper-int" <?php echo ($resume['eng']=='4' ? 'checked' : ''); ?>>
                                    <label for="upper-int">
                                        <p class="b-cv-level"></p>
                                        <div class="level-wrapper"><p>UPPER INTERMEDIATE</p></div>
                                        <strong>Высокий <br>уровень</strong>
                                        <p></p>
                                    </label>
                                </div>
                                <div class="b-resume-form-english__item">
                                    <input type="radio" name="eng" value="5" id="advanced"  <?php echo ($resume['eng']=='5' ? 'checked' : ''); ?>>
                                    <label for="advanced">
                                        <p class="b-cv-level"></p>
                                        <div class="level-wrapper"><p>ADVANCED</p></div>
                                        <strong>Продвинутый <br>уровень</strong>
                                        <p></p>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="b-resume-form-div">
                            <div class="b-resume-form-img">
                                <img src="<?php echo $resume['link_to_photo']; ?>">
                                <div class="form-photo-link-button"  for="form-photo-link-button">

                                    <input type="hidden" name="cropped_image" id="upload2"/>
                                </div>
                            </div>
                            <div class="b-resume-form-img">
                            <div class="row">
                                <div class="file-upload hidden">
                                    <label for="upload" class="download-photo">Завантажити фото</label>
                                    <input type="file" name="link_to_photo" id="upload" class="form-photo-link">
                                </div>
                                <div class="crop">
                                    <div id="upload-demo" style="float:none;margin:auto;">
                                        <label></label>
                                    </div>
                                    <div id="result" class="croppie-result" style="margin-bottom:20px;"></div>
                                    <div class="upload-result-btn">
                                        <span class="upload-result download-photo">Обрезать</span>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" value="Обновить резюме" id="first-step-btn">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="<?php bloginfo('template_directory'); ?>/relize/js/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php bloginfo('template_directory'); ?>/relize/js/tags.min_v2.js"></script>
        <script src="<?php bloginfo('template_directory'); ?>/relize/js/croppie.js"></script>
        <script src="<?php bloginfo('template_directory'); ?>/js/masked-input.min.js"></script>
        <script src="<?php bloginfo('template_directory'); ?>/js/for_resume_v10.js"></script>
        <?php
        $listCourses = '';
        $title_day_courses = ['ICND1','ICND2'];
        $posts = get_posts( array(
            'numberposts' => -1,
            'category'    => '22',
            'post_type'   => 'post',
            'orderby'     => 'title'
            ));
        foreach($posts as $post){
            setup_postdata($post);
            $listCourses .= "'".$post->post_title."',";
        }
        foreach($title_day_courses as $tdc){
            $listCourses .= "'".$tdc."',";
        }
        $listCourses = str_replace('&#038;', '&', $listCourses);
        wp_reset_postdata();
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
// START preloading data in markup
                var sampleTags = [<?php echo $listCourses; ?>];
                $('#myULTags').tagit({
                    availableTags: sampleTags,
                    fieldName: 'courses[]',
                    showAutocompleteOnFocus: true,
                    beforeTagAdded: function(event, ui) {
                        if($.inArray(ui.tagLabel, sampleTags)==-1) return false;
                    }
                });
                var sampleSingleTags = ['С#','C++','Ruby','Objective-C','Scala','Perl','Go','CoffeeScript','ActionScript','Java','Python','PHP',
                    'jQuery','JavaScript','HTML','CSS','Linux','Ubuntu','MySQL','Ajax','Git','SQL','Nginx','Node.js','Angular.js','React.js',
                    'Алгоритмы','Криптография','ООП','.NET','Django','MongoDB','Ruby on Rails','Drupal','WordPress','Agile','Symfony','Doctrine',
                    'Bootstrap','Photoshop','SSH','Sass','Laravel','Zend Framework','Yii'];
                $("#mySingleFieldTags").tagit({
                    availableTags: sampleSingleTags,
                    allowSpaces: true
                });
// END preloading

                var $uploadCrop;
                function readFile(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $uploadCrop.croppie('bind', {
                                url: e.target.result
                            });
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                    else {
                        alert("Sorry - you're browser doesn't support the FileReader API");
                    }
                }
                $uploadCrop = $('#upload-demo').croppie({
                    viewport: {
                        width: 200,
                        height: 200,
                        type: 'circle'
                    },
                    boundary: {
                        width: 300,
                        height: 300
                    }
                });
                var $upload = $('#upload');

                function clickUpload(e){
                     e.preventDefault();
                     $upload.trigger('click');
                }


                $upload.on('change', function () {
                    $(".crop").show();
                    readFile(this);

                    $('.crop').off('click', '.cr-boundary', clickUpload);
                    $('.file-upload').removeClass('hidden');
                });

                $('.crop').on('click', '.cr-boundary', clickUpload);



                $('.upload-result').on('click', function (ev) {
                    $uploadCrop.croppie('result', 'canvas').then(function (resp) {
                        popupResult({
                            src: resp
                        });
                        $upload.val(resp);
                    });
                });
                function popupResult(result) {
                    var html;
                    if (result.html) {
                        html = result.html;
                    }
                    if (result.src) {
                        html = '<img src="' + result.src + '" />';
                    }
                    $("#result").html(html);
                    $("#upload2").attr('value', result.src);
                }

                // student CV edit page preloader start
                var studentForm = document.getElementById('student-cv-form');
                studentForm.addEventListener('submit', function(e) {
                    var loading = document.getElementById('loading');
                    loading.classList.add('active');
                });
                // student CV edit page preloader end
            });
        </script>

        <?php
    } get_footer();
} else { wp_redirect(get_permalink(7633)); exit; }
?>