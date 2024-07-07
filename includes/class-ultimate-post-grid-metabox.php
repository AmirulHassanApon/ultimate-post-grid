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
                __( 'Grid Settings', 'ultimate-post-grid' ),
                array( $this, 'render_meta_box' ),
                'post_settings',
                'advanced',
                'high'
            );
        }

        public function render_meta_box( $post ) {
            wp_nonce_field( 'ultimate_post_grid_meta_box', 'ultimate_post_grid_meta_box_nonce' );

            $grid_columns = get_post_meta( $post->ID, '_ultimate_post_grid_columns', true );
            ?>
            <p>
                <label for="ultimate_post_grid_columns"><?php _e( 'Number of Columns', 'ultimate-post-grid' ); ?></label>
                <input type="number" id="ultimate_post_grid_columns" name="ultimate_post_grid_columns" value="<?php echo esc_attr( $grid_columns ); ?>" min="1" max="6" />
            </p>
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

            if ( ! isset( $_POST['ultimate_post_grid_columns'] ) ) {
                return;
            }

            $grid_columns = sanitize_text_field( $_POST['ultimate_post_grid_columns'] );

            update_post_meta( $post_id, '_ultimate_post_grid_columns', $grid_columns );
        }
    }
}
