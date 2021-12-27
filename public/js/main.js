$(document).ready(function() {
    // unifiedHeight();
    // $('.styled').uniform();
    
    // $(window).resize(function() {
    //     unifiedHeight();
    //     setSliderHeight();
    //     fixingFooter();
    // });
    // singleHeight();
    // setSliderHeight();
    // fixingFooter();

    // $('.styled').uniform();
    // $('a.img-preview').fancybox({padding: 3});
    
    // $('#slideshow').dm3Slideshow({
    //     speed: 500,
    //     autoScrollInterval: 4000,
    //     autoScroll: true
    // });

    if (window.showModal) $('#'+window.showModal).modal('show');

    // $('.catalogue.group a')
    // .on('mouseenter', function (){
    //     $(this).find('.image').animate({'opacity':0.5},'fast');
    //     $(this).find('button').animate({'opacity':1,'margin-top':'40%'},'fast');
    // }).on('mouseleave', function (){
    //     $(this).find('.image').css({'opacity': 1});
    //     $(this).find('button').css({'opacity':0,'margin-top':0});
    // });
    
    // Owlcarousel
    // var navButtonBlack1 = '<img src="/images/arrow_left_black.svg" />',
    //     navButtonBlack2 = '<img src="/images/arrow_right_black.svg" />',
    //     navButtonWhite1 = '<img src="/images/arrow_left_white.svg" />',
    //     navButtonWhite2 = '<img src="/images/arrow_right_white.svg" />';

    // $('.owl-carousel.actions').owlCarousel({
        // margin: 0,
        // loop: true,
        // nav: true,
        // autoplay: false,
        // dots: true,
        // responsive: {
        //     0: {
        //         items: 1
        //     },
        //     729: {
        //         items: 1
        //     },
        //     1200: {
        //         items: 1
        //     }
        // },
        // navText:[navButtonWhite1,navButtonWhite2]
    // });

    // var onTopButton = $('#on-top-button'),
    //     mainMenuPos = 0,
    //     mainMenu = $('.navbar.navbar-default'),
    //     windowHeight = $(window).height();

    // Scroll menu
    // $('a[data-scroll]').click(function (e) {
    //     e.preventDefault();
    //     window.menuClickFlag = true;
    //     goToScroll($(this).attr('data-scroll'),mainMenu);
    // });

    // Drop down menu
    // $('.nav.navbar-nav li').bind('mouseover',function () {
    //     $(this).find('ul.dropdown-menu').show();
    // }).bind('mouseleave',function () {
    //     $(this).find('ul.dropdown-menu').hide();
    // });
    
    // Scroll controls
    // onTopButton.click(function (e) {
    //     e.preventDefault();
    //     window.menuClickFlag = true;
    //     goToScroll('top',mainMenu);
    // });

    // $(window).scroll(function() {
    //     var windowScroll = $(window).scrollTop();
    //     if (!window.menuClickFlag && window.homePage) {
    //         var win = $(this);
    //         $('section').each(function () {
    //             var scrollData = $(this).attr('data-scroll-destination');
    //             if (!win.scrollTop()) {
    //                 resetColorHrefsMenu();
    //             } else if ($(this).offset().top <= win.scrollTop()+50 && scrollData) {
    //                 resetColorHrefsMenu();
    //                 $('a[data-scroll=' + scrollData + ']').addClass('active');
    //             }
    //         });
    //     }
    //
    //     if (windowScroll > mainMenu.height() && !mainMenuPos) {
    //         mainMenu.css({
    //             'position':'fixed',
    //             'top':-1*100,
    //             'z-index':999
    //         });
    //         mainMenuPos = 1;
    //         mainMenu.animate({'top':0});
    //     } else if (windowScroll < mainMenu.height() && mainMenuPos) {
    //         mainMenu.css({'position':'relative'});
    //         mainMenuPos = 0;
    //     }
    //
    //     if (!windowScroll && window.homePage) {
    //         resetColorHrefsMenu();
    //         $('a.home').addClass('active');
    //     }
    //
    //     if (windowScroll > windowHeight) {
    //         onTopButton.fadeIn();
    //     } else onTopButton.fadeOut();
    // });
    
    // var typeHeadInput = $('.typeahead-basic');
    // if (typeHeadInput.length) {
    //     typeHeadInput.typeahead(
    //         {
    //             hint: true,
    //             highlight: true,
    //             minLength: 1
    //         },
    //         {
    //             name: 'states',
    //             displayKey: 'value',
    //             source: substringMatcher(window.typeHeadData)
    //         }
    //     );
    // }
});

function substringMatcher(strs) {
    return function findMatches(q, cb) {
        var matches = [];

        // regex used to determine if a string contains the substring `q`
        var substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function(i, str) {
            if (substrRegex.test(str)) {
                // the typeahead jQuery plugin expects suggestions to a
                // JavaScript object, refer to typeahead docs for more info
                matches.push({ value: str });
            }
        });
        cb(matches);
    };
}

function goToScroll(scrollData,mainMenu) {
    var isRelMainMenu = mainMenu.css('position') == 'relative',
        obj = $('section[data-scroll-destination="' + scrollData + '"]');

    if (!obj.length) obj = $('div[data-scroll-destination="' + scrollData + '"]');
    $('html,body').animate({
        scrollTop: obj.offset().top - (scrollData != 'top' ? (isRelMainMenu ? 200 : 100) : 0) //Coff main menu height
    }, 1500, 'easeInOutQuint');
}

function resetColorHrefsMenu() {
    $('.main-menu a.active').removeClass('active').blur();
}