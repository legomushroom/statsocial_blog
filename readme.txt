statsocial WordPress Theme
http://www.tenman.info/wp3/statsocial/

wp3.jpg wp3-thumbnail.jpg,arrows-vs.png, icons32-vs.png,bg.png,c.gif,footer.png,footer,png,footerbck.gif,footerbck.png,h2.gif,h2,png,h2b.png,h2c.png,header.png,info.png,ja-em.png,link.png,next.png,number.png,previus.png,requre.png,rss.png,sidebar.png,sticky.png,stop.png,topbck.png,y.gif
ver1.111 add image
images/please_upload.png , images/post-format-aside.png , images/post-format-audio.png , images/post-format-chat.png , images/post-format-gallery.png , images/post-format-image.png , images/post-format-link.png , images/post-format-quote.png , images/post-format-status.png , images/post-format-video.png , images/statsocial-chat-author-0.png , images/statsocial-chat-author-1.png , images/statsocial-chat-author-2.png , images/statsocial-chat-author-3.png , images/statsocial-chat-author-4.png , images/statsocial-chat-author-5.png , images/retina/info.png , images/retina/link.png , images/retina/next.png , images/retina/post-format-aside.png , images/retina/post-format-audio.png , images/retina/post-format-chat.png , images/retina/post-format-gallery.png , images/retina/post-format-image.png , images/retina/post-format-link.png , images/retina/post-format-quote.png , images/retina/post-format-status.png , images/retina/post-format-video.png , images/retina/previous.png , images/retina/statsocial-chat-author-0.png , images/retina/statsocial-chat-author-1.png , images/retina/statsocial-chat-author-2.png , images/retina/statsocial-chat-author-3.png , images/retina/statsocial-chat-author-4.png , images/retina/statsocial-chat-author-5.png , images/retina/require.png , images/retina/rss.png , images/retina/stop.png , images/wp3.jpg , images/statsocial-nav-menu-expand.png , images/statsocial-nav-menu-shrunk.png, images/dummy.png


Above images License

copyright   Copyright (c) 2010-2012, Tenman
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This themes contents is especially the thing without clear statement of a license
supply under below license.

copyright   Copyright (c) 2010-2012, Tenman
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html


Special Thanks for Contribution

	@ Luigi Rosa  Optimising Images



QUICK START
see: http://www.tenman.info/wp3/statsocial/quick-start/

ver 1.200

	IMPORTANT CHANGES
		out-of-the-box support
			statsocial not save default settings to the database without explicit user action
			You can check as follows: statsocial theme is whether you are using a database table

			statsocial options page title after message.
				Now, statsocial Not Using Database Table
				or
				Saved Database table name: Saved Table Name

		Note: For child theme developers
			About Child Theme UNINSTALL.

			add_action( 'switch_theme', 'child_theme_uninstall' );

			function child_theme_uninstall(){

				delete_option( "child_theme_settings" );
				// Do not foget remove statsocial theme settings.
				delete_option("statsocial_theme_settings");
			}

If you do not perform this setting, it was uninstalled the child theme, If you then install the statsocial, will be read as the theme settings to change the child theme. In this case, it may be different from the default display, it is to be displayed, such as w3standard.

ver 1.152

	Add statsocial-config-example.php

		When If you need more customize
			Rename 	from statsocial-config-example.php
					to statsocial-config.php
			and set your value.

	statsocial 1.152 Add tag 'accessibility-ready'

	Note: How to enable accessibility settings

		1. Open statsocial theme settings page.
			( Dashboard / Appearance / statsocial theme settings )
		2. Accessibility Settings edit value set yes. and save.


ver 1.116
    This version trying theme accessibility.

    How to activate Accessibility mode.
        Open statsocial option page.
        Accessibility Settings value set to yes.( default no ).

    accessibility checking tool
        Functional Accessibility Evaluator 1.1
        http://fae.cita.uiuc.edu/


ver 1.111
    Support Post Format.
        Note: The display of the contents at the time of applying Post Format

        When entry title is blank
            Show Post format image link to single.php
        When entry content is blank
            posted on is hide and shows only comment link
    Support Retina display.
        images for retina exists images/retina/
ver 0.980
    functions.php line:20
        $statsocial_actions_hook_message = false;
        WP_DEBUG need true.
        and When value change true then show action_hook point and message.
        You can customize the statsocial very Easy.
    blank_front.php
        for front page template.
        You not need  PHP skills , WordPress template functions knowledge.
        Only y or '' settings, Please try.

ver 0.975
    Remove textarea theme options page for customize Automatic CSS edit.
    Original theme design another way, for example below.

//add lib/csscolor.css.php
//register new design name
statsocial_register_styles("original");

//function name prefix 'statsocial_indv_css_' must need
function statsocial_indv_css_original(){
    $style=<<<CSS
    a{color:yellow;}
    body{background:#000;color:#fff;}
CSS;
return $style;
}
    You can select theme customizer color type 'original'

//child theme using example
// child theme functions.php code example below

add_action( 'after_setup_theme', 'child_theme_setup',11 );

function child_theme_setup(){
    statsocial_register_styles("original");

    function statsocial_indv_css_original(){
    $style=<<<CSS
    a{color:yellow;}
    body{background:#000;color:#fff;}



CSS;
    return $style;
    }
}

var 0.965
    Add CSS lightbox for featured image ( Not support IE )
    Note: header image
        Old versions header image size was 950px 198px
        Theme 0.965 and WordPress ver 3.4 can your original size of header image.
        When fixed width
            Magin add and display center when upload image width smaller than document width
            Image width will fit to document width when upload image width bigger than document width
        When fluid width
            Regardless of the size of an upload image, it will be adjusted to document size.
ver 0.960
    Add CSS class columns
        When a setup of page width is set to fluid 100%, page width changes in the range of 480px to 1280px by default.
At this time, the length of the text of contents becomes long too much, and it becomes difficult to compose it.
When describing contents, when possible, column is automatically set up by describing the whole as follows.

    example(need html mode)
    on your post content or page content

    <div class="columns">
    your content here
    </div>

ver 0.958
    Add simple view for mobile
    If you want show manuary
    Open functions.php
        Set $statsocial_fallback_human_interface_show = true
ver 0.948
statsocial_delete_post_link()
    This function default no work.
    If you need delete post link
    Please open file functions.php and const statsocial_SHOW_DELETE_POST_LINK value set true.
ver 0.940
By page edit and post edit,
the Color Type and the number of columns can be set to contribution.
Add a few codes when you edit post.
e.g.
<!--[statsocial color_type="light" col="1"]-->
it makes display 1column page or post.
and statsocial color type is overwrite light.

And next You can add your own color type.
Please open functions.php
Add code example where must last line.

statsocial_register_styles("my_css");

function statsocial_indv_css_my_css(){

$style = '/* Add CSS style rule*/ body{background:orange;
color:black;}';


return $style;

}
and add the code when you edit post.
<!--[statsocial color_type="my_css" col="1"]-->


Custom Header
If you select Header Image where Appearance header panel
and statsocial will show select image.
If you delete header Image and statsocial hide a Header Image.
If you select Header Text 'display text' value 'yes'
and site description text shows on the Header Image.
select 'no' and description show page right top position.

statsocial option 'Background image h2'
color type dark and minimal have this option.
If you need background image setting when open style.css
and last line comment out like this
e.g.
.rd-type-w3standard .footer-widget h2,.rsidebar h2,.lsidebar h2,
.rd-type-light .footer-widget h2,.rsidebar h2,.lsidebar h2 {
/*background:none!important;*/
}

Custom Background
If you want your original background. you can change every color type.

Tips
Featured Image will show Article above on single page.
loop page show icon each the_content left.

Category gallery and Cagory blog have Special Layout.

Upload header,footer image.
    Allow image type is png,jpeg,gif
    max upload size 2000000byte
    header or footer image max width 1300px
    upload files saved your uplload dir
    default header,footer image exists statsocial/images header.png footer.png

Be careful
    version 0.907 Reset all setting button initializes all customizing.
    MultiSite user must click the link when setting change where  with update result message.

Questions, bugs and others can be emailed me to a.tenman@gmail.com

Tenman
a.tenman@gmail.com
http://www.tenman.info