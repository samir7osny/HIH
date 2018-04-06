$(document).ready(function () {

    $("#toContent").click(function (e) {
        $('html, body').animate({
            scrollTop: $("#navContainer").offset().top
         }, 1000);
         console.log($("#navContainer").offset().top);
    });
    if($(".headerVideoContainer video").length){
        $('.headerVideo').on('ended',function(){
            $('html, body').animate({
                scrollTop: $("#navContainer").offset().top
             }, 1000);
        });
        $(window).focus(function() {
            $(".headerVideoContainer").find("video").get(0).play();
        });
        $(window).blur(function() {
            $(".headerVideoContainer").find("video").get(0).pause();
        });
    }
});