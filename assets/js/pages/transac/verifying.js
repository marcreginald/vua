var $BTN_VERIFIED     = $("#btn-verified"); // showing confirmation modal
var $MOD_VERIFICATION = $("#mod-verifying");

$(function(){
   
    /* verfying the visa applicant transaction */
    $BTN_VERIFIED.on('click', function(e){
        e.preventDefault();
        $MOD_VERIFICATION.modal({backdrop:"static",keyboard:"false"});
    });
    
    /* confirmation the verification process */
    $MOD_VERIFICATION.on('click', '#confirm-verification', function(e){
        e.preventDefault();

        let self = this;
        $(self).attr('disabled', true);
        let crntTransacNum = $(this).data('crnttransnum');
    
        $.post(SITE_BASEPATH+"/vua/util/approving", $.param({transnum:crntTransacNum}), function(stat){
            
            if(stat.status){
               showGritter('Sucecss!', crntTransacNum.toUpperCase()+" been verified");
               setTimeout(function(){
                   window.opener.location.reload();
                   window.location.reload();
               }, 1000);
            }else{
                showGritter('Error!', 'Unable to Approve '+ crntTransacNum, 'errror');
                $(self).attr('disabled', false);

            }
        });
    });
    
});