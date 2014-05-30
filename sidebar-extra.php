<?php
/**
 * Template part file for extra sidebar.
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
<<?php statsocial_doctype_elements( 'div', 'aside' ); ?> class="rsidebar" <?php statsocial_doctype_elements( '', 'role="complementary"' ); ?>>
<ul>
    <?php
    if ( !dynamic_sidebar( 'sidebar-2' ) ) {

        statsocial_sidebar_menus( 'extra' );
    }
    ?>
</ul>
</<?php statsocial_doctype_elements( 'div', 'aside' ); ?>>
<?php do_action( 'statsocial_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) ); ?>