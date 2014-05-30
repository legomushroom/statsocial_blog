<?php

/**
 * Filter and actions for statsocial theme
 *
 *
 * @package statsocial
 * @since statsocial 0.948
 */
add_action( 'after_setup_theme', 'statsocial_theme_setup' );
if ( !function_exists( 'statsocial_theme_setup' ) ) {

    function statsocial_theme_setup() {
        global $statsocial_wp_version;
        add_filter( 'use_default_gallery_style', '__return_false' );
        /**
         *
         *
         *
         *
         *
         */
        add_action( 'load-themes.php', 'statsocial_install_navigation' );
        /**
         *
         *
         *
         *
         *
         */
        add_editor_style();
        /**
         *
         *
         *
         *
         * thanks ison
         */
        add_filter( 'wp_page_menu_args', 'statsocial_page_menu_args' );
        /**
         *
         *
         *
         *
         *
         */
        /* 		if (  $statsocial_wp_version < '3.4'  ) {
          add_filter( "wp_head", "statsocial_embed_meta", '90' );
          } */
        /**
         *
         *
         *
         *
         *
         */
        add_filter( 'comment_form_default_fields', 'statsocial_comment_form' );
        /**
         *
         *
         *
         *
         *
         */
        add_filter( 'the_meta_key', 'statsocial_filter_explode_meta_keys', 10, 2 );
        /**
         *
         *
         *
         *
         *
         */
        add_filter( 'body_class', 'statsocial_add_body_class' );
        /**
         *
         *
         *
         *
         *
         */
        add_filter( 'comment_form_field_comment', 'statsocial_custom_remove_aria_required' );
        /**
         *
         *
         *
         *
         *
         */
        add_filter( 'the_meta_key', 'statsocial_filter_explode_meta_keys', 10, 2 );
        /**
         *
         *
         *
         *
         *
         */
        add_filter( 'the_title', 'statsocial_fallback_title', 10, 2 );
        /**
         *
         *
         *
         *
         *
         */
        add_filter( 'the_content', 'statsocial_ie_height_expand_issue' );
        /**
         *
         *
         *
         * 	@since 1.100
         */
        add_filter( 'widget_text', 'statsocial_ie_height_expand_issue' );
        /**
         *
         *
         *
         *
         *
         */
        //    if (  !is_admin(  )  ) {
        // add_action( 'wp_print_styles', 'add_statsocial_stylesheet' );
        //    }

        /**
         *
         *
         *
         *
         *
         */
        add_action( 'admin_init', 'statsocial_options_init' );
        /**
         *
         *
         *
         *
         *
         */
        add_filter( 'wp_title', 'statsocial_filter_title', 10, 3 );
        /**
         *
         *
         *
         *
         * @since 0.956
         */
        add_action( 'wp_enqueue_scripts', 'statsocial_enqueue_comment_reply' );
        /**
         *
         *
         *
         *
         * @since 0.956
         */
        add_action( 'customize_controls_print_styles', 'statsocial_customize_controls_print_styles' );
        /**
         *
         *
         *
         *
         * @since 0.964 ?
         */
        add_filter( 'widget_text', 'do_shortcode' );
        /**
         *
         *
         *
         * @since 0.992
         */
        add_action( 'wp_head', 'statsocial_mobile_meta' );
        /**
         * Switch elements from div to figure when doctype html5
         *
         *
         * @since 1.003
         */
        add_filter( 'img_caption_shortcode', 'statsocial_img_caption_shortcode_filter', 10, 3 );
        /**
         * Archive link title add string 'Archives ' for for screen reader
         *
         *
         * @since 1.008
         */
        add_filter( 'get_archives_link', 'statsocial_accessible_titled' );
        /**
         *
         *
         *
         * @since 1.008
         */
        add_filter( 'the_category', 'statsocial_remove_category_rel' );
        /**
         *
         *
         *
         * @since 1.136
         */
        add_filter( 'theme_mod_header_textcolor', 'statsocial_filter_header_text_color' );
        /**
         *
         *
         *
         * @since 1.211
         */
        add_action( 'wp_footer', 'statsocial_status_bar' );
        /*
         * 
         * 
         * 
         * @since 1.217
         */
        add_filter('query_vars','statsocial_extend_query');
    }

}
?>