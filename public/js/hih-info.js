var SearchOpen = false;
var lastValue = "NoThing";
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

    $(".popUpWindow .search").addClass('out');
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".popUpWindow").click( function(){
        if(SearchOpen==true){
            SearchOpen=false;
            $(".popUpWindow .search").removeClass('on');
            $(".popUpWindow .search").addClass('out');
            $(".popUpWindow").fadeOut();
        }
    });

    $(".search").click(function (e) {
        e.stopPropagation();    //To prevent clicking on background DIVs
    });

    $('.changePresident').click(function (e) { 
        e.preventDefault();
        SearchOpen=true;
        $(".popUpWindow .search").removeClass('out');
        $(".popUpWindow .search").addClass('on');
        $(".popUpWindow").fadeIn();
        $('input[name="searchKey"]').focus();
    });

    $('input[name="searchKey"]').on("change paste keyup focus", function() {
        if($(this).val() == lastValue){
            return;
        }
        lastValue = $(this).val();
        $.ajax({
            url: '/member/search',
            type: "get",
            data: {
                searchKey:$(this).val()
            },
            success: function(response){ // What to do if we succeed
                if (response.success) {
                    let searchBox = $('.popUpWindow .search .results');
                    searchBox.html(response.data);
                    var links = searchBox.find('a');
                    for (let index = 0; index < links.length; index++) {
                        const element = links.eq(index);
                        element.attr('target','');
                        element.attr('href','/member/'+element.attr('m')+'/president');
                    }
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                console.log(XMLHttpRequest);
                //alert("an error has occured"/* + textStatus + errorThrown + XMLHttpRequest*/);
            }  
        });
    });
});