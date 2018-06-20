$(document).ready(function() {        
    // handle rate
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.rateBar').mousemove(function (event) {
        var offset = $(this).offset();
        var x = event.pageX - offset.left;
        $('.bar').width((x*100/$(this).width()).toString() + '%');
    });
    $('.rateBar').mouseleave(function () {
        $('.bar').width($(this).attr('totalValue'));
    });
    $('.rateBar').click(function (e) { 
        e.preventDefault();
        $.ajax({
            url: window.location.pathname + '/rate',
            type: "PUT",
            data: {
                rate:($('.bar').width()*100/$('.rateBar').width())*5.0/100.0
            },
            success: function(response){ // What to do if we succeed
                if (response.success) {
                    $('.userRate').html('<span></span>/5');
                    $('.userRate span').text(Math.round( response.userRate * 10 ) / 10);
                    $('.rateBar').attr('totalValue',(response.totalRate*100.0/5.0).toString() + '%');
                    $('.bar').width($('.rateBar').attr('totalValue'));
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                console.log(XMLHttpRequest);
            }  
        });
    });
});