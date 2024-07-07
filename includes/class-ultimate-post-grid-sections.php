<?php

if ( ! class_exists( 'Ultimate_Post_Grid_Sections' ) ) {
    class Ultimate_Post_Grid_Sections extends Ultimate_Post_Grid {
        
        public function __construct() {
            parent::__construct();
            add_action( 'init', array( $this, 'register_grid_sections' ) );
        }
        
        public function register_grid_sections() {
            // Register the custom taxonomy for grid sections
            $labels = array(
                'name'                       => _x( 'Grid Sections', 'taxonomy general name', 'ultimate-post-grid' ),
                'singular_name'              => _x( 'Grid Section', 'taxonomy singular name', 'ultimate-post-grid' ),
                'search_items'               => __( 'Search Grid Sections', 'ultimate-post-grid' ),
                'popular_items'              => __( 'Popular Grid Sections', 'ultimate-post-grid' ),
                'all_items'                  => __( 'All Grid Sections', 'ultimate-post-grid' ),
                'parent_item'                => __( 'Parent Grid Section', 'ultimate-post-grid' ),
                'parent_item_colon'          => __( 'Parent Grid Section:', 'ultimate-post-grid' ),
                'edit_item'                  => __( 'Edit Grid Section', 'ultimate-post-grid' ),
                'update_item'                => __( 'Update Grid Section', 'ultimate-post-grid' ),
                'add_new_item'               => __( 'Add New Grid Section', 'ultimate-post-grid' ),
                'new_item_name'              => __( 'New Grid Section Name', 'ultimate-post-grid' ),
                'separate_items_with_commas' => __( 'Separate grid sections with commas', 'ultimate-post-grid' ),
                'add_or_remove_items'        => __( 'Add or remove grid sections', 'ultimate-post-grid' ),
                'choose_from_most_used'      => __( 'Choose from the most used grid sections', 'ultimate-post-grid' ),
                'not_found'                  => __( 'No grid sections found.', 'ultimate-post-grid' ),
                'menu_name'                  => __( 'Grid Sections', 'ultimate-post-grid' ),
            );

            $args = array(
                'hierarchical'          => true,
                'labels'                => $labels,
                'show_ui'               => true,
                'show_admin_column'     => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var'             => true,
                'rewrite'               => array( 'slug' => 'grid-section' ),
            );

            register_taxonomy( 'grid_section', 'post', $args );
        }
        
        // Add more methods as per your grid section requirements
        
    }
}
