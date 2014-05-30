<?php
/**
 * Template Name: Full-width Page Template, No Sidebar
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
?>
<div id="yui-main">
    <div id="container">
        <?php
        get_template_part( 'widget', 'sticky' );

        if ( have_posts() ) {

            while ( have_posts() ) {

                the_post();
                ?>
                <div class="entry page">
                    <div id="post-<?php the_ID(); ?>" <?php statsocial_post_class(); ?>>
                        <?php
                        statsocial_entry_title();
                        ?>
                        <div class="entry-content">
                            <?php
                            statsocial_prepend_entry_content();

                            statsocial_entry_content();
                            ?>
                            <br class="clear" />
                            <?php
                            statsocial_append_entry_content();
                            ?>
                        </div>
                        <div class="linkpage clearfix">
                            <?php
                            wp_link_pages( 'before=<p class="pagenate">&after=</p>&next_or_number=number&pagelink=<span>%</span>' );
                            ?>
                        </div>
                        <br class="clear" />
                        <div class="postmetadata">
                            <?php
                            the_category( ', ' );

                            echo '&nbsp;';

                            edit_post_link( esc_html__( 'Edit', 'statsocial' ) . statsocial_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );

                            statsocial_delete_post_link( esc_html__( 'Trash', 'statsocial' ) . statsocial_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
                            ?>
                        </div>
                        <?php
                        comments_template( '', true );
                        ?>
                    </div>
                </div>
                <?php
            } //endwhile 
            statsocial_next_prev_links( "nav-below" );
        } //end have post
        ?>
    </div>
</div>
</div>
<?php get_footer( $statsocial_document_type ); ?>