<?php
/**************************
* Styles connector        *
* Created by Brackets.    *
* @package MT             *
* User: slitefull         *
* Date: 30/05/2020        *
* Time: 16:23 AM          *
***************************/

add_action('after_setup_theme', function () {
    register_nav_menus([
        'header_menu' => 'Header menu',
        'footer_menu' => 'Footer menu'
    ]);
});
