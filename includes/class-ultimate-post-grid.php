<?php
class Ultimate_Post_Grid {
    
    public function __construct() {
        $this->load_dependencies();
        $this->define_admin_hooks();
    }

    private function load_dependencies() {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/admin/class-ultimate-post-grid-admin.php';
        // require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-shortcode-generator.php';
    }

    private function define_admin_hooks() {
        $plugin_admin = new Ultimate_Post_Grid_Admin();

        add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_scripts' ) );
    }
    
}
?>
