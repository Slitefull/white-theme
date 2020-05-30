<?php
/**************************
* Scripts connector       *
* Created by Brackets.    *
* User: slitefull         *
* Date: 30/05/2020        *
* Time: 16:23 AM          *
***************************/

add_action('wp_enqueue_scripts', 'addHeaderScripts');
add_action('wp_footer', 'addFooterScripts');

//если в хедер
function addHeaderScripts()
{
    wp_enqueue_script('main_script', ASSETS_URI . '/js/main.js');
}

//если в футер
function addFooterScripts()
{
    wp_enqueue_script('main_script', ASSETS_URI . '/js/main.js');

    if ( is_page_template('page.php') ) {
        wp_enqueue_script('page-script', ASSETS_URI . '/js/pages/page.js');
    }
}
