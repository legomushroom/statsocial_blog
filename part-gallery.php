<?php
/**
 * Template part file part-gallery
 *
 * @package statsocial
 * @since statsocial 0.940
 *
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
global $template;
do_action( 'statsocial_pre_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
statsocial_entry_title();
?>
        <div class="entry-meta-gallery">
            <?php
            statsocial_posted_on();
            ?>
        </div>
        <div class="entry-content">
            <?php
            statsocial_prepend_entry_content();

            $statsocial_attachment_args = array(
                'post_parent'    => $post->ID,
                'post_type'      => 'attachment',
                'post_mime_type' => 'image',
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
                'numberposts'    => 999
            );

            $statsocial_images = get_children( $statsocial_attachment_args );

            if ( isset( $statsocial_images ) && !empty( $statsocial_images ) ) {

                $statsocial_format = true;

                $total_images = count( $statsocial_images );

                $statsocial_image_result = array_shift( $statsocial_images );
            } else {

                $statsocial_format = false;

                $total_images = 0;

                $statsocial_image_result = '';
            }

            if ( !preg_match( '!\[gallery!', get_the_content() ) && true == $statsocial_format ) {
                ?>
                <div class="gallery-thumb">
                    <?php
                    echo wp_get_attachment_link( $statsocial_image_result->ID, 'thumbnail', true );
                    ?>
                </div>
                <?php
            }
            statsocial_entry_content();
            ?>
            <div class="clearfix">
                <?php
                statsocial_append_entry_content();

                wp_link_pages( 'before=<p class="pagenate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>' );
                ?>
            </div>
            <?php
            if ( true == $statsocial_format ) {
                ?>
                <p style="margin:1em;"><em>
                        <?php
                        echo sprintf( esc_html__( 'This gallery contains %1$s photographs in all as ', 'statsocial' ), $total_images ) . '&nbsp;' . wp_get_attachment_link( $statsocial_image_result->ID, false, true ) . '&nbsp;' . __( 'photograph etc.', 'statsocial' );
                        ?>
                    </em></p>
                <?php
            }
            ?>
        </div>
        <div class="entry-utility entry-meta">
            <?php
            $category_id = get_cat_ID( 'Gallery' );

            $category_link = get_category_link( $category_id );

            printf(
                    '%4$s<a href="%1$s" title="%2$s">%3$s</a> | ', esc_url( $category_link ), esc_attr__( 'View posts in the Gallery category', 'statsocial' ), ' ' . esc_html__( 'Gallery', 'statsocial' ), esc_html__( 'Link to Category', 'statsocial' )
            );
            ?>
            <span class="comments-link">
            <?php comments_popup_link( esc_html__( 'Leave a comment', 'statsocial' ), esc_html__( '1 Comment', 'statsocial' ), esc_html__( '% Comments', 'statsocial' ) ); ?>
            </span>
                <?php
                edit_post_link( esc_html__( 'Edit', 'statsocial' ) . statsocial_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );

                statsocial_delete_post_link( esc_html__( 'Trash', 'statsocial' ), '<span class="edit-link">', '</span>' );
                ?>
        </div>
    <?php
    if ( is_single() ) {

        statsocial_prev_next_post( 'nav-below' );
    }
    ?>
<?php
comments_template( '', true );
do_action( 'statsocial_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
?>