$(document).ready(function(){
    $("body").on("click","#menu1 .dropdown-toggle", function( event ) {
        if ($(document).width() > 768) {
            e.preventDefault();
            var url = $(this).attr('href');
            if (url !== '#') {
                window.location.href = url;
            }
        }
    });
    $("body").on("click", ".filter__cancel", function() {
        $('input:checked').attr('checked',false);
        console.log('clear');
    });


});
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
