<?php
class Ultimate_Post_Grid {
    
    public function __construct() {
        $this->load_dependencies();
        $this->define_admin_hooks();
        add_action( 'init', array( $this, 'register_custom_post_type' ) );
        add_filter( 'enter_title_here', array( $this, 'change_placeholder_text' ) );
        add_filter( 'post_updated_messages', array( $this, 'custom_updated_messages' ) );
        add_filter( 'manage_post_settings_posts_columns', array( $this, 'add_shortcode_column' ) );
        add_action( 'manage_post_settings_posts_custom_column', array( $this, 'display_shortcode_column' ), 10, 2 );
        add_shortcode( 'ultimate_post_grid', array( $this, 'generate_shortcode' ) );
    }
    public function register_custom_post_type() {
        // Set UI labels for Custom Post Type
        $labels = array(
            'name'               => esc_html__( 'Ultimate Post Grid', 'ultimate-post-grid' ),
            'singular_name'      => esc_html__( 'Post Grid', 'ultimate-post-grid' ),
            'add_new'            => esc_html__( 'Add New Grid', 'ultimate-post-grid' ),
            'all_items'          => esc_html__( 'All Grids', 'ultimate-post-grid' ),
            'add_new_item'       => esc_html__( 'Add New Post Grid', 'ultimate-post-grid' ),
            'edit_item'          => esc_html__( 'Edit Post Grid', 'ultimate-post-grid' ),
            'new_item'           => esc_html__( 'New Post Grid', 'ultimate-post-grid' ),
            'view_item'          => esc_html__( 'View Post Grid', 'ultimate-post-grid' ),
            'search_items'       => esc_html__( 'Search Post Grids', 'ultimate-post-grid' ),
            'not_found'          => esc_html__( 'No Post Grids found', 'ultimate-post-grid' ),
            'not_found_in_trash' => esc_html__( 'No Post Grids found in Trash', 'ultimate-post-grid' ),
        );

        // Set other options for Custom Post Type
        $args = array(
            'label'               => __('All Post Grids', 'ultimate-post-grid'),
            'description'         => __('Shortcode news and reviews', 'ultimate-post-grid'),
            'labels'              => $labels,
            'supports'            => array( 'title' ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_icon'           => 'dashicons-screenoptions',
            'menu_position'       => 30,
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => false,
            'publicly_queryable'  => false,
            'capability_type'     => 'page',
        );

        // Registering the Shortcodes Custom Post Type
        register_post_type( 'post_settings', $args );
    }

    public function change_placeholder_text( $input ) {
        global $post_type;
        if ( 'post_settings' == $post_type )
            return __( 'Enter Shortcode Name', 'ultimate-post-grid' );
        return $input;
    }

    public function custom_updated_messages( $messages ) {
        global $post, $post_id;
        $messages['post_settings'] = array(
            1  => __('Shortcode updated.', 'ultimate-post-grid'),
            2  => $messages['post'][2],
            3  => $messages['post'][3],
            4  => __('Shortcode updated.', 'ultimate-post-grid'),
            5  => isset($_GET['revision']) ? sprintf( __('Shortcode restored to revision from %s', 'ultimate-post-grid'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6  => __('Shortcode published.', 'ultimate-post-grid'),
            7  => __('Shortcode saved.', 'ultimate-post-grid'),
            8  => __('Shortcode submitted.', 'ultimate-post-grid'),
            9  => sprintf( __('Shortcode scheduled for: <strong>%1$s</strong>.', 'ultimate-post-grid'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) )),
            10 => __('Shortcode draft updated.', 'ultimate-post-grid'),
        );
        return $messages;
    }

    public function add_shortcode_column( $columns ) {
        return array_merge( $columns, array( 'shortcode' => __( 'Shortcode', 'ultimate-post-grid' ) ) );
    }

    public function display_shortcode_column( $column, $post_id ) {
        if ( $column == 'shortcode' ) {
            ?>
            <input style="background:#ccc; width:250px" type="text" onClick="this.select();" value="[ultimate_post_grid id=&quot;<?php echo esc_attr( $post_id ); ?>&quot;]" />
            <br />
            <textarea cols="50" rows="3" style="background:#ddd" onClick="this.select();" ><?php echo '<?php echo do_shortcode("[ultimate_post_grid id='; echo esc_attr( $post_id ); echo ']"); ?>'; ?></textarea>
            <?php
        }
    }

    public function generate_shortcode( $atts ) {
        $atts = shortcode_atts( array(
            'id' => '',
        ), $atts, 'ultimate_post_grid' );

        // Code to render the grid based on the shortcode attributes
        // This part will depend on your specific requirements for the grid layout

        return '<div>Custom Grid Display for post ID ' . esc_attr( $atts['id'] ) . '</div>';
    }


    private function load_dependencies() {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/admin/class-ultimate-post-grid-admin.php';
    }

    private function define_admin_hooks() {
        $plugin_admin = new Ultimate_Post_Grid_Admin();

        add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_scripts' ) );
    }
    
}
?>
