
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

    if($('.main-header').length){ 
        var stickyNavTop = $('.main-header').offset().top;
        var stickyNav = function(){
                var scrollTop = $(window).scrollTop();
                if (scrollTop > stickyNavTop) {
                     $('.main-header').addClass('sticky');
                } else {
                    $('.main-header').removeClass('sticky');
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

    var $listItem = $('.footer-area-top ul.menu-social-menu li');
    if ($listItem.length) {
        $listItem.each(function(index){
            $a = $(this).find('a');
            $name = $a.text();
            $link = $a.attr('href');
            $(this).html('<span> <a href="'+ $link +  '"><i class="fa fa-' + $name+ '"></i></a></span>');
            });
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

