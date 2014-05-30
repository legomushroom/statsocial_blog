<?php
/**
 * Template file index
 *
 * @package statsocial
 * @since statsocial 0.940
 *
 * @uses get_header( $statsocial_document_type )	include template part file
 * @uses is_home( )	Check Conditional is home page or not
 * @uses is_active_sidebar( 'sidebar-3' )	include template part file
 * @uses dynamic_sidebar( 'sidebar-3' )	include template part file
 * @uses statsocial_yui_class_modify( )	add class attribute value
 * @uses is_2col_statsocial( 'style="width:99%;"' )	add inline style attribute
 * @uses get_template_part( 'loop', 'default' )	include template part file
 * @uses get_sidebar( 'extra' )	include template part file
 * @uses get_sidebar( 'default' )	include template part file
 * @uses get_footer( $statsocial_document_type ) 
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
global $rsidebar_show, $statsocial_document_type;
get_header( $statsocial_document_type );
do_action( 'statsocial_pre_' . basename( __FILE__ ) );
statsocial_debug_navitation( __FILE__ );
?>
<div id="yui-main">
    <div class="yui-b">
                <?php get_template_part( 'widget', 'sticky' ); ?>
        <div class="<?php echo statsocial_yui_class_modify(); ?>" id="container">
            <div class="yui-u first<?php statsocial_add_class( 'yui-u first', true ); ?>" <?php statsocial_doctype_elements( '', 'role="main"' ); ?>>
<?php get_template_part( 'loop', $statsocial_document_type ); ?>
                <br style="clear:both" />			
            </div>
            <div class="yui-u">
                <?php statsocial_prepend_extra_sidebar(); ?>
            <?php if ( $rsidebar_show ) {
                get_sidebar( 'extra' );
            } ?>
<?php statsocial_append_extra_sidebar(); ?>
            </div>
    <?php //add nest grid here  ?>
        </div>
    </div>
</div>
<div class="yui-b">
<?php statsocial_prepend_default_sidebar(); ?>
<?php get_sidebar( 'default' ); ?>
<?php statsocial_append_default_sidebar(); ?>	
</div>
</div>
<?php get_footer( $statsocial_document_type ); ?>