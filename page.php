<?php
/**
 * Template for display page
 *
 *
 * @package statsocial
 * @since statsocial 0.1
 *
 * @uses statsocial_show_one_column( )
 * @uses add_filter( )
 * @uses get_header( )
 * @uses statsocial_yui_class_modify( )
 * @uses have_posts( )
 * @uses the_post( )
 * @uses the_ID( )
 * @uses statsocial_post_class( )
 * @uses the_title_attribute( )
 * @uses statsocial_entry_title( )
 * @uses statsocial_entry_content( )
 * @uses wp_link_pages( )
 * @uses the_category( ', ' )
 * @uses edit_post_link( )
 * @uses statsocial_delete_post_link( )
 * @uses comments_template( '', true )
 * @uses next_posts_link( )
 * @uses previous_posts_link( )
 * @uses get_sidebar( 'extra' )
 * @uses get_sidebar( 'default' )
 * @uses get_footer( $statsocial_document_type )
 * @uses statsocial_prepend_default_sidebar( )
 * @uses statsocial_append_default_sidebar( )
 * @uses the_post_thumbnail( )
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
do_action( 'statsocial_' . basename( __FILE__ ) );
$statsocial_current_column = statsocial_show_one_column();

if ( $statsocial_current_column !== false ) {
    add_filter( "statsocial_theme_settings__statsocial_indv_css", "statsocial_color_type_custom" );
}

get_header( $statsocial_document_type );
do_action( 'statsocial_pre_' . basename( __FILE__ ) );
statsocial_debug_navitation( __FILE__ );
?>
<div id="yui-main">
    <div class="yui-b <?php statsocial_add_class( 'yui-b' ); ?>">
                <?php get_template_part( 'widget', 'sticky' ); ?>
        <div class="<?php echo statsocial_yui_class_modify(); ?>" id="container">
            <div class="yui-u first<?php statsocial_add_class( 'yui-u first', true ); ?>" <?php statsocial_doctype_elements( '', 'role="main"' ); ?>>
                <?php
                if ( have_posts() ) {

                    while ( have_posts() ) {

                        the_post();

                        printf( '<!--%1$s-->', $statsocial_document_type );
                        ?>
                        <div class="entry page">
                            <<?php statsocial_doctype_elements( 'div', 'article' ); ?> id="post-<?php the_ID(); ?>" <?php statsocial_post_class(); ?>>

                            <?php
                            statsocial_entry_title();
                            ?>
                            <div class="entry-content">
                                <?php
                                statsocial_prepend_entry_content();

                                the_post_thumbnail( 'full', 'class=page-featured-image' );

                                statsocial_entry_content();
                                ?>
                                <br class="clear" />
                                <?php
                                statsocial_append_entry_content();
                                ?>
                            </div>
                            <div class="linkpage clearfix">
                                <?php
                                wp_link_pages( 'before=<p class="pagenate">&after=</p>&next_or_number=number&pagelink=<span>%</span>' );
                                ?>
                            </div>
                            <br class="clear" />
                            <div class="postmetadata">
                                <?php
                                the_category( ', ' );

                                echo "&nbsp;";

                                edit_post_link( esc_html__( 'Edit', 'statsocial' ) . statsocial_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );

                                statsocial_delete_post_link( esc_html__( 'Trash', 'statsocial' ) . statsocial_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
                                ?>
                            </div>
                            <?php
                            comments_template( '', true );
                            ?>
                            </<?php statsocial_doctype_elements( 'div', 'article' ); ?>>
                        </div>
                        <?php
                    } //endwhile 

                    statsocial_next_prev_links( "nav-below" );
                } //end have post
                ?>
            </div>
            <?php
            if ( 3 == statsocial_show_one_column() ) {
                ?>
                <div class="yui-u">
                    <?php
                    statsocial_prepend_extra_sidebar();

                    get_sidebar( 'extra' );

                    statsocial_append_extra_sidebar();
                    ?>
                </div>
                <?php
            } elseif ( $rsidebar_show && false == $statsocial_current_column ) {
                ?>
                <div class="yui-u">
                    <?php
                    statsocial_prepend_extra_sidebar();

                    get_sidebar( 'extra' );

                    statsocial_append_extra_sidebar();
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
if ( statsocial_show_one_column() !== '1' || false == $statsocial_current_column ) {
    ?>
    <div class="yui-b">
        <?php
        //lsidebar start 
        statsocial_prepend_default_sidebar();

        get_sidebar( 'default' );

        statsocial_append_default_sidebar();
        ?>
    </div>
    <?php
}
?>
</div>
<?php get_footer( $statsocial_document_type ); ?>