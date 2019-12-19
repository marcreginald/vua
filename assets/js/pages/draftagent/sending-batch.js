var $MOD_SENDBATCH  = $("#mod-sendbatch"); // MOD
var $TBOD_SENDNATCH = $("#batch-applicant");
var $BTN_SEND       = $("#btn-sendbatch"); // BTN SEND
//

/* MODAL SEND */
var $FRM_SENDSAVE    = $("#frm-sendbatch").parsley();
// var $BTN_SAVESENDBTC = $("#btn-savebatch-send");

/* getting all agent draft transaction */
var getAllTransaction = function(){
    $.get(SITE_BASEPATH+"/vua/draftagent/getagentalltransac", function(html){
        $TBOD_SENDNATCH.empty();
        $TBOD_SENDNATCH.append(html);
        $MOD_SENDBATCH.modal({backdrop:"static",keyboard:"false"});
    });
}

/* selecting only some */
var getSelectedTransaction = function(chkdArr){
    
    $.post(SITE_BASEPATH+"/vua/draftagent/getselectedtransac/", $.param(chkdArr), function(html){
        $TBOD_SENDNATCH.empty();
        $TBOD_SENDNATCH.append(html);
        $MOD_SENDBATCH.modal({backdrop:"static",keyboard:"false"});
    }); 
}

/* sending + saving all the agent transactions */
var sendSaveTransaction = function(btn){
    
    $FRM_SENDSAVE.validate();
    if($FRM_SENDSAVE.isValid()){
        
        if($TBOD_SENDNATCH.children().length === 0){
           showGritter('Error!', 'Reload the page no applicant found', 'error');
        }else{
            
            let selectedRow = []
            let rows  = $TBOD_SENDNATCH.find('tr').each(function(i, e){
                selectedRow.push($(e).data('crnttransnum'));
            });

            let visaSend = new FormData($("#frm-sendbatch")[0]); // FormData Object FormData(data)
            for(var i=0; i < selectedRow.length; i++){
                visaSend.append('slctd[]', selectedRow[i]);
            }
            
            /*console.log(visaSend.entries());*/
            let xhrObj   = new XMLHttpRequest();
            
            xhrObj.onreadystatechange = function(){              
                if(xhrObj.readyState === XMLHttpRequest.DONE){
                   let res = $.parseJSON(xhrObj.responseText);
                    if(res.status){
                       showGritter('Success!', 'File have been uploaded and Batch been saved');
                       setTimeout(function(){
                         location.reload(true);
                       }, 1000);
                    }else{
                       showGritter('Error!', 'Unable to upload the file allowed file size was 10 MB', 'error');
                       $(btn).attr('disabled', false);
                    }
                }
            };
            
            xhrObj.open('post', SITE_BASEPATH+"/vua/batchrecords/savesendbatch", true);
            xhrObj.send(visaSend);
        }
        
    }else{
        $(btn).attr('disabled', false);
    }
}

$(function(){

    /* custom sanitizer for the sending field form data */
    isanitizer('alphanum', 'via');
    isanitizer('passport', 'f-v-num');
    isanitizer('alphanum', 'port-ofe');

    /* datetimepicker plugin*/
    datetimepicker('arrival');
    
    /* showing the modal with its transaction */
    $BTN_SEND.on('click', function(e){
        e.preventDefault();
        // getAllTransaction();
        let isAll = $CHK_ALL.is(':checked');
        $FRM_SENDSAVE.reset();
        
        if(isAll){
           
            if($('#agentdrafted-list > tr > td.dataTables_empty').length > 0){ // 9:05 AM 3/8/2018 additional validation
               showGritter('Error!', 'Empty transaction list!', 'error');
            }else{
                // $MOD_DISCARD.modal({ backdrop:"static", keyboard:"false" });                
                getAllTransaction();
                isAll = 'all'; 
            }
            
        }else{
            
            // getting all checked checkbox
            let checked = getAllSelectedTrans();
            
            if(checked.length === 0){
                showGritter('Error', 'Please check atleast one transaction', 'error');
            }else{
                let chkdArr = {};
                chkdArr['selected'] = checked;
                getSelectedTransaction(chkdArr);
                isAll = 'no';
            }
              
        }
        
    });
    
    /* save + sending the transaction to be batch */
    $MOD_SENDBATCH.on('click', '#btn-savebatch-send', function(e){
        e.preventDefault();
        $(this).attr('disabled', true); 
        sendSaveTransaction(this);
    });
    
    $MOD_SENDBATCH.on('click', '#btn-remove', function(e){
        e.preventDefault();
        $(this).closest('tr').remove();
    });
});