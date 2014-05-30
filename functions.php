<?php
/**
 * functions and constants for statsocial theme
 *
 *
 * @package statsocial
 * @since statsocial 0.1
 */
if ( !defined( 'ABSPATH' ) ) {

    exit;
}
/**
 * include statsocial custom settings
 *
 *
 *
 */
if ( file_exists( get_template_directory() . '/statsocial-config.php' ) ) {

    require_once( get_template_directory() . '/statsocial-config.php' );
}
/**
 * Show theme options page
 * If set false then hide customize.php statsocial theme option and statsocial options page 
 *
 * $statsocial_show_theme_option
 * @since 1.149
 */
$statsocial_show_theme_option = true;

if ( $statsocial_show_theme_option == false ) {

    if ( !defined( 'statsocial_USE_AUTO_COLOR' ) ) {

        define( 'statsocial_USE_AUTO_COLOR', false );
    }
}
/**
 * Add to style for each post, page
 *
 * need role edit page.
 * @since 1.201
 */
if ( !defined( 'statsocial_CUSTOM_FIELD_CSS' ) ) {

    define( 'statsocial_CUSTOM_FIELD_CSS', true );
}
/**
 * Add to script or metatag singlure page from custom field
 * 
 *
 * javascript custom field key name: javascript
 * metatag name : meta
 * need role edit page.
 * @since 1.201
 */
if ( !defined( 'statsocial_CUSTOM_FIELD_META' ) ) {

    define( 'statsocial_CUSTOM_FIELD_META', true );
}
if ( !defined( 'statsocial_CUSTOM_FIELD_SCRIPT' ) ) {

    define( 'statsocial_CUSTOM_FIELD_SCRIPT', false );
}
/**
 * move from hooks.php
 * and change from load_textdomain(   ) to load_theme_text_domain(   )
 *
 *
 * @since 0.988
 *
 * When child theme has languages/statsocial_[lang].mo
 * statsocial Theme read this language file.
 * You can override parent themes language file from child theme.
 */
load_theme_textdomain( 'statsocial', apply_filters( 'statsocial_load_text_domain', get_template_directory() . '/languages' ) );

/**
 * When WP_DEBUG value true and $statsocial_actions_hook_message value true
 * Show statsocial action filter position and examples
 *
 * $statsocial_actions_hook_message
 * @since 0.980
 */
if ( !isset( $statsocial_actions_hook_message ) ) {

    $statsocial_actions_hook_message = false;
}
/**
 * 
 * Show statsocial status bar at browser bottom
 *
 * shows true hide false
 * @since 1.211
 */
if ( !isset( $statsocial_status_bar ) ) {

    $statsocial_status_bar = true;
}
/**
 * Current version of WordPress
 *
 *
 * $statsocial_current_data_theme_uri
 * $statsocial_current_data_author_uri
 * @since 0.965
 */
$statsocial_check_wp_version        = explode( '-', $wp_version );
$statsocial_wp_version              = $statsocial_check_wp_version[0];
/* @since 1.103 */
$statsocial_current_data            = wp_get_theme();
$statsocial_current_data_theme_uri  = apply_filters( 'statsocial_theme_url', $statsocial_current_data->get( 'ThemeURI' ) );
$statsocial_current_data_author_uri = apply_filters( 'statsocial_author_url', $statsocial_current_data->get( 'AuthorURI' ) );
$statsocial_current_data_version    = $statsocial_current_data->get( 'Version' );
$statsocial_current_theme_name      = $statsocial_current_data->get( 'Name' );
/**
 * Include functions about the statsocial options panel
 *
 *
 *
 *
 *
 */
if ( !class_exists( 'statsocial_menu_create' ) ) {

    require_once ( get_template_directory() . '/lib/option-panel.php' );
}

if ( $statsocial_show_theme_option == true ) {

    $is_submenu = new statsocial_menu_create;
    add_action( 'admin_menu', array( $is_submenu, 'statsocial_add_menus' ) );
}
/**
 * Include functions about colors ,backgrounds and borders
 *
 *
 *
 *
 */
$statsocial_included_files = get_included_files();

foreach ( $statsocial_included_files as $key => $val ) {

    $included_file[$key] = basename( $val );
}

$statsocial_included_files  = $included_file;
$statsocial_color_file_path = get_stylesheet_directory() . '/lib/csscolor/csscolor.php';

if ( !in_array( 'csscolor.php', $statsocial_included_files ) && file_exists( $statsocial_color_file_path ) ) {

    require_once ( $statsocial_color_file_path );
} elseif ( !in_array( 'csscolor.php', $statsocial_included_files ) ) {

    require_once ( get_template_directory() . '/lib/csscolor/csscolor.php' );
}

$statsocial_color_file_path = get_stylesheet_directory() . '/lib/csscolor.css.php';

if ( !in_array( 'csscolor.css.php', $statsocial_included_files ) && file_exists( $statsocial_color_file_path ) ) {

    require_once ( $statsocial_color_file_path );
} elseif ( !in_array( 'csscolor.css.php', $statsocial_included_files ) ) {

    require_once ( get_template_directory() . '/lib/csscolor.css.php' );
}
/** statsocial help
 *
 *
 *
 * @since 1.155
 */
add_action( 'load-post.php', array( 'statsocialPostHelp', 'init' ) );
add_action( 'load-post-new.php', array( 'statsocialPostHelp', 'init' ) );
add_action( 'load-themes.php', array( 'statsocialPostHelp', 'init' ) );

class statsocialPostHelp {

    public $tabs = array(
        'statsocial-post' => array(
            'title'   => 'statsocial Help'
            , 'content' => 'help'
        ),
    );

    static public function init() {
        $class = __CLASS__;
        new $class;
    }

    public function __construct() {

        switch ( $GLOBALS['pagenow'] ) {

            case( 'themes.php' ):

                $this->tabs = array( 'statsocial-settings-help' => array( 'title' => 'statsocial Infomation', 'content' => 'help' ) );

                add_action( "load-{$GLOBALS['pagenow']}", array( $this, 'add_tabs_theme' ), 20 );
                break;

            default:
                add_action( "load-{$GLOBALS['pagenow']}", array( $this, 'add_tabs' ), 20 );
                break;
        }
    }

    public function add_tabs() {

        foreach ( $this->tabs as $id => $data ) {

            get_current_screen()->add_help_tab( array(
                'id'       => $id
                , 'title'    => __( 'statsocial Help', 'statsocial' )
                , 'content'  => '<h1>' . __( 'About Base Color related Class', 'statsocial' ) . '</h1>'
                , 'callback' => array( $this, 'prepare' )
            ) );
        }
    }

    public function add_tabs_theme() {

        foreach ( $this->tabs as $id => $data ) {

            get_current_screen()->add_help_tab( array(
                'id'       => $id
                , 'title'    => __( 'statsocial Theme Help', 'statsocial' )
                , 'content'  => '<h1>' . __( 'About statsocial Theme', 'statsocial' ) . '</h1>'
                , 'callback' => array( $this, 'prepare_theme' )
            ) );
        }
    }

    public function prepare( $screen, $tab ) {

        if ( statsocial_USE_AUTO_COLOR !== false ) {

            echo statsocial_edit_help( '' );
        } else {

            printf( '<p class="disable-color-gradient">%1$s</p>', __( 'Now statsocial_USE_AUTO_COLOR value false and Cannot show this help', 'statsocial' ) );
        }
    }

    public function prepare_theme( $screen, $tab ) {

        echo statsocial_settings_page_contextual_help();
    }

}

/**
 * It has alias functions.
 *
 *
 *
 *
 */
$statsocial_functions_file_path = get_stylesheet_directory() . '/lib/alias_functions.php';

if ( !in_array( 'alias_functions.php', $statsocial_included_files ) && file_exists( $statsocial_functions_file_path ) ) {

    require_once ( $statsocial_functions_file_path );
} elseif ( !in_array( 'alias_functions.php', $statsocial_included_files ) ) {

    require_once ( get_template_directory() . '/lib/alias_functions.php' );
}
/**
 *
 *
 *
 * @since 1.138
 */
do_action( 'statsocial_include_after' );
/**
 *
 *
 *
 *
 *
 */
add_action( 'wp_enqueue_scripts', 'add_statsocial_stylesheet' );
/**
 *
 *
 *
 *
 *
 */
register_nav_menus( array( 'primary' => esc_html__( 'Primary Navigation', 'statsocial' ), ) );
/**
 * Custom image header
 *
 *
 *
 * $statsocial_custom_header_args
 *
 */
if ( !isset( $statsocial_custom_header_args ) ) {

    $statsocial_custom_header_args = array( 'default-text-color'     => 'bbb',
        'width'                  => apply_filters( 'statsocial_header_image_width', '950' ),
        'flex-width'             => true,
        'height'                 => apply_filters( 'statsocial_header_image_height', '198' ),
        'flex-height'            => true,
        'header-text'            => true,
        'default-image'          => '%1$s/images/headers/wp3.jpg',
        'wp-head-callback'       => apply_filters( 'statsocial_wp-head-callback', 'statsocial_embed_meta' ),
        'admin-preview-callback' => 'statsocial_admin_header_image', 'admin-head-callback'    => 'statsocial_admin_header_style' );

    add_theme_support( 'custom-header', $statsocial_custom_header_args );
    //they are "suggested" when flex-width and flex-height are set
}
/**
 * It has hooks.
 *
 *
 *
 *
 */
$statsocial_functions_file_path = get_stylesheet_directory() . '/lib/hooks.php';

if ( !in_array( 'alias_functions.php', $statsocial_included_files ) && file_exists( $statsocial_functions_file_path ) ) {

    require_once ( $statsocial_functions_file_path );
} elseif ( !in_array( 'alias_functions.php', $statsocial_included_files ) ) {

    require_once ( get_template_directory() . '/lib/hooks.php' );
}

/**
 * Accessibility Settings
 *
 *  When true
 *  Add to hidden text for identify  entry-title link text, comment link text, more link
 *
 * @since 1.116
 */
function statsocial_extend_query( $vars ) {

    $vars[] = 'friendly';
    return $vars;
}

if ( !isset( $statsocial_link_unique_text ) ) {

    if ( 'yes' == statsocial_warehouse_clone( 'statsocial_accessibility_settings' ) ) {

        $statsocial_link_unique_text = true;
    } else {

        $statsocial_link_unique_text = false;
    }
}
/**
 * Enabling accessibility links when Setting value no at statsocial options page Accessibility Settings
 * 
 * 
 * @since1.217
 */
if ( !isset( $statsocial_accessibility_link ) ) {

    $statsocial_accessibility_link = true;
}

if ( 'yes' == statsocial_warehouse_clone( 'statsocial_accessibility_settings' ) ) {

    $statsocial_accessibility_link = false;
}

if ( isset( $_REQUEST['friendly'] ) && !empty( $_REQUEST['friendly'] ) && true == $statsocial_accessibility_link ) {

    $statsocial_link_unique_text = true;
}

function statsocial_current_url() {

    $url = 'http';
    if ( isset( $_SERVER["HTTPS"] ) && $_SERVER["HTTPS"] == "on" ) {
        $url .= "s";
    }
    $url .= "://";
    if ( isset( $_SERVER["SERVER_PORT"] ) && $_SERVER["SERVER_PORT"] != "80" ) {
        $url .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    $url = esc_url( $url );

    return apply_filters( 'statsocial_current_url', $url );
}
/**
 * home link
 *
 * ver 1.116 default value change
 * if you need home link then $statsocial_nav_menu_home_link set true.
 */
if ( !isset( $statsocial_nav_menu_home_link ) ) {

    if ( true == $statsocial_link_unique_text ) {

        $statsocial_nav_menu_home_link = false;
    } else {

        $statsocial_nav_menu_home_link = true;
    }
}
/**
 * browser detection
 * use server side browser detection or javascript browser ditection
 *
 * javascript browser ditection is At a target [ operate / even when cash plug-in is used / properly ]
 * value bool
 * $statsocial_browser_detection
 * ver 1.121
 */
if ( !isset( $statsocial_browser_detection ) ) {

    $statsocial_browser_detection = false;
}
/**
 * HTML document type
 *
 *
 *
 * Now only 'xhtml'
 * ver 0.999 add type 'html5'
 */
if ( !isset( $statsocial_document_type ) ) {

    if ( 'xhtml' == statsocial_warehouse_clone( 'statsocial_doc_type_settings' ) ) {

        $statsocial_document_type = 'xhtml';
    } else {

        $statsocial_document_type = 'html5';
    }
}
/**
 * Force Document type for lt IE9 Old Browser
 * Note: This setting is SERVER_SIDE Setting, I recommend that the browser is set when the cache of less than IE9 as not performed
 *
 * statsocial 1.204 remove from header.php 
 * 		<!--[if IE]>
 * 		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
 * 		<![endif]--> 
 *
 *
 * ver 1.204 
 */
if ( $is_IE ) {

    preg_match( "|(MSIE )([0-9]{1,2})(\.)|si", $_SERVER['HTTP_USER_AGENT'], $statsocial_regs );

    $statsocial_regs = ( int ) $statsocial_regs[2];

    if ( $statsocial_regs < 9 ) {

        $statsocial_document_type = 'xhtml';
    }
}
/**
 *
 *
 * $statsocial_post_formats_args
 * add ver0.991 gallery,status
 */
if ( !isset( $statsocial_post_formats_args ) ) {

    $statsocial_post_formats_args = array( 'aside', 'gallery', 'chat', 'link', 'image', 'status', 'quote', 'video' );
    add_theme_support( 'post-formats', $statsocial_post_formats_args );
}
/**
 *
 *
 *
 * $statsocial_custom_background_args
 *
 */
if ( !isset( $statsocial_custom_background_args ) ) {

    $statsocial_custom_background_args = array( 'default-color'    => '',
        'default-image'    => '',
        'wp-head-callback' => apply_filters( 'statsocial_wp-head-callback', 'statsocial_embed_meta' ) );
    add_theme_support( 'custom-background', $statsocial_custom_background_args );
}
/**
 *
 *
 *
 * $statsocial_post_thumbnails_args
 *
 */
if ( !isset( $statsocial_post_thumbnails_args ) ) {

    $statsocial_post_thumbnails_args = array( 'post', 'page' );
    add_theme_support( 'post-thumbnails', $statsocial_post_thumbnails_args );
}
/**
 *
 *
 *
 *
 *
 */
add_theme_support( 'automatic-feed-links' );
/**
 * Your extend function , settings write below.
 *
 *
 *
 *
 */
/**
 * Original page width implementation by manual labor
 *
 * If you need original page width
 * you can specific pixel page width
 * e.g. '$statsocial_page_width = '776';' is  776px page width.
 *
 *
 */
if ( !isset( $statsocial_page_width ) ) {

    $statsocial_page_width = '';
}
/**
 * Content width implementation by manual labor
 *
 * If you need specific $content_width.
 * value set 400 When not setting or empty.
 *
 */
//$content_width = '';

/**
 * 750px,950px centered layout fluid or fixed page width switch
 *
 * Empty value makes like a Elastic layout
 *
 * value 'fixed' or empty
 *
 */
if ( !isset( $statsocial_fluid_or_fixed ) ) {

    $statsocial_fluid_or_fixed = 'fixed';
}
/**
 * fluid page  main column minimum width px
 *
 *
 *
 * $statsocial_fluid_minimum_width
 *
 */
if ( !isset( $statsocial_fluid_minimum_width ) ) {

    $statsocial_fluid_minimum_width = '320';
}
/**
 * $statsocial_fluid_minimum_width for IE
 *
 * IE browser not support responsive
 *
 * $statsocial_fluid_minimum_width
 *
 */
if ( $is_IE ) {

    preg_match( "|(MSIE )([0-9]{1,2})(\.)|si", $_SERVER['HTTP_USER_AGENT'], $regs );

    if ( $regs[2] < 9 ) {

        $statsocial_fluid_minimum_width = '640';
    }
}
/**
 * fluid page  main column maximum width px
 *
 *
 *
 * $statsocial_fluid_maximum_width
 *
 */
if ( !isset( $statsocial_fluid_maximum_width ) ) {

    $statsocial_fluid_maximum_width = '1280';
}
/**
 * Special simple view for mobile and small width browser
 * If it sets to true, a display simple compulsory always will be performed.
 *
 * default false
 * $statsocial_fallback_human_interface_show
 *
 */
if ( !isset( $statsocial_fallback_human_interface_show ) ) {

    $statsocial_fallback_human_interface_show = false;
}
/**
 * statsocial header and footer image upload
 *
 * $statsocial_max_width
 * $statsocial_max_upload_size
 * $statsocial_allow_file_type
 *
 */
// Allow image type statsocial footer and header.

if ( !isset( $statsocial_allow_file_type ) ) {

    $statsocial_allow_file_type = array( 'image/png', 'image/jpeg', 'image/jpg', 'image/gif' );
}
//max upload size byte

if ( !isset( $statsocial_max_upload_size ) ) {

    $statsocial_max_upload_size = 2000000;
}
//header or footer image max width px

if ( !isset( $statsocial_max_width ) ) {

    $statsocial_max_width = 1300;
}
/**
 * Custom fields name css is add to post style rules.
 *
 * When false add to style single post and pages
 * When true add to style all list style posts and pages
 * statsocial_OVERRIDE_POST_STYLE_ALL_CONTENTS
 * @since 0.992
 */
if ( !defined( 'statsocial_OVERRIDE_POST_STYLE_ALL_CONTENTS' ) ) {

    define( "statsocial_OVERRIDE_POST_STYLE_ALL_CONTENTS", true );
}
/**
 *
 *
 *
 * statsocial_SHOW_DELETE_POST_LINK
 *
 */
if ( !defined( 'statsocial_SHOW_DELETE_POST_LINK' ) ) {

    define( "statsocial_SHOW_DELETE_POST_LINK", false );
}
/**
 * the_content(   ) or the_excerpt
 *
 * the_excerpt use where index,archive,other not single pages.
 * If statsocial_USE_LIST_EXCERPT value false and use the_content .
 *
 * statsocial_USE_LIST_EXCERPT
 * add ver 1.127
 * When use excerpt please set $statsocial_where_excerpts
 */
if ( !defined( 'statsocial_USE_LIST_EXCERPT' ) ) {

    define( "statsocial_USE_LIST_EXCERPT", false );
}
// values 'is_search', 'is_archive', 'is_category' ,'is_tax', 'is_tag' any conditional function name

if ( !isset( $statsocial_where_excerpts ) ) {

    $statsocial_where_excerpts = array( 'is_search' );
}
/**
 *
 *
 *
 * @since 1.127
 */
if ( !function_exists( 'statsocial_detect_excerpt_condition' ) ) {

    function statsocial_detect_excerpt_condition() {

        global $statsocial_where_excerpts;

        if ( statsocial_USE_LIST_EXCERPT !== true ) {

            return false;
        }

        if ( !empty( $statsocial_where_excerpts ) ) {

            foreach ( $statsocial_where_excerpts as $excerpt ) {

                if ( true == $excerpt() ) {

                    return true;
                }
            }
        }
        return false;
    }

}
/**
 * Auto Color On or Off
 * If you want no Auto Color when set value false.
 *
 *
 * statsocial_USE_AUTO_COLOR
 *
 */
if ( !defined( 'statsocial_USE_AUTO_COLOR' ) ) {

    define( "statsocial_USE_AUTO_COLOR", true );
}
/**
 * Monthly archive, Daily archive  time format
 *
 *
 *
 *
 *
 */
if ( !defined( 'statsocial_TABLE_TITLE' ) ) {

    define( "statsocial_TABLE_TITLE", 'options' );
}

if ( !defined( 'statsocial_PLUGIN_TABLE' ) ) {

    define( 'statsocial_PLUGIN_TABLE', $wpdb->prefix . statsocial_TABLE_TITLE );
}

if ( !isset( $statsocial_theme_settings ) ) {

    $statsocial_theme_settings = get_option( 'statsocial_theme_settings', 'no' );
}
/**
 * single-post-thumbnail
 *
 *
 * statsocial_SINGLE_POST_THUMBNAIL_WIDTH
 * statsocial_SINGLE_POST_THUMBNAIL_HEIGHT
 *
 */
if ( !isset( $statsocial_featured_image_full_size ) ) {

    $statsocial_featured_image_full_size = true;
}

if ( !defined( 'statsocial_SINGLE_POST_THUMBNAIL_WIDTH' ) ) {

    define( 'statsocial_SINGLE_POST_THUMBNAIL_WIDTH', 600 );
}

if ( !defined( 'statsocial_SINGLE_POST_THUMBNAIL_HEIGHT' ) ) {

    define( 'statsocial_SINGLE_POST_THUMBNAIL_HEIGHT', 200 );
}
add_image_size( 'single-post-thumbnail', statsocial_SINGLE_POST_THUMBNAIL_WIDTH, statsocial_SINGLE_POST_THUMBNAIL_HEIGHT, true );

/**
 *
 *
 * statsocial_USE_FEATURED_IMAGE_LIGHT_BOX
 * @since 1.002
 */
if ( !defined( 'statsocial_USE_FEATURED_IMAGE_LIGHT_BOX' ) ) {

    define( 'statsocial_USE_FEATURED_IMAGE_LIGHT_BOX', false );
}
/**
 * widget settings
 *
 * Registered Default Sidebar, Extra Sidebar, Sticky Widget, Footer Widget, Category Blog Widget
 *
 * @since 1.119 Widget label change from Category Blog Widget to Status Sidebar
 *
 */
if ( !function_exists( 'statsocial_widgets_init' ) ) {

    function statsocial_widgets_init() {

        register_sidebar( array( 'name'          => esc_html__( 'Default Sidebar', 'statsocial' ),
            'id'            => 'sidebar-1',
            'before_widget' => '<li id="%1$s" class="%2$s widget default" >',
            'after_widget'  => '</li>',
            'before_title'  => '<h2 class="widgettitle default h2"><span>',
            'after_title'   => '</span></h2>',
            'widget_id'     => 'default',
            'widget_name'   => 'default',
            'text'          => "1" ) );

        register_sidebar( array( 'name'          => esc_html__( 'Extra Sidebar', 'statsocial' ),
            'id'            => 'sidebar-2',
            'before_widget' => '<li id="%1$s" class="%2$s widget extra">',
            'after_widget'  => '</li>',
            'before_title'  => '<h2 class="widgettitle extra h2"><span>',
            'after_title'   => '</span></h2>',
            'widget_id'     => 'extra',
            'widget_name'   => 'extra',
            'text'          => "2" ) );
        register_sidebar( array( 'name'          => esc_html__( 'Sticky Widget', 'statsocial' ),
            'id'            => 'sidebar-3',
            'before_widget' => '<li id="%1$s" class="%2$s widget sticky-widget">',
            'after_widget'  => '</li>',
            'before_title'  => '<h2 class="widgettitle home-top-content h2"><span>',
            'after_title'   => '</span></h2>',
            'widget_id'     => 'toppage2',
            'widget_name'   => 'toppage2',
            'text'          => "3" ) );
        register_sidebar( array( 'name'          => esc_html__( 'Footer Widget', 'statsocial' ),
            'id'            => 'sidebar-4',
            'before_widget' => '<li id="%1$s" class="%2$s widget footer-widget">',
            'after_widget'  => '</li>',
            'before_title'  => '<h2 class="widgettitle footer-widget h2"><span>',
            'after_title'   => '</span></h2>',
            'widget_id'     => 'footer',
            'widget_name'   => 'footer',
            'text'          => "4" ) );
        register_sidebar( array( 'name'          => esc_html__( 'Post Format Status Sidebar', 'statsocial' ),
            'id'            => 'sidebar-5',
            'before_widget' => '<li  id="%1$s" class="%2$s widget category-blog-widget status-side-bar">',
            'after_widget'  => '</li>',
            'before_title'  => '<h2 class="widgettitle category-blog-widget h2 status-side-bar">',
            'after_title'   => '</h2>',
            'widget_id'     => 'categoryblog',
            'widget_name'   => 'categoryblog',
            'text'          => "5" ) );
    }

}
/**
 *
 *
 *
 *
 *
 */
if ( !isset( $statsocial_base_setting ) ) {

    $statsocial_base_setting = $statsocial_base_setting_args;
}

if ( statsocial_warehouse_clone( 'statsocial_show_right_sidebar' ) == 'hide' ) {

    $rsidebar_show = false;
} else {

    $rsidebar_show = true;
}

if ( '25' == statsocial_warehouse_clone( 'statsocial_right_sidebar_width_percent' ) ) {

    $yui_inner_layout = 'yui-ge';
} elseif ( '75' == statsocial_warehouse_clone( 'statsocial_right_sidebar_width_percent' ) ) {

    $yui_inner_layout = 'yui-gf';
} elseif ( '33' == statsocial_warehouse_clone( 'statsocial_right_sidebar_width_percent' ) ) {

    $yui_inner_layout = 'yui-gc';
} elseif ( '66' == statsocial_warehouse_clone( 'statsocial_right_sidebar_width_percent' ) ) {

    $yui_inner_layout = 'yui-gd';
} elseif ( '50' == statsocial_warehouse_clone( 'statsocial_right_sidebar_width_percent' ) ) {

    $yui_inner_layout = 'yui-g';
} else {

    $yui_inner_layout = 'yui-ge';
}

if ( !isset( $statsocial_current_style_type ) ) {

    $statsocial_current_style_type = statsocial_warehouse_clone( "statsocial_style_type" );
}
/**
 * Content width setup
 *
 *
 *
 *
 *
 */
if ( !isset( $content_width ) || empty( $content_width ) ) {

    $content_width = statsocial_content_width_clone();
}
/**
 *
 *
 *
 *
 *
 */
$install_once = get_option( 'statsocial_theme_settings' );

if ( false == $install_once || !array_key_exists( 'install', $install_once ) ) {

    //add_action( 'admin_init', 'setup_statsocial' );
}
add_action( 'widgets_init', 'statsocial_widgets_init' );
/**
 * Add option helper
 *
 *
 *
 *
 *
 */
foreach ( $statsocial_base_setting as $setting ) {

    $function_name = $setting['option_name'] . '_validate';

    if ( !function_exists( $function_name ) ) {

        $message = sprintf( esc_html__( 'If you add  %s when you must create function %s for data validation', 'statsocial' ), $setting['option_name'], $function_name );
        printf( '<script type="text/javascript">alert( \'%s\'  );</script>', $message );
        return;
    }
}
/**
 * Extend body_class(   )
 *
 *
 * add browser class, languages class,
 *
 *
 */
if ( !function_exists( 'statsocial_add_body_class' ) ) {

    function statsocial_add_body_class( $classes ) {

        global $post, $current_blog, $statsocial_link_unique_text, $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone, $statsocial_browser_detection, $statsocial_status_bar;
        $classes[] = get_locale();

        if ( is_single() || is_page() ) {

            $statsocial_options = get_option( "statsocial_theme_settings" );

            if ( isset( $statsocial_options["statsocial_style_type"] ) && !empty( $statsocial_options["statsocial_style_type"] ) ) {

                $color_type = "rd-type-" . $statsocial_options["statsocial_style_type"];
            }

            $statsocial_content_check = get_post( $post->ID );
            $statsocial_content_check = $statsocial_content_check->post_content;

            if ( preg_match( "!\[statsocial[^\]]+(color_type)=(\"|')*?([^\"' ]+)(\"|' )*?[^\]]*\]!si", $statsocial_content_check, $regs ) ) {
                $color_type = "rd-type-" . trim( $regs[3] );
            }
            if ( preg_match( "!\[statsocial[^\]]+(col)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si", $statsocial_content_check, $regs ) ) {

                $color_type .= ' ';
                $color_type .= "rd-col-" . $regs[3];
            }
            if ( !isset( $color_type ) ) { // When not using database
                $color_type = "rd-type-" . statsocial_warehouse( 'statsocial_style_type' );
            }
            $classes[] = $color_type;
        } else {

            $statsocial_options = get_option( "statsocial_theme_settings" );

            if ( isset( $statsocial_options["statsocial_style_type"] ) && !empty( $statsocial_options["statsocial_style_type"] ) ) {

                $classes[] = "rd-type-" . $statsocial_options["statsocial_style_type"];
            }
        }

        if ( true == $statsocial_browser_detection ) {

            if ( isset( $_SERVER["HTTP_ACCEPT_LANGUAGE"] ) ) {

                $browser_lang = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
                $browser_lang = explode( ",", $browser_lang );
                $browser_lang = esc_html( $browser_lang[0] );
                $browser_lang = 'accept-lang-' . $browser_lang;
                $classes[]    = $browser_lang;
            }
            switch ( true ) {
                case ( $is_lynx ):
                    $classes[] = 'lynx';
                    break;

                case ( $is_gecko ):

                    if ( preg_match( '!Trident/.*rv:([0-9]{1,}\.[\.0-9]{0,})!', $_SERVER['HTTP_USER_AGENT'], $regs ) ) {

                        $classes[] = 'ie' . ( int ) $regs[1];
                    } else {

                        $classes[] = 'gecko';
                    }
                    break;

                case ( $is_IE ):
                    preg_match( "|(MSIE )([0-9]{1,2})(\.)|si", $_SERVER['HTTP_USER_AGENT'], $regs );
                    $classes[] = 'ie' . $regs[2];
                    break;

                case ( $is_opera ):
                    $classes[] = 'opera';
                    break;

                case ( $is_NS4 ):
                    $classes[] = 'ns4';
                    break;

                case ( $is_safari ):
                    $classes[] = 'safari';
                    break;

                case ( $is_chrome ):
                    $classes[] = 'chrome';
                    break;

                case ( $is_iphone ):
                    $classes[] = 'iphone';
                    break;

                default:

                    $classes[] = 'unknown2';
                    break;
            }
        }


        if ( isset( $current_blog ) ) {

            $classes[] = "b" . $current_blog->blog_id;
        }

        if ( true == $statsocial_link_unique_text ) {

            $classes[] = 'statsocial-accessible-mode';
        }

        if ( $statsocial_status_bar == true ) {

            $classes[] = 'statsocial-status-bar-active';
        }
        return apply_filters( "statsocial_add_body_class", $classes );
    }

}
/**
 * wp_list_comments callback function
 *
 *
 *
 * comments.php
 *
 */
if ( !function_exists( 'statsocial_comment' ) ) {

    function statsocial_comment( $comment, $args, $depth ) {

        $GLOBALS['comment'] = $comment;

        if ( '' == $comment->comment_type ) {
            ?>
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                <div id="comment-<?php comment_ID(); ?>">
                    <div class="comment-author vcard">
                        <div class="statsocial-comment-avatar">
            <?php echo get_avatar( $comment, 32, '', esc_attr__( 'Avatar', 'statsocial' ) . ' ' . esc_attr( strip_tags( get_comment_author_link() ) ) ); ?> </div>
                        <div class="statsocial-comment-author-meta">
                            <?php
                            printf( '%1$s <span class="says">%2$s</span>', sprintf( '<cite class="fn">%s</cite> ', get_comment_author_link() ), esc_html__( 'says:', 'statsocial' ) );
                            ?>
                        </div>
                        <div class="comment-meta commentmetadata clearfix">
                            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'statsocial' ), get_comment_date(), get_comment_time() ); ?></a>
            <?php
            edit_comment_link( esc_html__( ' Edit ', 'statsocial' ) . statsocial_link_unique( 'Comment', $comment->comment_ID ), ' ' );
            ?>
                        </div>
                    </div>
                    <!-- .comment-author .vcard -->
            <?php
            if ( '0' == $comment->comment_approved ) {
                ?>
                        <div class="clearfix awaiting"> <em><?php esc_html_e( 'Your comment is awaiting moderation.', 'statsocial' ); ?></em>
                            <br />
                        </div>
                <?php
            } //endif
            ?>
                    <!-- .comment-meta .commentmetadata -->
                    <div class="comment-body">
                    <?php
                    comment_text();
                    ?>
                    </div>
                    <div class="reply">
                        <?php
                        $statsocial_comment_reply_text = esc_html__( 'Reply', 'statsocial' ) . statsocial_link_unique( 'Comment', $comment->comment_ID );
                        comment_reply_link( array_merge( $args, array( 'reply_text' => $statsocial_comment_reply_text, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
                        ?>
                    </div>
                    <!-- .reply -->
                </div>
                <!-- #comment-##  -->
            <?php
        } else {
            ?>
            <li class="post pingback">
                <p>
                <?php
                esc_html_e( 'Pingback:', 'statsocial' );
                comment_author_link();
                echo ' ';
                edit_comment_link( esc_html__( ' Edit ', 'statsocial' ) . statsocial_link_unique( 'Comment', $comment->comment_ID ), ' ' );
                ?>
                </p>
                    <?php
                } //endif
            }

        }
        /**
         * Template function posted in
         *
         *
         *
         * loop.php
         *
         */
        if ( !function_exists( 'statsocial_posted_in' ) ) {

            function statsocial_posted_in() {

                global $post;

                if ( is_sticky() ) {

                    return;
                }
                $format   = get_post_format( $post->ID );
                $tag_list = get_the_tag_list( '', ' ' );

                if ( false === $format ) {

                    if ( $tag_list ) {

                        $posted_in = '<span class="this-posted-in">' . esc_html__( 'This entry was posted in', 'statsocial' ) . '</span> %1$s <span class="tagged">' . esc_html__( 'and tagged', 'statsocial' ) . '</span> %2$s';
                    } elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {

                        $posted_in = '<span class="this-posted-in">' . esc_html__( 'This entry was posted in', 'statsocial' ) . '</span> %1$s ';
                    } else {

                        $posted_in = '';
                    }
                    $result = $format . sprintf( $posted_in, get_the_category_list( ' ' ), $tag_list );
                    echo apply_filters( "statsocial_posted_in", $result );
                } else {

                    if ( $tag_list ) {

                        $posted_in = '<span class="this-posted-in">' . esc_html__( 'This entry was posted in', 'statsocial' ) . '</span> %1$s <span class="tagged">' . esc_html__( 'and tagged', 'statsocial' ) . '</span> %2$s ' . '  <span class="post-format-text">%4$s</span> <a href="%3$s"> <span class="post-format">%5$s</span></a>';
                    } elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {

                        $posted_in = '<span class="this-posted-in">' . esc_html__( 'This entry was posted in', 'statsocial' ) . '</span> %1$s %2$s' . '  <span class="post-format-text">%4$s</span><a href="%3$s"> <span class="post-format">%5$s</span></a>';
                    } else {

                        $posted_in = '<a href="%3$s">   <span class="post-format-text">%4$s</span> <span class="post-format">%5$s</span></a>';
                    }
                    $result = sprintf( $posted_in, get_the_category_list( ' ' ), $tag_list, esc_url( get_post_format_link( $format ) ), esc_html( 'Format', 'statsocial' ), get_post_format_string( $format ) );
                    echo apply_filters( "statsocial_posted_in", $result );
                }
            }

        }
        /**
         * Template function statsocial_comments_link
         *
         *
         *
         * loop.php
         * @since 1.163
         */
        if ( !function_exists( 'statsocial_comments_link' ) ) {

            function statsocial_comments_link() {

                if ( comments_open() ) {

                    $statsocial_comment_html = '<a href="%1$s" class="statsocial-comment-link"><span class="statsocial-comment-string point"></span><em>%2$s %3$s</em></a>';

                    if ( get_comments_number() > 0 ) {

                        $statsocial_comment_string = _n( 'Comment', 'Comments', get_comments_number(), 'statsocial' ) . statsocial_link_unique( 'Post', get_the_ID() );
                        $statsocial_comment_number = get_comments_number();
                    } else {

                        $statsocial_comment_string = __( 'Comment ', 'statsocial' ) . statsocial_link_unique( 'Post', get_the_ID() );
                        $statsocial_comment_number = '';
                    }
                } else {

                    $statsocial_comment_html   = '';
                    $statsocial_comment_string = '';
                    $statsocial_comment_number = '';
                }

                $result = sprintf( $statsocial_comment_html, get_comments_link(), $statsocial_comment_number, $statsocial_comment_string );

                return apply_filters( 'statsocial_comments_link', $result, get_comments_link(), $statsocial_comment_number, $statsocial_comment_string );
            }

        }
        /**
         * Template function posted_on
         *
         *
         *
         * loop.php
         *
         */
        if ( !function_exists( 'statsocial_posted_on' ) ) {

            function statsocial_posted_on() {

                global $post;
                $statsocial_date_format = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
                $author                = statsocial_blank_fallback( get_the_author(), 'Somebody' );
                $archive_year          = get_the_time( 'Y' );
                $archive_month         = get_the_time( 'm' );
                $archive_day           = get_the_time( 'd' );
                $day_link              = esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) . '#post-' . $post->ID );

                $result = sprintf( esc_html__( '%1$s %5$s %2$s %6$s %3$s %4$s', 'statsocial' ), '<span class="meta-prep meta-prep-author">', '</span>' . sprintf( '<a href="%1$s" title="%2$s"><%4$s class="entry-date updated" %5$s>%3$s</%4$s></a>', $day_link, esc_attr( 'archives daily ' . get_the_time( $statsocial_date_format ) ), get_the_date( $statsocial_date_format ), statsocial_doctype_elements( 'span', 'time', false ), statsocial_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false ) ) . '<span class="meta-sep">', '</span>' . sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="vcard:url">%3$s</a></span> ', get_author_posts_url( get_the_author_meta( 'ID' ) ), sprintf( esc_attr__( 'View all posts by %s', 'statsocial' ), wp_kses( $author, array() ) ), $author ), apply_filters( 'statsocial_posted_on_comment_link', statsocial_comments_link() ), '<span class="posted-on-string">' . __( 'Posted on', 'statsocial' ) . '</span>', '<span class="posted-by-string">' . __( 'by', 'statsocial' ) . '</span>' );

                $format              = get_post_format();
                $content_empty_check = trim( get_the_content() );

                if ( false === $format ) {

                    echo apply_filters( "statsocial_posted_on", $result );
                } elseif ( empty( $content_empty_check ) ) {

                    echo statsocial_comments_link();
                } else {

                    echo apply_filters( "statsocial_posted_on", $result );
                }
            }

        }
        /**
         * Special custom fields key css, javascript, metatags
         *
         *
         * css,javascrip,meta is separated anothor Custom Field.
         *
         *
         */
        if ( !function_exists( 'statsocial_filter_explode_meta_keys' ) ) {

            function statsocial_filter_explode_meta_keys( $content, $key ) {

                $explode_keys = array( 'css', 'javascript', 'meta' );

                if ( in_array( $key, $explode_keys ) ) {

                    return;
                } else {

                    return $content;
                }
            }

        }
        /**
         * Like a get_option(   )
         *
         *
         * statsocial conditional response.
         *
         * for templates
         */
        if ( !function_exists( 'statsocial_warehouse' ) ) {

            function statsocial_warehouse( $name ) {

                return apply_filters( "statsocial_warehouse", statsocial_warehouse_clone( $name ) );
            }

        }
        /**
         * Return $statsocial_base_setting value.
         *
         *
         *
         *
         *
         */
        if ( !function_exists( 'statsocial_admin_meta' ) ) {

            function statsocial_admin_meta( $name, $meta_name ) {

                global $statsocial_base_setting;
                global $statsocial_page_width;
                $vertical = array();

                foreach ( $statsocial_base_setting as $key => $val ) {

                    if ( !is_null( $statsocial_base_setting ) ) {

                        $vertical[] = $val['option_name'];
                    }
                }

                $row = array_search( $name, $vertical );
                return $statsocial_base_setting[$row][$meta_name];
            }

        }
        /**
         * Admin Panel help
         *
         *
         *
         *
         *
         */
        if ( !function_exists( 'statsocial_settings_page_contextual_help' ) ) {

            function statsocial_settings_page_contextual_help() {

                global $statsocial_current_data;
                $html    = '<dt>%1$s</dt><dd>%2$s</dd>';
                $link    = '<a href="%1$s" %3$s>%2$s</a>';
                $content = '';
                /* theme URI */
                $content .= sprintf( $html, esc_html__( 'Theme URI', 'statsocial' ), sprintf( $link, $statsocial_current_data->get( 'ThemeURI' ), $statsocial_current_data->get( 'ThemeURI' ), 'target="_self"' ) );
                /* AuthorURI */
                $content .= sprintf( $html, esc_html__( 'Author', 'statsocial' ), sprintf( $link, $statsocial_current_data->get( 'AuthorURI' ), $statsocial_current_data->get( 'Author' ), 'target="_self"' ) );
                /* Support */
                $content .= sprintf( $html, esc_html__( 'Support', 'statsocial' ), sprintf( $link, 'http://wordpress.org/support/theme/statsocial', esc_html__( 'http://wordpress.org/support/theme/statsocial', 'statsocial' ), 'target="_blank"' ) . '<br />' . sprintf( $link, 'http://ja.forums.wordpress.org/', esc_html__( 'http://ja.forums.wordpress.org/ lang:Japanese', 'statsocial' ), 'target="_blank"' ) );
                /* Version */
                $content .= sprintf( $html, esc_html__( 'Version', 'statsocial' ), $statsocial_current_data->get( 'Version' ) );
                /* Changelog.txt */
                $content .= sprintf( $html, esc_html__( 'Change log text', 'statsocial' ), sprintf( $link, get_template_directory_uri() . '/changelog.txt', esc_html__( 'Changelog , display new window', 'statsocial' ), 'target="_blank"' ), 'target = "_blank"' );
                /* readme.txt */
                $content .= sprintf( $html, esc_html__( 'Readme text', 'statsocial' ), sprintf( $link, get_template_directory_uri() . '/README.txt', esc_html__( 'Readme , display new window', 'statsocial' ), 'target="_blank"' ) );
                $content = '<dl id="statsocial-help">' . $content . '</dl>';

                return $content;
            }

        }
        /**
         * statsocial edit help
         *
         *
         * Check the real color of the Cradation Class and the Color Class.
         *
         *
         */
        if ( !function_exists( 'statsocial_edit_help' ) ) {

            function statsocial_edit_help( $text, $force = false ) {

                global $post_type_object;
                global $title;

                if ( statsocial_USE_AUTO_COLOR !== true && $force !== true ) {

                    return $text;
                }

                if ( ( isset( $post_type_object ) && ( $title == $post_type_object->labels->add_new_item || $title == $post_type_object->labels->edit_item ) || true == $force ) ) {

                    $result = "<h2 class=\"h2\">" . esc_html__( 'Tips', "statsocial" ) . '</h2>';
                    $result .= '<p>' . esc_html__( 'If statsocial Options panel is opened, and the reference color is set, this arrangement of color is changed at once.', "statsocial" ) . "</p>";
                    $result .= "<dl><dt><h3>" . esc_html__( 'Dinamic Color Class', 'statsocial' ) . '</strong></h3>';
                    $result .= '<dd><table><tr>
        <td style="' . statsocial_colors_clone( 5, 'set' ) . 'padding:0.5em;">class color5</td>
        <td style="' . statsocial_colors_clone( 4, 'set' ) . 'padding:0.5em;">class color4</td>
        <td style="' . statsocial_colors_clone( 3, 'set' ) . 'padding:0.5em;">class color3</td>
        <td style="' . statsocial_colors_clone( 2, 'set' ) . 'padding:0.5em;">class color2</td>
        <td style="' . statsocial_colors_clone( 1, 'set' ) . 'padding:0.5em;">class color1</td></tr><tr>
        <td style="' . statsocial_colors_clone( '-1', 'set' ) . 'padding:0.5em;">class color-1</td>
        <td style="' . statsocial_colors_clone( '-2', 'set' ) . 'padding:0.5em;">class color-2</td>
        <td style="' . statsocial_colors_clone( '-3', 'set' ) . 'padding:0.5em;">class color-3</td>
        <td style="' . statsocial_colors_clone( '-4', 'set' ) . 'padding:0.5em;">class color-4</td>
        <td style="' . statsocial_colors_clone( '-5', 'set' ) . 'padding:0.5em;">class color-5</td></tr>
        <tr><td colspan="5">
        ' . esc_html__( 'code example:please HTML editor mode', 'statsocial' ) . '
        <div  style="' . statsocial_colors_clone( 2, 'set' ) . 'padding:1em;">&lt;div class="color3"&gt;
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum&lt;/div&gt;
        </div></td>
        </tr></table>
        </dd>';
                    $result .= "<dt><h3>" . esc_html__( 'Dinamic Gradient Class', 'statsocial' ) . '</h3></dt>';
                    $result .= '<dd><table><tr>
        <td style="' . statsocial_gradient_single( 1, "asc" ) . 'padding:0.5em;">class gradient5</td>
        <td style="' . statsocial_gradient_single( 2, "asc" ) . 'padding:0.5em;">class gradient4</td>
        <td style="' . statsocial_gradient_single( 3, "asc" ) . 'padding:0.5em;">class gradient3</td>
        <td style="' . statsocial_gradient_single( 4, "asc" ) . 'padding:0.5em;">class gradient2</td>
        <td style="' . statsocial_gradient_single( 5, "asc" ) . 'padding:0.5em;">class gradient1</td></tr><tr>
        <td style="' . statsocial_gradient_single( 1, "desc" ) . 'padding:0.5em;">class gradient-1</td>
        <td style="' . statsocial_gradient_single( 2, "desc" ) . 'padding:0.5em;">class gradient-2</td>
        <td style="' . statsocial_gradient_single( 3, "desc" ) . 'padding:0.5em;">class gradient-3</td>
        <td style="' . statsocial_gradient_single( 4, "desc" ) . 'padding:0.5em;">class gradient-4</td>
        <td style="' . statsocial_gradient_single( 5, "desc" ) . 'padding:0.5em;">class gradient-5</td></tr>
        <tr><td colspan="5">
        ' . esc_html__( 'code example:please HTML editor mode', 'statsocial' ) . '
        <div  style="' . statsocial_gradient_single( 3, "asc" ) . 'padding:1em;">&lt;div class="gradient3"&gt;
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/div&gt;</div></td></tr></table></dd>';
                    $result .= "<dl><dt><h3>" . esc_html__( 'About Featured Image', 'statsocial' ) . '</strong></h3>';
                    $result .= "<dl><dd><p>" . esc_html__( 'image width and height aspect ratio is 3:1. another aspect ratio will be trimming center', 'statsocial' ) . '</p></dd>';
                    $result .= "</dl>";
                    $result .= $text;
                    return $result;
                } else {

                    return $text;
                }
            }

        }
        /**
         * Create admin panel form and define input value.
         *
         *
         *
         *
         */
        if ( !function_exists( 'statsocial_options_init' ) ) {

            function statsocial_options_init() {

                global $statsocial_base_setting;

                if ( isset( $statsocial_base_setting ) ) {

                    foreach ( $statsocial_base_setting as $setting ) {

                        register_setting( 'raindrop_options', $setting['option_name'], $setting['validate'] );
                    }
                }
            }

        }
        /**
         * internal function File upload
         *
         *
         * @param $embed string inline or external or embed
         * @param $id #hd or #ft
         */
        if ( !function_exists( 'statsocial_upload_image_parser' ) ) {

            function statsocial_upload_image_parser( $uri, $embed = "inline", $id = "#hd" ) {

                /* upload image from statsocial admin panel saved filename
                 * e.g. statsocial-item-header-style-no-repeat-top-0-left-0-aomoriken.jpg
                 * filename parse and create style
                 */
                $upload_info = wp_upload_dir();
                $filename    = basename( $uri );

                if ( file_exists( get_stylesheet_directory() . '/images/' . $filename ) ) {

                    if ( '#hd' == $id ) {

                        if ( !file_exists( $upload_info['path'] . '/' . $filename ) ) {

                            return apply_filters( 'statsocial_upload_image_parser_hd', 'background:url(  ' . get_stylesheet_directory_uri() . '/images/' . $filename . '  );background-repeat:repeat-x;' );
                        }
                    } elseif ( '#ft' == $id ) {

                        if ( !file_exists( $upload_info['path'] . '/' . $filename ) ) {

                            return apply_filters( 'statsocial_upload_image_parser_ft', 'background:url(  ' . get_stylesheet_directory_uri() . '/images/' . $filename . '  );background-repeat:repeat-x;' );
                        }
                    }
                } elseif ( file_exists( get_template_directory() . '/images/' . $filename ) ) {

                    if ( '#hd' == $id ) {

                        if ( !file_exists( $upload_info['path'] . '/' . $filename ) ) {

                            return apply_filters( 'statsocial_upload_image_parser_hd', 'background:url(  ' . get_template_directory_uri() . '/images/' . $filename . '  );background-repeat:repeat-x;' );
                        }
                    } elseif ( '#ft' == $id ) {

                        if ( !file_exists( $upload_info['path'] . '/' . $filename ) ) {

                            return apply_filters( 'statsocial_upload_image_parser_ft', 'background:url(  ' . get_template_directory_uri() . '/images/' . $filename . '  );background-repeat:repeat-x;' );
                        }
                    }
                }

                if ( file_exists( $upload_info['path'] . '/' . $filename ) ) {

                    preg_match( "|statsocial-item-([^-]+)|", $filename, $regs );
                    $purpose = $regs[1];
                    $purpose = str_replace( array( "header", "footer" ), array( "#hd", "#ft" ), $purpose );
                    preg_match( "|-style-([^-]+)|", $filename, $regs );
                    $style   = $regs[1];
                    $style   = str_replace( array( 'no', 'x' ), array( 'no-', '-x' ), $style );
                    preg_match( "|-top-(-?[^-]+)|", $filename, $regs );
                    $top     = $regs[1];
                    preg_match( "|-left-(-?[^-]+)|", $filename, $regs );
                    $left    = $regs[1];
                    preg_match( "|-height-([^-]+)|", $filename, $regs );
                    $height  = $regs[1];

                    if ( 'inline' == $embed ) {

                        return apply_filters( 'statsocial_upload_image_parser_prop', 'background:url(  ' . $uri . '  );background-repeat:' . $style . ';background-position:' . $left . 'px ' . $top . 'px;min-height:' . $height . 'px;' );
                    } elseif ( 'external' == $embed || 'embed' == $embed ) {

                        return apply_filters( 'statsocial_upload_image_parser_prop', $purpose . '{background:url(  ' . $uri . '  );background-repeat:' . $style . ';background-position:' . $left . 'px ' . $top . 'px;min-height:' . $height . 'px;}' );
                    } else {

                        return;
                    }
                }
                return false;
            }

        }
        /**
         * Alias function Show real gradient where admin panel help
         *
         *
         *
         *
         * return string inline style rule what gradient
         */
        if ( !function_exists( 'statsocial_gradient_single' ) ) {

            function statsocial_gradient_single( $i, $order = "asc" ) {

                return apply_filters( "statsocial_gradient_single", statsocial_gradient_single_clone( $i, $order ) );
            }

        }
        /**
         * Alias function Create gradient style rule
         *
         *
         *
         * return string embed header current style rule set what gradient
         */
        if ( !function_exists( 'statsocial_gradient' ) ) {

            function statsocial_gradient() {

                return apply_filters( "statsocial_gradient", statsocial_gradient_clone() );
            }

        }
        /**
         * Set stylesheet and few javascript
         *
         *
         *
         *
         */
        if ( !function_exists( "add_statsocial_stylesheet" ) ) {

            function add_statsocial_stylesheet() {

                global $statsocial_current_theme_name, $statsocial_current_data_version;
                $themes          = wp_get_themes();
                $current_theme   = $statsocial_current_theme_name;
                $template_uri    = get_template_directory_uri();
                //$template_uri		= str_replace(  'http:','', $template_uri  );
                $template_path   = get_template_directory();
                $stylesheet_uri  = get_stylesheet_directory_uri();
                //$stylesheet_uri	= str_replace(  'http:','', $stylesheet_uri  );
                $stylesheet_path = get_stylesheet_directory();
                $reset_font_grid = $stylesheet_uri . '/reset-fonts-grids.css';

                if ( !file_exists( $stylesheet_path . '/reset-fonts-grids.css' ) ) {

                    $reset_font_grid = $template_uri . '/reset-fonts-grids.css';
                }
                wp_register_style( 'statsocial_reset_fonts_grids', $reset_font_grid, array(), $statsocial_current_data_version, 'all' );
                wp_enqueue_style( 'statsocial_reset_fonts_grids' );
                $grids = $stylesheet_uri . '/grids.css';

                if ( !file_exists( $stylesheet_path . '/grids.css' ) ) {

                    $grids = $template_uri . '/grids.css';
                }
                wp_register_style( 'statsocial_grids', $grids, array( 'statsocial_reset_fonts_grids' ), $statsocial_current_data_version, 'all' );
                wp_enqueue_style( 'statsocial_grids' );
                $fonts = $stylesheet_uri . '/fonts.css';

                if ( !file_exists( $stylesheet_path . '/fonts.css' ) ) {

                    $fonts = $template_uri . '/fonts.css';
                }
                wp_register_style( 'statsocial_fonts', $fonts, array( 'statsocial_grids' ), $statsocial_current_data_version, 'all' );
                wp_enqueue_style( 'statsocial_fonts' );
                $language = get_locale();

                $lang = '';

                if ( !file_exists( $stylesheet_path . '/languages/css/' . $language . '.css' ) ) {

                    if ( file_exists( $template_path . '/languages/css/' . $language . '.css' ) ) {

                        $lang = $template_uri . '/languages/css/' . $language . '.css';
                    }
                } else {

                    $lang = $stylesheet_uri . '/languages/css/' . $language . '.css';
                }

                if ( !empty( $lang ) ) {

                    wp_register_style( 'lang_style', $lang, array( 'statsocial_fonts' ), $statsocial_current_data_version, 'all' );
                    wp_enqueue_style( 'lang_style' );
                }

                if ( statsocial_warehouse_clone( "statsocial_style_type" ) !== 'w3standard' ) {

                    if ( file_exists( get_stylesheet_directory() . '/css3.css' ) ) {

                        $statsocial_css3 = $stylesheet_uri . '/css3.css';
                    } else {

                        $statsocial_css3 = $template_uri . '/css3.css';
                    }
                    wp_register_style( 'statsocial_css3', $statsocial_css3, array( 'statsocial_fonts' ), $statsocial_current_data_version, 'all' );
                    wp_enqueue_style( 'statsocial_css3' );
                }
                $child = $template_uri . '/style.css';
                wp_register_style( 'style', $child, array( 'statsocial_fonts' ), $statsocial_current_data_version, 'all' );
                wp_enqueue_style( 'style' );

                if ( is_child_theme() ) {

                    $child = $stylesheet_uri . '/style.css';
                    wp_register_style( 'child', $child, array( 'style' ), $statsocial_current_data_version, 'all' );
                    wp_enqueue_style( 'child' );
                }
                /* add small js */
                $statsocial_js = $stylesheet_uri . '/statsocial.js';

                if ( !file_exists( $stylesheet_path . '/statsocial.js' ) ) {

                    $statsocial_js = $template_uri . '/statsocial.js';
                }
                wp_register_script( 'statsocial', $statsocial_js, array( 'jquery', 'jquery-migrate' ), $statsocial_current_data_version, false );
                wp_enqueue_script( 'statsocial' );
            }

        }
        /**
         * filter function comment form
         *
         *
         *
         *
         */
        if ( !function_exists( "statsocial_comment_form" ) ) {

            function statsocial_comment_form( $form ) {

                global $commenter;
                $form['url'] = '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'statsocial' ) . '</label><span class="option">' . esc_html__( 'Option', 'statsocial' ) . '</span><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';
                return apply_filters( "statsocial_comment_form", $form );
            }

        }
        /**
         * filter function remove area required
         *
         *
         *
         *
         */
        if ( !function_exists( "statsocial_custom_remove_aria_required" ) ) {

            function statsocial_custom_remove_aria_required( $arg ) {

                global $statsocial_document_type;

                if ( $statsocial_document_type == 'xhtml' ) {
                    $change = array( "aria-required=\"true\"", "aria-required='true'" );
                    $arg    = str_replace( $change, '', $arg );
                    return $arg;
                } else {
                    return $arg;
                }
            }

        }
        /**
         * Option value set when install.
         *
         *
         *
         *
         */
        if ( !function_exists( "setup_statsocial" ) ) {

            function setup_statsocial() {

                global $wpdb, $statsocial_base_setting;

                if ( false == statsocial_USE_AUTO_COLOR ) {

                    return;
                }
                $statsocial_theme_settings = get_option( 'statsocial_theme_settings' );

                foreach ( $statsocial_base_setting as $add ) {

                    $option_name = $add['option_name'];

                    if ( !isset( $statsocial_theme_settings[$option_name] ) ) {

                        $statsocial_theme_settings[$option_name] = $add['option_value'];
                    }
                }
                $style_type                                      = statsocial_warehouse_clone( "statsocial_style_type" );
                $statsocial_indv_css                              = statsocial_design_output_clone( $style_type ) . statsocial_color_base_clone();
                $statsocial_theme_settings['_statsocial_indv_css'] = $statsocial_indv_css;
                update_option( 'statsocial_theme_settings', $statsocial_theme_settings, "", $add['autoload'] );

                if ( file_exists( get_stylesheet_directory() . '/images/headers/wp3.jpg' ) ) {

                    $statsocial_site_image           = get_stylesheet_directory_uri() . '/images/headers/wp3.jpg';
                    $statsocial_site_thumbnail_image = get_stylesheet_directory_uri() . '/images/headers/wp3-thumbnail.jpg';
                } else {

                    $statsocial_site_image           = get_template_directory_uri() . '/images/headers/wp3.jpg';
                    $statsocial_site_thumbnail_image = get_template_directory_uri() . '/images/headers/wp3-thumbnail.jpg';
                }
                set_theme_mod( 'default-image', $statsocial_site_image );
            }

        }
        /**
         * image element has attribute 'width','height' and image size > column width
         * style max-width value 100% set when expand height height attribute value.
         *
         * IE filter
         *
         */
        if ( !function_exists( "statsocial_ie_height_expand_issue" ) ) {

            function statsocial_ie_height_expand_issue( $content ) {

                global $is_IE, $content_width;

                if ( $is_IE ) {

                    preg_match_all( '#(<img)([^>]+)(height|width)(=")([0-9]+)"([^>]+)(height|width)(=")([0-9]+)"([^>]*)>#', $content, $images, PREG_SET_ORDER );

                    foreach ( $images as $image ) {

                        if ( ( "width" == $image[3] && $image[5] > $content_width ) || ( "width" == $image[7] && $image[9] > $content_width ) ) {

                            $content = str_replace( $image[0], $image[1] . $image[2] . $image[6] . $image[10] . '>', $content );
                        }
                    }
                    return $content;
                } else {

                    return $content;
                }
            }

        }
        /**
         * statsocial once message when install.
         *
         *
         *
         *
         *
         */
        if ( !function_exists( "statsocial_first_only_msg" ) ) {

            function statsocial_first_only_msg( $type = 0 ) {

                global $statsocial_current_theme_name;

                if ( 1 == $type ) {

                    $query = 'statsocial_settings';
                    $link  = get_site_url( '', 'wp-admin/themes.php', 'admin' ) . '?page=' . $query;

                    if ( version_compare( PHP_VERSION, '5.0.0', '<' ) ) {

                        $msg = sprintf( esc_html__( 'Sorry Your PHP version is %s Please use PHP version 5 || later.', 'statsocial' ), PHP_VERSION );
                    } else {

                        $msg = sprintf( esc_html__( 'Thank you for adopting the %1$s theme. It is necessary to set it to this theme. Please move to a set screen clicking this ', 'statsocial' ) . '<a href="%2$s">' . esc_html__( 'statsocial settings view', 'statsocial' ) . '</a>.', $statsocial_current_theme_name, $link );
                    }
                }
                return '<div id="testmsg" class="error"><p>' . $msg . '</p></div>' . "\n";
            }

        }
        /**
         * Management of uninstall and install.
         *
         *
         *
         * ver 1.114 Theme data automatic change is supported at the time of site change.
         */
        if ( !function_exists( "statsocial_install_navigation" ) ) {

            function statsocial_install_navigation() {


                $install    = get_option( 'statsocial_theme_settings' );
                $upload_dir = wp_upload_dir();
                if ( false == $install ) {
                    
                } else {

                    if ( isset( $install['current_stylesheet_dir_url'] ) && get_stylesheet_directory_uri() !== $install['current_stylesheet_dir_url'] ) {

                        $install['_statsocial_indv_css']        = str_replace( $install['current_stylesheet_dir_url'], get_stylesheet_directory_uri(), $install['_statsocial_indv_css'] );
                        $install['old_stylesheet_dir_url']     = $install['current_stylesheet_dir_url'];
                        $install['current_stylesheet_dir_url'] = get_stylesheet_directory_uri();
                        update_option( 'statsocial_theme_settings', $install );
                    } elseif ( !isset( $install['current_stylesheet_dir_url'] ) ) {

                        $install['current_stylesheet_dir_url'] = get_stylesheet_directory_uri();
                        update_option( 'statsocial_theme_settings', $install );
                    }

                    if ( isset( $install['current_upload_base_url'] ) && $upload_dir !== $install['current_upload_base_url'] ) {

                        $install['_statsocial_indv_css']     = str_replace( $install['current_upload_base_url'], $upload_dir['baseurl'], $install['_statsocial_indv_css'] );
                        $install['old_upload_base_url']     = $install['current_upload_base_url'];
                        $install['current_upload_base_url'] = $upload_dir['baseurl'];
                        update_option( 'statsocial_theme_settings', $install );
                    } elseif ( !isset( $install['current_upload_base_url'] ) ) {

                        $install['current_upload_base_url'] = $upload_dir['baseurl'];
                        update_option( 'statsocial_theme_settings', $install );
                    }
                    add_action( 'switch_theme', create_function( null, 'delete_option(  "statsocial_theme_settings"  );' ) );
                }
            }

        }
        /**
         * insert into embed style ,javascript script and embed tags from custom field
         *
         *
         *
         *
         */
        if ( !function_exists( "statsocial_embed_css" ) ) {

            function statsocial_embed_css() {

                global $post, $statsocial_fluid_or_fixed, $statsocial_fluid_minimum_width, $statsocial_wp_version, $statsocial_current_theme_name, $statsocial_page_width;
                $css                  = statsocial_gallerys();
                //#header-image
                $css .= "\n" . statsocial_header_image( 'css' ) . "\n";
                //site-title
                $statsocial_text_color = get_theme_mod( 'header_textcolor', 'dddddd' );

                if ( $statsocial_text_color !== 'blank' ) {

                    $css .= "\n#site-title a{color:#" . $statsocial_text_color . ';}';
                }
                //page type

                if ( isset( $statsocial_fluid_or_fixed ) && !empty( $statsocial_fluid_or_fixed ) && ( 'doc' == statsocial_warehouse_clone( "statsocial_page_width" ) || 'doc2' == statsocial_warehouse_clone( "statsocial_page_width" ) || 'custom-doc' == statsocial_warehouse_clone( "statsocial_page_width" ) ) ) {

                    $css .= statsocial_is_fixed();
                } elseif ( isset( $statsocial_fluid_minimum_width ) && !empty( $statsocial_fluid_minimum_width ) ) {

                    $css .= statsocial_is_fluid();
                }
                //#hd
                $uploads          = wp_upload_dir();
                $header_image_uri = $uploads['url'] . '/' . statsocial_warehouse( 'statsocial_header_image' );

                if ( 'statsocial' !== $statsocial_current_theme_name && 'header.png' == statsocial_warehouse( 'statsocial_header_image' ) ) {

                    $header_image_uri = str_replace( $statsocial_current_theme_name, 'statsocial', $header_image_uri );
                }
                $css .= "\n#hd{" . statsocial_upload_image_parser( $header_image_uri, 'inline', '#hd' ) . '}';
                //#ft
                $footer_image_uri = $uploads['url'] . '/' . statsocial_warehouse( 'statsocial_footer_image' );

                if ( 'statsocial' !== $statsocial_current_theme_name && 'footer.png' == statsocial_warehouse( 'statsocial_footer_image' ) ) {

                    $footer_image_uri = str_replace( $statsocial_current_theme_name, 'statsocial', $footer_image_uri );
                }
                $css .= "\n#ft{" . statsocial_upload_image_parser( $footer_image_uri, 'inline', '#ft' ) . '}';
                // 2col 3col change style helper
                $css .= '/*' . statsocial_warehouse_clone( 'statsocial_show_right_sidebar' ) . '*/';

                if ( "show" == statsocial_warehouse_clone( 'statsocial_show_right_sidebar' ) ) {

                    $css .= ' .rsidebar{display:block;} ';
                } else {

                    $css .= ' .rsidebar{display:none;} ';
                }
                // Custom page width helper
                /* Duplication next version removed . change from statsocial_custom_width(   ) to statsocial_is_fixed( ). */
                /*
                  if ( isset( $statsocial_page_width ) and ! empty( $statsocial_page_width ) ) {

                  $css                 .= statsocial_custom_width(   );
                  }
                 */
                //when manual style rule mode

                if ( statsocial_warehouse_clone( "statsocial_style_type" ) == $statsocial_current_theme_name ) {

                    return $css . statsocial_warehouse_clone( '_statsocial_indv_css' );
                }
                $statsocial_options = get_option( "statsocial_theme_settings" );

                if ( isset( $statsocial_options['statsocial_style_type'] ) && !empty( $statsocial_options['statsocial_style_type'] ) ) {

                    $statsocial_style_type = $statsocial_options['statsocial_style_type'];
                } else {

                    $statsocial_style_type = '';
                }
                $statsocial_options         = get_option( 'statsocial_theme_settings' );
                $statsocial_base_color      = statsocial_warehouse_clone( 'statsocial_base_color' );
                $statsocial_hyperlink_color = statsocial_warehouse_clone( 'statsocial_hyperlink_color' );
                $statsocial_indv_css        = statsocial_design_output( $statsocial_style_type ) . statsocial_color_base( $statsocial_base_color );
                //when this code exists [statsocial color_type="minimal" col="1"] in the post
                $statsocial_indv_css        = statsocial_color_type_custom( $statsocial_indv_css );
                $css .= apply_filters( "statsocial_indv_css", $statsocial_indv_css );

                if ( $statsocial_hyperlink_color !== '' ) {

                    $css .= statsocial_custom_link_color( $statsocial_hyperlink_color );
                }
                $background = get_background_image();
                $color      = get_background_color();

                if ( !empty( $background ) || !empty( $color ) ) {

                    $css = preg_replace( "|body[^{]*{[^}]+}|", "", $css );
                }
                //body background
                $body_background            = get_theme_mod( "background_color" );
                $body_background_image      = get_theme_mod( "background_image" );
                $body_background_repeat     = get_theme_mod( "background_repeat" );
                $body_background_position_x = get_theme_mod( "background_position_x" );
                $body_background_attachment = get_theme_mod( "background_attachment" );

                if ( $body_background !== false && !empty( $body_background ) && !empty( $body_background_image ) ) {

                    $css .= "\nbody{background:#" . $body_background . ' url(  ' . $body_background_image . '  );}';
                } elseif ( $body_background !== false && !empty( $body_background ) ) {

                    $css .= "\nbody{background-color:#" . $body_background . ';}';
                } elseif ( !empty( $body_background_image ) ) {

                    $css .= "\nbody{background-image: url(  " . $body_background_image . '  );}';
                }

                if ( isset( $body_background_repeat ) && !empty( $body_background_repeat ) ) {

                    $css .= "\nbody{background-repeat: " . $body_background_repeat . ';}';
                }

                if ( isset( $body_background_position_x ) && !empty( $body_background_position_x ) ) {

                    $css .= "\nbody{background-position:top " . $body_background_position_x . ';}';
                }

                if ( isset( $body_background_attachment ) && !empty( $body_background_attachment ) ) {

                    $css .= "\nbody{background-attachment: " . $body_background_attachment . ';}';
                }

                if ( empty( $css ) ) {

                    $css = "cannot get style value check me";
                }

                if ( WP_DEBUG !== true ) {

                    $css = str_replace( array( "\n", "\r", "\t", '&quot;', '--', '\"' ), array( "", "", "", '"', '', '"' ), $css );
                } else {

                    $css = str_replace( array( '&quot;', '--', '\"' ), array( '"', '', '"' ), $css );
                }
                return apply_filters( "statsocial_embed_meta_css", $css );
            }

        }
        /**
         *
         *
         *
         *
         *
         */
        if ( !function_exists( "statsocial_custom_link_color" ) ) {

            function statsocial_custom_link_color( $color ) {

                $css = <<< LINK_COLOR_CSS
    .entry-content a:link,
    .entry-content a:active,
    .entry-content a:visited,
    .entry-content a:hover{
    	color:{$color};
    }

    .entry-title a:link,
    .entry-title a:active,
    .entry-title a:visited,
    .entry-title a:hover{
    	color:{$color};
    }

    .posted-on a:link,
    .posted-on a:active,
    .posted-on a:visited,
    .posted-on a:hover{
    	color:{$color};
    }
    .entry-meta-default .entry-date{
    color:{$color};
    }/*single.php*/
    .entry-meta-default .author a{
    	color:{$color};
    }/*single.php*/

    .post .entry-meta,
    .entry-meta a:link,
    .entry-meta a:active,
    .entry-meta a:visited,
    .entry-meta a:hover{
    	color:{$color};
    }

    .rsidebar a:link,
    .rsidebar a:active,
    .rsidebar a:visited,
    .rsidebar a:hover{
    	color:{$color};
    }
    .lsidebar a:link,
    .lsidebar a:active,
    .lsidebar a:visited,
    .lsidebar a:hover{
    	color:{$color};
    }

    #wp-calendar{
    color:{$color};
    }
    .statsocial-comment-link em,
    .statsocial-comment-link a:link em,
    .statsocial-comment-link a:active em,
    .statsocial-comment-link a:visited em,
    .statsocial-comment-link a:hover em{
    	color:{$color}! important;
    }

    #nav-above .nav-previous a,
    #nav-above .nav-next a,
    #nav-below .nav-previous a,
    #nav-below .nav-next a{
    	color:{$color};

    }
    .logged-in-as a:link,
    .logged-in-as a:active,
    .logged-in-as a:visited,
    .logged-in-as a:hover{
    	color:{$color};
    }
LINK_COLOR_CSS;
                if ( preg_match( "!#([0-9a-f]{6}|[0-9a-f]{3})!si", $color ) ) {

                    return apply_filters( "statsocial_custom_link_color", $css );
                }
            }

        }
        /**
         *
         *
         *
         *
         *
         */
        if ( !function_exists( "statsocial_embed_meta" ) ) {

            function statsocial_embed_meta( $content ) {

                global $post;
                $result      = "";
                $css         = statsocial_embed_css();
                $result_indv = '';

                if ( statsocial_USE_AUTO_COLOR !== true ) {

                    //  $css = '';
                }

                if ( is_single() || is_page() ) {

                    $css_single = get_post_meta( $post->ID, 'css', true );

                    if ( true == statsocial_OVERRIDE_POST_STYLE_ALL_CONTENTS ) {

                        $css .= preg_replace_callback( '![^}]+{[^}]+}!siu', 'statsocial_css_add_id', $css_single );
                    } else {

                        $css .= $css_single;
                    }

                    if ( !empty( $css ) && statsocial_CUSTOM_FIELD_CSS == true ) {

                        $result .= '<style type="text/css" id="statsocial-embed-css">';
                        $result .= "\n<!--/*<! [CDATA[*/\n";
                        $result .= strip_tags( $css );
                        $result .= "\n/*]]>*/-->\n";
                        $result .= "</style>";
                    }

                    $meta = get_post_meta( $post->ID, 'meta', true );

                    if ( !empty( $meta ) && statsocial_CUSTOM_FIELD_META == true ) {

                        $result .= statsocial_esc_custom_field_meta( $meta );
                    }

                    $javascript = get_post_meta( $post->ID, 'javascript', true );

                    if ( !empty( $javascript ) && statsocial_CUSTOM_FIELD_SCRIPT == true ) {

                        $result .= '<script type="text/javascript">';
                        $result .= "\n<!--/*<! [CDATA[*/\n";
                        $result .= statsocial_esc_custom_field_javascript( $javascript );
                        $result .= "\n/*]]>*/-->\n";
                        $result .= "</script>";
                    }
                } else {

                    $result .= '<style type="text/css">';
                    $result .= "\n<!--/*<! [CDATA[*/\n";
                    $result .= $css;

                    if ( true == statsocial_OVERRIDE_POST_STYLE_ALL_CONTENTS ) {

                        if ( have_posts() ) {

                            if ( false == statsocial_USE_AUTO_COLOR ) {
                                
                            }
                            $result .= "\n/*start custom fields style for loop pages*/\n";
                            while ( have_posts() ) {
                                the_post();
                                $collections = get_post_meta( $post->ID, 'css', true );
                                $result_indv .= preg_replace_callback( '![^}]+{[^}]+}!siu', 'statsocial_css_add_id', $collections );
                            }
                            rewind_posts();
                        }
                    }

                    if ( WP_DEBUG !== true ) {

                        $result_indv = str_replace( array( "\n", "\r", "\t", '&quot;', '--', '\"' ), array( "", "", "", '"', '', '"' ), $result_indv );
                    }
                    $result .= $result_indv;
                    $result .= "\n/*end custom fields style for loop pages*/\n";
                    $result .= "\n/*]]>*/-->\n";
                    $result .= "</style>";
                }
                echo apply_filters( 'statsocial_embed_meta_echo', $result );
                return $content;
            }

        }

        if ( !function_exists( 'statsocial_esc_custom_field_meta' ) ) {

            function statsocial_esc_custom_field_meta( $meta_input ) {

                if ( statsocial_CUSTOM_FIELD_META !== true ) {
                    return;
                }
                $meta = preg_replace( '!>[^<]+<!', ">\n<", $meta_input );
                $meta = "\n{$meta}\n";
                $meta = preg_replace( '!style\s*=\s*("|\')[^"\']+("|\')!', '', $meta );
                $meta = preg_replace( '!onmouseover\s*=\s*("|\')[^"\']+("|\')!', '', $meta );
                $meta = strip_tags( $meta, '<base><link><meta>' );

                if ( is_singular() && !empty( $meta_input ) ) {

                    return apply_filters( 'statsocial_esc_custom_field_meta', $meta, $meta_input );
                }

                return;
            }

        }

        /**
         * When custom field <base>element add single post display properly.
         * But loop page not adding <base>element,result display improperly.
         * this filter detect custom field <base> and add base URL to relative links and image source.
         */
        add_filter( 'the_content', 'statsocial_custom_field_meta_helper' );

        if ( !function_exists( 'statsocial_custom_field_meta_helper' ) ) {

            function statsocial_custom_field_meta_helper( $content ) {

                global $post;

                $meta_values = get_post_meta( $post->ID, 'meta', true );

                if ( !empty( $meta_values ) && strstr( $meta_values, '<base' ) !== false && !is_singular() ) {

                    preg_match( '!<base.+href\s*=\s*("|\')([^"\']+)("|\')!', $meta_values, $regs );

                    /* NOTE: This preg_replace has Notice:Undefined offset: 2,  add patturn exists check */

                    if ( preg_match( '!(href\s*=\s*|src\s*=\s*)("|\')([^//]*)?("|\')!', $content ) ) {

                        $content = preg_replace( '!(href\s*=\s*|src\s*=\s*)("|\')([^//]*)?("|\')!', '$1"' . esc_url( $regs[2] ) . '$3"', $content );

                        return apply_filters( 'statsocial_esc_custom_field_meta_helper', $content );
                    }
                }

                return $content;
            }

        }

        if ( !function_exists( 'statsocial_esc_custom_field_javascript' ) ) {

            function statsocial_esc_custom_field_javascript( $script ) {

                if ( statsocial_CUSTOM_FIELD_SCRIPT !== true ) {
                    return;
                }
                if ( is_singular() && !empty( $script ) ) {

                    $javascript = str_replace( array( "\n", "\t", "\r", ), ' ', $script );

                    return apply_filters( 'statsocial_esc_custom_field_javascript', $javascript, $script );
                }
                return;
            }

        }

        /**
         *
         *
         *
         * @since 0.992
         */
        if ( !function_exists( "statsocial_css_add_id" ) ) {

            function statsocial_css_add_id( $matches ) {

                global $post;
                $result = '';

                foreach ( $matches as $k => $match ) {

                    if ( preg_match( '|^(.+){(.+)|siu', $match, $regs ) ) {

                        $match_1 = str_replace( ',', ', #post-' . $post->ID . ' ', $regs[1] );
                        $match   = $match_1 . '{' . $regs[2];
                    }

                    $result .= '#post-' . $post->ID . ' ' . trim( $match ) . "\n";
                }
                return $result;
            }

        }
        /**
         * Alternative character when value is blank
         *
         *
         *
         *
         */
        if ( !function_exists( "statsocial_blank_fallback" ) ) {

            function statsocial_blank_fallback( $string, $fallback ) {

                if ( !empty( $string ) ) {

                    return $string;
                } else {

                    return $fallback;
                }
            }

        }
        /**
         * Article navigation
         *
         *
         *
         *
         */
        if ( !function_exists( "statsocial_prev_next_post" ) ) {

            function statsocial_prev_next_post( $position = "nav-above" ) {

                if ( is_category() ) {

                    $filter = true; //display same category.
                } else {

                    $filter = false;
                }
                //exclude separate 'and'
                $exclude_category = apply_filters( 'statsocial_next_prev_excluded_categories', '' );
                $html             = '<div id="%1$s" class="%2$s"><span class="%3$s">';
                printf( $html, $position, "clearfix", "nav-previous" );
                previous_post_link( '%link', '<span class="button"><span class="meta-nav">&laquo;</span> %title</span>', $filter, $exclude_category );
                $html             = '</span><div class="%1$s">';
                printf( $html, "nav-next" );
                next_post_link( '%link', '<span class="button"> %title <span class="meta-nav">&raquo;</span></span>', $filter, $exclude_category );
                $html             = '</div></div>';
                echo apply_filters( "statsocial_prev_next_post", $html );
            }

        }
        /**
         * date.php
         *
         *
         *
         *
         */
        if ( !function_exists( "statsocial_days_in_month" ) ) {

            function statsocial_days_in_month( $month, $year ) {

                $daysInMonth = array( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );

                if ( $month != 2 ) {

                    return $daysInMonth[$month - 1];
                }
                return ( checkdate( $month, 29, $year ) ) ? 29 : 28;
            }

        }
        /**
         *
         *
         *
         *
         *
         */
        /**
         * for date.php
         *
         *
         *
         *
         */
        if ( !function_exists( "statsocial_get_year" ) ) {

            function statsocial_get_year( $posts = '', $year = '', $pad = 0 ) {

                global $calendar_page_number, $post_per_page, $calendar_page_last, $calendar_page_start;
                $months = array();
                $y      = "";
                $m      = "";
                $d      = "";
                // first let's parse through our posts, organizing them by month

                foreach ( $posts as $post ) {

                    $y            = substr( $post->post_date, 0, 4 );
                    $m            = substr( $post->post_date, 5, 2 );
                    $d            = substr( $post->post_date, 8, 2 );
                    $months[$m][] = $post;
                }

                $output     = "<h2 class=\"h2 year\"><span class=\"year-name\">$year</span></h2>";
                $table_year = array( '<table id="statsocial_year_list"' . statsocial_doctype_elements( 'summary ="Archives in ' . $year . '"', '', false ) . '><tbody>', '<tr><td class="month-name">1</td><td></td></tr>', '<tr><td class="month-name">2</td><td></td></tr>', '<tr><td class="month-name">3</td><td></td></tr>', '<tr><td class="month-name">4</td><td></td></tr>', '<tr><td class="month-name">5</td><td></td></tr>', '<tr><td class="month-name">6</td><td></td></tr>', '<tr><td class="month-name">7</td><td></td></tr>', '<tr><td class="month-name">8</td><td></td></tr>', '<tr><td class="month-name">9</td><td></td></tr>', '<tr><td class="month-name">10</td><td></td></tr>', '<tr><td class="month-name">11</td><td></td></tr>', '<tr><td class="month-name">12</td><td></td></tr>', '</tbody></table>' );

                foreach ( $months as $num => $val ) {

                    $num              = ( int ) $num;
                    $table_year[$num] = '<tr><td class="month-name"><a href="' . get_month_link( $year, $num ) . "\" title=\"$year/$num\">" . $num . '</a></td><td class="month-excerpt"><a href="' . get_month_link( $year, $num ) . "\" title=\"$year/$num\">" . sprintf( esc_html__( "%s Articles archived", "statsocial" ), count( $val ) ) . '</a></td></tr>';
                }
                return $output . implode( "\n", $table_year );
            }

        }
        /* end statsocial_get_year(   ) */
        /**
         * for date.php
         *
         *
         *
         *
         */
        if ( !function_exists( "statsocial_get_day" ) ) {

            function statsocial_get_day( $posts = '', $year = '', $mon = '', $day = '', $pad = 1 ) {

                global $month;
                $here   = home_url();
                $output = "<h2 class=\"h2 year-month-date\"><a href=\"" . get_year_link( $year ) . "\" title=\"$year\"><span class=\"year-name\">$year</span></a> <a href=\"" . get_month_link( $year, $mon ) . "\" title=\"$year/$mon\"><span class=\"month-name\">" . $mon . "</span></a>&nbsp;<span class=\"day-name\">" . $day . "</span></h2>";
                $output .= '<table id="date_list" ' . statsocial_doctype_elements( 'summary="Archive in ' . $day . ', ' . $mon . ', ' . $year . '"', '', false ) . '>';

                foreach ( $posts as $mytime ) {

                    $h = substr( $mytime->post_date, 11, 2 );

                    if ( 10 > $h ) {

                        $h = substr( $h, 1, 1 );
                    }
                    $today[$h][] = $mytime;
                }

                for ( $i = 0; $i <= 24; $i++ ) {
                    $output .= '<tr><td class="time">';

                    if ( 10 > $i ) {

                        $output .= "0$i:00";
                    } else {

                        $output .= "$i:00";
                    }
                    $output .= '</td><td>';

                    if ( isset( $today[$i] ) ) {

                        foreach ( $today[$i] as $mytime ) {

                            $mytime->post_title = statsocial_fallback_title( $mytime->post_title );
                            $mytime->post_title = preg_replace( '|>.+</|', '>[Article ' . $mytime->ID . ']</', $mytime->post_title );


                            $output .= "<a href=\"" . get_permalink( $mytime->ID ) . "\"
id=\"post-" . $mytime->ID . "\">$mytime->post_title</a><br />";
                        }
                    } else {

                        $output .= '<span style="visibility:hidden;">.</span>';
                    }
                    $output .= '</td></tr>';
                }
                $output .= '</table>';
                return $output;
            }

        }
        /* end statsocial_get_day(   ) */
        /**
         * for date.php
         *
         *
         *
         *
         */
        if ( !function_exists( "statsocial_year_list" ) ) {

            function statsocial_year_list( $one_month, $ye, $mo ) {

                global $calendar_page_number, $post_per_page, $calendar_page_last, $calendar_page_start;
                $d      = "";
                $links  = "";
                $result = "";

                foreach ( $one_month as $key => $month ) {

                    list( $y, $m, $d ) = sscanf( $month->post_date, "%d-%d-%d $d:$d:$d" );
                    $month->post_title = statsocial_fallback_title( $month->post_title );
                    $month->post_title = preg_replace( '|>.+</|', '>[link to ' . $month->ID . ']</', $month->post_title );

                    if ( $m == $mo && $ye == $y ) {

                        $links .= "<li class=\"$mo\"><a href=\"" . get_permalink( $month->ID ) . "\" title=\"" . esc_attr( strip_tags( $month->post_title ) ) . "\">" . $month->post_title . "</a></li>";
                    }
                }

                if ( !empty( $links ) ) {

                    $result .= " <td><ul>";
                    $result .= $links;
                    $result .= "</ul></td>";
                }
                return $result;
            }

        }
        /**
         * sort month_list
         *
         *
         *
         *
         */
        if ( !function_exists( "statsocial_cmp_ids" ) ) {

            function statsocial_cmp_ids( $a, $b ) {

                $cmp = strcmp( $a->post_date, $b->post_date );
                return $cmp;
            }

        }
        /**
         * for date.php
         *
         *
         *
         *
         *
         */
        if ( !function_exists( "statsocial_month_list" ) ) {

            function statsocial_month_list( $one_month, $ye, $mo ) {

                global $calendar_page_number, $post_per_page, $calendar_page_last, $calendar_page_start;
                $result = "";
                $here   = home_url();
                $z      = - 1;
                $c      = 0;

                for ( $i = 1; $i <= statsocial_days_in_month( $mo, $ye ); $i++ ) {
                    $links      = "";
                    usort( $one_month, "statsocial_cmp_ids" );
                    $page_break = false;
                    $first_data = false;

                    foreach ( $one_month as $key => $month ) {

                        list( $y, $m, $d, $h, $m, $s ) = sscanf( $month->post_date, "%d-%d-%d %d:%d:%d" );

                        if ( $key < $calendar_page_last && $key >= $calendar_page_start ) {

                            if ( $d == $i && $m == $mo && $y == $ye ) {

                                $first_data        = true;
                                $month->post_title = statsocial_fallback_title( $month->post_title );
                                $month->post_title = preg_replace( '|>.+</|', '>[link to ' . $month->ID . ']</', $month->post_title );

                                $html = '<li id="post-%5$s" %6$s>
                        <span class="%1$s"><a href="%2$s" rel="bookmark" title="%3$s">%4$s</a></span>
                        <%7$s class="entry-date updated" %8$s>%9$s</%7$s>
                        <span class="author vcard"><a class="url fn n" href="%10$s" title="%11$s" rel="vcard:url">%12$s</a></span> 					</li>';

                                $display_name = get_the_author_meta( 'display_name', $month->post_author );
                                $links .= sprintf( $html, 'h2 entry-title', esc_url( get_permalink( $month->ID ) ), 'link to content: ' . esc_attr( strip_tags( $month->post_title ) ), $month->post_title, $month->ID, ' ' . statsocial_post_class( array( 'clearfix' ), $month->ID, false ), statsocial_doctype_elements( 'span', 'time', false ), statsocial_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false ), $month->post_date, get_author_posts_url( get_the_author_meta( 'ID' ) ), sprintf( esc_attr__( 'View all posts by %s', 'statsocial' ), $display_name ), $display_name
                                );
                                $c++;
                            }
                        }
                    }
                    $post_per_page = get_option( 'posts_per_page' );
                    $post_per_page = apply_filters( 'statsocial_month_list_post_count', $post_per_page );

                    if ( $z == $c && $c == $post_per_page ) {

                        break;
                    }

                    if ( !empty( $links ) ) {

                        $result .= "<tr><td class=\"month-date\"><span class=\"day-name\">";
                        $result .= "<a href=\"" . get_day_link( $y, $mo, $i ) . "\">";
                        $result .= $i;
                        $result .= " </a></span></td><td><ul>";
                        $result .= $links;
                        $result .= "</ul></td></tr>";
                    } else {

                        $result .= "<tr class=\"no-archive\"><td class=\"month-date\"><span class=\"day-name\">";
                        $result .= $i;
                        $result .= " </span></td><td>&nbsp;</td></tr>";
                    }
                    $z = $c;
                }
                $output = "<h2 id=\"date_title\" class=\"h2 year-month\"><a href=\"" . esc_url( get_year_link( $y ) ) . "\" title=\"" . esc_attr( $y ) . "\"><span class=\"year-name\">" . esc_html( $y ) . "</span></a> <span class=\"month-name\">" . esc_html( $m ) . " </span></h2>";
                return $output . '<table id="month_list" ' . statsocial_doctype_elements( 'summary="Archive in ' . esc_attr( $m ) . ', ' . esc_attr( $y ) . '"', '', false ) . '>' . $result . "</table>";
            }

        }
        /**
         * index ,archive,loops page title
         *
         * echo Archives title
         *
         *
         */
        if ( !function_exists( "statsocial_loop_title" ) ) {

            function statsocial_loop_title() {

                global $template;

                $statsocial_class_name = "";
                $page_title           = "";
                $page_title_c         = "";

                if ( is_search() ) {

                    $statsocial_class_name = 'serch-result';
                    $page_title           = esc_html__( "Search Results", 'statsocial' );
                    $page_title_c         = get_search_query();
                } elseif ( is_tag() ) {

                    $statsocial_class_name = 'tag-archives';
                    $page_title           = esc_html__( "Tag Archives", 'statsocial' );
                    $page_title_c         = single_term_title( "", false );
                } elseif ( is_category() ) {

                    $statsocial_class_name = 'category-archives';
                    $page_title           = esc_html__( "Category Archives", 'statsocial' );
                    $page_title_c         = single_cat_title( '', false );
                } elseif ( is_archive() ) {

                    $statsocial_date_format = get_option( 'date_format' );

                    if ( is_day() ) {

                        $statsocial_class_name = 'dayly-archives';
                        $page_title           = esc_html__( 'Daily Archives', 'statsocial' );
                        $page_title_c         = get_the_date( $statsocial_date_format );
                    } elseif ( is_month() ) {

                        $statsocial_class_name = 'monthly-archives';
                        $page_title           = esc_html__( 'Monthly Archives', 'statsocial' );

                        if ( 'ja' == get_locale() ) {

                            $page_title_c = get_the_date( 'Y / F' );
                        } else {

                            $page_title_c = get_the_date( 'F Y' );
                        }
                    } elseif ( is_year() ) {

                        $statsocial_class_name = 'yearly-archives';
                        $page_title           = esc_html__( 'Yearly Archives', 'statsocial' );
                        $page_title_c         = get_the_date( 'Y' );
                    } elseif ( is_author() ) {

                        $statsocial_class_name = 'author-archives';
                        $page_title           = esc_html__( "Author Archives", 'statsocial' );
                        while ( have_posts() ) {
                            the_post();
                            $page_title_c = get_avatar( get_the_author_meta( 'user_email' ), 32 ) . ' ' . get_the_author();
                            break;
                        }
                        rewind_posts();
                    } elseif ( has_post_format( 'aside' ) ) {

                        $slug                 = 'aside';
                        $statsocial_class_name = 'post-format-' . $slug;
                        $page_title           = esc_html__( 'Post Format', 'statsocial' );
                        $page_title_c         = get_post_format_string( $slug );
                    } elseif ( has_post_format( 'chat' ) ) {

                        $slug                 = 'chat';
                        $statsocial_class_name = 'post-format-' . $slug;
                        $page_title           = esc_html__( 'Post Format', 'statsocial' );
                        $page_title_c         = get_post_format_string( $slug );
                    } elseif ( has_post_format( 'gallery' ) ) {

                        $slug                 = 'gallery';
                        $statsocial_class_name = 'post-format-' . $slug;
                        $page_title           = esc_html__( 'Post Format', 'statsocial' );
                        $page_title_c         = get_post_format_string( $slug );
                    } elseif ( has_post_format( 'link' ) ) {

                        $slug                 = 'link';
                        $statsocial_class_name = 'post-format-' . $slug;
                        $page_title           = esc_html__( 'Post Format', 'statsocial' );
                        $page_title_c         = get_post_format_string( $slug );
                    } elseif ( has_post_format( 'image' ) ) {

                        $slug                 = 'image';
                        $statsocial_class_name = 'post-format-' . $slug;
                        $page_title           = esc_html__( 'Post Format', 'statsocial' );
                        $page_title_c         = get_post_format_string( $slug );
                    } elseif ( has_post_format( 'quote' ) ) {

                        $slug                 = 'quote';
                        $statsocial_class_name = 'post-format-' . $slug;
                        $page_title           = esc_html__( 'Post Format', 'statsocial' );
                        $page_title_c         = get_post_format_string( $slug );
                    } elseif ( has_post_format( 'status' ) ) {

                        $slug                 = 'status';
                        $statsocial_class_name = 'post-format-' . $slug;
                        $page_title           = esc_html__( 'Post Format', 'statsocial' );
                        $page_title_c         = get_post_format_string( $slug );
                    } elseif ( has_post_format( 'video' ) ) {

                        $slug                 = 'video';
                        $statsocial_class_name = 'post-format-' . $slug;
                        $page_title           = esc_html__( 'Post Format', 'statsocial' );
                        $page_title_c         = get_post_format_string( $slug );
                    } elseif ( has_post_format( 'audio' ) ) {

                        $slug                 = 'audio';
                        $statsocial_class_name = 'post-format-' . $slug;
                        $page_title           = esc_html__( 'Post Format', 'statsocial' );
                        $page_title_c         = get_post_format_string( $slug );
                    } else {

                        $statsocial_class_name = 'blog-archives';
                        $page_title           = esc_html__( "Blog Archives", 'statsocial' );
                    }
                }

                if ( empty( $statsocial_class_name ) ) {

                    if ( is_front_page() ) {
                        $statsocial_class_name = 'front-page ';
                    }

                    $statsocial_class_name .= basename( $template, '.php' );
                    $statsocial_class_name = str_replace( array( '_', ), array( '-', ), $statsocial_class_name );
                }

                if ( !empty( $statsocial_class_name ) ) {

                    echo '<ul class="index ' . esc_attr( $statsocial_class_name ) . '">';
                } else {

                    echo '<ul class="index">';
                }

                if ( !empty( $page_title ) ) {

                    printf( '<li><strong class="f16" id="archives-title">%s <span>%s</span></strong></li>', apply_filters( 'statsocial_archive_name', $page_title ), apply_filters( 'statsocial_archive_value', $page_title_c ) );
                }
            }

        }
        /**
         * yui helper function
         *
         *
         *
         *
         *
         */
        if ( !function_exists( "statsocial_yui_class_modify" ) ) {

            function statsocial_yui_class_modify( $statsocial_inner_class = 'yui-ge' ) {

                global $yui_inner_layout;

                if ( isset( $yui_inner_layout ) ) {

                    $statsocial_inner_class = $yui_inner_layout;
                }
                return $statsocial_inner_class;
            }

        }
        /**
         * Template conditional function statsocial display 2column or not
         *
         *
         * @param string   css rule or text
         * @param bool      if value is true echo or false return
         * @return string  input strings text
         */
        if ( !function_exists( "is_2col_statsocial" ) ) {

            function is_2col_statsocial( $action = true, $echo = true ) {

                if ( 'hide' == statsocial_warehouse_clone( 'statsocial_show_right_sidebar' ) ) {

                    if ( true == $echo ) {

                        echo $action;
                    } else {

                        return $action;
                    }
                } else {

                    return false;
                }
            }

        }
        /**
         * yui layout curc
         *
         *
         *
         * @return content width
         */
        if ( !function_exists( "statsocial_main_width" ) ) {

            function statsocial_main_width() {

                return statsocial_content_width_clone();
            }

        }
        /**
         * content width curc
         *
         *
         *
         *
         * @return main column width
         */
        if ( !function_exists( "statsocial_content_width" ) ) {

            function statsocial_content_width() {

                return statsocial_content_width_clone();
            }

        }
        /**
         * fallback stylesheet
         *
         *
         *
         *
         */
        if ( !function_exists( "statsocial_w3standard" ) ) {

            function statsocial_w3standard() {

                $font_color = statsocial_colors( $num        = 5, $select     = 'color', $color1     = null );
                $style      = <<<DOC
legend,
a:link,a:active,a:visited,a:hover,
.lsidebar,
#sidebar,
.rsidebar,
#doc,#doc2,#doc3,#doc4,
#hd,
h1,             
#yui-main,
.entry ol ol ,.entry ul,
.entry ul * {
	%c5%
}
.footer-widget h2,.rsidebar h2,.lsidebar h2 {
	%c5%
	%h2_w3standard_background%
	%h_position_rsidebar_h2%
}
body {
    margin:0! important;padding:0;
    background-repeat:repeat-x;
}
#yui-main{
    color:%statsocial_header_color%;
}
#hd{
    background-image:url( %statsocial_hd_images_path%%statsocial_header_image% );
}
.hfeed{
    background:#fff;
}
#ft {
    background:url( %statsocial_images_path%%statsocial_footer_image% ) repeat-x;
    color:%statsocial_footer_color%;
}
.footer-widget h2,
.rsidebar h2,
.lsidebar h2 {
/*%h2_w3standard_background%*/
	%h_position_rsidebar_h2%
}
.rsidebar ul li ul li,
.lsidebar ul li ul li{
list-style-type:square;
list-style-position:inside;
}
.ie8 .lsidebar .widget ul li a {
    list-style:none;
}
.home .sticky {
	%c5%
border-top:solid 6px %c_border%;
border-bottom:solid 2px %c_border%;
}
.entry-meta{
	%c4%
border-top:solid 1px %c_border%;
border-bottom:solid 1px %c_border%;
}
textarea,
input[type="password"],
input[type="text"],
input[type="submit"],
input[type="reset"],
input[type="file"]{
    %c4%
}
input[type="checkbox"],
input[type="radio"],
select{
    %c4%
}
.social textarea#comment,
.social input[type="text"] {
    outline:none;
    %c3%
}
.social textarea#comment:focus,
.social input:focus{
    %c4%
}
.entry-content ul li{
    list-style-type:square;
}
.entry-content input[type="submit"],
.entry-content input[type="reset"],
.entry-content input[type="file"]{
    %c4%
}
.entry-content input[type="submit"],
.entry-content input[type="radio"]{
    %c3%
}
.entry-content select{
    %c4%
}
.entry-content blockquote{
    %c4%
    border-left:solid 6px %c_border%;
}
cite{
    %c4%
}
cite a:link,
cite a:active,
cite a:visited,
cite a:hover{
    $font_color
}
.entry-content fieldset {
    border:solid 1px %c_border%;
}
.entry-content legend{
    %c5%
}
.entry-content td{
    %c4%
    border:solid 1px %c_border%;
}
.entry-content th{
    %c3%
    border:solid 1px %c_border%;
}
hr{
	border-top:1px dashed %c_border%;
}
/*--------------------------------*/
#access{
    /*%c3%*/
}
#access a {
}
#access ul ul a {
    %c3%
}
#access li:active > a,
#access ul ul :active > a {
    top:0;
    %c2%
    color:%custom_color%
}
#access ul li.current_page_item > a,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-item > a,
#access ul li.current-menu-parent > a {
    %c3%
}
.ie6 #access ul li.current_page_item a,
.ie6 #access ul li.current-menu-ancestor a,
.ie6 #access ul li.current-menu-item a,
.ie6 #access ul li.current-menu-parent a,
.ie6 #access ul li a:hover {
    %c2%
}
table,
table td,
#access > li{
    border:1px solid #ccc;
}
tfoot td{
    border:none;
}
.lsidebar  li,
.rsidebar li{
    border:none! important;
}
td.month-date,td.month-name,td.time{
    %c4%
}
.datetable td li{
}
address{margin:10px auto;}
.wp-caption {
}
li.byuser,
li.bypostauthor {
	%c5%
}
.comment-meta a,
cite.fn{
}
.datetable td li{
}
.fail-search,
#not-found {
	%c3%
border:3px double;
}
.rd-page-navigation li{
border-left:solid 1px %c_border%;
	%c5%
}
.rd-page-navigation a{
	%c5%
}
.rd-page-navigation .current_page_item{
	%c4%
}
.statsocial-tab-content,
.statsocial-tab-list li{
	border:1px solid %c_border%;
}
/*comment bubble*/
a.statsocial-comment-link {
}
.statsocial-comment-link em {
	%c4%
	position: relative;
}
.statsocial-comment-link .point {
	border-left: 0.45em solid %c_border%;
	border-bottom: 0.45em solid #FFF; /* IE fix */
	border-bottom: 0.45em solid %c_border%;
	overflow: hidden; /* IE fix */
}
a.statsocial-comment-link:hover {
}
a.statsocial-comment-link:hover em {
	%c5%
}
a.statsocial-comment-link:hover .point {
border-left:1px solid %c_border%;
}
DOC;
                return $style;
            }

        }
        /**
         * plugin API
         *
         *
         *
         *
         *
         */
        if ( !function_exists( "plugin_is_active" ) ) {

            function plugin_is_active( $plugin_path ) {

                $return_var = in_array( $plugin_path, get_option( 'active_plugins' ) );
                return $return_var;
            }

            if ( plugin_is_active( 'tmn-quickpost/tmn-quickpost.php' ) ) {

                global $base_info;

                foreach ( $base_info['root'] as $key => $val ) {

                    $wp_cockneyreplace['%' . $key . '%'] = $val;
                }

                function statsocial_import_post_meta() {

                    global $post, $base_info;
                    $r = get_post_meta( $post->ID, 'template', true );

                    foreach ( $base_info['root'] as $key => $val ) {

                        $r = str_replace( '%' . $key . '%', $val, $r );
                    }

                    if ( class_exists( 'trans' ) ) {

                        $n = new trans( $r );
                        return $n->text2html();
                    } else {

                        return $r;
                    }
                }

            }
        }
        /** Custom Image Header for statsocial theme
         *
         *
         *
         *
         *
         */
        if ( !function_exists( 'statsocial_header_style' ) ) {

            function statsocial_header_style() {
                ?><?php
        }

    }
    /** Custom Image Header for statsocial theme
     *
     *
     *
     *
     *
     */
    if ( !function_exists( 'statsocial_admin_header_style' ) ) {

        function statsocial_admin_header_style() {

            global $statsocial_page_width;
            $statsocial_options   = get_option( "statsocial_theme_settings" );
            $css                 = $statsocial_options['_statsocial_indv_css'];
            $css                 = statsocial_color_type_custom( $css );
            $background          = get_background_image();
            $color               = get_background_color();
            $text_color          = get_header_textcolor();
            $page_width          = statsocial_warehouse_clone( 'statsocial_page_width' );
            $custom_header_width = $statsocial_page_width;

            switch ( $page_width ) {
                case ( "doc" ):
                    $custom_header_width = '750px';
                    break;

                case ( "doc2" ):
                    $custom_header_width = '950px';
                    break;

                case ( "doc3" ):
                    //$custom_header_width = '974px';
                    $custom_header_width = '100%';
                    break;

                case ( "doc4" ):
                    //$custom_header_width = '100%';
                    $custom_header_width = '974px';
                    break;
            }

            if ( !empty( $background ) || !empty( $color ) ) {

                $css = preg_replace( "|body[^{]*{[^}]+}|", "", $css );
            }
            $css_result = "";
            $csses      = explode( "\n", $css );

            foreach ( $csses as $k => $v ) {

                if ( preg_match( '!^.+(,|{)!si', $v, $regs ) ) {

                    $css_result .= '#headimg ' . $regs[0] . "\n";
                } else {

                    $css_result .= $v . "\n";
                }
            }
            $css_result = str_replace( array( '#headimg body', 'a:hover' ), array( '#headimg', 'a' ), $css_result );
            ?>
            <style type="text/css">
                <!--
                a:hover{color:none;}
                #headimg{
                    width:<?php echo $custom_header_width; ?>! important;
                    position:relative;
                    min-height:278px;
                    background-position:0 80px;
                }
                #headimg #hd {
                    overflow:hidden;
                    padding:.5em 1em;
                    min-height:5em;
                }
                #headimg #hd h1,
                #headimg #hd h1 a,
                #headimg #hd .h1 a,
                #headimg #hd #site-title{
                    font-size:174%;
                    letter-spacing: 0.05em;
                    background:none;
                }
                #headimg #hd #site-title{
                    display:inline-block! important;
                    max-width:74%;
                }
                #headimg #hd #site-title a{
                    color:#<?php echo $text_color; ?>! important;
                }
                #headimg #top{
                    padding-bottom:5px;
                    position:relative;
                }
                #headimg #site-title{
                    display:inline-block! important;
                    max-width:74%;
                    clear:both;
                    font-weight:bold;
                    overflow:hidden;
                    margin:.5em 0;
                    font-family:"Times New Roman", Times, serif;
                }
                #headimg #site-description {
                    position:absolute;
                    top:10px;
                    right:10px;
                }
                #headimg #access {
                    display: block;
                    float: left;
                    margin: 0 auto;
                    width:99%;
                    margin-left:0.5%;
                    margin-top:5px;
                }
                #headimg #access .menu,
                #headimg #access div.menu ul{
                    font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
                }
                #headimg #headimg .ie8 #access {
                    margin-left:0;
                    width:100%;
                    margin-top:0;
                }
                #headimg #header-image{
                    position:relative;
                    min-height:198px;
                }
                #headimg #header-image p{
                    position:relative;
                    top:35%;
                    text-align:center;
                    font-size:200%;
                    position:relative;
                    top:35%;
                    text-align:center;
                    font-size:200%;
                    text-shadow: 0 0 2px #fff, 0 0 2px #fff, 0 0 2px #fff, 0 0 2px #fff;
                    /*filter:progid:DXImageTransform.Microsoft.Glow(  color=white,Strength=2 );*/
                }
                #headimg #site-description {
                    text-align:right;
                }
                #headimg #site-description {
                    max-width:24%;
                }
                #headimg #access ul ul {
                    box-shadow: 0px 3px 3px rgba( 0,0,0,0.2 );
                    -moz-box-shadow: 0px 3px 3px rgba( 0,0,0,0.2 );
                    -webkit-box-shadow: 0px 3px 3px rgba( 0,0,0,0.2 );
                }
                #headimg .wp-caption {
                    /* optional rounded corners for browsers that support it */
                    -moz-border-radius: 3px;
                    -khtml-border-radius: 3px;
                    -webkit-border-radius: 3px;
                    border-radius: 3px;
                }
                #headimg .wp-caption {
                    /* optional rounded corners for browsers that support it */
                    -moz-border-radius: 3px;
                    -khtml-border-radius: 3px;
                    -webkit-border-radius: 3px;
                    border-radius: 3px;
                }
                #headimg .shadow{
                    box-shadow: 7px 7px 8px #cccccc;
                    -webkit-box-shadow: 7px 7px 8px #cccccc;
                    -moz-box-shadow: 7px 7px 8px #cccccc;
                    /*filter: progid:DXImageTransform.Microsoft.dropShadow(  color=#cccccc, offX=7, offY=7, positive=true  );zoom:1;*/
                }
                #headimg #access{
                    -webkit-text-size-adjust: 120%;
                }
        <?php echo $css_result; ?>
                a, a:hover{
                    background:none;
                }
                #wp-admin-bar-comments a,
                #wp-admin-bar-view-site a{
                    color:#ddd! important;
                }
                span#site-title,
                #message a{
                    color: #21759B! important;
                }-->
            </style>
        <?php
    }

}
/**
 *
 *
 *
 *
 */
if ( !function_exists( 'statsocial_admin_header_image' ) ) {

    function statsocial_admin_header_image() {

        global $statsocial_current_theme_name;
        $statsocial_header_image = get_header_image();
        $statsocial_header_style = 'style="color:#' . get_theme_mod( 'header_textcolor' ) . '"';
        $html                   = '<div id="%1$s"><div id="%2$s">';
        printf( $html, 'headimg', 'top' );
        $uploads                = wp_upload_dir();
        $header_image_uri       = $uploads['url'] . '/' . statsocial_warehouse_clone( 'statsocial_header_image' );
        $html                   = '<div id="%1$s" style="%2$s">';
        $exception_page_width   = statsocial_warehouse_clone( 'statsocial_page_width' );

        if ( 'doc3' == $exception_page_width ) {

            /* doc3 fluid layout , image displayed shrink , expand */
            $add_fluid_style                  = "width:480px;";
            $add_fluid_style_description_html = '<div style="padding:1em;position:absolute;left:520px;top:20px;background:#000;color:#fff;border:2px dashed #777"><p>' . esc_html__( 'Current theme is fluid settings', 'statsocial' ) . '</p><p>' . esc_html__( 'image size will be shrink to fit page', 'statsocial' ) . '</p>';
            $add_fluid_style_description_html .= '<li><a href="' . admin_url() . 'themes.php?page=statsocial_settings#statsocial-page-width" style="color:#00CCCC;">' . esc_html__( 'Theme Settings', 'statsocial' ) . '</a></li>';
            $add_fluid_style_description_html .= '</div>';
        } else {

            $add_fluid_style                  = "";
            $add_fluid_style_description_html = '';
        }
        printf( $html, 'hd', statsocial_upload_image_parser( $header_image_uri, 'inline', '#hd' ) . $add_fluid_style );
        /** Site description display position
         *
         *
         * Site description diaplay at image when if header text Display Text value is yes.
         * Site description diaplay at header bar when if header text Display Text value is no.
         *
         *
         */
        if ( 'blank' == get_theme_mod( 'header_textcolor' ) || '' == get_theme_mod( 'header_textcolor' ) ) {

            $statsocial_show_hide = '';
            $style               = ' style="display:none;"';
        } elseif ( preg_match( "!([0-9a-f]{6}|[0-9a-f]{3})!si", get_header_textcolor() ) ) {

            $style               = ' style="color:#' . get_header_textcolor() . ';"';
            $statsocial_show_hide = ' style="display:none;"';
        } else {

            $style               = '';
            $statsocial_show_hide = ' style="display:none;"';
        }
        /**
         * Conditional Switch html headding element
         *
         *
         *
         *
         *
         */
        if ( is_home() || is_front_page() ) {

            $heading_elememt = 'h1';
        } else {

            $heading_elememt = 'div';
        }
        $title_format                    = '<%s class="h1" id="site-title"><span><a href="%s" title="%s" rel="%s">%s</a></span></%s>';
        printf( $title_format, $heading_elememt, home_url(), esc_attr( get_bloginfo( 'name', 'display' ) ), "home", get_bloginfo( 'name', 'display' ), $heading_elememt );
        /**
         * Site description diaplay at header bar when if header text Display Text value is no.
         *
         *
         *
         *
         */
        $statsocial_site_desctiption_html = '<div id="site-description" %s>%s</div></div>';
        printf( $statsocial_site_desctiption_html, $statsocial_show_hide, get_bloginfo( 'description' ) );
        /**
         * header image
         *
         *
         *
         *
         *
         */
        echo statsocial_header_image();
        echo $add_fluid_style_description_html;
    }

}
/**
 * Empty title fallback
 *
 *
 */
if ( !function_exists( 'statsocial_fallback_title' ) ) {

    function statsocial_fallback_title( $title, $id = 0 ) {

        global $post, $statsocial_link_unique_text;
        $format_label = '';

        if ( 0 == $id && is_object( $post ) ) {

            $id = $post->ID;
        }

        if ( !is_admin() ) {

            $format = get_post_format( $id );

            if ( false === $format ) {

                $image_uri    = get_template_directory_uri() . '/images/link.png';
                $class        = 'icon-link-no-title';
                $format_label = 'Article';
            } else {

                $image_uri = get_template_directory_uri() . '/images/post-format-' . $format . '.png';
                $class     = 'icon-post-format-notitle icon-post-format-' . $format;

                if ( 'link' == $format ) {

                    $add_label = ' to entry';
                } else {

                    $add_label = '';
                }
                $format_label = 'Post Format ' . esc_attr( $format ) . $add_label;
            }

            if ( empty( $title ) ) {

                $html = '<span class="' . esc_attr( $class ) . '" title="' . $format_label . '" ></span>';
                return $html;
            }
        }

        if ( isset( $post->ID ) && $statsocial_link_unique_text == true ) {

            $title = statsocial_link_unique( $format_label, $post->ID ) . $title;
        }

        return apply_filters( 'statsocial_fallback_title', $title );
    }

}
/**
 *
 *
 *
 * @since 1.139
 */
///////////////////////////////////test

if ( !function_exists( 'statsocial_detect_header_image_size' ) ) {

    function statsocial_detect_header_image_size( $xy = 'width' ) {

        global $statsocial_custom_header_args;
        $all_header_images     = array();
        $header_image          = get_custom_header();
        $header_image_uri      = $header_image->url;
        $header_image_basename = basename( $header_image_uri );

        if ( $statsocial_custom_header_args["default-image"] == $header_image_uri ) {

            if ( 'width' == $xy ) {

                return $statsocial_custom_header_args["width"];
            } elseif ( 'height' == $xy ) {
                return $statsocial_custom_header_args["height"];
            }
        }
        $all_header_images = get_uploaded_header_images();

        if ( 'width' == $xy ) {

            if ( isset( $all_header_images[$header_image_basename]['width'] ) ) {

                return $all_header_images[$header_image_basename]['width'];
            } else {

                return $header_image->width;
            }
        } elseif ( 'height' == $xy ) {

            if ( isset( $all_header_images[$header_image_basename]['height'] ) ) {

                return $all_header_images[$header_image_basename]['height'];
            } else {

                return $header_image->height;
            }
        }
        return false;
    }

}
/**
 * Template function print header image
 *
 * This function has filter hook name statsocial_header_image
 * @param array(  'img'=> 'image uri' , 'height' => 'image height' , 'color' => 'text color', 'style' => '( default  ) background-size:cover;' , 'description' => 'replace text from bloginfo(  description  ) to your text','description_style' => 'Your description style rule'  )
 * @return string htmlblock <div id="['header-image']" style="background-image:url( [img] );height:[height];color:#[color]][style]"><p [description_style]>[WordPress site description]</p></div>
 */
if ( !function_exists( 'statsocial_header_image' ) ) {

    function statsocial_header_image( $type = 'default', $args = array() ) {

        global $statsocial_page_width;
        $statsocial_document_width      = $statsocial_page_width;
        $statsocial_header_image        = get_custom_header();
        $statsocial_header_image_uri    = $statsocial_header_image->url;
        $statsocial_header_image_width  = statsocial_detect_header_image_size( 'width' );
        $statsocial_header_image_height = statsocial_detect_header_image_size( 'height' );
        $statsocial_restore_check       = get_theme_mod( 'header_image', get_theme_support( 'custom-header', 'default-image' ) );

        if ( 'remove-header' == $statsocial_restore_check ) {

            return;
        }

        if ( empty( $statsocial_header_image_uri ) ) {

            $statsocial_header_image_uri = $statsocial_restore_check;
        }

        if ( $statsocial_header_image_width > 0 && $statsocial_header_image_height > 0 ) {

            $ratio = $statsocial_header_image_height / $statsocial_header_image_width;
        } else {

            $ratio = 0;
        }
        $statsocial_width = statsocial_warehouse_clone( 'statsocial_page_width' );
        switch ( true ) {
            case 'doc' == $statsocial_width:
                $statsocial_document_width = 750;
                break;

            case 'doc2' == $statsocial_width:
                $statsocial_document_width = 950;
                break;

            case 'doc4' == $statsocial_width:
                $statsocial_document_width = 974;
                break;

            case is_numeric( $statsocial_width ):
                $statsocial_document_width = $statsocial_page_width;
                break;

            case 'doc3' == $statsocial_width:
                $statsocial_document_width = 950; //this value is fake following javascript
                break;
        }

        if ( $statsocial_header_image_width >= $statsocial_document_width ) {

            $height_current = round( $statsocial_document_width * $ratio ) . 'px';
            $block_style    = 'background-size:cover;';
        } else {

            $height_current = round( $statsocial_header_image_height ) . 'px';
            $block_style    = 'background-repeat:no-repeat;background-position:center;background-color:#000;background-size:auto;  background-origin:content-box;';
        }

        if ( 'doc3' == $statsocial_width ) {

            $block_style = str_replace( 'background-size:auto', 'background-size:cover', $block_style );
        }
        //w3standard can not use CSS3

        if ( 'w3standard' == statsocial_warehouse( 'statsocial_style_type' ) ) {

            $block_style = 'background-repeat:no-repeat;background-position:center;background-color:#000;';
        }

        if ( '' == get_header_image() ) {

            $height            = 0;
            $description_style = ' style="display:none;"';
        }
        $defaults = array( 'img' => $statsocial_header_image_uri, 'height' => $height_current, 'color' => get_theme_mod( 'header_textcolor' ), 'style' => $block_style, 'text' => get_bloginfo( 'description' ), 'text_attr' => '' );
        $args     = wp_parse_args( $args, $defaults );
        extract( $args, EXTR_SKIP );

        if ( 'blank' == get_theme_mod( 'header_textcolor' ) ) {

            $text_attr = ' style="display:none;"';
        } elseif ( preg_match( "!([0-9a-f]{6}|[0-9a-f]{3})!si", get_theme_mod( 'header_textcolor' ) ) ) {

            $add_class = '';
            $add_style = '';

            if ( preg_match( '!style!', $text_attr ) ) {

                $add_style = str_replace( array( 'style', "'", '"', '=' ), '', $text_attr );
            } else {

                $add_class = $text_attr;
            }
            $text_attr = ' style="color:#' . esc_attr( get_theme_mod( 'header_textcolor' ) ) . ';' . esc_attr( $add_style ) . '" ' . esc_html( $add_class );
            $text_attr = apply_filters( 'statsocial_header_image_description_attr', $text_attr );
        }

        if ( 'doc3' == statsocial_warehouse_clone( "statsocial_page_width" ) ) {

            $width = 'width:100%';
        } else {

            $width = 'width:' . $statsocial_document_width . 'px';
        }

        if ( $type == 'default' || !isset( $type ) ) {

            $html = '<div id="%1$s" style="background-image:url( %2$s );%8$s;height:%3$s;color:#%4$s;%5$s"><p %6$s>%7$s</p></div>';
            $html = sprintf( $html, 'header-image', esc_url( $img ), esc_html( $height ), esc_html( $color ), esc_html( $style ), htmlspecialchars( $text_attr, ENT_NOQUOTES ), esc_html( $text ), $width );

            if ( $color == 'blank' ) {

                $html = str_replace( 'color:#blank;', '', $html );
            }
            return apply_filters( "statsocial_header_image", $html );
        } elseif ( 'css' == $type ) {

            $css       = '#%1$s{%2$s%8$s;height:%3$s;color:#%4$s;%5$s}' . "\n" . '#%1$s p {%6$s}';
            $text_attr = str_replace( array( 'style', '=', '"', "'" ), '', $text_attr );
            $css       = sprintf( $css, 'header-image', apply_filters( 'statsocial_header_image_background_image', 'background-image:url( ' . esc_url( $img ) . ' );' ), esc_html( $height ), esc_html( $color ), apply_filters( 'statsocial_header_image_background_style', esc_html( $style ) ), // css needs > but this style is inline
                    htmlspecialchars( $text_attr, ENT_NOQUOTES ), // css needs > but this style is inline
                    esc_html( $text ), $width );

            if ( $color == 'blank' ) {

                $css = str_replace( 'color:#blank;', '', $css );
            }
            return apply_filters( "statsocial_header_image_css", $css );
        } elseif ( 'elements' == $type ) {

            $elements = '<div id="%1$s">' . apply_filters( 'statsocial_header_image_contents', '' ) . '<p %3$s>%2$s</p></div>';
            $elements = sprintf( $elements, 'header-image', esc_html( $text ), $text_attr );
            return apply_filters( "statsocial_header_image_elements", $elements );
        } elseif ( 'home_url' == $type ) {

            $elements = '<a href="%3$s"><div id="%1$s">' . apply_filters( 'statsocial_header_image_contents', '' ) . '<p %4$s>%2$s</p></div></a>';
            $elements = sprintf( $elements, 'header-image', esc_html( $text ), esc_url( home_url() ), $text_attr );
            return apply_filters( "statsocial_header_image_home_url", $elements );
        }
    }

}
/**
 * Print site description html
 *
 * This function has filter hook name statsocial_site_description
 *
 * @param array(  "text" => 'Some text' , "switch" => ' style="display:none;"'  )
 * @return string htmlblock  <div id="site-description" [input switch]>[input text]</div>
 *
 */
if ( !function_exists( 'statsocial_site_description' ) ) {

    function statsocial_site_description( $args = array() ) {

        if ( 'blank' == get_theme_mod( 'header_textcolor' ) ) {

            $statsocial_show_hide = '';
        } elseif ( preg_match( "!([0-9a-f]{6}|[0-9a-f]{3})!si", get_header_textcolor() ) ) {

            $statsocial_show_hide = ' style="display:none;"';
        } else {

            $statsocial_show_hide = ' style="display:none;"';
        }
        $defaults = array( 'text' => get_bloginfo( 'description' ), 'switch' => $statsocial_show_hide );
        $args     = wp_parse_args( $args, $defaults );
        extract( $args, EXTR_SKIP );
        $html     = '<div id="site-description" %1$s>%2$s</div>';
        $html     = sprintf( $html, $switch, $text );
        return apply_filters( "statsocial_site_description", $html );
    }

}
/**
 * Print the site title
 *
 * This function has filter hook name statsocial_site_title(  #site-title  )
 *
 *
 * @param $text string  append to title strings
 * @return htmlblock <[h1|div] class="h1" id="site-title"><span><a href="[home url(   )]" title="[blog_info( name )]" rel="['home']" [style get_header_textcolor(   )]>[bloginfo( name )]</a></span></[h1|div]>
 */
if ( !function_exists( 'statsocial_site_title' ) ) {

    function statsocial_site_title( $text = "" ) {

        global $statsocial_document_type;

        if ( 'xhtml' == $statsocial_document_type ) {

            if ( is_home() || is_front_page() ) {

                $heading_elememt = 'h1';
            } else {

                $heading_elememt = 'div';
            }
        } else {

            $heading_elememt = 'h1';
        }
        $header_text_color = get_theme_mod( 'header_textcolor' );

        if ( 'blank' == $header_text_color || '' == $header_text_color ) {

            $hd_style = '';
        } else {

            $hd_style = ' style="color:#' . $header_text_color . ';"';
        }
        $title_format = '<%1$s class="h1" id="site-title"><a href="%2$s" title="%3$s" rel="%4$s"><span>%5$s</span></a></%1$s>';
        $html         = sprintf( $title_format, $heading_elememt, home_url(), esc_attr( 'site title ' . get_bloginfo( 'name', 'display' ) ), "home", get_bloginfo( 'name', 'display' ) . esc_html( $text ) );
        return apply_filters( "statsocial_site_title", $html );
    }

}
/**
 * filter function for wp_title hook
 * element title
 */
if ( !function_exists( 'statsocial_filter_title' ) ) {

    function statsocial_filter_title( $title, $sep = true, $seplocation = 'right' ) {

        global $page, $paged;
        $page_info        = '';
        $add_title        = array();
        $site_description = get_bloginfo( 'description', 'display' );

        if ( !empty( $title ) ) {

            $add_title[] = str_replace( $sep, '', $title );
        }
        $add_title[] = get_bloginfo( 'name' );

        if ( !empty( $site_description ) && ( is_home() || is_front_page() ) ) {

            $add_title[] = $site_description;
        }
        // Add a page number

        if ( $paged > 1 || $page > 1 ) {

            $page_info = sprintf( esc_html__( ' Page %s', 'statsocial' ), max( $paged, $page ) );
        }

        if ( 'right' == $seplocation ) {

            $add_title = array_reverse( $add_title );
            $title     = implode( " $sep ", $add_title ) . $page_info;
        } else {

            $title = implode( " $sep ", $add_title ) . $page_info;
        }
        return $title;
    }

}
/**
 *
 *
 *
 *
 *
 */
if ( !function_exists( "statsocial_show_one_column" ) ) {

    function statsocial_show_one_column() {

        global $post;

        if ( isset( $post ) ) {

            $statsocial_content_check = get_post( $post->ID );
            $statsocial_content_check = $statsocial_content_check->post_content;

            if ( preg_match( "!\[statsocial[^\]]+(col)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si", $statsocial_content_check, $regs ) ) {

                return $regs[3];
            } else {

                return false;
            }
        } elseif ( 'hide' == statsocial_warehouse_clone( 'statsocial_show_right_sidebar' ) ) {

            return 2;
        } elseif ( 'show' == statsocial_warehouse_clone( 'statsocial_show_right_sidebar' ) ) {

            return 3;
        }
    }

}
/**
 *
 *
 *
 *
 *
 */
if ( !function_exists( "statsocial_color_type_custom" ) ) {

    function statsocial_color_type_custom( $css ) {

        global $post;

        if ( isset( $post ) && is_singular() ) {

            $statsocial_content_check = get_post( $post->ID );
            $statsocial_content_check = $statsocial_content_check->post_content;

            if ( preg_match( "!\[statsocial[^\]]+(color_type)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si", $statsocial_content_check, $regs ) ) {

                $color_type = trim( $regs[3] );
                return statsocial_design_output( $color_type ) . statsocial_color_base();
            } else {

                return $css;
            }
        } else {

            return $css;
        }
    }

}
/**
 *
 *
 *
 *
 *
 */
if ( !function_exists( "statsocial_delete_post_link" ) ) {

    function statsocial_delete_post_link( $link_text = null, $before = '', $after = '', $id = 0, $echo = true ) {

        global $post;

        if ( statsocial_SHOW_DELETE_POST_LINK !== true ) {

            return;
        }

        if ( empty( $link_text ) ) {

            $link_text = esc_html__( 'Trash', 'statsocial' );
        }

        if ( current_user_can( 'edit_post', $post->ID ) && $url = get_delete_post_link() ) {

            $html = $before . '<a href="%1$s">%2$s</a>' . $after;
            $html = sprintf( $html, $url, $link_text );

            if ( $echo !== true ) {

                return $html;
            } else {

                echo $html;
            }
        }
    }

}
/**
 * comment reply
 *
 *
 *
 * @since 0.956
 */
if ( !function_exists( "statsocial_enqueue_comment_reply" ) ) {

    function statsocial_enqueue_comment_reply() {

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

            wp_enqueue_script( 'comment-reply' );
        }
    }

}
add_filter( 'the_content', 'statsocial_fallback_human_interface' );
add_filter( 'statsocial_posted_in', 'statsocial_fallback_human_interface' );
/**
 *
 *
 *
 *
 * @since 0.958
 */
if ( !function_exists( "statsocial_fallback_human_interface" ) ) {

    function statsocial_fallback_human_interface( $content ) {

        if ( ( is_home() || is_front_page() ) && true == small_screen_check() ) {

            return;
        } else {

            return $content;
        }
    }

}
/**
 *
 *
 *
 *
 * @since 0.958
 */
if ( !function_exists( "small_screen_check" ) ) {

    function small_screen_check() {

        global $statsocial_fluid_minimum_width, $statsocial_fallback_human_interface_show;
        $size = '';

        if ( isset( $_SERVER['HTTP_UA_PIXELS'] ) && !empty( $_SERVER['HTTP_UA_PIXELS'] ) ) {

            $size = $_SERVER['HTTP_UA_PIXELS'];
        }

        if ( isset( $_SERVER['HTTP_X_UP_DEVCAP_SCREENPIXELS'] ) && !empty( $_SERVER['HTTP_X_UP_DEVCAP_SCREENPIXELS'] ) ) {

            $size = $_SERVER['HTTP_X_UP_DEVCAP_SCREENPIXELS'];
        }

        if ( isset( $_SERVER['HTTP_X_JPHONE_DISPLAY'] ) && !empty( $_SERVER['HTTP_X_JPHONE_DISPLAY'] ) ) {

            $size = $_SERVER['HTTP_X_JPHONE_DISPLAY'];
        }
        $size = preg_split( '[x,*]', $size );

        if ( true == $statsocial_fallback_human_interface_show ) {

            return true;
        }

        if ( isset( $size[0] ) && is_numeric( $size[0] ) ) {

            if ( $size[0] < $statsocial_fluid_minimum_width ) {

                return true;
            } else {

                return false;
            }
        }
        return false;
    }

}
/**
 *
 *
 *
 *
 * @since 0.958
 */
/*
  if (  !  function_exists(  "fallback_user_interface_view"  )  ) {

  function fallback_user_interface_view(   ) {

  global $statsocial_current_theme_name, $statsocial_current_data_version;

  wp_deregister_style(  'style'  );

  wp_deregister_style(  'statsocial_reset_fonts_grids'  );

  wp_deregister_style(  'statsocial_grids'  );

  wp_deregister_style(  'statsocial_fonts'  );

  wp_deregister_style(  'statsocial_css3'  );

  wp_deregister_style(  'child'  );

  $current_theme      = $statsocial_current_theme_name;

  $fallback_style     = get_template_directory_uri(   ).'/fallback.css';

  wp_register_style(  'fallback_style', $fallback_style,array(   ), $statsocial_current_data_version,'all'  );

  wp_enqueue_style(  'fallback_style'  );

  add_filter(  'statsocial_indv_css', '__return_false'  );

  add_filter(  'statsocial_is_fluid', '__return_false'  );

  add_filter(  'statsocial_is_fixed' , '__return_false'  );

  add_filter(  'statsocial_embed_meta_css', '__return_false'  );

  }


  if ( small_screen_check(   ) == true  ) {

  add_action(  'wp_print_styles', 'fallback_user_interface_view', 99  );

  add_action(  'wp_head', 'statsocial_mobile_meta'  );

  }

  } */
/**
 *
 *
 *
 *
 *
 */
if ( "doc3" == statsocial_warehouse_clone( 'statsocial_page_width' ) ) {

    add_action( 'wp_footer', 'statsocial_small_device_helper' );
} else {

    add_action( 'wp_footer', 'statsocial_helper_for_no_fluid_page_width' );
}
/**
 *
 *
 *
 *
 */
if ( !function_exists( 'statsocial_helper_for_no_fluid_page_width' ) ) {

    function statsocial_helper_for_no_fluid_page_width() {

        global $statsocial_browser_detection, $post;

        if ( $statsocial_browser_detection !== true ) {
            ?><script type="text/javascript">
                    (function() {

                        jQuery(function() {
            <?php
            if ( is_single() || is_page() ) {

                $color_type              = '';
                $statsocial_content_check = get_post( $post->ID );
                $statsocial_content_check = $statsocial_content_check->post_content;

                if ( preg_match( "!\[statsocial[^\]]+(color_type)=(\"|')*?([^\"' ]+)(\"|' )*?[^\]]*\]!si", $statsocial_content_check, $regs ) ) {

                    $color_type = "rd-type-" . trim( $regs[3] );
                }

                if ( preg_match( "!\[statsocial[^\]]+(col)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si", $statsocial_content_check, $regs ) ) {

                    $color_type .= ' ';
                    $color_type .= "rd-col-" . $regs[3];
                }
                ?>
                                jQuery('body').addClass('<?php echo $color_type; ?>');
                <?php
            } else {

                $statsocial_options = get_option( "statsocial_theme_settings" );

                if ( isset( $statsocial_options["statsocial_style_type"] ) && !empty( $statsocial_options["statsocial_style_type"] ) ) {
                    ?>
                                    jQuery('body').addClass('<?php echo "rd-type-" . $statsocial_options["statsocial_style_type"]; ?>');
                    <?php
                }
            }
            ?>
                            if (navigator.userLanguage) {

                                baseLang = navigator.userLanguage.substring(0, 2).toLowerCase();
                            } else {

                                baseLang = navigator.language.substring(0, 2).toLowerCase();
                            }

                            jQuery('body').addClass('accept-lang-' + baseLang);


                            var userAgent = window.navigator.userAgent.toLowerCase();

                            if (userAgent.match(/msie/i)) {

                                var ie_num = userAgent.match(/MSIE (\d+\.\d+);/i);
                                var ieversion = parseInt(ie_num[1], 10);
                                jQuery('body').addClass('ie' + ieversion);
                            } else if (userAgent.indexOf('opera') != -1) {

                                jQuery('body').addClass('opera');
                            } else if (userAgent.indexOf('chrome') != -1) {

                                jQuery('body').addClass('chrome');
                            } else if (userAgent.indexOf('safari') != -1) {

                                jQuery('body').addClass('safari');
                            } else if (userAgent.indexOf('gecko') != -1) {

                                var match = userAgent.match(/(trident)(?:.*rv:([\w.]+))?/);
                                var version = parseInt(match[2], 10);

                                if (version == 11) {
                                    jQuery('body').addClass('ie11');
                                } else {
                                    jQuery('body').addClass('gecko');
                                }
                            } else if (userAgent.indexOf('iphone') != -1) {

                                jQuery('body').addClass('iphone');
                            } else if (userAgent.indexOf('Netscape') != -1) {

                                jQuery('body').addClass('netscape');
                            } else {

                                jQuery('body').addClass('unknown');
                            }

                        });
                    })(jQuery);
                </script>
            <?php
        } //end if (  true !== $statsocial_browser_detection  )
    }

}
/**
 *
 *
 *
 *
 */
if ( !function_exists( 'statsocial_small_device_helper' ) ) {

    function statsocial_small_device_helper() {

        global $is_IE, $statsocial_fluid_maximum_width, $statsocial_browser_detection, $post, $template, $statsocial_link_unique_text;

        $statsocial_header_image     = get_custom_header();
        $statsocial_header_image_uri = $statsocial_header_image->url;

        if ( empty( $statsocial_header_image_uri ) ) {

            $statsocial_header_image_uri = get_header_image();
        }
        $statsocial_header_image_width  = statsocial_detect_header_image_size( 'width' );
        $statsocial_header_image_height = statsocial_detect_header_image_size( 'height' );
        ?>
            <script type="text/javascript">
                (function() {

                    jQuery(function() {

                        var statsocial_width = jQuery('div#header-image').width();
                        function statsocial_resizes() {

                            var image_exists = '<?php echo $statsocial_header_image_uri; ?>';
                            var statsocial_width = jQuery('div#header-image').width();
                            var statsocial_window_width = jQuery(window).width();
        <?php
        $statsocial_restore_check       = get_theme_mod( 'header_image', get_theme_support( 'custom-header', 'default-image' ) );

        if ( $statsocial_restore_check !== 'remove-header' ) {

            if ( $statsocial_header_image_width > 0 && $statsocial_header_image_height > 0 ) {

                $ratio = $statsocial_header_image_height / $statsocial_header_image_width;
            } else {

                $ratio = 0;
            }
            ?>
                                var statsocial_ratio = <?php echo apply_filters( 'statsocial_header_image_ratio', $ratio ); ?>;
                                var statsocial_height = Math.round(statsocial_width * statsocial_ratio);
                                jQuery('#header-image').removeAttr('style').css({'height': statsocial_height});

            <?php
            //remove header
        }
// equal height for design ver 1.150
        $statsocial_currrent_template = basename( $template, '.php' );

        if ( $statsocial_currrent_template == 'list_of_post' ) {
            ?>
                                var statsocial_ignore_template = true;
            <?php
        } else {
            ?>
                                var statsocial_ignore_template = false;
            <?php
        }
        ?>
                            if (statsocial_window_width > 640 && statsocial_ignore_template == false) {
                                var statsocial_main_sidebar_height = jQuery('.lsidebar').height();
                                var statsocial_extra_sidebar_height = jQuery('.rsidebar').height();
                                var statsocial_container_height = jQuery('#container').height();
                                var statsocial_sticky_widget_height = jQuery('.topsidebar').height();

                                if (statsocial_main_sidebar_height > statsocial_container_height) {

                                    jQuery('#container').css({'min-height': statsocial_main_sidebar_height + 'px'});
                                    jQuery('.rsidebar').css({'min-height': statsocial_main_sidebar_height + 'px'});
                                } else {

                                    if (statsocial_sticky_widget_height > 0) {

                                        statsocial_left_sidebar_height = statsocial_container_height + statsocial_sticky_widget_height + 13;
                                        jQuery('.lsidebar').css({'min-height': statsocial_left_sidebar_height + 'px'});
                                    } else {

                                        jQuery('.lsidebar').css({'min-height': statsocial_container_height + 'px'});
                                    }
                                    jQuery('.rsidebar').css({'min-height': statsocial_container_height + 'px'});
                                }
                            }
        <?php
//detect lang  add ver 1.120

        if ( $statsocial_browser_detection !== true ) {

            if ( is_single() || is_page() ) {

                $color_type              = '';
                $statsocial_content_check = get_post( $post->ID );
                $statsocial_content_check = $statsocial_content_check->post_content;

                if ( preg_match( "!\[statsocial[^\]]+(color_type)=(\"|')*?([^\"' ]+)(\"|' )*?[^\]]*\]!si", $statsocial_content_check, $regs ) ) {

                    $color_type = "rd-type-" . trim( $regs[3] );
                }

                if ( preg_match( "!\[statsocial[^\]]+(col)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si", $statsocial_content_check, $regs ) ) {

                    $color_type .= ' ';
                    $color_type .= "rd-col-" . $regs[3];
                }
                ?>
                                    jQuery('body').addClass('<?php echo $color_type; ?>');
                <?php
            } else {

                $statsocial_options = get_option( "statsocial_theme_settings" );

                if ( isset( $statsocial_options["statsocial_style_type"] ) && !empty( $statsocial_options["statsocial_style_type"] ) ) {
                    ?>
                                        jQuery('body').addClass('<?php echo "rd-type-" . $statsocial_options["statsocial_style_type"]; ?>');
                    <?php
                }
            }
            ?>

                                if (navigator.userLanguage) {

                                    baseLang = navigator.userLanguage.substring(0, 2).toLowerCase();
                                } else {

                                    baseLang = navigator.language.substring(0, 2).toLowerCase();
                                }

                                jQuery('body').addClass('accept-lang-' + baseLang);


                                var userAgent = window.navigator.userAgent.toLowerCase();

                                if (userAgent.match(/msie/i)) {

                                    var ie_num = userAgent.match(/MSIE (\d+\.\d+);/i);
                                    var ieversion = parseInt(ie_num[1], 10);
                                    jQuery('body').addClass('ie' + ieversion);
                                } else if (userAgent.indexOf('opera') != -1) {

                                    jQuery('body').addClass('opera');
                                } else if (userAgent.indexOf('chrome') != -1) {

                                    jQuery('body').addClass('chrome');
                                } else if (userAgent.indexOf('safari') != -1) {

                                    jQuery('body').addClass('safari');
                                } else if (userAgent.indexOf('gecko') != -1) {

                                    var match = userAgent.match(/(trident)(?:.*rv:([\w.]+))?/);
                                    var version = parseInt(match[2], 10);

                                    if (version == 11) {
                                        jQuery('body').addClass('ie11');
                                    } else {
                                        jQuery('body').addClass('gecko');
                                    }
                                } else if (userAgent.indexOf('iphone') != -1) {

                                    jQuery('body').addClass('iphone');
                                } else if (userAgent.indexOf('Netscape') != -1) {

                                    jQuery('body').addClass('netscape');
                                } else {

                                    jQuery('body').addClass('unknown');
                                }
            <?php
            /**
             * Accessible class
             * 
             * @since 1.217 
             */
            if ( $statsocial_link_unique_text == true ) {
                ?>
                                    jQuery('body').addClass('statsocial-accessible-mode');
                <?php
            } elseif ( 'yes' !== statsocial_warehouse_clone( 'statsocial_accessibility_settings' ) ) {
                ?>
                                    jQuery('body').removeClass('statsocial-accessible-mode');
                <?php
            }
        } //end if (  true !== $statsocial_browser_detection  )

        /**
         * Check window size and mouse position
         * Controll childlen menu show right or left side.
         *
         *
         *
         */
        ?>
                            if (jQuery('body > div').is('#doc3')) {

                                jQuery("#access").mousemove(function(e) {

                                    var statsocial_menu_item_position = e.pageX;

                                    if (statsocial_window_width - 200 < statsocial_menu_item_position) {

                                        jQuery('#access ul ul ul').addClass('left');
                                    } else if (statsocial_window_width / 2 > statsocial_menu_item_position) {

                                        jQuery('#access ul ul ul').removeClass('left');
                                    }

                                });
                                if (statsocial_window_width > <?php echo $statsocial_fluid_maximum_width; ?>) {
                                    //centering page when browser width > $statsocial_fluid_maximun_width
                                    jQuery('#doc3').css({'margin': 'auto'});
                                }
                            }
                        }
                        jQuery(window).load(function() {
                            statsocial_resizes()
                        });
                        jQuery(window).resize(function() {
                            statsocial_resizes()
                        });
                    });

                    jQuery('#access').find('a').on('focus.statsocial blur.statsocial', function() {
                        jQuery(this).parents().toggleClass('focus');
                    });
                })(jQuery);
            </script>
        <?php
    }

}
/**
 *
 *
 *
 *
 *
 */
if ( !function_exists( 'statsocial_custom_width' ) ) {

    function statsocial_custom_width() {

        global $statsocial_page_width;
        $c_width              = ( int ) $statsocial_page_width;
        $width                = $c_width / 13;
        $ie_width             = $width * 0.9759;
        return "/* test: $c_width */";
        $custom_content_width = '/* set custom content width start */' . '#custom-doc {margin:auto;text-align:left;' . "\n" . 'width:' . round( $width, 0 ) . 'em;' . "\n" . '*width:' . round( $ie_width, 0 ) . 'em;' . "\n" . 'min-width:' . round( $width * 0.7, 0 ) . 'em;}/* set custom content width end */';
        return apply_filters( "statsocial_custom_width", $custom_content_width );
    }

}
/**
 *
 *
 *
 *
 *
 */
if ( !function_exists( 'statsocial_is_fluid' ) ) {

    function statsocial_is_fluid() {

        global $is_IE, $statsocial_fluid_minimum_width, $statsocial_fluid_maximum_width;
        $width               = intval( $statsocial_fluid_minimum_width );
        $extra_sidebar_width = statsocial_warehouse_clone( 'statsocial_right_sidebar_width_percent' );

        if ( '25' == $extra_sidebar_width ) {

            $main_column_width_fluid = 74;
        } elseif ( '75' == $extra_sidebar_width ) {

            $main_column_width_fluid = 24;
        } elseif ( '33' == $extra_sidebar_width ) {

            $main_column_width_fluid = 64;
        } elseif ( '66' == $extra_sidebar_width ) {

            $main_column_width_fluid = 32;
        } elseif ( '50' == $extra_sidebar_width ) {

            $main_column_width_fluid = 49;
        } else {

            $main_column_width_fluid = 100;
        }

        if ( 'show' !== statsocial_warehouse_clone( 'statsocial_show_right_sidebar' ) ) {

            $main_column_width_fluid = 100;
        }
        $fluid_width = '/* statsocial is fluid start  */' . "\n#doc3{min-width:" . $statsocial_fluid_minimum_width . 'px;max-width:' . $statsocial_fluid_maximum_width . 'px;}' . "\n#container > .first{width:" . $main_column_width_fluid . "%;}" . "\n#access{min-width:" . $statsocial_fluid_minimum_width . 'px;}/* statsocial is fluid end */';
        return apply_filters( "statsocial_is_fluid", $fluid_width );
    }

}

if ( !function_exists( 'statsocial_is_fixed' ) ) {

    function statsocial_is_fixed() {

        global $is_IE, $statsocial_page_width, $statsocial_base_font_size;
        $add_ie = '';
        $pw     = statsocial_warehouse_clone( "statsocial_page_width" );

        $statsocial_base_font_size = apply_filters( 'statsocial_base_font_size', 13 ); //px size

        if ( 'doc' == $pw ) {

            $width = 750;
            $px    = 'width:' . $width . 'px;';
            $width = $width / $statsocial_base_font_size;
        }

        if ( 'doc2' == $pw ) {

            $width = 950;
            $px    = 'width:' . $width . 'px;';
            $width = $width / $statsocial_base_font_size;
        }

        if ( 'custom-doc' == $pw ) {

            $width = $statsocial_page_width;
            $px    = 'width:' . $width . 'px;';
            $width = $width / $statsocial_base_font_size;
        }
        $statsocial_main_width = statsocial_main_width();
        $statsocial_main_width = $statsocial_main_width / $statsocial_base_font_size;

        if ( $is_IE ) {

            $width                = round( $width * 0.9759, 1 );
            $add_ie               = '';
            $statsocial_main_width = round( $statsocial_main_width * 0.9759, 1 );
        } else {

            $width                = round( $width, 1 );
            $statsocial_main_width = round( $statsocial_main_width, 1 );
        }
        $custom_fixed_width = '/* statsocial is fixed start*/' . "
                \n#" . $pw . '{margin:auto;text-align:left;' . "\n" . 'min-width:' . $width . 'em;' . $add_ie . $px . '}' . "\n#container{min-width:" . $statsocial_main_width . 'em;}/* statsocial is fixed end */';
        return apply_filters( "statsocial_is_fixed", $custom_fixed_width );
    }

}
/**
 *
 *
 *
 *
 *
 */
if ( !function_exists( 'statsocial_gallerys' ) ) {

    function statsocial_gallerys() {

        $statsocial_gallerys = ".gallery { margin: auto; overflow: hidden; width: 100%; }\n
            .gallery dl { margin: 0px; }\n
            .gallery .gallery-item { float: left; margin-top: 10px; text-align: center; }\n
            .gallery img { border: 2px solid #cfcfcf;max-width:100%; }\n
            .gallery .gallery-caption { margin-left: 0; }\n
            .gallery br { clear: both }\n
            .gallery-columns-1 dl{ width: 100% }\n
            .gallery-columns-2 dl{ width: 50% }\n
            .gallery-columns-3 dl{ width: 33.3% }\n
            .gallery-columns-4 dl{ width: 25% }\n
            .gallery-columns-5 dl{ width: 20% }\n
            .gallery-columns-6 dl{ width: 16.6% }\n
            .gallery-columns-7 dl{ width: 14.28% }\n
            .gallery-columns-8 dl{ width: 12.5% }\n
            .gallery-columns-9 dl{ width: 11.1% }\n
            .gallery-columns-10 dl{ width: 9.9% }\n";
        return apply_filters( "statsocial_gallerys_css", $statsocial_gallerys );
    }

}
/**
 *
 *
 *
 *
 * @since 0.965
 */
if ( $statsocial_show_theme_option == true ) {

    add_action( 'customize_register', 'statsocial_customize_register' );
}
/**
 *
 *
 *
 *
 */
if ( !function_exists( 'statsocial_customize_register' ) ) {

    function statsocial_customize_register( $wp_customize ) {

        global $statsocial_current_theme_name;
        $wp_customize->add_section( 'statsocial_theme_settings', array( 'title' => esc_html__( 'statsocial theme settings', 'statsocial' ), 'priority' => 25, ) );
        $wp_customize->add_section( 'statsocial_navigation_setting', array( 'title' => esc_html__( 'Another Settings link', 'statsocial' ), 'priority' => 120, ) );

        /* Pending
         * Reason:PHP Fatal error:  Allowed memory size of 94371840 bytes exhausted (tried to allocate 17249 bytes) in /.../wp/wp-includes/functions.php on line 252
         *
         * 	
          $wp_customize->add_setting( 'statsocial_theme_settings[statsocial_style_type]', array( 'default' => 'dark', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'statsocial_style_type_validate' ) );
          $wp_customize->add_setting( 'statsocial_theme_settings[statsocial_page_width]', array( 'default' => 'doc2', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'statsocial_page_width_validate' ) );
          $wp_customize->add_setting( 'statsocial_theme_settings[statsocial_base_color]', array( 'default' => '#444444', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'statsocial_base_color_validate' ) );
          $wp_customize->add_setting( 'statsocial_theme_settings[statsocial_show_right_sidebar]', array( 'default' => 'show', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'statsocial_show_right_sidebar_validate' ) );
          $wp_customize->add_setting( 'statsocial_theme_settings[statsocial_col_width]', array( 'default' => 't2', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'statsocial_col_width_validate' ) );
          $wp_customize->add_setting( 'statsocial_theme_settings[statsocial_show_menu_primary]', array( 'default' => 'show', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'statsocial_show_menu_primary_validate' ) );
          $wp_customize->add_setting( 'statsocial_theme_settings[statsocial_default_fonts_color]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'statsocial_default_fonts_color_validate' ) );
          $wp_customize->add_setting( 'statsocial_theme_settings[statsocial_hyperlink_color]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'statsocial_hyperlink_color_validate' ) );
          $wp_customize->add_setting( 'navigation_setting', array( 'default' => array( array( 'label' => esc_html__( 'Custom Header', 'statsocial' ), 'path' => 'themes.php?page=custom-header', 'target' => 'b' ), array( 'label' => esc_html__( 'Widget', 'statsocial' ), 'path' => 'widgets.php', 'target' => 'b' ), array( 'label' => esc_html__( 'Nav Menus', 'statsocial' ), 'path' => 'nav-menus.php', 'target' => 'b' ), array( 'label' => esc_html__( 'statsocial Settings', 'statsocial' ), 'path' => 'themes.php?page=statsocial_settings', 'target' => 'b' ), array( 'label' => esc_html__( 'Theme', 'statsocial' ), 'path' => 'themes.php', 'target' => 's' ), array( 'label' => esc_html__( 'Dashbord', 'statsocial' ), 'path' => 'index.php', 'target' => 's' ), ), ) );
         */
        $wp_customize->add_setting( 'statsocial_theme_settings[statsocial_style_type]', array( 'default' => 'dark', 'type' => 'option', 'capability' => 'edit_theme_options', ) );
        $wp_customize->add_setting( 'statsocial_theme_settings[statsocial_page_width]', array( 'default' => 'doc3', 'type' => 'option', 'capability' => 'edit_theme_options', ) );
        $wp_customize->add_setting( 'statsocial_theme_settings[statsocial_base_color]', array( 'default' => '#444444', 'type' => 'option', 'capability' => 'edit_theme_options', ) );
        $wp_customize->add_setting( 'statsocial_theme_settings[statsocial_show_right_sidebar]', array( 'default' => 'show', 'type' => 'option', 'capability' => 'edit_theme_options', ) );
        $wp_customize->add_setting( 'statsocial_theme_settings[statsocial_col_width]', array( 'default' => 't2', 'type' => 'option', 'capability' => 'edit_theme_options', ) );
        $wp_customize->add_setting( 'statsocial_theme_settings[statsocial_show_menu_primary]', array( 'default' => 'show', 'type' => 'option', 'capability' => 'edit_theme_options', ) );
        $wp_customize->add_setting( 'statsocial_theme_settings[statsocial_default_fonts_color]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', ) );
        $wp_customize->add_setting( 'statsocial_theme_settings[statsocial_hyperlink_color]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', ) );
        $wp_customize->add_setting( 'navigation_setting', array( 'default' => array( array( 'label' => esc_html__( 'Custom Header', 'statsocial' ), 'path' => 'themes.php?page=custom-header', 'target' => 'b' ), array( 'label' => esc_html__( 'Widget', 'statsocial' ), 'path' => 'widgets.php', 'target' => 'b' ), array( 'label' => esc_html__( 'Nav Menus', 'statsocial' ), 'path' => 'nav-menus.php', 'target' => 'b' ), array( 'label' => esc_html__( 'statsocial Settings', 'statsocial' ), 'path' => 'themes.php?page=statsocial_settings', 'target' => 'b' ), array( 'label' => esc_html__( 'Theme', 'statsocial' ), 'path' => 'themes.php', 'target' => 's' ), array( 'label' => esc_html__( 'Dashbord', 'statsocial' ), 'path' => 'index.php', 'target' => 's' ), ), ) );


        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'statsocial_base_color', array( 'label' => esc_html__( 'Base color', 'statsocial' ), 'section' => 'statsocial_theme_settings', 'settings' => 'statsocial_theme_settings[statsocial_base_color]' ) ) );
        $statsocial_style_type_choices = statsocial_register_styles( "w3standard" );
        $wp_customize->add_control( 'statsocial_style_type', array( 'label' => esc_html__( 'Color Type', 'statsocial' ), 'section' => 'statsocial_theme_settings', 'settings' => 'statsocial_theme_settings[statsocial_style_type]', 'type' => 'radio', 'choices' => $statsocial_style_type_choices, ) );
        $wp_customize->add_control( 'statsocial_page_width', array( 'label' => esc_html__( 'Page width', 'statsocial' ), 'section' => 'statsocial_theme_settings', 'settings' => 'statsocial_theme_settings[statsocial_page_width]', 'type' => 'radio', 'choices' => array( 'doc' => '750px fix', 'doc2' => '950px fix', 'doc3' => 'fluid', 'doc4' => '974px fix', ), ) );
        $wp_customize->add_control( 'statsocial_show_right_sidebar', array( 'label' => esc_html__( 'Extra Sidebar', 'statsocial' ), 'section' => 'statsocial_theme_settings', 'settings' => 'statsocial_theme_settings[statsocial_show_right_sidebar]', 'type' => 'radio', 'choices' => array( 'show' => 'Show', 'hide' => 'Hide', ), ) );
        $statsocial_col_width          = array( "left 160px" => "t1", "left 180px" => "t2", "left 300px" => "t3", "right 180px" => "t4", "right 240px" => "t5", "right 300px" => "t6" );
        $wp_customize->add_control( 'statsocial_col_width', array( 'label' => esc_html__( 'Default Sidebar', 'statsocial' ), 'section' => 'statsocial_theme_settings', 'settings' => 'statsocial_theme_settings[statsocial_col_width]', 'type' => 'radio', 'choices' => array_flip( $statsocial_col_width ), ) );
        $wp_customize->add_control( 'statsocial_show_menu_primary', array( 'label' => esc_html__( 'Menu Primary', 'statsocial' ), 'section' => 'statsocial_theme_settings', 'settings' => 'statsocial_theme_settings[statsocial_show_menu_primary]', 'type' => 'radio', 'choices' => array( 'show' => 'Show', 'hide' => 'Hide', ), ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'statsocial_default_fonts_color', array( 'label' => esc_html__( 'Font Color', 'statsocial' ), 'section' => 'statsocial_theme_settings', 'settings' => 'statsocial_theme_settings[statsocial_default_fonts_color]' ) ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'statsocial_hyperlink_color', array( 'label' => esc_html__( 'Link Color', 'statsocial' ), 'section' => 'statsocial_theme_settings', 'settings' => 'statsocial_theme_settings[statsocial_hyperlink_color]' ) ) );
        $wp_customize->add_control( new statsocial_Customize_Navigation_Control( $wp_customize, 'navigation_setting', array( 'label' => 'Navigation_Setting', 'section' => 'statsocial_navigation_setting', 'settings' => 'navigation_setting' ) ) );

        /* Label change 'Display Header Text' */
        $wp_customize->add_control( 'display_header_text', array(
            'settings' => 'header_textcolor',
            'label'    => __( 'Move Tagline from header image to top right', 'statsocial' ),
            'section'  => 'title_tagline',
            'type'     => 'checkbox',
        ) );

        do_action( 'statsocial_customize_register' );
    }

}
add_filter( 'statsocial_prev_next_post', 'statsocial_remove_element' );
add_filter( 'statsocial_posted_on', 'statsocial_remove_element' );
add_filter( 'statsocial_posted_in', 'statsocial_remove_element' );
/**
 *
 *
 *
 *
 */
if ( !function_exists( 'statsocial_remove_element' ) ) {

    function statsocial_remove_element( $content ) {

        return preg_replace( '!<span[^>]+><\/span>!', '', $content );
    }

}
/**
 *
 *
 *
 *
 * thanks  aison
 */
if ( !function_exists( 'statsocial_page_menu_args' ) ) {

    function statsocial_page_menu_args( $args ) {

        global $statsocial_nav_menu_home_link;
        $args['show_home'] = $statsocial_nav_menu_home_link;
        return $args;
    }

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'insert_message_action_hook_position' ) ) {

    function insert_message_action_hook_position( $hook_name = '' ) {

        add_action( 'statsocial_after_nav_menu', 'statsocial_action_hook_messages' );
        add_action( 'statsocial_append_entry_content', 'statsocial_action_hook_messages' );
        add_action( 'statsocial_prepend_extra_sidebar', 'statsocial_action_hook_messages' );
        add_action( 'statsocial_append_extra_sidebar', 'statsocial_action_hook_messages' );
        add_action( 'statsocial_prepend_doc', 'statsocial_action_hook_messages' );
        add_action( 'statsocial_append_doc', 'statsocial_action_hook_messages' );
        add_action( 'statsocial_prepend_default_sidebar', 'statsocial_action_hook_messages' );
        add_action( 'statsocial_append_default_sidebar', 'statsocial_action_hook_messages' );
        add_action( 'statsocial_prepend_footer', 'statsocial_action_hook_messages' );
        add_action( 'statsocial_append_footer', 'statsocial_action_hook_messages' );
        add_action( 'statsocial_prepend_entry_content', 'statsocial_action_hook_messages' );
        add_action( 'statsocial_prepend_loop', 'statsocial_action_hook_messages' );
        add_action( 'statsocial_append_loop', 'statsocial_action_hook_messages' );
    }

}

if ( true == WP_DEBUG && true == $statsocial_actions_hook_message ) {

    insert_message_action_hook_position();
}
/**
 *
 *
 *
 *
 * @since 1.204
 */
if ( !function_exists( 'statsocial_prepend_loop' ) ) {

    function statsocial_prepend_loop() {
        $args = array( 'hook_name' => 'statsocial_prepend_loop', 'template_part_name' => 'hook-prepend-loop.php' );

        get_template_part( 'hook', 'prepend-loop' );
        do_action( 'statsocial_prepend_loop', $args );
    }

}
/**
 *
 *
 *
 *
 * @since 1.204
 */
if ( !function_exists( 'statsocial_append_loop' ) ) {

    function statsocial_append_loop() {
        $args = array( 'hook_name' => 'statsocial_append_loop', 'template_part_name' => 'hook-append-loop.php' );

        get_template_part( 'hook', 'append-loop' );
        do_action( 'statsocial_append_loop', $args );
    }

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'statsocial_action_hook_messages' ) ) {

    function statsocial_action_hook_messages( $args ) {

        if ( isset( $args ) && array_key_exists( 'hook_name', $args ) && array_key_exists( 'template_part_name', $args ) ) {

            $message = esc_html__( 'add_action(  \'%1$s\', \'your_function\'  ) or add template part file the name \'%2$s\'.' );
            $message = sprintf( $message, $args['hook_name'], $args['template_part_name'] );
            printf( '<div style="%2$s" class="color3 pad-m corner">%1$s</div>', $message, 'word-break:break-all;word-wrap:break-word;' );
        }
    }

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'statsocial_after_nav_menu' ) ) {

    function statsocial_after_nav_menu() {

        get_template_part( 'hook', 'after-nav-menu' );
        $args = array( 'hook_name' => 'statsocial_after_nav_menu', 'template_part_name' => 'hook-after-nav-menu.php' );
        do_action( 'statsocial_after_nav_menu', $args );
    }

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'statsocial_prepend_doc' ) ) {

    function statsocial_prepend_doc() {

        $args = array( 'hook_name' => 'statsocial_prepend_doc', 'template_part_name' => 'hook-prepend-doc.php' );
        get_template_part( 'hook', 'prepend-doc' );
        do_action( 'statsocial_prepend_doc', $args );
    }

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'statsocial_append_doc' ) ) {

    function statsocial_append_doc() {

        $args = array( 'hook_name' => 'statsocial_append_doc', 'template_part_name' => 'hook-append-doc.php' );
        get_template_part( 'hook', 'append-doc' );
        do_action( 'statsocial_append_doc', $args );
    }

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'statsocial_prepend_entry_content' ) ) {

    function statsocial_prepend_entry_content() {

        $args = array( 'hook_name' => 'statsocial_prepend_entry_content', 'template_part_name' => 'hook-prepend-entry-content.php' );
        get_template_part( 'hook', 'prepend-entry-content' );
        do_action( 'statsocial_prepend_entry_content', $args );
    }

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'statsocial_prepend_extra_sidebar' ) ) {

    function statsocial_prepend_extra_sidebar() {

        $args = array( 'hook_name' => 'statsocial_prepend_extra_sidebar', 'template_part_name' => 'hook-prepend-extra-sidebar.php' );
        get_template_part( 'hook', 'prepend-extra-sidebar' );
        do_action( 'statsocial_prepend_extra_sidebar', $args );
    }

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'statsocial_prepend_default_sidebar' ) ) {

    function statsocial_prepend_default_sidebar() {

        $args = array( 'hook_name' => 'statsocial_prepend_default_sidebar', 'template_part_name' => 'hook-prepend-default-sidebar.php' );
        get_template_part( 'hook', 'prepend-default-sidebar' );
        do_action( 'statsocial_prepend_default_sidebar', $args );
    }

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'statsocial_prepend_footer' ) ) {

    function statsocial_prepend_footer() {

        $args = array( 'hook_name' => 'statsocial_prepend_footer', 'template_part_name' => 'hook-prepend-footer.php' );
        get_template_part( 'hook', 'prepend-footer' );
        do_action( 'statsocial_prepend_footer', $args );
    }

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'statsocial_append_entry_content' ) ) {

    function statsocial_append_entry_content() {

        $args = array( 'hook_name' => 'statsocial_append_entry_content', 'template_part_name' => 'hook-append-entry-content.php' );
        get_template_part( 'hook', 'append-entry-content' );
        do_action( 'statsocial_append_entry_content', $args );
    }

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'statsocial_append_extra_sidebar' ) ) {

    function statsocial_append_extra_sidebar() {

        $args = array( 'hook_name' => 'statsocial_append_extra_sidebar', 'template_part_name' => 'hook-append-extra-sidebar.php' );
        get_template_part( 'hook', 'append-extra-sidebar' );
        do_action( 'statsocial_append_extra_sidebar', $args );
    }

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'statsocial_append_default_sidebar' ) ) {

    function statsocial_append_default_sidebar() {

        $args = array( 'hook_name' => 'statsocial_append_default_sidebar', 'template_part_name' => 'hook-append-default-sidebar.php' );
        get_template_part( 'hook', 'append-default-sidebar' );
        do_action( 'statsocial_append_default_sidebar', $args );
    }

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'statsocial_append_footer' ) ) {

    function statsocial_append_footer() {

        $args = array( 'hook_name' => 'statsocial_append_footer', 'template_part_name' => 'hook-append-footer.php' );
        get_template_part( 'hook', 'append-footer' );
        do_action( 'statsocial_append_footer', $args );
    }

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'statsocial_entry_title' ) ) {

    function statsocial_entry_title( $args = array() ) {

        global $post, $templates;
        $default   = array( 'statsocial_title_element' => 'h2', );
        $args      = wp_parse_args( $args, $default );
        $thumbnail = '';
        extract( $args, EXTR_SKIP );

        if ( has_post_thumbnail( $post->ID ) && !is_singular() && !post_password_required() ) {

            $thumbnail .= '<span class="h2-thumb">';
            $thumbnail .= get_the_post_thumbnail( $post->ID, array( 48, 48 ), array( "style" => "vertical-align:text-bottom;", "alt" => esc_attr__( 'Featured Image', 'statsocial' ) ) );
            $thumbnail .= '</span>';
        }

        if ( !is_singular() or is_page_template( 'page-templates/list-of-post.php' ) ) {

            $html = '<' . $statsocial_title_element . ' class="%1$s">%5$s<a href="%2$s" rel="bookmark" title="%3$s"><span>%4$s</span></a></' . $statsocial_title_element . '>';

            $html = sprintf( $html, 'h2 entry-title', get_permalink(), the_title_attribute( array( 'before' => '', 'after' => '', 'echo' => false ) ), the_title( '', '', false ), $thumbnail );

            echo apply_filters( 'statsocial_entry_title', $html );
        } else {

            $html = '<' . $statsocial_title_element . ' class="%1$s"><span>%2$s</span></' . $statsocial_title_element . '>';

            $html = sprintf( $html, 'h2 entry-title', the_title( '', '', false ) );

            echo apply_filters( 'statsocial_entry_title', $html );
        }
    }

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'statsocial_entry_content' ) ) {

    function statsocial_entry_content( $more_link_text = null, $stripteaser = false ) {

        global $post;
        $statsocial_excerpt_condition = statsocial_detect_excerpt_condition();

        if ( true == $statsocial_excerpt_condition ) {

            /* remove shortcodes */
            $excerpt = preg_replace( '!\[[^\]]+\]!', '', get_the_excerpt() );
            $excerpt = apply_filters( 'the_excerpt', $excerpt );
            echo apply_filters( 'statsocial_entry_content', $excerpt );
        } else {

            if ( empty( $more_link_text ) ) {

                $more_link_text = esc_html__( 'Continue&nbsp;reading ', 'statsocial' ) . '<span class="meta-nav">&rarr;</span><span class="more-link-post-unique">' . esc_html__( '&nbsp;Post ID&nbsp;', 'statsocial' ) . get_the_ID() . '</span>';
            }
            $content = get_the_content( $more_link_text, $stripteaser );
            $content = apply_filters( 'the_content', $content );
            $content = apply_filters( 'statsocial_entry_content', $content );
            $content = str_replace( ']]>', ']]&gt;', $content );
            echo $content;
        }
    }

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'statsocial_next_prev_links' ) ) {

    function statsocial_next_prev_links( $position = 'nav-above' ) {

        global $wp_query, $paged;

        $statsocial_old = $paged + 1;
        $statsocial_new = $paged - 1;
        $statsocial_old = statsocial_link_unique( $text          = 'Next Page', $statsocial_old );
        $statsocial_new = statsocial_link_unique( $text          = 'Next Page', $statsocial_new );

        if ( $wp_query->max_num_pages > 1 ) {

            $html = '<div id="%3$s" class="clearfix"><span class="nav-previous">%1$s</span><span class="nav-next">%2$s</span></div>';
            $html = sprintf( $html, get_next_posts_link( '<span class="meta-nav">&larr;</span>' . $statsocial_old . esc_html__( ' Older posts', 'statsocial' ) ), get_previous_posts_link( '<span>' . $statsocial_new . esc_html__( 'Newer posts', 'statsocial' ) . '<span class="meta-nav">&rarr;</span></span>' ), $position );
            echo apply_filters( 'statsocial_next_prev_links', $html, $position );
        }
    }

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'statsocial_sidebar_menus' ) ) {

    function statsocial_sidebar_menus( $position = 'default' ) {

        global $post, $statsocial_wp_version;
        $attr = '';

        if ( 'default' == $position ) {

            if ( $statsocial_wp_version < 3.6 ) {

                $html = '';
                // version 3.5.2 get_search_form always echo , It shows list elements before.
            } else {

                $html = '<li id="search-default" class="widget-container widget_search">' . get_search_form( false ) . '</li>';
            }
            $html .= '<li><h2 class="h2 widget-title">' . esc_html__( 'Archives', 'statsocial' ) . '</h2>';
            $html .= '<ul>' . wp_get_archives( 'type=monthly&echo=0' ) . '</ul>';
            $html .= '</li>';
        } else {

            $html = wp_list_categories( 'show_count=1&title_li=<h2 class="h2 widget-title">' . esc_html__( 'Categories', 'statsocial' ) . '</h2>&echo=0' );
        }
        echo apply_filters( 'statsocial_sidebar_menus', $html );
        wp_reset_postdata();
    }

}
/**
 * recent posta
 *
 *
 *
 *
 */
if ( !function_exists( 'statsocial_recent_posts' ) ) {

    function statsocial_recent_posts( $args = array() ) {

        global $statsocial_bf_recent_posts_setting, $post;

        $thumbnail_size = apply_filters( 'statsocial_recent_posts_thumb_size', array( 125, 125 ) );
        $article_margin = 0;

        $thumbnail_width  = ( int ) $thumbnail_size[0];
        $thumbnail_height = ( int ) $thumbnail_size[0];

        if ( empty( $args ) ) {

            if ( !isset( $statsocial_bf_recent_posts_setting ) && basename( $template ) == 'blank-front.php' ) {

                return;
            }
        } else {

            $statsocial_bf_recent_posts_setting = wp_parse_args( $args, $statsocial_bf_recent_posts_setting );
        }

        $default = array( 'title'                                       => esc_html__( 'Recent Post', 'statsocial' ), 'numberposts'                                 => 10, 'offset'                                      => 0, 'category'                                    => 0, 'orderby'                                     => 'post_date', 'order'                                       => 'DESC', 'include'                                     => '', 'exclude'                                     => '', 'meta_key'                                    => '', 'meta_value'                                  => '', 'post_type'                                   => 'post', 'post_status'                                 => 'publish', 'suppress_filters'                            => true,
            'statsocial_excerpt_length'                    => 100,
            'statsocial_excerpt_more'                      => '...', 'statsocial_post_thumbnail'                    => true, 'statsocial_recent_post_thumbnail_default_uri' => '' );
        $args    = wp_parse_args( $statsocial_bf_recent_posts_setting, $default );
        $title   = $args['title'];
        unset( $args['title'] );

        $article_margin = '';

        if ( array_key_exists( 'statsocial_excerpt_length', $args ) ) {

            $statsocial_excerpt_length = $args["statsocial_excerpt_length"];
        }

        if ( array_key_exists( 'statsocial_excerpt_more', $args ) && $args["statsocial_excerpt_length"] > 0 ) {

            $statsocial_excerpt_more = $args["statsocial_excerpt_more"];
        } else {

            $statsocial_excerpt_more = '';
        }

        if ( array_key_exists( 'statsocial_recent_post_thumbnail_default_uri', $args ) && !empty( $args["statsocial_recent_post_thumbnail_default_uri"] ) ) {

            $statsocial_recent_post_thumbnail_default_uri = $args["statsocial_recent_post_thumbnail_default_uri"];
        } elseif ( empty( $args["statsocial_recent_post_thumbnail_default_uri"] ) ) {

            $statsocial_recent_post_thumbnail_default_uri = '';
        }


        $archive_year  = get_the_time( 'Y' );
        $archive_month = get_the_time( 'm' );
        $archive_day   = get_the_time( 'd' );

        $statsocial_date_format = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
        $day_link              = esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) . '#post-' . $post->ID );

        $html    = '<li class="%3$s">%10$s<%4$s id="post-%5$s-recentpost" %6$s style="%11$s"><div class="posted-on">
%7$s%8$s</div><h3 class="h4 entry-title"><a href="%1$s"><span>%2$s</span></a></h3><div class="entry-content clearfix">%9$s</div></%4$s></li>';
        $html    = apply_filters( 'statsocial_recent_posts_li', $html );
        $results = wp_get_recent_posts( $args );

        $result = sprintf( '<h2 class="%2$s">%1$s</h2>', $title, 'title h2' );
        $result = apply_filters( 'statsocial_recent_posts_title', $result );

        $result .= sprintf( '<ul class="%1$s">', 'statsocial-recent-posts' );

        foreach ( $results as $key => $val ) {

            $classes = '';

            if ( empty( $statsocial_recent_post_thumbnail_default_uri ) && !has_post_thumbnail( $val["ID"] ) ) {

                $article_margin = '';
            } elseif ( true == $args["statsocial_post_thumbnail"] ) {

                $article_margin = ( int ) $thumbnail_size[0] + 10;

                $article_margin = 'margin-left:' . $article_margin . 'px!important';
            }


            if ( array_key_exists( 'statsocial_post_thumbnail', $args ) &&
                    true == $args["statsocial_post_thumbnail"] &&
                    //has_post_thumbnail( $post["ID"] ) &&  
                    !post_password_required() ) {

                $thumbnail = '<span class="statsocial_recent_posts thumb">';

                if ( has_post_thumbnail( $val["ID"] ) ) {

                    $thumbnail .= get_the_post_thumbnail( $val["ID"], $thumbnail_size, array( "style" => "vertical-align:text-bottom;float:left;", "alt" => esc_attr__( 'Recent Post Featured Image', 'statsocial' ) ) );
                } elseif ( !empty( $statsocial_recent_post_thumbnail_default_uri ) ) {

                    $thumbnail .= '<img src="' . apply_filters( 'statsocial_recent_post_thumbnail_default_uri', $statsocial_recent_post_thumbnail_default_uri ) . '" style="vertical-align:text-bottom;float:left;" width="' . $thumbnail_width . '" height="' . $thumbnail_height . '" alt="' . esc_attr__( 'Recent Post Fallback Image', 'statsocial' ) . '" />';
                }


                $thumbnail .= '</span>';
            } else {
                $thumbnail = '';
            }


            $author         = get_the_author_meta( 'display_name', $val["post_author"] );
            $post_content   = strip_shortcodes( $val["post_content"] );
            $list_num_class = 'recent-' . $val['ID'];

            $statsocial_now          = ( int ) current_time( 'timestamp' );
            $statsocial_publish_time = ( int ) strtotime( $val["post_date"] );
            $statsocial_period       = apply_filters( 'statsocial_new_period', 3 );
            $statsocial_Period       = ( int ) 60 * 60 * 24 * $statsocial_period;


            if ( $statsocial_now < $statsocial_Period + $statsocial_publish_time ) {

                $classes = array( 'statsocial-pub-new ' );
                $classes = get_post_class( $classes );
            } else {

                $classes = get_post_class();
            }

            $classes = 'class="' . join( ' ', $classes ) . '"';

            $result .= sprintf( $html, get_permalink( $val['ID'] ), $val['post_title'], $list_num_class, statsocial_doctype_elements( 'div', 'article', false ), $val['ID'], $classes, sprintf( '<a href="%1$s" title="%2$s"><%4$s class="entry-date updated" %5$s>%3$s</%4$s></a>&nbsp;', $day_link, esc_attr( 'archives daily ' . mysql2date( $val["post_date"], $statsocial_date_format ) ), esc_html( mysql2date( $statsocial_date_format, $val["post_date"] ) ), statsocial_doctype_elements( 'span', 'time', false ), statsocial_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false )
                    ), sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="vcard:url">%3$s</a></span> ', get_author_posts_url( $val["post_author"] ), sprintf( esc_attr__( 'View all posts by %s', 'statsocial' ), $author ), $author
                    ), wp_html_excerpt( $post_content, $statsocial_excerpt_length, $statsocial_excerpt_more ), $thumbnail, $article_margin
            );
        }

        $result .= sprintf( '</ul>' );
        $result = sprintf( '<div id="%3$s" class="%1$s">%2$s</div>', 'clearfix', $result, 'statsocial-recent-posts' );
        echo apply_filters( 'statsocial_recent_posts', $result );
    }

}
/**
 * category posts
 *
 *
 *
 *
 */
if ( !function_exists( 'statsocial_category_posts' ) ) {

    function statsocial_category_posts( $args = '' ) {

        global $post, $statsocial_bf_category_posts_setting, $template;

        if ( !isset( $statsocial_bf_category_posts_setting ) && basename( $template ) == 'blank-front.php' ) {

            return;
        }
        if ( !empty( $args ) ) {
            $statsocial_bf_category_posts_setting = $args;
        }

        $thumbnail_size = apply_filters( 'statsocial_category_posts_thumb_size', array( 125, 125 ) );
        $article_margin = 0;

        $thumbnail_width  = ( int ) $thumbnail_size[0];
        $thumbnail_height = ( int ) $thumbnail_size[0];

        $html          = '<li class="%3$s">%10$s<%4$s id="post-%5$s-catpost" %6$s style="%11$s"><div class="posted-on">
%7$s%8$s</div><h3 class="h4 entry-title"><a href="%1$s"><span>%2$s</span></a></h3><div class="entry-content clearfix">%9$s</div></%4$s></li>';
        $archive_year  = get_the_time( 'Y' );
        $archive_month = get_the_time( 'm' );
        $archive_day   = get_the_time( 'd' );

        $statsocial_date_format = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
        $day_link              = esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) . '#post-' . $post->ID );
        $settings              = array( 'title'                                         => esc_html__( 'Categories', 'statsocial' ),
            'numberposts'                                   => 0,
            'offset'                                        => 0,
            'category'                                      => 0,
            'orderby'                                       => 'post_date',
            'order'                                         => 'DESC',
            'include'                                       => '',
            'exclude'                                       => '',
            'meta_key'                                      => '',
            'meta_value'                                    => '',
            'post_type'                                     => 'post',
            'post_mime_type'                                => '',
            'post_parent'                                   => '',
            'post_status'                                   => 'publish',
            'statsocial_excerpt_length'                      => 100,
            'statsocial_excerpt_more'                        => '...',
            'statsocial_post_thumbnail'                      => true,
            'statsocial_category_post_thumbnail_default_uri' => '' );
        $settings              = wp_parse_args( $statsocial_bf_category_posts_setting, $settings );



        $title = $settings['title'];
        unset( $settings['title'] );


        $article_margin = '';

        if ( array_key_exists( 'statsocial_excerpt_length', $settings ) ) {

            $statsocial_excerpt_length = $settings["statsocial_excerpt_length"];
        }

        if ( array_key_exists( 'statsocial_excerpt_more', $settings ) && $settings["statsocial_excerpt_length"] > 0 ) {

            $statsocial_excerpt_more = $settings["statsocial_excerpt_more"];
        } else {

            $statsocial_excerpt_more = '';
        }

        if ( array_key_exists( 'statsocial_category_post_thumbnail_default_uri', $settings ) && !empty( $settings["statsocial_category_post_thumbnail_default_uri"] ) ) {

            $statsocial_category_post_thumbnail_default_uri = $settings["statsocial_category_post_thumbnail_default_uri"];
        } elseif ( empty( $settings["statsocial_category_post_thumbnail_default_uri"] ) ) {

            $statsocial_category_post_thumbnail_default_uri = '';
        }

        //echo 'test'. $statsocial_category_post_thumbnail_default_uri.'test'; 

        $posts = get_posts( $settings );

        if ( $posts ) {

            $result = sprintf( '<h2 class="%2$s">%1$s</h2>', $title, 'title h2' );
            $result .= sprintf( '<ul class="list">' );

            foreach ( $posts as $post ) {
                setup_postdata( $post );
                $classes = '';

                if ( empty( $statsocial_category_post_thumbnail_default_uri ) && !has_post_thumbnail( $post->ID ) ) {

                    $article_margin = '';
                } elseif ( true == $settings["statsocial_post_thumbnail"] ) {

                    $article_margin = ( int ) $thumbnail_size[0] + 10;

                    $article_margin = 'margin-left:' . $article_margin . 'px!important';
                }

                if ( array_key_exists( 'statsocial_post_thumbnail', $settings ) &&
                        true == $settings["statsocial_post_thumbnail"] &&
                        !post_password_required() ) {

                    $thumbnail = '<span class="statsocial_recent_posts thumb">';

                    if ( has_post_thumbnail( $post->ID ) ) {


                        $thumbnail .= get_the_post_thumbnail( $post->ID, $thumbnail_size, array( "style" => "vertical-align:text-bottom;float:left;", "alt" => esc_attr__( 'Category Post Featured Image', 'statsocial' ) ) );
                    } elseif ( !empty( $statsocial_category_post_thumbnail_default_uri ) ) {

                        $thumbnail .= '<img src="' . apply_filters( 'statsocial_category_post_thumbnail_default_uri', $statsocial_category_post_thumbnail_default_uri ) . '" style="vertical-align:text-bottom;float:left;" width="' . $thumbnail_width . '" height="' . $thumbnail_height . '" alt="' . esc_attr__( 'Recent Post Fallback Image', 'statsocial' ) . '" />';
                    }


                    $thumbnail .= '</span>';
                } else {
                    $thumbnail = '';
                }

                $author         = get_the_author_meta( 'display_name', get_the_author() );
                $post_content   = strip_shortcodes( get_the_content() );
                $list_num_class = 'recent-' . $post->ID;

                $statsocial_now          = ( int ) current_time( 'timestamp' );
                $statsocial_publish_time = ( int ) strtotime( get_the_date() );
                $statsocial_period       = apply_filters( 'statsocial_new_period', 3 );
                $statsocial_Period       = ( int ) 60 * 60 * 24 * $statsocial_period;


                if ( $statsocial_now < $statsocial_Period + $statsocial_publish_time ) {

                    $classes = array( 'statsocial-pub-new ' );
                    $classes = get_post_class( $classes );
                } else {

                    $classes = get_post_class();
                }

                $classes = 'class="' . join( ' ', $classes ) . '"';
                $result .= sprintf( $html, get_permalink( $post->ID ), get_the_title(), $list_num_class, statsocial_doctype_elements( 'div', 'article', false ), $post->ID, $classes, sprintf( '<a href="%1$s" title="%2$s"><%4$s class="entry-date updated" %5$s>%3$s</%4$s></a>&nbsp;', $day_link, esc_attr( 'archives daily ' . mysql2date( get_the_date(), $statsocial_date_format ) ), esc_html( mysql2date( $statsocial_date_format, get_the_date() ) ), statsocial_doctype_elements( 'span', 'time', false ), statsocial_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false )
                        ), sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="vcard:url">%3$s</a></span> ', get_author_posts_url( get_the_author() ), sprintf( esc_attr__( 'View all posts by %s', 'statsocial' ), get_the_author() ), get_the_author()
                        ), wp_html_excerpt( $post_content, $statsocial_excerpt_length, $statsocial_excerpt_more ), $thumbnail, $article_margin
                );




                //$result .= sprintf( '<li><a href="%2$s">%1$s</a></li>', the_title( '', '', false ), get_permalink( ) );
            }
            $result .= sprintf( '</ul>' );
        }

        $result = sprintf( '<div class="%1$s">%2$s</div>', 'statsocial-category-posts clearfix', $result );
        echo apply_filters( 'statsocial_category_posts', $result );
        wp_reset_postdata();
    }

}
/**
 * tag posts
 *
 *
 *
 *
 */
if ( !function_exists( 'statsocial_tag_posts' ) ) {

    function statsocial_tag_posts() {

        global $post, $statsocial_bf_tag_posts_setting;

        if ( empty( $args ) ) {

            if ( !isset( $statsocial_bf_tag_posts_setting ) && basename( $template ) == 'blank-front.php' ) {

                return;
            }
        }
        $thumbnail_size = apply_filters( 'statsocial_tag_posts_thumb_size', array( 125, 125 ) );
        $article_margin = 0;

        $thumbnail_width  = ( int ) $thumbnail_size[0];
        $thumbnail_height = ( int ) $thumbnail_size[0];




        $html          = '<li class="%3$s">%10$s<%4$s id="post-%5$s-tagpost" %6$s style="%11$s"><div class="posted-on">
%7$s%8$s</div><h3 class="h4 entry-title"><a href="%1$s"><span>%2$s</span></a></h3><div class="entry-content clearfix">%9$s</div></%4$s></li>';
        $archive_year  = get_the_time( 'Y' );
        $archive_month = get_the_time( 'm' );
        $archive_day   = get_the_time( 'd' );

        $statsocial_date_format = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
        $day_link              = esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) . '#post-' . $post->ID );




        $settings = array( 'title'                                    => esc_html__( 'Tags', 'statsocial' ), 'numberposts'                              => 0, 'offset'                                   => 0, 'category'                                 => 0, 'orderby'                                  => 'post_date', 'order'                                    => 'DESC', 'include'                                  => '', 'exclude'                                  => '', 'meta_key'                                 => '', 'meta_value'                               => '', 'post_type'                                => 'post', 'post_mime_type'                           => '', 'post_parent'                              => '', 'post_status'                              => 'publish', 'statsocial_excerpt_length'                 => 100,
            'statsocial_excerpt_more'                   => '...', 'statsocial_post_thumbnail'                 => true, 'statsocial_tag_post_thumbnail_default_uri' => '' );
        $settings = wp_parse_args( $statsocial_bf_tag_posts_setting, $settings );
        $title    = $settings['title'];
        unset( $settings['title'] );



        $article_margin = 'margin-left:' . $article_margin . 'px!important';


        if ( array_key_exists( 'statsocial_excerpt_length', $settings ) ) {

            $statsocial_excerpt_length = $settings["statsocial_excerpt_length"];
        }

        if ( array_key_exists( 'statsocial_excerpt_more', $settings ) && $settings["statsocial_excerpt_length"] > 0 ) {

            $statsocial_excerpt_more = $settings["statsocial_excerpt_more"];
        } else {

            $statsocial_excerpt_more = '';
        }

        if ( array_key_exists( 'statsocial_tag_post_thumbnail_default_uri', $settings ) && !empty( $settings["statsocial_tag_post_thumbnail_default_uri"] ) ) {

            $statsocial_tag_post_thumbnail_default_uri = $settings["statsocial_tag_post_thumbnail_default_uri"];
        } elseif ( empty( $settings["statsocial_tag_post_thumbnail_default_uri"] ) ) {

            $statsocial_tag_post_thumbnail_default_uri = '';
        }

        $posts = get_posts( $settings );

        if ( $posts ) {

            $result = sprintf( '<h2 class="%2$s">%1$s</h2>', $title, 'title h2' );
            $result .= sprintf( '<ul class="%1$s">', 'list' );

            foreach ( $posts as $post ) {
                setup_postdata( $post );
                $classes = '';


                if ( empty( $statsocial_tag_post_thumbnail_default_uri ) && !has_post_thumbnail( $post->ID ) ) {

                    $article_margin = '';
                } elseif ( true == $settings["statsocial_post_thumbnail"] ) {

                    $article_margin = ( int ) $thumbnail_size[0] + 10;

                    $article_margin = 'margin-left:' . $article_margin . 'px!important';
                }



                if ( array_key_exists( 'statsocial_post_thumbnail', $settings ) &&
                        true == $settings["statsocial_post_thumbnail"] &&
                        !post_password_required() ) {

                    $thumbnail = '<span class="statsocial_recent_posts thumb">';

                    if ( has_post_thumbnail( $post->ID ) ) {

                        $thumbnail .= get_the_post_thumbnail( $post->ID, $thumbnail_size, array( "style" => "vertical-align:text-bottom;float:left;", "alt" => esc_attr__( 'tag Post Featured Image', 'statsocial' ) ) );
                    } elseif ( !empty( $statsocial_tag_post_thumbnail_default_uri ) ) {

                        $thumbnail .= '<img src="' . apply_filters( 'statsocial_tag_post_thumbnail_default_uri', $statsocial_tag_post_thumbnail_default_uri ) . '" style="vertical-align:text-bottom;float:left;" width="' . $thumbnail_width . '" height="' . $thumbnail_height . '" alt="' . esc_attr__( 'Recent Post Fallback Image', 'statsocial' ) . '" />';
                    }


                    $thumbnail .= '</span>';
                } else {
                    $thumbnail = '';
                }

                $author         = get_the_author_meta( 'display_name', get_the_author() );
                $post_content   = strip_shortcodes( get_the_content() );
                $list_num_class = 'recent-' . $post->ID;

                $statsocial_now          = ( int ) current_time( 'timestamp' );
                $statsocial_publish_time = ( int ) strtotime( get_the_date() );
                $statsocial_period       = apply_filters( 'statsocial_new_period', 3 );
                $statsocial_Period       = ( int ) 60 * 60 * 24 * $statsocial_period;


                if ( $statsocial_now < $statsocial_Period + $statsocial_publish_time ) {

                    $classes = array( 'statsocial-pub-new ' );
                    $classes = get_post_class( $classes );
                } else {

                    $classes = get_post_class();
                }

                $classes = 'class="' . join( ' ', $classes ) . '"';
                $result .= sprintf( $html, get_permalink( $post->ID ), get_the_title(), $list_num_class, statsocial_doctype_elements( 'div', 'article', false ), $post->ID, $classes, sprintf( '<a href="%1$s" title="%2$s"><%4$s class="entry-date updated" %5$s>%3$s</%4$s></a>&nbsp;', $day_link, esc_attr( 'archives daily ' . mysql2date( get_the_date(), $statsocial_date_format ) ), esc_html( mysql2date( $statsocial_date_format, get_the_date() ) ), statsocial_doctype_elements( 'span', 'time', false ), statsocial_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false )
                        ), sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="vcard:url">%3$s</a></span> ', get_author_posts_url( get_the_author() ), sprintf( esc_attr__( 'View all posts by %s', 'statsocial' ), get_the_author() ), get_the_author()
                        ), wp_html_excerpt( $post_content, $statsocial_excerpt_length, $statsocial_excerpt_more ), $thumbnail, $article_margin
                );




                //$result .= sprintf( '<li><a href="%2$s">%1$s</a></li>', the_title( '', '', false ), get_permalink( ) );
            }
            $result .= sprintf( '</ul>' );
        }
        $result = sprintf( '<div class="%1$s">%2$s</div>', 'statsocial-tag-posts clearfix', $result );
        echo apply_filters( 'statsocial_tag_posts', $result );
        wp_reset_postdata();
    }

}
/**
 *
 *
 *
 *
 */
if ( !function_exists( 'statsocial_monthly_archive_prev_next_navigation' ) ) {

    function statsocial_monthly_archive_prev_next_navigation() {

        global $wpdb, $wp_query;

        if ( is_month() ) {

            $thisyear        = mysql2date( 'Y', $wp_query->posts[0]->post_date );
            $thismonth       = mysql2date( 'm', $wp_query->posts[0]->post_date );
            $unixmonth       = mktime( 0, 0, 0, $thismonth, 1, $thisyear );
            $last_day        = date( 't', $unixmonth );
            $calendar_output = '';

            $previous = $wpdb->get_row( "SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		WHERE post_date < '$thisyear-$thismonth-01'
		AND post_type = 'post' AND post_status = 'publish'
			ORDER BY post_date DESC
			LIMIT 1" );
            $next     = $wpdb->get_row( "SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		WHERE post_date > '$thisyear-$thismonth-{$last_day} 23:59:59'
		AND post_type = 'post' AND post_status = 'publish'
			ORDER BY post_date ASC
			LIMIT 1" );

            $html = '<a href="%1$s" class="%3$s">%2$s</a>';

            if ( $previous ) {

                $calendar_output = sprintf( $html, get_month_link( $previous->year, $previous->month ), sprintf( esc_html__( 'Prev Month(  %sth  )', 'statsocial' ), $previous->month ), 'alignleft' );
            }
            $calendar_output .= "\t";

            if ( $next ) {

                $calendar_output .= sprintf( $html, get_month_link( $next->year, $next->month ), sprintf( esc_html__( 'Next Month(  %sth  )', 'statsocial' ), $next->month ), 'alignright' );
            }
            $html            = '<div class="%1$s">%2$s</div>';
            $calendar_output = sprintf( $html, 'statsocial-monthly-archive-prev-next-avigation', $calendar_output );
            echo apply_filters( 'statsocial_monthly_archive_prev_next_navigation', $calendar_output );
        }
    }

}
/**
 *
 *
 *
 *
 *
 */
if ( !function_exists( 'statsocial_customize_controls_print_styles' ) ) {

    function statsocial_customize_controls_print_styles() {
        ?>
            <style type="text/css">
                #customize-control-statsocial_style_type .customize-control-title + label{

                    background:url( <?php echo get_template_directory_uri() . '/images/screen-shot-dark.png'; ?> );
                    height:200px;
                    display:block;
                    background-position:0px 40px;
                    background-repeat:no-repeat;
                    background-size:cover;
                }
                #customize-control-statsocial_style_type .customize-control-title  + label + label{

                    background:url( <?php echo get_template_directory_uri() . '/images/screen-shot-w3standard.png'; ?> );
                    height:200px;
                    display:block;
                    background-position:0px 40px;
                    background-repeat:no-repeat;
                    background-size:cover;
                }
                #customize-control-statsocial_style_type .customize-control-title  + label +label + label{

                    background:url( <?php echo get_template_directory_uri() . '/images/screen-shot-light.png'; ?> );
                    height:200px;
                    display:block;
                    background-position:0px 40px;
                    background-repeat:no-repeat;
                    background-size:cover;
                }
                #customize-control-statsocial_style_type .customize-control-title  + label +label + label + label{

                    background:url( <?php echo get_template_directory_uri() . '/images/screen-shot-minimal.png'; ?> );
                    height:200px;
                    display:block;
                    background-position:0px 40px;
                    background-repeat:no-repeat;
                    background-size:cover;
                }

            </style>
        <?php
    }

}
/**
 *
 *
 *
 *
 * @since 0.990
 */
if ( class_exists( 'WP_Customize_Control' ) ) {

    class statsocial_Customize_Navigation_Control extends WP_Customize_Control {

        public $type = 'navigation';

        public function render_content() {

            $url                 = admin_url();
            $result              = '<ul class="statsocial-customize-section-content">';
            $result_after        = '</ul>';
            $html_place_holder_s = '<li><h4><a href="%1$s">%2$s</a></h4></li>';
            $html_place_holder_b = '<li><h4><a href="%1$s">%2$s</a>&nbsp;<a href="%1$s" target="_blank">(  ' . esc_html__( 'New window', 'statsocial' ) . '  )</a></h4></li>';
            foreach ( $this->value() as $link ) {

                if ( 'b' == $link['target'] ) {

                    $result .= sprintf( $html_place_holder_b, $url . $link['path'], $link['label'] );
                } else {

                    $result .= sprintf( $html_place_holder_s, $url . $link['path'], $link['label'] );
                }
            }
            $result = $result . $result_after;
            echo $result;
        }

    }

}
/**
 *
 *
 *
 * @since: 0.992
 */
if ( !function_exists( 'statsocial_mobile_meta' ) ) {

    function statsocial_mobile_meta() {
        /* 1.213 remove wp_is_mobile() && works improperly ? */
        if ( 'doc3' == statsocial_warehouse( 'statsocial_page_width' ) ) {
            ?>
                <meta name="viewport" content="width=device-width" />
                <meta name="apple-mobile-web-app-capable" content="yes" />
                <meta name="apple-mobile-web-app-status-bar-style" content="default" />
            <?php
        }
    }

}
/**
 *
 *
 *
 * @since 0.999
 */
if ( !function_exists( 'statsocial_add_class' ) ) {

    function statsocial_add_class( $id = 'yui-u first', $echo = false ) {

        global $rsidebar_show;
        $class                    = '';
        $statsocial_current_column = statsocial_show_one_column();

        if ( 'yui-u first' == $id ) {

            if ( 3 == $statsocial_current_column ) {

                $class = '';
            } elseif ( 1 == $statsocial_current_column ) {

                if ( is_single() or is_page() || false == $rsidebar_show ) {

                    $class = 'statsocial-expand-width';
                }
            } elseif ( $statsocial_current_column == 2 ) {

                if ( is_single() || is_page() || false == $rsidebar_show ) {

                    $class = 'statsocial-expand-width';
                }
            } elseif ( false == $statsocial_current_column ) {

                $check = is_2col_statsocial( 'not-add-class', false );

                if ( false == $check ) {

                    $class = '';
                } elseif ( 'not-add-class' == $check ) {

                    $class = 'statsocial-expand-width';
                } else {

                    $class = '';
                }
            }
        }

        if ( 'yui-b' == $id ) {

            if ( '1' == $statsocial_current_column ) {

                $class = "statsocial-expand-width statsocial-margin-left-none";
            }
        }

        if ( false !== $echo ) {

            if ( !empty( $class ) ) {

                echo ' ' . $class;
            }
        } else {

            if ( !empty( $class ) ) {

                return ' ' . $class;
            } else {

                return;
            }
        }
    }

}
/**
 *
 *
 *
 *
 */
if ( !function_exists( 'statsocial_debug_navitation' ) ) {

    function statsocial_debug_navitation( $template ) {

        if ( true == WP_DEBUG ) {

            echo '<!--' . basename( $template, '.php' ) . '[' . basename( dirname( __FILE__ ) ) . ']-->';
        }
    }

}
/**
 *
 *
 *
 *
 */
if ( !function_exists( 'statsocial_doctype_elements' ) ) {

    function statsocial_doctype_elements( $xhtml, $html5, $echo = true ) {

        global $statsocial_document_type;

        if ( true == $echo ) {

            echo $$statsocial_document_type;
        } else {

            return $$statsocial_document_type;
        }
    }

}
/**
 * Switch elements from div to figure when doctype html5
 *
 *
 * @since 1.003
 */
if ( !function_exists( 'statsocial_img_caption_shortcode_filter' ) ) {

    function statsocial_img_caption_shortcode_filter( $val, $attr, $content = null ) {

        global $statsocial_document_type;
        extract( shortcode_atts( array( 'id' => '', 'align' => '', 'width' => '', 'caption' => '' ), $attr ) );

        if ( 'html5' == $statsocial_document_type ) {

            if ( 1 > ( int ) $width && empty( $caption ) )
                return $val;
            $capid = '';

            if ( $id ) {

                $id    = esc_attr( $id );
                $capid = 'id="figcaption_' . $id . '" ';
                $id    = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
            }
            $html = '<figure %1$s class="wp-caption %2$s" style="width:%3$spx">%4$s<figcaption %5$s class="wp-caption-text">%6$s</figcaption></figure>';
            return sprintf( $html, $id, esc_attr( $align ), ( 10 + ( int ) $width ), do_shortcode( $content ), $capid, $caption );
        }
        return $val;
    }

}
/**
 *
 *
 *
 * @since 1.002
 */
if ( !function_exists( 'statsocial_featured_image' ) ) {

    function statsocial_featured_image() {

        global $post, $is_IE, $statsocial_featured_image_full_size;

        if ( post_password_required() || !has_post_thumbnail() ) {

            return;
        }
        /**
         * Show featured image
         *
         *
         *
         *
         */
        if ( true == $statsocial_featured_image_full_size ) {
            $thumb = get_the_post_thumbnail( $post->ID, 'full' );
        } else {
            $thumb = get_the_post_thumbnail( $post->ID, 'single-post-thumbnail' );
        }

        if ( has_post_thumbnail() && isset( $thumb ) && $is_IE ) {

            /* IE8 img element has width height attribute. and style max-width and height auto makes conflict expand height */
            $thumbnailsrc   = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' );
            $thumbnailuri   = esc_url( $thumbnailsrc[0] );
            $thumbnailwidth = $thumbnailsrc[1];

            if ( $thumbnailwidth > $content_width ) {

                $thumbnailheight = $thumbnailsrc[2];
                $ratio           = round( statsocial_SINGLE_POST_THUMBNAIL_HEIGHT / statsocial_SINGLE_POST_THUMBNAIL_WIDTH, 2 );
                $ie_height       = round( $content_width * $ratio );
                $thumbnail_title = basename( $thumbnailsrc[0] );
                $thumbnail_title = esc_attr( $thumbnail_title );
                $size_attribute  = image_hwstring( $content_width, $ie_height );
                echo '<div class="single-post-thumbnail">';
                echo '<img src="' . $thumbnailuri . '" ' . $size_attribute . '" alt="' . $thumbnail_title . '" />';
                echo '</div>';
            } else {

                echo '<div class="single-post-thumbnail">';
                echo $thumb;
                echo '</div>';
            }
        } else {

            $statsocial_post_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false, '' );
            $flag                         = true;

            if ( 'w3standard' == statsocial_warehouse( 'statsocial_style_type' ) || false == statsocial_USE_FEATURED_IMAGE_LIGHT_BOX ) {

                //Sorry w3standard css can not use CSS3 then remove light box
                $flag = false;
            }

            if ( !empty( $thumb ) ) {

                echo '<div class="single-post-thumbnail">';

                if ( $flag ) {

                    echo '<a href="#statsocial-light-box" class="statsocial-light-box">';
                } else {

                    printf( '<a href="%1$s">', get_attachment_link( get_post_thumbnail_id() ) );
                }
                echo $thumb;

                if ( $flag ) {

                    echo '</a>';
                }
                echo '</div>';
                /* for light box */
                if ( $flag ) {

                    echo '<div class="statsocial-lightbox-overlay" id="statsocial-light-box">';
                    echo '<a href="#page" class="lb-close">Close</a>';
                    echo '<img src="' . $statsocial_post_thumbnail_src[0] . '" alt="single post thumbnail" />';
                    echo '</div>';
                }
            }
        }
        /**
         * Add navigation link for post thumbnail
         *
         *
         *
         *
         */
        if ( has_post_thumbnail() && true == statsocial_USE_FEATURED_IMAGE_LIGHT_BOX ) {

            $statsocial_html_piece = '<p style="text-align:center;font-size:small;"><a href="%1$s">%2$s</a></p>';
            printf( $statsocial_html_piece, get_attachment_link( get_post_thumbnail_id() ), esc_html__( 'Go to Attachment page', 'statsocial' ) );
        }
    }

}
/**
 * statsocial loop class
 *
 *
 *
 *
 * ver 1.001
 */
if ( !function_exists( 'statsocial_loop_class' ) ) {

    function statsocial_loop_class( $statsocial_loop_number, $statsocial_tile_post_id = '', $add_class = '' ) {

        if ( is_front_page() || is_home() ) {

            $id            = get_option( 'page_on_front' );
            $template_name = basename( get_page_template_slug( $id ), '.php' );
        } elseif ( is_page() ) {

            global $template;
            $template_name = basename( $template, '.php' );
        } else {

            $template_name = '';
        }
        $str_class            = '';
        $statsocial_background = '';

        if ( is_array( $add_class ) ) {

            foreach ( $add_class as $class ) {

                $str_class = ' ' . $class;
            }
        } else {

            $str_class = ' ' . $add_class;
        }
        $post_formats = get_post_format_slugs();

        foreach ( $post_formats as $key => $val ) {

            if ( has_post_format( $val ) ) {

                $str_class .= ' loop-post-format-' . $val;
            }
        }
        $statsocial_loop_five = $str_class;

        //	if ( 'front-portfolio' == $template_name ) {

        if ( 12 == $statsocial_loop_number ) {

            $statsocial_loop_number = 0;
        } elseif ( 0 == $statsocial_loop_number % 5 ) {

            $statsocial_loop_five .= ' loop-five';
        }

        if ( !empty( $statsocial_tile_post_id ) ) {

            $post_thumbnail_id    = get_post_thumbnail_id( $statsocial_tile_post_id );
            $statsocial_background = wp_get_attachment_image_src( $post_thumbnail_id, 'none' );

            list( $statsocial_background, $width, $height ) = $statsocial_background;
        } else {
            $statsocial_background = false;
        }

        if ( !$statsocial_background ) {

            $statsocial_loop_five .= ' loop-item-show-allways';
        } else {

            $statsocial_background = 'style="background:url(  ' . $statsocial_background . '  );background-size:cover;"';
        }
        //	}
        return array( $statsocial_loop_number, $statsocial_loop_five, $statsocial_background );
    }

}
/**
 *
 *
 *
 * @since 1.103
 */
add_action( 'set_current_user', 'statsocial_postmeta_cap' );

if ( !function_exists( 'statsocial_postmeta_cap' ) ) {

    function statsocial_postmeta_cap() {

        if ( current_user_can( 'edit_pages' ) && statsocial_CUSTOM_FIELD_CSS == true ) {

            add_filter( 'auth_post_meta_css', '__return_true', 5 );
        } else {

            add_filter( 'auth_post_meta_css', '__return_false', 5 );
        }

        if ( current_user_can( 'edit_pages' ) && statsocial_CUSTOM_FIELD_SCRIPT == true ) {

            add_filter( 'auth_post_meta_javascript', '__return_true', 5 );
        } else {

            add_filter( 'auth_post_meta_javascript', '__return_false', 5 );
        }
        if ( current_user_can( 'edit_pages' ) && statsocial_CUSTOM_FIELD_META == true ) {

            add_filter( 'auth_post_meta_meta', '__return_true', 5 );
        } else {

            add_filter( 'auth_post_meta_meta', '__return_false', 5 );
        }
    }

}
/**
 *
 *
 *
 *
 * @since 1.111
 */
if ( !class_exists( 'statsocial_unique_identifier_walker_nav_menu' ) ) {

    class statsocial_unique_identifier_walker_nav_menu extends Walker_Nav_Menu {

        function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            global $wp_query;

            $classes     = empty( $item->classes ) ? array() : ( array ) $item->classes;
            $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

            // build html
            $output .= '<li id="nav-menu-item-' . $item->ID . '" class="' . $class_names . '">';

            // link attributes
            $attributes = !empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
            $attributes .=!empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
            $attributes .=!empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
            $attributes .=!empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

            $item_id = url_to_postid( $item->url );

            if ( $item_id == 0 ) {
                
            } else {

                $item->title = $item->title;
                $item->title = sprintf( '<span class="statsocial_unique_identifier">[Link to %1$s]</span>%2$s', $item_id, $item->title );
            }

            $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s', !empty( $args->before ) ? $args->before : '', $attributes, !empty( $args->link_before ) ? $args->link_before : '', apply_filters( 'statsocial_nav_menu_title', $item->title, $item->ID ), !empty( $args->link_after ) ? $args->link_after : '', !empty( $args->after ) ? $args->after : ''
            );

            // build html
            $output .= apply_filters( 'statsocial_unique_identifier_walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }

    }

}
/**
 *
 *
 *
 *
 * 
 */
if ( !function_exists( 'statsocial_nav_menu_primary' ) ) {

    function statsocial_nav_menu_primary( $args = array() ) {
        global $statsocial_link_unique_text;

        $defaults = array(
            'theme_location'    => 'primary',
            'menu'              => '',
            'container'         => 'div',
            'container_class'   => 'menu-header',
            'container_id'      => '',
            'menu_class'        => 'menu',
            'menu_id'           => '',
            'echo'              => false,
            'fallback_cb'       => 'wp_page_menu',
            'before'            => '',
            'after'             => '',
            'link_before'       => '',
            'link_after'        => '',
            'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth'             => 0,
            'walker'            => '',
            'wrap_element_id'   => 'access',
            'wrap_mobile_class' => 'statsocial-mobile-menu',
        );

        $args = wp_parse_args( $args, $defaults );
        $args = apply_filters( 'wp_nav_menu_args', $args );

        if ( "show" == statsocial_warehouse( 'statsocial_show_menu_primary' ) ) {

            if ( $statsocial_link_unique_text == true ) {

                $args['walker']             = new statsocial_unique_identifier_walker_nav_menu();
                $statsocial_nav_menu_primary = wp_nav_menu( $args );
            } else {

                $statsocial_nav_menu_primary = wp_nav_menu( $args );
            }

            $template = '<p class="' . $args['wrap_mobile_class'] . '">
                            <a href="#access" class="open"><span class="statsocial-nav-menu-expand" title="nav menu expand">Expand</span></a><span class="menu-text">menu</span>
                            <a href="#%1$s" class="close"><span class="statsocial-nav-menu-shrunk" title="nav menu shrunk">Shrunk</span></a>
                             </p>
                            <%3$s id="' . esc_attr( $args['wrap_element_id'] ) . '">
                            %2$s
                            </%3$s>
                            <br class="clear" />';

            do_action( 'statsocial_nav_menu_primary' );
            $html = sprintf( $template, esc_attr( statsocial_warehouse( 'statsocial_page_width' ) ), $statsocial_nav_menu_primary, statsocial_doctype_elements( 'div', 'nav', false ) );
            echo apply_filters( 'statsocial_nav_menu_primary_html', $html );
        } //statsocial_warehouse(  'statsocial_show_menu_primary'  )
    }

}

/**
 *
 *
 *
 *
 * @since 0.48
 */
if ( !function_exists( 'statsocial_post_class' ) ) {

    function statsocial_post_class( $class = '', $post_id = null, $echo = true ) {

        global $post;
        $classes = get_post_class( $class, $post_id );

        if ( is_sticky() ) {

            $classes[] = 'statsocial-sticky';
        }
        $statsocial_content_empty_class = trim( get_the_content() );

        if ( empty( $statsocial_content_empty_class ) ) {

            $classes[] = 'statsocial-empty-content';
        }
        $statsocial_title_empty_class = trim( the_title( '', '', false ) );

        if ( empty( $statsocial_title_empty_class ) ) {

            $classes[] = 'statsocial-empty-title';
        }
        $statsocial_now           = current_time( 'timestamp' );
        $statsocial_publish_time  = get_the_time( 'U' );
        $statsocial_modified_time = get_the_modified_time( 'U' );
        $statsocial_period        = apply_filters( 'statsocial_new_period', 3 );
        $statsocial_Period        = 60 * 60 * 24 * $statsocial_period;

        if ( $statsocial_now < $statsocial_Period + $statsocial_publish_time ) {

            $classes[] = 'statsocial-pub-new ';
        }

        if ( $statsocial_now < $statsocial_Period + $statsocial_modified_time ) {

            $classes[] = 'statsocial-mod-new';
        }
        $classes = array_map( 'esc_attr', $classes );

        if ( true == $echo ) {

            echo 'class="' . join( ' ', $classes ) . '"';
        } else {

            return 'class="' . join( ' ', $classes ) . '"';
        }
    }

}
/**
 *
 *
 *
 *
 * @since 1.111
 */
add_filter( 'the_content', 'statsocial_chat_filter' );

if ( !function_exists( 'statsocial_chat_filter' ) ) {

    function statsocial_chat_filter( $contents ) {

        if ( !has_post_format( 'chat' ) ) {

            return $contents;
        } else {

            /* chat notation use : remove protocol from url */
            $contents = str_replace( array( 'http:', 'https:' ), '', $contents );
        }
        $new_contents = explode( '<p>', $contents );

        if ( 2 == count( $new_contents ) ) {

            return $contents;
        }
        $result         = '';
        $prev_author_id = '';
        $html           = '<dt class="statsocial-chat statsocial-chat-author-%1$s">%2$s</dt><dd class="statsocial-chat-text statsocial-chat-author-text-%1$s">%3$s</dd>';

        foreach ( $new_contents as $key => $new ) {

            preg_match( '|([^\:]+)(\:)(.+)|si', $new, $regs );

            if ( isset( $regs[1] ) && !empty( $regs[1] ) ) {

                $regs[1] = strip_tags( $regs[1] );
            }

            if ( isset( $regs[1] ) && !preg_match( '!(http|https|ftp)!', $regs[1] ) && !empty( $regs[1] ) ) {

                $result .= sprintf( $html, esc_attr( statsocial_chat_author_id( $regs[1] ) ), esc_html( $regs[1] ), $regs[3] );
            } else {

                $result .= '<dd>' . $new . '</dd>';
            }
        }
        return apply_filters( 'statsocial_chat_filter', sprintf( '<dl class="statsocial-post-format-chat">%1$s</dl>', $result ) );
    }

}
/**
 *
 *
 *
 *
 * @since 1.111
 */
if ( !function_exists( 'statsocial_chat_author_id' ) ) {

    function statsocial_chat_author_id( $author ) {

        static $statsocial_chat_author_id = array();
        $statsocial_chat_author_id[]      = $author;
        $statsocial_chat_author_id        = array_unique( $statsocial_chat_author_id );
        return array_search( $author, $statsocial_chat_author_id );
    }

}

/**
 *
 *
 *
 *
 * @since 1.116
 */
function do_not_cache_feeds( $feed ) {
    $feed->enable_cache( false );
}

add_action( 'wp_feed_options', 'do_not_cache_feeds' );


if ( !function_exists( 'statsocial_link_unique' ) ) {

    function statsocial_link_unique( $text = '', $id = 0, $class = 'statsocial_unique_identifier' ) {

        global $statsocial_link_unique_text;

        if ( true == $statsocial_link_unique_text && !is_admin() ) {

            $html = '<span class="%1$s">[%2$s %3$s]</span>';
            $html = sprintf( $html, esc_attr( $class ), esc_attr( $text ), ( int ) $id );
            return apply_filters( 'statsocial_link_unique', $html, $text, $id, $class );
        }
        return;
    }

}
/**
 *
 *
 *
 *
 * @since 1.118
 */
if ( !function_exists( 'statsocial_counter' ) ) {

    function statsocial_counter() {

        static $count = 1;
        return $count++;
    }

}
/**
 *
 *
 *
 *
 * @since 1.118
 */
if ( !function_exists( 'statsocial_accessible_titled' ) ) {

    function statsocial_accessible_titled( $link ) {

        /* care for screen reader */
        $link = str_replace( array( "title='", 'title="' ), array( "title='Archives ", 'title="Archives ' ), $link );
        return $link;
    }

}
/**
 *
 *
 *
 *
 * @since 1.118
 */
add_filter( 'image_send_to_editor', 'statsocial_remove_category_rel' );

if ( !function_exists( 'statsocial_remove_category_rel' ) ) {

    function statsocial_remove_category_rel( $output ) {

        $output = preg_replace( '!( rel="[^"]+")!', '', $output );
        return $output;
    }

}
add_filter( 'widget_posts_args', 'statsocial_remove_sticky_link_from_recent_post_widget' );

if ( !function_exists( 'statsocial_remove_sticky_link_from_recent_post_widget' ) ) {

    function statsocial_remove_sticky_link_from_recent_post_widget( $args ) {

        $args['post__not_in'] = get_option( 'sticky_posts' );
        return $args;
    }

}
/**
 * Entry title none breaking text breakable
 *
 *
 * test filter.
 * @since 1.119
 */
add_filter( 'the_title', 'statsocial_non_breaking_title' );

if ( !function_exists( 'statsocial_non_breaking_title' ) ) {

    function statsocial_non_breaking_title( $title ) {

        global $statsocial_document_type;
        //Floccinaucinihilipilification

        if ( !is_admin() && 'html5' == $statsocial_document_type ) {

            if ( preg_match( "/[\x20-\x7E]{30,}/", strip_tags( $title ) ) && preg_match( '!([A-Z])!', $title ) ) {

                return preg_replace( '!([A-Z])!', '<wbr>$1', $title );
            } elseif ( preg_match( "/[\x20-\x7E]{30,}/", strip_tags( $title ) ) ) {

                return preg_replace( '!([A-Z])!', '$1<wbr>', $title );
            }
        }
        return $title;
    }

}
/** statsocial_non_breaking_title() assist function
 * remove wbr escaped elements when another plugin escape title
 *
 *
 */
add_filter( 'esc_html', 'remove_wbr', 999 );

function remove_wbr( $content ) {

    return str_replace( array( '&lt;wbr&gt;', '&lt;/wbr&gt;' ), '', $content );
}

/**
 * Entry content none breaking text (  url  ) breakable
 *
 *
 * test filter.
 * @since 1.119
 */
add_filter( 'the_content', 'statsocial_non_breaking_content', 11 );

if ( !function_exists( 'statsocial_non_breaking_content' ) ) {

    function statsocial_non_breaking_content( $content ) {

        global $statsocial_document_type;
        //long url link text breakable

        if ( !is_admin() && 'html5' == $statsocial_document_type ) {

            return preg_replace_callback( "|>([-_.!˜*\'()a-zA-Z0-9;\/?:@&=+$,%#]{30,})<|", 'statsocial_add_wbr_content_long_text', $content );
        }
        return $content;
    }

}

if ( !function_exists( 'statsocial_add_wbr_content_long_text' ) ) {

    function statsocial_add_wbr_content_long_text( $matches ) {

        foreach ( $matches as $match ) {

            return preg_replace( '!([/])!', '$1<wbr>', $match );
        }
    }

}

if ( !function_exists( 'statsocial_poster' ) ) {

    function statsocial_poster( $args ) {

        $args_count = count( $args );
        $html       = '<a href="%1$s" title="link to %2$s" class="page-featured-template">%3$s</a>';
        for ( $i = 0; $i < $args_count; $i++ ) {
            echo '<div class="line poster-row-' . ($i + 1) . '">';

            foreach ( $args[$i] as $key => $page_item ) {

                echo '<div class="' . $page_item['class'] . ' poster-col-' . ( $key + 1 ) . ' ' . esc_attr( $page_item['type'][0] ) . ' ">';

                do_action( 'statsocial_poster_before_' . ($i + 1) . '_' . ( $key + 1 ) );

                if ( 'include' == $page_item['type'][0] ) {

                    if ( is_string( $page_item['type'][1] ) ) {

                        locate_template( array( $page_item['type'][1] ), true, true );
                    } elseif ( is_array( $page_item['type'][1] ) ) {

                        locate_template( $page_item['type'][1], true, true );
                    }
                }

                if ( 'widget' == $page_item['type'][0] ) {

                    the_widget( $page_item['type'][1], $page_item['type'][2], $page_item['type'][3] );
                }

                if ( 'page' == $page_item['type'][0] || 'post' == $page_item['type'][0] ) {
                    ?>
                        <<?php statsocial_doctype_elements( 'div', 'article' ); ?> id="post-<?php echo esc_attr( $page_item['type'][1] ); ?>" <?php statsocial_post_class( array( 'clearfix' ) ); ?>>
                        <?php
                        if ( is_numeric( $page_item['type'][1] ) ) {

                            $content = get_post( $page_item['type'][1] );

                            if ( !is_null( $content ) ) {

                                $thumnail_exists = $content->__get( '_thumbnail_id' );
                                $title           = $content->post_title;
                                $link            = get_permalink( $page_item['type'][1] );
                                $image           = get_the_post_thumbnail( $page_item['type'][1] );

                                if ( empty( $thumnail_exists ) ) {

                                    printf( '<h2 class="entry-title page-featured-template">' . $html . '</h2>', $link, esc_attr( strip_tags( $title ) ), $title );

                                    echo apply_filters( 'the_content', statsocial_add_more( $page_item['type'][1], $content->post_content ) );
                                } else {

                                    $image = get_the_post_thumbnail( $page_item['type'][1] );
                                    printf( $html, $link, esc_attr( $title ), $image );
                                }
                            }
                        } elseif ( is_array( $page_item['type'][1] ) ) {

                            foreach ( $page_item['type'][1] as $id ) {

                                $content = get_post( $id );

                                if ( !is_null( $content ) ) {

                                    $title           = get_the_title( $id );
                                    $link            = get_permalink( $id );
                                    $thumnail_exists = $content->__get( '_thumbnail_id' );

                                    if ( empty( $thumnail_exists ) ) {

                                        printf( '<h2 class="entry-title page-featured-template">' . $html . '</h2>', $link, esc_attr( strip_tags( $title ) ), $title );


                                        echo apply_filters( 'the_content', statsocial_add_more( $id, $content->post_content ) );
                                    } else {

                                        $image = get_the_post_thumbnail( $id );
                                        printf( $html, $link, esc_attr( $title ), $image );
                                    }
                                }
                            }
                        }
                        ?>
                        </<?php statsocial_doctype_elements( 'div', 'article' ); ?>>
                        <?php
                    }
                    do_action( 'statsocial_poster_after_' . ($i + 1) . '_' . ( $key + 1 ) );
                    echo '</div>';
                }
                echo '</div>';
            }
        }

    }
    /**
     * comment list class
     *
     *
     * since 1.136
     */
    if ( !function_exists( 'statsocial_comment_class' ) ) {

        function statsocial_comment_class( $comment_class = array(), $add_start_attribute = true ) {

            $comment_class[] = 'commentlist';
            $comment_page    = get_query_var( 'cpage' );

            if ( is_numeric( $comment_page ) ) {

                $comment_class[] = esc_attr( sprintf( 'comments-p%1$d', $comment_page ) );
            } else {

                $comment_page = '';
            }
            printf( 'class="%1$s"', join( ' ', $comment_class ) );

            if ( $add_start_attribute && !empty( $comment_page ) ) {

                $comment_per_page = get_option( 'comments_per_page' );
                $comment_page     = $comment_page - 1;
                $start            = ( $comment_page * $comment_per_page ) + 1;
                printf( ' start="%1$d"', $start );
            }
        }

    }
    /**
     *
     *
     *
     * since 1.136
     */
    if ( !function_exists( 'statsocial_filter_header_text_color' ) ) {

        function statsocial_filter_header_text_color( $color ) {

            global $statsocial_fallback_human_interface_show;

            if ( true == $statsocial_fallback_human_interface_show ) {

                return 'blank';
            }
            return $color;
        }

    }
    /**
     *
     *
     *
     * @since 1.148
     */
    if ( !function_exists( 'statsocial_list_of_posts' ) ) {

        function statsocial_list_of_posts() {

            global $statsocial_list_of_posts_per_page;
            global $statsocial_list_of_posts_length;
            global $statsocial_list_of_posts_more;
            global $statsocial_list_of_posts_use_toggle;

            $query = get_query_var( 'paged' );


            if ( !isset( $statsocial_list_of_posts_per_page ) ) {

                $statsocial_list_of_posts_per_page = get_option( 'posts_per_page' );
            }
            if ( !isset( $statsocial_list_of_posts_excerpt_length ) ) {

                $statsocial_list_of_posts_length = 200;
            }

            if ( !isset( $statsocial_list_of_posts_excerpt_more ) ) {

                $statsocial_list_of_posts_more = '[...]';
            }
            if ( !isset( $statsocial_list_of_posts_use_toggle ) ) {

                $statsocial_list_of_posts_use_toggle = true;
            }


            if ( !isset( $statsocial_list_of_posts_per_page ) ) {

                $statsocial_list_of_posts_per_page = get_option( 'posts_per_page' );
            }

            if ( $query == 0 ) {

                $start = 1;
            } else {

                $start = ($query - 1) * $statsocial_list_of_posts_per_page + 1;
            }

            $statsocial_args               = array( 'post_status'   => 'publish',
                'post_per_page' => $statsocial_list_of_posts_per_page,
                'paged'         => $query,
            );
            $statsocial_list_of_post_query = new WP_Query( $statsocial_args );

            if ( $statsocial_list_of_post_query->have_posts() ) {
                ?>
                <ol start="<?php echo $start; ?>" class="list-of-post-list">
                <?php
                while ( $statsocial_list_of_post_query->have_posts() ) {

                    $statsocial_list_of_post_query->the_post();
                    $statsocial_list_of_posts_empty_flag = false;
                    ?>
                        <li id="post-<?php the_ID(); ?>" <?php statsocial_post_class( 'list-of-post-items' ); ?>>
                        <?php
                        statsocial_entry_title();
                        ?>
                            <ul class="list-of-post-toggle">
                            <?php
                            $statsocial_list_of_posts_excerpt    = apply_filters( 'the_content', get_the_content() );
                            $statsocial_list_of_posts_excerpt    = preg_replace( '!\[[^\]]*\]!', '', $statsocial_list_of_posts_excerpt );

                            if ( empty( $statsocial_list_of_posts_excerpt ) ) {
                                $statsocial_list_of_posts_excerpt    = esc_html__( 'Empty content', 'statsocial' );
                                $statsocial_list_of_posts_empty_flag = true;
                            }
                            $statsocial_list_of_posts_contents = $statsocial_list_of_posts_excerpt;
                            $statsocial_list_of_posts_excerpt  = wp_html_excerpt( $statsocial_list_of_posts_excerpt, $statsocial_list_of_posts_length, $statsocial_list_of_posts_more );

                            if ( $statsocial_list_of_posts_use_toggle == true ) {

                                $statsocial_toggle_title_class   = 'statsocial-toggle statsocial-toggle-title';
                                $statsocial_toggle_content_class = 'statsocial-toggle';
                            } else {

                                $statsocial_toggle_title_class   = 'no-toggle-title';
                                $statsocial_toggle_content_class = 'no-toggle-content';
                            }

                            if ( $statsocial_list_of_posts_empty_flag == true ) {

                                $statsocial_toggle_title_class   = 'no-toggle-title';
                                $statsocial_toggle_content_class = 'no-toggle-content';
                            }

                            printf( '<li class="%1$s">', $statsocial_toggle_title_class );

                            echo $statsocial_list_of_posts_excerpt;

                            if ( $statsocial_list_of_posts_use_toggle == true and $statsocial_list_of_posts_empty_flag == false ) {

                                printf( '</li><li class="%1$s">', $statsocial_toggle_content_class );
                                echo $statsocial_list_of_posts_contents;
                            }
                            ?>
                        </li>
                    </ul>
                    <div class="list-of-post-edit-link">
                <?php
                statsocial_delete_post_link( __( 'Trash', 'statsocial' ), '<span class="delete-link">', '</span>' );

                edit_post_link( __( 'Edit', 'statsocial' ), '<span class="edit-link">', '</span>' );
                ?>
                    </div>
                </li>
                        <?php
                    } //end while

                    wp_reset_postdata();
                    ?>
            </ol>

            <?php
        } //end have_posts
        ?>
        <div class="list-of-post-next-prev">
            <div class="left">
        <?php
        next_posts_link( __( '&laquo; Older Entries', 'statsocial' ), $statsocial_list_of_post_query->max_num_pages )
        ?>
            </div>
            <div class="right">
                <?php
                previous_posts_link( __( 'Newer Entries &raquo;', 'statsocial' ), $statsocial_list_of_post_query->max_num_pages )
                ?>
            </div>

        </div>
        <?php
    }

}

if ( !function_exists( 'statsocial_tile' ) ) {

    function statsocial_tile( $args = array() ) {

        global $query_string;

        $defaults      = array(
            'posts_per_page'     => 3,
            'numberposts'        => -1,
            'orderby'            => 'post_date',
            'order'              => 'DESC',
            'post_type'          => 'post',
            /* 'meta_key'        => '_thumbnail_id', */
            'post_status'        => 'publish',
            'post__not_in'       => get_option( 'sticky_posts' ),
            'statsocial_tile_col' => 3,
        );
        $args          = wp_parse_args( $args, $defaults );
        $args['paged'] = get_query_var( 'page' );

        if ( !isset( $args['paged'] ) ) {

            $args['paged'] = 1;
        }
        if ( $args['paged'] > 0 ) {

            $args['offset'] = ( $args['paged'] - 1 ) * $args['posts_per_page'];
        } else {

            $args['offset'] = 0;
        }

        $statsocial_posts     = get_posts( $args );
        $statsocial_html_page = '<li><a href="%1$s" class="%2$s"><span class="%3$st">%4$s</span></a></li>';

        if ( !empty( $statsocial_posts ) ) {
            ?><div id="portfolio" class="portfolio column-<?php echo $args['statsocial_tile_col']; ?>"><?php
            do_action( 'statsocial_tile_pre' );

            statsocial_loop_title();
            $statsocial_loop_number = 1;

            foreach ( $statsocial_posts as $post ) {

                setup_postdata( $post );
                $statsocial_loop_class = statsocial_loop_class( $statsocial_loop_number, $post->ID );

                printf( '<li class="loop-%1$s%2$s" %3$s>', trim( $statsocial_loop_class[0] ), apply_filters( 'statsocial_tile_class', ' ' . trim( $statsocial_loop_class[1] ), $post->ID ), apply_filters( 'statsocial_tile_style', $statsocial_loop_class[2], $post->ID )
                );

                $statsocial_loop_number++;
                ?><<?php statsocial_doctype_elements( 'div', 'article' ); ?> id="post-tile-<?php echo $post->ID; ?>" <?php statsocial_post_class( '', $post->ID ); ?> >
                    <span class="entry-title"><a href="<?php echo get_permalink( $post->ID ); ?>">
                <?php
                    $title = get_the_title( $post->ID );
                    $title = wp_html_excerpt( $title, apply_filters( 'statsocial_tile_title_length', 40 ), apply_filters( 'statsocial_tile_title_more', '...' ) );

                    echo statsocial_fallback_title( $title, $post->ID );
                    ?></a></span>
                    <div class="posted-on">
                            <?php statsocial_posted_on(); ?>
                    </div>
                    <div class="entry-content clearfix">
                        <a href="<?php echo get_comments_link( $post->ID ); ?>" class="statsocial-comment-link"><span class="statsocial-comment-string point"></span><em><?php esc_html_e( 'Comment', 'statsocial' ); ?></em></a>
                    </div>
                    <div class="entry-meta">
                <?php edit_post_link( esc_html__( 'Edit', 'statsocial' ) . statsocial_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>', $post->ID ); ?>
                    </div>
                    <br class="clear" />
                    </<?php statsocial_doctype_elements( 'div', 'article' ); ?>>
                </li>
            <?php }//foreach( $statsocial_posts as $post )           ?>
            </ul>
            <br class="clear" />
            <?php
            $html = '';

            if ( 0 == $args['paged'] ) {

                if ( is_front_page() ) {

                    $url  = add_query_arg( 'page', 2 ) . '#portfolio';
                    $html = '<li><a href="' . esc_url( $url ) . '" title="page 2" class="portfolio-page2">' . esc_html__( 'Page', 'statsocial' ) . '2</a></li>';
                } else {

                    $url  = add_query_arg( 'page', 2 ) . '#portfolio';
                    $html = '<li><a href="' . esc_url( $url ) . '" title="page 2" class="portfolio-page2">' . esc_html__( 'Page', 'statsocial' ) . '2</a></li>';
                }
            } elseif ( $args['paged'] > 0 ) {

                $page = $args['paged'] + 1;
                $url  = add_query_arg( 'page', $page ) . '#portfolio';
                $html = sprintf( $statsocial_html_page, esc_url( $url ), 'portfolio-next portfolio-' . $page, 'portfolio-nav-next', esc_html__( 'Page', 'statsocial' ) . ' ' . $page
                );
            }

            if ( $args['paged'] > 0 ) {

                $url = add_query_arg( 'page', $args['paged'] ) . '#portfolio';
                $html .= sprintf( $statsocial_html_page, esc_url( $url ), 'portfolio-current current-' . $args['paged'], 'portfolio-nav-current', esc_html__( 'Now Page', 'statsocial' ) . ' ' . $args['paged']
                );
            }

            if ( 2 == $args['paged'] ) {

                $page = $args['paged'] - 1;
                $url  = add_query_arg( 'page', $page ) . '#portfolio';
                $html .= sprintf( $statsocial_html_page, esc_url( $url ), 'portfolio-prev portfolio-home', 'portfolio-nav-prev', __( 'Portfolio Home', 'statsocial' )
                );
            } elseif ( $args['paged'] > 2 ) {

                $page = $args['paged'];
                $page = $page - 1;
                $url  = add_query_arg( 'page', $page ) . '#portfolio';
                $html .= sprintf( $statsocial_html_page, esc_url( $url ), 'portfolio-prev portfolio-' . $page, 'portfolio-nav-prev', esc_html__( 'Page', 'statsocial' ) . ' ' . $page
                );
            }

            echo apply_filters( 'statsocial_portfolio_nav', sprintf( '<div class="portfolio-nav"><ul>%1$s</ul></div>', $html ) );
        } else { //! empty( $statsocial_posts )
            ?><div><<?php statsocial_doctype_elements( 'div', 'article' ); ?> id="post-<?php the_ID(); ?>" <?php statsocial_post_class( 'no-portfolio' ); ?> ><?php
            $url                 = remove_query_arg( 'page' );
            $statsocial_html_page = '<p style="text-align:center;"><a href="%1$s" class="%2$s" ><span class="%3$st">%4$s</span></a></p>';
            if ( preg_match( '!page=!', $query_string ) ) {
                ?><h3 style="text-align:center" class="h1 portfolio-navigation-last">End</h3><?php
                    echo apply_filters( 'statsocial_portfolio_nav', sprintf( $statsocial_html_page, esc_url( $url ), 'portfolio-home', 'portfolio-home-text', esc_html__( 'Portfolio Home', 'statsocial' )
                    ) );
                }
                echo apply_filters( 'statsocial_portfolio_nav', sprintf( $statsocial_html_page, home_url(), 'portfolio blog-home-link', 'portfolio-nav', esc_html__( 'Home', 'statsocial' )
                ) );
                ?></<?php statsocial_doctype_elements( 'div', 'article' ); ?>><?php
            }
            wp_reset_postdata();
            do_action( 'statsocial_tile_after' );
            ?>
        </div>
            <?php
        }

    }
    /**
     *
     *
     *
     * @since 1.150
     */
    if ( !function_exists( 'statsocial_add_more' ) ) {

        function statsocial_add_more( $id, $content, $more_link_text = null ) {

            global $multipage, $page;


            $pre   = apply_filters( 'statsocial_add_more_before', '' );
            $after = apply_filters( 'statsocial_add_more_after', '' );
            $html  = ' <div class="statsocial-more-wrapper">' . $pre . '<a href="%1$s%2$s" class="poster-more-link">%3$s</a>' . $after . '</div>';
            if ( empty( $more_link_text ) ) {

                $more_link_text = esc_html__( 'Continue&nbsp;reading ', 'statsocial' ) . '<span class="meta-nav">&rarr;</span><span class="more-link-post-unique">' . esc_html__( '&nbsp;Post ID&nbsp;', 'statsocial' ) . $id . '</span>';
            }
            $output       = '';
            $strip_teaser = false;
            $more         = false;

            if ( preg_match( '/<!--noteaser-->/', $content, $matches ) ) {

                $fragment_identifier = '';
            } else {

                $fragment_identifier = '#more-' . $id;
            }

            if ( preg_match( '/<!--more(.*?)?-->/', $content, $matches ) ) {

                $content = explode( $matches[0], $content, 2 );

                if ( !empty( $matches[1] ) ) {

                    $more_link_text = esc_html( $matches[1] );
                }

                if ( !empty( $matches[1] ) && !empty( $more_link_text ) ) {
                    $more_link_text = strip_tags( wp_kses_no_null( trim( $matches[1] ) ) );
                }
                $more = true;
            }

            if ( is_array( $content ) ) {

                $content = $content[0];
                $content .= apply_filters( 'the_content_more_link', sprintf( $html, get_permalink( $id ), $fragment_identifier, $more_link_text
                        ), $more_link_text
                );

                $content = force_balance_tags( $content );

                return apply_filters( 'statsocial_add_more', $content, $more );
            } else {

                return apply_filters( 'statsocial_add_more', $content, $more );
            }
        }

    }
    /**
     *
     *
     *
     * @since 1.211
     */
    if ( !function_exists( 'statsocial_status_bar' ) ) {

        function statsocial_status_bar() {
            global $statsocial_status_bar, $post;
            if ( $statsocial_status_bar !== true ) {

                return;
            }
            ?>
        <div id="statsocial_status_bar">
        <?php
        do_action( 'statsocial_status_bar_before' );
        $link_to_top = '<p class="move-to-top"><a href="#">top</a></p>';
        echo apply_filters( 'statsocial_status_bar_top', $link_to_top );

        statsocial_monthly_archive_prev_next_navigation();
        ?> 
            <div class="statsocial-next-prev-links">
            <?php statsocial_next_prev_links( 'nav-status-bar' ); ?>
            </div>   
            <div class="statsocial_prev_next_post">
                <?php
                if ( is_single() ) {
                    statsocial_prev_next_post( 'nav-status-bar' );
                }
                ?>
            </div>
            <div class="child-pages">

        <?php
        $args = array(
            'post_type'   => 'page',
            'post_status' => 'publish',
            'numberposts' => -1,
            'order'       => 'ASC',
            'orderby'     => 'post_title',
            'post_parent' => $post->ID, );

        $html = '<a href="%1$s">%2$s</a>';

        $child_pages = query_posts( $args );

        if ( $child_pages ) {

            $number = count( $child_pages );
            ?>
                    <span class="status-bar-page-title"><?php echo _nx( 'Child Page : ', 'Child Pages : ', $number, '', 'statsocial' ); ?></span>
                    <?php
                    foreach ( $child_pages as $child ) {
                        $permalink = apply_filters( 'the_permalink', get_permalink( $child->ID ) );
                        $title     = apply_filters( 'the_title', $child->post_title );

                        printf( $html, $permalink, $title );

                        if ( end( $child_pages ) !== $child ) {

                            echo ' , ';
                        }
                    }
                }
                wp_reset_query();
                ?>
            </div>
                <?php do_action( 'statsocial_status_bar_after' ); ?>   
        </div>
            <?php
        }

    }
    /**
     *
     *
     *
     * @since 1.138
     */
    do_action( 'statsocial_last' );
    ?>