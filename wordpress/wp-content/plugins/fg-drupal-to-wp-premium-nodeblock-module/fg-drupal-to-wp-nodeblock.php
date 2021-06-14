<?php
/**
 * Plugin Name: FG Drupal to WordPress Premium Nodeblock module
 * Depends:		FG Drupal to WordPress Premium
 * Plugin Uri:  https://www.fredericgilles.net/fg-drupal-to-wordpress/
 * Description: A plugin to migrate the data from the Nodeblock Drupal module to WordPress
 * 				Needs the plugin «FG Drupal to WordPress Premium» to work
 * Version:     1.1.0
 * Author:      Frédéric GILLES
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

add_action( 'admin_init', 'fgd2wp_nodeblock_test_requirements' );

if ( !function_exists( 'fgd2wp_nodeblock_test_requirements' ) ) {
	function fgd2wp_nodeblock_test_requirements() {
		new fgd2wp_nodeblock_requirements();
	}
}

if ( !class_exists('fgd2wp_nodeblock_requirements', false) ) {
	class fgd2wp_nodeblock_requirements {
		private $parent_plugin = 'fg-drupal-to-wp-premium/fg-drupal-to-wp-premium.php';
		private $required_premium_version = '1.32.0';

		public function __construct() {
			load_plugin_textdomain( 'fgd2wp_nodeblock', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
			if ( !is_plugin_active($this->parent_plugin) ) {
				add_action( 'admin_notices', array($this, 'error') );
			} else {
				$plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/' . $this->parent_plugin);
				if ( !$plugin_data or version_compare($plugin_data['Version'], $this->required_premium_version, '<') ) {
					add_action( 'admin_notices', array($this, 'version_error') );
				}
			}
		}
		
		/**
		 * Print an error message if the Premium plugin is not activated
		 */
		function error() {
			echo '<div class="error"><p>[fgd2wp_nodeblock] '.__('The Nodeblock module needs the «FG Drupal to WordPress Premium» plugin to work. Please install and activate <strong>FG Drupal to WordPress Premium</strong>.', 'fgd2wp_nodeblock').'<br /><a href="https://www.fredericgilles.net/fg-drupal-to-wordpress/" target="_blank">https://www.fredericgilles.net/fg-drupal-to-wordpress/</a></p></div>';
		}
		
		/**
		 * Print an error message if the Premium plugin is not at the required version
		 */
		function version_error() {
			printf('<div class="error"><p>[fgd2wp_nodeblock] '.__('The Nodeblock module needs at least the <strong>version %s</strong> of the «FG Drupal to WordPress Premium» plugin to work. Please install and activate <strong>FG Drupal to WordPress Premium</strong> at least the <strong>version %s</strong>.', 'fgd2wp_nodeblock').'<br /><a href="https://www.fredericgilles.net/fg-drupal-to-wordpress/" target="_blank">https://www.fredericgilles.net/fg-drupal-to-wordpress/</a></p></div>', $this->required_premium_version, $this->required_premium_version);
		}
	}
}

if ( !defined('WP_LOAD_IMPORTERS') && !defined('DOING_AJAX') && !defined('DOING_CRON') && !defined('WP_CLI') ) {
	return;
}

add_action( 'plugins_loaded', 'fgd2wp_nodeblock_load', 25 );

if ( !function_exists( 'fgd2wp_nodeblock_load' ) ) {
	function fgd2wp_nodeblock_load() {
		if ( !defined('FGD2WPP_LOADED') ) return;

		load_plugin_textdomain( 'fgd2wp_nodeblock', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		
		global $fgd2wpp;
		new fgd2wp_nodeblock($fgd2wpp);
	}
}

if ( !class_exists('fgd2wp_nodeblock', false) ) {
	class fgd2wp_nodeblock {
		
		/**
		 * Sets up the plugin
		 *
		 */
		public function __construct($plugin) {
			
			$this->plugin = $plugin;
			
			add_filter( 'fgd2wp_pre_display_admin_page', array ($this, 'process_admin_page'), 11, 1 );
			add_filter( 'fgd2wp_import_node_fields', array ($this, 'insert_nodeblock_into_content'), 10, 1 );
		}
		
		/**
		 * Add information to the admin page
		 * 
		 * @param array $data
		 * @return array
		 */
		public function process_admin_page($data) {
			$data['title'] .= ' ' . __('+ Nodeblock module', __CLASS__);
			$data['description'] .= "<br />" . __('The Nodeblock module will also import the fields from the Nodeblock Drupal module.', __CLASS__);
			
			return $data;
		}
		
		/**
		 * Insert the Nodeblock fields into the content
		 * 
		 * @param array[
		 *			string $custom_field_name Custom field name
		 *			$custom_field Custom field
		 *			$custom_field_values Custom field values
		 *		  ]
		 * @return array
		 */
		public function insert_nodeblock_into_content($params) {
			list($custom_field_name, $custom_field, $custom_field_values) = $params;
			if ( $custom_field['type'] == 'field_collection' ) {
				if ( isset($custom_field['columns']['value']) ) {
					$content_values = array();
					$custom_field_name = 'body';
					$value_column = $custom_field['columns']['value'];
					foreach ( $custom_field_values as $value ) {
						if ( isset($value[$value_column]) ) {
							$field_content_entity_id = $value[$value_column];
							$field_content_value = $this->get_field_content_value($field_content_entity_id);
							if ( !empty($field_content_value) ) {
								$content_values[] = $field_content_value;
							}
						}
					}
					$custom_field_values = $content_values;
				}
			}
			return array($custom_field_name, $custom_field, $custom_field_values);
		}
		
		/**
		 * Get the value from a field content
		 * 
		 * @param int $entity_id Entity ID
		 * @return mixed Value
		 */
		private function get_field_content_value($entity_id) {
			$value = '';
			$prefix = $this->plugin->plugin_options['prefix'];
			$sql = "
				SELECT fc.field_content_value
				FROM ${prefix}field_data_field_content fc
				WHERE entity_type = 'field_collection_item'
				AND entity_id = '$entity_id'
				AND deleted = 0
				LIMIT 1
			";
			$result = $this->plugin->drupal_query($sql);
			if ( !empty($result) ) {
				$value = $result[0]['field_content_value'];
			}
			return $value;
		}
		
	}
}
