<?php
/**
 * Template for display loops.
 *
 * @package statsocial
 * @since statsocial 0.1
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php
/**
 * Display navigation to next/previous pages when applicable
 */
statsocial_prepend_loop();

statsocial_next_prev_links();

if ( have_posts() ) {

    statsocial_loop_title();

    $statsocial_loop_number = 1;

    while ( have_posts() ) {

        the_post();

        $statsocial_loop_class = statsocial_loop_class( $statsocial_loop_number, get_the_ID() );

        printf( '<li class="loop-%1$s%2$s">', esc_attr( trim( $statsocial_loop_class[ 0 ] ) ), esc_attr( rtrim( $statsocial_loop_class[ 1 ] ) )
        );

        $statsocial_loop_number++;
        ?>				
        <<?php statsocial_doctype_elements( 'div', 'article' ); ?> id="post-<?php the_ID(); ?>" <?php statsocial_post_class(); ?>>		
        <?php
        $format = get_post_format();
        /**
         * In category gallery
         *
         *
         *
         *
         */
        if ( in_category( "gallery" ) || has_post_format( "gallery" ) ) {

            get_template_part( 'part', 'gallery' );
            /**
             * In category blog 
             *
             *
             *
             *
             */
        } elseif ( in_category( "blog" ) || has_post_format( "status" ) ) {

            get_template_part( 'part', 'blog' );
        } elseif ( $format !== false ) {

            get_template_part( 'part', $format );
            /**
             * Default loop
             *
             *
             *
             *
             */
        } else {
            ?>
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
                <?php
            }
            ?>
        <br class="clear" />
        </<?php statsocial_doctype_elements( 'div', 'article' ); ?>>
        </li>
        <?php
    } //end while
    ?>
    </ul>
    <?php
    statsocial_next_prev_links( "nav-below" );
}//if have_posts
statsocial_append_loop();
?>