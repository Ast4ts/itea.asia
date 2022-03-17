<form role="search" method="get" id="searchform" action="<?php echo home_url('/') ?>" >
    <input type="text" value="<?php echo get_search_query() ?>"  name="s" id="s" placeholder="Поиск по сайту" class="form-control form-lg" />
    <input type="submit" id="searchsubmit" value="Поиск" class="search-icon" />
</form>