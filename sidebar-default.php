<?php
/**
 * Template part file for default sidebar.
 *
 *
 * @package statsocial
 * @since statsocial 0.1
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
global $template;
do_action( 'statsocial_pre_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
?>
<<?php statsocial_doctype_elements( 'div', 'nav' ); ?> class="lsidebar" <?php statsocial_doctype_elements( '', 'role="navigation"' ); ?>>
<ul>
    <?php
    if ( !dynamic_sidebar( 'sidebar-1' ) ) {
        statsocial_sidebar_menus( 'default' );
    }
    ?>
</ul>
</<?php statsocial_doctype_elements( 'div', 'nav' ); ?>>
<?php do_action( 'statsocial_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) ); ?>