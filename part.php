<?php
/**
 * Template part file part
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
$format = get_post_format();

if ( false === $format ) {

    $statsocial_entry_meta_class = 'entry-meta-default';
} else {

    $statsocial_entry_meta_class = 'entry-meta-' . $format;
}

        statsocial_entry_title();
?>
        <div class="<?php echo $statsocial_entry_meta_class; ?>">
            <?php
            statsocial_posted_on();
            ?>
        </div>

        <div class="entry-content clearfix">
            <?php
            statsocial_prepend_entry_content();

            statsocial_entry_content();

            wp_link_pages( 'before=<p class="pagenate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>' );
            ?>
            <br class="clear" />
            <?php
            statsocial_append_entry_content();
            ?>
        </div>

        <div class="entry-utility entry-meta">
            <?php
            echo statsocial_posted_in();

            edit_post_link( esc_html__( 'Edit', 'statsocial' ) . statsocial_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );

            statsocial_delete_post_link( esc_html__( 'Trash', 'statsocial' ) . statsocial_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
            ?>
        </div>
<?php
if ( is_single() ) {

    statsocial_prev_next_post( 'nav-below' );
}

comments_template( '', true );

do_action( 'statsocial_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
?>