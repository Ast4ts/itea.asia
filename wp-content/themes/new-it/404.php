<?php get_header(); ?>

<div class="container">
    <div class="post page404">

        <div id="cowBoy"></div>
        <div class="errorMessage404">
            Ошибка <span>404</span>
        </div>
        <div class="textError404">
            <p>Ёу-ёу, ковбой! Притормози!
                Здесь нет того, что ты ищешь.</p>
            <p>Думаю, тебе нужно вернуться туда,
                откуда ты пришел!</p>
        </div>
        <div class="links404">
            <a id="rollBack" onclick="history.back();">Назад</a>
            <a href="<?php echo get_home_url(); ?>">На главную</a>
        </div>

    </div>
</div>

<?php get_footer(); ?>