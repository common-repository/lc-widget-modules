<?php
class DSLC_Advanced_Posts extends DSLC_Posts {
	function __construct() {
		parent::__construct(); 
		$this->module_id = 'DSLC_Advanced_Posts';
		$this->module_title = __( 'Advanced Posts', 'live-composer-page-builder' );
		//$this->module_icon = 'th-large';
		//$this->module_category = 'Post-Based';
	}
	function options() {
		$options = parent::options();
		$categories = array(array(
			'label' => __( 'All', 'live-composer-page-builder' ),
			'value' => '',
		));
		$all = get_categories();
		foreach ($all as $cat) {
			$categories[] = array(
				'label' => $cat->cat_name,
				'value' => ''.$cat->cat_ID
			);
		}

		for ($i=0; $i<count($options); $i++) {
			if ($options[$i]['id'] == 'query_alter') {
				$options[$i] = array(
					'label' => __( 'Category', 'live-composer-page-builder' ),
					'id' => 'categories',
					'std' => '',
					'type' => 'select',
					'choices' => $categories,
					'tab' => 'posts query',
				);
				break;
			}
		}
		return $options;
	}
	static function dslc_module_options_before_output($options) {
		return $options;
	}
}
//add_filter('dslc_module_options_before_output', array('DSLC_Advanced_Posts', 'dslc_module_options_before_output');