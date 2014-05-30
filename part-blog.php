<?php
/**
 * Template part file part-blog
 *
 * @package statsocial
 * @since statsocial 0.1
 *
 * @uses the_ID( )
 * @uses statsocial_post_class( )
 * @uses get_option( 'date_format' )
 * @uses the_time( )
 * @uses get_avatar( )
 * @uses apply_filters( )
 * @uses the_category( )
 * @uses the_tags( )
 * @uses sprintf( )
 * @uses get_author_posts_url( )
 * @uses comments_popup_link( )
 * @uses dynamic_sidebar( )
 * @uses edit_post_link( )
 * @uses the_permalink( )
 * @uses the_title_attribute( )
 * @uses statsocial_entry_title( )
 * @uses statsocial_entry_content( )
 * @uses wp_link_pages( )
 * @uses is_single( )
 * @uses statsocial_prev_next_post( )
 * @uses comment_template( )
 * @uses get_day_link( )
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
global $template;

do_action( 'statsocial_pre_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
$statsocial_date_html_module = '<a href="%1$s">%2$s</a>';
$statsocial_date_format      = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
$statsocial_archive_year     = get_the_time( 'Y' );
$statsocial_archive_month    = get_the_time( 'm' );
$statsocial_archive_day      = get_the_time( 'd' );
$statsocial_day_link         = esc_url( get_day_link( $statsocial_archive_year, $statsocial_archive_month, $statsocial_archive_day ) . '#post-' . $post->ID
);
$statsocial_status_date      = get_the_time( $statsocial_date_format );

if ( is_single() ) {

    /**
     * 	Template for Single post
     *
     *
     *
     */
    ?>
    <ul class="entry-meta-list left">
        <li class="category-blog-publish-date post-format-status-publish-date">
            <?php
            printf( $statsocial_date_html_module, $statsocial_day_link, $statsocial_status_date );
            ?>
        </li>
        <li class="blog-avatar post-format-status-avatar">
            <?php
            echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'statsocial_author_bio_avatar_size', 90 ), '', __( 'Author', 'statsocial' ) . ' ' . get_the_author_meta( 'display_name' )
            );
            ?>
        </li>
        <li>
            <?php
            esc_html_e( 'Category:', 'statsocial' );

            the_category( ' ' )
            ?>
        </li>
        <li>
            <?php
            esc_html_e( 'Tags:', 'statsocial' );

            the_tags( ' ', ' ' );
            ?>
        </li>
        <li>
            <?php
            esc_html_e( 'Author:', 'statsocial' );

            printf(
                    '<span class="author vcard"><a class="url fn n" href="%1$s"   rel="vcard:url">%2$s</a></span>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() )
            );
            ?>
        </li>
        <li>
            <?php
            if ( comments_open() ) {
                comments_popup_link( esc_html__( 'Leave a comment', 'statsocial' ) . statsocial_link_unique( 'Post', $post->ID ), esc_html__( '1 Comment', 'statsocial' ), esc_html__( '% Comments', 'statsocial' )
                );
            }
            ?>
        </li>
            <?php
            dynamic_sidebar( 'sidebar-5' );
            ?>
        <li>
            <?php
            edit_post_link( esc_html__( 'Edit', 'statsocial' ) . statsocial_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>'
            );

            statsocial_delete_post_link( esc_html__( 'Trash', 'statsocial' ) . statsocial_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>'
            );
            ?>
        </li>
    </ul>

    <div class="blog-main left post-format-status-main">
            <?php
            statsocial_entry_title();
            ?>
        <div class="entry-content clearfix">
            <?php
            statsocial_prepend_entry_content();

            statsocial_entry_content();
            ?>
            <div class="clearfix">
        <?php
        statsocial_append_entry_content();
        ?>
            </div>
            <?php
            wp_link_pages( 'before=<p class="pagenate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>' );
            ?>
        </div>

    </div>
    <div class="clearfix"></div>
                <?php
                if ( is_single() ) {

                    statsocial_prev_next_post( 'nav-below' );
                }
                comments_template( '', true );
            } else {

                /**
                 * Template for Not Single post
                 *
                 *
                 *
                 */
                ?>
    <div class="format-status-not-single-post">
        <div class="posted-on">
    <?php
    statsocial_posted_on();
    ?>
        </div>

        <ul class="entry-meta-list left">
            <li class="blog-avatar">
    <?php
    $statsocial_avatar = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'statsocial_author_bio_avatar_size', 48 ), '', get_the_author_meta( 'display_name' )
    );
    printf(
            '<span class="author vcard"><a class="url" href="%1$s"   rel="vcard:url">%2$s<span class="fn n">%3$s</span></a></span>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), $statsocial_avatar, get_the_author_meta( 'display_name' ) );
    ?>

            </li>
        </ul>

        <div class="blog-main left post-format-status-main">
                <?php
                statsocial_entry_title();
                ?>

            <div class="entry-content clearfix">
                <?php
                statsocial_prepend_entry_content();

                statsocial_entry_content();
                ?>
                <div class="clearfix">
                <?php
                statsocial_append_entry_content();
                ?>
                </div>
    <?php
    wp_link_pages( 'before=<p class="pagenate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>' );
    ?>
            </div>
        </div>
            <?php
            if ( !is_tax() ) {
                ?>
            <div class="entry-utility entry-meta clear">
                    <?php
                    echo statsocial_posted_in();

                    edit_post_link( esc_html__( 'Edit', 'statsocial' ) . statsocial_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );

                    statsocial_delete_post_link( esc_html__( 'Trash', 'statsocial' ) . statsocial_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
                    ?>		
            </div>
                    <?php
                }

                if ( is_user_logged_in() && is_tax() ) {
                    ?>
            <div class="entry-utility entry-meta clear">
            <?php
            edit_post_link( esc_html__( 'Edit', 'statsocial' ) . statsocial_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );

            statsocial_delete_post_link( esc_html__( 'Trash', 'statsocial' ) . statsocial_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
            ?>
            </div>
                <?php
            } elseif ( is_tax() ) {

                $statsocial_date_html_module = '<p style="text-align:right;">' . $statsocial_date_html_module . '</p>';

                printf( $statsocial_date_html_module, $statsocial_day_link, $statsocial_status_date );
            }
            ?>
    </div>
        <?php
    }
    do_action( 'statsocial_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
    ?>