var $FRM_VISATRANSAC = $("#frm-visatransaction").parsley();
var $BTN_SAVE        = $("#btn-savevisatransac");
var $ETICKET         = $("#in-eticket");
var $PASSPORT        = $("#in-passport");
var $BTN_SS          = $("#btn-savesend");

/* PREVIEWING THE IMAGE */
var $MOD_PREVIEW     = $("#image-preview");
var $PRVIEW_IMG      = $("#img-preview");

// SENDING THE FORM NULTIPART VIA PURE JAVASCRIPT 
var sendVisaTransaction = function (self, frmid, ajax){
    
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
                
                showGritter('Success!', 'New Transaction beed created');
                setTimeout(function(){
                     // location.reload(true);
                      location.href = "draftagent";
                },200); 
                
            }else{
                showGritter('Error!', data, 'error');
                $(self).attr('disabled', false);
            }
        }
    });
};

/* VIEWING OF SELECTED IMAGE */
function readURL(input, elem) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $(elem).attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

/* CHECKING IF AN ATTACHMENT WAS IN THE PASSPORT AND IN THE ATTACHMENT(E-TICKET)*/
var isAttachedOk = function(){
    let eticketVal, passVal, lTicket, lPass;
    
    // !$ETICKET.val() || 
    if(!$PASSPORT.val()){
       return false;
    }else{
        // get the extensiion on both file
        // eticketVal = $ETICKET.val().split('.').pop();
        passVal    = $PASSPORT.val().split('.').pop();
        // lTicket    = eticketVal.toLowerCase();
        lPass      = passVal.toLowerCase();
        
        // if(lTicket == 'jpeg' || lTicket == 'png' || lTicket == 'jpg'){
            
            if(lPass == 'jpeg' || lPass == 'png' || lPass == 'jpg'){
                 return true;
            }else{
                 return false;
            }
            
        /*}else{
              return false;
        } */
        
    }
    
}

$(function(){
    
    /* allowing the - in the jquery.mask plugins */
    /*$.mask.definitions['~'] = '[-A-Za-z ]';
    $('#va-dob').mask('9999-99-99');*/

    /* create form sanitizer */
    isanitizer('nametype', 'va-fname');
    isanitizer('nametype', 'va-lname');
    isanitizer('passport', 'passport');

    // datetimepicker('div-dob');
    $('#va-dob').datetimepicker({
        format:'MM-DD-YYYY'
    });

    // viewing of the passport image
    $('#in-passport').on('change', function(){
        readURL(this, '#img-passport');
    });
    
    // previewing of the atatched eticket
    $('#in-eticket').on('change', function(){
        readURL(this, '#img-eticket');
    });
    
    // checking each passport
    $('#img-passport, #img-eticket').on('click', function(e){
        e.preventDefault();
        $MOD_PREVIEW.modal('hide');
        let crntImage = $(this).attr('src');
        $PRVIEW_IMG.attr('src', crntImage);
        $MOD_PREVIEW.modal({keyboard:"false", show:true});
        
    });
    
    /* saving the new visa transaction */
    $BTN_SAVE.on('click', function(e){
        e.preventDefault();
        
        $(this).attr('disabled', true);
        var sample = isAttachedOk();
        $FRM_VISATRANSAC.validate();
        if($FRM_VISATRANSAC.isValid() && isAttachedOk()){
            
            /* add these for the validation in the DATE */
            
            if(!$('#va-dob').val()){
                 $('#va-dob').closest('.form-group-sm').addClass('has-error has-feedback');
                $(this).attr('disabled', false);
            }else{
               $('#va-dob').closest('.form-group-sm').removeClass('has-error').addClass('has-success');
               sendVisaTransaction(this, 'frm-visatransaction', SITE_BASEPATH+"/vua/transacnew/savenewtransac");
            }
            
        }else{
            showGritter('Error!', 'Please fill-out necessary fields!', 'error');
            $(this).attr('disabled', false);
        }
    });
    
    $('#image-preview').draggable(); 
    // only add these to the create transaction and the edit  also in the inbox viewing and the css also

}); // DOM READY