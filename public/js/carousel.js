/*Стрелка вверх*/
// ===== Scroll to Top ====
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});
/*Стрелка вверх*/


$('.dropdown-toggle').click(function(e) {
    if ($(document).width() > 768) {
        e.preventDefault();
        var url = $(this).attr('href');
        if (url !== '#') {
            window.location.href = url;
        }
    }
});
