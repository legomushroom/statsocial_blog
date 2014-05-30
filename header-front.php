<?php
/**
 * The xhtml1.0 transitional header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="bd">
 *
 * @package statsocial
 * @since statsocial 0.997
 *
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
global $template, $statsocial_document_type, $statsocial_link_unique_text;
do_action( 'statsocial_pre_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );

switch ( $statsocial_document_type ) {
    /**
     *
     *
     *
     *
     */
    case( 'html5' ):
        ?>
        <!DOCTYPE html>
        <html <?php language_attributes(); ?>>
            <head>
                <meta charset="<?php bloginfo( 'charset' ); ?>" />
                <title><?php wp_title( '|', true, 'right' ); ?></title>
                <!--[if IE]>
                <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
                <![endif]--> 
            <?php wp_head(); ?>
            </head>
            <?php
            break;
        /**
         *
         *
         *
         *
         */
        default:
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
        <?php break;
} //end switch( $statsocial_document_type )
?>
        <body <?php body_class(); ?>>
            <div id="<?php echo esc_attr( statsocial_warehouse( 'statsocial_page_width' ) ); ?>" class="<?php echo esc_attr( 'yui-' . statsocial_warehouse( 'statsocial_col_width' ) ); ?> hfeed">
                    <?php statsocial_prepend_doc(); ?>
                <<?php statsocial_doctype_elements( 'div', 'header' ); ?> id="top">
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
                     *  statsocial_site_description( array("text"=>"replace text","switch" => 'style="display:none;"' ) );
                     *
                     *
                     */
                    echo statsocial_site_description();
                    ?>
                </div>
                <?php
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
                </<?php statsocial_doctype_elements( 'div', 'header' ); ?>>

<?php $statsocial_header_image = statsocial_header_image( 'elements' ); ?>

<?php if ( !empty( $statsocial_header_image ) || has_post_thumbnail() ) { ?>
                    <span id="container"></span>
                    <div class="yui-g fron-page-top-container">
                        <div class="yui-u first" <?php statsocial_doctype_elements( '', 'role="main"' ); ?>>
                            <div class="static-front-content">
                                <?php
                                if ( is_page() ) {

                                    if ( have_posts() ) {

                                        while ( have_posts() ) {

                                            the_post();
                                            the_content();
                                        }
                                    }
                                }
                                ?>
                                <br style="clear:both" />
                            </div>
                        </div>
                        <div class="yui-u">
                            <div class="static-front-media">
                                <?php
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail( 'large', 'style=max-width:100%;height:auto;' );
                                } else {
                                    echo $statsocial_header_image;
                                }
                            } else {
                                ?>  
                                <div class="static-front-content">
                                    <?php
                                    if ( is_page() ) {

                                        if ( have_posts() ) {

                                            while ( have_posts() ) {

                                                the_post();
                                                the_content();
                                            }
                                        }
                                    }
                                    ?>
                                    <br style="clear:both" />
                                </div>
<?php } // end if ( ! empty( $statsocial_header_image ) || has_post_thumbnail( ) ) ?>
                        </div>
                    </div>
                </div>
                <div id="bd" class="clearfix">
<?php do_action( 'statsocial_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) ); ?>