<?php
/**
 * The template for displaying Auther.
 * *
 * @package statsocial
 * @since Raindrop 0.1
 *
 * @uses get_header( $statsocial_document_type )	include template part file
 * @uses statsocial_yui_class_modify( )	add class attribute value
 * @uses is_2col_statsocial( 'style="width:99%;"' )	add inline style attribute
 * @uses get_avatar( )
 * @uses apply_filters( 'statsocial_author_bio_avatar_size', 60 )
 * @uses have_posts( )
 * @uses have_posts( )
 * @uses the_post( )
 * @uses get_option( 'date_format' )
 * @uses the_time( $statsocial_date_format )
 * @uses the_permalink( )
 * @uses the_title_attribute( )
 * @uses statsocial_entry_title( )
 * @uses the_category( ', ' )
 * @uses get_the_tag_list( '', ', ' )
 * @uses get_sidebar( 'extra' )	include template part file
 * @uses get_sidebar( 'default' )	include template part file
 * @uses get_footer( $statsocial_document_type ) 
 * @uses statsocial_prepend_default_sidebar( )
 * @uses statsocial_append_default_sidebar( )
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

$curauth = get_userdata( intval( $author ) );

get_header( $statsocial_document_type );

do_action( 'statsocial_pre_' . basename( __FILE__ ) );

statsocial_debug_navitation( __FILE__ );
?>
<div id="yui-main">
    <div class="yui-b">
        <div class="<?php echo statsocial_yui_class_modify(); ?>" id="container">
            <<?php statsocial_doctype_elements( 'div', 'article' ); ?> id="post-<?php the_ID(); ?>" <?php statsocial_post_class(); ?>>		
            <div class="yui-u first<?php statsocial_add_class( 'yui-u first', true ); ?>" <?php statsocial_doctype_elements( '', 'role="main"' ); ?>>
                <h2 class="h2">
<?php printf( esc_html__( 'Author Archives: %s', 'statsocial' ), $curauth->nickname ); ?>
                </h2>

                <table <?php statsocial_doctype_elements( 'summary="author infomation"', '' ); ?> class="author-meta left auto">
                    <tr>
                        <td class="avatar-col" style="width:60px;vertical-align:top;">
                            <?php
                            echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'statsocial_author_bio_avatar_size', 60 ), '', esc_attr__( 'Author Avatar Image', 'statsocial' ) );
                            ?>
                        </td>
                        <td>
                            <dl class="author statsocial" style="margin:0;padding:0;">
                                <?php if ( esc_html( $curauth->description ) ) { ?>
                                    <dt>
                                        <?php esc_html_e( 'Profile', 'statsocial' ); ?>
                                    </dt>
                                    <dd>
                                    <?php echo wpautop( esc_html( $curauth->description ) ); ?>
                                    </dd>
                                <?php }// end if ( esc_html( $curauth->description ) ) ?>
                                <?php if ( !empty( $curauth->user_url ) ) { ?>
                                    <dt>
                                        <?php esc_html_e( 'Website', 'statsocial' ); ?>
                                    </dt>
                                    <dd>
                                        <?php
                                        $statsocial_html_author_url = '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="vcard:url">%3$s</a></span>';

                                        printf( $statsocial_html_author_url, esc_url( $curauth->user_url ), sprintf( 'link to author %1$s', esc_attr( $curauth->display_name ) ), esc_url( $curauth->user_url )
                                        );
                                        ?>
                                    </dd>
                                    <?php } //if ( ! empty( $curauth->user_url ) ) {?>
                                <dt>
                                <?php esc_html_e( 'registered', 'statsocial' ); ?>
                                </dt>
                                <dd>
<?php echo esc_html( $curauth->user_registered ); ?>
                                </dd>
                            </dl>
                        </td>
                    </tr>
                </table>
                <br class="clear" />
                <h2 class="h2">
<?php esc_html_e( "Recent post", 'statsocial' ); ?>
                </h2>
                <dl class="author">
                    <!-- The Loop -->
<?php
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        ?>
                            <dt>
                            <?php
                            $statsocial_date_format = get_option( 'date_format' );
                            $statsocial_year        = get_the_time( 'Y' );
                            $statsocial_month       = get_the_time( 'm' );
                            $statsocial_day         = get_the_time( 'd' );
                            $day_link              = esc_url( get_day_link( $statsocial_year, $statsocial_month, $statsocial_day ) . '#post-' . $post->ID );

                            printf( '<a href="%1$s" title="%2$s"><%4$s class="entry-date updated" %5$s>%3$s</%4$s></a>', $day_link, esc_attr( 'archives daily ' . get_the_time( $statsocial_date_format ) ), get_the_date( $statsocial_date_format ), statsocial_doctype_elements( 'span', 'time', false ), statsocial_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false )
                            );

                            statsocial_entry_title( array( 'statsocial_title_element' => 'span' ) );
                            ?>
                            </dt>
                            <dd>
                            <?php
                            esc_html_e( 'Categories :', 'statsocial' );

                            the_category( ', ' );
                            ?>
                            </dd>
                            <dd>
                                <?php
                                esc_html_e( 'Tag :', 'statsocial' );

                                echo get_the_tag_list( '', ', ' );
                                ?>
                            </dd>
                                <?php
                                $format = get_post_format();

                                if ( $format !== false ) {
                                    ?>
                                <dd>
                                <?php
                                esc_html_e( 'Format :', 'statsocial' );

                                echo ' <a href="' . esc_url( get_post_format_link( $format ) ) . '">' . esc_html( get_post_format_string( $format ) ) . '</a>';
                                ?>
                                </dd>
                                <?php
                            } //end if ( $format !== false ) 
                        } //end while			
                    } else {
                        ?>
                        <p><?php esc_html_e( 'No posts by this author.', 'statsocial' ); ?></p>
                        <?php } //if ( have_posts( ) ) 
                    ?>
                </dl>
                <?php statsocial_next_prev_links( "nav-below" ); ?>
            </div>
            </<?php statsocial_doctype_elements( 'div', 'article' ); ?>>
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