$(document).ready(function () {
    $('.headerVideo').on('ended',function(){
        $('html, body').animate({
            scrollTop: $("#navContainer").offset().top
         }, 1000);
    });
    $("#toContent").click(function (e) {
        $('html, body').animate({
            scrollTop: $("#navContainer").offset().top
         }, 1000);
         console.log($("#navContainer").offset().top);
    });
    $(window).focus(function() {
        if($(".headerVideoContainer").length){
            $(".headerVideoContainer").find("video").get(0).play();
        }
    });
    $(window).blur(function() {
        if($(".headerVideoContainer").length){
            $(".headerVideoContainer").find("video").get(0).pause();
        }
    });
});