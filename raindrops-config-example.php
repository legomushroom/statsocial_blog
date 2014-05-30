<?php

/** statsocial Cofig file
 *
 *
 * Please Rename from statsocial-config-example.php
 * 				 to   statsocial-config.php
 *
 */
/** Theme Option Page
 *
 *
 * true Shows Theme option page
 * false Hide Theme option page
 * default true
 */
$statsocial_show_theme_option = true;

/** Shows Place holder for insert contents
 *
 * When WP_DEBUG value true and $statsocial_actions_hook_message value true
 * Show statsocial action filter position and examples
 *
 * default false
 * @since 0.980
 */
$statsocial_actions_hook_message = false;

/** Browser Detection Server Side or Cliant Side
 * 
 * use server side browser detection or javascript browser ditection
 *
 * javascript browser ditection is At a target [ operate / even when cash plug-in is used / properly ]
 * value bool
 * default false ( cliant side javascript )
 * ver 1.121
 */
$statsocial_browser_detection = false;

/** Custom Page width for Fixed Width
 * Original page width implementation by manual labor
 *
 * If you need original page width
 * you can specific pixel page width
 * e.g. '$statsocial_page_width = '776';' is  776px page width.
 *
 * default ''
 */
$statsocial_page_width = '';

/** Custom Page width for fluid ( responsive )
 *
 * fluid page  main column maximum width px
 *
 *
 *
 * $statsocial_fluid_maximum_width
 * default 1280
 *
 */
$statsocial_fluid_maximum_width = '1280';

/** UPLOAD IMAGE
 *
 *
 *
 *
 */
$statsocial_allow_file_type = array( 'image/png', 'image/jpeg', 'image/jpg', 'image/gif' );

//max upload size byte
$statsocial_max_upload_size = 2000000;

//header or footer image max width px
$statsocial_max_width = 1300;

/**
 * Show statsocial status bar at browser bottom
 *
 * shows true hide false
 * @since 1.211
 */
$statsocial_status_bar = true;
/**
 * Featured image size
 * 
 * full size or single-post-thumbnail 600x200 size
 * since 1.215
 */
 $statsocial_featured_image_full_size = true;
/**
 * Custom fields name css is add to post style rules.
 *
 * When false add to style single post and pages
 * When true add to style all list style posts and pages
 * statsocial_OVERRIDE_POST_STYLE_ALL_CONTENTS
 * @since 0.992
 */
define( "statsocial_OVERRIDE_POST_STYLE_ALL_CONTENTS", true );

/** Show Post Delete link 
 *
 *
 *
 * statsocial_SHOW_DELETE_POST_LINK
 *
 */
define( "statsocial_SHOW_DELETE_POST_LINK", false );

/** Excerpt Settings
 *
 * the_content(   ) or the_excerpt
 *
 * the_excerpt use where index,archive,other not single pages.
 * If statsocial_USE_LIST_EXCERPT value false and use the_content .
 *
 * statsocial_USE_LIST_EXCERPT
 * add ver 1.127
 * When use excerpt please set $statsocial_where_excerpts
 */
define( "statsocial_USE_LIST_EXCERPT", false );

// values 'is_search', 'is_archive', 'is_category' ,'is_tax', 'is_tag' any conditional function name

$statsocial_where_excerpts = array( 'is_search' );

/** Color Setting Show or Hide at Theme Option Page
 * Auto Color On or Off
 * If you want no Auto Color when set value false.
 *
 *
 * statsocial_USE_AUTO_COLOR
 *
 */
define( "statsocial_USE_AUTO_COLOR", true );

/** Featured Image Size
 * single-post-thumbnail
 *
 *
 * statsocial_SINGLE_POST_THUMBNAIL_WIDTH
 * statsocial_SINGLE_POST_THUMBNAIL_HEIGHT
 *
 */
define( 'statsocial_SINGLE_POST_THUMBNAIL_WIDTH', 600 );

define( 'statsocial_SINGLE_POST_THUMBNAIL_HEIGHT', 200 );

/** Add Light Box for Featured Image Size
 *
 *
 * statsocial_USE_FEATURED_IMAGE_LIGHT_BOX
 * @since 1.002
 */
define( 'statsocial_USE_FEATURED_IMAGE_LIGHT_BOX', false );

/** Add CSS from Custom field
 *
 *
 * field name: css
 * default: true
 * @since 1.201
 */
define( 'statsocial_CUSTOM_FIELD_CSS', true );

/** Add javascript element from Custom field
 *
 *
 * field name: javascript
 * default: true
 * @since 1.201
 */
define( 'statsocial_CUSTOM_FIELD_META', true );

/** Add meta element from Custom field
 *
 *
 * field name: meta
 * default: false
 * possible elements <base><link><meta>
 * @since 1.201
 */
define( 'statsocial_CUSTOM_FIELD_SCRIPT', false );
/**
 * Enabling accessibility links when Setting value no at statsocial options page Accessibility Settings
 * 
 * 
 * @since1.217
 */
if ( !isset( $statsocial_accessibility_link )  ) {

    $statsocial_accessibility_link = true;
}



