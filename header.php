<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
global $template, $statsocial_link_unique_text;
do_action( 'statsocial_pre_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
      <meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
      <title><?php wp_title( '|', true, 'right' ); ?></title>
      <link rel="stylesheet" href="http://statsocial.com/css/main.css">
      <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700,800" rel="stylesheet" type="text/css">
      <?php wp_head(); ?>
  </head>
    <body <?php body_class(); ?>>
      <div id="<?php echo esc_attr( statsocial_warehouse( 'statsocial_page_width' ) ); ?>" class="<?php echo esc_attr( 'yui-' . statsocial_warehouse( 'statsocial_col_width' ) ); ?> hfeed">
        <?php
        statsocial_prepend_doc();
        ?>
       <header id="top">
          <div id="hd" <?php statsocial_doctype_elements( '', 'role="banner"' ); ?>>
            <div class="skip-link screen-reader-text">
              <a href="#container" title="<?php esc_attr_e( 'Skip to content', 'statsocial' ); ?>"><?php esc_html_e( 'Skip to content', 'statsocial' ); ?></a>
            </div>
            <?php
            /**
             * Conditional Switch html headding element
             *
             * example
             *  statsocial_site_title( " add some text" );
             *
             */
            echo statsocial_site_title();
            /**
             * Site description diaplay 
             *
             *
             *
             */
            echo statsocial_site_description();
            ?>
        </div>
        <?php
        /**
         * header image
         *
         * if no link home_url( ) then use 'elements'
         * if need link home_url( ) then use 'home_url'
         *
         * var 1.116 default setting change from home_url to elements
         * FAE accessibility rule Ensure that links that point to the same HREF use the same link text.
         *
         *
         * Tips
         * Header Image and Site description
         * Fixed width page can change a header image from this template ( without fluid layout )
         *
          echo statsocial_header_image( 'default',
          array('height'=> '300px',
          'img' => 'http://tenman.info/images/pen.jpg',
          //'img' => 'http://example.com/images/example.jpg',
          'text_attr' => 'style="color:red;"' ,
          'text'=> 'change text' )
          );
         * Page width fluid can below
         *
          echo statsocial_header_image( 'default',
          array( 'text_attr' => 'class="hello"' ,
          'text'=> 'change text' )
          );
         *
         */
        if ( true == $statsocial_link_unique_text ) {

            echo statsocial_header_image( 'elements' );
        } else {

            echo statsocial_header_image( 'home_url' );
        }


        /**
         * horizontal menubar
         *
         *
         *
         *
         */
        statsocial_nav_menu_primary();

        statsocial_after_nav_menu();
        ?>
    </header>
    <div id="bd" class="clearfix">
        <?php do_action( 'statsocial_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) ); ?>