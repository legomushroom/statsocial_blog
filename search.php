<?php
/**
 * Template for search .
 *
 *
 * @package statsocial
 * @since statsocial 0.1
 *
 * @uses statsocial_prepend_default_sidebar( )
 * @uses statsocial_append_default_sidebar( )
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
do_action( 'statsocial_' . basename( __FILE__ ) );
get_header( $statsocial_document_type );
do_action( 'statsocial_pre_' . basename( __FILE__ ) );
?>
<div id="yui-main">
<?php statsocial_debug_navitation( __FILE__ ); ?>
    <div class="yui-b">
        <div class="<?php echo statsocial_yui_class_modify(); ?>" id="container">
            <div class="yui-u first<?php statsocial_add_class( 'yui-u first', true ); ?>" <?php statsocial_doctype_elements( '', 'role="main"' ); ?>>
<?php statsocial_prepend_loop(); ?>
<?php if ( have_posts() ) { ?>

                    <h1 class="pagetitle h1">Search Results : <?php the_search_query(); ?></h1>
                    <ul class="search-results">
                        <li>
                            <?php
                            statsocial_next_prev_links();
                            ?>
                        </li>
                        <?php
                        while ( have_posts() ) {

                            the_post();
                            ?>
                            <li>
                                <div id="post-<?php the_ID(); ?>" <?php statsocial_post_class(); ?> >
                                    <?php
                                    statsocial_entry_title();
                                    ?>
                                    <div class="posted-on">
                                        <?php
                                        statsocial_posted_on();
                                        ?>
                                    </div>
                                    <div class="entry-content clearfix">

                                        <?php
                                        statsocial_prepend_entry_content();

                                        statsocial_entry_content();
                                        ?>
                                        <br class="clear" />
                                        <?php
                                        statsocial_append_entry_content();
                                        ?>
                                    </div>
                                    <div class="entry-meta">
                                        <?php
                                        statsocial_posted_in();

                                        edit_post_link( esc_html__( 'Edit', 'statsocial' ) . statsocial_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );

                                        statsocial_delete_post_link( esc_html__( 'Trash', 'statsocial' ) . statsocial_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
                                        ?>
                                    </div>
                                    <br class="clear" />
                                </div>
                            </li>

                        <?php }//while ( have_posts( ) )	?>

                        <li>
                            <?php
                            statsocial_next_prev_links( "nav-below" );
                            ?>
                        </li>
                    </ul>
                <?php } else { ?>
                    <div class="fail-search">
                        <h2 class="center h2">
                            <?php
                            esc_html_e( "Nothing was found though it was regrettable. Please change the key word if it is good, and retrieve it.", "statsocial" );
                            ?>
                        </h2>
                        <?php get_search_form(); ?>
                    </div>
                <?php } ?>
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