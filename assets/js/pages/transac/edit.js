/* AGENT BASE UPDATION */
var $BTN_UPDATE = $("#btn-edittransac"); // edit transac
var $FRM_UPDATE = $("#frm-visatransaction-edit").parsley(); // parsley 


/* MODAL FOR USER CONFIRMATION UPDATE */
var $MOD_UPDATE_CONFIRM = $("#mod-confirmation");

/* edit type */
var updateVisaTransaction = function (self, frmid, ajax){
    
   let theForm = document.getElementById(frmid);
   let xhrObj  = new XMLHttpRequest();
   let data    = new FormData(theForm);

    jQuery.ajax({
        url: ajax,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST', // For jQuery < 1.9
        success: function(data){
            // console.log(data);
            if(data == 'done'){
                
                showGritter('Success!', 'Transaction been updated.');
                setTimeout(function(){
                      location.reload(true);
                     // location.href = "draftagent";
                },200); 
                
            }else{
                showGritter('Error!', data, 'error');
                $BTN_UPDATE.attr('disabled', false);
            }
        }
    });
};

$(function(){
    
    /* edit form sanitizer */
    isanitizer('nametype', 'va-fname-edit');
    isanitizer('nametype', 'va-lname-edit');
    isanitizer('passport', 'passport-edit');
    
    datetimepicker('va-dob-edit'); // datetimepicker
    
    // update in the agent part showing the modal update confirmation
    $BTN_UPDATE.on('click', function(e){
        e.preventDefault();

        // $BTN_UPDATE.attr('disabled', true);
        $FRM_UPDATE.validate();
        
        if($FRM_UPDATE.isValid()){
            
            if(!$('#va-dob-edit').val()){
               $('#va-dob-edit').closest('.form-group-sm').addClass('has-error has-feedback');
            }else{
               $('#va-dob-edit').closest('.form-group-sm').removeClass('has-error').addClass('has-success');
               $('#big-noti').text('Are you sure, you want to Update?');
               $MOD_UPDATE_CONFIRM.modal({backdrop:"static", keyboard:"false"});
            }
            
            
        }else{
            showGritter('Error!', 'Unable to update transaction', 'error');
        }
    });
    
    $MOD_UPDATE_CONFIRM.on('click', '#yes-confirm', function(e){
        e.preventDefault();
        updateVisaTransaction(this, 'frm-visatransaction-edit', SITE_BASEPATH+"/vua/transacview/updatetransac");
    });
    
    // on change of image
    $('#in-passport-edit').on('change', function(){
        readURL(this, '#img-passport-edit');
    });
    
    // previewing of the atatched eticket
    $('#in-eticket-edit').on('change', function(){
        readURL(this, '#img-eticket-edit');
    });
    
    /* deprecated feautures (only for emergency purpose 2/18/2018) (currently posponed)*/
    $('#img-passport-edit, #img-eticket-edit').on('click', function(e){
        e.preventDefault();
        $MOD_PREVIEW.modal('hide');
        let crntImage = $(this).attr('src');
        $PRVIEW_IMG.attr('src', crntImage);
        $MOD_PREVIEW.modal({backdrop:"static",keyboard:"false"});
    });
});