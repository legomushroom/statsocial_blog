<?php
/*
  Template Name: list of post
 */
/* Customize options
  $statsocial_list_of_posts_per_page	= 10;
  $statsocial_list_of_posts_length		= 200;
  $statsocial_list_of_posts_more		= '[...]';
  $statsocial_list_of_posts_use_toggle	= true;
 */

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$statsocial_current_column = statsocial_show_one_column();

if ( $statsocial_current_column !== false ) {

    add_filter( "statsocial_theme_settings__statsocial_indv_css", "statsocial_color_type_custom" );
}
get_header( $statsocial_document_type );
do_action( 'statsocial_pre_' . basename( __FILE__ ) );
statsocial_debug_navitation( __FILE__ );
?>
<div id="yui-main">
    <div class="yui-b <?php statsocial_add_class( 'yui-b' ); ?>">
        <div class="<?php echo statsocial_yui_class_modify(); ?>" id="container">
                    <?php get_template_part( 'widget', 'sticky' ); ?>
            <div class="yui-u first<?php statsocial_add_class( 'yui-u first', true ); ?>" <?php statsocial_doctype_elements( '', 'role="main"' ); ?>>
                <div class="entry page list-of-post-entry">
                    <?php
                    $query = get_query_var( 'paged' );

                    if ( have_posts() && is_page() && empty( $query ) ) {

                        while ( have_posts() ) {

                            the_post();
                            ?>
                            <div class="entry page"> 				 
                                <<?php statsocial_doctype_elements( 'div', 'article' ); ?> id="post-<?php the_ID(); ?>" <?php statsocial_post_class(); ?>>
                                <?php
                                statsocial_entry_title();
                                ?>
                                <div class="entry-content">
                                    <?php
                                    statsocial_prepend_entry_content();

                                    the_post_thumbnail( 'full', 'class=page-featured-image' );

                                    statsocial_entry_content();
                                    ?>
                                    <br class="clear" />
                                    <?php
                                    statsocial_append_entry_content();
                                    ?>
                                </div>					
                                </<?php statsocial_doctype_elements( 'div', 'article' ); ?>>
                            </div>
                            <?php
                        } //end while
                    } //end have posts
                    ?>
                </div>
                <div id="list-of-post">
                    <?php
                    if ( !empty( $query ) ) {

                        statsocial_entry_title();
                    }
                    /**
                     * List of Posts
                     */
                    statsocial_list_of_posts();
                    ?>
                </div>
            </div>
            <?php
            if ( 3 == statsocial_show_one_column() ) {
                ?>
                <div class="yui-u">
                    <?php
                    statsocial_prepend_extra_sidebar();

                    get_sidebar( 'extra' );

                    statsocial_append_extra_sidebar();
                    ?>
                </div>
                <?php
            } elseif ( $rsidebar_show && false == $statsocial_current_column ) {
                ?>
                <div class="yui-u">
                    <?php
                    statsocial_prepend_extra_sidebar();

                    get_sidebar( 'extra' );

                    statsocial_append_extra_sidebar();
                    ?>
                </div>
                <?php
            } // end if ( 3 == statsocial_show_one_column( ) ) 
            ?>
        </div>
    </div>
</div>
<?php
if ( statsocial_show_one_column() !== '1' || false == $statsocial_current_column ) {
    ?>
    <div class="yui-b">
        <?php
        //lsidebar start 
        statsocial_prepend_default_sidebar();

        get_sidebar( 'default' );

        statsocial_append_default_sidebar();
        ?>
    </div>
    <?php
} //end if ( statsocial_show_one_column( ) !== '1' || false == $statsocial_current_column ) 
?>
</div>
<?php get_footer( $statsocial_document_type ); ?>