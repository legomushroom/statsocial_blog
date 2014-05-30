<?php
/**
 * The template for displaying 404 pages ( Not Found ).
 *
 *
 * @package statsocial
 * @since Raindrop 0.1
 *
 * @uses statsocial_prepend_default_sidebar( )
 * @uses statsocial_append_default_sidebar( )
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

get_header( $statsocial_document_type );

do_action( 'statsocial_pre_' . basename( __FILE__ ) );

statsocial_debug_navitation( __FILE__ );
?>
<div id="yui-main">
    <div class="yui-b">
        <div class="<?php echo statsocial_yui_class_modify(); ?>" id="container">
            <div class="yui-u first<?php statsocial_add_class( 'yui-u first', true ); ?>" <?php statsocial_doctype_elements( '', 'role="main"' ); ?>>
                <h1 class="entry-title">
<?php esc_html_e( 'Error 404 - Not Found', 'statsocial' ); ?>
                </h1>
                <div id="post-0" class="post error404 not-found">
                    <div class="entry-content">
                        <p>
                        <?php esc_html_e( 'Apologies, but no results were found for the requested Archive. Perhaps searching will help find a related post.', 'statsocial' ); ?>
                        </p>
<?php get_search_form(); ?>
                    </div>
                </div>
            </div>
            <div class="yui-u">
                <?php
                statsocial_prepend_extra_sidebar();

                if ( $rsidebar_show ) {
                    get_sidebar( 'extra' );
                }

                statsocial_append_extra_sidebar();
                ?>
            </div>
        </div>
    </div>
</div>
<div class="yui-b">
    <?php
    statsocial_prepend_default_sidebar();

    get_sidebar( 'default' );

    statsocial_append_default_sidebar();
    ?>	
</div>
</div>
<?php
do_action( 'statsocial_after_' . basename( __FILE__ ) );

get_footer( $statsocial_document_type );
?>