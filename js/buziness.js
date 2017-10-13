
jQuery(document).ready(function($) {

    //Responsive menu
    $(function(){
        $(".menu-toggle").click(function(){
            $(".navigation #bz-menu ul").slideToggle("fast");
            $(this).children('#nav-icon').toggleClass('open');
        });
    });

    //Submenu Dropdown Toggle
    if($('li.menu-item-has-children ul').length){
        // $('li.menu-item-has-children').append('<div class="cl_drop_menu"><i class="fa fa-angle-down"></i></div>');
        $('li.menu-item-has-children').append('<div class="cl_drop_menu"><i id="drop"></i></div>');

        //Dropdown Button
        $('.cl_drop_menu').on('click', function() {
            $(this).children("#drop").toggleClass('collapse');
            $(this).prev('ul').slideToggle(500);
            // if($(this).children('.fa').hasClass('fa-angle-down'))
            // {
            //     $(this).children('.fa').removeClass('fa-angle-down');
            //     $(this).children('.fa').addClass('fa-angle-up');
            // }
            // else{
            //     $(this).children('.fa').removeClass('fa-angle-up');
            //     $(this).children('.fa').addClass('fa-angle-down');
            // }
            
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

