<?php
/*
Plugin Name: Redbubble via API
Plugin URI: https://github.com/markhowellsmead/mhm-redbubble-atom/
Description: A WordPress plugin to load, parse and display Redbubble products from a valid, public Atom feed.
Author: Mark Howells-Mead
Version: 0.1.0
Author URI: https://sayhello.ch/
*/

namespace MarkHowellsMead\RedbubbleAtom;

spl_autoload_register(
	function ($class_name) {
		if (false !== strpos($class_name, 'MarkHowellsMead\RedbubbleAtom')) {
			$classes_dir = realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;
			$class_file  = str_replace('MarkHowellsMead\RedbubbleAtom\\', '', $class_name) . '.php';
			require_once $classes_dir . $class_file;
		}
	}
);

new Plugin();
