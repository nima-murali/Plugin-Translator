<?php
/*
Plugin Name: Plugin Translator
Description: A translator plugin to translate strings to specified language.
Author: Nima
Version: 1.0
Text Domain: Plugin Translator
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( !class_exists( 'WpStringTranslator' )) {
	class WpStringTranslator{

		function __construct(){
			add_action( 'init', array($this,'load_textdomain' ));
			add_action('admin_menu',array($this,'wp_setup_translator_menu'));
			add_filter( 'the_content', array($this,'wp_display_date_and_time' ));
			add_action('wp_enqueue_scripts', array($this,'load_scripts'));
		}


		public function wp_setup_translator_menu(){
			add_menu_page(
			__( 'StringTranslator', 'plugin_translator' ),
			__( 'StringTranslator', 'plugin_translator' ),
			'manage_options',
			'translator_settings',
			array($this, 'test_init'),
			);


		}
		public function test_init(){
			$greeting = __( 'Good Morning!', 'plugin_translator' );
			?> <h1><?php _e("Hello world",'plugin_translator'); ?></h1> <?php
			echo $greeting;
			?>
			<!--
			<br><br>
			<button onclick="displayalert(this,event)" id="exitbutton" ></button>
			
			<script>
				function displayalert() {
					alert("Are you sure you want to exit?");
				}	
			</script>
			-->
			<?php
		}
		public function wp_display_date_and_time($content){
			$post_type = get_post_type();
			if ($post_type == 'post'){
				//date_default_timezone_set('Indian/Mahe');
				$date 	= __("Today's Date is : ",'plugin_translator');
				$date  .= date('Y-m-d');
				$date  .= "<br><br>";
				$time 	= __("Current Time is : ",'plugin_translator');
				$time  .= date('g:i:a');
				return $content.$date.$time;
			}
			else{
				$content;
			}
		}
		public function load_textdomain() {
			load_plugin_textdomain( 'plugin_translator', false, basename( dirname( __FILE__ ) ) . '/languages/' );
		}

		public function load_scripts() {

			//wp_register_script('demo',plugins_url('demo.js', __FILE__),array('wp-i18n'),false,true);
			wp_enqueue_script('demo-js',plugins_url( '/demo.js', __FILE__ ));
			wp_set_script_translations('demo-js', 'plugin_translator',  plugin_dir_path(__FILE__) . 'languages/');
		}
	}

	$objtranslator	= new WpStringTranslator();
}

?>