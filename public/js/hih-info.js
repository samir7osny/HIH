$(document).ready(function () {
    let Boxs = $(".outerBox");
    $.each(Boxs, function (indexInArray, valueOfElement) {
        if (indexInArray != 0) {
            valueOfElement.innerHTML = "<span class='upArrow'><i class='fa fa-angle-up' aria-hidden='true'></i></span>" + valueOfElement.innerHTML;
        }
        if (indexInArray != Boxs.length - 1) {
            valueOfElement.innerHTML = valueOfElement.innerHTML + "<span class='downArrow'><i class='fa fa-angle-down' aria-hidden='true'></i></span>";
        }
    });
    $(".downArrow").click(function (e) {
        $('html, body').animate({
            scrollTop: $(this).parent().next().offset().top - 80
        },{duration:1000/*,specialEasing:{scrollTop:'easeOutElastic'}*/});
    });
    $(".upArrow").click(function (e) { 
        $('html, body').animate({
            scrollTop: $(this).parent().prev().offset().top - 80
        },{duration:1000/*,specialEasing:{scrollTop:'easeOutElastic'}*/});
    });
});