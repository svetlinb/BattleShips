<?php 
/**
 * Path configuration
 *
 * In this file you set paths to different directories used by App.
 *
 */

/**
 * Use the DS to separate the directories in other defines
 */
if (!defined('DS')) {
	define('DS', '/');
}

/**
 * The full path to the directory which holds "app", WITHOUT a trailing DS.
 *
 */
if (!defined('WWW_ROOT')) {
	define('WWW_ROOT', dirname(__FILE__) . DS);
}

/**
 * Path to the libs directory.
 */
define('LIBS', WWW_ROOT.'libs'.DS);

/**
 * Path to the core directory.
 */
define('CORE', WWW_ROOT.'core'.DS);

/**
 * Path to the controller directory.
 */
define('CONTROLLER', WWW_ROOT.'Controller'.DS);

/**
 * Path to the model directory.
 */
define('MODEL', WWW_ROOT.'Model'.DS);

/**
 * Path to the view directory.
 */
define('VIEW', WWW_ROOT.'View'.DS);

define('SAVE_PATH', getcwd().DS."object.saved");
?>