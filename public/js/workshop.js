var workshopTimeline=false;
$(document).ready(function () {
    $(".popUpWindow .workshopTimeline").addClass('out');


    $(".popUpWindow").click(function () {
        if (workshopTimeline == true) {
            workshopTimeline = false;
            $('.popUpWindow .workshopTimeline').removeClass('on');
            $('.popUpWindow .workshopTimeline').addClass('out');
            $('.popUpWindow').css('display', 'none');
        }
    });
    
    $('.workshopTimeline').click(function (e) {
        e.stopPropagation();
    });

    $('.workshopTimelineButton').click(function () {
        workshopTimeline = true;
        $('.popUpWindow .workshopTimeline').removeClass('out');
        $('.popUpWindow .workshopTimeline').addClass('on');
        $('.popUpWindow').fadeIn();
        //$('.popUpWindow').css('display', 'block');
    });
});