<?php

/**
 * statsocial default settings and display the admin option panel.
 *
 * this scripts moved from functions.php 0.929
 *
 * @package WordPress
 * @subpackage statsocial
 */
if ( !defined( 'ABSPATH' ) ) {

    exit;
}
if ( ! isset( $statsocial_base_setting_args ) ) {
$statsocial_base_setting_args = array(
    array( 'option_id'    => 1,
        'blog_id'      => 0,
        'option_name'  => "statsocial_color_scheme",
        'option_value' => "statsocial_color_ja",
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Color Scheme', 'statsocial' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Please choose the naming convention for the color list', 'statsocial' ),
        'validate'     => 'statsocial_color_scheme_validate', 'list'         => 12 ),
    array( 'option_id'    => 2,
        'blog_id'      => 0,
        'option_name'  => "statsocial_base_color",
        'option_value' => "#444444",
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Base Color for Automatic Color Arrangement', 'statsocial' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Please specify your favorite color. and an automatic arrangement of color is designed.', 'statsocial' ),
        'validate'     => 'statsocial_base_color_validate',
        'list'         => 1 ),
    array( 'option_id'    => 3,
        'blog_id'      => 0,
        'option_name'  => "statsocial_style_type",
        'option_value' => "dark",
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Color Type', 'statsocial' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'The mood like dark atmosphere and the bright note, etc. is decided. and The editor is displayed when themename is selected, and a present style can be edited in detail.', 'statsocial' ),
        'validate'     => 'statsocial_style_type_validate',
        'list'         => 2,
    ),
    array( 'option_id'    => 4,
        'blog_id'      => 0,
        'option_name'  => "statsocial_header_image",
        'option_value' => "header.png",
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Header background image', 'statsocial' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'The header image can be set by two methods.
One is a method of up-loading the image from the below up-loading form. Another is a method of filling in the filename from this textfield from statsocial/images something image.', 'statsocial' ),
        'validate'     => 'statsocial_header_image_validate',
        'list'         => 3,
    ),
    array( 'option_id'    => 5,
        'blog_id'      => 0,
        'option_name'  => "statsocial_footer_image",
        'option_value' => "footer.png",
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Footer background image', 'statsocial' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'The footer image can be set by two methods.
One is a method of up-loading the image from the below up-loading form. Another is a method of filling in the filename from this textfield from statsocial/images something image.', 'statsocial' ),
        'validate'     => 'statsocial_footer_image_validate', 'list'         => 4 ),
    array( 'option_id'    => 6,
        'blog_id'      => 0,
        'option_name'  => "statsocial_heading_image",
        'option_value' => "h2.png",
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Widget Title Background Image', 'statsocial' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'The header image can be chosen from among three kinds [h2.png,h2b.png,h2c.png].', 'statsocial' ),
        'validate'     => 'statsocial_heading_image_validate', 'list'         => 5 ),
    array( 'option_id'    => 7,
        'blog_id'      => 0,
        'option_name'  => "statsocial_heading_image_position",
        'option_value' => "0",
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Widget Title Background Image Position', 'statsocial' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'The name of the picture file used for the h2 headding is set. Please set the integral value from 0 to 7. ', 'statsocial' ),
        'validate'     => 'statsocial_heading_image_position_validate', 'list'         => 6 ),
    array( 'option_id'    => 8,
        'blog_id'      => 0,
        'option_name'  => "statsocial_page_width",
        'option_value' => "doc3",
        'autoload'     => 'yes',
        'title'        => __( 'Page Width', 'statsocial' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Please choose width on the page.', 'statsocial' ) .
        esc_html__( 'Please choose from four kinds of inside of', 'statsocial' ) .
        esc_html__( '750px centerd 950px centerd fluid 974px.', 'statsocial' ),
        'validate'     => 'statsocial_page_width_validate', 'list'         => 7 ),
    array( 'option_id'    => 9,
        'blog_id'      => 0,
        'option_name'  => "statsocial_col_width",
        'option_value' => "t2",
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Column Width and Position', 'statsocial' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Please specify the position and the width of Default Sidebar. Six kinds of sidebars of left 160px left 180px left 300px right 180px right 240px right 300px can be specified.', 'statsocial' ),
        'validate'     => 'statsocial_col_width_validate', 'list'         => 8 ),
    array( 'option_id'    => 10,
        'blog_id'      => 0,
        'option_name'  => "statsocial_default_fonts_color",
        'option_value' => "",
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Text color in content ', 'statsocial' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'If you need to set contents Special font color.', 'statsocial' ),
        'validate'     => 'statsocial_default_fonts_color_validate', 'list'         => 9 ),
    array( 'option_id'    => 11,
        'blog_id'      => 0,
        'option_name'  => "statsocial_footer_color",
        'option_value' => "",
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Text color in footer ', 'statsocial' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'If you need to set footer Special font color.', 'statsocial' ),
        'validate'     => 'statsocial_footer_color_validate', 'list'         => 10 ),
    array( 'option_id'    => 12,
        'blog_id'      => 0,
        'option_name'  => "statsocial_show_right_sidebar",
        'option_value' => "show",
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Extra Sidebar', 'statsocial' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Please specify show when you want to use three row layout. Please set Ratio to text when extra sidebar is displayed when you specify show', 'statsocial' ),
        'validate'     => 'statsocial_show_right_sidebar_validate', 'list'         => 11 ),
    array( 'option_id'    => 13,
        'blog_id'      => 0,
        'option_name'  => "statsocial_right_sidebar_width_percent",
        'option_value' => "25",
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Extra Sidebar Width', 'statsocial' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'When display extra sidebar is set to show', 'statsocial' ) .
        esc_html__( 'it is necessary to specify it.', 'statsocial' ) .
        esc_html__( 'It can decide to divide the width of which place of extra sidebar', 'statsocial' ) .
        esc_html__( 'and to give it. Please select it from among 25% 33% 50% 66% 75%. ', 'statsocial' ),
        'validate'     => 'statsocial_right_sidebar_width_percent_validate', 'list'         => 12 ),
    array( 'option_id'    => 14,
        'blog_id'      => 0,
        'option_name'  => "statsocial_show_menu_primary",
        'option_value' => "show",
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Menu Primary', 'statsocial' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Display or not Menu Primary. default value is show. set hide when not display menu primary', 'statsocial' ),
        'validate'     => 'statsocial_show_menu_primary_validate', 'list'         => 13 ),
    array( 'option_id'    => 15,
        'blog_id'      => 0,
        'option_name'  => "statsocial_hyperlink_color",
        'option_value' => "",
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Link color', 'statsocial' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Hyper link color', 'statsocial' ),
        'validate'     => 'statsocial_hyperlink_color_validate', 'list'         => 14 ),
    array( 'option_id'    => 16,
        'blog_id'      => 0,
        'option_name'  => "statsocial_accessibility_settings",
        'option_value' => "no",
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Accessibility Settings', 'statsocial' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Accessibility Settings is create a unique link text. set to yes or no.', 'statsocial' ),
        'validate'     => 'statsocial_accessibility_settings_validate', 'list'         => 15
    ),
    array( 'option_id'    => 17,
        'blog_id'      => 0,
        'option_name'  => "statsocial_doc_type_settings",
        'option_value' => "html5",
        'autoload'     => 'yes',
        'title'        => esc_html__( "Document Type Settings", 'statsocial' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( "Default Document type html5. Set to xhtml or html5.", 'statsocial' ),
        'validate'     => 'statsocial_doc_type_settings_validate', 'list'         => 16
    ),
);
}
if ( !isset( $statsocial_base_setting ) ) {

    $statsocial_base_setting = $statsocial_base_setting_args;
}

/**
 * Validate admin panel form value.
 *
 *
 *
 *
 */
function statsocial_doc_type_settings_validate( $output ) {

    $output = ( string ) $output;

    if ( 'html5' == $output || 'xhtml' == $output ) {

        return $output;
    }

    return 'html5';
}

/**
 * 
 *
 *
 *
 *
 */
function statsocial_accessibility_settings_validate( $output ) {

    $output = ( string ) $output;

    if ( 'yes' == $output || 'no' == $output ) {

        return $output;
    }
    return 'no';
}

/**
 * 
 *
 *
 *
 *
 */
function statsocial_use_automatic_color_validate( $input ) {

    $input = str_replace( "#", "", $input );

    if ( ctype_xdigit( $input ) ) {

        return '#' . $input;
    } else {

        $statsocial_options = get_option( "statsocial_theme_settings" );
        return $statsocial_options[ "statsocial_use_automatic_color" ];
    }
    return $input;
}

/**
 *
 *
 *
 *
 *
 */
function statsocial_right_sidebar_width_percent_validate( $input ) {

    $obj  = new statsocial_menu_create();
    $vals = $obj->col_settings_statsocial_right_sidebar_width_percent;

    foreach ( $vals as $val ) {

        if ( $input == $val ) {

            return $input;
        }
    }
    $statsocial_options = get_option( "statsocial_theme_settings" );
    return $statsocial_options[ "statsocial_right_sidebar_width_percent" ];
}

/**
 *
 *
 *
 *
 *
 */
function statsocial_show_right_sidebar_validate( $input ) {

    $obj  = new statsocial_menu_create();
    $vals = $obj->col_settings_statsocial_show_right_sidebar;

    foreach ( $vals as $val ) {

        if ( $input == $val ) {

            return $input;
        }
    }
    $statsocial_options = get_option( "statsocial_theme_settings" );
    return $statsocial_options[ "col_settings_statsocial_show_right_sidebar" ];
}

/**
 *
 *
 *
 *
 *
 */
function statsocial_footer_color_validate( $input ) {

    if ( $input == '' ) {
        return $input;
    }

    if ( preg_match( "!#([0-9a-f]{6}|[0-9a-f]{3})!si", $input ) ) {

        return $input;
    }
    $statsocial_options = get_option( "statsocial_theme_settings" );
    return $statsocial_options[ "statsocial_default_fonts_color" ];
}

/**
 *
 *
 *
 *
 *
 */
function statsocial_default_fonts_color_validate( $input ) {

    if ( $input == '' ) {
        return $input;
    }

    if ( preg_match( "!#([0-9a-f]{6}|[0-9a-f]{3})!si", $input ) ) {

        return $input;
    }
    $statsocial_options = get_option( "statsocial_theme_settings" );
    return $statsocial_options[ "statsocial_default_fonts_color" ];
}

/**
 *
 *
 *
 *
 *
 */
function statsocial_col_width_validate( $input ) {

    $obj  = new statsocial_menu_create();
    $vals = $obj->col_settings_statsocial_col_width;

    foreach ( $vals as $val ) {

        if ( $input == $val ) {

            return $input;
        }
    }
    $statsocial_options = get_option( "statsocial_theme_settings" );
    return $statsocial_options[ "statsocial_col_width" ];
}

/**
 *
 *
 *
 *
 *
 */
function statsocial_page_width_validate( $input ) {

    $obj  = new statsocial_menu_create();
    $vals = $obj->col_settings_statsocial_page_width;

    foreach ( $vals as $val ) {

        if ( $input == $val ) {

            return $input;
        }
    }
    $statsocial_options = get_option( "statsocial_theme_settings" );
    return $statsocial_options[ "statsocial_page_width" ];
}

/**
 *
 *
 *
 *
 *
 */
function statsocial_heading_image_validate( $input ) {

    if ( preg_match( '/[^(a-z|0-9|_|-|\.)]+/si', $input ) ) {

        $statsocial_options = get_option( "statsocial_theme_settings" );
        return $statsocial_options[ "statsocial_heading_image" ];
    }
    return $input;
}

/**
 *
 *
 *
 *
 *
 */
function statsocial_heading_image_position_validate( $input ) {

    if ( is_numeric( $input ) && $input < 8 && -1 < $input ) {

        return $input;
    }

    $statsocial_options = get_option( "statsocial_theme_settings" );
    return $statsocial_options[ "statsocial_heading_image_position" ];
}

/**
 *
 *
 *
 *
 *
 */
function statsocial_footer_image_validate( $input ) {

    global $statsocial_options;

    if ( preg_match( '/[^(a-z|0-9|_|-|\.)]+/si', $input ) ) {

        $statsocial_options = get_option( "statsocial_theme_settings" );
        return $statsocial_options[ "statsocial_footer_image" ];
    }
    return $input;
}

/**
 *
 *
 *
 *
 *
 */
function statsocial_header_image_validate( $input ) {

    if ( preg_match( '/[^(a-z|0-9|_|-|\.)]+/si', $input ) ) {

        $statsocial_options = get_option( "statsocial_theme_settings" );
        return $statsocial_options[ "statsocial_header_image" ];
    }
    return $input;
}

/**
 *
 *
 *
 *
 *
 */
function statsocial_style_type_validate( $input ) {

    $array = statsocial_register_styles( $input );

    if ( array_search( $input, $array ) ) {

        return esc_html( $input );
    } else {

        return "w3standard";
    }
}

/**
 *
 *
 *
 *
 *
 */
function statsocial_base_color_validate( $input ) {

    if ( $input == '' ) {
        return $input;
    }

    if ( preg_match( "!([0-9a-f]{6}|[0-9a-f]{3})!si", $input ) ) {

        return $input;
    }
    $statsocial_options = get_option( "statsocial_theme_settings" );
    return $statsocial_options[ "statsocial_base_color" ];
}

/**
 *
 *
 *
 *
 *
 */
function statsocial_color_scheme_validate( $input ) {

    if ( $input == '' ) {
        return $input;
    }
    return esc_html( $input );
}

/**
 *
 *
 *
 *
 *
 */
function _statsocial_indv_css_validate( $input ) {

    // if needs core support style only
    //return safecss_filter_attr($input);
    return ' ' . strip_tags( $input );
}

/**
 *
 *
 *
 *
 *
 */
function statsocial_show_menu_primary_validate( $input ) {

    if ( "show" == $input ) {

        return 'show';
    }

    return 'hide';
}

/**
 *
 *
 *
 *
 *
 */
function statsocial_hyperlink_color_validate( $input ) {

    if ( '' == $input ) {
        return 'auto';
    }

    if ( preg_match( "!([0-9a-f]{6}|[0-9a-f]{3})!si", $input ) ) {

        return $input;
    }
    $statsocial_options = get_option( "statsocial_theme_settings" );
    return $statsocial_options[ "statsocial_hyperlink_color" ];
}

/**
 * statsocial option panel
 *
 *
 * @package WordPress
 * @subpackage statsocial
 */
class statsocial_menu_create {

    var $accesskey                                          = array( "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z" );
    var $table_template                                     = '<table class="%s widefat post fixed statsocial-value-set-tables">';
    var $title_template                                     = '<a id="%s" href="#wpwrap" class="go-top"><span>page top</span></a><h3 title="%s" class="statsocial-options-title">%s</h3>';
    var $excerpt_template                                   = '<div class="statsocial-excerpt">%s</div>';
    var $line_select_element                                = '<select accesskey="%s" name="%s" size="%d" style="height:%spx;">';
    var $col_settings_statsocial_col_width                   = array( "left 160px"  => "t1",
        "left 180px"  => "t2",
        "left 300px"  => "t3",
        "right 180px" => "t4",
        "right 240px" => "t5",
        "right 300px" => "t6"
    );
    var $col_settings_statsocial_page_width                  = array( "750px centered" => "doc",
        "950px centered" => "doc2",
        "fluid"          => "doc3",
        "974px"          => "doc4"
    );
    var $col_settings_statsocial_right_sidebar_width_percent = array( "25%" => "25",
        "33%" => "33",
        "50%" => "50",
        "66%" => "66",
        "75%" => "75"
    );
    var $col_settings_statsocial_show_right_sidebar          = array( "show" => "show",
        "hide" => "hide"
    );
    var $col_settings_statsocial_style_type                  = array( "light"      => "light",
        "dark"       => "dark",
        "w3standard" => "w3standard",
        "minimal"    => "minimal",
        "helloworld" => "helloworld",
    );
    var $col_settings_statsocial_color_scheme                = array( "Japan"           => "statsocial_color_ja",
        "USA"             => "statsocial_color_en",
        "WWW"             => "statsocial_color_en_140",
        "Animation Color" => "statsocial_color_anime"
    );
    var $first_save_to_database                             = 'no';

    /**
     *
     *
     *
     *
     *
     */
    function statsocial_SubMenu_GUI() {

        do_action( 'statsocial_SubMenu_GUI_pre' );

        global $wpdb, $statsocial_base_setting, $statsocial_wp_version, $statsocial_current_theme_name;

        if ( true == statsocial_USE_AUTO_COLOR ) {

            $this->col_settings_statsocial_style_type = statsocial_register_styles( "w3standard" );
        } else {

            $this->col_settings_statsocial_style_type = array( "w3standard" => "w3standard" );
        }

        $settings_check = get_option( 'statsocial_theme_settings' );

        if ( $settings_check == false ) {

            $this->first_save_to_database = 'yes';
        }


        $ok     = false;
        $result = "";
        /**
         * POSTGET
         *
         *
         */
        if ( isset( $_POST[ 'statsocial_option_values' ] ) && !empty( $_POST[ 'statsocial_option_values' ] ) ) {

            if ( !wp_verify_nonce( $_POST[ '_wpnonce' ], 'update-options' ) ) {

                wp_die( esc_html__( 'Post Errors 14', 'statsocial' ) );
            }

            if ( !check_admin_referer( 'update-options', '_wpnonce' ) ) {

                wp_die( esc_html__( 'Post Errors 18', 'statsocial' ) );
            }


            $option_id         = intval( $_POST[ 'option_id' ] );
            $statsocial_updates = "";

            foreach ( $_POST[ "statsocial_option_values" ] as $key => $val ) {

                $valid_function       = $key . '_validate';
                $new_settings         = get_option( 'statsocial_theme_settings' );
                $new_settings[ $key ] = $valid_function( $val );

                $upload_dir                                   = wp_upload_dir();
                $new_settings[ 'current_stylesheet_dir_url' ] = get_stylesheet_directory_uri();
                $new_settings[ 'current_upload_base_url' ]    = $upload_dir[ 'baseurl' ];
                $new_settings[ 'install' ]                    = true;
                if ( $key == "statsocial_style_type" ) {
                    $style_type                            = statsocial_warehouse( "statsocial_style_type" );
                    $statsocial_indv_css                    = statsocial_design_output( $style_type ) . statsocial_color_base();
                    $new_settings[ '_statsocial_indv_css' ] = $statsocial_indv_css;
                }

                if ( update_option( 'statsocial_theme_settings', $new_settings ) ) {
                    $ok = true;
                    $statsocial_updates .= ',<span class="' . esc_attr( $key ) . '">' . $key . '</span>';
                }
            }
        }
        $result .= '<div class="wrap"><div id="title-statsocial-header" >';
        $result .= screen_icon();
        $result .= "<h2>" . ucfirst( $statsocial_current_theme_name ) . esc_html__( ' Theme Settings', 'statsocial' ) . "</h2>";


        $install_condition = get_option( 'statsocial_theme_settings' );

        if ( $install_condition !== false ) {

            $result .= "<p>" . __( 'Saved Database table name:', 'statsocial' ) . " <strong>" . statsocial_PLUGIN_TABLE . "</strong></p></div>";
        } else {

            $result .= "<p>" . __( 'Now, statsocial Not Using Database Table', 'statsocial' ) . "</p></div>";
        }
        /**
         *
         *
         *
         *
         *
         */
        if ( isset( $_POST[ 'reset' ] ) ) {

            foreach ( $statsocial_base_setting as $add ) {

                $option_name                              = $add[ 'option_name' ];
                $statsocial_theme_settings[ $option_name ] = $add[ 'option_value' ];
            }
            $style_type                                               = statsocial_warehouse( "statsocial_style_type" );
            $statsocial_indv_css                                       = statsocial_design_output( $style_type ) . statsocial_color_base();
            $statsocial_theme_settings[ '_statsocial_indv_css' ]        = $statsocial_indv_css;
            $upload_dir                                               = wp_upload_dir();
            $statsocial_theme_settings[ 'current_stylesheet_dir_url' ] = get_stylesheet_directory_uri();
            $statsocial_theme_settings[ 'current_upload_base_url' ]    = $upload_dir[ 'baseurl' ];
            $statsocial_theme_settings[ 'install' ]                    = true;




            update_option( 'statsocial_theme_settings', $statsocial_theme_settings, "", $add[ 'autoload' ] );
            //1.213 nav_menu hide issue 
           //remove_theme_mods();

            do_action( 'statsocial_remove_theme_mods' );

            if ( file_exists( get_stylesheet_directory() . '/images/headers/wp3.jpg' ) ) {

                $statsocial_site_image           = get_stylesheet_directory_uri() . '/images/headers/wp3.jpg';
                $statsocial_site_thumbnail_image = get_stylesheet_directory_uri() . '/images/headers/wp3-thumbnail.jpg';
            } else {

                $statsocial_site_image           = get_template_directory_uri() . '/images/headers/wp3.jpg';
                $statsocial_site_thumbnail_image = get_template_directory_uri() . '/images/headers/wp3-thumbnail.jpg';
            }

            set_theme_mod( 'default-image', $statsocial_site_image );
        }
        /**
         *
         *
         *
         *
         *
         */
        if ( isset( $_POST[ 'statsocial_option_values' ] ) && !empty( $_POST[ 'statsocial_option_values' ] ) ) {

            $scheme = statsocial_warehouse( "statsocial_color_scheme" );
            global $$scheme;

            if ( $ok == true ) {

                if ( $this->first_save_to_database == 'yes' ) {

                    $result .= '<div id="message" class="updated fade" title="' . esc_attr( $statsocial_updates ) . '"><p>' . __( 'updated saved database successfully.', 'statsocial' );
                } else {

                    $result .= '<div id="message" class="updated fade" title="' . esc_attr( $statsocial_updates ) . '"><p>' . sprintf( __( 'updated %1$s successfully.', 'statsocial' ), $statsocial_updates );
                }

                if ( is_multisite() ) {

                    $result .= sprintf( '<a href="%s">%s</a></p></div>', 'themes.php?page=statsocial_settings', esc_html__( " MultiSite User must Click here !!", "statsocial" ) );
                } else {

                    $result .= '</p></div>';
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
        if ( isset( $_POST[ 'statsocial_upload' ] ) ) {

            global $statsocial_max_upload_size, $statsocial_max_width, $statsocial_allow_file_type;

            $upload_result = statsocial_upload_image( $statsocial_max_upload_size, $statsocial_max_width, $statsocial_allow_file_type );

            if ( true == $upload_result[ 0 ] ) {

                $result .= '<div id="message" class="updated fade" title="' . esc_attr( basename( $upload_result[ 1 ] ) ) . '"><img src="' . $upload_result[ 2 ] . '" width="100" style="vertical-align:middle;">&nbsp;&nbsp;&nbsp;&nbsp;' . sprintf( __( 'updated %1$s successfully.', 'statsocial' ), basename( $upload_result[ 2 ] ) );
            } else {

                $result .= '<div id="message" class="updated fade" title="' . esc_attr( basename( $upload_result[ 1 ] ) ) . '">' . sprintf( __( 'updated %s fail.', 'statsocial' ), $upload_result[ 1 ] );
            }
        }
        $result .= '</div>';
        $result .= '<div id="reset2"></div>';
        $result .= '<div>' . $this->statsocial_form_user_input() . '</div>';
        echo $result;
    }

    /**
     *
     *
     *
     *
     *
     */
    function statsocial_add_menus() {

        global $statsocial_wp_version, $statsocial_current_theme_name;

        if ( function_exists( 'add_theme_page' ) ) {

            $option_name = ucwords( $statsocial_current_theme_name ) . ' Options';
            $hook_suffix = add_theme_page( statsocial_TABLE_TITLE, $option_name, 'edit_theme_options', 'statsocial_settings', array( $this, 'statsocial_SubMenu_GUI' ) );

            if ( $hook_suffix ) {

                add_action( 'admin_print_styles-' . $hook_suffix, array( $this, 'statsocial_admin_print_styles' ) );
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
    function statsocial_admin_print_styles() {

        global $statsocial_wp_version;

        if ( file_exists( get_stylesheet_directory() . '/admin-options.css' ) ) {

            echo '<style type="text/css">@import url("' . get_stylesheet_directory_uri() . '/admin-options.css?ver=' . $statsocial_wp_version . '");</style>';
        } else {

            echo '<style type="text/css">@import url("' . get_template_directory_uri() . '/admin-options.css?ver=' . $statsocial_wp_version . '");</style>';
        }
    }

    /**
     *
     *
     *
     *
     *
     */
    function statsocial_form_user_input() {

        global $statsocial_base_setting;
        global $wpdb;
        global $statsocial_wp_version;
        global $statsocial_current_theme_name;
        global $statsocial_current_data_theme_uri;

        $option_value = "-";
        $lines        = "";
        $i            = 0;
        $deliv        = htmlspecialchars( $_SERVER[ 'REQUEST_URI' ] );
        $results      = get_option( 'statsocial_theme_settings' );

        if ( $results == false ) {
            $this->first_save_to_database = 'yes';
            $results                      = array();

            foreach ( $statsocial_base_setting as $key => $row ) {

                $statsocial_option_name             = $statsocial_base_setting[ $key ][ 'option_name' ];
                $statsocial_option_value            = $statsocial_base_setting[ $key ][ 'option_value' ];
                $results[ $statsocial_option_name ] = $statsocial_base_setting[ $key ][ 'option_value' ];
            }
        }

        foreach ( $statsocial_base_setting as $key => $row ) {

            $statsocial_option_name  = $statsocial_base_setting[ $key ][ 'option_name' ];
            $statsocial_option_value = $statsocial_base_setting[ $key ][ 'option_value' ];

            if ( !empty( $results[ $statsocial_option_name ] ) ) {

                $statsocial_sort[ $statsocial_option_name ] = $results[ $statsocial_option_name ];
            } else {

                $statsocial_sort[ $statsocial_option_name ] = $statsocial_option_value;
            }
        }
        $results = $statsocial_sort;






        $current_heading_image     = statsocial_warehouse( "statsocial_heading_image" );
        $statsocial_navigation_add  = '';
        $statsocial_navigation_list = '<div class="statsocial-navigation-wrapper"><h3 class="statsocial-navigation-title">' . __( 'WordPress Native Theme Options', 'statsocial' ) . '</h3><ul style="margin-bottom:5px;" class="statsocial-native-menu">';


        $statsocial_navigation_list .= '<li><a href="' . admin_url( 'customize.php' ) . '">' . esc_html__( 'Theme customizer', 'statsocial' ) . '</a></li>';

        $statsocial_navigation_list .= '<li><a href="' . admin_url( 'themes.php?page=custom-header' ) . '">' . esc_html__( 'Custom Header', 'statsocial' ) . '</a></li>';
        $statsocial_navigation_list .= '<li><a href="' . admin_url( 'themes.php?page=custom-background' ) . '">' . esc_html__( 'Custom Background', 'statsocial' ) . '</a></li>';
        $statsocial_navigation_list .= '<li><a href="' . admin_url( 'widgets.php' ) . '">' . esc_html__( 'Widget', 'statsocial' ) . '</a></li>';
        $statsocial_navigation_list .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">' . esc_html__( 'Menus', 'statsocial' ) . '</a></li>';
        $statsocial_navigation_list .= '<li><a href="' . admin_url( 'theme-editor.php' ) . '">' . esc_html__( 'Theme Editor', 'statsocial' ) . '</a></li>';
        $statsocial_navigation_list .= '</ul>';

        if ( true == statsocial_USE_AUTO_COLOR ) {

            $statsocial_navigation_list .= '<h3 class="statsocial-navigation-title">' . __( 'statsocial Extend Theme Options', 'statsocial' ) . '</h3><ul id="statsocial_navigation_list" class="statsocial-options-menu">';
        } else {

            $statsocial_navigation_list = '<div class="statsocial-navigation-wrapper">';
        }

        $statsocial_navigation_add = '';
        unset( $results[ '_statsocial_indv_css' ] );
        unset( $results[ 'install' ] );
        $lines .= "<form action=\"$deliv\" method=\"post\">" . wp_nonce_field( 'update-options' );

        foreach ( $results as $key => $val ) {

            $add_box = '';

            if ( true == statsocial_USE_AUTO_COLOR ) {

                $statsocial_navigation_list .= '<li><a href="#' . str_replace( "_", "-", $key ) . '">' . statsocial_admin_meta( $key, 'title' ) . '</a></li>';
                if ( 'statsocial_base_color' == $key ) {

                    $statsocial_navigation_add = '<ul style="padding:0 30px;"><li><a href="#statsocial-style-type">' . __( 'go to Color Type', 'statsocial' ) . '</a></li></ul>';
                } elseif ( 'statsocial_header_image' == $key || 'statsocial_footer_image' == $key ) {

                    $statsocial_navigation_add = '<ul style="padding:0 30px;"><li><a href="#statsocial_upload_form">' . __( 'Go to upload form', 'statsocial' ) . '</a></li></ul>';
                } elseif ( 'statsocial_style_type' == $key ) {

                    $statsocial_navigation_add = '<ul style="padding:0 30px;"><li><a href="#statsocial-base-color">' . __( 'Go to Base Color', 'statsocial' ) . '</a></li></ul>';
                } else {

                    $statsocial_navigation_add = '';
                }
            }

            $excerpt = "";
            $table   = sprintf( $this->table_template, str_replace( "_", "-", $key ) );
            $excerpt = sprintf( $this->title_template, str_replace( "_", "-", $key ), str_replace( "_", " ", $key ), statsocial_admin_meta( $key, 'title' ) );
            $excerpt .= sprintf( $this->excerpt_template, statsocial_admin_meta( $key, 'excerpt2' ) );

            if ( !empty( $excerpt ) ) {

                $excerpt = '<div class="postbox" style="margin:1em;color:#339999">' . $excerpt;
            } else {

                $excerpt = "";
            }

            if ( preg_match( "!([0-9a-f]{6}|[0-9a-f]{3})!si", $val ) ) {

                $style = "background:" . $val . ';';
            } else {

                $style = "";
            }

            if ( preg_match( "!\.(png|gif|jpeg|jpg)$!i", $val ) && $key !== "statsocial_footer_image" && $key !== "statsocial_header_image" ) {

                if ( file_exists( get_stylesheet_directory() . "/images/" . $val ) ) {

                    $style .="background:url(" . get_stylesheet_directory_uri() . "/images/" . $val . ');';
                } else {

                    $style .="background:url(" . get_template_directory_uri() . "/images/" . $val . ');';
                }
            } else {

                $style .='';
            }

            if ( empty( $style ) ) {

                $style .='visibility:hidden';
                $table_header = '<thead><tr><th>&nbsp;</th><th>' . __( "Value", 'statsocial' ) . '</th><th>' . __( "Edit", 'statsocial' ) . '</th><th style="width:6em;">&nbsp;</th></tr></thead>';
            } else {

                $table_header = '<thead><tr><th >' . __( "Color", 'statsocial' ) . '</th><th>' . __( "Value", 'statsocial' ) . '</th><th>' . __( "Edit", 'statsocial' ) . '</th><th style="width:6em;">&nbsp;</th></tr></thead>';
            }

            if ( false == statsocial_USE_AUTO_COLOR && ( "statsocial_footer_color" == $key or
                    "statsocial_default_fonts_color" == $key or
                    "statsocial_base_color" == $key or
                    "statsocial_header_image" == $key or
                    "statsocial_footer_image" == $key or
                    "statsocial_heading_image_position" == $key or
                    "statsocial_heading_image" == $key or
                    "statsocial_style_type" == $key or
                    "statsocial_hyperlink_color" == $key or
                    "statsocial_color_scheme" == $key ) ) {
                continue;
            }

            if ( statsocial_warehouse( "statsocial_style_type" ) == $statsocial_current_theme_name && ( "statsocial_footer_color" == $key or
                    "statsocial_default_fonts_color" == $key or
                    "statsocial_header_image" == $key or
                    "statsocial_footer_image" == $key or
                    "statsocial_heading_image_position" == $key or
                    "statsocial_heading_image" == $key or
                    "statsocial_hyperlink_color" == $key
                    ) ) {
                continue;
            }

            $lines .= $excerpt;
            $lines .= $table;
            $lines .= $table_header;
            $lines .= '<tbody>';
            $lines .= '<tr>';
            $lines .= '<td style="display:none;">';
            $lines .= '<input type="text" name="option_id" value="' . $i . '" />' . $i . '</td>';
//background setting

            if ( "statsocial_heading_image_position" == $key ) {

                if ( file_exists( get_stylesheet_directory() . '/images/' . $current_heading_image ) ) {

                    $lines .= '<td style="background:url( ' . get_stylesheet_directory_uri() . '/images/' . $current_heading_image . ' );"><img src="' . get_stylesheet_directory_uri() . '/images/number.png" />';
                } else {

                    $lines .= '<td style="background:url( ' . get_template_directory_uri() . '/images/' . $current_heading_image . ' );"><img src="' . get_template_directory_uri() . '/images/number.png" />';
                }
            } elseif ( $key == "statsocial_header_image" ) {

                $uploads          = wp_upload_dir();
                $header_image_uri = $uploads[ 'url' ] . '/' . statsocial_warehouse( 'statsocial_header_image' );
                $lines .= '<td colspan="4" style="height:150px;' . statsocial_upload_image_parser( $header_image_uri, 'inline', '#hd' ) . '"></td></tr><tr><td>&nbsp;</td>';
            } elseif ( $key == "statsocial_footer_image" ) {

                $uploads          = wp_upload_dir();
                $footer_image_uri = $uploads[ 'url' ] . '/' . statsocial_warehouse( 'statsocial_footer_image' );
                $lines .= '<td colspan="4" style="height:150px;' . statsocial_upload_image_parser( $footer_image_uri, 'inline', '#ft' ) . '" ></td></tr><tr><td>&nbsp;</td>';
            } else {

                $lines .= '<td style="' . $style . '">';
            }

            $lines .= '<input type="hidden" name="option_name" value="' . esc_attr( $key ) . '" read-only="read-only" /></td>';
            $lines .= '<td>' . esc_html( $val ) . '</td>';

            if ( $key == "statsocial_hyperlink_color" ||
                    $key == "statsocial_base_color" ||
                    $key == "statsocial_footer_color" ||
                    $key == "statsocial_default_fonts_color" ) {

                $lines .= "<td>" . $this->statsocial_color_selector( $key, esc_attr( $val ), $i ) . "</td>";
            } elseif ( $key == "statsocial_col_width" ) {

                $lines .= '<td>';
                $lines .= sprintf( $this->line_select_element, $this->accesskey[ $i ], 'statsocial_option_values[' . $key . ']', 6, 120 );

                foreach ( $this->col_settings_statsocial_col_width as $key => $current ) {

                    $lines .= '<option value="' . esc_attr( $current ) . '" ' . selected( strcmp( $val, $current ), 0, false ) . '>' . esc_html( $key ) . '</option>';
                }

                $lines .='</select></td>';
            } elseif ( $key == "statsocial_page_width" ) {

                $lines .= '<td>';
                $lines .= sprintf( $this->line_select_element, esc_attr( $this->accesskey[ $i ] ), 'statsocial_option_values[' . $key . ']', 4, 80 );

                foreach ( $this->col_settings_statsocial_page_width as $key => $current ) {

                    $lines .= '<option value="' . esc_attr( $current ) . '" ' . selected( strcmp( $val, $current ), 0, false ) . '>' . esc_html( $key ) . '</option>';
                }
                $lines .='</select></td>';
            } elseif ( $key == "statsocial_show_right_sidebar" ) {

                $lines .= '<td>';
                $lines .= sprintf( $this->line_select_element, esc_attr( $this->accesskey[ $i ] ), 'statsocial_option_values[' . $key . ']', 2, 40 );

                foreach ( $this->col_settings_statsocial_show_right_sidebar as $key => $current ) {

                    $lines .= '<option value="' . esc_attr( $current ) . '" ' . selected( strcmp( $val, $current ), 0, false ) . '>' . esc_html( $key ) . '</option>';
                }

                $lines .='</select></td>';
            } elseif ( $key == "statsocial_right_sidebar_width_percent" ) {

                $lines .= '<td>';
                $lines .= sprintf( $this->line_select_element, esc_attr( $this->accesskey[ $i ] ), 'statsocial_option_values[' . $key . ']', 5, 100 );

                foreach ( $this->col_settings_statsocial_right_sidebar_width_percent as $key => $current ) {

                    $lines .= '<option value="' . esc_attr( $current ) . '" ' . selected( strcmp( $val, $current ), 0, false ) . '>' . esc_html( $key ) . '</option>';
                }
                $lines .='</select></td>';
            } elseif ( $key == "statsocial_style_type" ) {

                $lines .= '<td>';
                $lines .= sprintf( $this->line_select_element, $this->accesskey[ $i ], 'statsocial_option_values[' . $key . ']', 3, 60 );

                foreach ( $this->col_settings_statsocial_style_type as $key => $current ) {

                    $lines .= '<option value="' . esc_attr( $current ) . '" ' . selected( strcmp( $val, $current ), 0, false ) . '>' . esc_html( $key ) . '</option>';
                }
                $lines .='</select></td>';
            } elseif ( $key == "statsocial_heading_image" ) {

                $lines .= '<td style="height:225px">';
                $lines .= '<input accesskey="' . esc_attr( $this->accesskey[ $i ] ) . '" type="text" name="statsocial_option_values[' . $key . ']" value="' . esc_attr( $val ) . '"';
                $lines .= ' /></td>';
            } elseif ( $key == "statsocial_color_scheme" ) {

                $lines .= '<td>';
                $lines .= sprintf( $this->line_select_element, $this->accesskey[ $i ], 'statsocial_option_values[' . $key . ']', 3, 60 );

                foreach ( $this->col_settings_statsocial_color_scheme as $key => $current ) {

                    $lines .= '<option value="' . esc_attr( $current ) . '" ' . selected( strcmp( $val, $current ), 0, false ) . '>' . esc_html( $key ) . '</option>';
                }
            } else {

                $lines .= '<td>';
                $lines .= '<input accesskey="' . esc_attr( $this->accesskey[ $i ] ) . '" type="text" name="statsocial_option_values[' . $key . ']" value="' . esc_attr( $val ) . '"';
                $lines .= ' /></td>';
            }

            $i++;
            $lines .= "<td style=\"vertical-align:bottom;text-align:right;\"><input type=\"submit\" class=\"button-primary\" value=\"" . esc_attr__( 'Save', 'statsocial' ) . '" /></td>';
            $lines .= '</tr>';
            $send_key_name = "";
            $lines .= "</tbody></table><br />{$add_box}{$statsocial_navigation_add}</div>";
        } // foreach ( $results as $key => $val )

        $lines .= "<div style=\"margin:0 50px;\"><input type=\"submit\" class=\"button-primary\" value=\"" . esc_attr( 'Save Changes' ) . '" />&nbsp;&nbsp;&nbsp;';
        $lines .= "<input type=\"submit\" name=\"reset\" class=\"button-primary\" value=\"" . esc_attr( 'Reset All Settings' ) . '" /></form><br style="clear:both;</div>"';
        $lines .= "</div>";

        if ( !preg_match( '|<tbody>|', $lines ) ) {

            $lines .= "<tbody><tr><td colspan=\"4\">" . __( "Please reload this page ex. windows F5", 'statsocial' ) . '</td></tr></tbody>';
        }

        $lines .= statsocial_upload_form();

        if ( is_child_theme() ) {

            $statsocial_theme_name = 'Child theme ' . ucwords( wp_get_theme() ) . ' of ' . __( "statsocial Theme", "statsocial" );
        } else {

            $statsocial_theme_name = esc_html__( "statsocial Theme", "statsocial" );
        }

        if ( true == statsocial_USE_AUTO_COLOR ) {

            $add_infomation = sprintf( '<div class="statsocial-option-footer-infomation"><a href="%s">%s</a></div>', $statsocial_current_data_theme_uri, $statsocial_theme_name );
        } else {

            $add_infomation = sprintf( '<div class="statsocial-option-footer-infomation"><a href="%s">%s</a>%s</div>', $statsocial_current_data_theme_uri, $statsocial_theme_name, '&nbsp;&nbsp;<span class="statsocial-use-auto-color-disable">' . __( "Now constant statsocial_USE_AUTO_COLOR is false", 'statsocial' ) . '</span>' );
        }

        return apply_filters( 'statsocial_form_user_input', $statsocial_navigation_list . '</ul>' . $add_infomation . '</div>' . $lines . '<br style="clear:both" />' );
    }

    /**
     *
     *
     *
     *
     *
     */
    function statsocial_color_selector( $name, $current_val, $i ) {

        global $statsocial_color_ja, $statsocial_color_en_140, $statsocial_color_en, $statsocial_color_anime;

        $result = sprintf( $this->line_select_element, $this->accesskey[ $i ], 'statsocial_option_values[' . $name . ']', 4, 100 );
        $scheme = statsocial_warehouse( "statsocial_color_scheme" );
        $scheme = $$scheme;

        //1.122
        if ( isset( $scheme ) && is_array( $scheme ) ) {

            $current_color = array_search( $current_val, $scheme );

            $result .= '<option value="' . $current_val . '" style="background:' . $current_val . '" ' . selected( 1, 1, false ) . '>' . $current_color . '</option>';

            foreach ( $scheme as $key => $val ) {

                $cr = hexdec( substr( $val, 1, 2 ) ) * 0.5;
                $cg = hexdec( substr( $val, 3, 2 ) ) * 0.5;
                $cb = hexdec( substr( $val, 5, 2 ) ) * 0.5;

                if ( $cr + $cg + $cb < 128 && !empty( $val ) ) {

                    $color = "#ccc";
                } else {

                    if ( $cr > $cg && $cg > $cb ) {

                        $color = "#" . dechex( $cb ) . dechex( $cg ) . dechex( $cr );
                    } elseif ( $cr > $cb && $cb > $cg ) {

                        $color = "#" . dechex( $cg ) . dechex( $cb ) . dechex( $cr );
                    } elseif ( $cg > $cr && $cr > $cb ) {

                        $color = "#" . dechex( $cb ) . dechex( $cg ) . dechex( $cg );
                    } elseif ( $cg > $cb && $cb > $cr ) {

                        $color = "#" . dechex( $cr ) . dechex( $cb ) . dechex( $cg );
                    } elseif ( $cb > $cg && $cg > $cr ) {

                        $color = "#" . dechex( $cr ) . dechex( $cg ) . dechex( $cb );
                    } elseif ( $cb > $cr && $cr > $cg ) {

                        $color = "#" . dechex( $cg ) . dechex( $cr ) . dechex( $cb );
                    } else {

                        $color = "#000";
                    }
                }

                $result .= '<option value="' . esc_attr( $val ) . '" style="background:' . esc_attr( $val ) . ';color:' . esc_attr( $color ) . '">' . esc_html( $key ) . '</option>';
            }
        } else {

            $result .= '<option disabled>' . esc_html( 'Not selectable', 'statsocial' ) . '</option>';
        }

        $result .='</select>';
        return $result;
    }

}

/**
 * statsocial header footer image upload
 *
 *
 *
 *
 */
function statsocial_upload_form() {

    global $max_upload_size, $dirlist;

    $deliv  = htmlspecialchars( $_SERVER[ 'REQUEST_URI' ] );
    $result = '<div class="postbox statsocial" id="statsocial_upload_form">
			<h3 id="statsocial-style-type" title="statsocial style type">
			<div id="icon-upload" class="icon32"></div>
			<span>' .
            esc_html__( 'Image Upload', 'statsocial' ) .
            '</span></h3>
			<fieldset ><legend>' . esc_html__( 'Upload', 'statsocial' ) . '</legend>
			<form enctype="multipart/form-data" action="' . $deliv . '" method="POST">' . wp_nonce_field( 'update-options2' ) . '<p>
			<input name="uploadfile" type="file"></p><p>' .
            esc_html__( 'Purpose:', 'statsocial' ) . '<label>
			<input type="radio" name="purpose" value="header" checked="checked" />' .
            '<strong>' .
            esc_html__( 'Header Image', 'statsocial' ) .
            '</strong></label>
			&nbsp;&nbsp;&nbsp;<label><input type="radio" name="purpose" value="footer" />' .
            '<strong>' .
            esc_html__( 'Footer Image', 'statsocial' ) .
            '</strong></label></p><p>' .
            esc_html__( 'Style:', 'statsocial' ) . '<label>
			<input type="radio" name="style" value="norepeat" checked="checked" />' .
            esc_html__( 'no-repeat', 'statsocial' ) .
            '</label>&nbsp;&nbsp;&nbsp;<label>
			<input type="radio" name="style" value="repeatx" />' .
            esc_html__( 'repeat-x', 'statsocial' ) . '</label></p>
			<p>' . esc_html__( 'position:', 'statsocial' ) . '<label>' .
            esc_html__( 'top:', 'statsocial' ) . '<input type="text" name="position-top" value="0" style="text-align:right;" />' .
            esc_html__( 'px', 'statsocial' ) . '</label>&nbsp;&nbsp;&nbsp;' .
            esc_html__( 'left:', 'statsocial' ) .
            '<label><input type="text" name="position-left" value="0" style="text-align:right;" />' .
            esc_html__( 'px', 'statsocial' ) . '</label></p><p>' .
            esc_html__( 'box height:', 'statsocial' ) . '<label>
			<input type="text" name="height" value="0" style="text-align:right;" />' .
            esc_html__( 'px', 'statsocial' ) . '</label></p><p>
			<input type="submit" value="upload" name="statsocial_upload" class="button-primary"></p>
			</form>
			</fieldset>' .
            '<div class="statsocial_navigation_list">
			<ul>
			<li><a href="#statsocial-header-image">' .
            esc_html__( 'Go to current header image', 'statsocial' ) .
            '</a></li>
			<li><a href="#statsocial-footer-image">' .
            esc_html__( 'Go to current footer image', 'statsocial' ) .
            '</a></li></ul></div>' .
            '</div>';
    return $result;
}

/**
 * statsocial upload image check and save
 *
 *
 *
 *
 */
function statsocial_upload_image( $statsocial_max_upload_size, $statsocial_max_width, $statsocial_allow_file_type ) {

    global $statsocial_max_upload_size, $statsocial_max_width, $statsocial_allow_file_type;
    $upload_info = wp_upload_dir();
    $propaty     = '';
    $width       = '';
    $height      = '';
    $type        = '';
    $attr        = '';

    if ( isset( $_POST[ 'statsocial_upload' ] ) ) {

        if ( !isset( $_REQUEST[ '_wpnonce' ] ) ) {

            $result = esc_html__( "Cannot be trusted data", "statsocial" );
            return array( false, $result );
        } else {

            if ( !wp_verify_nonce( $_REQUEST[ '_wpnonce' ], 'update-options2' ) ) {
                $result = esc_html__( "Can not Upload Security issue", "statsocial" );
                return array( false, $result );
            }
        }

        if ( isset( $_POST[ 'purpose' ] ) && ( 'header' == $_POST[ 'purpose' ] || 'footer' == $_POST[ 'purpose' ] ) ) {

            $save_dir = $upload_info[ 'path' ] . '/statsocial-item';
            $propaty  = $propaty . '-' . sanitize_key( $_POST[ 'purpose' ] );
        } else {

            $result = esc_html__( "purpose no data", "statsocial" );
            return array( false, $result );
        }

        if ( isset( $_POST[ 'style' ] ) && ( 'norepeat' == $_POST[ 'style' ] || 'repeatx' == $_POST[ 'style' ] ) ) {

            $style   = $_POST[ 'style' ];
            $propaty = $propaty . '-style-' . sanitize_key( $_POST[ 'style' ] );
        } else {

            $result = esc_html__( "style no data", "statsocial" );
            return array( false, $result );
        }

        if ( isset( $_POST[ 'position-top' ] ) && is_numeric( $_POST[ 'position-top' ] ) ) {

            $top     = $_POST[ 'position-top' ];
            $propaty = $propaty . '-top-' . sanitize_key( $_POST[ 'position-top' ] );
        } else {

            $result = esc_html__( "position top no data", "statsocial" );
            return array( false, $result . 'c' );
        }

        if ( isset( $_POST[ 'position-left' ] ) && is_numeric( $_POST[ 'position-left' ] ) ) {

            $left    = $_POST[ 'position-left' ];
            $propaty = $propaty . '-left-' . sanitize_key( $_POST[ 'position-left' ] ) . '-';
        } else {

            $result = esc_html__( "position no data", "statsocial" );
            return array( false, $result );
        }

        if ( isset( $_POST[ 'height' ] ) && is_numeric( $_POST[ 'height' ] ) ) {

            $height  = $_POST[ 'height' ];
            $propaty = $propaty . 'x-height-' . sanitize_key( $_POST[ 'height' ] ) . '-';
        } else {

            $result = esc_html__( "box height no data", "statsocial" );
            return array( false, $result );
        }

        if ( $_FILES[ 'uploadfile' ][ 'size' ] > $statsocial_max_upload_size ) {

            $result = "file size over" . $_FILES[ 'uploadfile' ][ 'size' ] . 'upload-image-size' . $statsocial_max_upload_size;
            return array( false, $result );
        }

        if ( false == in_array( $_FILES[ 'uploadfile' ][ 'type' ], $statsocial_allow_file_type ) ) {

            $result = sprintf( esc_html__( '%s is not permitted filetype.', "statsocial" ), $_FILES[ 'uploadfile' ][ 'type' ] ) . implode( ',', $statsocial_allow_file_type );
            return array( false, $result );
        }

        if ( !function_exists( 'wp_handle_upload' ) ) {

            $result = sprintf( esc_html__( '%s function is not exists', "statsocial" ), 'wp_handle_upload' );
            return array( false, $result );
        }

        $uploadedfile     = $_FILES[ 'uploadfile' ];
        $upload_overrides = array( 'test_form' => false, );

        function statsocial_theme_upload_filename( $filename ) {

            $info    = pathinfo( $filename );
            $ext     = empty( $info[ 'extension' ] ) ? '' : '.' . $info[ 'extension' ];
            $name    = basename( $filename, $ext );
            $propaty = 'statsocial-item';

            if ( isset( $_POST[ 'purpose' ] ) && ( 'header' == $_POST[ 'purpose' ] || 'footer' == $_POST[ 'purpose' ] ) ) {

                $propaty = $propaty . '-' . sanitize_key( $_POST[ 'purpose' ] );
            }

            if ( isset( $_POST[ 'style' ] ) && ( 'norepeat' == $_POST[ 'style' ] || 'repeatx' == $_POST[ 'style' ] ) ) {

                $style   = $_POST[ 'style' ];
                $propaty = $propaty . '-style-' . sanitize_key( $_POST[ 'style' ] );
            }

            if ( isset( $_POST[ 'position-top' ] ) && is_numeric( $_POST[ 'position-top' ] ) ) {

                $top     = $_POST[ 'position-top' ];
                $propaty = $propaty . '-top-' . sanitize_key( $_POST[ 'position-top' ] );
            }

            if ( isset( $_POST[ 'position-left' ] ) && is_numeric( $_POST[ 'position-left' ] ) ) {

                $left    = $_POST[ 'position-left' ];
                $propaty = $propaty . '-left-' . sanitize_key( $_POST[ 'position-left' ] ) . '-';
            }

            if ( isset( $_POST[ 'height' ] ) && is_numeric( $_POST[ 'height' ] ) ) {

                $height  = $_POST[ 'height' ];
                $propaty = $propaty . 'x-height-' . sanitize_key( $_POST[ 'height' ] ) . '-';
            }

            return $propaty . $name . $ext;
        }

        add_filter( 'sanitize_file_name', 'statsocial_theme_upload_filename', 10 );


        if ( ( $test = wp_handle_upload( $uploadedfile, $upload_overrides ) ) ) {

            if ( isset( $test[ 'error' ] ) ) {

                $result = $test[ 'error' ];
                return array( false, $result );
            }

            if ( file_exists( $save_dir . $_FILES[ 'uploadfile' ][ 'name' ] ) ) {

                chmod( $save_dir . $_FILES[ 'uploadfile' ][ 'name' ], 0644 );
                list( $width, $height, $type, $attr ) = getimagesize( $save_dir . $_FILES[ 'uploadfile' ][ 'name' ] );

                if ( $statsocial_max_width < $width || $height > $statsocial_max_width * 1.5 ) {

                    unlink( $save_dir . $_FILES[ 'uploadfile' ][ 'name' ] );
                    $result = sprintf( esc_html__( "%d px * %d width too big. limit %d px", "statsocial" ), $width, $height, $statsocial_max_width );
                    return array( false, $result . 'g' );
                }
            }

            $uploaded_url = $upload_info[ 'url' ] . '/statsocial-item' . $propaty . $_FILES[ 'uploadfile' ][ 'name' ];
            $new_settings = get_option( 'statsocial_theme_settings' );

            if ( 'header' == $_POST[ 'purpose' ] ) {

                $new_settings[ 'statsocial_header_image' ] = 'statsocial-item' . $propaty . $_FILES[ 'uploadfile' ][ 'name' ];
            } elseif ( 'footer' == $_POST[ 'purpose' ] ) {

                $new_settings[ 'statsocial_footer_image' ] = 'statsocial-item' . $propaty . $_FILES[ 'uploadfile' ][ 'name' ];
            }

            update_option( 'statsocial_theme_settings', $new_settings );
            return array( true, 'success', $uploaded_url, $width, $height, true );
        } else {

            $result = esc_html__( "It failed in up-loading.", "statsocial" );

            foreach ( $_FILES[ 'userfile' ][ 'error' ] as $error ) {

                $result .= $error;
            }
            return array( false, $result );
        }
    }
}

/**
 * statsocial_COLOR_SCHEME
 *
 *
 *
 *
 */
$statsocial_color_ja     = array( __( 'none', 'statsocial' ) => "", __( 'toki', 'statsocial' ) => "#F9A1D0", __( 'tutuji', 'statsocial' ) => "#CB4B94", __( 'sakura', 'statsocial' ) => "#FFDBED", __( 'bara', 'statsocial' ) => "#D34778", __( 'karakurenai', 'statsocial' ) => "#E3557F", __( 'sango', 'statsocial' ) => "#FF87A0", __( 'koubai', 'statsocial' ) => "#E08899", __( 'momo', 'statsocial' ) => "#E38698", __( 'beni', 'statsocial' ) => "#BD1E48", __( 'beniaka', 'statsocial' ) => "#B92946", __( 'enji', 'statsocial' ) => "#AE3846", __( 'suou', 'statsocial' ) => "#974B52", __( 'akane', 'statsocial' ) => "#A0283A", __( 'aka', 'statsocial' ) => "#BF1E33", __( 'syu', 'statsocial' ) => "#ED514E", __( 'benikaba', 'statsocial' ) => "#A14641", __( 'benihi', 'statsocial' ) => "#EE5145", __( 'entan', 'statsocial' ) => "#D3503C", __( 'beniebitya', 'statsocial' ) => "#703B32", __( 'tobi', 'statsocial' ) => "#7D483E", __( 'azuki', 'statsocial' ) => "#946259", __( 'bengara', 'statsocial' ) => "#8A4031", __( 'ebitya', 'statsocial' ) => "#6D3D33", __( 'kinaka', 'statsocial' ) => "#ED542A", __( 'akatya', 'statsocial' ) => "#B15237", __( 'akasabi', 'statsocial' ) => "#923A21", __( 'ouni', 'statsocial' ) => "#EF6D3E", __( 'sekitou', 'statsocial' ) => "#ED551B", __( 'kaki', 'statsocial' ) => "#E06030", __( 'nikkei', 'statsocial' ) => "#B97761", __( 'kaba', 'statsocial' ) => "#BD4A1D", __( 'renga', 'statsocial' ) => "#974E33", __( 'sabi', 'statsocial' ) => "#664134", __( 'hiwada', 'statsocial' ) => "#8A604F", __( 'kuri', 'statsocial' ) => "#754C38", __( 'kiaka', 'statsocial' ) => "#E45E00", __( 'taisya', 'statsocial' ) => "#BA6432", __( 'rakuda', 'statsocial' ) => "#B67A52", __( 'kitye', 'statsocial' ) => "#BB6421", __( 'hadairo', 'statsocial' ) => "#F4BE9B", __( 'daidai', 'statsocial' ) => "#FD7E00", __( 'haitya', 'statsocial' ) => "#866955", __( 'tya', 'statsocial' ) => "#734E30", __( 'kogetya', 'statsocial' ) => "#594639", __( 'kouji', 'statsocial' ) => "#FFA75E", __( 'anzu', 'statsocial' ) => "#DDA273", __( 'mikan', 'statsocial' ) => "#FA8000", __( 'kassyoku', 'statsocial' ) => "#763900", __( 'tutiiro', 'statsocial' ) => "#A96E2D", __( 'komugi', 'statsocial' ) => "#D9A46D", __( 'kohaku', 'statsocial' ) => "#C67400", __( 'kintya', 'statsocial' ) => "#C47600", __( 'tamago', 'statsocial' ) => "#FABE6F", __( 'yamabuki', 'statsocial' ) => "#FFA500", __( 'oudo', 'statsocial' ) => "#C18A39", __( 'kutiba', 'statsocial' ) => "#897868", __( 'himawari', 'statsocial' ) => "#FFB500", __( 'ukon', 'statsocial' ) => "#FCAC00", __( 'suna', 'statsocial' ) => "#C9B9A8", __( 'karasi', 'statsocial' ) => "#CDA966", __( 'ki', 'statsocial' ) => "#FFBE00", __( 'tanpopo', 'statsocial' ) => "#FFBE00", __( 'uguisutya', 'statsocial' ) => "#70613A", __( 'tyuki', 'statsocial' ) => "#FAD43A", __( 'kariyasu', 'statsocial' ) => "#EED67E", __( 'kihada', 'statsocial' ) => "#D9CB65", __( 'miru', 'statsocial' ) => "#736F55", __( 'biwa', 'statsocial' ) => "#C2C05C", __( 'uguisu', 'statsocial' ) => "#71714A", __( 'mattya', 'statsocial' ) => "#BDBF92", __( 'kimidori', 'statsocial' ) => "#B9C42F", __( 'koke', 'statsocial' ) => "#7A7F46", __( 'wakakusa', 'statsocial' ) => "#A9B735", __( 'moegi', 'statsocial' ) => "#96AA3D", __( 'kusa', 'statsocial' ) => "#72814B", __( 'wakaba', 'statsocial' ) => "#AFC297", __( 'matuba', 'statsocial' ) => "#6E815C", __( 'byakuroku', 'statsocial' ) => "#CADBCF", __( 'midori', 'statsocial' ) => "#4DB56A", __( 'tokiwa', 'statsocial' ) => "#357C4C", __( 'rokusyou', 'statsocial' ) => "#5F836D", __( 'titosemidori', 'statsocial' ) => "#4A6956", __( 'fukamidori', 'statsocial' ) => "#005731", __( 'moegi', 'statsocial' ) => "#15543B", __( 'wakatake', 'statsocial' ) => "#49A581", __( 'seiji', 'statsocial' ) => "#80AA9F", __( 'aotake', 'statsocial' ) => "#7AAAAC", __( 'tetu', 'statsocial' ) => "#244344", __( 'aomidori', 'statsocial' ) => "#0090A8", __( 'sabiasagi', 'statsocial' ) => "#6C8D9B", __( 'mizuasagi', 'statsocial' ) => "#7A99AA", __( 'sinbasi', 'statsocial' ) => "#69AAC6", __( 'asagi', 'statsocial' ) => "#0087AA", __( 'byakugun', 'statsocial' ) => "#84B5CF", __( 'nando', 'statsocial' ) => "#166A88", __( 'kamenozoki', 'statsocial' ) => "#8CB4CE", __( 'mizu', 'statsocial' ) => "#A9CEEC", __( 'ainezu', 'statsocial' ) => "#5E7184", __( 'sora', 'statsocial' ) => "#95C0EC", __( 'ao', 'statsocial' ) => "#0067C0", __( 'ai', 'statsocial' ) => "#2E4B71", __( 'koiai', 'statsocial' ) => "#20324E", __( 'wasurenagusa', 'statsocial' ) => "#92AFE4", __( 'tuyukusa', 'statsocial' ) => "#3D7CCE", __( 'hanada', 'statsocial' ) => "#3C639B", __( 'konjou', 'statsocial' ) => "#3D496B", __( 'ruri', 'statsocial' ) => "#3451A4", __( 'rurikon', 'statsocial' ) => "#324784", __( 'kon', 'statsocial' ) => "#333C5E", __( 'kakitubata', 'statsocial' ) => "#4C5DAB", __( 'kati', 'statsocial' ) => "#383C57", __( 'gunjou', 'statsocial' ) => "#414FA3", __( 'tetukon', 'statsocial' ) => "#232538", __( 'fujinando', 'statsocial' ) => "#6869A8", __( 'kikyou', 'statsocial' ) => "#4A49AD", __( 'konai', 'statsocial' ) => "#35357D", __( 'fuji', 'statsocial' ) => "#A09BD8", __( 'fujimurasaki', 'statsocial' ) => "#948BDB", __( 'aomurasaki', 'statsocial' ) => "#704CBC", __( 'sumire', 'statsocial' ) => "#6D52AB", __( 'hatoba', 'statsocial' ) => "#675D7E", __( 'syoubu', 'statsocial' ) => "#7051AA", __( 'edomurasaki', 'statsocial' ) => "#5F4C86", __( 'murasaki', 'statsocial' ) => "#A260BF", __( 'kodaimurasaki', 'statsocial' ) => "#775686", __( 'nasukon', 'statsocial' ) => "#47384F", __( 'sikon', 'statsocial' ) => "#402949", __( 'ayame', 'statsocial' ) => "#C27BC8", __( 'botan', 'statsocial' ) => "#C24DAE", __( 'akamurasaki', 'statsocial' ) => "#C54EA0", __( 'siro', 'statsocial' ) => "#F1F1F1", __( 'gofun', 'statsocial' ) => "#F2E8EC", __( 'kinari', 'statsocial' ) => "#F0E2E0", __( 'zouge', 'statsocial' ) => "#E3D4CA", __( 'ginnezu', 'statsocial' ) => "#A0A0A0", __( 'tyanezumi', 'statsocial' ) => "#9F9190", __( 'nezumi', 'statsocial' ) => "#868686", __( 'rikyunezumi', 'statsocial' ) => "#787C7A", __( 'namari', 'statsocial' ) => "#797A88", __( 'hai', 'statsocial' ) => "#797979", __( 'susutake', 'statsocial' ) => "#605448", __( 'kurotya', 'statsocial' ) => "#3E2E28", __( 'sumi', 'statsocial' ) => "#313131", __( 'kuro', 'statsocial' ) => "#262626", __( 'tetukuro', 'statsocial' ) => "#262626" );
$statsocial_color_en_140 = array( "none" => "", "white" => "#ffffff", "whitesmoke" => "#f5f5f5", "gainsboro" => "#dcdcdc", "lightgrey" => "#d3d3d3", "silver" => "#c0c0c0", "darkgray" => "#a9a9a9", "gray" => "#808080", "dimgray" => "#696969", "black" => "#000000", "red" => "#ff0000", "orangered" => "#ff4500", "tomato" => "#ff6347", "coral" => "#ff7f50", "salmon" => "#fa8072", "lightsalmon" => "#ffa07a", "darksalmon" => "#e9967a", "peru" => "#cd853f", "saddlebrown" => "#8b4513", "sienna" => "#a0522d", "chocolate" => "#d2691e", "sandybrown" => "#f4a460", "darkred" => "#8b0000", "maroon" => "#800000", "brown" => "#a52a2a", "firebrick" => "#b22222", "crimson" => "#dc143c", "indianred" => "#cd5c5c", "lightcoral" => "#f08080", "rosybrown" => "#bc8f8f", "palevioletred" => "#db7093", "deeppink" => "#ff1493", "hotpink" => "#ff69b4", "lightpink" => "#ffb6c1", "pink" => "#ffc0cb", "mistyrose" => "#ffe4e1", "linen" => "#faf0e6", "seashell" => "#fff5ee", "lavenderblush" => "#fff0f5", "snow" => "#fffafa", "yellow" => "#ffff00", "gold" => "#ffd700", "orange" => "#ffa500", "darkorange" => "#ff8c00", "goldenrod" => "#daa520", "darkgoldenrod" => "#b8860b", "darkkhaki" => "#bdb76b", "burlywood" => "#deb887", "tan" => "#d2b48c", "khaki" => "#f0e68c", "peachpuff" => "#ffdab9", "navajowhite" => "#ffdead", "palegoldenrod" => "#eee8aa", "moccasin" => "#ffe4b5", "wheat" => "#f5deb3", "bisque" => "#ffe4c4", "blanchedalmond" => "#ffebcd", "papayawhip" => "#ffefd5", "cornsilk" => "#fff8dc", "lightyellow" => "#ffffe0", "lightgoldenrodyellow" => "#fafad2", "lemonchiffon" => "#fffacd", "antiquewhite" => "#faebd7", "beige" => "#f5f5dc", "oldlace" => "#fdf5e6", "ivory" => "#fffff0", "floralwhite" => "#fffaf0", "greenyellow" => "#adff2f", "yellowgreen" => "#9acd32", "olive" => "#808000", "darkolivegreen" => "#556b2f", "olivedrab" => "#6b8e23", "chartreuse" => "#7fff00", "lawngreen" => "#7cfc00", "lime" => "#00ff00", "limegreen" => "#32cd32", "forestgreen" => "#228b22", "green" => "#008000", "darkgreen" => "#006400", "seagreen" => "#2e8b57", "mediumseagreen" => "#3cb371", "darkseagreen" => "#8fbc8f", "lightgreen" => "#90ee90", "palegreen" => "#98fb98", "springgreen" => "#00ff7f", "mediumspringgreen" => "#00fa9a", "honeydew" => "#f0fff0", "mintcream" => "#f5fffa", "azure" => "#f0ffff", "lightcyan" => "#e0ffff", "aliceblue" => "#f0f8ff", "darkslategray" => "#2f4f4f", "steelblue" => "#4682b4", "mediumaquamarine" => "#66cdaa", "aquamarine" => "#7fffd4", "mediumturquoise" => "#48d1cc", "turquoise" => "#40e0d0", "lightseagreen" => "#20b2aa", "darkcyan" => "#008b8b", "teal" => "#008080", "cadetblue" => "#5f9ea0", "darkturquoise" => "#00ced1", "aqua" => "#00ffff", "cyan" => "#00ffff", "lightblue" => "#add8e6", "powderblue" => "#b0e0e6", "paleturquoise" => "#afeeee", "skyblue" => "#87ceeb", "lightskyblue" => "#87cefa", "deepskyblue" => "#00bfff", "dodgerblue" => "#1e90ff", "ghostwhite" => "#f8f8ff", "lavender" => "#e6e6fa", "lightsteelblue" => "#b0c4de", "slategray" => "#708090", "lightslategray" => "#778899", "indigo" => "#4b0082", "darkslateblue" => "#483d8b", "midnightblue" => "#191970", "navy" => "#000080", "darkblue" => "#00008b", "slateblue" => "#6a5acd", "mediumslateblue" => "#7b68ee", "cornflowerblue" => "#6495ed", "royalblue" => "#4169e1", "mediumblue" => "#0000cd", "blue" => "#0000ff", "thistle" => "#d8bfd8", "plum" => "#dda0dd", "orchid" => "#da70d6", "violet" => "#ee82ee", "fuchsia" => "#ff00ff", "magenta" => "#ff00ff", "mediumpurple" => "#9370db", "mediumorchid" => "#ba55d3", "darkorchid" => "#9932cc", "blueviolet" => "#8a2be2", "darkviolet" => "#9400d3", "purple" => "#800080", "darkmagenta" => "#8b008b", "mediumvioletred" => "#c71585" );
$statsocial_color_en     = array( "none" => "", "american red" => "#bf0a30", "american blue" => "#002868", "american green" => "#006e53", "american yellow" => "#deb301", "american light blue" => "#cbddf3", "american brown" => "#9a6b37", "american gray" => "#afafb1", "glory red" => "#cc0033", "glory blue" => "#0000ff", "glory white" => "#fff9f5", "big apple red" => "#ff6331", "big apple blue" => "#3131ce", "empire blue" => "#001873", "empire cyan" => "#00b5d6", "empire red" => "#d60000", "empire yellow" => "#f7f700", "empire orange" => "#f79429", "empire green" => "#084a29", "empire ebony" => "#424a00", "natural red" => "#cc0033", "natural blue" => "#000099", "natural light blue" => "#84c8ef", "natural green" => "#90c924", "natural orange" => "#f39234", "natural brown" => "#843a2f", "natural gray" => "#bfbfbf", "hawkeye red" => "#e3003d", "hawkeye blue" => "#3c3c9e", "hawkeye yellow" => "#ffb30f", "hawkeye brown" => "#a54a00", "frontier blue" => "#000080", "frontier light blue" => "#d3eef7", "frontier green" => "#024900", "frontier yellow" => "#ffff00", "frontier purple" => "#8663bd", "dixie red" => "#b10021", "dixie blue" => "#083152", "dixie green" => "#105a21", "dixie yellow" => "#ffc621", "grand canyon blue" => "#002868", "grand canyon red" => "#bf0a30", "grand canyon brown" => "#ce5c17", "grand canyon yellow" => "#fed700", "grand canyon green" => "#00320b", "grand canyon pink" => "#efc1a9", "lincoln red" => "#e2184f", "lincoln pink" => "#e24a4f", "lincoln light blue" => "#64b4ff", "lincoln blue" => "#3c3c9e", "lincoln green" => "#3f863f", "lincoln yellow" => "#ffe60f", "lincoln orange" => "#ffb316", "hoosier blue" => "#101195", "hoosier yellow" => "#ffe700", "hoosier green" => "#197351", "hoosier brown" => "#563837", "badger blue" => "#002986", "badger light blue" => "#00b2fd", "badger pink" => "#f8b8de", "badger red" => "#f3334b", "badger green" => "#41ad16", "badger yellow" => "#ffe618", "badger brown" => "#66180b", "badger gray" => "#a2b9b9", "mountain red" => "#ff3516", "mountain blue" => "#003776", "mountain green" => "#20d942", "mountain yellow" => "#ffb30f", "mountain brown" => "#d15b25", "mountain gray" => "#c0c0c0", "sooner blue" => "#0e4892", "sooner light blue" => "#00adc6", "sooner green" => "#1b692b", "sooner opal" => "#8ab87a", "sooner yellow" => "#f0c016", "sooner brown" => "#421000", "sooner beige" => "#ffc69c", "sooner gray" => "#d6c6c6", "sooner black" => "#454442", "buckeye blue" => "#1a3b86", "buckeye red" => "#ff0000", "buckeye green" => "#00784b", "buckeye yellow" => "#f8c300", "buckeye brown" => "#4e3330", "buckeye light blue" => "#027bc2", "beaver blue" => "#002a86", "beaver yellow" => "#ffea0f", "golden red" => "#c10435", "golden green" => "#007e3a", "golden brown" => "#391800", "golden yellow" => "#bc8e07", "golden cyan" => "#40a7aa", "golden gray" => "#84948e", "sunflower blue" => "#00009c", "sunflower light blue" => "#0092df", "sunflower green" => "#29b910", "sunflower orange" => "#ff660f", "sunflower brown" => "#b34e20", "sunflower purple" => "#7c4790", "sunflower yellow" => "#ffe400", "sunflower gray" => "#dedede", "new england" => "#e25c5c", "midatlantic" => "#5c7a7a", "south" => "#8a84a3", "florida" => "#e9bda2", "midwest" => "#ffd577", "texas" => "#77cbb3", "great plains" => "#b6bc4d", "rocky mountain" => "#e9df25", "southwest" => "#ee2222", "california" => "#e0fa92", "pacific northwest" => "#38911c", "alaska" => "#d09440", "hawaii" => "#4f93c0", "mountains alabama" => "#999966", "metropolitan alabama" => "#ff9933", "river heritage alabama" => "#996699", "gulf coast alabama" => "#99cccc", "southern california" => "#e03030", "california desert" => "#e0b000", "california central coast" => "#00b000", "san joaquin valley" => "#a0a0c0", "sacramento valley" => "#e0b000", "sierra nevada" => "#00e000", "gold country" => "#e0e000", "bay area california" => "#e06060", "california north coast" => "#b0b000", "shasta cascades" => "#e03030", "mississippi capital river" => "#336699", "mississippi delta" => "#663366", "mississippi pines" => "#339966", "gulf coast mississippi" => "#660033", "mississippi hills" => "#996633", "panhandle nebraska" => "#cc9966", "north central nebraska" => "#cccc66", "eastern nebraska" => "#99cccc", "western nevada" => "#cc9999", "northern nevada" => "#cc9966", "central nevada" => "#9999cc", "southern nevada" => "#99cccc", "central new mexico" => "#e0fa92", "north central new mexico" => "#6699aa", "northeast new mexico" => "#b6bc4d", "northwest new mexico" => "#d09440", "southwest new mexico" => "#b2cc7f", "southeast new mexico" => "#ffff99", "northwest ohio" => "#666633", "northeast ohio" => "#669999", "midohio" => "#996666", "southwest ohio" => "#666699", "southeast ohio" => "#cc9933", "western tennessee" => "#996699", "central tennessee" => "#339999", "eastern tennessee" => "#339966", "panhandle texas" => "#80622f", "prairies and lakes" => "#335c64", "piney woods" => "#406324", "gulf coast texas" => "#7895a3", "south texas plains" => "#7d6b71", "hill country" => "#d1a85e", "big bend country" => "#c6ab7a", "wasatch front" => "#99cc33", "canyon country" => "#cc6600", "northeastern utah" => "#669900", "dixie" => "#b2cc7f", "central utah" => "#999933", "western utah" => "#ffff99", "northern virginia" => "#9966ff", "eastern virginia" => "#33bbee", "central virginia" => "#ff6655", "southwest virginia" => "#ffcc33", "shenandoah valley" => "#339933", "southeast wisconsin" => "#66cc99", "southwest wisconsin" => "#99ccff", "northeast wisconsin" => "#009999", "north central wisconsin" => "#66ccff", "northwest wisconsin" => "#99cccc" );
//@see:http://www.nekomataya.info/teck_info/taiyo_color
$statsocial_color_anime  = array( "bl" => "#110f11", "lb9" => "#1d1f29", "bb" => "#1c232b", "bl1" => "#283039", "10" => "#3c4249", "20" => "#4f5760", "30" => "#566169", "40" => "#66717a", "50" => "#717d87", "60" => "#7e8b94", "70" => "#8e9ba2", "80" => "#a5b3b8", "90" => "#b3c0c7", "95" => "#c2cdce", "100" => "#d2dad4", "w" => "#efefe2", "700g" => "#23262a", "600g" => "#2f2f39", "500g" => "#343649", "180g" => "#384156", "400g" => "#42435a", "300g" => "#5b5f73", "200g" => "#74798f", "99g" => "#909aae", "100g" => "#8fa4b9", "90g" => "#a5b5bf", "pb20" => "#2854a9", "cb6" => "#002289", "cb20" => "#0051b5", "cb30" => "#1160c0", "cb40" => "#3877c9", "cb50" => "#5a90d7", "cb60" => "#73a3d6", "cb80" => "#99badc", "cb90" => "#b3ccdc", "cb95" => "#cbdae0", "cb0" => "#d7e1e0", "nr0-1" => "#1b232c", "nr0" => "#222e40", "nr1" => "#303e62", "nr2" => "#41547a", "nr3" => "#4c6189", "nr4" => "#586f96", "nr5" => "#7694b0", "nr6" => "#8ba5c2", "bg6" => "#113f40", "144m" => "#007069", "tbg7" => "#2d9a9a", "bg5" => "#074b4f", "145m" => "#266966", "133m" => "#4e9d91", "x13" => "#005d71", "166m" => "#007589", "aa-7" => "#00adba", "bg16" => "#008f9b", "bg15" => "#00a5a8", "bg14" => "#4ebfc6", "o-01" => "#a1d4cb", "n13" => "#006074", "167m" => "#266372", "165m" => "#25808e", "c15" => "#3c8e98", "x4m" => "#2f5560", "x2m" => "#498291", "bg45" => "#009694", "bg85" => "#5cc2bd", "bg95" => "#a6dbcd", "n12" => "#003246", "n10" => "#004b67", "bs4" => "#00627b", "bs3" => "#008da5", "bs2" => "#2096ac", "bs1" => "#42b8c9", "bs-01" => "#7ec6ce", "b10" => "#004275", "b20" => "#0071a4", "b30" => "#0093c8", "b40" => "#009dcb", "b60" => "#20aed2", "b80" => "#70c7db", "b90" => "#a5d8dc", "b95" => "#badfdd", "n8" => "#0068a5", "n75" => "#007abd", "n7" => "#008dc7", "n6" => "#0097ce", "n4" => "#00a1d1", "n3" => "#42b5d5", "n2" => "#78c5ce", "cb10" => "#24354e", "a02" => "#4a6282", "a01" => "#6285ae", "bu5" => "#507fac", "bu4" => "#72a3c6", "gr6a" => "#99bcc7", "anr2" => "#1b4a76", "bu3" => "#245a81", "b36" => "#0051a7", "b37" => "#0063b2", "blue2" => "#007ec0", "bu2" => "#348fbb", "o" => "#89bfdb", "grb1" => "#a8cbdb", "bg20m" => "#455c60", "bg40m" => "#577977", "bg60m" => "#719a96", "bg70m" => "#82a9a2", "bg80m" => "#94bbaf", "bg90m" => "#b1cec1", "bw" => "#d1e7d8", "aw" => "#dfebdc", "yr10m" => "#4b3c38", "yr20m" => "#5f463d", "yr40m" => "#755549", "yr50m" => "#856757", "yr60m" => "#9e7d66", "yr2" => "#b1987f", "yr1" => "#cbb49c", "yr0" => "#dccbb5", "yr90m" => "#dcb995", "yr95m" => "#ddc3a2", "8a" => "#7c7e7e", "7a" => "#8b8d8c", "6a" => "#9d9f9d", "5a" => "#abaca9", "4a" => "#c4c1b8", "1a" => "#d2d2cb", "gt1" => "#969395", "gm1" => "#aea8a1", "gh3" => "#31292d", "gh2" => "#433d44", "gh1" => "#595058", "gb1" => "#777278", "yr100" => "#332c2a", "yr900" => "#3f3836", "yr28" => "#4e4342", "yr47" => "#5d524f", "yrd" => "#514c4c", "yrc" => "#61544f", "yrb" => "#7a6962", "yra" => "#897867", "yr3a" => "#9a8776", "yr85" => "#92857b", "yrm" => "#393532", "yy10" => "#3a3a39", "y28" => "#464240", "y9" => "#3e392f", "y47" => "#565449", "rb2" => "#7e8167", "rb1" => "#acae80", "yrf" => "#696861", "yre" => "#818377", "td1" => "#9c9b8a", "eb2" => "#595959", "eb1" => "#7b7d78", "et1" => "#969994", "gr6" => "#a7adac", "yr15" => "#774d3c", "yr50" => "#aa6a47", "s45" => "#c07d51", "lo1" => "#df8d5e", "mo1" => "#f8ae82", "ek55" => "#bc896b", "ek33" => "#f1ae87", "sm1" => "#fec89e", "sm3" => "#f8c5a5", "d50" => "#8d5b3f", "d40" => "#c0764e", "d30" => "#d7945d", "d20" => "#e9a472", "d1" => "#edb285", "d10" => "#e7b18a", "d0" => "#e7cfae", "63m" => "#6a4f3f", "bc60" => "#846b5b", "ek44" => "#c0a685", "tt2" => "#99927b", "tt1" => "#bcae93", "tm1" => "#d3c59f", "r20m" => "#674241", "r30m" => "#825453", "r40m" => "#8f554e", "r55m" => "#b76356", "r65m" => "#c77d70", "r70m" => "#d98778", "r75m" => "#df907e", "r80m" => "#f3ab94", "s1" => "#f2b8a4", "r90m" => "#f7bfae", "b35" => "#fa9b87", "bc9" => "#fcaf96", "b34" => "#f8b9a4", "11" => "#f3d4c5", "b32" => "#f4b497", "bc2" => "#f6ba9d", "bc20" => "#fabfa5", "bc0" => "#f9c6ad", "x20" => "#f1cfb5", "12" => "#f5dac9", "s20" => "#feb190", "s0" => "#f8c4a5", "x19" => "#f4caac", "13" => "#f6d2bd", "hb" => "#f1d4bb", "14" => "#f6ddc7", "s40" => "#db805a", "s3" => "#fba485", "c6" => "#7d4a36", "c5" => "#8c5341", "c4" => "#ab714c", "c3" => "#b88051", "c35" => "#c18b64", "c43" => "#ce9863", "yr75m" => "#c0844e", "c37" => "#cd9d6e", "c32" => "#e2bc8e", "ek44" => "#c5aa84", "c1a" => "#f0d2a3", "yr15m" => "#44342f", "yr25m" => "#563e32", "65m" => "#805842", "67m" => "#a16e4b", "69m" => "#cda36d", "bc1" => "#f5d7a7", "c0" => "#eee0c0", "bc01" => "#e4d2b3", "sf" => "#ece9cd", "sfm" => "#efecd3", "52" => "#50332d", "42" => "#5d342a", "45" => "#953c26", "46" => "#b24926", "or4" => "#d05c2b", "or3" => "#fc742a", "or2" => "#fe8a4f", "or1" => "#ffb56e", "yr20" => "#674032", "y8" => "#8d5134", "yr30" => "#ac4c35", "yr60" => "#c9633c", "yr65" => "#ee5e00", "d2" => "#fd803a", "yr75" => "#f28c4d", "yr80" => "#ffa157", "yr95" => "#ffba73", "s5" => "#feb973", "yr90" => "#deb87e", "c54" => "#e09d71", "bf40" => "#9f613e", "c70" => "#77452b", "c50" => "#915631", "yr70m" => "#b4845e", "yr80m" => "#d4a775", "yr90m" => "#dcb996", "yr95m" => "#ddc3a2", "y95" => "#eedf00", "y7" => "#886232", "y6" => "#b07727", "e2" => "#ce943d", "e34" => "#ffb347", "s6(old)" => "#ffc875", "x16" => "#ffc720", "s6" => "#ffcc59", "x18" => "#fdda7e", "d8" => "#4a3d30", "d6" => "#6f5135", "d4" => "#a26e40", "d3" => "#b9702b", "d04" => "#a6690d", "y50" => "#ee9611", "y85" => "#ffaf13", "f2" => "#fece20", "f32" => "#f8e473", "f31" => "#f0eab2", "f30" => "#f3e5be", "b7" => "#5e2923", "hb4" => "#8f2b1f", "bo6" => "#a94d2b", "bo5" => "#a83c26", "bo4" => "#be5e2a", "bo3" => "#ce6f30", "bo2" => "#fd871c", "bo1" => "#ffa100", "fd80" => "#8e6742", "aa5" => "#a57349", "c5a" => "#8a5a34", "pf1" => "#ab723b", "tpb1" => "#da9f53", "d1a" => "#dfa75e", "e30" => "#d3a047", "89" => "#d4a149", "aa4" => "#d3a454", "e70" => "#2e3128", "e60" => "#464027", "e5" => "#5d4f31", "e6" => "#836b40", "e4" => "#9c783b", "e3" => "#9e7f2e", "88" => "#c9b14d", "87" => "#d7bf65", "y136" => "#746638", "90m" => "#90753e", "89m" => "#c0a058", "ae1" => "#ad996f", "y91" => "#c3a569", "y92" => "#d1b26b", "e1" => "#e0c27d", "y10" => "#433931", "y20" => "#594638", "y40" => "#7a5d3f", "y60" => "#b88d2c", "y80" => "#cea645", "y70" => "#e0b800", "y90" => "#fdd010", "aa10" => "#916247", "cr25" => "#9c6a51", "bc57" => "#a67c64", "bc55" => "#ad866e", "bc47" => "#bb947c", "bc37" => "#ad8d75", "bc46" => "#be9d84", "bc45" => "#c7ad97", "bc10" => "#dbb49c", "cr5" => "#5a342c", "cr4" => "#784a3c", "cr3" => "#88503d", "cr2" => "#be7459", "cr1" => "#ce9276", "cr0" => "#d6ae94", "so19" => "#a67d6f", "so18" => "#ba8d7b", "pe2" => "#965d65", "pe1" => "#b9777f", "pn2" => "#956a66", "pn1" => "#be8680", "pfl2" => "#ab746d", "pfl1" => "#c6968b", "cfl2" => "#a36f62", "cfl1" => "#d19b87", "bc11" => "#d89e8b", "b81" => "#3b2928", "b9" => "#6f362e", "b7" => "#59271e", "b6" => "#7a322b", "821" => "#c7795b", "b5" => "#d72f2a", "b4" => "#e04236", "b3" => "#e75a4c", "b1" => "#ef7d71", "ps1" => "#c8433b", "td2" => "#904d3a", "afc" => "#a45750", "om4" => "#e66855", "r75" => "#f19175", "af1" => "#f28978", "cr30" => "#a05638", "yr40" => "#ad5c3d", "41-0m" => "#201d1f", "41m" => "#332226", "43m" => "#5a3c36", "44m" => "#693d32", "45m" => "#895340", "46m" => "#9f593e", "56n" => "#b37158", "66n" => "#c78f72", "sb80" => "#4e373b", "sb60" => "#6a4c51", "sb40" => "#866363", "sb20" => "#9b7a79", "sb0" => "#b59b97", "sb01" => "#cbb6ad", "rp20m" => "#532d2e", "rp30m" => "#6c3940", "rp40m" => "#974b57", "rp60m" => "#d96b7c", "rp2" => "#e09497", "rp1" => "#edb7b4", "rp0" => "#f0d0c5", "r30" => "#7f2734", "ar20" => "#901e34", "ar10" => "#b64957", "r10" => "#4a2a2d", "x37" => "#563132", "r10a" => "#6f3738", "x14" => "#552527", "aa2" => "#943a34", "30m" => "#7f3934", "26m" => "#a55146", "af1" => "#d26f5d", "r11" => "#251811", "x38" => "#3f2f31", "xr35" => "#534040", "r91" => "#73504e", "r89" => "#886868", "r77" => "#b89c98", "32r" => "#6c534f", "r82" => "#8a7070", "r78" => "#b29e95", "r76" => "#c9bbb2", "r83" => "#7f5750", "r79" => "#91675a", "ap40" => "#4e6db3", "ap60" => "#9b85c2", "ap80" => "#ccbfda", "p80" => "#cabad9", "p90" => "#d6cddd", "p40" => "#2657ab", "p50" => "#4a71be", "p60" => "#6887c4", "p70" => "#929dcf", "np2" => "#acabc6", "apb80" => "#cccbde", "nr12" => "#283459", "nr11" => "#333d6c", "p8(old)" => "#46539b", "pb40" => "#616eb2", "pb60" => "#7e8ac6", "pb70" => "#98a6d4", "pb80" => "#b4bad6", "pb90" => "#c3cbdd", "p8" => "#4b57a1", "p6" => "#6c79bf", "p4" => "#7789c8", "p2" => "#91a8d2", "p1" => "#aeb9d6", "p0" => "#c8cad8", "p01" => "#cbd0d2", "nrq9" => "#252944", "q9" => "#322e54", "q7" => "#3e3667", "p10" => "#625a85", "q5" => "#716691", "q3" => "#928aa8", "q50" => "#514269", "q40" => "#614c71", "q30" => "#7d6993", "q25" => "#8e7da3", "q20" => "#a893af", "q10" => "#bfb1b9", "p20" => "#601377", "v6" => "#352659", "v5" => "#4d3069", "v4" => "#74498a", "v3" => "#745ea4", "v2" => "#9383ba", "v1" => "#c7bcd6", "rp40" => "#9a6695", "rp60" => "#ca92b8", "rp70" => "#d1a2c0", "rp80" => "#e5d3e2", "rp90" => "#e8dae4", "rp95" => "#ebe1dd", "rp99" => "#ece6de", "rp100" => "#eceae0", "x33" => "#432131", "m128" => "#653947", "m127" => "#774956", "m3" => "#512d43", "m2" => "#6e3957", "m126" => "#9c5177", "a4" => "#a7588a", "a3" => "#b675a1", "a20" => "#d294b1", "a1" => "#e1ccdb", "r8" => "#562a58", "r6" => "#73396d", "xr5" => "#91508d", "r4" => "#b577ae", "r2" => "#d1acc8", "aa4" => "#9d83a5", "aa2" => "#be9db5", "aa1" => "#cab5c8", "r11" => "#1a0f11", "21" => "#3c1e21", "rp5" => "#5f2532", "r51" => "#b3214f", "rr5" => "#a74556", "rr4" => "#b86077", "rr3" => "#d99091", "rr2" => "#dd8d96", "rr1" => "#e8abad", "rr0" => "#f0c5bf", "871" => "#ab6e89", "ap2" => "#c390b3", "ap3" => "#c791b6", "ap4" => "#cc9fc1", "rp10" => "#381f2d", "rp20" => "#681e4d", "aa5" => "#a25f8b", "r12" => "#3f1912", "r26" => "#4e1d1c", "r20" => "#70071e", "r25" => "#930016", "r40" => "#d52839", "r70" => "#e75456", "r75" => "#f4876a", "x28" => "#ad002b", "x27" => "#d12b40", "sf4" => "#d93343", "sy4" => "#e75862", "sy3" => "#ee887e", "r5" => "#9c0025", "r1" => "#b8023f", "r3" => "#c1113f", "r7" => "#d7465b", "r50" => "#e38386", "pb6" => "#92002e", "pb4" => "#b74155", "r60" => "#cb6c70", "r80" => "#da8092", "r90" => "#e7a1a7", "ag2" => "#006841", "ag3" => "#008856", "ag4" => "#009e5b", "g11" => "#00372d", "g20" => "#005340", "g40" => "#007647", "g60" => "#00a071", "gt2" => "#27b680", "g80" => "#65c789", "g90" => "#8bd59f", "g90a" => "#9edbb1", "go5" => "#223d29", "go4" => "#3f5337", "go3" => "#596539", "go2" => "#788554", "go1" => "#a6ae7b", "x21" => "#b6c489", "g10b" => "#252c2a", "g10" => "#364132", "gy12" => "#49593f", "gy13" => "#566951", "gy11" => "#657158", "g9" => "#728567", "g8" => "#99b18e", "g7" => "#d6eab3", "gy20" => "#3f5336", "gy40" => "#71764c", "gy3" => "#798941", "g3" => "#7a9b31", "aa6" => "#bcbb55", "i7" => "#1d5429", "x29" => "#407a43", "x30" => "#58955a", "fg90" => "#346c53", "g6" => "#538561", "g4a" => "#63a874", "i6" => "#006a06", "i5" => "#009115", "gy60" => "#4fb42f", "gy80" => "#83c934", "gy90" => "#bbe07b", "x7" => "#242b37", "x6" => "#2f3c49", "x5" => "#334a5a", "x4" => "#4d5e6a", "x3" => "#53727c", "x2" => "#5b8288", "x1" => "#719ca3", "b70m" => "#74979d", "pan-2" => "#6d979f", "pan-1" => "#96bdc1", "o-50" => "#404e5b", "o-40" => "#586c75", "o-30" => "#5f8691", "o-20" => "#65a5af", "o-10" => "#8bc0c3", "ms20" => "#002631", "bg20" => "#00676d", "bg40" => "#008672", "bg60" => "#00a282", "bg80" => "#50c2aa", "bg90" => "#aee0c7" );
