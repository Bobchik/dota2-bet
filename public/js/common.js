$(window).ready(function(){

    $(".landing_arrow").not(".reversed").click(function() {
        $('html, body').animate({
            scrollTop: $("#second").offset().top
        }, 1500);
    });

    $(".landing_arrow.reversed").click(function() {
        $('html, body').animate({
            scrollTop: $("#first").offset().top
        }, 1500);
    });

    $('.open-popup-link').magnificPopup({
        showCloseBtn: false
    })
})