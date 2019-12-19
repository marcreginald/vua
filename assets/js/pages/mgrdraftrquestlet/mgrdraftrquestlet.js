var $BTN_ETICKET = $("#btn-geteticket");

var $TBOD_DRAFTED = $("#mgr-draftedrequestl");
var $BTN_DISCARD  = $("#btn-discardrql");
var $CHK_ALL      = $("#check-all");

// MODAL PROPERTIES
var $MOD_CONFIRMPROCESS = $("#mod-processnotification");
var $BTN_YES             = $("#yes-generate");

// apiPrint
var apiPrintRequestLetter = SITE_BASEPATH+"/vua/composerequestletter/print/";

/* updated discarding button 10:26 PM 2/25/2018 */
var $MOD_CONFIRM_DISCARD = $("#mod-confirmation");

/* showing the modal for confirmation */
var confirmingProcessBatch = function(batchNum, rqlId)
{
    $('#curr-batchnum').text(batchNum.toUpperCase());
    // $BTN_YES.data({rqlid:rqlId, batchnum:batchNum});
    $BTN_YES.data('rqlid', rqlId);
    $BTN_YES.data('batchnum', batchNum);
    $MOD_CONFIRMPROCESS.modal({ backdrop:"static", keyboard:"false" });
}

/* selecting all the domList element with the checkbox then getting the reqlid data attribute on here.*/
var getCheckedRql = function()
{
    
    let selectedRQL = [];
    
    $('#rql-needle:checked').each(function(i, e){
        selectedRQL.push($(e).data('rqlid'));
    });
    
    return selectedRQL;
}

/* discarding a specific or all the request letter */
var discardRql = function (ajx, data)
{
    
    $BTN_DISCARD.attr('disabled', true);
    let ajxF = SITE_BASEPATH+"/vua/mgrdraftrquestlet/"+ajx;
    let dataF = {};
    dataF.selectedrql = data;
    dataF.discardtype = ajx;
    
    $.post(ajxF, $.param(dataF), function(res){
        
        // console.log(res);
        if(res.status){
           showGritter('Success!', 'Draft/s has been discarded!');
            setTimeout(function(){
                location.reload(true);
            },1000);
        }else{
            $BTN_DISCARD.attr('disabled', false);
            showGritter('Error!', 'Error discarding', 'error');
        }
           
    });
}

$(function(){
        
    // loading the datatable
    datatable('data-table', SITE_BASEPATH+"/vua/mgrdraftrquestlet/draftrql", false, 'lftrip', '10,20,50,100');
    
    /* showing the error message or the modal notifying user of discarding a visa transaction */
    $BTN_DISCARD.on('click', function(e){
        e.preventDefault();
        
        /* changing the */
        $('#big-noti').text('Are you sure you want to discard selected draft/s'); 
        $('#small-noti').text('Note: Discarded draft can no longer be retrieved!'); 

        if($('#check-all').is(':checked')){
        
            $MOD_CONFIRM_DISCARD.modal({backdrop:"static",keyboard:"false"});

        }else{
            let checkedRQL = getCheckedRql();
            
            if(checkedRQL.length === 0){
               showGritter('Error!', 'Please check at least one transaction.', 'error');
            }else{
                $MOD_CONFIRM_DISCARD.modal({backdrop:"static",keyboard:"false"});
            }
        }
    });

    /* discarding all or a selected reques letter  */
    $MOD_CONFIRM_DISCARD.on('click', '#yes-confirm', function (e) {
        e.preventDefault();

        if ($('#check-all').is(':checked')) {
            discardRql('delallrql');
        }else{

            let checkedRQL = getCheckedRql();
            discardRql('selectedrql', checkedRQL);
        }
    });
    
    /* upon checking the check all checkbox */
    $CHK_ALL.on('change', function(e){
        
        if($(this).is(':checked')){
           $TBOD_DRAFTED.find('input[type=checkbox]').prop('checked', true).attr('disabled', true);
        }else{
           $TBOD_DRAFTED.find('input[type=checkbox]').prop('checked', false).attr('disabled', false);
        }
        
    });
    
    /* clicking edit request draft */
    $TBOD_DRAFTED.on('click', '#btn-editdraft-rql', function(e){
        e.preventDefault();
        let crntRQLDraft = $(this).data('crntrql');
        location.href=SITE_BASEPATH+"/vua/composeedit/index/"+crntRQLDraft;
    });
    
    /* the following functions are now been used by the compose edit controller view file */
    /* printing the request letter but first and foremost the modal will be popup first notifying that*/
    $('#btn-printdraft-rql').on('click', function(e){
        e.preventDefault();
        
        /*let crntrqlid = $(this).data('crntrql');*/
        let COMPOSE_EDIT = $('#compose-date-edit');
        
        let crntRequestid= $(this).data('crntrql');
        let crntBatchNum = $(this).data('crntbatchnum');
        
        if(!COMPOSE_EDIT.val()){
           COMPOSE_EDIT.closest('.form-group-sm .form-control').css('border-color', 'red');
        }else{
           COMPOSE_EDIT.closest('.form-group-sm .form-control').css('border-color', '');
           confirmingProcessBatch(crntBatchNum, crntRequestid);    
        }
    });
    //  currently not in use date_commented 9:26 PM 2/25/2018
    
    /* generating the request letter pdf (date_commented: 9:25PM 2/25/2018)*/
    $MOD_CONFIRMPROCESS.on('click', '#yes-generate', function(e){
        e.preventDefault();
        
        let rqlId     = $(this).data('rqlid');
        let self      = this;
        $(self).attr('disabled', true);

        var data      = {};
        data.rqlid    = $(this).data('rqlid');
        data.batchnum = $(this).data('batchnum');
        
        $.post(SITE_BASEPATH+"/vua/mgrdraftrquestlet/savegeneration", $.param(data), function(res){
             console.log(res);
            
            if(res.status){
                let printUrl = SITE_BASEPATH+res.rqsprint+rqlId;
                window.open(printUrl, "windowid", "toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1300,height=700,top=15'");
                // window.location.reload();
                location.href=SITE_BASEPATH+"/vua/mgrdraftrquestlet";
            }else{
                $(self).attr('disabled', false);
                showGritter('Error!', 'Error generating request letter', 'error');
            }
        });
    });
    
    /* downloading the eticket file */
    $BTN_ETICKET.on('click', function(e){
        e.preventDefault();
        let crntBatch = $(this).data('batchnum');
        window.open(SITE_BASEPATH+"/vua/batchrecords/downeticket/"+crntBatch, '_blank');
    });

});