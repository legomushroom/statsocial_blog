/**
 * statsocial javascript actions
 *
 * @package statsocial
 */
(function() {
    jQuery(function() {

        jQuery("blockquote").each(function() {
            var cite = jQuery(this).attr("cite");
            if (cite) {
                jQuery(this).append("<p style=\"text-align:right;\">cite:<a href=\"" + cite + "\" onclick=\"this.target='_blank';\" onkeypress=\"this.target='_blank';\">" + cite + "</a></p>");
            }

        });

        jQuery("#month_list ul li:last-child").css({border: "none"});
        jQuery(".widget ul li:last-child").css({border: "none"});
        jQuery('a').removeAttr("title");

        /** Toggle
         *
         *
         * @package statsocial
         * @since Raindrop 0.922
         */

        jQuery('.statsocial-toggle').hide().css("width", "90%");
        jQuery('.statsocial-toggle.statsocial-toggle-title').show().css({"width": "90%", "list-style": "none", "font-weight": "bold", "margin": "0 0 0 -1em"}).prepend("+ ");
        jQuery('.statsocial-toggle.statsocial-toggle-title').css("cursor", "pointer").click(function() {

            jQuery(this).siblings().toggle("slow");

            var v = jQuery(this).html().substring(0, 1);

            if (v == "+") {
                jQuery(this).html("-" + jQuery(this).html().substring(1));
            } else if (v == "-") {
                jQuery(this).html("+" + jQuery(this).html().substring(1));
            }
        });

        jQuery('#statsocial_status_bar').hide();

         jQuery(window).mousemove(function(e){
              
                var status_bar_window_height =  jQuery(window).innerHeight();
                if ( status_bar_window_height - 100 < e.pageY - jQuery(this).scrollTop() ) {
                    jQuery('#statsocial_status_bar').show();
                } else {
                    jQuery('#statsocial_status_bar').hide();
                }
         });
    });

})(jQuery);

/** Tab Controll
 *
 *
 * @package statsocial
 * @since Raindrop 0.922
 */

(function() {
    jQuery(function() {

        var element = ".statsocial-tab-content h3";
        var prefix = "statsocial-tab-page-";

        jQuery(element).each(function(i) {
            var fragment = prefix + i;

            var title = "<li><a href=\"#" + fragment + "\">" + jQuery(element).eq(i).html() + "</a></li>";
            jQuery(this).parents(':eq(1)').prev().append(title);
            jQuery(this).parent().attr("id", fragment);

        });

        jQuery(".statsocial-tab-list li.dummy").remove();

        //Default Action
        jQuery(".statsocial-tab-page").hide(); //Hide all content
        jQuery(".statsocial-tab-list li:first").addClass("active").show(); //Activate first tab
        jQuery(".statsocial-tab-page:first").show(); //Show first tab content

        //On Click Event
        jQuery(".statsocial-tab-list li").click(function() {
            jQuery(".statsocial-tab-list li").removeClass("active"); //Remove any "active" class
            jQuery(this).addClass("active"); //Add "active" class to selected tab
            jQuery(".statsocial-tab-page").hide(); //Hide all tab content
            var activeTab = jQuery(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
            jQuery(activeTab).fadeIn(); //Fade in the active content
            return false;
        });
        jQuery(".statsocial-tab-list").css({"margin": "auto"});
        jQuery(".statsocial-tab-list li").css({"float": "left", "list-style": "none"});
        jQuery(".statsocial-tab-list li a").css({"display": "block", "padding": "10px", "text-decoration": "none", "margin-right": "1px"});
    });
})(jQuery);