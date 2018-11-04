var Isotope = require('isotope-layout');

(function ($) {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1500,
        outDuration: 800,
        linkElement: '.animsition-link',
        loading: true,
        loadingParentElement: 'html',
        loadingClass: 'animsition-loading-1',
        loadingInner: '<div class="loader05"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: [ 'animation-duration', '-webkit-animation-duration'],
        overlay : false,
        overlayClass : 'animsition-overlay-slide',
        overlayParentElement : 'html',
        transition: function(url){ window.location.href = url; }
    });

    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height()/2;

    $(window).on('scroll',function(){
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css('display','flex');
        } else {
            $("#myBtn").css('display','none');
        }
    });

    $('#myBtn').on("click", function(){
        $('html, body').animate({scrollTop: 0}, 300);
    });


    /*==================================================================
    [ Fixed Header ]*/
    var headerDesktop = $('.container-menu-desktop');
    var wrapMenu = $('.wrap-menu-desktop');

    if($('.top-bar').length > 0) {
        var posWrapHeader = $('.top-bar').height();
    }
    else {
        var posWrapHeader = 0;
    }


    if($(window).scrollTop() > posWrapHeader) {
        $(headerDesktop).addClass('fix-menu-desktop');
        $(wrapMenu).css('top',0);
    }
    else {
        $(headerDesktop).removeClass('fix-menu-desktop');
        $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop());
    }

    $(window).on('scroll',function(){
        if($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(wrapMenu).css('top',0);
        }
        else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop());
        }
    });


    /*==================================================================
    [ Menu mobile ]*/
    $('.btn-show-menu-mobile').on('click', function(){
        $(this).toggleClass('is-active');
        $('.menu-mobile').slideToggle();
    });

    var arrowMainMenu = $('.arrow-main-menu-m');

    for(var i=0; i<arrowMainMenu.length; i++){
        $(arrowMainMenu[i]).on('click', function(){
            $(this).parent().find('.sub-menu-m').slideToggle();
            $(this).toggleClass('turn-arrow-main-menu-m');
        })
    }

    $(window).resize(function(){
        if($(window).width() >= 992){
            if($('.menu-mobile').css('display') == 'block') {
                $('.menu-mobile').css('display','none');
                $('.btn-show-menu-mobile').toggleClass('is-active');
            }

            $('.sub-menu-m').each(function(){
                if($(this).css('display') == 'block') { console.log('hello');
                    $(this).css('display','none');
                    $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                }
            });

        }
    });


    /*==================================================================
    [ Show / hide modal search ]*/
    $('.js-show-modal-search').on('click', function(){
        $('.modal-search-header').addClass('show-modal-search');
        $(this).css('opacity','0');
    });

    $('.js-hide-modal-search').on('click', function(){
        $('.modal-search-header').removeClass('show-modal-search');
        $('.js-show-modal-search').css('opacity','1');
    });

    $('.container-search-header').on('click', function(e){
        e.stopPropagation();
    });


    /*==================================================================
    [ Isotope ]*/
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };

    var $topeContainer = $('.isotope-grid');
    var $filter = $('.filter-tope-group');
    var iso = '';

    // filter items on button click
    $filter.each(function () {
        $filter.on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            iso.arrange({filter: filterValue})
            // $(".isotope-item").slice(0, 8).show();
        });

    });

    // init Isotope
    $(window).on('load', function () {
        initIsotop()
    });

    function initIsotop() {
        var $grid = $topeContainer.each(function () {
            iso = new Isotope(this, {
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows',
                percentPosition: true,
                animationEngine : 'best-available',
                masonry: {
                    columnWidth: '.isotope-item'
                }
            });
        });
        var current_category = getUrlParameter('current_category');
        if(current_category)
            iso.arrange({filter: '.' + current_category})
    }

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function(){
        $(this).on('click', function(){
            for(var i=0; i<isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
            }

            $(this).addClass('how-active1');
        });
    });

    //Load more item products
    // $(".isotope-item").slice(0, 8).show(); // select the first ten
    // $("#load").click(function(e){ // click event for load more
    //     e.preventDefault();
    //     $(".isotope-item:hidden").slice(0, 8).show(); // select next 10 hidden divs and show them
    //     initIsotop()
    //     if($(".isotope-item:hidden").length == 0){ // check if any hidden divs still exist
    //         $("#load").hide(); // hide btn if there are none left
    //     }
    // });

    /*==================================================================
    [ Filter / Search product ]*/
    $('.js-show-filter').on('click',function(){
        $(this).toggleClass('show-filter');
        $('.panel-filter').slideToggle(400);

        if($('.js-show-search').hasClass('show-search')) {
            $('.js-show-search').removeClass('show-search');
            $('.panel-search').slideUp(400);
        }
    });

    $('.js-show-search').on('click',function(){
        $(this).toggleClass('show-search');
        $('.panel-search').slideToggle(400);

        if($('.js-show-filter').hasClass('show-filter')) {
            $('.js-show-filter').removeClass('show-filter');
            $('.panel-filter').slideUp(400);
        }
    });




    /*==================================================================
    [ Cart ]*/
    $('.js-show-cart').on('click',function(){
        $('.js-panel-cart').addClass('show-header-cart');
    });

    $('.js-hide-cart').on('click',function(){
        $('.js-panel-cart').removeClass('show-header-cart');
    });

    /*==================================================================
    [ Cart ]*/
    $('.js-show-sidebar').on('click',function(){
        $('.js-sidebar').addClass('show-sidebar');
    });

    $('.js-hide-sidebar').on('click',function(){
        $('.js-sidebar').removeClass('show-sidebar');
    });

    /*==================================================================
    [ +/- num product ]*/
    $('.btn-num-product-down').on('click', function(){
        var numProduct = Number($(this).next().val());
        if(numProduct > 0) $(this).next().val(numProduct - 1);
    });

    $('.btn-num-product-up').on('click', function(){
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
    });

    /*==================================================================
    [ +/- num product cart ]*/
    $('.btn-num-cart-product-down').on('click', function(){
        var numProduct = Number($(this).next().val());
        if(numProduct > 1) {
            $(this).next().val(numProduct - 1);
            var price = parseFloat($(this).parent().parent().parent().find('.product-price').text()).toFixed(2);
            var totalProductPrice = parseFloat($(this).parent().parent().parent().find('.total-product-price').text()).toFixed(2);
            var subTotal = parseFloat($('.sub-total').text()).toFixed(2);
            var total = parseFloat($('.total').text()).toFixed(2);
            $(this).parent().parent().parent().find('.total-product-price').text(parseFloat(totalProductPrice - price).toFixed(2));
            $('.sub-total').text(parseFloat(subTotal - price).toFixed(2));
            $('.total').text(parseFloat(total - price).toFixed(2));
        }
    });

    $('.btn-num-cart-product-up').on('click', function(){
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
        var price = parseFloat($(this).parent().parent().parent().find('.product-price').text()).toFixed(2);
        var totalProductPrice = parseFloat($(this).parent().parent().parent().find('.total-product-price').text()).toFixed(2);
        var subTotal = parseFloat($('.sub-total').text()).toFixed(2);
        var total = parseFloat($('.total').text()).toFixed(2);

        var currentTotalPrice = parseFloat(Number(totalProductPrice) + Number(price)).toFixed(2);
        $(this).parent().parent().parent().find('.total-product-price').text(currentTotalPrice);

        var currentSubTotal = parseFloat(Number(subTotal) + Number(price)).toFixed(2);
        $('.sub-total').text(currentSubTotal);

        var currentTotal = parseFloat(Number(total) + Number(price)).toFixed(2);
        $('.total').text(currentTotal);
    });

    /*==================================================================
    [ Rating ]*/
    $('.wrap-rating').each(function(){
        var item = $(this).find('.item-rating');
        var rated = -1;
        var input = $(this).find('input');
        $(input).val(0);

        $(item).on('mouseenter', function(){
            var index = item.index(this);
            var i = 0;
            for(i=0; i<=index; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });

        $(item).on('click', function(){
            var index = item.index(this);
            rated = index;
            $(input).val(index+1);
        });

        $(this).on('mouseleave', function(){
            var i = 0;
            for(i=0; i<=rated; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });
    });

    /*==================================================================
    [ Show modal1 ]*/
    $('.js-show-modal1').on('click',function(e){
        e.preventDefault();
        var product_id = $(this).attr('data-product');
        var url = site_url + 'modal/product/' + product_id;

        $.ajax({
            type: 'post',
            url: url,
            success: function (data) {
                $('.modal-product').html(data);
                $('.js-modal1').addClass('show-modal1');
                $(".js-select2").each(function(){
                    $(this).select2({
                        minimumResultsForSearch: 20,
                        dropdownParent: $(this).next('.dropDownSelect2')
                    });
                })
                $('.gallery-lb').each(function() { // the containers for all your galleries
                    $(this).magnificPopup({
                        delegate: 'a', // the selector for gallery item
                        type: 'image',
                        gallery: {
                            enabled:true
                        },
                        mainClass: 'mfp-fade'
                    });
                });
                $('.wrap-slick3').each(function(){
                    $(this).find('.slick3').slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        fade: true,
                        infinite: true,
                        autoplay: false,
                        autoplaySpeed: 6000,

                        arrows: true,
                        appendArrows: $(this).find('.wrap-slick3-arrows'),
                        prevArrow:'<button class="arrow-slick3 prev-slick3"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
                        nextArrow:'<button class="arrow-slick3 next-slick3"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',

                        dots: true,
                        appendDots: $(this).find('.wrap-slick3-dots'),
                        dotsClass:'slick3-dots',
                        customPaging: function(slick, index) {
                            var portrait = $(slick.$slides[index]).data('thumb');
                            return '<img src=" ' + portrait + ' "/><div class="slick3-dot-overlay"></div>';
                        },
                    });
                });
                $('.btn-num-product-down').on('click', function(){
                    var numProduct = Number($(this).next().val());
                    if(numProduct > 0) $(this).next().val(numProduct - 1);
                });

                $('.btn-num-product-up').on('click', function(){
                    var numProduct = Number($(this).prev().val());
                    $(this).prev().val(numProduct + 1);
                });

                $('.js-addcart-detail').each(function(){
                    var nameProduct = $('.js-name-detail').text();
                    $(this).on('click', function(){
                        swal(nameProduct, "is added to cart !", "success");
                    });
                });
            }
        });
    });

    $('.js-hide-modal1').on('click',function(){
        $('.js-modal1').removeClass('show-modal1');
    });

    /*==================================================================*/
    $(".js-select2").each(function(){
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2')
        });
    })

    /*==================================================================*/
    $('.parallax100').parallax100();

    /*==================================================================*/
    $('.gallery-lb').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled:true
            },
            mainClass: 'mfp-fade'
        });
    });

    /*==================================================================*/
    $('.js-addwish-b2').on('click', function(e){
        e.preventDefault();
    });

    $('.js-addwish-b2').each(function(){
        var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-b2');
            $(this).off('click');
        });
    });

    $('.js-addwish-detail').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

        $(this).on('click', function(){
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-detail');
            $(this).off('click');
        });
    });


    $('.js-addcart-detail').each(function() {
        $(this).on('click', function(){
            var product_id = $(this).attr('data-product');
            var size_id = $("#size").val();
            var shape_id = $("#shape").val();
            var material_id = $("#material").val();
            var color_id = $("#color").val();
            var quantity = parseInt($(".num-product").val());
            var datas = {
                product: product_id,
                size : size_id,
                shape : shape_id,
                material : material_id,
                color : color_id,
                quantity : quantity
            };
            var url = site_url + 'cart/add';
            var nameProduct = $('.js-name-detail').text();
            $.ajax({
                type: 'post',
                url: url,
                data: datas,
                success: function (data) {
                    $('.js-show-cart').attr('data-notify', parseInt($('.js-show-cart').attr('data-notify')) + quantity);
                    swal(nameProduct, "is added to cart !", "success");
                }
            })
        });
    });

    /*==================================================================*/
    const PerfectScrollbar = require('perfect-scrollbar').default;
    $('.js-pscroll').each(function(){
        $(this).css('position','relative');
        $(this).css('overflow','hidden');
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 1,
            scrollingThreshold: 1000,
            wheelPropagation: false,
        });

        $(window).on('resize', function(){
            ps.update();
        })
    });


})(jQuery);