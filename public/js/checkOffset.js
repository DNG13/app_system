/**
 * Created by nata on 15.01.18.
 */function checkOffset() {
    if($('#social-float').offset().top + $('#social-float').height()
        >= $('#footer').offset().top - 10)
        $('#social-float').css('position', 'absolute');
    if($(document).scrollTop() + window.innerHeight < $('#footer').offset().top)
        $('#social-float').css('position', 'fixed'); // restore when you scroll up
    $('#social-float').text($(document).scrollTop() + window.innerHeight);
}
$(document).scroll(function() {
    checkOffset();
});