<?php
/*
Plugin Name: LC Widget Modules
Plugin URI: https://wordpress.org/plugins/lc-widget-modules
Version: 1.0.1
Description: Additional modules for live composer that can also be used as wordpress shortcodes or widgets
Author: James Low
Author URI: http://jameslow.com
*/

class LC_Widget_Modules_Plugin {
	static $widgets;

	public static function add_hooks() {
		self::$widgets = array(
			'Anchor' => 'Add an anchor you can link to from a button or link'
		);
		add_action('dslc_hook_register_modules', array(static::class, 'register_modules'));
	}
	public static function register_modules() {
		require_once 'lc-widget-modules.php';
		require_once 'lc-widget-modules-mods.php';
		foreach (self::$widgets as $title => $desc) {
			dslc_register_module('LC_'.str_replace(' ','_',$title).'_Module');
			dslc_register_module('DSLC_Advanced_Posts');
		}
	}
}
LC_Widget_Modules_Plugin::add_hooks();