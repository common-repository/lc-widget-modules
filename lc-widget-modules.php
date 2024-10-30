<?php

abstract class LC_Widget_Module extends DSLC_Module {
	var $module_category = 'Extensions';
	var $is_livecomposer = true;
	var $is_shortcode = false;
	var $is_widget = false;

	function output($options) {
		$this->module_start($options);
		$options = $options ? $options : array();
		echo $this->html_module($options);
		$this->module_end($options);
	}
	function html_module($options = null) {
		$options = $options ? $options : array();
		return $this->html($options);
	}
	public static function get_checkbox($options, $key) {
		return explode(' ', $options[$key]);
	}
	public static function is_checked($options, $key, $value) {
		return in_array($value, self::get_checkbox($options, $key));
	}
	public static function is_editing() {
		global $dslc_active;
		//isset($_REQUEST['module_id'])
		return ($dslc_active && is_user_logged_in() && current_user_can(DS_LIVE_COMPOSER_CAPABILITY)) || strpos($_SERVER['REQUEST_URI'], 'widgets.php') !== false;
	}
	public static function is_settings() {
		global $dslc_active;
		//isset($_REQUEST['module_id'])
		return $dslc_active && is_user_logged_in() && current_user_can(DS_LIVE_COMPOSER_CAPABILITY)
			&& $_REQUEST['action'] == 'dslc-ajax-display-module-options';
	}
	public static function notice($message) {
		return '<div class="dslc-notification dslc-green">' . __( $message, 'live-composer-page-builder' ) . '</div>';
	}
	public function get_options() {
		return array();
	}
	public function html($options) {
		return '';
	}
	public function options() {
		//$self = get_called_class();
		return apply_filters('dslc_module_options', $this->get_options(), $this->module_id);
	}
}

class LC_Anchor_Module extends LC_Widget_Module {
	var $module_category = 'Extensions';
	var $module_id = 'LC_Anchor_Module';
	var $module_title = 'Anchor';
	var $module_icon = 'anchor';
	
	public function get_options() {
		$options = array(
			array(
				'label' => 'Name',
				'id' => 'lc_name',
				'std' => '',
				'type' => 'text'
			)
		);
		return $options;
	}
	public function html($options = array()) {
		$html = '';
		$name = $options['lc_name'];
		if (self::is_editing()) {
			$html = '<div class="dslc-notification dslc-green">You can link to this section using #'.$name.'<br />
			This box will not display on the website</div>';
		} else {
			$html = '<a name="'.$name.'"></a>';
		}
		return $html;
	}
}