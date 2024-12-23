<?php
/*
 * Define Variables
 */
if (!defined('SHIN_DIR_PATH'))
    define('SHIN_DIR_PATH',  untrailingslashit(get_template_directory()));
if (!defined('SHIN_DIR_URL'))
    define('SHIN_DIR_URL', get_template_directory_uri());
if (!defined('SHIN_SSD_PATH'))
    define('SHIN_SSD_PATH', get_stylesheet_directory());

foreach (glob(SHIN_DIR_PATH . "-child/includes/*.php") as $file_name) {
    require_once($file_name);
}


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
