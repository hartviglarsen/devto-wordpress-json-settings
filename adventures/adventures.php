<?php
/*
Plugin Name: Adventures
Plugin URI: https://mortenhartvig.dk
Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pharetra nisi eu varius pellentesque. Aenean posuere, velit mollis sodales convallis, ipsum lectus feugiat nunc, ac auctor sapien enim eu metus.
Version: 1
Requires at least: 6.1
Requires PHP: 8.3
Author: Morten Hartvig
Author URI: https://mortenhartvig.dk
License: Do whatever you want
*/

define('ADV__PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ADV__PLUGIN_VIEW', ADV__PLUGIN_DIR . 'views/');
define('ADV__PLUGIN_SLUG', 'adv');

require_once ADV__PLUGIN_DIR . 'class.adventures.php';

(new Adventures());
