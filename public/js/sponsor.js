var sponsorSearchOpen = false;
var sponsorlastValue = "NoThing";
$(document).ready(function () {
    $(".popUpWindowSponsor .sponsorSearch").addClass('out');
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".popUpWindowSponsor").click( function(){
        if(sponsorSearchOpen==true){
            sponsorSearchOpen=false;
            $(".popUpWindowSponsor .sponsorSearch").removeClass('on');
            $(".popUpWindowSponsor .sponsorSearch").addClass('out');
            $(".popUpWindowSponsor").fadeOut();
        }
    });

    $(".sponsorSearch").click(function (e) {
        e.stopPropagation();    //To prevent clicking on background DIVs
    });

    $('.addSponsor').click(function (e) { 
        e.preventDefault();
        sponsorSearchOpen=true;
        $(".popUpWindowSponsor .sponsorSearch").removeClass('out');
        $(".popUpWindowSponsor .sponsorSearch").addClass('on');
        $(".popUpWindowSponsor").fadeIn();
        $('input[name="searchKey"]').focus();
    });

    $(".popUpWindowSponsor .sponsorSearch").on("click", ".member:not(.addMember)",function (e) {
        e.preventDefault();
        if($('.sponsors .member[s="' + $(this).attr('s') + '"]').length == 0){
            var newEle = '<a target="blank" href="/sponsor/' + $(this).attr('s') + '" class="member" s="' + $(this).attr('s') + '"><span class="removeButton"><i class="fa fa-minus-square" aria-hidden="true"></i></span><img src="' + $(this).find('img').attr('src') + '"/><input name="sponsor[]" hidden type="integer" value="' + $(this).attr('s') + '"/></a>';
            console.log($('.sponsors .addSponsor'));
            $('.sponsors .addSponsor').before(newEle);
        }
        if(sponsorSearchOpen==true){
            sponsorSearchOpen=false;
            $(".popUpWindowSponsor .sponsorSearch").removeClass('on');
            $(".popUpWindowSponsor .sponsorSearch").addClass('out');
            $(".popUpWindowSponsor").fadeOut();
        }
    });

    $(".sponsors").on("click", ".member .removeButton",function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).parent('.member').remove();
    });

    $('input[name="searchKey"]').on("change paste keyup focus", function() {
        if($(this).val() == sponsorlastValue){
            return;
        }
        sponsorlastValue = $(this).val();
        $.ajax({
            url: '/sponsor/search',
            type: "get",
            data: {
                searchKey:$(this).val()
            },
            success: function(response){ // What to do if we succeed
                if (response.success) {
                    let searchBox = $('.popUpWindowSponsor .sponsorSearch .results');
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