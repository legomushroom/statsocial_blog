<?php
/**
 * Template for single post.
 *
 *
 * @package statsocial
 * @since statsocial 0.306
 * @uses statsocial_show_one_colum   Detect current post column count
 * @uses add_filter                 Overwrite Color type func statsocial_color_type_custom( )
 * @uses get_header( $statsocial_document_type )       Include template part file
 * @uses have_posts( )
 * @uses the_post( )
 * @uses in_category( )
 * @uses get_the_post_thumbnail( )
 * @uses has_post_thumbnail( )
 * @uses wp_get_attachment_image_src( )
 * @uses esc_url( )
 * @uses round( )
 * @uses esc_attr( )
 * @uses image_hwstring( )
 * @uses switch( )
 * @uses get_template_part( )
 * @uses statsocial_show_one_column( )
 * @uses next_posts_link( )
 * @uses previous_posts_link( )
 * @uses get_sidebar( )
 * @uses get_footer( $statsocial_document_type )
 * @uses get_attachment_link( )
 * @uses get_post_thumbnail_id( )
 * @uses statsocial_prepend_default_sidebar( )
 * @uses statsocial_append_default_sidebar( )
 *
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$statsocial_home_url       = trailingslashit( home_url() );
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
        <div class="<?php echo statsocial_yui_class_modify(); ?>" id="container">
            <div class="yui-u first<?php statsocial_add_class( 'yui-u first', true ); ?>" <?php statsocial_doctype_elements( '', 'role="main"' ); ?>>
                <?php
                /**
                 * Display navigation to next/previous pages when applicable
                 */
                if ( have_posts() ) {
                    /**
                     * when Single page
                     */
                    while ( have_posts() ) {

                        the_post();

                        $format = get_post_format();

                        $cat = "default";

                        if ( in_category( "blog" ) || has_post_format( "status" ) ) {

                            $cat = "blog";
                        } elseif ( in_category( "gallery" ) || has_post_format( "gallery" ) ) {

                            $cat = "gallery";
                        } elseif ( $format !== false ) {

                            $cat = $format;
                        }

                        if ( true == WP_DEBUG ) {

                            echo '<!--Single Post Format or 2 Category ' . $cat . ' start-->';
                        }
                        ?>
                        <<?php statsocial_doctype_elements( 'div', 'article' ); ?> id="post-<?php the_ID(); ?>" <?php statsocial_post_class( array( 'clearfix' ) ); ?>>	
                        <?php
                        if ( is_sticky() ) {
                            ?>
                            <div class="sticky-single-follow-text">

                                <strong><a href="<?php echo $statsocial_home_url; ?>"><?php esc_html_e( 'Sticky Post Shows Only WEB Site Home.', 'statsocial' ); ?></a></strong>

                            </div>
            <?php
        }

        /**
         * Show featured image
         *
         *
         *
         *
         */
        statsocial_featured_image();
        /**
         * Show Category base special layout and default single template part
         *
         *
         *
         *
         */
        get_template_part( "part", $cat );

        if ( true == WP_DEBUG ) {
            echo '<!-- #post-' . get_the_ID() . ' -->';
        }
    }       //　endwhile
    /**
     * Next Previous post link
     *
     *
     *
     *
     */
    statsocial_next_prev_links( "nav-below" );
} else {
    
}           // if ( have_posts( ) )
?>

                </<?php statsocial_doctype_elements( 'div', 'article' ); ?>>
            </div>
                <?php
                /**
                 * Show Extra sidebar column rsidebar start
                 *
                 *
                 *
                 *
                 */
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
                //add nest grid here
                ?>
        </div>
    </div>
</div>
            <?php
            /**
             * Show main column lsidebar start
             *
             *
             *
             *
             */
            if ( '1' !== statsocial_show_one_column() || false == $statsocial_current_column ) {
                ?>
    <div class="yui-b">
    <?php
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