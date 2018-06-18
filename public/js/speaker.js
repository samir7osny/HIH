var SearchOpen = false;
var lastValue = "NoThing";
$(document).ready(function () {
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

    $('.addSpeaker').click(function (e) { 
        e.preventDefault();
        SearchOpen=true;
        $(".popUpWindow .search").removeClass('out');
        $(".popUpWindow .search").addClass('on');
        $(".popUpWindow").fadeIn();
        $('input[name="searchKey"]').focus();
    });

    $(".popUpWindow .search").on("click", ".member:not(.addMember)",function (e) {
        e.preventDefault();
        if($('.speakers .members .flexBox .member[s="' + $(this).attr('s') + '"]').length == 0){
            var newEle = $(this).clone().append('<span class="removeButton"><i class="fa fa-minus-square" aria-hidden="true"></i></span><input name="speaker[]" hidden type="integer" value="' + $(this).attr('s') + '">');
            $('.speakers .members .flexBox').append(newEle);
        }
        if(SearchOpen==true){
            SearchOpen=false;
            $(".popUpWindow .search").removeClass('on');
            $(".popUpWindow .search").addClass('out');
            $(".popUpWindow").fadeOut();
        }
    });

    $(".speakers").on("click", ".member .removeButton",function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).parent('.member').remove();
    });

    $('input[name="searchKey"]').on("change paste keyup focus", function() {
        if($(this).val() == lastValue){
            return;
        }
        lastValue = $(this).val();
        $.ajax({
            url: '/speaker/search',
            type: "get",
            data: {
                searchKey:$(this).val()
            },
            success: function(response){ // What to do if we succeed
                if (response.success) {
                    let searchBox = $('.popUpWindow .search .results');
                    searchBox.html(response.data);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                console.log(XMLHttpRequest);
                //alert("an error has occured"/* + textStatus + errorThrown + XMLHttpRequest*/);
            }  
        });
    });
});