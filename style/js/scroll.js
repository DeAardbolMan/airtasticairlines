$(document).ready(function () {
    $("a").on('click', function (event) {
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 600, function () {
                window.location.hash = hash;
            });
        }
    });
});
$(window).scroll(function () {
    if ($(window).scrollTop() > 120) {
        $('.menu-logo').fadeIn();
        $('.header-logo').fadeOut();
    }
    else {
        $('.header-logo').fadeIn();
        $('.menu-logo').fadeOut();
    }
});

function volgendeStap1() {

    $('#datum').fadeIn();

}

function volgendeStap2() {

    $('#personen').fadeIn();
    $('#voltooi').fadeIn();
}