<?php
/**
 * The template part file for footer.
 *
 *
 * @package statsocial
 * @since statsocial 0.1
 *
 * @uses wp_upload_dir( )
 * @uses statsocial_upload_image_parser( $footer_image_uri, 'inline','#ft' )
 * @uses is_active_sidebar( 'sidebar-4' )
 * @uses get_bloginfo( 'name' )
 * @uses get_bloginfo( 'rss2_url' )
 * @uses ucwords( )
 * @uses wp_footer( )
 * @uses statsocial_prepend_footer( )
 * @uses statsocial_append_footer( )
 * @uses statsocial_append_doc( )
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
global $statsocial_current_theme_name, $statsocial_current_data_theme_uri, $template, $statsocial_accessibility_link;
do_action( 'statsocial_pre_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
?>
<<?php statsocial_doctype_elements( 'div', 'footer' ); ?> id="ft" class="clear" <?php statsocial_doctype_elements( '', 'role="contentinfo"' ); ?>>
<?php statsocial_prepend_footer(); ?>
<!--footer-widget start-->
<div class="widget-wrapper clearfix">
    <?php if ( is_active_sidebar( 'sidebar-4' ) ) { ?>
        <ul>
            <?php dynamic_sidebar( 'sidebar-4' ); ?>
        </ul>
    <?php }//end if ( is_active_sidebar( 'sidebar-4' ) )  ?>
    <br class="clear" />
</div>
<!--footer-widget end-->
<address>
    <?php
    $statsocial_address_html = '<small>&copy;%s &nbsp; %s &nbsp;
								<a href="%s" class="entry-rss">%s</a> <span>' . esc_html__( 'and', 'statsocial' ) . '</span> 
								<a href="%s" class="comments-rss">%s</a>';
    if ( $statsocial_accessibility_link == true ) {

        $accessible_url = statsocial_current_url();

        $accessible_url = add_query_arg( 'friendly', 'true', $accessible_url );

        $statsocial_address_html .= '<a href="' . $accessible_url . '" class="statsocial-accessibility-link">'. esc_html__( 'Accessible', 'statsocial' ). '</a>';
    }

    $statsocial_address_html .= '</small>&nbsp;';

    printf( $statsocial_address_html, date( "Y" ), $statsocial_current_theme_name, get_bloginfo( 'rss2_url' ), esc_html__( "Entries RSS", "statsocial" ), get_bloginfo( 'comments_rss2_url' ), esc_html__( 'Comments RSS', "statsocial" )
    );

    if ( is_child_theme() ) {

        $statsocial_theme_name = 'Child theme ' . esc_html( ucwords( $statsocial_current_theme_name ) ) . ' of ' . esc_html__( "statsocial Theme", "statsocial" );
    } else {
        $statsocial_theme_name = esc_html__( "statsocial Theme", "statsocial" );
    }

    printf( '&nbsp;<small><a href="%s">%s</a></small>&nbsp;&nbsp;', $statsocial_current_data_theme_uri, $statsocial_theme_name
    );
    ?>
</address>
<?php statsocial_append_footer(); ?>
</<?php statsocial_doctype_elements( 'div', 'footer' ); ?>>
<?php statsocial_append_doc(); ?>
</div>
<?php wp_footer(); ?>
</body>
</html><?php do_action( 'statsocial_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) ); ?>
