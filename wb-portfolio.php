<?php
/**
 * Plugin Name:		   WB Portfolio
 * Plugin URI:		   https://wbbrim.com/
 * Description:		   WB Portfolio is a custom post type based  Responsive Filterable Portfolio showing plugin.
 * Version: 		   1.0
 * Author: 			   wpbrim < imran@wpbrim.com >
 * Author URI: 		   https://wbbrim.com/
 * Text Domain:        wb-portfolio
 * License:            GPL-2.0+
 * License URI:        http://www.gnu.org/licenses/gpl-2.0.txt
 * License: GPL2
 */

 /**
  * Protect direct access
  */

 if( ! defined( 'WB_PORTFOLIO_HACK_MSG' ) ) define( 'WB_PORTFOLIO_HACK_MSG', __( 'Sorry ! You made a mistake !', 'wb-portfolio' ) );
 if ( ! defined( 'ABSPATH' ) ) die( WB_PORTFOLIO_HACK_MSG );

 /**
  * Defining constants
 */

 if( ! defined( 'WPPORTFOLIO_PLUGIN_DIR' ) ) define( 'WPPORTFOLIO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
 if( ! defined( 'WPPORTFOLIO_PLUGIN_URI' ) ) define( 'WPPORTFOLIO_PLUGIN_URI', plugins_url( '', __FILE__ ) );

// require files
require_once WPPORTFOLIO_PLUGIN_DIR .'/lib/wb-portfolio-cpt.php';
require_once WPPORTFOLIO_PLUGIN_DIR .'/lib/wb-metabox.php';
require_once WPPORTFOLIO_PLUGIN_DIR .'/public/wb-view.php';

 function wbportfolio_faq_enqueue_scripts() {
    //Plugin Main CSS File
     wp_enqueue_style('wb-portfolio-style', WPPORTFOLIO_PLUGIN_URI.'/assets/css/wb-portfolio-style.css');
     wp_enqueue_script('wb-isotope-js', WPPORTFOLIO_PLUGIN_URI.'/vendors/isotope/isotope.pkgd.min.js', array('jquery'),'1.3.1', true);
     wp_enqueue_script('wb-custom-js', WPPORTFOLIO_PLUGIN_URI.'/assets/js/wb-custom.js');
  }
 add_action( 'wp_enqueue_scripts', 'wbportfolio_faq_enqueue_scripts' );

 function wbportfolio_admin_style() {
  wp_enqueue_style( 'wbportfolio-admin', WPPORTFOLIO_PLUGIN_URI.'/assets/css/wb-portfolio-admin.css');
 }
 add_action( 'admin_enqueue_scripts', 'wbportfolio_admin_style' );

 // Sub Menu Page

 add_action('admin_menu', 'wbportfolio_menu_init');
 function wbportfolio_menu_help(){
   include('lib/wb-portfolio-help-upgrade.php');
 }
 function wbportfolio_menu_init()
   {
     add_submenu_page('edit.php?post_type=wbportfolio', __('Help & Upgrade','wb-portfolio'), __('Help & Upgrade','wb-portfolio'), 'manage_options', 'wbportfolio_menu_help', 'wbportfolio_menu_help');
   }
   
// adding link
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'wbportfolio_plugin_action_links' );
function wbportfolio_plugin_action_links( $links ) {
   $links[] = '<a class="wb-pro-link" href="https://wpbrim.com/product/wb-portfolio/" target="_blank">Pro Version</a>';
   $links[] = '<a href="https://wpbrim.com/products/" target="_blank">WB Plugins</a>';
   return $links;
}
