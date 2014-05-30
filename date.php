<?php
/**
 * The template for Yearly monthly each date Archives
 *
 *
 * @package statsocial
 *
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * @uses user_trailingslashit( )
 * @uses trailingslashit( )
 * @uses remove_query_arg( )
 * @uses get_query_var( 'paged' )
 * @uses get_option( 'posts_per_page' )
 * @uses get_template_part( 'archive' )
 * @uses mysql2date( )
 * @uses statsocial_yui_class_modify( )
 * @uses is_2col_statsocial( 'style="width:99%;"' )
 * @uses query_posts( "posts_per_page=-1&year=$ye" )
 * @uses statsocial_get_year( $one_year, $ye )
 * @uses wp_reset_query( )
 * @uses statsocial_month_list( $one_month, $ye, $mo )
 * @uses statsocial_get_day( $one_day, $ye, $mo, $da )
 * @uses paginate_links( $pagination )
 * @uses get_sidebar( 'extra' )
 * @uses get_sidebar( 'default' )
 * @uses get_footer( $statsocial_document_type )
 * @uses statsocial_prepend_default_sidebar( )
 * @uses statsocial_append_default_sidebar( )
 */
/*
  date.php - calendar based archive navigation
  copyright ( c ) 2005 Scott Merrill ( skippy@skippy.net )
  Released under the terms of the GNU GPL version 2
  http://www.gnu.org/licenses/gpl.html
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
do_action( 'statsocial_' . basename( __FILE__ ) );
global $wp_query, $wp_rewrite;

if ( $wp_query->query_vars[ 'paged' ] > 1 ) {

    $current = $wp_query->query_vars[ 'paged' ];
} else {

    $current = 1;
}

if ( have_posts() ) {

    $ye = mysql2date( 'Y', $wp_query->posts[ 0 ]->post_date );
    $mo = mysql2date( 'm', $wp_query->posts[ 0 ]->post_date );
    $da = mysql2date( 'd', $wp_query->posts[ 0 ]->post_date );
} else {

    get_template_part( '404' );
}

$calendar_page_number = get_query_var( 'paged' );
$post_per_page_pre    = get_option( 'posts_per_page' );
$post_per_page        = apply_filters( 'statsocial_month_list_post_count', $post_per_page_pre );

if ( isset( $ye ) && !empty( $ye ) && isset( $mo ) && !empty( $mo ) ) {

    $statsocial_page_total = ( int ) ceil( $wp_query->max_num_pages * $post_per_page_pre / $post_per_page );
} else {

    $statsocial_page_total = $wp_query->max_num_pages;
}

$pagination = array( 'base'     => @add_query_arg( 'paged', '%#%' ),
    'format'   => '',
    'total'    => $statsocial_page_total,
    'current'  => $current,
    'show_all' => true,
    'type'     => 'plain'
);

if ( $wp_rewrite->using_permalinks() ) {

    $pagination[ 'base' ] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
}

if ( 0 == $calendar_page_number ) {

    $calendar_page_number = 1;
}

$calendar_page_last  = $calendar_page_number * $post_per_page;
$calendar_page_start = $calendar_page_last - $post_per_page;
$weekdaynames        = array(
    0 => esc_html__( 'Sunday', 'statsocial' ),
    1 => esc_html__( 'Monday', 'statsocial' ),
    2 => esc_html__( 'Tuesday', 'statsocial' ),
    3 => esc_html__( 'Wednesday', 'statsocial' ),
    4 => esc_html__( 'Thursday', 'statsocial' ),
    5 => esc_html__( 'Friday', 'statsocial' ),
    6 => esc_html__( 'Saturday', 'statsocial' )
);
get_header( $statsocial_document_type );
do_action( 'statsocial_pre_' . basename( __FILE__ ) );
statsocial_debug_navitation( __FILE__ );
?>
<div id="yui-main">
    <div class="yui-b">
        <div class="<?php echo statsocial_yui_class_modify(); ?>" id="container">
            <!-- content -->
            <div class="yui-u first<?php statsocial_add_class( 'yui-u first', true ); ?>" <?php statsocial_doctype_elements( '', 'role="main"' ); ?>>
<?php statsocial_prepend_loop(); ?>

                <h2 class="page-title">
                    <?php
                    if ( is_year() ) {
                        $one_year = query_posts( "posts_per_page=-1&year=$ye" );
                        $output   = statsocial_get_year( $one_year, $ye );
                        wp_reset_query();
                        esc_html_e( 'Yearly Archives', 'statsocial' );
                    } elseif ( is_month() ) {
                        $one_month = query_posts( "posts_per_page=-1&year=$ye&monthnum=$mo" );
                        $output    = statsocial_month_list( $one_month, $ye, $mo );
                        wp_reset_query();
                        esc_html_e( 'Monthly Archives', 'statsocial' );
                    } elseif ( is_day() ) {
                        $one_day = query_posts( "posts_per_page=-1&year=$ye&monthnum=$mo&day=$da" );
                        $output  = statsocial_get_day( $one_day, $ye, $mo, $da );
                        wp_reset_query();
                        esc_html_e( 'Daily Archives', 'statsocial' );
                    }
                    ?>
                </h2>
                <?php statsocial_monthly_archive_prev_next_navigation(); ?>
                <div class="datetable">
                    <?php echo $output; ?>
                </div>
                <?php if ( is_month() ) { ?>
                    <div class="monthly-archives-pagenate">
                        <?php echo paginate_links( $pagination ) . ''; ?>
                    </div>
                <?php }// end if ( is_month( ) )?>
                <?php statsocial_append_loop(); ?>

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
<?php get_footer( $statsocial_document_type ); ?>