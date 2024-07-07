<?php

if ( ! class_exists( 'Ultimate_Post_Grid_Metabox' ) ) {
    class Ultimate_Post_Grid_Metabox {
        
        public function __construct() {
            add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
            add_action( 'save_post', array( $this, 'save_meta_box_data' ) );
        }

        public function add_meta_box() {
            add_meta_box(
                'ultimate_post_grid_meta_box',
                __( 'Shortcode Generator', 'ultimate-post-grid' ),
                array( $this, 'render_meta_box' ),
                'post_settings',
                'advanced',
                'high'
            );
        }

        public function render_meta_box( $post ) {
            wp_nonce_field( 'ultimate_post_grid_meta_box', 'ultimate_post_grid_meta_box_nonce' );
        
            $grid_columns = get_post_meta( $post->ID, '_ultimate_post_grid_columns', true );
            $grid_rows = get_post_meta( $post->ID, '_ultimate_post_grid_rows', true );
            $grid_gap = get_post_meta( $post->ID, '_ultimate_post_grid_gap', true );
            $grid_padding = get_post_meta( $post->ID, '_ultimate_post_grid_padding', true );
            ?>
            
            <div class="upg-tabs">
                <div class="upg-tab active" data-tab="tab-query"><?php _e('Query Builder', 'ultimate-post-grid'); ?></div>
                <div class="upg-tab" data-tab="tab-grid"><?php _e('Grid', 'ultimate-post-grid'); ?></div>
                <div class="upg-tab" data-tab="tab-slider"><?php _e('Slider', 'ultimate-post-grid'); ?></div>
                <div class="upg-tab" data-tab="tab-post-style"><?php _e('Post Style', 'ultimate-post-grid'); ?></div>
                <div class="upg-tab" data-tab="tab-post-style-hover"><?php _e('Post Style Hover', 'ultimate-post-grid'); ?></div>
            </div>
            <div class="upg-tab-content active" id="tab-query">
                <p>
                    <label for="ultimate_post_grid_columns"><?php _e( 'Number of Columns', 'ultimate-post-grid' ); ?></label>
                    <input type="number" id="ultimate_post_grid_columns" name="ultimate_post_grid_columns" value="<?php echo esc_attr( $grid_columns ); ?>" min="1" max="6" />
                </p>
            </div>
            <div class="upg-tab-content" id="tab-grid">
                <p>
                    <label for="ultimate_post_grid_rows"><?php _e( 'Number of Rows', 'ultimate-post-grid' ); ?></label>
                    <input type="number" id="ultimate_post_grid_rows" name="ultimate_post_grid_rows" value="<?php echo esc_attr( $grid_rows ); ?>" min="1" />
                </p>
                <p>
                    <label for="ultimate_post_grid_gap"><?php _e( 'Grid Gap (px)', 'ultimate-post-grid' ); ?></label>
                    <input type="number" id="ultimate_post_grid_gap" name="ultimate_post_grid_gap" value="<?php echo esc_attr( $grid_gap ); ?>" min="0" />
                </p>
                <p>
                    <label for="ultimate_post_grid_padding"><?php _e( 'Grid Padding (px)', 'ultimate-post-grid' ); ?></label>
                    <input type="number" id="ultimate_post_grid_padding" name="ultimate_post_grid_padding" value="<?php echo esc_attr( $grid_padding ); ?>" min="0" />
                </p>
            </div>
            <div class="upg-tab-content" id="tab-slider">
                
            </div>
            <div class="upg-tab-content" id="tab-post-style">
            </div>
            <div class="upg-tab-content" id="tab-post-style-hover">
            </div>
            <?php
        }
        

        public function save_meta_box_data( $post_id ) {
            if ( ! isset( $_POST['ultimate_post_grid_meta_box_nonce'] ) ) {
                return;
            }
        
            if ( ! wp_verify_nonce( $_POST['ultimate_post_grid_meta_box_nonce'], 'ultimate_post_grid_meta_box' ) ) {
                return;
            }
        
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return;
            }
        
            if ( isset( $_POST['post_type'] ) && 'post_settings' === $_POST['post_type'] ) {
                if ( ! current_user_can( 'edit_page', $post_id ) ) {
                    return;
                }
            } else {
                if ( ! current_user_can( 'edit_post', $post_id ) ) {
                    return;
                }
            }
        
            $fields = ['ultimate_post_grid_columns', 'ultimate_post_grid_rows', 'ultimate_post_grid_gap', 'ultimate_post_grid_padding'];
            foreach ($fields as $field) {
                if (isset($_POST[$field])) {
                    update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
                }
            }
        }
        
    }
}
