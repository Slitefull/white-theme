<?php
/**
 * Created by PhpStorm.
 * User: ole.andreynik
 * Date: 7/25/2018
 * Time: 6:08 PM
 */

/**
 * A function that makes a change to a global variable $wp_query. After the loop you should always use wp_reset_query().
 *
 * @param callable $callback
 * @return array
 */
function AddToQuery(callable $callback)
{
    global $wp_query;
    $newQuery = call_user_func($callback);
    return query_posts(array_merge($newQuery, $wp_query->query));
}

function registerPolyLangVariables()
{
    if (function_exists("pll_register_string")) {
        $arTranslateFiles = getTranslateFiles();
        if (!empty($arTranslateFiles)) {
            foreach ($arTranslateFiles as $group => $filePath) {

                $varPrefix = explode(" (",$group);
                $varPrefix = array_shift($varPrefix);
                $filePath = str_replace('\\', '/', $filePath);
                if (file_exists($filePath)) {
                    $translateVars = file_get_contents($filePath);
                }

                if (!empty($translateVars)) {
                    $translateVars = json_decode($translateVars);

                    foreach ($translateVars as $varName => $defTranslate) {
                        pll_register_string( $varPrefix . "_" . $varName, $varPrefix . "_" .$varName, $group);
                    }
                }
            }
        }
    }
}

registerPolyLangVariables();
function getTranslateFiles()
{
    $baseDir = APP_DIR . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR;
    $arDir = scandir($baseDir);
    $arTranslateFilesInfo = [];
    $arTranslateFile = null;
    if (!empty($arDir)) {
        $arDir = array_diff($arDir, ['..', '.']);

        foreach ($arDir as $blockVariant) {
            $arTranslateFile = scandir($baseDir . $blockVariant);
            $arTranslateFile = array_diff($arTranslateFile, ['..', '.']);

            if (!empty($arTranslateFile)) {
                foreach ($arTranslateFile as $fileName) {

                    $filePath = $baseDir . $blockVariant . DIRECTORY_SEPARATOR . $fileName;
                    $prefix = $blockVariant . " (" . substr($fileName, 0, (strlen($fileName) - 5)) . ")";
                    $arTranslateFilesInfo[$prefix] = $filePath;
                }
            }
        }
    }
    return $arTranslateFilesInfo;
}

/**
 * function check main page
 * @return bool
 */
function isMainPage():bool
{
    $isHome = false;
    $langFromUrl = $_SERVER['REQUEST_URI'];
    if ($langFromUrl !== '/') {
        $langFromUrl = str_replace("/", "", $langFromUrl);
        $isHome = in_array($langFromUrl, pll_languages_list());
    } else{
        $isHome = true;
    }



    return $isHome;
}



