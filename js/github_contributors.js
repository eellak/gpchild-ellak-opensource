jQuery(document).ready(function(){jQuery('.ellak-contributors.contr-entry.main-wrapper').on("click", 
    function(){
        var width=jQuery(window).width();
        var height=jQuery(window).height();
        jQuery('#grey-backdrop').toggleClass('gh-collapsed');
        jQuery('#grey-backdrop.gh-collapsed').animate({width: 0, height: 0});
        jQuery('#grey-backdrop').animate({width: width-20, height: height-20});
        console.log(jQuery(this));

        var title_div=jQuery(this).clone();
        title_div.find('.ellak-contributors.contr-entry.details-container').toggleClass('collapse');
        title_div.prependTo('#grey-backdrop')
        title_div.find('.ellak-contributors.contributor-avatar').css({width: '100px', height: '100px', 'margin-top': '6px', 'margin-bottom': '6px'})
        if (width<=800){
            title_div.animate({width: width-20, top: 20, left: 10});
        }
        else{
            var title_div_centrify_x=width/2-330;
            title_div.css('position', 'relative');
            title_div.animate({width: 660});
            title_div.css('left', title_div_centrify_x);
        }
        var title_div_height=title_div.height();
        var title_div_centrify_y=height/2-180;
        if(title_div_centrify_y<=30){
            title_div_centrify_y=30;
        }
        title_div.css('top', title_div_centrify_y);
    });
});

function collapse_details_box(){
    var div=jQuery('#grey-backdrop');
    div.empty();
    div.toggleClass('gh-collapsed');
    div.css('width', 0);
    div.css('height', 0);
}