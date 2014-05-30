<?php
/**
 * Template Name: front portfolio Template
 *
 *
 * The posts contain featured image shows 9
 *
 */
do_action( 'statsocial_' . basename( __FILE__ ) );

get_header( $statsocial_document_type );
do_action( 'statsocial_pre_' . basename( __FILE__ ) );

$statsocial_current_column = statsocial_show_one_column();

if ( $statsocial_current_column !== false ) {
    add_filter( "statsocial_theme_settings__statsocial_indv_css", "statsocial_color_type_custom" );
}

statsocial_debug_navitation( __FILE__ );

get_template_part( 'widget', 'sticky' );

/**
 *  Sticky Posts
 *
 */
$statsocial_get_posts_args = array( 'numberposts' => -1, 'post_status' => 'publish' );

$statsocial_posts = get_posts( $statsocial_get_posts_args );
?>
<div class="stickies">
    <?php
    foreach ( $statsocial_posts as $post ) {

        setup_postdata( $post );

        if ( is_sticky() ) {
            ?>
            <<?php statsocial_doctype_elements( 'div', 'article' ); ?> id="post-<?php the_ID(); ?>" <?php statsocial_post_class(); ?> >
            <?php
            the_title( '<h2 class="h2 entry-title">', '</h2>' );
            ?>
            <div class="entry-content">
                <?php
                the_content();
                ?>
            </div>
            </<?php statsocial_doctype_elements( 'div', 'article' ); ?>>
            <?php
        }// is_sticky( )
    } // foreach 
    ?>
</div>
<?php
wp_reset_postdata();
?>
<div class="portfolio-page-content" id="container">
    <?php
    /**
     *  portfolio entry content
     *
     */
    if ( have_posts() ) {

        while ( have_posts() ) {

            the_post();

            the_content();

            wp_link_pages();
        }
    }
    ?>
</div>
<?php
/**
 *  portfolio block
 *
 */
$statsocial_portfolio_page = get_query_var( 'page' );
$statsocial_posts_per_page = 9;
$statsocial_offset         = 0;
$args                     = array(
    'posts_per_page' => $statsocial_posts_per_page,
    'paged'          => $statsocial_portfolio_page,
    'numberposts'    => -1,
    'offset'         => 0,
    'orderby'        => 'post_date',
    'order'          => 'DESC',
    'post_type'      => 'post',
    'meta_key'       => '_thumbnail_id',
    'post_status'    => 'publish',
    'post__not_in'   => get_option( 'sticky_posts' ) );

statsocial_tile( $args );
?>	
</div>			
<?php get_footer( $statsocial_document_type ); ?>