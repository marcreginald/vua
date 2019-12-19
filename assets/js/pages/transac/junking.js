var $BTN_JUNK = $("#btn-junk"); // btn-junk

var $MOD_JUNKING = $("#mod-junking"); // updated mod_junk 11:47 AM 2/25/2018

$(function(){

    /* modal for junking.. */    
    $BTN_JUNK.on('click', function(e){
        e.preventDefault();

        /* changing the universal modal-confirmation */
        $MOD_JUNKING.modal({backdrop:"static", keyboard:"false"});
    });
    
    /* CONFIRMING THE JUNKING VIA MODAL POP UP */
    $MOD_JUNKING.on('click', '#confirm-junking', function(e){
        e.preventDefault();

        let self = this;
        $(self).attr('disabled', true);
        let crnttransNum = $(self).data('transnum');

        $.post(SITE_BASEPATH+"/vua/util/junking", $.param({transnum:crnttransNum}), function(stat){
            if(stat.status){
                showGritter('Success!', crnttransNum+" has beed junked.");                
                setTimeout(function(){
                   window.history.back();
                }, 1000);
            }else{
                showGritter('Error!', 'Unable to move '+ crnttransNum + "to the junk.");
               $(self).attr('disabled', false);
            }
        });
    });
    
});