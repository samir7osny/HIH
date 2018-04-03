$(document).ready(function () {
    $("body").on("click", "button.edit",function (e) {
        if($(this).html() == 'Edit'){
            createForm($(this));
        }
        else if($(this).html() == 'Submit'){
            let committeeBox = $(this).parents('.outerBox');
            if( !checkInputsArray(committeeBox.find('.data'))){return;}
            
            if( !submitAJAXEdit(committeeBox) ){return;}
    
            //deleteForm($(this));
    
        }
        else if($(this).html() == 'Save'){
            let committeeBox = $(this).parents('.outerBox');
            if( !checkInputsArray(committeeBox.find('.data'))){return;}
            
            submitAJAXSave(committeeBox);
        }
    });
    $("body").on("click", "button.cancel",function (e) {
        let committeeBox = $(this).parents('.outerBox');
        if(committeeBox.find('button.edit').html() == 'Save'){
            committeeBox.css("transition","none");
            committeeBox.slideToggle("fast",function(){
                deleteForm(committeeBox);
                committeeBox.remove();
                if($('button.add').hasClass('light')){
                    $('button.add').removeClass('light');
                    $('button.add').addClass('dark');
                }
                else {
                    $('button.add').removeClass('dark');
                    $('button.add').addClass('light');
                }
            });
        } else{
            getDataAJAX(committeeBox);
            deleteForm(committeeBox);
        }
    });
    $("body").on("click", "button.delete",function (e) {
        let committeeBox = $(this).parents('.outerBox');
        if(confirm('You want to delete "' + committeeBox.find('h1[name="name"]').text() + '" committee!')){
            deleteAJAX(committeeBox);
        }
    });

    $("body").on("change paste keyup",".data",function (e) {
        //checkInput($(this));

        if (!checkInput($(this))) {
            $(this).empty();
        }
    });

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    if($('.outerBox').length % 2 == 0)
        $('button.add').addClass('dark');
    else 
        $('button.add').addClass('light');
    let members = $('.members');
    $('.members').slideToggle(1);
    $("body").on("click", "button.membersButton",function (e) {
        let members = $(this).parents('.outerBox').find('.members');
        members.css('transition','none');
        members.slideToggle("fast");
    });

    $("body").on("click", "button.add",function (e) { 
        let className = "";
        if($('.outerBox').length % 2 == 0)
            className = 'dark';
        else 
            className = 'light';
        if($('button.add').hasClass('light')){
            $('button.add').removeClass('light');
            $('button.add').addClass('dark');
        }
        else {
            $('button.add').removeClass('dark');
            $('button.add').addClass('light');
        }
        let addButton = $(this);
        $.ajax({
            url : "/committee/create",
            type: "GET",
            success : function(result){
                addButton.parent().before(result);
                let newCommittee = addButton.parent().prev();
                newCommittee.addClass(className);
                newCommittee.css('transition','none');
                newCommittee.css('display','none');
                newCommittee.css('opacity','1');
                createSaveForm(newCommittee.find('button.edit'));
                newCommittee.find(".members").slideToggle(1);
                newCommittee.slideToggle("fast");
            }
        });
    });
});






/* Functions */
function createForm(button){
    button.html('Submit');
    button.after(' <button class="cancel">Cancel</button>');
    let inputs = button.parents('.outerBox').find('.data');
    inputs.attr('contenteditable','true');
    let desc = button.parents('.outerBox').find('p.data');
    for (let index = 0; index < desc.length; index++) {
        CKEDITOR.inline( desc[index] );
    }
}

function createSaveForm(button){
    button.html('Save');
    let inputs = button.parents('.outerBox').find('.data');
    inputs.attr('contenteditable','true');
    let desc = button.parents('.outerBox').find('p.data');
    for (let index = 0; index < desc.length; index++) {
        CKEDITOR.inline( desc[index] );
    }
}

function deleteForm(committeeBox){
    let desc = committeeBox.find('p.data');
    committeeBox.find('button.edit').html('Edit');
    committeeBox.find('button.cancel').remove();
    for(let name in CKEDITOR.instances) {
        let instance = CKEDITOR.instances[name];
        for (let index = 0; index < desc.length; index++) {
            if(desc[index] == instance.element.$){
                instance.destroy();
                break;
            }
        }
    }
    committeeBox.find('.data').attr('contenteditable','false');
}

function checkInputsArray(requiredInputs){
    let allright = true;
    for (let index = 0; index < requiredInputs.length; index++) {
        if (!checkInput(requiredInputs.eq(index))) {
            allright = false;
        }
    }
    return allright;
}
function checkInput(input){
    if(input.html().split(' ').join('').split('&nbsp;').join('').split('<br>').join('') == ""){
        input.css('border-color','red');
        return false;
    } else {
        input.css('border-color','');
        return true;
    }
}

function submitAJAXEdit(committeeBox){
    
    $.ajax({
        url: 'committee/'+committeeBox.attr('committee'),
        type: "PUT",
        data: {
            name:committeeBox.find("[name='name']").html(),
            description:committeeBox.find("[name='description']").html(),
        },
        success: function(response){ // What to do if we succeed
            alert(response.desc);
            if (response.success) {
                deleteForm(committeeBox);
            } 
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("an error has occured");
        } 
    });
}

function submitAJAXSave(committeeBox){
    $.ajax({
        url: 'committee',
        type: "POST",
        data: {
            name:committeeBox.find("[name='name']").html(),
            description:committeeBox.find("[name='description']").html(),
        },
        success: function(response){ // What to do if we succeed
            alert(response.desc);
            if (response.success) {
                committeeBox.attr('committee',response.id);
                deleteForm(committeeBox);
                committeeBox.find('button.membersButton').after(' <button class="delete">Delete</button>');
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("an error has occured");
        }  
    });
}

function getDataAJAX(committeeBox){
    $.ajax({
        url: 'committee/' + committeeBox.attr('committee'),
        type: "GET",
        success: function(response){ // What to do if we succeed
            if (response.success) {
                committeeBox.find('h1[name="name"]').html(response.name);
                committeeBox.find('p[name="description"]').html(response.description);
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("an error has occured" + textStatus + errorThrown + XMLHttpRequest);
        }  
    });
}

function deleteAJAX(committeeBox){
    $.ajax({
        url: 'committee/' + committeeBox.attr('committee'),
        type: "DELETE",
        success: function(response){ // What to do if we succeed
            if (response.success) {
                committeeBox.css('transition','none');
                committeeBox.slideToggle("fast",function(){
                    committeeBox.remove();
                    if($('button.add').hasClass('light')){
                        $('button.add').removeClass('light');
                        $('button.add').addClass('dark');
                    }
                    else {
                        $('button.add').removeClass('dark');
                        $('button.add').addClass('light');
                    }
                });
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("an error has occured" + textStatus + errorThrown + XMLHttpRequest);
        }  
    });
}
