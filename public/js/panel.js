let isLastRight = true;
let timerRun = true;
let slideFinish = true;
let timeSlide = 500;
let timeDelaySlide = 10000;
let timer = $( '.panelTimer span' ).eq(panelIndex);
let leftArrow = $( '.panelRightArrow' ).eq(panelIndex);
let rightArrow = $( '.panelLeftArrow' ).eq(panelIndex);
let pauseButton = $('.panelPause').eq(panelIndex);
let playButton = $('.panelPlay').eq(panelIndex);
let activeSelector = '.panelItem#panelActive';
let activeId = 'panelActive';
let itemClass = 'panelItem';


$(document).ready(function () {
    $('.panel').eq(panelIndex).find('.panelItem').last().attr('id',activeId);
    checkRighteft();
    animateTimer();
    leftArrow.click(function (e) { 
        if(slideFinish){
            slideItems(false);
            isLastRight = false;
            if(timerRun){
                resetTimer();
                animateTimer();
            }
                
        }
    });
    rightArrow.click(function (e) { 
        if(slideFinish){
            slideItems(true);
            isLastRight = true;
            if(timerRun){
                resetTimer();
                animateTimer();
            }

        }
    });
});

pauseButton.click(function (e) { 
    pauseTimer();
    $(this).css('transition','none');
    $(this).css('virtual','0');
    $(this).animate({  virtual: 1 }, {
        step: function(now,fx) {
          $(this).css({transform:'Scale('+ (now + 1) +')',
                    opacity: 1 - (now)});  
        },
        duration: 300,
        complete: function() {
            $(this).css('transition','');
            $(this).css('transform','');
            $(this).css('opacity','');
            $(this).css('virtual','');
            $(this).css('display','none');
            playButton.fadeIn();  
        }
    });
});

playButton.click(function (e) { 
    resumeTimer();
    $(this).css('transition','none');
    $(this).css('virtual','0');
    $(this).animate({  virtual: 1 }, {
        step: function(now,fx) {
          $(this).css({transform:'Scale('+ (now + 1) +')',
                    opacity: 1 - (now)});  
        },
        duration: 300,
        complete: function() {
            $(this).css('transition','');
            $(this).css('transform','');
            $(this).css('opacity','');
            $(this).css('virtual','');
            $(this).css('display','none');
            pauseButton.fadeIn();
        }
    });
});

function checkRighteft(){
    let next = nextItem(true);
    if(next != null && rightArrow.css('display') == 'none'){
        rightArrow.fadeIn();
    } else if (next == null && rightArrow.css('display') != 'none'){
        rightArrow.fadeOut();
        isLastRight = false;
    }
    next = nextItem(false);
    if(next != null && leftArrow.css('display') == 'none'){
        leftArrow.fadeIn();
    } else if (next == null && leftArrow.css('display') != 'none'){
        leftArrow.fadeOut();
        isLastRight = true;
    }
}
function resetTimer(){
    timer.stop();
    timer.css('left','0');
    timer.css('right','100%');
}
function resumeTimer(){
    timer.stop();
    animateTimer();
    timerRun = true;
}
function pauseTimer(){
    if(parseInt(timer.css('right')) == 0){
        resetTimer()
    } else {
        timer.stop();
    }
    timerRun = false;
}

function animateTimer(){
    let factor = (parseInt(timer.parent().width()) - parseInt(timer.width()))/parseInt(timer.parent().width());
    // console.log(factor);
    // console.log(timer.css('right'));
    let time = timeDelaySlide * factor;
    timer.animate({
        right:'0%'
    }, time, function() {
        slideItems(isLastRight);
        $( this ).animate({
            left:'100%'
            }, timeSlide, 'linear', function() {
                timer.css('left','0');
                timer.css('right','100%');
                animateTimer();
        });
    });
}

function slideItems(right){
    if(!slideFinish){
        return;
    }
    let next = nextItem(right);
    if(next != null){
        slideFinish = false;
        if(right){
            slide($( activeSelector ).eq(panelIndex), true, false);
            slide(next, true, true);
        } else {
            slide($( activeSelector ).eq(panelIndex), false, false);
            slide(next, false, true);
        }
    } else {
        isLastRight =!isLastRight;
        slideFinish = true;
    }
}

function slide(item, right, toactive){
    var width = item.width();
    var start = 0;
    var offset = 0;
    let op = 1;
    // console.log(right);
    // console.log(toactive);
    if(!toactive){
        item.css('z-index','0');
        item.css('transform','scale(1)');
        item.css('virtual','0px');
        item.css('opacity','1');
        width = 100;
        item.animate({  virtual: width }, {
            step: function(now,fx) {
              $(this).css({transform:'scale('+ (1 - (now/200))+')'/*,
            opacity: now/width + op*/});  
            },
            duration: timeSlide,
            complete: function() {
                if(toactive){
                    $(this).attr('id',activeId);
                    checkRighteft();
                } else {
                    $(this).attr('id','');
                }
                $(this).css('transform','');
                $(this).css('virtual','');
                $(this).css('opacity','');
                $(this).css('z-index','');
                slideFinish = true;
            }
        });
        return;
    }
    if(toactive && right){
        start = -width;
        offset = 1;
        op = 0;
    } else if (toactive && !right){
        start = width;
        offset = -1;
        op = 0;
    } else if(right){
        start = 0;
        offset = 1;
    } else {
        start = 0;
        offset = -1;
    }
    item.css('z-index','3');
    item.css('transform','translateX('+ (start)+'px)');
    item.css('virtual','0px');
    item.css('opacity','1');
    item.animate({  virtual: width }, {
        step: function(now,fx) {
          $(this).css({transform:'translateX('+ (start + (offset * now ))+'px)'/*,
        opacity: now/width + op*/});  
        },
        duration: timeSlide,
        complete: function() {
            if(toactive){
                $(this).attr('id',activeId);
                checkRighteft();
            } else {
                $(this).attr('id','');
            }
            $(this).css('transform','');
            $(this).css('virtual','');
            $(this).css('opacity','');
            $(this).css('z-index','');
            slideFinish = true;
        }
    });
}

function nextItem(right){
    if(right){
        if($(activeSelector).eq(panelIndex).next().hasClass(itemClass)){
            return $(activeSelector).eq(panelIndex).next();
        } else {
            return null;
        }
    } else {
        if($(activeSelector).eq(panelIndex).prev().hasClass(itemClass)){
            return $(activeSelector).eq(panelIndex).prev();
        } else {
            return null;
        }
    }
}