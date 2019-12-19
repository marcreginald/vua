/* 

    HANDLE THE FRONT END INTERACTION OF THE USER IN THE VISA VIEW INPROCESS OR PROCESS
    
    1. THE MULTIPLE IMAGE UPLOADING INSIDE THE DIV TO BE UPLOAD
        => read the file input value make it an array.. 
        => then preview it inside the div
        
    2. HANDLE THE LIST OF APPLICANTS WITH CHANGE IMAGE
        => use event delegation on changing the image via each choose file input then 
        => in the server upon clicking the attached stamp passport server must update the stampped_passport in a particular visatransaction_id
        => 
    3. PREVIEWING OF THE CHANGE IMAGE
       => upon clicking the small image preview popup the modal that has been resize.
    
    
    use the fileReader javascript object.
    delegate the previewing to less code
*/

var $APPLICANT_LIST = $("#listapplicant-table");
var $TBOD_LIST      = $("#tbod-listapplicant"); // TBODY

var $BTN_SVSTAMPPED = $("#btn-update-stamppedpass"); // saving the per transaction stampped pic
var $MOD_PREVIEW    = $("#image-preview"); // IMAGE_PREVIEW

var $F_CONFIRMRQL   = $("#attach-confirmationrql"); // ATTACH CONFIRMATION LETTER
var $DV_CONFIRMRQL  = $("#confirm-frame"); // container of the confirmation letter pic
var $DATE_APPROVED  = $("#date-approved");

var $BTN_SAVE_APPROVE = $("#btn-approve"); // Approve button

/* custom function to check if the inprocess stampped image is the default one or not*/
var checkImgPassport  = function(stamppedPassport){
    let stamppedImg = $("#tbod-listapplicant").find("img");
    
     for(var i=0; i<stamppedImg.length; i++){
         
         if(stamppedImg[i].src.indexOf('passport.png') == -1){
             // console.log();
             $(stamppedImg[i]).closest('table').parent().closest('tr').find('td:nth-child(6)').append(stamppedPassport)
         }
     }
    
};

$(function(){
   
    /* simple fa-awesome check status */
    let stat = `
        <span class="fa-stack fa-2x text-success" title="Stampped image successfully Uploaded" style="font-size: 19px;" id="stampped-notification">
            <i class="fa fa-square-o fa-stack-2x"></i>
            <i class="fa fa-check fa-stack-1x"></i>
        </span>
    `;
    
    datetimepicker('date-approved');
    datetimepicker('compose-arrivaldate');
    checkImgPassport(stat);
    
    /* on change the choose file */
    $TBOD_LIST.on('change', '#file-upload', function(e){
        
        let self = this;
        let pic = e.target.files; // get the content for the file
                
        let reader = new FileReader(); //creating a reader OBject
        
        reader.readAsDataURL(pic[0]); // lupit
        
        /* each time the reader successfully read the file*/
        reader.onload = function(e){
            $(self).closest('td').find('img').attr('src', e.target.result); // assigning to the ermano element image
        }  
    });
    
    /* clicking the image */
    $TBOD_LIST.on('click', 'img', function(e){
          $('#img-preview').attr('src', $(this).attr('src')); 
        $MOD_PREVIEW.modal({keyboard:"false", show:true});
    });
    
    /* saving the list applicant stampped passport */
    $TBOD_LIST.on('click', '#btn-update-stamppedpass', function(e){
        e.preventDefault(); 
        
        let self = this;
        
        let crntForm = $(this).closest('tr').find('td:nth-child(7) > table > tbody > tr > td > #frm-stampped-pass')[0];
        let dataStamppedPic = new FormData(crntForm);
        let xhrObj  = new XMLHttpRequest();
        
        let fileVal = $(crntForm).find('#file-upload').val(); // viewing if the image has been changed

        if(fileVal != ''){
            xhrObj.onreadystatechange = function(){
            if(xhrObj.readyState == XMLHttpRequest.DONE){
                let res = $.parseJSON(xhrObj.responseText);
                if(res.status){
                   showGritter('Success', 'VISA has been uploaded');
                    let statCol = $(self).closest('tr').find('td:nth-child(6)');
                    
                    if(statCol.children().length == 0){
                        statCol.append(stat);
                    }else{
                        statCol.empty();
                        statCol.append(stat);
                    }
                    
                }else{
                    showGritter('Error', 'Kindly choose VISA Applicant stampped Image', 'error');
                }
                crntForm.reset();
                }
            };
            
            /* adding a validation here to determine if the closest input type file has been != no value */
            xhrObj.open('post', SITE_BASEPATH+"/vua/visaview/savestampped", true);
            xhrObj.send(dataStamppedPic);
        }else{
            showGritter('Error!', 'Kindly replace the image', 'error');
        }
    });
    
    // let picCollection = []; // file collection array
    /* change of file input dito sa may Confirmation Request Letter pic */
    $F_CONFIRMRQL.on('change', function(e){
        // alert('Delegation file upload');
        //    border-style: ridge;
        $DV_CONFIRMRQL.css({'border':'none', 'border-style':'ridge'});
        // picCollection = []; // empty the picArrayCollection
        
        let self = this;
        let pics = e.target.files;
        $DV_CONFIRMRQL.empty();
        
        $.each(pics, function(i, pic){
            
            // picCollection.push(pic);
            
            let reader = new FileReader();
            reader.readAsDataURL(pic);
            
            reader.onload = function(e){
                
                var template = `
                    <img src="`+e.target.result+`" width="100" height="90" class="custom-file-upload" id="img-comfirmpic">
                `;
                
                $DV_CONFIRMRQL.append(template);
            }; // each file has successfully read
        });
    });
    
    /* btn approve now is in the visaview-approved.js*/
    $('#confirm-frame').on('click', '#img-comfirmpic', function(e){
        e.preventDefault();
        
        $('#img-preview').attr('src', $(this).attr('src'));
        $MOD_PREVIEW.modal('show');
    });

});