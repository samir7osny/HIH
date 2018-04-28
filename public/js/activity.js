$(document).ready(function () {
    // Fire the input file when click on the photo
    $('body').on("click", '.gallery.create .photo .inputImgHover',function (e) { 
        $(this).parent('.photo').find("input").click();
        console.log($(this).parent('.photo').find("input").val());
    });

    // Delete the photo
    $('body').on("click", '.gallery.create .photo .removeButton',function (e) { 
        e.preventDefault();
        $(this).parent('.photo').remove();
    });

    // make the photo cover
    $('body').on("click", '.gallery.create .photo .makeCover',function (e) { 
        e.preventDefault();
        let oldCover = $('.photo.cover');
        if(oldCover){
            oldCover.removeClass('cover');
        }
        $(this).parent('.photo').addClass('cover');

        $('input[name="coverName"]').val($(this).parent('.photo').find('input')[0].files[0].name);
        console.log($('input[name="coverName"]').val());
    });

    // Delete the photo
    $('body').on("click", '.gallery.edit .photo .removeButton',function (e) { 
        e.preventDefault();
        let photo = $(this).parent('.photo');
        photo.after('<input type="text" value="' + photo.attr('name') + '" hidden name="deletePhoto[]">');
        photo.remove();
    });

    // make the photo cover
    $('body').on("click", '.timeline span.add',function (e) { 
        e.preventDefault();
        $('.timeline').parent('.inputContainer').append('<div style="display:none;" class="timeline">'
        + '<div class="flexBox">'
        + '<input required class="requiredInput" type="date" name="timelineDate[]">'
        + '<input required class="requiredInput" type="time" name="timelineFrom[]">'
        + '<input required class="requiredInput" type="time" name="timelineTo[]">'
        + '<span class="add"><i class="fa fa-plus-square" aria-hidden="true"></i></span>'
        + '<span class="delete"><i class="fa fa-minus-square" aria-hidden="true"></i></span>'
        + '</div>'
        + '</div>');
        $('.timeline[style="display:none;"]').slideToggle({
            start:function(){
                $(this).css("transition","none");
            },
            complete:function(){
                $(this).removeAttr('style');
            }
        });
    });

    // Delete the photo
    $('body').on("click", '.timeline span.delete',function (e) { 
        e.preventDefault();
        if($('.timeline').length > 1){
            $(this).parents('.timeline').slideToggle({
                start:function(){
                    $(this).css("transition","none");
                },
                complete:function(){
                    $(this).remove();
                }
            });
        }
    });

    // make the photo cover
    $('body').on("click", '.gallery.edit .photo .makeCover',function (e) { 
        e.preventDefault();
        let oldCover = $('.photo.cover');
        if(oldCover){
            oldCover.removeClass('cover');
        }
        $(this).parent('.photo').addClass('cover');
        if ($(this).parent('.photo')[0].hasAttribute('name')) 
        {
            $('input[name="coverName"]').val($(this).parent('.photo').attr('name'));
        }
        else
        {
            $('input[name="coverName"]').val($(this).parent('.photo').find('input')[0].files[0].name);
        }
    });


    // add photo and choose it from the computer
    $('body').on("click", '.photo.addPhoto',function (e) {
        //$('input#gallery').click();
        if ($('div[new="new"]').length == 0) {
            $(this).before('<div class="photo" style="display:none;" new="new"><img src="/images/temp/tomhanks.jpg" class="galleryPhoto" id="cover"><div class="inputImgHover"><span>Click To Edit</span></div><input type="file" accept="image/*" hidden><span class="removeButton"><i class="fa fa-minus-square" aria-hidden="true"></i></span><span class="makeCover"><i class="fa fa-picture-o" aria-hidden="true"></i></span></div>');
            $(this).prev().find("input").click();
        }
        else{
            $(this).parent().find('.photo[new="new"] input').click();
        }
    });


    // // Get new images and check if each isn't image file
    // $('body').on("change", 'input#gallery',function (evt) {   
    //     var inputUserImage = $(this);
    //     if(inputUserImage[0].files){
    //         for (let index = 0; index < inputUserImage[0].files.length; index++) {
    //                 let fileName = inputUserImage[0].files[index].name;
    //                 let idxDot = fileName.lastIndexOf(".") + 1;
    //                 let extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
    //                 if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
    //                     let tgt = evt.target || window.event.srcElement,
    //                     files = tgt.files;

    //                     // FileReader support
    //                     if (FileReader && files && files.length) {
    //                         let fr = new FileReader();
    //                         fr.onload = (function (theFile) {
    //                             return function (e) {
    //                                 $(".photo.addPhoto").before('<div class="photo"><img src="' + e.target.result + '" class="galleryPhoto" id="cover"><div class="inputImgHover"><span>Click To Edit</span></div><input multiple type="file" accept="image/*" hidden name="galleryPhoto[]"><span class="removeButton"><i class="fa fa-minus-square" aria-hidden="true"></i></span></div>');
    //                                 $(".photo.addPhoto").prev().find('input')[0].files[0] = theFile;
    //                                 console.log($(".photo.addPhoto").prev().find('input')[0].files[0]);
    //                             };
    //                         })(inputUserImage[0].files[index]);
    //                         fr.readAsDataURL(inputUserImage[0].files[index]);
    //                     }
    //                 }else{
    //                     alert("Only jpg/jpeg and png files are allowed!");
    //                 }
                
    //         }
    //     }
    // });

    // change the image and check if each isn't image file
    $('body').on("change", '.photo input',function (evt) {
        var inputUserImage = $(this);
        var fileName = inputUserImage.val();
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

            // FileReader support
            if (FileReader && files && files.length) {
                var fr = new FileReader();
                fr.onload = function () {
                    inputUserImage.attr('name','galleryPhoto[]');
                    inputUserImage.parent('.photo').find('img').get(0).src = fr.result;
                    inputUserImage.parent('.photo').removeAttr('new');
                    inputUserImage.parent('.photo').removeAttr('style');
                }
                fr.readAsDataURL(files[0]);
            }
        }else{
            alert("Only jpg/jpeg and png files are allowed!");
        }
    });
});