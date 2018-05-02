$(document).ready(function () {
    
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let chater = 0;
    let chatBox = $('.chat').eq(0);
    let chatInput = $('input[name="message"]').eq(0);
    chatBox.css('transition','none');
    function scrollDown(animation = false){
        if (animation) {
            chatBox.animate({ scrollTop: chatBox[0].scrollHeight}, 500);
        }
        else {
            chatBox.animate({ scrollTop: chatBox[0].scrollHeight});
        }
    }
    scrollDown(false);

    $(chatInput).keypress(function (e) {
        updateAllToBeSeen();
        if (e.keyCode === 13 && chatInput.val() != '') {
            sendNewMessage(chatInput.val());
            chatInput.val('');
        }
    });
    $(chatInput).focus(function (e) { 
        updateAllToBeSeen();
    });
    $('.messageInput button') .click(function(){
        if (chatInput.val() != '') {
            sendNewMessage(chatInput.val());
            chatInput.val('');
        }
    });


    // send message
    function sendNewMessage(message){
        if (chater == 0) {
            return;
        }
        $.ajax({
            url: '/chat/send',
            type: "post",
            data: {
                message:message,
                receiver:chater
            },
            success: function(response){ // What to do if we succeed
                if (response.success) {
                    chatBox.find('.nothing').remove();
                    chatBox.append(response.data);
                    scrollDown(true);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                //alert("an error has occured"/* + textStatus + errorThrown + XMLHttpRequest*/);
                //console.log(XMLHttpRequest);
            }  
        });
    }

    
    let finishRetrieve = true;
    let finishRetrieveSeen = true;
    let finishCheckContacts = true;
    setInterval(function(){
        if (finishRetrieve) {
            receiveNewMessage();
        }
        if (finishRetrieveSeen) {
            updateAllToGetSeen();
        }
        if (finishCheckContacts){
            checkContacts()
        }
    },500);
    // check messages
    function receiveNewMessage(){
        if (chater == 0) {
            return;
        }
        let lastMessage = $('.chat .receive').last().attr('m');
        if (lastMessage == null) {
            lastMessage = 0;
        }
        finishRetrieve = false;
        $.ajax({
            url: '/chat/receive',
            type: "get",
            data: {
                sender:chater,
                lastMessage:lastMessage
            },
            success: function(response){ // What to do if we succeed
                if (response.success) {
                    for (let index = 0; index < response.data.length; index++) {            
                        chatBox.append(response.data[index]);
                        scrollDown(true);
                    }
                }
                finishRetrieve = true;
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                //alert("an error has occured"/* + textStatus + errorThrown + XMLHttpRequest*/);
                console.log(XMLHttpRequest);
            }  
        });
    }

    // make all seen
    $('.chat').mouseover(function () { 
        updateAllToBeSeen();
    });

    // check messages
    function updateAllToBeSeen(){
        if (chater == 0) {
            return;
        }
        let lastMessage = $('.chat .receive').last().attr('m');
        if (lastMessage == null) {
            lastMessage = 0;
        }
        finishRetrieveSeen = false;
        $.ajax({
            url: '/chat/seeall',
            type: "put",
            data: {
                sender:chater,
                lastMessage:lastMessage
            },
            success: function(response){ // What to do if we succeed
                if (response.success) {
                    $('.chat .receive i').filter(function() {
                        return $(this).parents('.receive').attr("m") <= lastMessage && $(this).hasClass('fa-square-o');
                      }).addClass('fa-check-square-o').removeClass('fa-square-o');
                }
                finishRetrieveSeen = true;
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                //console.log(XMLHttpRequest);
                //alert("an error has occured"/* + textStatus + errorThrown + XMLHttpRequest*/);
            }  
        });
    }

    // check messages
    function updateAllToGetSeen(){
        if (chater == 0) {
            return;
        }
        finishRetrieveSeen = false;
        $.ajax({
            url: '/chat/checksee',
            type: "get",
            data: {
                receiver:chater
            },
            success: function(response){ // What to do if we succeed
                if (response.success) {
                    $('.chat .send i').filter(function() {
                        return $(this).parents('.send').attr("m") <= response.lastSeen && $(this).hasClass('fa-square-o');
                    }).addClass('fa-check-square-o').removeClass('fa-square-o');
                }
                finishRetrieveSeen = true;
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                console.log(XMLHttpRequest);
                //alert("an error has occured"/* + textStatus + errorThrown + XMLHttpRequest*/);
            }  
        });
    }

    // get chat
    function getChat(chaterId){
        finishRetrieve = false;
        chater = chaterId;
        if (chater == 0) {
            return;
        }
        $.ajax({
            url: '/chat/all',
            type: "get",
            data: {
                chater:chaterId
            },
            success: function(response){ // What to do if we succeed
                if (response.success) {
                    $('.chat').html(response.data);
                    setTimeout(function(){
                        finishRetrieve = true;
                    }, 200);
                    scrollDown(true);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                console.log(XMLHttpRequest);
                //alert("an error has occured"/* + textStatus + errorThrown + XMLHttpRequest*/);
            }  
        });
    }

    //serach
    $('input[name="search"]').on("change paste keyup focus", function() {
        if ($(this).val() == '') {
            if ($('.contacts.search').css('display') != 'none') {
                $('.contacts.search').slideToggle(function(){
                    $(this).html('');
                });
            }
            return;
        }
        $.ajax({
            url: '/chat/search',
            type: "get",
            data: {
                searchAbout:$(this).val()
            },
            success: function(response){ // What to do if we succeed
                if (response.success) {
                    let searchBox = $('.contacts.search');
                    searchBox.html(response.data);
                    if (searchBox.css('display') == 'none') {
                        searchBox.slideToggle();
                    }
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                console.log(XMLHttpRequest);
                //alert("an error has occured"/* + textStatus + errorThrown + XMLHttpRequest*/);
            }  
        });
     });
     $('input[name="search"]').on("blur", function() {
        $('.contacts.search').slideToggle(function(){
            $(this).html('');
        }); 
     });

     $("body").on("click", ".contacts.search .contact",function (e) {
         let id = $(this).attr('u');
         $('#opened').attr('id','');
        if ($('.contacts:not(.search) .contact[u="' + id + '"]').length) {    
            $('.contacts:not(.search) .contact[u="' + id + '"]').attr('id','opened');
            $('.contacts:not(.search)').scrollTop($('#opened').offset().top);
            $(this).parents('.search').slideToggle(function(){
                $(this).html('');
            }); 
        }
        else
        {       
            $('.contacts:not(.search)').prepend($(this).clone().attr('id','opened'));
            $(this).parents('.search').slideToggle(function(){
                $(this).html('');
            });
        }
        getChat(id);
    });

    $("body").on("click", ".contacts:not(.search) .contact",function (e) {
        let id = $(this).attr('u');
        $('#opened').attr('id','');
        $(this).attr('id','opened');
        getChat(id);
    });

    // refresh contacts
    function checkContacts(){
        finishCheckContacts = false;
        $.ajax({
            url: '/chat/checkcontacts',
            type: "get",
            data: {
                
            },
            success: function(response){ // What to do if we succeed
                finishCheckContacts = true;
                if (response.success) {
                    if (response.contactsCount > $('.contacts:not(.search) .contact').length) {
                        refreshContacts()
                    }
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                console.log(XMLHttpRequest);
                //alert("an error has occured"/* + textStatus + errorThrown + XMLHttpRequest*/);
            }  
        });
    }
    function refreshContacts(){
        finishCheckContacts = false;
        let id = $('.contacts:not(.search) .contact#opened').attr('u');
        $.ajax({
            url: '/chat/contacts',
            type: "get",
            data: {
                chater:id
            },
            success: function(response){ // What to do if we succeed
                finishCheckContacts = true;
                if (response.success) {
                    $('.contacts:not(.search)').html(response.data);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                console.log(XMLHttpRequest);
                //alert("an error has occured"/* + textStatus + errorThrown + XMLHttpRequest*/);
            }  
        });
    }

});