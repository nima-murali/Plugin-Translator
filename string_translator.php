<?php
/*
Plugin Name: String Translator
Description: A translator plugin to translate strings to specified language.
Author: Nima
Version: 1.0
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( !class_exists( 'WpStringTranslator' )) {
	class WpStringTranslator{

		function __construct(){
			add_filter( 'the_content', array($this,'wp_display_date_and_time' ));
			add_action('admin_menu',array($this,'wp_setup_translator_menu'));
		}


		public function wp_setup_translator_menu(){
			add_menu_page( 'String Translator', 'String Translator', 'manage_options', 'translator-settings',array($this,'test_init'));
		}
		public function test_init(){
			$greeting = __( 'Good Morning!', 'string-translator' ) 
			echo "<h1>Hello world</h1>";
			echo $greeting;
		}
		public function wp_display_date_and_time($content){
			$post_type = get_post_type();
			if ($post_type == 'post'){
				//date_default_timezone_set('Indian/Mahe');
				$date 	= "Today's Date is : ";
				$date  .= date('Y-m-d');
				$time 	= "<br><br>Current Time is : ";
				$time  .= date('g:i:a');
				//$content .= "haiiiiiiiiiiiiiiiiiiii";
				return $content.$date.$time;
			}
			else{
				$content;
			}
		}
		public function wan_load_textdomain() {
			load_plugin_textdomain( 'wp-admin-motivation', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );
		}
	}

	$objtranslator	= new WpStringTranslator();
}

?>