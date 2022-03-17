<?php
session_start();
global $post;
if (post_is_in_descendant_category([22, 219], $post)) {
    require_once('templates_for_categories/categ_22_&_219__singles.php'); exit;
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

<?php
if (have_posts()) while (have_posts()) : the_post();
    $category = get_the_category();
    $page_id = get_the_ID();
    $cat_id = get_the_category($page_id);
    $rr = get_ancestors($cat_id[0]->cat_ID, 'category');

    if (in_category(24) || in_category(305)) :
//        $v_name = get_post_meta($page_id, 'Название', true);
        $v_name = get_the_title();
        ?>
        <div class="container post post-vacancy-wrap no-mar-pad-bottom">
            <div class="container">
                <div class="post-head-vacansy personal-vacancy">
                    <h1 class="vacancy"><?php echo $v_name; ?></h1>
                    <?php echo get_the_post_thumbnail($page_id, 'full', array('class' => 'vacancy-logo'));?>
                    <?php /*?><?php $v_name = get_post_meta($page_id, 'Название', true);
                    $v_price = get_post_meta($page_id, 'Зарплата', true); ?>
                    <h1 class="vacancy"><?php echo $v_name; ?></h1>
                    <?php echo get_the_post_thumbnail($page_id, 'full', array('class' => 'vacancy-logo'));

                    $v_city = get_post_meta($page_id, 'Город', true);
                    $v_comp = get_post_meta($page_id, 'Компания', true);
                    $v_type = get_post_meta($page_id, 'Вид занятости', true); ?>
                    <p class="vacansy-desc"><?php echo $v_price; ?></p>
                    <p class="vacansy-desc"><?php echo $lang ? 'Компания: ' : 'Компанія: '; ?><span><?php echo $v_comp; ?></span></p>
                    <p class="vacansy-desc"><?php echo $lang ? 'Город: ' : 'Місто: '; ?><span><?php echo $v_city; ?></span></p>
                    <p class="vacansy-desc"><?php echo $lang ? 'Вид занятости: ' : 'Вид зайнятості: '; ?><span><?php echo $v_type; ?></span></p><?php /**/?>
                </div>
                <div class="post-body-vacansy">
                    <?php
                    $my_post = get_post($page_id);
                    $cont    = $my_post->post_content;
                    ?>
                    <div class="vacancy-content">
                        <?php if ($cont != '') {
                            echo $cont;
                        } ?>
                    </div>
                    <div class="vacancy-form">
                        <?php
                        /*echo '<pre>';print_r($_POST);echo '</pre>';
                        echo '<pre>';print_r($_GET);echo '</pre>';
                        echo '<pre>';print_r($_SESSION);echo '</pre>';*/
                        if ($_POST['done'] && $_POST['done']!=$_SESSION['done']) {
                            $email  = empty($_POST['email']) ? '' : $_POST['email'];
                            $phone  = empty($_POST['phone']) ? '' : $_POST['phone'];
                            $uname  = empty($_POST['uname']) ? '' : $_POST['uname'];
                            $url    = empty($_POST['url'])   ? '' : $_POST['url'];
                            $about  = empty($_POST['about']) ? '' : $_POST['about'];

                            $subject = "Сообщение о кандидате на вакансию ".get_the_title();
                            $to = 'hr@itea.ua,miroslav@itea.ua,nykolay@itea.ua,alexandr.kaliuzhnyi@itea.ua,recruiter@itea.ua';//'eugene.mukhamedov@gns-it.com,summaryitea@gmail.com';
                            $message = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"</head><body>';
                            $message .= "<p>Кандидат на вакансию {$v_name}</p>";
                            $message .= "<p>ФИО: {$uname} </p>";
                            $message .= "<p>Эл. почта: {$email}</p>";
                            $message .= "<p>Телефон: {$phone} </p>";
                            $message .= "<p>URL: {$url} </p>";
                            $message .= "<p>О себе: {$about} </p>";
                            $message .= '<p>IP: ' . $_SERVER['REMOTE_ADDR'] . '</p>';
                            $message .= '</body></html>';

                            $headers[] = 'From: IT Education Academy <resume@itea.ua>';
                            $headers[] = 'Content-Type: text/html; charset=utf-8';

                            if ($_FILES['file']['size'] != 0) {
                                if (!function_exists('wp_handle_upload')) {
                                    require_once(ABSPATH . 'wp-admin/includes/file.php');
                                }
                                $movefile = wp_handle_upload($_FILES['file'], array('test_form' => false));
                                $file_type = $movefile['type'];
                                $path_for_file = $movefile['file'];

                                if(wp_mail($to, $subject, $message, $headers,[$path_for_file])){
                                    if ($lang) {
                                        echo '<h2 style="margin-bottom: 20px">Спасибо за отклик на вакансию. Мы обязательно рассмотрим вашу кандидатуру и, в случае положительного решения, свяжемся с вами, чтобы договориться о собеседовании</h2>';
                                    } else {
                                        echo '<h2 style="margin-bottom: 20px">Дякуємо за відгук на вакансію. Ми обов\'язково розглянемо вашу кандидатуру і, в разі позитивного рішення, зв\'яжемося з вами, щоб домовитися про співбесіду</h2>';
                                    }
                                    $_SESSION['done']=$_POST['done'];
                                }else{
                                    echo "can not send";
                                }

//                                wp_mail($to, $subject, $message, $headers, [$path_for_file]);
                                //wp_mail('anna.nesterenko@itea.ua', $subject, $message, $headers);
                                (is_file($path_for_file) ? unlink($path_for_file) : '');

                                /*header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '/?sent=ok');
                                exit();*/
                            } else {
                                if(wp_mail($to, $subject, $message, $headers)){
                                    if ($lang) {
                                        echo '<h2 style="margin-bottom: 20px">Спасибо за отклик на вакансию. Мы обязательно рассмотрим вашу кандидатуру и, в случае положительного решения, свяжемся с вами, чтобы договориться о собеседовании</h2>';
                                    } else {
                                        echo '<h2 style="margin-bottom: 20px">Дякуємо за відгук на вакансію. Ми обов\'язково розглянемо вашу кандидатуру і, в разі позитивного рішення, зв\'яжемося з вами, щоб домовитися про співбесіду</h2>';
                                    }
                                    $_SESSION['done']=$_POST['done'];
                                }else{
                                    echo "can not send";
                                }
                            }
                        } else {$send=strtotime(date("His"));
                        ?>
                            <form action="<?php echo get_permalink($page_id); ?>" method="POST" id="mail_form" enctype="multipart/form-data">
                                <h2><?php echo $lang?'Заполни форму ниже':'Заповни форму нижче'; ?></h2>
                                <p><?php echo $lang?'Если чувствуешь, что мы подходим друг другу:)':'Якщо відчуваєш, що ми підходимо один одному :)'; ?></p>
                                <div class="wrap-fields">
                                    <div class="wrap-input focused user-name required">
                                        <label for="names">
                                            <span class="placeholder"><?php echo $lang ? 'Имя и фамилия' : 'Ім\'я та прізвище'; ?>*</span>
                                            <input type="text" name="uname" class="" id="names" placeholder="<?php echo $lang ? 'Имя и фамилия' : 'Ім\'я та прізвище'; ?>*"/>
                                            <span class="error-empty"><?php echo $lang ? 'Поле не должно быть пустым' : 'Поле не має бути пустим'; ?></span>
                                        </label>
                                    </div>
                                    <div class="wrap-input focused user-email required">
                                        <label for="email">
                                            <span class="placeholder">Email*</span>
                                            <input type="text" name="email" class="" id="email" placeholder="Email*"/>
                                            <span class="error-empty"><?php echo $lang ? 'Поле не должно быть пустым' : 'Поле не має бути пустим'; ?></span>
                                            <span class="error-email"><?php echo $lang ? 'Введите корректное значение e-mail' : 'Введіть коректне значення e-mail'; ?></span>
                                        </label>
                                    </div>
                                    <div class="wrap-input focused user-phone required">
                                        <label for="telephone">
                                            <span class="placeholder">Телефон*</span>
                                            <input type="text" name="phone" class="" id="telephone" placeholder="Телефон*"/>
                                            <span class="error-empty"><?php echo $lang ? 'Поле не должно быть пустым' : 'Поле не має бути пустим'; ?></span>
                                        </label>
                                    </div>
                                    <div class="wrap-input focused user-url">
                                        <label for="url-form">
                                            <span class="placeholder"><?php echo $lang ? 'Ссылка на резюме' : 'Посилання на резюме'; ?></span>
                                            <input type="url" name="url" class="" id="url-form" placeholder="<?php echo $lang ? 'Ссылка на резюме' : 'Посилання на резюме'; ?>"/>
                                        </label>
                                    </div>
                                    <div class="wrap-input user-file">
                                        <p>Формат <?php echo $lang?'файлов':'файлів'; ?> .doc, .docx, .pdf, .pptx, .ppt</p>
                                        <div>
                                            <label for="file-resume">
                                                <?php echo $lang?'Прикрепить резюме':'Прикріпити резюме'; ?>
                                                <input id="file-resume" type="file" name="file" accept=".doc,.docx,.pdf,.pptx,.ppt"/>
                                                <span class="error-ext"><?php echo $lang?'Выбирите правильный формат файла':'Виберіть вірний формат файлу'; ?></span>
                                            </label>
                                            <span class="name-file">resume-example.pdf</span>
                                        </div>
                                    </div>
                                    <div class="wrap-input focused user-about">
                                        <textarea name="about" id="about-user" placeholder="<?php echo $lang?'Немного о себе':'Трохи про себе'; ?>"></textarea>
                                    </div>
                                </div>
                                <div class="submit-btn">
                                    <input type="hidden" id="pseudo-submit" name="done">
                                    <input type="submit" name="ok" class="btn btn-sm btn-green" value="<?php echo $lang ? 'Отправить' : 'Відправити'; ?>"/>
                                </div>

                                <style>
                                    #privacy-policy{width: 100%;display: flex;margin-top: 15px}
                                    #privacy-policy>label{padding-right: 10px;box-sizing: border-box;position: relative;display: block;top: 0;left: 0;margin: 0;}
                                    #privacy-policy>label>input{display: none;}
                                    #privacy-policy>label>span{display: block;width: 20px;height: 20px;box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);border-radius: 3px;background-color: #ffffff;border:1px solid #010101;position: relative;cursor: pointer;}
                                    #privacy-policy>label>input.error+span{border-color:#e61a4b;box-shadow: 0 2px 10px rgba(230, 26, 75, 0.2);}
                                    #privacy-policy>label>input.error:checked+span{border-color:#010101;box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);}
                                    #privacy-policy>label>span:after{content: "";position: absolute;width: 11px;height: 5px;border: 2px solid #0bac7c;border-top:0;border-right:0;top: 42%;left: 50%;-webkit-transform: translate(-50%,-50%) rotate(-45deg);transform: translate(-50%,-50%) rotate(-45deg);display: none;}
                                    #privacy-policy>label>input:checked+span:after{display:block;}
                                    #privacy-policy>p,#privacy-policy>p>a{font-size: 11px;color: #606f7e;line-height: 16px;}
                                    #privacy-policy>p{text-indent: 0;}
                                    #privacy-policy>p>a{color:#e61a4b;}
                                </style>
                                <div id="privacy-policy">
                                    <label for="input-privacy-policy">
                                        <input type="checkbox" id="input-privacy-policy" name="inputPrivacyPolicy">
                                        <span></span>
                                    </label>
                                    <p><span style="color:#E11030;">*</span>
                                        <?php if ($lang) { ?>
                                            Подписанием и отправкой настоящей заявки я подтверждаю, что я ознакомлен с <a href="/politika-konfidentsialnosti/" target="_blank">Политикой конфиденциальности</a> и принимаю ее условия, включая регламентирующие обработку моих персональных данных, и согласен с ней.
                                        <?php } else { ?>
                                            Підписанням і відправкою справжньою заявки я підтверджую, що я ознайомлений з <a href="/uk/politika-konfidentsiynosti/" target="_blank">Політикою конфіденційності</a> і приймаю її умови, включаючи регламентуючу обробку моїх персональних даних, і згоден з нею.
                                        <?php } ?>
                                    </p>
                                </div>
                                <script>
                                    /*var inputPP = document.querySelector('#input-privacy-policy') || 'notInput';
                                    if(!inputPP.checked){
                                        inputPP.className = 'error';
                                    }*/
                                </script>

                            </form>
                        <?php } ?>
                    </div>
                    <?php /*
                $my_post = get_post($page_id);
                $cont    = $my_post->post_content;

                if ($cont != '') {
                    echo '<div class="container">';
                    echo '<h2 class="vacansy-desc">', ($lang ? 'Описание вакансии' : 'Опис вакансії'), '</h2>';
                    echo $cont;
                }
                ?>
                <p></p>
                <p>
                    <a href="#" class="btn btn-sm btn-green" data-toggle="modal" data-target="#myModal"
                      id="show_vacancy_form"><?php echo $lang ? 'Отправить резюме' : 'Відправити резюме'; ?></a>
                </p>

                <?php if ($cont != '') echo '</div>'; /**/?>
                </div>
            </div>
        </div>

        <?php /*?>
        <div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="left-side-modal-vacansy">
                            <h3><?php echo $v_name; ?></h3>
                            <p class="vacansy-desc"><?php echo $v_price; ?></p>
                            <p class="vacansy-desc"><?php echo $lang ? 'Компания: ' : 'Компанія: '; ?><span><?php echo $v_comp; ?></span></p>
                            <p class="vacansy-desc"><?php echo $lang ? 'Город: ' : 'Місто: '; ?><span><?php echo $v_city; ?></span></p>
                            <p class="vacansy-desc"><?php echo $lang ? 'Вид занятости: ' : 'Вид зайнятості: '; ?><span><?php echo $v_type; ?></span></p>
                            <!--<p class="vacansy-desc">Требования: <span>--><?php //echo $v_need; ?><!--</span></p>-->
                        </div>

                        <div class="right-side-modal-vacansy">
                            <?php
                            if (($_POST['ok']) || ($_GET['sent'])) {

                                $email = empty($_POST['email']) ? '' : $_POST['email'];
                                $phone = empty($_POST['phone']) ? '' : $_POST['phone'];
                                $uname = empty($_POST['uname']) ? '' : $_POST['uname'];

                                $subject = "Сообщение о кандидате на вакансию {$v_name}";
                                $to = 'summaryitea@gmail.com';
                                $message = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"</head><body>';
                                $message .= "<p>Кандидат на вакансию {$v_name}</p>";
                                $message .= "<p>ФИО: {$uname} </p>";
                                $message .= "<p>Эл. почта: {$email}</p>";
                                $message .= "<p>Телефон: {$phone} </p>";
                                $message .= '<p>IP: ' . $_SERVER['REMOTE_ADDR'] . '</p>';
                                $message .= '</body></html>';

                                $headers[] = 'From: IT Education Academy <resume@itea.ua>';
                                $headers[] = 'Content-Type: text/html; charset=utf-8';

                                if ($_FILES['file']['size'] != 0) {
                                    if (!function_exists('wp_handle_upload')) {
                                        require_once(ABSPATH . 'wp-admin/includes/file.php');
                                    }
                                    $movefile = wp_handle_upload($_FILES['file'], array('test_form' => false));
                                    $file_type = $movefile['type'];
                                    $path_for_file = $movefile['file'];

                                    wp_mail($to, $subject, $message, $headers, [$path_for_file]);
                                    wp_mail('anna.nesterenko@itea.ua', $subject, $message, $headers);
                                    (is_file($path_for_file) ? unlink($path_for_file) : '');

                                    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '/?sent=ok');
                                    exit();
                                } elseif (!empty($uname) && !empty($phone)) {
                                    wp_mail($to, $subject, $message, $headers);
                                }

                                if ($lang) {
                                    echo '<h2>Спасибо за отклик на вакансию. Мы обязательно рассмотрим вашу кандидатуру и, в случае положительного решения, свяжемся с вами, чтобы договориться о собеседовании</h2>';
                                } else {
                                    echo '<h2>Дякуємо за відгук на вакансію. Ми обов\'язково розглянемо вашу кандидатуру і, в разі позитивного рішення, зв\'яжемося з вами, щоб домовитися про співбесіду</h2>';
                                }
                            } else { ?>
                                <form action="<?php echo get_permalink($page_id); ?>" method="POST" id="mail_form" enctype="multipart/form-data">
                                    <p>
                                        <label>
                                            <?php echo $lang ? 'Ваше имя, фамилия:' : 'Ваше ім\'я та прізвище:'; ?>
                                            <span>*</span>
                                            <input type="text" name="uname" class="full-size" id="names" required
                                                   pattern="^[a-zA-Zа-яА-ЯіІїЇ'][a-zA-Zа-яА-Я-' іІїЇ]+[a-zA-Zа-яА-ЯіІїЇ']?$"/>
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            <?php echo $lang ? 'Ваш адрес эл. почты:' : 'Ваша адреса ел. пошти:'; ?>
                                            <span>*</span>
                                            <input type="email" name="email" class="full-size" id="email" required/>
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            <?php echo $lang ? 'Контактый телефон:' : 'Контактний телефон:'; ?>
											<span>*</span>
                                            <input type="text" name="phone" class="full-size" id="telephone" required/>
                                        </label>
                                    </p>
                                    <p>
                                        <?php echo $lang ? 'Прикрепите свое готовое резюме' : 'Прикріпіть своє готове резюме'; ?>
                                        <span>*</span>
                                    </p>
                                    <input type="file" name="file" required/>
                                    <p><span>*</span> - <?php echo $lang ? 'поля, обязательные для заполнения' : 'поля, обов\'язкові для заповнення'; ?></p>
                                    <p></p>
                                    <p><input type="submit" name="ok" class="btn btn-sm btn-green" value="<?php echo $lang ? 'Отправить' : 'Відправити'; ?>"/></p>

                                    <style>
                                        #privacy-policy{width: 100%;display: flex;margin-top: 15px}
                                        #privacy-policy>label{padding-right: 10px;box-sizing: border-box;position: relative;display: block;top: 0;left: 0;margin: 0;}
                                        #privacy-policy>label>input{display: none;}
                                        #privacy-policy>label>span{display: block;width: 20px;height: 20px;box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);border-radius: 3px;background-color: #ffffff;border:1px solid #010101;position: relative;cursor: pointer;}
                                        #privacy-policy>label>input.error+span{border-color:#e61a4b;box-shadow: 0 2px 10px rgba(230, 26, 75, 0.2);}
                                        #privacy-policy>label>input.error:checked+span{border-color:#010101;box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);}
                                        #privacy-policy>label>span:after{content: "";position: absolute;width: 11px;height: 5px;border: 2px solid #0bac7c;border-top:0;border-right:0;top: 42%;left: 50%;-webkit-transform: translate(-50%,-50%) rotate(-45deg);transform: translate(-50%,-50%) rotate(-45deg);display: none;}
                                        #privacy-policy>label>input:checked+span:after{display:block;}
                                        #privacy-policy>p,#privacy-policy>p>a{font-size: 11px;color: #606f7e;line-height: 16px;}
                                        #privacy-policy>p>a{color:#e61a4b;}
                                    </style>
                                    <div id="privacy-policy">
                                        <label for="input-privacy-policy">
                                            <input type="checkbox" id="input-privacy-policy" name="inputPrivacyPolicy" required>
                                            <span></span>
                                        </label>
                                        <p><span style="color:#E11030;">*</span>
                                            <?php if ($lang) { ?>
                                                Подписанием и отправкой настоящей заявки я подтверждаю, что я ознакомлен с <a href="/politika-konfidentsialnosti/" target="_blank">Политикой конфиденциальности</a> и принимаю ее условия, включая регламентирующие обработку моих персональных данных, и согласен с ней.
                                            <?php } else { ?>
                                                Підписанням і відправкою справжньою заявки я підтверджую, що я ознайомлений з <a href="/uk/politika-konfidentsiynosti/" target="_blank">Політикою конфіденційності</a> і приймаю її умови, включаючи регламентуючу обробку моїх персональних даних, і згоден з нею.
                                            <?php } ?>
                                        </p>
                                    </div>
                                    <script>
                                        var inputPP = document.querySelector('#input-privacy-policy') || 'notInput';
                                        if(!inputPP.checked){
                                            inputPP.className = 'error';
                                        }
                                    </script>

                                </form>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!empty($_GET['sent'])) { ?>
            <script type="text/javascript">
                window.addEventListener('load', function () {
                    $('#myModal').modal('show');
                });
            </script>
        <?php
        }
        echo '</div>'; /**/
        ?>
    <?php elseif (in_category(25) || in_category(310)): ?>

        <div class="container">
            <div class="head-section">
                <h1>

                    <?php the_title(); ?>
                </h1>
            </div>

            <div class="block-news single-post clearfix ">
                <div class="articleNew">
                    <?php echo get_the_post_thumbnail($page_id, 'medium', array('class' => 'news_img')); ?>
                    <?php the_content(); ?>
                </div>
            </div>

        </div>

    <?php elseif (in_category(70) || in_category(314)): ?>

        <div class="container">
            <div class="head-section">
                <h1>

                    <?php the_title(); ?>
                </h1>
            </div>
            <div class="post single-post clearfix noPad">
                <div class="articleNew clearfix ">


                    <?php
                    if (get_post_gallery()) :
                        ?>
                        <link rel="stylesheet"
                              href="<?php bloginfo('template_directory'); ?>/relize/css/prettyPhoto.css" type="text/css"
                              media="screen" charset="utf-8"/>
                        <script src="<?php bloginfo('template_directory'); ?>/relize/js/jquery.prettyPhoto.js"
                                type="text/javascript" charset="utf-8"></script>
                    <?php
                    print get_post_gallery();

                    ?>

                        <script type="text/javascript">
                            $(".gallery-item a").attr("rel", "prettyPhoto[pp_gal]");


                            $(document).ready(function () {
                                $("a[rel^='prettyPhoto']").prettyPhoto({
                                    default_width: 600,
                                    default_height: 400,
                                    markup: '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                        <a class="pp_close" href="#">Close</a> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#">next</a> \
                                            <a class="pp_previous" href="#">previous</a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <p class="pp_description"><div class="pp_social"><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"><\/script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href=' + location.href + '&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div></div></p> \
                                            {pp_social} \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>',
                                    social_tools: ''

                                });


                            });
                        </script>


                        <?php

                    else :
                        echo apply_filters('the_content', $post->post_content);
                    endif;
                    ?>

                </div>

            </div>
        </div>
        <!--        </div>-->

    <?php elseif (in_category(26) || in_category(301)): ?>

        <div class="container">
            <div class="head-section">
                <a href="<?php echo get_category_link(($lang ? 26 : 301)); ?>"
                   class="rollback"><?php echo($lang ? 'Вернуться' : 'Повернутися'); ?> <img
                            src="<?php bloginfo('template_directory'); ?>/relize/img/buttons/close.png"></a>
                <h1>
                    <?php the_title(); ?>
                </h1>
            </div>

            <div class="post dayInstructorSingle single-post clearfix ">
                <?php echo get_the_post_thumbnail($page_id, array(150, 150), array('class' => 'news_img')); ?>
                <div class="articleNew">
                    <?php
                    echo get_post_meta($page_id, 'Описание', true);
                    $subject = get_post_meta($page_id, 'Специаьность', true);
                    ?>
                    <?php if ($subject): ?>
                        <div>
                            <hr>
                            <ul>
                                <li><?php echo $subject; ?></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    <?php elseif (in_category(77) || in_category(299)): ?>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/relize/css/style1.css">
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/teacher_evening_v3.css">

        <div class="container container-teacher">
            <a style="position:absolute; top:10px; right:10px; z-index:100; "
               href="<?php echo get_category_link(($lang ? 77 : 299)); ?>"><img
                        src="<?php bloginfo('template_directory'); ?>/relize/img/buttons/close.png"></a>

            <div class="teacher-information-heading">
                <?php echo get_the_post_thumbnail($page_id, array(150, 150)); ?>
                <h1 class="teacher-information-heading_name"><?php echo get_the_title($page_id); ?></h1>
                <h4 class="teacher-information-heading_title"><?php echo get_post_meta($page_id, 'Специальность', true); ?></h4>
            </div>
            <div class="teacher-main-content">
                <?php
                $item = get_post_meta($page_id, 'О преподавателе', true);
                if ($item) {
                    ?>
                    <div class="teacher-info-block">
<!--                        <div class="teacher-info-block_bio">-->
<!--                            <img src="--><?php //bloginfo('template_directory'); ?><!--/images/teacher_evening/person.svg"-->
<!--                                 alt="">-->
<!--                            <h2>--><?php //echo($lang ? 'О преподавателе' : 'Про викладача'); ?><!--</h2>-->
<!--                        </div>-->
                        <div class="teacher-info-block_main_text">
                            <p>
                                <?php echo $item; ?>
                            </p>
                        </div>
                    </div>
                    <?php
                }
//                $item = get_post_meta($page_id, 'Достижения и навыки', true);
//                if ($item) {
//                    ?>
<!--                    <div class="teacher-info-block">-->
<!--                        <div class="teacher-info-block_skills">-->
<!--                            <img src="--><?php //bloginfo('template_directory'); ?><!--/images/teacher_evening/bag.svg" alt="">-->
<!--                            <h2>--><?php //echo($lang ? 'Достижения и навыки' : 'Досягнення та навички'); ?><!--</h2>-->
<!--                        </div>-->
<!--                        <div class="teacher-info-block_main_text">-->
<!--                            <p>--><?php //echo $item; ?><!--</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    --><?php
//                }
//                $item = get_post_meta($page_id, 'Образование', true);
//                if ($item) {
//                    ?>
<!--                    <div class="teacher-info-block">-->
<!--                        <div class="teacher-info-block_education">-->
<!--                            <img src="--><?php //bloginfo('template_directory'); ?><!--/images/teacher_evening/education.svg"-->
<!--                                 alt="">-->
<!--                            <h2>--><?php //echo($lang ? 'Образование' : 'Освіта'); ?><!--</h2>-->
<!--                        </div>-->
<!--                        <div class="teacher-info-block_education_list">-->
<!--                            --><?php //echo $item; ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                    --><?php
//                }
//                $item = get_post_meta($page_id, 'Сертификаты', true);
//                if ($item) {
//                    ?>
<!--                    <div class="teacher-info-block">-->
<!--                        <div class="teacher-info-block_certification">-->
<!--                            <img src="--><?php //bloginfo('template_directory'); ?><!--/images/teacher_evening/cert.svg" alt="">-->
<!--                            <h2>--><?php //echo($lang ? 'Сертификаты' : 'Сертифікати'); ?><!--</h2>-->
<!--                        </div>-->
<!--                        <div class="teacher-info-block_certification_list">-->
<!--                            --><?php //echo $item; ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                    --><?php
//                }
                ?>
            </div>
        </div>

    <?php elseif ($rr[count($rr) - 1] == 23 || $rr[count($rr) - 1] == 296): ?>

        <div class="container day">
            <div class="head-section">
                <h1>
                    <?php the_title(); ?>
                </h1>
            </div>

            <div id="dayContent">
                <div class="articleNew" role="tabpanel">
                    <ul class="nav nav-tabs TwoListsCourses isoLinkDay" role="tablist">
                        <li role="presentation" class="active"><a href="#desc" class="" aria-controls="desc" role="tab"
                                                                  data-toggle="tab"><?php echo($lang ? 'Описание' : 'Опис'); ?></a>
                        </li>
                        <li role="presentation"><a href="#profile" class="" aria-controls="profile" role="tab"
                                                   data-toggle="tab"><?php echo($lang ? 'Программа' : 'Програма'); ?></a>
                        </li>
                        <li role="presentation"><a href="#require" class="" aria-controls="require" role="tab"
                                                   data-toggle="tab"><?php echo($lang ? 'Требования' : 'Вимоги'); ?></a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="courseContent">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane  fade in active" id="desc">
                                <?php echo get_post_meta($page_id, 'Описание', true) ?>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                <?php echo get_post_meta($page_id, 'Программа', true) ?>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="require">
                                <?php echo get_post_meta($page_id, 'Требование у слушателям', true) ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <?php if (function_exists('courseSideBar')) {
                        echo courseSideBar($post, true);
                    } ?>
                </div>
            </div>

            <!-- Start SiteHeart code -->
            <script src="<?php bloginfo("template_directory"); ?>/relize/js/site-heart-code.js"></script>
            <!-- End SiteHeart code -->

        </div>
    <?php else : ?>
    <?php endif; ?>
<?php endwhile; ?>

    <script type="text/javascript">
        $(document).ready(function () {
            $('input').unbind().keyup(function () {
                var id = $(this).attr('id');
                var val = $(this).val();

                switch (id) {
                    // Проверка поля "Имя и Фамилия"
                    case 'names':
                        var rv_name = /^[a-zA-Zа-яА-Я]+$/;
                        if (val != '' && rv_name.test(val)) {
                            $(this).removeClass('has_error').addClass('not_error').css({
                                'border-color': '#0BAC7C',
                                'background-color': '#FAFFBD'
                            });
                        } else {
                            $(this).removeClass('not_error').addClass('has_error').css({
                                'border-color': '#F93B47',
                                'background-color': '#E1A8B0'
                            });
                        }
                        break;

                    // Проверка email
                    case 'email':
                        var rv_email = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
                        if (val != '' && rv_email.test(val)) {
                            $(this).removeClass('has_error').addClass('not_error').css({
                                'border-color': '#0BAC7C',
                                'background-color': '#FAFFBD'
                            });
                        } else {
                            $(this).removeClass('not_error').addClass('has_error').css({
                                'border-color': '#F93B47',
                                'background-color': '#E1A8B0'
                            });
                        }
                        break;
                }
            });
            if($('.vacancy-form').length>0){
                $('.vacancy-form .focused').focusin(function(){
                    $(this).addClass('focusin');
                }).focusout(function(){
                    var inputVal = $(this).find('input,textarea').val();
                    if(!inputVal.length>0 || !/^\+9 \(\d{3}\) \d{3} \d{2} \d{2}/i.test(inputVal)){
                        $(this).removeClass('focusin');
                    }
                });

                var inLeft = false;
                var inRight = true;
                var bound = 948;
                var doc_width = window.innerWidth;
                if(bound>doc_width){inLeft = true; inRight = false;leftFunc();}
                function changeLocation(){
                    doc_width = window.innerWidth;
                    if(bound<=doc_width){
                        if(inLeft && !inRight){
                            console.log("»>");
                            rightFunc();
                            inLeft = false; inRight = true;
                        }
                    }else{
                        if(!inLeft && inRight){
                            console.log("«<");
                            leftFunc();
                            inLeft = true; inRight = false;
                        }
                    }
                }
                $( window ).resize(function() {
                    changeLocation();
                });

                function leftFunc(){
                    $(".vacancy-form>h2").insertBefore($(".post-head-vacansy>h1"));
                }
                function rightFunc(){
                    $(".post-head-vacansy>h2").appendTo(".vacancy-form");
                }

                var validForm = {
                    uname: false,
                    email: false,
                    phone: false,
                    privacy: false,
                    file: true,
                    allTrue: function(){
                        return this.uname && this.email && this.phone && this.privacy && this.file
                    },
                    setValue: function(keyN,valK){
                        if(keyN in this){
                            this[keyN]=valK;
                        }
                    }
                };
                $('#mail_form').submit(function(e){
                    e.preventDefault();
                    $('#mail_form .required').each(function(){
                        $(this).removeClass('empty');
                        $(this).removeClass('err-email');
                        var value = $(this).find('input, textarea').val();
                        var attrName = $(this).find('input').attr('name');
                        if(!value.length>0){
                            $(this).addClass('empty');
                            validForm.setValue(attrName,false);
                        }else{
                            validForm.setValue(attrName,true);
                            if(value.length>0 && attrName==='email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test($(this).find('input').val())){
                                $(this).addClass('err-email');
                                validForm.setValue(attrName,false);
                            }
                        }
                    });
                    if($('#input-privacy-policy').prop('checked')){
                        $('#input-privacy-policy').removeClass('error');
                        validForm.setValue('privacy',true);
                    }else{
                        $('#input-privacy-policy').addClass('error');
                        validForm.setValue('privacy',false);
                    }
                    if(validForm.allTrue()){
                        $('#mail_form #pseudo-submit').val('done_'+(new Date().getTime() / 1000));
                        this.submit();
                    }
                });
                $('#file-resume').change(function(){
                    var allowedExtensions = /(\.doc|\.docx|\.pdf|\.pptx|\.ppt)$/i;
                    $(this).removeClass('error');
                    if(!allowedExtensions.test($(this).prop('files')[0]['name'])){
                        $(this).addClass('error');
                        $('#mail_form .user-file .name-file').text('resume-example.pdf');
                        validForm.setValue('file',false);
                        return false;
                    }else{
                        $('#mail_form .user-file .name-file').text($('#file-resume').prop('files')[0]['name']);
                        validForm.setValue('file',true);
                        /*Image preview
                        if (fileInput.files && fileInput.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
                            };
                            reader.readAsDataURL(fileInput.files[0]);
                        }*/
                    }
                });
            }
        });
    </script>

    <script src="<?php bloginfo('template_directory'); ?>/relize/js/mask.js"></script>
    <script type="text/javascript">
        jQuery(function ($) {
            $("#telephone").mask("+9 (999) 999 99 99");
        });
    </script>

<?php get_footer(); ?>
