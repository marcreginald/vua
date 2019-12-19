/* DESIGN AND SOME SIDEBAR FUNCTIONALITY OF THE SYSTEM */
var $RIGHT_SIDEBAR = $('#user-batchnotification');
var handleActive = function(){

    var activeLi = $.cookie('active');
    $('.active').removeClass('active');
    $(activeLi).addClass('active');
    
    if(activeLi == '#visa'){
        $('#visa > ul').css('display', 'block');
    }
    
    var activeL2 = $.cookie('active_two');
    $(activeL2).addClass('active');
    // console.log(activeL2);
    
    $.cookie('active_two', null, {path: '/'});

}, /*handleSideBar = function(){
    
    let currenUser = $.cookie('user_type');
    
    if(currenUser == 'agent'){
       // only agent
       $.getJSON(SITE_BASEPATH+"/util/");
        
    }else{
        // admin and the agent
    }
}*/
    
Vuadesign = function (){
    "use strict";
    return {
        init:function(){
            handleActive();
            // handleSideBar();
        }
    }
}();

/* GLOBAL AVAILABLE FUNCTIONS */
function showGritter(title, text, isErr) {
    if(isErr == 'error'){
       $.gritter.add({
        title: title,
        text: text,
        sticky: !0,
        class_name: 'gritter-light'
       });
   }else{
       $.gritter.add({
        title: title,
        text: text,
        sticky: !0,
       });
   }
}
