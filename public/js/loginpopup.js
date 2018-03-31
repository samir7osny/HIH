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
});
function openLoginForm() {
    loginOpen=true;
    $("#backLoginWindow #loginForm").removeClass('out');
    $("#backLoginWindow #loginForm").addClass('on');
    $("#backLoginWindow").fadeIn();
}