/*
	Load more content with jQuery - May 21, 2013
	(c) 2013 @ElmahdiMahmoud
*/   

$('ul li').hover(function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(100);
}, function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(100);
});

$(function () {
    $("article").slice(0, 4).show();
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $("div:hidden").slice(0, 4).slideDown();
        if ($("div:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top
        }, 1500);
    });
});

$('a[href=#top]').click(function () {
    $('body,html').animate({
        scrollTop: 0
    }, 600);
    return false;
});

$(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
        $('.totop a').fadeIn();
    } else {
        $('.totop a').fadeOut();
    }
});