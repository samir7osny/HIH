{
var loginOpen = false;  
$(document).ready(function () {
    $("#backLoginWindow #loginForm").addClass('out');

    $("#backLoginWindow").click( function(){
        if(loginOpen==true){
                loginOpen=false;
                $("#backLoginWindow #loginForm").removeClass('on');
                $("#backLoginWindow #loginForm").addClass('out');
                $("#backLoginWindow").fadeOut();
        }
    });
    $("#loginForm").click(function (e) {
        e.stopPropagation();    //To prevent clicking on background DIVs
    });

    $("#loginForm label").click(function (e) { 
        $(this).prev().focus();
    });

    $("body").on("change paste keyup","#loginForm input,select,textarea",function (e) {
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

    $("#loginForm input[type='submit']").click(function (e) {
        let submit = true; 
        let requiredInputs = $("#loginForm .requiredInput");
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
});
function openLoginForm() {
    loginOpen=true;
    $("#backLoginWindow #loginForm").removeClass('out');
    $("#backLoginWindow #loginForm").addClass('on');
    $("#backLoginWindow").fadeIn();
}

}