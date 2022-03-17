<?php /* Template Name: Courses list */ ?>

<?php get_header(); ?>

<div class="wrap-list-course">
    <div class="day-course course-blok">
        <div class="head-zone-course">
            <div class="image-type-of-course">
                <img src="<?php bloginfo('template_directory'); ?>/relize/img/courses-icons/day-course.png" alt=""/>
            </div>
            <div class="body-text-course">
                <h2>Дневные курсы</h2>
                <p><span class="bold-text">Будние дни</span> с 10.00 до 18.00</p>
                <!-- <p><span class="bold-text">Инструкторы</span> - сертифицированные и подтверденные Вендором</p> -->
            </div>
        </div>
        <div class="body-zone-course">
            <div class="metro-line">
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line"></div>

            </div>
            <div class="list-of-course">
                <!-- <h3>Вендорские</h3> -->
                <a href="http://test.oshurov.dev.gns-it.com/courses/daily/cisco/">Cisco</a>
                <a href="http://test.oshurov.dev.gns-it.com/courses/daily/microsoft/">Microsoft</a>
                <a href="http://test.oshurov.dev.gns-it.com/courses/daily/pm/">Управление проектами</a>
                <a href="http://test.oshurov.dev.gns-it.com/courses/daily/programmirovanie/">Программирование</a>
                <a href="http://test.oshurov.dev.gns-it.com/courses/daily/unix_linux/">UNIX / Linux</a>
                <a href="http://test.oshurov.dev.gns-it.com/courses/daily/metodologiya/">Методология</a>
                <a href="http://test.oshurov.dev.gns-it.com/courses/daily/databases-daily/">Базы данных</a>
                <a href="http://iteducate.com.ua/courses/ochnyie-kursyi/polzovatelskie-kursyi/">Пользовательские
                    курсы</a>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <div class="evening-course course-blok">
        <div class="head-zone-course">
            <div class="image-type-of-course">
                <img src="<?php bloginfo('template_directory'); ?>/relize/img/courses-icons/evening-course.png"
                     alt=""/>
            </div>
            <div class="body-text-course">
                <h2>Вечерние курсы</h2>
                <p><span class="bold-text">ПН,ПТ</span> Вечернее время (после 18.00)</p>
                <p><span class="bold-text">СБ,ВС</span> Дневное время (начиная с 10.00)</p>
                <p><span class="bold-text">Инструкторы</span> - только практикующие специалисты, работающие в самых
                    престижных мировых ИТ-компаниях</p>
            </div>
        </div>
        <div class="body-zone-course">
            <div class="metro-line">
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line spes-circle"></div>
                <div class="circle-metro-line"></div>

            </div>
            <div class="list-of-course">
                <a href="/courses/evening/programming-fundamentals/">Основы программирования</a>
                <a href="/courses/evening/c/">C++</a>
                <a href="/courses/evening/c-2/">C#</a>
                <a href="/courses/evening/java/">Java</a>
                <a href="/courses/evening/perl/">Perl</a>
                <a href="/courses/evening/shell/">Shell</a>
                <a href="/courses/evening/php/">PHP</a>
                <a href="/courses/evening/javascript/">JS development</a>
                <a href="/courses/evening/python/">Python</a>
                <a href="/courses/evening/android_course/">Программирование под Андроид</a>
                <a href="/courses/evening/ios_course/">Программирование на IOS</a>

            </div>
            <div class="metro-line">
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line"></div>
                <div class="circle-metro-line spes-circle"></div>
                <div class="circle-metro-line"></div>

            </div>
            <div class="list-of-course">
                <a href="/courses/evening/html/">Frontend development</a>
                <a href="/courses/evening/qa/">Тестирование</a>
                <a href="/courses/evening/databases/">Базы данних</a>
                <a href="/courses/evening/web-design/">Веб-дизайн</a>
                <a href="/courses/evening/tech-english/">Технический английский</a>
                <a href="/courses/evening/it-help/">Помощь трудоустройства в ИТ</a>
                <a href="/courses/evening/agile_scrum/">Agile/Scrum</a>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>

<?php get_footer(); ?>