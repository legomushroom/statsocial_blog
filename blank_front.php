<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Template Name: brank front
 *
 * Show or Hide Controller Template
 *
 * $statsocial_bf_show_sticky_post
 * $statsocial_bf_recent_posts
 * $statsocial_bf_category_posts
 * $statsocial_bf_tag_posts
 *
 * $statsocial_bf_sticky_post_args	//WP_Query
 * $statsocial_bf_recent_posts_setting	//wp_get_recent_posts
 * $statsocial_bf_category_posts_setting  //get_posts
 * $statsocial_bf_tag_posts_setting	//get_posts
 * 
 * $statsocial_bf_display_title // Site Title
 * $statsocial_bf_display_description // Site description + Need customizer site title and tagline display header text checkbox off
 * $statsocial_bf_display_header_image // header image
 * $statsocial_bf_display_nav_menus // wp_nav_menu
 * $statsocial_bf_display_widget // widget
 * $statsocial_bf_add_custom_text_extra_sidebar // Extra Sidebar show original menu
 * $statsocial_bf_custom_text_extra_sidebar // Extra Sidebar show original menu text
 * $statsocial_bf_add_custom_text_default_sidebar // Default Sidebar show original menu
 * $statsocial_bf_custom_text_default_sidebar // Extra Sidebar show original menu text
 * $statsocial_bf_remove_left_margin // Remove Default Sidebar blank space
 * $statsocial_bf_remove_right_margin // Remove Extra Sidebar blank space
 * $statsocial_bf_display_page_title // Static Page Title
 * $statsocial_bf_display_page_content //Static Page Content
 *
 * usage:
 * $statsocial_bf_display_title = ''; //hide Site Title
 * $statsocial_bf_display_title = 'y'; //Show Site Title
 * variables can write functions.php or this template.
 *
 * @package statsocial
 * @since statsocial 0.959
 */
// Setting here start

$statsocial_bf_show_sticky_post = '';




// Setting end
/**
 * When you display the Sticky post, $show_sticky_post set value true.
 *
 *
 *
 */
if ( !isset( $statsocial_bf_show_sticky_post ) ) {

    $statsocial_bf_show_sticky_post = 'y';
}

if ( !isset( $statsocial_bf_sticky_post_args ) ) {

    $statsocial_bf_sticky_post_args = array( 'posts_per_page' => 3,
        'post__in'       => get_option( 'sticky_posts' ),
            //'ignore_sticky_posts' => 1
    );
}
/**
 * When you display links list of the Recent Posts , please delete comment out of add_action( ).
 *
 *
 *
 */
if ( !isset( $statsocial_bf_recent_posts ) ) {

    $statsocial_bf_recent_posts = 'y';
}
if ( !isset( $statsocial_bf_recent_posts_setting ) ) {

    $statsocial_bf_recent_posts_setting = array( 'title'                                       => esc_html__( 'Recent Posts', 'statsocial' ),
        'numberposts'                                 => 3, //show count
        'statsocial_excerpt_length'                    => 50, // excerpt length
        'statsocial_excerpt_more'                      => '...', // excerpt more marker
        'statsocial_post_thumbnail'                    => true,
        'statsocial_recent_post_thumbnail_default_uri' => get_template_directory_uri() . '/images/dummy.png',
    );
}

/**
 * When you display the category contain post list , please delete comment out of add_action( ).
 *
 *
 *
 *
 */
if ( !isset( $statsocial_bf_category_posts ) ) {

    $statsocial_bf_category_posts = 'y';
}
if ( !isset( $statsocial_bf_category_posts_setting ) ) {

    $statsocial_bf_category_posts_setting = array( 'title'                                         => esc_html__( 'Categories', 'statsocial' ),
        'numberposts'                                   => 5, //show count
        'category'                                      => 0, //category id
        'orderby'                                       => 'post_date',
        'order'                                         => 'DESC',
        'statsocial_post_thumbnail'                      => true,
        'statsocial_category_post_thumbnail_default_uri' => get_template_directory_uri() . '/images/dummy.png',
    );
}
/**
 * 　When you display the tagged entry list , please delete comment out of add_action( ).
 *
 *
 *
 *
 */
if ( !isset( $statsocial_bf_tag_posts ) ) {

    $statsocial_bf_tag_posts = 'y';
}
if ( !isset( $statsocial_bf_tag_posts_setting ) ) {

    $statsocial_bf_tag_posts_setting = array( 'title'                                         => esc_html__( 'Tags', 'statsocial' ),
        'numberposts'                                   => 5, //show count
        'statsocial_post_thumbnail'                      => true,
        'statsocial_category_post_thumbnail_default_uri' => get_template_directory_uri() . '/images/dummy.png',
        'tax_query'                                     => array(
            array(
                'taxonomy' => 'post_tag',
                'terms'    => array( 'post-formats' ), //tag slug
                'field'    => 'slug',
                'operator' => 'IN'
            ),
            'relation' => 'AND'
        )
    );
}
if ( !isset( $statsocial_bf_display_title ) ) {

    /**
     * Display or not Site title
     *
     * value y then show other hide.
     *
     *
     */
    $statsocial_bf_display_title = 'y';
}
if ( !isset( $statsocial_bf_display_description ) ) {

    /**
     * Display or not Site description
     *
     * value y then show other hide.
     *
     *
     */
    $statsocial_bf_display_description = 'y';
}
if ( !isset( $statsocial_bf_display_header_image ) ) {

    /**
     * Display or not Site header image
     *
     * value y then show other hide.
     *
     *
     */
    $statsocial_bf_display_header_image = 'y';
}
if ( !isset( $statsocial_bf_display_nav_menus ) ) {

    /**
     * Display or not horizontal navigation
     *
     * value y then show other hide.
     *
     *
     */
    $statsocial_bf_display_nav_menus = 'y';
}
if ( !isset( $statsocial_bf_display_widget ) ) {

    /**
     * Display or not widget
     *
     * value y then show other hide.
     */
    $statsocial_bf_display_widget = 'y';
}
if ( !isset( $statsocial_bf_add_custom_text_extra_sidebar ) ) {

    /**
     * Add your html , line:211 $statsocial_bf_custom_text_extra_sidebar
     *
     * value y then show other hide.
     *
     */
    $statsocial_bf_add_custom_text_extra_sidebar = '';
}
if ( !isset( $statsocial_bf_add_custom_text_default_sidebar ) ) {

    /**
     * Add your html , line:194 $statsocial_bf_custom_text_default_sidebar
     *
     * value y then show other hide.
     *
     */
    $statsocial_bf_add_custom_text_default_sidebar = '';
}
if ( !isset( $statsocial_bf_remove_left_margin ) ) {

    /**
     * When you not need left margin ( blank default sidebar width ).
     *
     * value y then show other hide.
     *
     */
    $statsocial_bf_remove_left_margin = '';
}
if ( !isset( $statsocial_bf_remove_right_margin ) ) {

    /**
     * When you not need right margin ( blank extra sidebar width ).
     *
     * value y then show other hide.
     *
     */
    $statsocial_bf_remove_right_margin = '';
}
if ( !isset( $statsocial_bf_display_page_title ) ) {
    /**
     * Display or not page title
     * value y then show other hide.
     *
     */
    $statsocial_bf_display_page_title = 'y';
}
if ( !isset( $statsocial_bf_display_page_content ) ) {
    /**
     * Display or not page content
     * value y then show other hide.
     *
     */
    $statsocial_bf_display_page_content = 'y';
}
if ( !isset( $statsocial_bf_custom_text_default_sidebar ) ) {
    /**
     * custom_text_default_sidebar
     *
     *
     *
     */
    $statsocial_bf_custom_text_default_sidebar = <<<SUBSTITUTION_CONTENT

<h2>hello world</h2>



SUBSTITUTION_CONTENT;
}
if ( !isset( $statsocial_bf_custom_text_extra_sidebar ) ) {

    /**
     * substitution extra sidebar content
     *
     */
    $statsocial_bf_custom_text_extra_sidebar = <<<SUBSTITUTION_EXTRA_SIDEBAR

<h2>hello world</h2>



SUBSTITUTION_EXTRA_SIDEBAR;
}

/** Do not Edit
 * Functions and filters
 *
 *
 *
 */
if ( isset( $statsocial_bf_show_sticky_post ) && 'y' == $statsocial_bf_show_sticky_post ) {
    $statsocial_bf_sticky_post_args = apply_filters( 'statsocial_bf_sticky_post_args', $statsocial_bf_sticky_post_args );
}
if ( isset( $statsocial_bf_recent_posts ) && 'y' == $statsocial_bf_recent_posts ) {

    add_action( 'statsocial_append_entry_content', 'statsocial_recent_posts' );
    $statsocial_bf_recent_posts_setting = apply_filters( 'statsocial_bf_recent_posts_setting', $statsocial_bf_recent_posts_setting );
}
if ( isset( $statsocial_bf_category_posts ) && 'y' == $statsocial_bf_category_posts ) {

    add_action( 'statsocial_append_entry_content', 'statsocial_category_posts' );
    $statsocial_bf_category_posts_setting = apply_filters( 'statsocial_bf_category_posts_setting', $statsocial_bf_category_posts_setting );
}
if ( isset( $statsocial_bf_tag_posts ) && 'y' == $statsocial_bf_tag_posts ) {

    add_action( 'statsocial_append_entry_content', 'statsocial_tag_posts' );
    $statsocial_bf_tag_posts_setting = apply_filters( 'statsocial_bf_tag_posts_setting', $statsocial_bf_tag_posts_setting );
}



if ( 'y' !== $statsocial_bf_display_title ) {

    add_filter( 'statsocial_site_title', '__return_null' );
}

if ( 'y' !== $statsocial_bf_display_description ) {

    add_filter( 'statsocial_site_description', '__return_null' );

    add_filter( 'statsocial_header_image_elements', 'statsocial_remove_header_text' );
}

function statsocial_remove_header_text( $content ) {

    return preg_replace( '!<p[^>]*>(.*)</p>!siu', '', $content );
}

if ( 'y' !== $statsocial_bf_display_header_image ) {

    add_filter( 'statsocial_header_image_elements', '__return_null' );
    add_filter( 'statsocial_header_image_home_url', '__return_null' );
}

if ( 'y' !== $statsocial_bf_display_nav_menus ) {

    add_filter( 'statsocial_nav_menu_primary_html', '__return_null' );
}

if ( 'y' !== $statsocial_bf_display_page_content ) {

    add_filter( 'statsocial_entry_content', '__return_null' );
}

add_filter( 'statsocial_posted_in', '__return_null' );

add_filter( 'statsocial_posted_on', '__return_null' );

/*
  if ( $statsocial_display_wp_link_pages !== 'y' ) {
  add_filter( 'wp_link_pages_args', 'statsocial_wp_link_pages_filter' );
  }
 */

function statsocial_wp_link_pages_filter( $args ) {

    $args[ 'echo' ] = false;

    return $args;
}

if ( 'y' !== $statsocial_bf_display_widget ) {

    add_filter( 'dynamic_sidebar', '__return_empty_array' );

    add_filter( 'statsocial_sidebar_menus', '__return_null' );
}

if ( 'y' == $statsocial_bf_add_custom_text_default_sidebar ) {

    add_action( 'statsocial_prepend_default_sidebar', 'statsocial_prepend_default_sidebar_filter' );
}

if ( 'y' == $statsocial_bf_add_custom_text_extra_sidebar ) {

    add_action( 'statsocial_prepend_extra_sidebar', 'statsocial_prepend_default_sidebar_filter' );
}

function statsocial_prepend_default_sidebar_filter() {

    global $statsocial_bf_custom_text_default_sidebar;

    echo $statsocial_bf_custom_text_default_sidebar;
}

function statsocial_prepend_extra_sidebar_filter() {

    global $statsocial_bf_custom_text_extra_sidebar;

    echo $statsocial_bf_custom_text_extra_sidebar;
}

if ( 'y' !== $statsocial_bf_display_page_title ) {

    add_filter( 'statsocial_entry_title', '__return_null' );
}

if ( 'y' !== $statsocial_bf_remove_left_margin || 'y' == $statsocial_bf_add_custom_text_default_sidebar ) {

    $statsocial_devide_column_class = 'yui-b';
} else {

    $statsocial_devide_column_class = '';
}

if ( 'y' !== $statsocial_bf_remove_left_margin || 'y' == $statsocial_bf_add_custom_text_extra_sidebar ) {

    $statsocial_devide_column_extra_class = 'yui-u';
} else {

    $statsocial_devide_column_extra_class = '';
}

/** Template
 *
 *
 *
 *
 */
get_header( $statsocial_document_type );
do_action( 'statsocial_pre_' . basename( __FILE__ ) );
statsocial_debug_navitation( __FILE__ );
?>
<div id="yui-main">
    <div class="<?php echo $statsocial_devide_column_class; ?>">
        <?php get_template_part( 'widget', 'sticky' ); ?>
        <div class="<?php echo statsocial_yui_class_modify(); ?>" id="container">
            <div class="<?php echo $statsocial_devide_column_extra_class; ?> first" <?php
        is_2col_statsocial( 'style="width:99%;"' );

        if ( $statsocial_devide_column_extra_class !== 'yui-u' ) {
            echo 'style="width:99%;"';
        }
        ?>>

                <?php if ( true == $statsocial_bf_show_sticky_post ) { ?>
                    <div>
                        <ul class="statsocial-sticky-posts">
                            <?php
                            /**
                             *  Sticky post
                             *
                             */
                            $the_query = new WP_Query( apply_filters( 'statsocial_bf_sticky_post_args', $statsocial_bf_sticky_post_args ) );


                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();


                                $html = '<div id="post-%1$s" class="%2$s">';
                                printf( $html, get_the_ID(), join( ' ', get_post_class() )
                                );

                                statsocial_entry_title();

                                $html = '<div class="%1$s">';
                                printf( $html, 'entry-content clearfix' );

                                statsocial_entry_content();
                                print( '</div>' );
                            } //end while
                            wp_reset_postdata();
                            ?>
                        </ul>
                    </div>
                        <?php } //endif( $show_sticky_post == true ) ?>

                <?php get_template_part( 'loop', 'default' ); ?>
                <br style="clear:both" />
            </div>
                <?php if ( $statsocial_devide_column_extra_class == 'yui-u' ) { ?>
                <div class="yui-u">
                <?php statsocial_prepend_extra_sidebar(); ?>
                <?php if ( $rsidebar_show && $statsocial_bf_display_widget == 'y' ) {
                    get_sidebar( 'extra' );
                } ?>
                    <?php statsocial_append_extra_sidebar(); ?>
                </div>
            <?php }//if ( $statsocial_devide_column_class == 'yui-u' ) ?>
        </div>
    </div>
</div>
<?php if ( 'yui-b' == $statsocial_devide_column_class ) { ?>
    <div class="yui-b">
        <?php statsocial_prepend_default_sidebar(); ?>
        <?php if ( $statsocial_bf_display_widget == 'y' ) {
            get_sidebar( 'default' );
        } ?>
    <?php statsocial_append_default_sidebar(); ?>
    </div>
<?php }//if ( $statsocial_devide_column_class == 'yui-b' )  ?>
</div>
<?php get_footer( $statsocial_document_type ); ?>