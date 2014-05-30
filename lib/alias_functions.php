<?php

/**
 * This functions has alias function
 *
 *
 * @package WordPress
 * @subpackage statsocial
 * @since statsocial 0.931
 */
?>
<?php

if ( !function_exists( 'statsocial_content_width_clone' ) ) {

    /**
     * Caluculate statsocial content width
     *
     *
     * @see statsocial_content_width( )
     *
     */
    function statsocial_content_width_clone() {
        global $statsocial_page_width;
        $adjust              = 16;
        $default             = 400;
        $document_width      = statsocial_warehouse_clone( 'statsocial_page_width' );
        $sidebar_width       = 'yui-' . statsocial_warehouse_clone( 'statsocial_col_width' );
        $extra_sidebar_width = statsocial_warehouse_clone( 'statsocial_right_sidebar_width_percent' );
        if ( isset( $statsocial_page_width ) && !empty( $statsocial_page_width ) ) {
            $w      = $statsocial_page_width;
            $adjust = 16;
            if ( 'yui-t1' == $sidebar_width ) {
                $statsocial_content_width = $w - 160 - $adjust;
            } elseif ( 'yui-t2' == $sidebar_width ) {
                $statsocial_content_width = $w - 180 - $adjust;
            } elseif ( 'yui-t3' == $sidebar_width ) {
                $statsocial_content_width = $w - 300 - $adjust;
            } elseif ( 'yui-t4' == $sidebar_width ) {
                $statsocial_content_width = $w - 180 - $adjust;
            } elseif ( 'yui-t5' == $sidebar_width ) {
                $statsocial_content_width = $w - 240 - $adjust;
            } elseif ( 'yui-t6' == $sidebar_width ) {
                $statsocial_content_width = $w - 300 - $adjust;
            } else {
                $statsocial_content_width = $default;
            }
        } else {
            if ( 'doc' == $document_width ) {
                $w      = 750;
                $adjust = 16;
                if ( 'yui-t1' == $sidebar_width ) {
                    $statsocial_content_width = $w - 160 - $adjust;
                } elseif ( 'yui-t2' == $sidebar_width ) {
                    $statsocial_content_width = $w - 180 - $adjust;
                } elseif ( 'yui-t3' == $sidebar_width ) {
                    $statsocial_content_width = $w - 300 - $adjust;
                } elseif ( 'yui-t4' == $sidebar_width ) {
                    $statsocial_content_width = $w - 180 - $adjust;
                } elseif ( 'yui-t5' == $sidebar_width ) {
                    $statsocial_content_width = $w - 240 - $adjust;
                } elseif ( 'yui-t6' == $sidebar_width ) {
                    $statsocial_content_width = $w - 300 - $adjust;
                } else {
                    $statsocial_content_width = $default;
                }
            } elseif ( 'doc2' == $document_width ) {
                $w      = 950;
                $adjust = 16;
                if ( 'yui-t1' == $sidebar_width ) {
                    $statsocial_content_width = $w - 160 - $adjust;
                } elseif ( 'yui-t2' == $sidebar_width ) {
                    $statsocial_content_width = $w - 180 - $adjust;
                } elseif ( 'yui-t3' == $sidebar_width ) {
                    $statsocial_content_width = $w - 300 - $adjust;
                } elseif ( 'yui-t4' == $sidebar_width ) {
                    $statsocial_content_width = $w - 180 - $adjust;
                } elseif ( 'yui-t5' == $sidebar_width ) {
                    $statsocial_content_width = $w - 240 - $adjust;
                } elseif ( 'yui-t6' == $sidebar_width ) {
                    $statsocial_content_width = $w - 300 - $adjust;
                } else {
                    $statsocial_content_width = $default;
                }
            } elseif ( $document_width == 'doc3' ) {
                //$statsocial_content_width = 0;
                $w = 950;
                if ( 'yui-t1' == $sidebar_width ) {
                    $statsocial_content_width = $w - 160 - $adjust;
                } elseif ( 'yui-t2' == $sidebar_width ) {
                    $statsocial_content_width = $w - 180 - $adjust;
                } elseif ( 'yui-t3' == $sidebar_width ) {
                    $statsocial_content_width = $w - 300 - $adjust;
                } elseif ( 'yui-t4' == $sidebar_width ) {
                    $statsocial_content_width = $w - 180 - $adjust;
                } elseif ( 'yui-t5' == $sidebar_width ) {
                    $statsocial_content_width = $w - 240 - $adjust;
                } elseif ( 'yui-t6' == $sidebar_width ) {
                    $statsocial_content_width = $w - 300 - $adjust;
                } else {
                    $statsocial_content_width = $default;
                }
                /*
                  Fluid Responsive layout can not set correct value
                  but needs fallback value.
                  return 0 makes full size editor display improperly.
                 */
            } elseif ( $document_width == 'doc4' ) {
                $w      = 974;
                $adjust = 16;
                if ( 'yui-t1' == $sidebar_width ) {
                    $statsocial_content_width = $w - 160 - $adjust;
                } elseif ( 'yui-t2' == $sidebar_width ) {
                    $statsocial_content_width = $w - 180 - $adjust;
                } elseif ( 'yui-t3' == $sidebar_width ) {
                    $statsocial_content_width = $w - 300 - $adjust;
                } elseif ( 'yui-t4' == $sidebar_width ) {
                    $statsocial_content_width = $w - 180 - $adjust;
                } elseif ( 'yui-t5' == $sidebar_width ) {
                    $statsocial_content_width = $w - 240 - $adjust;
                } elseif ( 'yui-t6' == $sidebar_width ) {
                    $statsocial_content_width = $w - 300 - $adjust;
                } else {
                    $statsocial_content_width = $default;
                }
            }
        }
        if ( statsocial_warehouse_clone( 'statsocial_show_right_sidebar' ) !== 'show' ) {
            return $statsocial_content_width;
        } else {
            if ( '25' == $extra_sidebar_width ) {
                return round( $statsocial_content_width * 0.74 );
            } elseif ( '75' == $extra_sidebar_width ) {
                return round( $statsocial_content_width * 0.24 );
            } elseif ( '33' == $extra_sidebar_width ) {
                return round( $statsocial_content_width * 0.74 );
            } elseif ( '66' == $extra_sidebar_width ) {
                return round( $statsocial_content_width * 0.32 );
            } elseif ( '50' == $extra_sidebar_width ) {
                return round( $statsocial_content_width * 0.49 );
            } else {
                return round( $statsocial_content_width );
            }
        }
        return $statsocial_content_width;
    }

}
if ( !function_exists( 'statsocial_warehouse_clone' ) ) {

    /**
     * return statsocial settings
     *
     *
     * @see statsocial_warehouse( )
     *
     */
    function statsocial_warehouse_clone( $name ) {
        global $statsocial_base_setting;
        global $statsocial_page_width;
        $vertical = array();
        if ( isset( $statsocial_base_setting ) ) {
            foreach ( $statsocial_base_setting as $key => $val ) {
                if ( !is_null( $statsocial_base_setting ) ) {
                    $vertical[] = $val[ 'option_name' ];
                }
            }
            $row = array_search( $name, $vertical );
            if ( isset( $statsocial_page_width ) && !empty( $statsocial_page_width ) && 'statsocial_page_width' == $name ) {
                return 'custom-doc';
            }
            $result = get_option( 'statsocial_theme_settings' );
            if ( isset( $result[ $name ] ) && !empty( $result[ $name ] ) ) {
                return apply_filters( 'statsocial_theme_settings_' . $name, $result[ $name ] );
            } elseif ( isset( $statsocial_base_setting[ $row ][ 'option_value' ] ) && !empty( $statsocial_base_setting[ $row ][ 'option_value' ] ) ) {
                return apply_filters( 'statsocial_theme_settings_' . $row, $statsocial_base_setting[ $row ][ 'option_value' ] );
            } else {
                return false;
            }
        }
    }

}
if ( !function_exists( 'statsocial_gradient_single_clone' ) ) {

    /**
     * create gradient color and background style rule
     *
     *
     * @see statsocial_gradient_single( )
     *
     */
    function statsocial_gradient_single_clone( $i, $order = "asc" ) {
        $g = "";
        if ( $i > 4 ) {
            $i = 4;
        }
        if ( "asc" == $order ) {
            $custom_dark_bg1  = statsocial_colors_clone( $i, 'background' );
            $custom_light_bg1 = statsocial_colors_clone( $i + 1, 'background' );
        } elseif ( "desc" == $order ) {
            $custom_dark_bg1  = statsocial_colors_clone( $i + 1, 'background' );
            $custom_light_bg1 = statsocial_colors_clone( $i, 'background' );
        }
        $g.= 'background: -webkit-gradient( linear, left top, left bottom, from( ' . $custom_dark_bg1 . ' ), to( ' . $custom_light_bg1 . ' ) );';
        $g.= 'background: -moz-linear-gradient( top,  ' . $custom_dark_bg1 . ',  ' . $custom_light_bg1 . ' );';
        $g.= 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $custom_dark_bg1 . '\', endColorstr=\'' . $custom_light_bg1 . '\' );';
        return $g;
    }

}
if ( !function_exists( 'statsocial_gradient_clone' ) ) {

    /**
     * create gradient set color and background style rule
     *
     *
     * @see statsocial_gradient( )
     *
     */
    function statsocial_gradient_clone() {
        $g = "";
        for ( $i = 1; $i < 5; $i++ ) {
            $custom_dark_bg1  = statsocial_colors_clone( $i, 'background' );
            $custom_light_bg1 = statsocial_colors_clone( $i + 1, 'background' );
            $custom_dark_bg2  = statsocial_colors_clone( $i, 'background' );
            $custom_light_bg2 = statsocial_colors_clone( $i - 1, 'background' );
            $g.= '.gradient' . $i . '{';
            $g.= 'color:' . statsocial_colors_clone( $i, 'color' ) . ';';
            $g.= 'background: -webkit-gradient( linear, left top, left bottom, from( ' . $custom_dark_bg1 . ' ), to( ' . $custom_light_bg1 . ' ) );';
            $g.= 'background: -moz-linear-gradient( top,  ' . $custom_dark_bg1 . ',  ' . $custom_light_bg1 . ' );';
            $g.= 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $custom_dark_bg1 . '\', endColorstr=\'' . $custom_light_bg1 . '\' );';
            $g.= "}\n";
            $g.= '.gradient' . $i . ' a{';
            $g.= 'color:' . statsocial_colors_clone( $i, 'color' ) . ';';
            $g.= "}\n";
            $g.= '.gradient-' . $i . '{';
            $g.= 'color:' . statsocial_colors_clone( $i, 'color' ) . ';';
            $g.= 'background: -webkit-gradient( linear, left top, left bottom, from( ' . $custom_dark_bg2 . ' ), to( ' . $custom_light_bg2 . ' ) );';
            $g.= 'background: -moz-linear-gradient( top,  ' . $custom_dark_bg2 . ',  ' . $custom_light_bg2 . ' );';
            $g.= 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $custom_dark_bg2 . '\', endColorstr=\'' . $custom_light_bg2 . '\' );';
            $g.= "}\n";
            $g.= '.gradient-' . $i . ' a{';
            $g.= 'color:' . statsocial_colors_clone( $i, 'color' ) . ';';
            $g.= "}\n";
        }
        return $g;
    }

}

/**
 * Create CSS Color Declaration
 *
 *
 *
 *
 */
function statsocial_colors_clone( $num = 0, $select = 'set', $color1 = null ) {
    global $statsocial_images_path;
    if ( $color1 == null ) {
        $color1 = str_replace( '#', "", statsocial_warehouse_clone( 'statsocial_base_color' ) );
    } else {
        $color1 = str_replace( '#', "", $color1 );
    }
    $base = new statsocial_CSS_Color( $color1 );
    switch ( $num ) {
        case ( 0 ):
            $bg    = $base->bg[ '0' ];
            $fg    = $base->fg[ '0' ];
            $color = "color:#$fg;background-color:#$bg;";
            break;

        case ( -1 ):
            $bg    = $base->bg[ '-1' ];
            $fg    = $base->fg[ '-1' ];
            $color = "color:#$fg;background-color:#$bg;";
            break;

        case ( -2 ):
            $bg    = $base->bg[ '-2' ];
            $fg    = $base->fg[ '-2' ];
            $color = "color:#$fg;background-color:#$bg;";
            break;

        case ( -3 ):
            $bg    = $base->bg[ '-3' ];
            $fg    = $base->fg[ '-3' ];
            $color = "color:#$fg;background-color:#$bg;";
            break;

        case ( -4 ):
            $bg    = $base->bg[ '-4' ];
            $fg    = $base->fg[ '-4' ];
            $color = "color:#$fg;background-color:#$bg;";
            break;

        case ( -5 ):
            $bg    = $base->bg[ '-5' ];
            $fg    = $base->fg[ '-5' ];
            $color = "color:#$fg;\n\tbackground-color:#$bg;";
            break;

        case ( 1 ):
            $bg    = $base->bg[ '+1' ];
            $fg    = $base->fg[ '+1' ];
            $color = "color:#$fg;\n\tbackground-color:#$bg;";
            break;

        case ( 2 ):
            $bg    = $base->bg[ '+2' ];
            $fg    = $base->fg[ '+2' ];
            $color = "color:#$fg;\n\tbackground-color:#$bg;";
            break;

        case ( 3 ):
            $bg    = $base->bg[ '+3' ];
            $fg    = $base->fg[ '+3' ];
            $color = "color:#$fg;\n\tbackground-color:#$bg;";
            break;

        case ( 4 ):
            $bg    = $base->bg[ '+4' ];
            $fg    = $base->fg[ '+4' ];
            $color = "color:#$fg;\n\tbackground-color:#$bg;";
            break;

        case ( 5 ):
            $bg    = $base->bg[ '+5' ];
            $fg    = $base->fg[ '+5' ];
            $color = "color:#$fg;\n\tbackground-color:#$bg;";
            break;

        default:
            $bg    = $base->bg[ '0' ];
            $fg    = $base->fg[ '0' ];
            $color = "color:#$fg;\n\tbackground-color:#$bg;";
            break;
    }
    switch ( $select ) {
        case ( 'set' ):
            return $color;
            break;

        case ( 'background' ):
            return '#' . $bg;
            break;

        case ( 'color' ):
            return '#' . $fg;
            break;
    }
}

/**
 * Declaration Calculator
 *
 *
 *
 *
 */
function statsocial_design_output_clone( $name = 'dark' ) {
    $statsocial_images_path  = get_stylesheet_directory_uri() . '/images/';
    $navigation_title_img   = statsocial_warehouse_clone( 'statsocial_heading_image' );
    $statsocial_header_image = statsocial_warehouse_clone( 'statsocial_header_image' );
    $statsocial_header_color = statsocial_warehouse_clone( 'statsocial_default_fonts_color' );
    $statsocial_footer_image = statsocial_warehouse_clone( 'statsocial_footer_image' );
    $statsocial_footer_color = statsocial_warehouse_clone( 'statsocial_footer_color' );
    if ( empty( $name ) ) {
        $name = 'dark';
    }
    $c_border = statsocial_colors_clone( 0, 'background' );
    if ( '#' == $c_border ) {
        $rgba_border = 'rgba( 203,203,203, 0.8 )';
    } else {
        $rgba_border = statsocial_hex2rgba( $c_border, 0.5 );
    }
    $c1 = statsocial_colors_clone( 0 );
    $c1 = statsocial_colors_clone( 1 );

    $c2         = statsocial_colors_clone( 2 );
    $c3         = statsocial_colors_clone( 3 );
    $c4         = statsocial_colors_clone( 4 );
    $c5         = statsocial_colors_clone( 5 );
    $c_1        = statsocial_colors_clone( -1 );
    $c_2        = statsocial_colors_clone( -2 );
    $c_3        = statsocial_colors_clone( -3 );
    $c_4        = statsocial_colors_clone( -4 );
    $c_5        = statsocial_colors_clone( -5 );
    $position_y = statsocial_warehouse_clone( 'statsocial_heading_image_position' );
    $y          = $position_y * 26;
    $y          = '-' . $y . 'px';
    switch ( $position_y ) {
        case ( 0 ):
            $h_position_rsidebar_h2 = "background-position:0 0;";
            break;

        case ( 1 ):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            break;

        case ( 2 ):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            break;

        case ( 3 ):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            break;

        case ( 4 ):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            break;

        case ( 5 ):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            break;

        case ( 6 ):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            break;

        case ( 7 ):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            break;

        default:
            $h_position_rsidebar_h2 = "background-position:0 208px;";
            break;
    }
    $h2_w3standard_background = "background:" . statsocial_colors_clone( 5, 'background' ) . ' ';
    $h2_w3standard_background.= "url( {$statsocial_images_path}{$navigation_title_img} );";
    $h2_w3standard_background.= "color:" . statsocial_colors_clone( 4, 'color' ) . ';';
    $h2_dark_background       = "background:" . statsocial_colors_clone( -3, 'background' ) . ' ';
    $h2_dark_background.= "url( {$statsocial_images_path}{$navigation_title_img} );";
    $h2_dark_background.= "color:" . statsocial_colors_clone( -3, 'color' ) . ';';
    $h2_light_background      = "background:" . statsocial_colors_clone( 4, 'background' ) . ' ';
    $h2_light_background.= "url( {$statsocial_images_path}{$navigation_title_img} );";
    $h2_light_background.= "color:" . statsocial_colors_clone( 4, 'color' ) . ';';
    switch ( $name ) {
        case ( "w3standard" ):
            $custom_dark_bg  = statsocial_colors_clone( '3', 'background' );
            $custom_light_bg = statsocial_colors_clone( '1', 'background' );
            $custom_color    = statsocial_colors_clone( '1', 'color' );
            if ( !empty( $statsocial_footer_color ) ) {
                $statsocial_footer_color = $statsocial_footer_color;
            } else {
                $statsocial_footer_color = '#000';
            }
            if ( !empty( $statsocial_header_color ) ) {
                $statsocial_header_color = $statsocial_header_color;
            } else {
                $statsocial_header_color = '#000';
            }
            $gradient = statsocial_gradient_clone();
            break;

        case ( "dark" ):
            /**
             * dark
             */
            $custom_dark_bg  = statsocial_colors_clone( '-1', 'background' );
            $custom_light_bg = statsocial_colors_clone( '-4', 'background' );
            $custom_color    = statsocial_colors_clone( '-3', 'color' );
            if ( !empty( $statsocial_footer_color ) ) {
                $statsocial_footer_color = $statsocial_footer_color;
            } else {
                $statsocial_footer_color = '#fff';
            }
            if ( !empty( $statsocial_header_color ) ) {
                $statsocial_header_color = $statsocial_header_color;
            } else {
                $statsocial_header_color = '#fff';
            }
            $gradient = statsocial_gradient_clone();
            break;

        case ( "light" ):
            /**
             * light
             */
            $custom_dark_bg  = statsocial_colors_clone( '5', 'background' );
            $custom_light_bg = statsocial_colors_clone( '3', 'background' );
            $custom_color    = statsocial_colors_clone( '3', 'color' );
            $base_gradient   = statsocial_gradient_single_clone( 3, "asc" );
            if ( !empty( $statsocial_footer_color ) ) {
                $statsocial_footer_color = $statsocial_footer_color;
            } else {
                $statsocial_footer_color = '#333';
            }
            if ( !empty( $statsocial_header_color ) ) {
                $statsocial_header_color = $statsocial_header_color;
            } else {
                $statsocial_header_color = '#333';
            }
            $gradient = statsocial_gradient_clone();
            break;

        default:
            $custom_dark_bg  = statsocial_colors_clone( '3', 'background' );
            $custom_light_bg = statsocial_colors_clone( '1', 'background' );
            $custom_color    = statsocial_colors_clone( '1', 'color' );
            if ( !empty( $statsocial_footer_color ) ) {
                $statsocial_footer_color = $statsocial_footer_color;
            } else {
                $statsocial_footer_color = '#000';
            }
            if ( !empty( $statsocial_header_color ) ) {
                $statsocial_header_color = $statsocial_header_color;
            } else {
                $statsocial_header_color = '#000';
            }
            $gradient = statsocial_gradient_clone();
            break;
    }
    $function_name = 'statsocial_indv_css_' . $name;
    if ( function_exists( $function_name ) ) {

        $content = $function_name();

        foreach ( explode( ' ', $content, -1 ) as $line ) {

            preg_match_all( '|%([a-z0-9_-]+)?%|si', $line, $regs, PREG_SET_ORDER );

            foreach ( $regs as $reg ) {

                if ( isset( $$reg[ 1 ] ) ) {

                    $content = str_replace( $reg[ 0 ], $$reg[ 1 ], $content );
                } else {
                    $content = str_replace( $reg[ 0 ], '/*cannot bind data [%' . $reg[ 1 ] . '%]*/', $content );
                }
            }
        }
        return apply_filters( "statsocial_colors", $content );
    }
}

/**
 * Base Color Class Create
 *
 *
 *
 *
 */
function statsocial_color_base_clone( $color1 = null, $class = null ) {
    global $statsocial_images_path;
    if ( null == $color1 ) {
        $color1 = str_replace( '#', "", statsocial_warehouse_clone( 'statsocial_base_color' ) );
    } else {
        $color1 = str_replace( '#', "", $color1 );
    }

    if ( $class == null ) {

        $class = 'color';
        $face  = 'face';
    } else {

        $class = sanitize_key( $class );
        $face  = 'face-' . $class;
    }
    $base   = new statsocial_CSS_Color( $color1 );
    $bg_1   = $base->bg[ '-1' ];
    $fg_1   = $base->fg[ '-1' ];
    $bg_2   = $base->bg[ '-2' ];
    $fg_2   = $base->fg[ '-2' ];
    $bg_3   = $base->bg[ '-3' ];
    $fg_3   = $base->fg[ '-3' ];
    $bg_4   = $base->bg[ '-4' ];
    $fg_4   = $base->fg[ '-4' ];
    $bg_5   = $base->bg[ '-5' ];
    $fg_5   = $base->fg[ '-5' ];
    $bg1    = $base->bg[ '+1' ];
    $fg1    = $base->fg[ '+1' ];
    $bg2    = $base->bg[ '+2' ];
    $fg2    = $base->fg[ '+2' ];
    $bg3    = $base->bg[ '+3' ];
    $fg3    = $base->fg[ '+3' ];
    $bg4    = $base->bg[ '+4' ];
    $fg4    = $base->fg[ '+4' ];
    $bg5    = $base->bg[ '+5' ];
    $fg5    = $base->fg[ '+5' ];
    $result = <<<CSS
.{$class}-1 a,
.{$class}-1{
  background:#{$bg_1};
  color:#{$fg_1};
}
.{$class}-2 a,
.{$class}-2 {
  background:#{$bg_2};
  color:#{$fg_2};
}
.{$class}-3 a,
.{$class}-3 {
  background:#{$bg_3};
  color:#{$fg_3};
}
.{$class}-4 a,
.{$class}-4 {
  /** Use the base {$class}, two shades darker */
  background:#{$bg_4};
  /** Use the corresponding foreground {$class} */
  color:#{$fg_4};
}
.{$class}-5 a,
.{$class}-5 {
  background:#{$bg_5};
  color:#{$fg_5};
}
.{$class}1 a,
.{$class}1{
  background:#{$bg1};
  color:#{$fg1};
}
.{$class}2 a,
.{$class}2 {
  background:#{$bg2};
  color:#{$fg2};
}
.{$class}3 a,
.{$class}3 {
  background:#{$bg3};
  color:#{$fg3};
}
.{$class}4 a,
.{$class}4 {
  /** Use the base color, two shades darker */
  background:#{$bg4};
  /** Use the corresponding foreground color */
  color:#{$fg4};
}
.{$class}5 a,
.{$class}5 {
  background:#{$bg5};
  color:#{$fg5};
}
.{$face}-1{
  color:#{$fg_1};
}
.{$face}-2 {
  color:#{$fg_2};
}
.{$face}-3 {
  color:#{$fg_3};
}
.{$face}-4 {
  color:#{$fg_4};
}
.{$face}-5 {
  color:#{$fg_5};
}
.{$face}1{
  color:#{$fg1};
}
.{$face}2 {
  color:#{$fg2};
}
.{$face}3 {
  color:#{$fg3};
}
.{$face}4 {
  color:#{$fg4};
}
.{$face}5 {
  color:#{$fg5};
}
CSS;
    return $result;
}

/**
 * register style name
 *
 *
 *
 *
 */
function statsocial_register_styles_clone( $style_name ) {
    static $vals;
    $vals[ $style_name ] = $style_name;
    return $vals;
}

?>