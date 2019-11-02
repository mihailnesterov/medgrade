<?php
// сохранение истории запросов в таблице wp_search_history
$s = $_GET['s'];
if(isset($s)){
    $the_ID = get_the_ID();
    $url = get_page_uri(get_the_ID());
    // раскомментировать, чтобы заработало:
    /*$wpdb->insert( 
        $wpdb->prefix.'search_history',
        array(
            'search_string' => $s,
            'url' => $url, 
        ), 
        array( 
            '%s',
            '%s'
        ) 
    );*/
}
?>
<div id="search-form-container" class="container block">
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
	<div id="search-input-block">
        <input 
            type="text" 
            id="search-input" 
            placeholder="Поиск медицинского оборудования по ключевым словам"
            value="<?php echo get_search_query() ?>" 
            name="s" 
            autocomplete="off"
        />
        <div id="search-list">
        </div>
        <!--<input type="hidden" value="post" name="post_type" />-->
    </div>
    <div id="search-button-block">
        <button type="submit" id="search-submit">Поиск по сайту</button>
    </div>
</form>

</div>