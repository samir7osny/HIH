$(document).ready(function () {
    $('.inputImgHover').click(function (e) {
        //$('input[name="userImage"]')[0].click();
    });

    $("label").click(function (e) { 
        $(this).prev().focus();
    });

    $("body").on("change paste keyup","input,select,textarea",function (e) {
        // if(typeof $(this).attr('contenteditable') !== typeof undefined && $(this).attr('contenteditable') !== false){
        //     if($(this).text().split(' ').join('').split('&nbsp;').join('').split('<br>').join('') == ''){
        //         $(this).empty();
        //     }
        //     return;
        // }
        if (!checkInput($(this)) && $(this).prop("tagName") != 'SELECT') {
            $(this).empty();
        }
    });

    $('body').on("paste keyup", 'input[name="phone_number"]',function (e) { 
        validatePhone($(this));
        console.log('fvfv');
    });

    $('body').on("paste keyup", 'input[name="username"]',function (e) { 
        validateUsername($(this));
    });
    
    let inputs = $("input,select,textarea");
    for (let index = 0; index < inputs.length; index++) {
        if (!checkInput(inputs.eq(index)) && inputs.eq(index).prop("tagName") != 'SELECT') {
            inputs.eq(index).empty();
        }
    }

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('select[name="university"]').change(function (e) { 
        $.ajax({
            url: '/university',
            type: "POST",
            data: {
                id:$(this).val(),
            },
            success: function(response){ // What to do if we succeed
                $('select[name="college"]').html(response);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("an error has occured");
            } 
        });
    });

    function checkInput(input){
        if(input.val() == "" || input.val() == null){
            if (input.next('label').hasClass('focused')) {
                input.next('label').removeClass('focused');
                if(input.hasClass('requiredInput')){
                    input.css('border-color','red');
                }
            }
            return false;
        } else {
            input.next('label').addClass('focused');
            input.css('border-color','');
            return true;
        }
    }

    function validatePhone(input){
        let value = input.val();
        for (let index = 0; index < value.length; index++) {
            if( !(value[index] >= '0' && value[index] <= '9')){
                value = value.substring(0,index) + value.substring(index + 1, value.length);
                index--;
            }
        }
        input.val(value);   
        checkInput(input);
    }
    function validateUsername(input){
        let value = input.val();
        for (let index = 0; index < value.length; index++) {
            if( !(  (value[index] >= '0' && value[index] <= '9')    ||
            (value[index] >= 'a' && value[index] <= 'z')    ||
            (value[index] >= 'A' && value[index] <= 'Z')    ||
            (value[index] == '_')    )){
                value = value.substring(0,index) + value.substring(index + 1, value.length);
                index--;
            }
        }
        input.val(value);   
        checkInput(input);
    }

    $("input[type='submit']").click(function (e) {
        let submit = true;
        let requiredInputs = $(this).parent('form').find(".requiredInput");
        for (let index = 0; index < requiredInputs.length; index++) {
            if (requiredInputs.eq(index).val() == "" || requiredInputs.eq(index).val() == null) {
                requiredInputs.eq(index).css('border-color','red');
                console.log(requiredInputs.eq(index));
                submit = false;
             }
        }
        if(!submit){
            e.preventDefault();
        }
    });
    
    // Get the image and check if it isn't image file
    var inputUserImage = $('input[name="userImage"]')[0];
    var userImage = $('#userImage')[0];
    if (inputUserImage) {
        inputUserImage.onchange = function (evt) {
            var fileName = inputUserImage.value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
            if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
                var tgt = evt.target || window.event.srcElement,
                files = tgt.files;
    
                // FileReader support
                if (FileReader && files && files.length) {
                    var fr = new FileReader();
                    fr.onload = function () {
                        userImage.src = fr.result;
                    }
                    fr.readAsDataURL(files[0]);
                }
            }else{
                alert("Only jpg/jpeg and png files are allowed!");
            }
        };
    }
});