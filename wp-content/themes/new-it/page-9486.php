<?php get_header(); ?>

<style type="text/css">
    label {
        position: relative;
        border-radius: 5px;
        width: 70%;
        text-align: left;
    }
    label input {
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5);
        border-radius: 5px;
        width: 100%;
        margin: 10px 0px 25px;
    }
    .password-form {
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5);
        width: 50%;
        margin: 50px auto;
        border-radius: 5px;
    }
    .password-form p {
        font-size: 18px;
        text-align: center;
        padding-top: 15px;
        margin: 0;
    }
    .password-form input[type="submit"] {
        background: #0bac7c;
        border: none;
        color: white;
        width: 70%;
        height: 50px;
        margin-bottom: 20px;
        font-size: 14px;
        line-height: 20px;
        text-transform: uppercase;
        vertical-align: middle;
        display: inline-block;
        border-radius: 4px;
        position: relative;
        overflow: hidden;
    }
    .password-form label[for="pwbox-9486"]{
        position: static;
    }
    .dates-filter {
        min-height: 100px;
    }
    .tagit {
        float: left !important;
        width: 100% !important;
        max-width: 590px !important;
        margin: 15px 40px 0 0 !important;
        padding: 1px 6px 0  4px !important;
        background-color: #fff !important;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) !important;
        border: none !important;
        border-radius: 5px !important;
        border-bottom: 1px solid #133b54 !important;
    }
    .dates-filter > input {
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5);
        font-size: 15px;
        padding: 5px 10px 5px 5px;
        display: block;
        width: 100%;
        border: none;
        border-radius: 5px;
        border-bottom: 1px solid #133b54;
    }
    .dates-filter > input[type=text] {
        line-height: 30px;
        width: 30%;
        min-width: 300px;
    }

    ::-webkit-input-placeholder {color:#9E9E9E; font-weight: 500;}
    ::-moz-placeholder          {color:#9E9E9E; font-weight: 500;}
    :-moz-placeholder           {color:#9E9E9E; font-weight: 500;}
    :-ms-input-placeholder      {color:#9E9E9E; font-weight: 500;}
    input[placeholder]          {text-overflow:ellipsis;}
    input::-moz-placeholder     {text-overflow:ellipsis;}
    input:-moz-placeholder      {text-overflow:ellipsis;}
    input:-ms-input-placeholder {text-overflow:ellipsis;}

    .dates-filter > input[type=date] {
        line-height: 20px;
        width: 25%;
        float: left;
        margin-right: 40px;
    }
    .dates-filter > input[type="submit"] {
        background: #0bac7c;
        border: none;
        color: white;
        width: 25%;
        min-width: 200px;
        height: 35px;
        line-height: 20px;
        text-transform: lowercase;
        vertical-align: middle;
        display: inline-block;
        border-radius: 5px;
        position: relative;
        overflow: hidden;
    }
    .filters-block {
        color: #133b54;
    }
    .filters-block a {
        float: right;
        color: #e11030;
    }
    .table-all-resume {
        width: 100%;
        color: #133b54;
        background-color: #fff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5);
        font-size: 15px;
    }
    .table-all-resume th {
        font-weight: 500;
        font-size: 16px;
        background-color: #DFEAF0;
    }
    .table-all-resume th,
    .table-all-resume td {
        padding: 8px;
        border: 1px solid #ECEFF1;
        text-align: center;
    }
    .table-all-resume th:first-child,
    .table-all-resume td:first-child,
    .table-all-resume td:last-child {
        text-align: left;
    }
    .table-all-resume td > a {
        text-decoration: underline;
    }
    .table-all-resume button:hover,
    .table-all-resume td > a:hover {
        color: #e11030;
    }
    .table-all-resume tr:hover {
        background: #F3F3F5;
    }
    .admin-comment {
        max-width: 310px;
        word-wrap: break-word;
    }
    .just-do-it form {
        display: inline;
    }
    .just-do-it button,
    .just-do-it a {
        font-size: 18px;
        margin-right: 20px;
    }
    .just-do-it a:last-child {
        margin-right: 0px;
    }
    .just-do-it button {
        border: 0;
        background: none;
    }
    .confirm-red {
        color: #e11030;
    }
    .confirm-green {
        color: #0bac7c;
    }
    .paginate-links {
        margin: 25px 0px;
        font-size: 16px;
        color: #fff;
        border-radius: 5px;
        background-color: #0bac7c;
        float: left;
    }
    .paginate-links span,
    .paginate-links a {
        color: #fff;
        float: left;
        padding: 10px 15px;
        margin: 0;
        text-decoration: none;
    }
    .paginate-links a:hover {
        background-color: #0f7864;
    }
    .paginate-links a:last-child{
        border-right: 0;
    }
    .paginate-links .current {
        background-color: #0f7864;
    }
    .paginate-links a:last-child {
        border-radius: 0px 5px 5px 0px
    }
    .paginate-links a:first-child {
        border-radius: 5px 0px 0px 5px
    }
    .paginate-links a:hover:last-child {
        border-radius: 0px 5px 5px 0px
    }
    .paginate-links a:hover:first-child {
        border-radius: 5px 0px 0px 5px
    }
    .page-numbers:first-child {
        border-radius: 5px 0px 0px 5px
    }
    .page-numbers:last-child {
        border-radius: 0px 5px 5px 0px
    }
    .glyphicon-sort {
        font-size: 14px;
        font-weight: 600;
        padding-left: 5px;
    }
    .message-block {
        height: 35px;
        text-align: center;
        padding-top: 4px;
        margin-bottom: 20px;
        color: #d31f45;
        border: 1px solid #d31f45;
        border-radius: 3px;
    }
</style>
<div class="container">

<?php
// pass: &P)4N(WR#vmZV4H9 || mu#$Au^7FZzgdfhD
if( post_password_required() ){
    echo '<div class="password-form">', get_the_password_form(), '</div>';
} else {
//    $date1   = (array_key_exists('date1', $_POST) ? $_POST['date1'] : (array_key_exists('after',  $_GET) ? $_GET['after'] : ''));
//    $date2   = (array_key_exists('date2', $_POST) ? $_POST['date2'] : (array_key_exists('before', $_GET) ? $_GET['before'] : ''));
    $courses = (array_key_exists('courses_filter', $_POST) ? implode(', ', $_POST['courses_filter']) : '');
    $filter_by_name = (array_key_exists('filter_by_name', $_POST) ? esc_sql($_POST['filter_by_name']) : '');
    $filters_array  = array();
    $filters_msq    = '';

    $posts = get_posts(array(
                        'numberposts' => -1,
                        'category'    => '22',
                        'post_type'   => 'post',
                        'orderby'     => 'title'
    ));

    if(!empty($courses)){
        $stack = explode(', ', trim(htmlspecialchars($courses)));
        foreach($posts as $post){
            if( in_array($post->post_title, $stack) ){
                array_push($filters_array, "courses REGEXP '(^|,)$post->ID(,|$)'");
                if( sizeof($stack) == sizeof($filters_array) ){ break; }
            }
        }
        $filters_msq .= $courses;
    }

    ### START creating conditions where
//    if(!empty($date1)){
//        array_push($filters_array, "date_time >= STR_TO_DATE('".trim(htmlspecialchars($date1))." 00:00:00', '%Y-%m-%d %H:%i:%s')");
//    }
//    if(!empty($date2)){
//        array_push($filters_array, "date_time <= STR_TO_DATE('".trim(htmlspecialchars($date2))." 23:59:59', '%Y-%m-%d %H:%i:%s')");
//    }
//    $filters_msq .= (!empty($date1) ? ' с '.$date1.' (включительно)' : '') . (!empty($date2) ? ' до '.$date2.' (включительно)' : '');

    if (!empty($filter_by_name)) {
        array_push($filters_array, "name LIKE '%".$filter_by_name."%'");
        $filters_msq .= ' &nbsp; &nbsp; &nbsp; Фильтр по имени: ' . $filter_by_name;
    }


    $where = '';
    if (!empty($filters_array)) {
        $where = ' WHERE '.implode(' AND ', $filters_array);
        unset($_GET['pg']);
    }
    ### END creating conditions where

    global $wpdb;
    $table_name  = $wpdb->get_blog_prefix() . 'resume';

    if (array_key_exists('del_resume_id', $_POST)) {
//        if(is_super_admin($user_ID)){
            $img = $wpdb->get_var('SELECT link_to_photo FROM '.$table_name.' WHERE uniqid = '."'$_POST[del_resume_id]'");
            $message_block = $wpdb->delete($table_name, array('uniqid' => $_POST['del_resume_id']), array( '%s' ));
            ($message_block && isset($img) ? (is_file($img) ? unlink($img) : '') : '');
            $message_block = ($message_block ? 'Запись успешно удалена' : 'Произошла ошибка при удалении');
//        } else {
//            $message_block = 'Отказано в доступе';
//        }
    }

    $total_lines = $wpdb->get_var('SELECT COUNT(*) FROM '.$table_name.$where);

    $items_per_page = 40;
    if(array_key_exists('date1', $_POST) || array_key_exists('date2', $_POST)){
        $page = '1';
    } else {
        $page = (array_key_exists('pg', $_GET) ? abs( (int) $_GET['pg'] ) : 1);
    }
    $offset = $page * $items_per_page - $items_per_page;
?>
<div class="head-section">
    <h1><?php the_title(); ?></h1>
</div>
<?php
if(!empty($message_block)){
    ?><div class="message-block"><span class="glyphicon glyphicon-info-sign" style="font-size:18px;"></span> <?php echo $message_block; ?></div><?php
}
?>
<div class="filters-block">Количество результатов: <?php echo min($items_per_page*$page, $total_lines), ' / ', $total_lines; ?></div>
<form method="post" class="dates-filter">
    <input type="text" name="filter_by_name" placeholder="Фильтр по имени" value="<?php echo $filter_by_name; ?>">
    <?php
    if (false) {
        echo '<input type="date" name="date1" placeholder=" from date" value="', $date1, '">';
        echo '<input type="date" name="date2" placeholder=" to date"   value="', $date2, '">';
    }
    ?>
    <div class="completed-courses">
        <ul id="myULTags"><li><?php echo str_replace(', ', '</li><li>', $courses); ?></li></ul>
    </div>
    <input type="submit" value="Отфильтровать">
</form>
<script src="<?php bloginfo('template_directory'); ?>/relize/js/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/relize/js/tags.min_v2.js"></script>
<?php
$listCourses = '';
foreach($posts as $post){
    $listCourses .= "'".$post->post_title."',";
}
$listCourses = str_replace('&#038;', '&', $listCourses);
?>
<script type="text/javascript">
$(document).ready(function () {
    var sampleTags = [<?php echo $listCourses; ?>];
    $('#myULTags').tagit({
        availableTags: sampleTags,
        fieldName: 'courses_filter[]',
        showAutocompleteOnFocus: true
    });
});
</script>

<?php
    echo '<div class="filters-block">';
    if(!empty($filters_msq)){
        echo '<br><span class="glyphicon glyphicon-calendar"></span> Фильтры: ';
        echo $filters_msq;
    }
    echo '<a href="', get_permalink(9486), '"><span class="glyphicon glyphicon-remove-circle"></span> сбросить фильтры</a></div>';

    $tab  = 0;
    if(array_key_exists('tab', $_GET)) {
        $tab = (int)!(bool)$_GET['tab'];
    }
    if(array_key_exists('sort', $_GET) && !empty($_GET['sort'])) {
        $options = array('name' => 'name', 'date' => 'id', 'status' => 'confirm');
        if( array_key_exists($_GET['sort'] , $options) ){
            $sort = $options[$_GET['sort']];
        }
    }

    $args = array();
    if(!empty($date1)) { $args['after']  = $date1; }
    if(!empty($date2)) { $args['before'] = $date2; }
    $args['tab']  = $tab;
    $args['sort'] = '';
    $args['pg']   = 1;

    echo '<table class="table-all-resume"><tr>';
        $args['sort']  = 'name';
        echo '<th><a href="', add_query_arg($args), '">ФИО слушателя <span class="glyphicon glyphicon-sort"></span></a></th>';
        $args['sort']  = 'date';
        echo '<th><a href="', add_query_arg($args), '">Дата резюме <span class="glyphicon glyphicon-sort"></span></a></th>';
        $args['sort']  = 'status';
        echo '<th><a href="', add_query_arg($args), '">Статус <span class="glyphicon glyphicon-sort"></span></a></th>';

        echo '<th>Действия</th>'; //Just do it
        echo '<th>Оферта</th>';
        echo '<th>Комментарий</th>';
    echo '</tr>';

    $tab = ($tab ? 'ASC' : 'DESC');
    if(empty($sort)) { $sort = 'confirm, id'; }
    $all_resumes = $wpdb->get_results('SELECT date_time,name,uniqid,confirm,comment,public_offer FROM '.$table_name.$where." ORDER BY ${sort} ${tab} LIMIT ${offset}, ${items_per_page}" , ARRAY_A);

    foreach ($all_resumes as $resume){
        echo '<tr>';
        echo '<td>'.$resume['name'].'</td>';
        echo '<td>'.substr($resume['date_time'], 0, 10).'</td>';
        echo '<td><span class="glyphicon glyphicon-'.($resume['confirm'] ? 'ok confirm-green' : 'remove confirm-red').'"></span></td>';
        echo '<td class="just-do-it">';
//        if(is_super_admin($user_ID)){
            echo '<form method="post" onsubmit="delete_resume(this,',"'",$resume['name'],"'",');return false;">';
            echo '<input type="hidden" name="del_resume_id" value="',$resume['uniqid'],'">';
            echo '<button type="submit"><span class="glyphicon glyphicon-trash"></span></button>';
            echo '</form>';
//        }
        echo '<form method="post" target="_blank" action="',get_permalink(9571),'">';
        echo '<input type="hidden" name="id" value="',$resume['uniqid'],'">';
        echo '<button type="submit" title="редактировать"><span class="glyphicon glyphicon-pencil"></span></button>';
        echo '</form>';

        echo '<a href="'.add_query_arg('id', $resume['uniqid'], get_permalink(7633)).'" title="перейти" target="_blank"><span class="glyphicon glyphicon-chevron-right"></span></a>';
        echo '</td>';
        echo '<td><span class="glyphicon glyphicon-'.(empty($resume['public_offer']) ? 'remove confirm-red' : 'ok confirm-green').'"></span></td>';
        echo '<td class="admin-comment">', mb_substr($resume['comment'],0,200), (mb_strlen($resume['comment'])>200 ? ' <b>...</b>' : ''), '</td>';
        echo '</tr>';
    }
    echo '</table>';

    if(!empty($_GET['tab']))  { $args['tab']  = $_GET['tab'];  } else { unset($args['tab']);  }
    if(!empty($_GET['sort'])) { $args['sort'] = $_GET['sort']; } else { unset($args['sort']); }
    $args['pg'] = '%#%';

    echo '<div class="paginate-links">', paginate_links(array(
        'base'      => (array_key_exists('pg', $_GET) ? add_query_arg($args) : '%_%'),
        'format'    => (array_key_exists('pg', $_GET) ? '' : '?pg=%#%'),
        'total'     => ceil($total_lines / $items_per_page),
        'current'   => $page,
        'prev_text' => __('&laquo; Previous'),
        'next_text' => __('Next &raquo;'),
        'end_size'  => 2,
        'mid_size'  => 4
    )), '</div>';
}
?>

</div>
<script type="text/javascript">
    function delete_resume(f,name) {
        if(confirm('Коля! Ты точно хочешь удалить запись "' + name + '" ???')) f.submit();
    }
</script>
<?php get_footer(); ?>