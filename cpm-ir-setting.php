<?php

/*
Plugin Name: CPM IR Setting
Plugin URI: https://codepixelzmedia.com/
Description: IR Setting
Version: 1.0.0
Author: CPM
Author URI: https://codepixelzmedia.com/
*/

if (!defined('ABSPATH')) {
   exit;
}

;
/* require plugin loder file */
$init_file = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . "cpm-ir-setting" . DIRECTORY_SEPARATOR  . "cpm-ir-setting-loader.php";
require $init_file;