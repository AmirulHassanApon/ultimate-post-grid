<?php
class Ultimate_Post_Grid_Admin {

    public function __construct() {
        
    }

    public function add_plugin_page() {
        add_menu_page(
            'Ultimate Post Grid',
            'Ultimate Post Grid',
            'manage_options',
            'ultimate-post-grid',
            array( $this, 'create_admin_page' ),
            'dashicons-screenoptions',
            6
        );
    }

    public function create_admin_page() {
        ?>
        
        <?php
    }

    public function enqueue_styles() {
        wp_enqueue_style( 'ultimate-post-grid-admin-style', plugin_dir_url( __FILE__ ) . '/css/admin-style.css', array(), '1.0.0', 'all' );
    }

    public function enqueue_scripts() {
        wp_enqueue_script( 'ultimate-post-grid-admin-script', plugin_dir_url( __FILE__ ) . '/js/admin-script.js', array( 'jquery' ), '1.0.0', true );
    }

}
?>
