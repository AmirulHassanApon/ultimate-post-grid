<?php
/**
 * Plugin Name: Ultimate Post Grid
 * Description: A plugin to create a grid layout for posts.
 * Version: 1.0
 * Author: Your Name
 * Text Domain: ultimate-post-grid
 */

if ( ! defined( 'WPINC' ) ) {
    die;
}

require plugin_dir_path( __FILE__ ) . 'includes/class-ultimate-post-grid.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-ultimate-post-grid-sections.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-ultimate-post-grid-metabox.php';

function run_ultimate_post_grid() {
    $plugin = new Ultimate_Post_Grid();
    $sections = new Ultimate_Post_Grid_Sections();
    $metabox = new Ultimate_Post_Grid_Metabox();
}


add_action( 'plugins_loaded', 'run_ultimate_post_grid' );