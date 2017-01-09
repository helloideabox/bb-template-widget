<?php
/**
 * Plugin Name: Template Widget for Beaver Builder
 * Plugin URI: https://wpbeaveraddons.com
 * Description: Adds a widget to display Beaver Builder saved templates in sidebar, footer or any other area.
 * Version: 1.0.0
 * Author: Beaver Addons, Achal Jain
 * Author URI: https://wpbeaveraddons.com
 * Copyright: (c) 2016 IdeaBox Creations
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: bb-template-widget
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TWBB_VER', '1.0.0' );
define( 'TWBB_DIR', plugin_dir_path( __FILE__ ) );
define( 'TWBB_URL', plugins_url( '/', __FILE__ ) );
define( 'TWBB_PATH', plugin_basename( __FILE__ ) );

if ( class_exists( 'FLBuilderModel' ) ) :

    /**
     * Get Beaver Builder saved templates.
     */
    function twbb_get_saved_templates( $type = 'layout' )
    {
        $templates = get_posts( array(
            'post_type'          => 'fl-builder-template',
            'orderby' 			 => 'title',
            'order'              => 'ASC',
            'posts_per_page'     => '-1',
            'tax_query'          => array(
                array(
                    'taxonomy' => 'fl-builder-template-type',
                    'field'    => 'slug',
                    'terms'    => $type
                )
            )
        ) );

        $options = array();

        if (count($templates)) {
            foreach ($templates as $template) {
                $options[$template->ID] = $template->post_title;
            }
        }

        return $options;
    }

    /**
     * Load widget class.
     */
    require_once TWBB_DIR . 'classes/class-template-widget.php';

endif;
