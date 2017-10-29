
jQuery(document).ready(function($) {

    //Responsive menu
    $(function(){
        $(".menu-toggle").click(function(){
            $(".navigation #bz-menu ul").slideToggle("fast");
            $(this).children('#nav-icon').toggleClass('open');
             $('.navigation #bz-menu ul ul').css('display','none');
        });
    });

    //Submenu Dropdown Toggle
    if($('li.menu-item-has-children ul').length){
        $('li.menu-item-has-children').append('<div class="cl_drop_menu"><i id="drop"></i></div>');

        //Dropdown Button
        $('.cl_drop_menu').on('click', function() {
            $(this).children("#drop").toggleClass('collapse');
            $(this).prev('ul').slideToggle(500);
        });
       
    }



    if($('.site-header').length){ 
        var stickyNavTop = $('.site-header').offset().top;
        var stickyNav = function(){
                var scrollTop = $(window).scrollTop();
                if (scrollTop > stickyNavTop) {
                     $('.site-header').addClass('sticky');
                } else {
                    $('.site-header').removeClass('sticky');
                }
            };
        stickyNav(); 
        $(window).scroll(function() {
            stickyNav();
        });
    }
    //Add stikcy header
    // $(window).scroll(function() {   
    //     if ($(this).scrollTop() > 1){         
    //     $('.site-header').addClass("sticky");   
    //     }   
    //     else{       
    //     $('.site-header').removeClass("sticky");   
    // }});
   
    $(window).scroll(function(){
        if($(this).scrollTop() > 1){
            $('#scrollUp').addClass("show");
        }else {
            $('#scrollUp').removeClass("show");
        }
    });

    $('.scrollUp').on('click', function(){
        console.log("Clicked");
        $("html, body").animate({scrollTop: 0}, 600);
        // return false;
    });

    $simcal = $('.footer-area-top').find('div.simcal-calendar');
    if($simcal.length){
        $simcal.removeClass('simcal-default-calendar-light');
        $simcal.addClass('simcal-default-calendar-dark');
        $('span.simcal-events-dots b').css('color', "#fff");
    }

    //Banner Slider

 
 $(".owl-carousel").owlCarousel({ 
    items:1, 
    loop:true,
    nav:true,
    dots:true, 
    animateOut: 'slideOutDown',
    animateIn: 'flipInX',
    autoplay:false,
    autoplayTimeout:4000,
    autoplayHoverPause:false,
    smartSpeed:450,
    navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"], 
    
}); 
// Testimonial Slider

    //wow
    wow = new WOW({
        animateClass: 'animated',
        offset: 120
    });
    wow.init(); 

    //Start counters
    $('.counter-number').counterUp({
        delay: 10,
        time: 2000
    });
});

