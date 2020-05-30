<?php
/************************************
* MaxShop functions and definitions *
* Created by Brackets.              *
* @package MT                       *
* User: slitefull                   *
* Date: 28/05/2020                  *
* Time: 12:22 AM                    *
************************************/

/*************
* constants *
*************/

define('APP_DIR', dirname(__FILE__) . "/app");
define('ASSETS_DIR', dirname(__FILE__) . "/assets");

define('ASSETS_URI', get_template_directory_uri() . "/assets/");

define('CURRENT_LANG', $lang ?? 'ru');
define('APP_DIR', dirname(__FILE__) . "/app");
define('ASSETS_DIR', dirname(__FILE__) . "/assets");
define('LAYOUTS_DIR', dirname(__FILE__) . "/layouts");

define('ASSETS_URI', get_template_directory_uri() . "/assets/");

/*****************************************
* constant for polylang default language *
*****************************************/
if(function_exists('pll_current_language')){
    $lang = pll_current_language();
}

/*****************
* classes loader *
*****************/
spl_autoload_register(function ($class) {
    $folders = ['/classes/',];
    foreach ($folders as $folder) {
        if (file_exists(str_replace('\\', '/', APP_DIR . $folder . $class . '.php')))
            include str_replace('\\', '/', APP_DIR . $folder . $class . '.php');
    }
});

/*******************
* Kama Breadcrumbs *
********************/
function kama_breadcrumbs( $sep = ' » ', $l10n = array(), $args = array() ){
    $kb = new Kama_Breadcrumbs;
    $home = 'Home';
    $paged = 'Paged';
    $error = 'breadcrumbs_error';
    $search = 'breadcrumbs_search';
    $authorArchive = 'breadcrumbs_authorArchive';
    $archiveFor = 'breadcrumbs_archiveFor';
    $year = 'breadcrumbs_year';
    $media = 'breadcrumbs_media';
    $tagEntries = 'breadcrumbs_tagEntries';
    $byTag = 'breadcrumbs_byTag';
    $of = 'breadcrumbs_of';

    $l10n = [
        'home'       => $home,
        'paged'      => $paged. ' %d',
        '_404'       => $error. ' 404',
        'search'     => '<span class="breadcrumbs__current">'. $search. ' - "%s"</span>',
        'author'     => $authorArchive. ': %s',
        'year'       => $archiveFor. '%d '. $year,
        'month'      => $archiveFor. ': %s',
        'day'        => '',
        'attachment' => $media. ': %s',
        'tag'        => $tagEntries. ': %s',
        'tax_tag'    => '%1$s '. $of. ' "%2$s" '. $byTag. ': %3$s',
    ];

    echo $kb->get_crumbs( $sep, $l10n, $args );
}

/***************************
* link directory templates *
****************************/
require_once(APP_DIR . '/core/metaBoxes.php');

require_once(APP_DIR . '/front/menuCreator.php');
require_once(APP_DIR . '/front/addStyles.php');
require_once(APP_DIR . '/front/addScripts.php');
