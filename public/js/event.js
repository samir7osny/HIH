var imageOpend=false;
$(document).ready(function() {        
    // $('.popUpWindow > .eventGalleryImage').addClass('out');

    $('.eventGalleryImage').click(function (){
        imageOpend = true;
        var newCopy=$(this).clone();
        newCopy.appendTo($(this).parents().find('.outerBox').parent().find('.popUpWindow'));
        
        // $('.popUpWindow > .eventGalleryImage').removeClass('out');

        $('.popUpWindow > .eventGalleryImage').css('position', 'relative');
        $('.popUpWindow > .eventGalleryImage').css('margin', 'auto');
        $('.popUpWindow > .eventGalleryImage').css('width', '50%');
        $('.popUpWindow > .eventGalleryImage').css('top', '50%');
        $('.popUpWindow > .eventGalleryImage').css('transform', 'translateY(-50%)');
        $('.popUpWindow > .eventGalleryImage').css('display', 'block');
        
        // $('.popUpWindow > .eventGalleryImage').addClass('on');

         $('.popUpWindow').css('display', 'block');

        // $('.popUpWindow > .eventGalleryImage').css({
        //     'display': 'block',
        //     'width': '50 %',
        //     'position': 'relative',
        //     'margin': 'auto',
        //     'top': '50 %',
        //     'transform': 'translateY(-50 %)'
        // });
    });

    $('.popUpWindow > .eventGalleryImage').click(function (e) {
        console.log('click');
        e.stopPropagation();
    });

    $(".popUpWindow").click(function () {
        if (imageOpend == true) {
            imageOpend = false;
            // $('.popUpWindow > .eventGalleryImage').removeClass('on');
            // $('.popUpWindow > .eventGalleryImage').addClass('out');
            $('.popUpWindow').css('display', 'none');
            $('div').remove('.popUpWindow > .eventGalleryImage');
        }
    });

});