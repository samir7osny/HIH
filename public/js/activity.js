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

    // add timelines
    let timelineAnimation = true;
    $('body').on("click", '.timeline span.add',function (e) { 
        e.preventDefault();
        if (timelineAnimation) {
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
                duration:250,
                start:function(){
                    timelineAnimation = false;
                    $(this).css("transition","none");
                },
                complete:function(){
                    timelineAnimation = true;
                    $(this).removeAttr('style');
                }
            });
        }
    });

    // Delete the timeline
    $('body').on("click", '.timeline span.delete',function (e) { 
        e.preventDefault();
        if($('.timeline').length > 1 && timelineAnimation){
            $(this).parents('.timeline').slideToggle({
                duration:250,
                start:function(){
                    timelineAnimation = false;
                    $(this).css("transition","none");
                },
                complete:function(){
                    timelineAnimation = true;
                    $(this).remove();
                }
            });
        }
    });

    // add question
    let questionAnimation = true;
    $('body').on("click", '.question span.add',function (e) { 
        e.preventDefault();
        if (questionAnimation) {
            $('.question').parent('.inputContainer').append(
            '<div style="display:none;" class="question">'
            + '<div class="flexBox">'
            + '<input required class="requiredInput" type="text" name="question[]" placeholder="Enter the question">'
            + '<span class="req" onclick="$(this).find(\'input\').val($(this).find(\'input\').val() === \'1\' ? \'0\' : \'1\'); $(this).toggleClass(\'checked\');">'
            + '<input style="display:none;" hidden type="text" value="0" name="req[]">'
            + '</span>'
            + '<span class="add"><i class="fa fa-plus-square" aria-hidden="true"></i></span>'
            + '<span class="delete"><i class="fa fa-minus-square" aria-hidden="true"></i></span>'
            + '</div>'
            + '</div>');
            $('.question[style="display:none;"]').slideToggle({
                duration:250,
                start:function(){
                    questionAnimation = false;
                    $(this).css("transition","none");
                },
                complete:function(){
                    questionAnimation = true;
                    $(this).removeAttr('style');
                }
            });
        }
    });

    // Delete the question
    $('body').on("click", '.question span.delete',function (e) { 
        e.preventDefault();
        if($('.question').length > 1 && questionAnimation){
            if ($(this).parents('.question')[0].hasAttribute('q')) {
                $(this).parents('.inputContainer').eq(0).append('<input hidden type="text" value="' + $(this).parents('.question').eq(0).attr('q') + '" name="deleteQuestion[]">');
            }
            $(this).parents('.question').slideToggle({
                duration:250,
                start:function(){
                    questionAnimation = false;
                    $(this).css("transition","none");
                },
                complete:function(){
                    questionAnimation = true;
                    $(this).remove();
                }
            });
        }
        else if($('.question').length ==  1 && questionAnimation && $(this).parents('.question')[0].hasAttribute('q')){
            $(this).parents('.question').eq(0).parent('.inputContainer').append(
                '<div class="question">'
                + '<div class="flexBox">'
                + '<input required class="requiredInput" disabled value="No questions!" type="text"  placeholder="Enter the question">'
                + '<span class="add"><i class="fa fa-plus-square" aria-hidden="true"></i></span>'
                + '</div>'
                + '</div>');
            
            $(this).parents('.question').slideToggle({
                duration:250,
                start:function(){
                    questionAnimation = false;
                    $(this).css("transition","none");
                },
                complete:function(){
                    questionAnimation = true;
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