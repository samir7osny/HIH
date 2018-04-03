$(document).ready(function () {
    $('.allowOverflow,.outerBox').delay(700).animate({opacity:1},{
        duration:500,
        start:function(){
            $(this).css('transition','none');
        },
        complete:function(){
            $(this).css('transition','');
        }
    });
    $("#menuButton").click(function (e) {
        if ($(this).attr("case") == "closed") {
            $(this).attr("case", "opened");
            $("#mainNav ul").slideToggle(100, function () {
                $(this).addClass("open");
                $(this).attr("style", "");
            });
            $("#mainNav ul").css("border-top-width", "2px");
        } else {
            $(this).attr("case", "closed");
            $("#mainNav ul").slideToggle(100, function () {
                $(this).removeClass("open");
                $(this).attr("style", "");
            });
            $("#mainNav ul").css("border-top-width", "0");
        }
    });
    $(window).scroll(function () {
        positioningNavBar();
    });
    positioningNavBar();
    function positioningNavBar(){
        var navOffset = $("#navContainer").next().offset().top - $("#navContainer").height();
        if ($(window).scrollTop() >= navOffset && !$('#navContainer').hasClass('fixedNav')) {
            $('#navContainer').addClass('fixedNav');
        } else if ($(window).scrollTop() < navOffset && $('#navContainer').hasClass('fixedNav')) {
            $('#navContainer').removeClass('fixedNav');
        }
        let headerVideoContainer = $(".headerVideoContainer");
        if(headerVideoContainer.length){
            let video = headerVideoContainer.find("video").get(0);
            if ($(window).scrollTop() > headerVideoContainer.offset().top + headerVideoContainer.outerHeight()/2){
                video.pause();
            } else {
                video.play();
            }
        }
    }
});