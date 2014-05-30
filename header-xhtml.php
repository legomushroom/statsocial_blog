<?php
/**
 * The xhtml1.0 transitional header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="bd">
 *
 * @package statsocial
 * @since statsocial 0.1
 *
 * @uses get_bloginfo( 'charset' )
 * @uses language_attributes( 'xhtml' )
 * @uses bloginfo( 'html_type' )
 * @uses bloginfo( 'charset' )
 * @uses wp_title( '|', true, 'right' )
 * @uses bloginfo( 'name' ) 
 * @uses get_bloginfo( 'description', 'display' ) 
 * @uses bloginfo( 'pingback_url' )
 * @uses is_singular( )
 * @uses get_option( 'thread_comments' )
 * @uses wp_enqueue_script( 'comment-reply' )
 * @uses wp_head( )
 * @uses body_class( $this_blog )
 * @uses statsocial_warehouse( 'statsocial_page_width' )
 * @uses statsocial_warehouse( 'statsocial_col_width' )
 * @uses wp_upload_dir( )
 * @uses statsocial_upload_image_parser($header_image_uri,'inline','#hd' )
 * @uses get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR )
 * @uses get_header_textcolor( )
 * @uses preg_match( "!([0-9a-f]{6}|[0-9a-f]{3})!si", get_header_textcolor( ) )
 * @uses home_url( )
 * @uses esc_attr( )
 * @uses get_bloginfo( 'name', 'display' )
 * @uses statsocial_header_image( $args = array( ) ) 
 * 
 * 
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
global $template, $statsocial_link_unique_text;
do_action( 'statsocial_pre_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );

echo '<' . '?' . 'xml version="1.0" encoding="' . get_bloginfo( 'charset' ) . '"' . '?' . '>' . "\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>>
    <head profile="http://gmpg.org/xfn/11">
        <meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
        <meta http-equiv="content-script-type" content="text/javascript" />
        <meta http-equiv="content-style-type" content="text/css" />
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?> >
        <div id="<?php echo esc_attr( statsocial_warehouse( 'statsocial_page_width' ) ); ?>" class="<?php echo esc_attr( 'yui-' . statsocial_warehouse( 'statsocial_col_width' ) ); ?> hfeed">
<?php
statsocial_prepend_doc();
?>
            <div id="top">
                <div id="hd">
                    <?php
                    /**
                     * Conditional Switch html headding element
                     *
                     * example
                     *  statsocial_site_title( " add some text" );
                     *
                     */
                    echo statsocial_site_title();
                    /**
                     * Site description diaplay at header bar when if header text Display Text value is no.
                     *
                     * example
                     *  statsocial_site_description(array("text"=>"replace text","switch" => 'style="display:none;"' );
                     *
                     *
                     */
                    echo statsocial_site_description();
                    ?>
                </div>
                <?php
                /**
                 * header image
                 *
                 * if no link home_url( ) then use 'elements'
                 *
                 */
                if ( true == $statsocial_link_unique_text ) {

                    echo statsocial_header_image( 'elements' );
                } else {

                    echo statsocial_header_image( 'home_url' );
                }

                /**
                 * horizontal menubar
                 *
                 *
                 *
                 *
                 */
                statsocial_nav_menu_primary();

                statsocial_after_nav_menu();
                ?>

            </div>
            <div id="bd" class="clearfix">
<?php do_action( 'statsocial_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) ); ?>