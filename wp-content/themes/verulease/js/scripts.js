(function ($, root, undefined) {

    $(function () {

        'use strict';

        $('.navbar-toggle').click(function () {
            $('.navbar-toggle i').toggleClass('fa-bars fa-times');
        });
        
        $("#map-view li").click(function(){
            $('#first-content').fadeOut(500, function() {
                $(this).html('').show();
            });
        });
        if($('#map-view li').hasClass('active')) {
            
        }
        
        //back to top
        $(window).scroll(function () {
            if ($(window).scrollTop() < 500) {
                $('#back-to-top').fadeOut();
            } else {
                $('#back-to-top').fadeIn();
            }



        });
        $("#back-to-top").on("click", function () {
            $("html, body").animate({scrollTop: 0}, 1000);
        });

    });

})(jQuery, this);
