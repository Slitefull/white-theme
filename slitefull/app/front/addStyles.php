<?php
/**************************
* Styles connector        *
* Created by Brackets.    *
* @package MT             *
* User: slitefull         *
* Date: 30/05/2020        *
* Time: 16:23 AM          *
***************************/

add_action('wp_enqueue_scripts', 'addHeaderStyles');
add_action('wp_footer', 'addFooterStyles');
function addHeaderStyles()
{
    if(is_front_page()) {
        wp_enqueue_style('home_page', get_template_directory_uri() . '/assets/css/home.css');
    }
}

function addFooterStyles()
{
    wp_enqueue_style('footer', get_template_directory_uri() . '/assets/css/footer.css');
}
