<?php
/**
 * Template for search form.
 *
 *
 * @package statsocial
 * @since statsocial 0.1
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
global $statsocial_document_type, $template;
do_action( 'statsocial_pre_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );

if ( 'html5' == $statsocial_document_type ) {
    ?>
    <form method="get" name="searchform" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" <?php statsocial_doctype_elements( '', 'role="search"' ); ?>>
        <div class="searchform">
            <label class="screen-reader-text" for="s">Search for:</label>
            <input type="text" value="<?php the_search_query(); ?>" pattern="^[^(<|>)]+$" title="<?php esc_attr_e( 'must not contain html tags', 'statsocial' ); ?>" placeholder="<?php esc_attr_e( 'Search', 'statsocial' ); ?>" name="s" id="s"  />
            <input type="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'statsocial' ); ?>" />
        </div>
    </form>
    <?php
} else {
    ?>
    <form method="get" name="searchform" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="searchform">
            <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" accesskey="s" tabindex="1" />
            &nbsp;
            <input type="submit" id="searchsubmit" value="<?php esc_html_e( 'Search', 'statsocial' ); ?>" accesskey="b" tabindex="2" />
        </div>
    </form>
    <?php
}
do_action( 'statsocial_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
?>