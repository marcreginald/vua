var $BTN_EDITCLIENT = $("#btn-editclientinfo"); // instant update transaction button
var $FRM_CLIENTINFO = $("#frm-mgrvisatransaction").parsley(); // edit-mgr parsley

var $MOD_CONFIRM_EDIT = $("#mod-edittransac"); // new modal confirmation

/* saving the updated client info */
var saveUpdatedClientInfo = function(){
    let data = $("#frm-mgrvisatransaction").serializeArray();
    
    $.post(SITE_BASEPATH+"/mgrtransacview/updateclientinfo", $.param(data), function(res){
       
        if(res.status){
           showGritter('Success!', $('#header-transno').text().toUpperCase() + 'has been updated');
            setTimeout(function(){
                location.reload(true);
            },1000);
        }else{
            showGritter('Error!', 'Unable to update '+$('#header-transno').text().toUpperCase(), 'error');
        }
    });
}

$(function(){

    datetimepicker('va-dob-edit');
    
    /* SHOWING THE UPDATE CONFIRMATION */
    $BTN_EDITCLIENT.on('click', function(e){
        e.preventDefault();
        
        $FRM_CLIENTINFO.validate();
        
        if($FRM_CLIENTINFO.isValid()){
            
            // add the form-edit validation here if the va_dob is currently missing
            if(!$('#va-dob-edit').val()){
                $('#va-dob-edit').closest('.form-group-sm').addClass('has-error has-feedback');
                $(this).attr('disabled', false);
            }else{
               $('#va-dob-edit').closest('.form-group-sm').removeClass('has-error').addClass('has-success');
               $MOD_CONFIRM_EDIT.modal({backdrop:"static",keyboard:"false"});
            }
            
        }
        
        
    });

    /* UPDATING THE CURRENT CLIENT INFORMATION */
    $MOD_CONFIRM_EDIT.on('click', '#edit-transac', function (e) {
        e.preventDefault();
        saveUpdatedClientInfo();
    });

});