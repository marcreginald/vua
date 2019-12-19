// part 2 of the visaview controller
var $MOD_CONFIRM_APPROVED = $("#mod-confirmation");

// submitting form +-
var submitApproved = function(){
    
    let frm = document.getElementById('attached-confirmletter');
    let fData = new FormData(frm);
    fData.append('batch_no', $BTN_SAVE_APPROVE.data('batchno')); // data attribute is <3
    fData.append('rql_id', $BTN_SAVE_APPROVE.data('rqlid'));
    fData.append('date_approved', $DATE_APPROVED.val());


    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if(xhr.readyState == XMLHttpRequest.DONE){

            let res = $.parseJSON(xhr.responseText);

            if(res.status){
               showGritter('Success!', 'Visa have been approved');
               setTimeout(function(){
                   location.href=SITE_BASEPATH+"/inprocess/";
               }, 1000);
            }else{
                showGritter('Error!', 'Unable to approve the VISA', 'error');
            }
        }
    };

    xhr.open('post', SITE_BASEPATH+"/vua/visaview/approvedinprocessrql", true); // async
    xhr.send(fData);
    
};

// checking if the all the file input have necessary values. (not in use 1:46 PM 3/8/2018).
var checkFileInputs = function(){
    
    let isEmpty = false;
    $.each($TBOD_LIST.find('input[type="file"]'), function(i, dE){
        
        /* check  if the crnt nodeList is have  a value of NULL if it does return a boolean false */
        if(!$(dE).val()){
           isEmpty &= false;
        }else{
           isEmpty &= true;
        }
    });
    
    return isEmpty;
}

// checking if it is the image in the image section td has not equal to passport.png or jpeg na file.
var checkImageNotDefault = function(){
    
    // use the indexOf function in javascript for the passport.png file. if its find one then return false
    let isNotEmpty = true;
    let CrntRowCount = $TBOD_LIST.children().length;
    
    /* image based */
    /*$.each($TBOD_LIST.find('img'), function(i, nodeList){
        
        let crntImage = $(nodeList).attr('src');
        
        if(crntImage.indexOf('passport') == -1 ){
           isNotEmpty = (isNotEmpty & true);
        }else{
           isNotEmpty = (isNotEmpty & false);
        }
           
    });
    */// return isNotEmpty;
    
    let crntstamp = 0;
    $.each($('span#stampped-notification'), function(i, nodeElem){
       ++crntstamp;
    });
    
    return CrntRowCount === crntstamp;
}

$(function () {
    
	/* showing the modal or an error message if no request letter approval letter attached */
	$BTN_SAVE_APPROVE.on('click', function(){
        
        if($DV_CONFIRMRQL.find('img').length > 0){
            
            if(checkImageNotDefault()){
                
                $('#big-noti').text('Are you sure you want to tag all VISA as approved?');
                $('#small-noti').text('Note: Approved visa will be moved in the Approved Page.');
                let DATE_APPROVED = $('#date-approved');
                
                if(!DATE_APPROVED.val()){
                   DATE_APPROVED.closest('.form-group-sm .form-control').css('border-color', 'red');
                   
                }else{
                    DATE_APPROVED.closest('.form-group-sm .form-control').css('border-color', '');
                   $MOD_CONFIRM_APPROVED.modal({ backdrop:"static", keyboard:"false"});
                }
                
            }else{
                showGritter('Error!', 'Upload each stampped visa', 'error');   
            }
            
        }else{
            showGritter('Error!', 'Please attach image of the applicant/s Approved visa', 'error'); 
            $DV_CONFIRMRQL.css('border', 'thin solid #da3737');
        }
    });
    
    /* saving the new approved must tag the batch with its manager */
    $MOD_CONFIRM_APPROVED.on('click', '#yes-confirm', function(res){
        submitApproved();
    });
    
});